<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Review;

class AdminController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $ordersCount = Order::count();
        $reviewsCount = Review::count();

        return view('admin.home', compact('productsCount', 'categoriesCount', 'ordersCount', 'reviewsCount'));
    }
}
