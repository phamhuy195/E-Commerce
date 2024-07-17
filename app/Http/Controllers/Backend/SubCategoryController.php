<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.sub-category.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required'],
            'name' => ['required', 'max:200' ,'unique:sub_categories,name'],
            'status' => ['required']
        ]);
        $data['slug'] = Str::slug($request->name);

        SubCategory::query()->create($data);
        flash()->addFlash('success', 'Sub Category created successfully', 'Success');

        return redirect()->route('admin.sub-category.index');
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
        $categories = Category::all();
        $subcategories = SubCategory::findOrFail($id);
        return view('admin.sub-category.edit', compact('categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategories = $request->validate([
            'category_id' => ['required'],
            'name' => ['required', 'max:200' ,'unique:sub_categories,name,'.$id],
            'status' => ['required']
        ]);
        $modal = SubCategory::findOrFail($id);

        $subcategories['slug'] = Str::slug($request->name);

        $modal->update($subcategories);

        flash()->addFlash('success', 'Sub Category update successfully', 'Success');

        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modal = SubCategory::findOrFail($id);
        $ChildCategory = ChildCategory::where('sub_category_id', $modal->id)->count();

        // dd($ChildCategory);
        if ($ChildCategory > 0) {
            return response(['status' => 'error', 'message' => 'Sub Category has child category']);
        }
        $modal->delete();

        // flash()->addSuccess('Sub Category deleted successfully');
        return response(['status' => 'success', 'message' => 'Deleted successfully']);

    }
}
