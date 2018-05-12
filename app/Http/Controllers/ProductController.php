<?php

namespace App\Http\Controllers;

use App\Category;
use App\Filters\Product\ProductFilters;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showByCategory($category_slug, $subcategory_slug, Request $request)
    {
        $category = Category::findBySlugOrFail($category_slug);

        $subCategory = $category->subCategories()->where('slug', $subcategory_slug)->firstOrFail();

        $products = $subCategory->products()->byVisible(true)->with(['brands'])->filter($request)->paginate(12);

        $products_id = $subCategory->products()->byVisible(true)->pluck('id')->all();

        $filters = ProductFilters::mappingsFilters($products_id);

        return view('front.products.show_by_category', compact('products','filters', 'category_slug', 'subcategory_slug'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->byVisible(true)->firstOrFail();

        return view('front.products.show', compact('product'));
    }
}
