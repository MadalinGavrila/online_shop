<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::orderBy('created_at', 'desc')->paginate(8);

        $categories = Category::pluck('name', 'id')->all();

        return view('admin.categories.sub_categories.index', compact('subCategories', 'categories'));
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
            'name' => 'required|string|max:50',
            'category_id' => 'required'
        ]);

        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.subCategories.index')->withSuccess('A subCategory has been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $categories = Category::pluck('name', 'id')->all();

        return view('admin.categories.sub_categories.edit', compact('subCategory', 'categories'));
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
            'name' => 'required|string|max:50',
            'category_id' => 'required'
        ]);

        $subCategory = SubCategory::findOrFail($id);

        $subCategory->update([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.subCategories.index')->withSuccess("SubCategory with id {$subCategory->id} has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->can('delete subcategories')){
            SubCategory::findOrFail($id)->delete();

            return redirect()->route('admin.subCategories.index')->withSuccess('SubCategory has been deleted !');
        }

        return redirect()->back();
    }
}
