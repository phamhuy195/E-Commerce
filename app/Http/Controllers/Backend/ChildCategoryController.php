<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $childCategories = ChildCategory::all();
        return view('admin.child-category.index',compact('childCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-category.create', compact('categories'));
    }
    /**
     * Get Sub Categories
     */

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status',0)->get();
        return $subCategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:200' ,'unique:child_categories,name'],
            'status' => ['required']
        ]);

        $data['slug'] = Str::slug($request->name);
        ChildCategory::query()->create($data);
        flash()->addFlash('success', 'Child Category created successfully', 'Success');
        return redirect()->route('admin.child-category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $childCategory->category_id)->get();
        // dd($subCategories);

        return view('admin.child-category.edit', compact('childCategory','categories','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:200' ,'unique:child_categories,name,'.$id],
            'status' => ['required']
        ]);
        $modal = ChildCategory::findOrFail($id);

        $data['slug'] = Str::slug($request->name);
        $modal->update($data);
        flash()->addFlash('success', 'Child Category created successfully', 'Success');
        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = ChildCategory::findOrFail($id);
        // dd($data);
        $data->delete();
        // flash()->addFlash('success', 'Delete successfully', 'Success');
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        // return redirect()->route('admin.child-category.index');
    }
}
