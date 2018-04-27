<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::pluck('name', 'id')->all();

        $categories = Category::has('subCategories')->pluck('name', 'id')->all();

        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function ajaxSubCategory(Request $request)
    {
        $category = Category::find($request->cat_id);

        $output = '';

        foreach($category->subCategories as $subCategory){
            $output .= '<option value="'.$subCategory->id.'">'.$subCategory->name.'</option>';
        }

        return $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'visible' => $request->visible
        ]);

        $product->addBrand($request->brand);

        $product->addSubCategory($request->subCategory);

        if($file = $request->file('photo')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $product->photos()->create(['path' => $name]);
        }

        return redirect()->route('admin.products.index')->withSuccess('A product has been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $product_subCategories = $product->subCategories()->orderBy('created_at', 'desc')->paginate(8);

        $categories = Category::has('subCategories')->pluck('name', 'id')->all();

        return view('admin.products.show', compact('product', 'product_subCategories', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $brands = Brand::pluck('name', 'id')->all();

        return view('admin.products.edit', compact('product', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'visible' => $request->visible
        ]);

        $product->updateBrand($request->brand);

        return redirect()->route('admin.products.index')->withSuccess("Product with id {$product->id} has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->can('delete products')){
            $product = Product::findOrFail($id);

            foreach($product->photos as $photo){
                unlink(public_path() . $photo->path);

                $photo->delete();
            }

            $product->delete();

            return redirect()->route('admin.products.index')->withSuccess('Product has been deleted !');
        }

        return redirect()->back();
    }

    public function addSubCategory(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required',
            'subCategory' => 'required'
        ]);

        $product = Product::findOrFail($id);

        $product->addSubCategory($request->subCategory);

        return redirect()->route('admin.products.show', $product->id)->withSuccess('SubCategory has been added !');
    }

    public function withdrawSubCategory(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->withdrawSubCategory($request->subCategory);

        return redirect()->route('admin.products.show', $product->id)->withSuccess('SubCategory has been removed !');
    }
}
