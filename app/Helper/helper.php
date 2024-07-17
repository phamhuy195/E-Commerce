<?php 

/** Sidebar active **/


function setActive(array $route){
    if(is_array($route)){
        foreach ($route as $r) {
             if(request()->routeIs($r)){
                return 'active';
            }
        }
    }   
}

 /**  Generate SKU **/
function generateSKU($length = 7) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $sku = '';
    for ($i = 0; $i < $length; $i++) {
        $sku .= $characters[rand(0, $charactersLength - 1)];
    }
    return $sku;
}

/** Slug **/

function slug($string){
    return Str::slug($string);
}

/** Check if product have discount **/

function checkDiscount($product){
    $currentDate = date('Y-m-d');
    if($product->discount_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date){
        return true;
    }
    return false;
}

/** Format Price **/
function formatPrice($price){
    return  number_format($price, 0, ',', '.') . ' VND';
}

/** Calculate discount percent **/

function discountPercent($price,$discountPrice){
    return ((($price - $discountPrice) / $price) * 100) . '%';
}

/** Check product type **/

function productType(string $type)
{
    switch($type){
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;
        case 'best_product':
            return 'Best';
            break;
        default: 
            return '';            
    }
}