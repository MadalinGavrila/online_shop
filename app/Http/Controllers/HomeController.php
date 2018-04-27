<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::has('subCategories')->get();

        return view('front.home', compact('categories'));
    }

    public function product()
    {
        return view('front.product');
    }
}
