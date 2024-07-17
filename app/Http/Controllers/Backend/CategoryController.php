<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'max:200', 'unique:categories,name'],
            'status' => ['required']
        ]);

        $categories['slug'] = Str::slug($request->name);

        Category::query()->create($categories);
        flash()->addFlash('success', 'Category created successfully', 'Success');
        return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $modal = Category::query()->findOrFail($id);

        $categories = $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'max:200', 'unique:categories,name,' . $id],
            'status' => ['required']
        ]);

        $categories['slug'] = Str::slug($request->name);

        // dd($request->all());
        $modal->update($categories);

        flash()->addFlash('success', 'Category update successfully', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modal = Category::findOrFail($id);
        // Kiểm tra xem có Sub Category hay không mới đc xóa
        $subCategory = SubCategory::where('category_id', $modal->id)->count();

        // dd($subCategory);
        if ($subCategory > 0) {
            return response(['status' => 'error', 'message' => 'Category has sub category']);
        }
        $modal->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        // flash()->addFlash('success', 'Delete successfully', 'Success');
    }
}
