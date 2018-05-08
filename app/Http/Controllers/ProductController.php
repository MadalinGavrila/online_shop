<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showByCategory($category_slug, $subcategory_slug, Request $request)
    {
        $category = Category::findBySlugOrFail($category_slug);

        $subCategory = $category->subCategories()->where('slug', $subcategory_slug)->firstOrFail();

        $products = $subCategory->products()->ByVisible(true)->with(['brands'])->filter($request, $this->getFilters())->orderBy('created_at', 'desc')->paginate(9);

        $categories = Category::has('subCategories')->get();

        return view('front.products.show_by_category', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->ByVisible(true)->firstOrFail();

        $categories = Category::has('subCategories')->get();

        return view('front.products.show', compact('product', 'categories'));
    }

    protected function getFilters()
    {
        return [
            // add a specific filter
        ];
    }
}
