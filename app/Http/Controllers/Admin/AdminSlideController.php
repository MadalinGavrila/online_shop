<?php

namespace App\Http\Controllers\Admin;

use App\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.media.slide.index', compact('slides'));
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
            'photo' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'visible' => 'required'
        ]);

        $file = $request->file('photo');
        $file_name = time() . $file->getClientOriginalName();
        $file->move('images/slides', $file_name);

        Slide::create([
            'photo' => $file_name,
            'visible' => $request->visible
        ]);

        return redirect()->route('admin.media.slide.index')->withSuccess('A slide has been created !');
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
        $slide = Slide::findOrFail($id);

        return view('admin.media.slide.edit', compact('slide'));
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
            'visible' => 'required'
        ]);

        $slide = Slide::findOrFail($id);

        $slide->update(['visible' => $request->visible]);

        return redirect()->route('admin.media.slide.edit', $slide->id)->withSuccess('The slide has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->can('delete photos')){
            $slide = Slide::findOrFail($id);

            unlink(public_path() . $slide->photo);

            $slide->delete();

            return redirect()->route('admin.media.slide.index')->withSuccess('Slide has been deleted !');
        }

        return redirect()->back();
    }
}
