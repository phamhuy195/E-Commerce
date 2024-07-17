<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 0)->orderBy('serial', 'asc')
        ->select('banner', 'type', 'title', 'price', 'btn_url', 'serial')->get();
        $flashSaleDate = FlashSale::first();
        $productFlashSales = FlashSaleItem::where('show_at_home', 0)
            ->where('status',0)->get();
        // return $sliders;
        return view('frontend.home.home',
            compact(
                'sliders',
                'flashSaleDate',
                'productFlashSales'
            ));
    }
}
