<?php

namespace App\Http\Controllers;

use App\Filters\Product\ProductFilters;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);

        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->byVisible(true)->filter($request)->paginate(12);

        $products_id = Product::where('name', 'LIKE', '%' . $request->search . '%')->byVisible(true)->pluck('id')->all();

        $filters = ProductFilters::mappingsFilters($products_id);

        return view('front.search.index', compact('products', 'filters'));
    }
}
