<?php

namespace App\Http\ViewComposers;

use App\Filters\Product\ProductFilters;
use Illuminate\View\View;

class ProductOrderingViewComposer
{
    public function compose(View $view)
    {
        $view->with([
            'ordering' => ProductFilters::mappingsOrder()
        ]);
    }
}