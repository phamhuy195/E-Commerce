<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

use Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Get Sub Categories
     */

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 0)->get();
        return $subCategories;
    }
    /**
     * Get Child Categories
     */

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();

        return $childCategories;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = $request->validate([
            'thumbnail' => ['image', 'required', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'name' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'quantity' => ['required'],
            'description' => ['required', 'max:500'],
            'details' => ['required'],
            'price' => ['required'],
            'is_top' => ['required'],
            'is_best' => ['required'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);


        $product['slug'] = slug($request->name);
        $product['thumbnail'] = $this->uploadImage($request, 'thumbnail', 'uploads/product');
        $product['sku'] = generateSKU();

        Product::query()->create($product);
        flash()->addFlash('success', 'Product created successfully', 'Success');
        return redirect()->route('admin.products.index');

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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();

        return view('admin.product.edit', compact('product', 'categories', 'brands', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $modal = Product::findOrFail($id);

        $product = $request->validate([
            'thumbnail' => ['image', 'nullable', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'name' => ['required'],
            'category_id' => ['required'],
            'sub_category_id' => ['nullable'],
            'child_category_id' => ['nullable'],
            'discount_price' => ['nullable'],
            'offer_start_date'=>['nullable'],
            'offer_end_date' => ['nullable'],
            'product_type' => ['nullable'],
            'brand_id' => ['required'],
            'quantity' => ['required'],
            'description' => ['required', 'max:500'],
            'details' => ['required'],
            'price' => ['required'],
            'is_top' => ['required'],
            'is_best' => ['required'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);

        $product['slug'] = slug($request->name);
        $product['sku'] = generateSKU();
        // $product['discount_price'] = $request->discount_price;

        $product['thumbnail'] = $this->updateImage($request, 'thumbnail', 'uploads/products', $modal->thumbnail);

        $modal->update($product);
        flash()->addFlash('success', 'Product created successfully', 'Success');
        return redirect()->route('admin.products.index');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $variantCheck = ProductVariant::where('product_id', $product->id)->count();
        // dd($variantCheck);
        if ($variantCheck > 0) {
            return response(['status' => 'error', 'message' => 'This product has variant please delete variant first!']);
        }
        $this->deleteImage($product->thumbnail);
        $product->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function destroyAll(string $id)
    {
        $product = Product::findOrFail($id);
        /** Delete the main product image */
        $this->deleteImage($product->thumbnail);

        /** Delete product gallery images */
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($galleryImages as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }

        /** Delete product variants if exist */
        $variants = ProductVariant::where('product_id', $product->id)->get();

        foreach ($variants as $variant) {
            // dd($variant->productVariantItems);
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

}
