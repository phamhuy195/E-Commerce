<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();

        $products = Product::where('status', 0)->get();

        $flashSaleProducts = FlashSaleItem::all();
        return view('admin.flash-sale.index', compact('flashSaleDate', 'products', 'flashSaleProducts'));
    }

    function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'end_date' => 'required',
        ]);

        // Cập nhật 1 bản ghi nếu tồn tại or tạo mới nếu ko tồn tại
        FlashSale::updateOrCreate(
            ['id' => 1], // tìm bản ghi có id là 1.
            ['end_date' => $request->end_date]
        );

        flash()->addSuccess('Flash sale date updated successfully');
        return redirect()->back();

    }

    public function addProduct(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => ['required','unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ],
        [
            'product_id.unique' => 'This Product is already in flash sale!',
        ]
    );

        $flashSaleDate = FlashSale::first();

        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->product_id = $request->product_id;
        $flashSaleItem->flash_sale_id = $flashSaleDate->id;
        $flashSaleItem->show_at_home = $request->show_at_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();

        flash()->addSuccess('Product added successfully');
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $flashSaleProduct = FlashSaleItem::findOrFail($request->id);
        $flashSaleProduct->status = $request->status == 'true' ? 0 : 1;
        $flashSaleProduct->save();

        flash()->addFlash('success', 'Status updated successfully', 'Success');
    }
    public function showAtHome(Request $request)
    {
        $flashSaleProduct = FlashSaleItem::findOrFail($request->id);
        $flashSaleProduct->show_at_home = $request->status == 'true' ? 0 : 1;
        $flashSaleProduct->save();

        flash()->addFlash('success', 'Status updated successfully', 'Success');
    }

    public function destroy(string $id){
        $flashSaleProduct = FlashSaleItem::findOrFail($id);
        $flashSaleProduct->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
