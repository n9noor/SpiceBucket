<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\DeliveryStatus;
use App\Models\Offer;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\OrderDetail;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NotiApiController extends Controller
{
    public function api_notifications()
    {
        $notifications = Offer::where('is_active', true)->count();
    
        $offers = Offer::where('is_active', true)->get();
    
        $categoryIds = $offers->pluck('category_id')->unique()->toArray();
    
        $products = ProductCategory::whereIn('id', $categoryIds)->get();
    
        return response()->json([
            'count' => $notifications,
            'notifications' => $offers,
            'products' => $products,
            'status'=> true
        ]);
    }
}
