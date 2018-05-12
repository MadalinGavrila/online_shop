<?php

namespace App\Http\Controllers;

use App\Product;
use App\Slide;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('visible', 1)->orderBy('created_at', 'desc')->take(5)->get();

        $products = Product::byVisible(true)->orderBy('created_at', 'desc')->take(12)->get();

        return view('front.home', compact('slides', 'products'));
    }
}
