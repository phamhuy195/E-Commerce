<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->product);
        $product = Product::findOrFail($request->productId);
        $productVariants = ProductVariant::where('product_id', $product->id)->latest('id')->get();
        return view('admin.product.variant.index', compact('product', 'productVariants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $variant = $request->validate([
            'product_id' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        ProductVariant::create($variant);

        flash()->addFlash('success', 'Product Variant created successfully', 'Success');
        return redirect()->route('admin.products-variant.index', ['productId' => $request->product_id]);

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
        $productVariant = ProductVariant::findOrFail($id);
        return view('admin.product.variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $variant = ProductVariant::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $variant->update($data);
        flash()->addFlash('success', 'Product Variant updated successfully', 'Success');
        return redirect()->route('admin.products-variant.index', ['productId' => $variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $variantItemCheck = ProductVariantItem::where('product_variant_id', $productVariant->id)->count();
        // dd($variantItemCheck);
        if ($variantItemCheck > 0) {
            return response(['status' => 'error', 'message' => 'This product variant has variant item please delete item first!']);
        }
        $productVariant->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
    public function changeStatus(Request $request)
    {
        $varinat = ProductVariant::findOrFail($request->id);
        $varinat->status = $request->status == 'true' ? 0 : 1;
        $varinat->save();

        flash()->addFlash('success', 'Product Flash Sale status updated successfully', 'Success');
        // return response(['message' => 'Status has been updated!']);
    }
}
