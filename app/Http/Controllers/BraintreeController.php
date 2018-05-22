<?php

namespace App\Http\Controllers;

use Braintree_Gateway;

class BraintreeController extends Controller
{
    public function token()
    {
        $gateway = new Braintree_Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        return response()->json([
            'token' => $gateway->clientToken()->generate(),
        ]);
    }
}
