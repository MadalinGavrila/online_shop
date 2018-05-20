<?php

namespace App\Http\ViewComposers;

use App\Cart\Cart;
use Illuminate\View\View;

class CartViewComposer
{
    public function compose(View $view)
    {
        $view->with([
            'cart' => new Cart()
        ]);
    }
}