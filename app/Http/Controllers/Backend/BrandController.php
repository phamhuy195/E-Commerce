<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $brands = $request->validate([
            'name' => ['required','unique:brands,name'],
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'status' => ['required'],
            'is_featured' => ['required']
        ]);

        $brands['slug'] = Str::slug($request->name);
        $brands['logo'] =  $this->uploadImage($request,'logo','uploads/brands');

        Brand::create($brands);

        flash()->addFlash('success', 'Brand created successfully', 'Success');

        return redirect()->route('admin.brand.index');

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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required','unique:brands,name,'.$id],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'status' => ['required'],
            'is_featured' => ['required']
        ]);

        $brand = Brand::findOrFail($id);

        $data['slug'] = Str::slug($request->name);
        $data['logo'] = $this->updateImage($request, 'logo', 'uploads/brands', $brand->logo);

        $brand->update($data);

        flash()->addFlash('success', 'Brand created successfully', 'Success');
        return redirect()->route('admin.brand.index');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Brand::findOrFail($id);
        $this->deleteImage($data->logo);
        $data->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);

    }
}
