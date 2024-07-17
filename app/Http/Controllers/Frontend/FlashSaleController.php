<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(){

        $flashSaleDate = FlashSale::first();
        $productFlashSales = FlashSaleItem::where('status',0)->latest('id')->paginate(10);

        return view('frontend.pages.flash-sale', compact('flashSaleDate', 'productFlashSales'));
    }
}
