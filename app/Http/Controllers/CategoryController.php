<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories|max:50|min:5',
            'image' => 'required|mimes:png,jpg,jpeg|max:1024'
        ]);
        if($request->hasFile('image')){
            $imageName = "category-".time().".".$request->image->extension();
            $request->file('image')->storeAs('categories', $imageName, 'public');
        }else{
            $imageName = "";
        }
        $category = Category::create([
            'title' => $request->title,
            'image' => $imageName
        ]);
        if($category){
            return redirect()->route('category.index')->with('success','Category created successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong. Please try again later!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('category.edit',compact('category'));
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
        $category = Category::findOrFail($id);
        $request->validate([
            'title' => 'required|unique:categories,title,'.$category->id,
            'image' => 'sometimes'
        ]);
        if($request->hasFile('image')){
            if($category->image){
                Storage::disk('public')->delete('categories/'.$category->image);
            }
            $imageName = "category-".time().".".$request->image->extension();
            $request->file('image')->storeAs('categories', $imageName, 'public');
        }else{
            $imageName = $category->image;
        }
        $category->update([
            'title' => $request->title,
            'image' => $imageName
        ]);
        if($category){
            return redirect()->route('category.index')->with('success','Category updated successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong. Please try again later!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->image){
            Storage::disk('public')->delete('categories/'.$category->image);
        }
        $category->delete();
        return redirect()->back()->with('success','Category deleted successfully');
    }
}
