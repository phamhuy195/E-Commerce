<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index($productId, $variantId)
    {

        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        // dd($variant->id);
        $variantItems = ProductVariantItem::where('product_variant_id', $variant->id)->get();
        return view('admin.product.variant-item.index', compact('product', 'variant','variantItems'));
    }

    public function create(string $productId, $variantId)
    {
        // dd($productId, $variantId); 
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return view('admin.product.variant-item.create', compact('variant', 'product'));
    }
    public function store(Request $request)
    {

        // dd($request->all());
        $variantItem = $request->validate([
            'name' => ['required', 'max:200'],
            'product_variant_id' => ['required', 'integer'],
            'price' => ['required'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);
        // ProductVariantItem::create($variantItem);

        // Cach 2 : ko can $fillable
        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->product_variant_id;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        flash()->addSuccess('Product Variant Item created successfully', 'Success');
        return redirect()->route('admin.products-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->product_variant_id]);
    }


    public function edit(string $id){
        $variantItem = ProductVariantItem::findOrFail($id);
        return view('admin.product.variant-item.edit',compact('variantItem'));
    }

    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $variantItem = ProductVariantItem::findOrFail($id);
        $data = $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['required'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);
        $variantItem->update($data);
        flash()->addSuccess('Product Variant Item updated successfully', 'Success');
        return redirect()->route('admin.products-variant-item.index', ['productId' => $variantItem->productVariant->product_id, 'variantId' => $variantItem->product_variant_id]);
    }
    public function destroy(string $id)
    {
        $variantItem = ProductVariantItem::findOrFail($id);
        $variantItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }


    
    public function changeStatus(Request $request)
    {
        $varinatItem = ProductVariantItem::findOrFail($request->id);
        $varinatItem->status = $request->status == 'true' ? 0 : 1;
        $varinatItem->save();

        flash()->addFlash('success', 'Product Variant status updated successfully', 'Success');
        return response(['message' => 'Status has been updated!']);
    }
}

