<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = new Cart();

        $cart->refresh();

        return view('front.cart.index', compact('cart'));
    }

    public function add($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $cart = new Cart();

        try {
            $cart->add($product, 1);
        } catch(QuantityExceededException $e) {
            session()->flash('quantity_exceeded_' . $product->id, $e->getMessage());
        }

        return redirect()->route('cart');
    }

    public function update($slug, Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer'
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $cart = new Cart();

        try {
            $cart->update($product, $request->quantity);
        } catch(QuantityExceededException $e) {
            session()->flash('quantity_exceeded_' . $product->id, $e->getMessage());
        }

        return redirect()->route('cart');
    }

    public function remove($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $cart = new Cart();

        $cart->remove($product);

        return redirect()->route('cart');
    }
}