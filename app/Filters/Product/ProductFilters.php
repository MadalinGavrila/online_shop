<?php

namespace App\Filters\Product;

use App\Brand;
use App\Filters\FiltersAbstract;
use App\Filters\Product\Ordering\Ordering;

class ProductFilters extends FiltersAbstract
{
    protected $filters = [
        'brand' => BrandFilter::class,
        'order' => Ordering::class,
    ];

    public static function mappingsFilters($products_id)
    {
        return [
            'brand' => Brand::byProducts($products_id)->pluck('name', 'slug')->all(),
        ];
    }

    public static function mappingsOrder()
    {
        return [
            'order' => [
                'newest' => 'Newest',
                'price_asc' => 'Price asc',
                'price_desc' => 'Price desc'
            ],
        ];
    }
}