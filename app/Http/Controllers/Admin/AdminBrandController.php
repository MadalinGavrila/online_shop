<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.brands.index', compact('brands'));
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
            'photo' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $brand = Brand::create(['name' => $request->name]);

        if($file = $request->file('photo')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $brand->photo()->create(['path' => $name]);
        }

        return redirect()->route('admin.brands.index')->withSuccess('A brand has been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        $brand_products = $brand->products()->orderBy('created_at', 'desc')->paginate(8);

        return view('admin.brands.show', compact('brand', 'brand_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
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
            'photo' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $brand = Brand::findOrFail($id);

        $brand->update(['name' => $request->name]);

        if($file = $request->file('photo')){
            if($brand->photo){
                unlink(public_path() . $brand->photo->path);

                $brand->photo()->delete();
            }

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $brand->photo()->create(['path' => $name]);
        }

        return redirect()->route('admin.brands.index')->withSuccess("Brand with id {$brand->id} has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->can('delete brands')){
            $brand = Brand::findOrFail($id);

            if($brand->photo){
                unlink(public_path() . $brand->photo->path);

                $brand->photo()->delete();
            }

            $brand->delete();

            return redirect()->route('admin.brands.index')->withSuccess('Brand has been deleted !');
        }

        return redirect()->back();
    }
}
