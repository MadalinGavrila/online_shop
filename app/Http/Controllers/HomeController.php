<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slide;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::has('subCategories')->get();

        $slides = Slide::where('visible', 1)->orderBy('created_at', 'desc')->take(5)->get();

        $products = Product::ByVisible(true)->orderBy('created_at', 'desc')->take(12)->get();

        return view('front.home', compact('categories', 'slides', 'products'));
    }
}
