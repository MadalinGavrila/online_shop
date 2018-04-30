<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.categories.index')->withSuccess('A category has been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $subCategories = $category->subCategories()->orderBy('created_at', 'desc')->paginate(8);

        return view('admin.categories.show', compact('category', 'subCategories'));
    }

    public function storeSubCategory(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        $category = Category::findOrFail($id);

        $category->subCategories()->create([
            'name' => $request->name,
            'category_id' => $category->id
        ]);

        return redirect()->route('admin.categories.show', $category->id)->withSuccess('A subCategory has been created !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        $category = Category::findOrFail($id);

        $category->update(['name' => $request->name]);

        return redirect()->route('admin.categories.edit', $category->id)->withSuccess('The category has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->can('delete categories')){
            Category::findOrFail($id)->delete();

            return redirect()->route('admin.categories.index')->withSuccess('Category has been deleted !');
        }

        return redirect()->back();
    }
}
