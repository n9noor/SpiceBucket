<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        if(!session()->has('customer-cart')){
            session()->put('customer-cart', array());
            session()->put('totalquantity', 0);
        }
    }

    public function index(){
        $products = Product::where('is_active', true)->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image')->get();
        return view('home', ['products' => $products]);
    }
}
