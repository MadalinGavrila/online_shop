<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart\Cart;
use App\Events\Order\OrderWasCreated;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Order;
use Braintree_Gateway;

class OrderController extends Controller
{
    public function index()
    {
        $cart = new Cart();

        $cart->refresh();

        if(!$cart->subTotal()){
            return redirect()->route('cart');
        }

        return view('front.order.index', compact('cart'));
    }

    public function store(OrderCreateRequest $request)
    {
        $cart = new Cart();

        $cart->refresh();

        if(!$cart->subTotal()){
            return redirect()->route('cart');
        }

        if(!$request->payment_method_nonce){
            return redirect()->route('order');
        }

        $hash = bin2hex(random_bytes(32));

        $user = auth()->user();

        $address = Address::firstOrCreate([
            'address1' => $request->address1,
            'address2' => $request->address2,
            'country' => $request->country,
            'city' => $request->city,
            'postal_code' => $request->postal_code
        ]);

        $order = $user->orders()->create([
            'hash' => $hash,
            'address_id' => $address->id,
            'total' => $cart->total(),
            'paid' => false
        ]);

        $allItems = $cart->all();

        $order->products()->saveMany(
            $allItems,
            $this->getQuantities($allItems)
        );

        $gateway = new Braintree_Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $cart->total(),
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        event(new OrderWasCreated($order, $cart, $result));

        if(!$result->success){
            return redirect()->route('order');
        }

        return redirect()->route('order.show', $order->hash);
    }

    public function show($hash)
    {
        $order = auth()->user()->orders()->with(['address', 'products'])->where('hash', $hash)->firstOrFail();

        return view('front.order.show', compact('order'));
    }

    protected function getQuantities($items)
    {
        $quantities = [];

        foreach($items as $item){
            $quantities[] = ['quantity' => $item->quantity];
        }

        return $quantities;
    }
}
