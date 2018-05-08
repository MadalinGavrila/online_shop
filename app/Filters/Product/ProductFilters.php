<?php

namespace App\Filters\Product;

use App\Filters\FiltersAbstract;
use App\Filters\Product\Ordering\PriceOrder;

class ProductFilters extends FiltersAbstract
{
    protected $filters = [
        'brand' => BrandFilter::class,
        'price' => PriceOrder::class,
    ];
}