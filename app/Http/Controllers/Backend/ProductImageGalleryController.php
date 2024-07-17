<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ProductImageGalleryController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product = Product::findOrFail($request->productId);

        $imageGalleries = ProductImageGallery::where('product_id', $product->id)->get();

        return view('admin.product.image-gallery.index', compact('product', 'imageGalleries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image.*' => ['required', 'image', 'max:2048'],
        ]);
        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads/products/image-gallery');

        foreach ($imagePaths as $path) {
            // Tạo một đối tượng mới của lớp ProductImageGallery để lưu thông tin hình ảnh
            $productImageGallery = new ProductImageGallery();

            // Gán đường dẫn hình ảnh cho thuộc tính 'image' của đối tượng
            $productImageGallery->image = $path;

            // Gán ID sản phẩm cho thuộc tính 'product_id' của đối tượng từ yêu cầu
            $productImageGallery->product_id = $request->product_id;

            // Lưu đối tượng vào cơ sở dữ liệu, tạo một bản ghi mới trong bảng ProductImageGallery
            $productImageGallery->save();
        }

        flash()->addFlash('success', 'Image uploaded successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = ProductImageGallery::findOrFail($id);
        $this->deleteImage($image->image);
        $image->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
