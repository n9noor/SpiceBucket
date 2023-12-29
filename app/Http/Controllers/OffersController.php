<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\ProductCategory;
use App\Models\StaticPage;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OffersController extends Controller
{
    function index(Request $request)
    {
        $whereData = array(['offers.is_active', true], ['offers.featured_category', '<>', 'popular_stores']);
        if (!empty($request->category)) {
            array_push($whereData, ['product_category.id', $request->category]);
        } else if (!empty($request->searchquery)) {
            array_push($whereData, ['product_category.id', $request->category]);
        }
        $column = 'offers.created_at';
        switch ($request->sortby) {
            case 'discount':
                $column = "offers.discount_upto";
                break;
            default:
                $column = "offers.created_at";
                break;
        }
        $sorting = $request->has('orderby') ? $request->orderby : 'desc';
        $headercategories = getHeaderCategories();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $offers = Offer::leftjoin('product_category', 'offers.category_id', '=', 'product_category.id')->leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->where($whereData)->when(!empty($request->searchcategories), function ($query) use ($request) {
            $query->whereIn('offers.category_id', $request->searchcategories);
        })->when(!empty($request->searchbrands), function ($query) use ($request) {
            $query->whereIn('offers.vendor_id', $request->searchbrands);
        })->select("offers.*", "vendors.slug AS vendor_slug")->orderBy($column, $sorting)->get();
        return view('offers.index', ['headercategories' => $headercategories, 'categories' => $categories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'vendors' => $vendors, 'activePage' => 'offers', 'offers' => $offers]);
    }

    function popular_stores(Request $request)
    {
        $whereData = array(['offers.is_active', true], ['offers.featured_category', 'popular_stores']);
        if (!empty($request->category)) {
            array_push($whereData, ['product_category.id', $request->category]);
        } else if (!empty($request->searchquery)) {
            array_push($whereData, ['product_category.id', $request->category]);
        }
        $headercategories = getHeaderCategories();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $offers = Offer::leftjoin('product_category', 'offers.category_id', '=', 'product_category.id')->leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->where($whereData)->when(!empty($request->searchcategories), function ($query) use ($request) {
            $query->whereIn('offers.category_id', $request->searchcategories);
        })->when(!empty($request->searchbrands), function ($query) use ($request) {
            $query->whereIn('offers.vendor_id', $request->searchbrands);
        })->select("offers.*", "vendors.slug AS vendor_slug")->get();
        return view('offers.index', ['headercategories' => $headercategories, 'categories' => $categories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'vendors' => $vendors, 'activePage' => 'offers', 'offers' => $offers]);
    }

    function list()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->whereIn('offers.is_active', [0, 1])->select('offers.*', 'vendors.store_name', 'product_category.name AS category')->get();
        return view('offers.list', ['offers' => $offers, 'title' => 'SpiceBucket Administrator: Offers']);
    }

    function add()
    {
        $vendors = Vendor::where('is_active', true)->get();
        $categories = ProductCategory::where('is_active', true)->where('parent', 0)->get();
        return view('offers.add', ['title' => 'SpiceBucket Administrator: Add Offer', 'vendors' => $vendors, 'categories' => $categories]);
    }

    function save(Request $request)
    {
        $this->validate($request, [
            'discount_upto' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'categoryid' => 'required_if:vendorid, "=", ""',
            'vendorid' => 'required_if:categoryid, "=", ""',
            'featured_category' => 'required_if:is_featured,"!=",""'
        ]);
        $offer = new Offer;
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/offers'), $imageName);
        $offer->imagepath = $imageName;
        $offer->heading = $request->heading;
        $offer->sub_heading = $request->sub_heading;
        $offer->vendor_id = $request->vendorid;
        $offer->category_id = $request->categoryid;
        $offer->discount_upto = $request->discount_upto;
        if ($request->is_featured == 1) {
            $offer->is_featured = $request->is_featured;
            $offer->featured_category = $request->featured_category;
        }
        $offer->save();
        return redirect('/offer/list')->with('message', 'Offer saved successfully.');
    }

    function edit($id)
    {
        $offer = Offer::find($id);
        $vendors = Vendor::where('is_active', true)->get();
        $categories = ProductCategory::where('is_active', true)->where('parent', 0)->get();
        return view('offers.edit', ['title' => 'SpiceBucket Administrator: Edit Offer', 'offer' => $offer, 'vendors' => $vendors, 'categories' => $categories]);
    }

    function update($id, Request $request)
    {
        $this->validate($request, [
            'discount_upto' => 'required|numeric',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'categoryid' => 'required_if:vendorid, "=", ""',
            'vendorid' => 'required_if:categoryid, "=", ""',
            'featured_category' => 'required_if:is_featured,"!=",""'
        ]);
        $offer = Offer::findOrFail($id);
        if ($request->hasFile('image')) {
            if (File::exists(public_path('images/offers') . $offer->imagepath)) {
                File::delete(public_path('images/offers') . $offer->imagepath);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/offers'), $imageName);
            $offer->imagepath = $imageName;
        }
        $offer->discount_upto = $request->discount_upto;
        $offer->heading = $request->heading;
        $offer->sub_heading = $request->sub_heading;
        $offer->vendor_id = $request->vendorid;
        $offer->category_id = $request->categoryid;
        if ($request->is_featured == 1) {
            $offer->is_featured = $request->is_featured;
            $offer->featured_category = $request->featured_category;
        }
        $offer->save();
        return redirect('/offer/list')->with('message', 'Offer updated successfully.');
    }

    function delete($id)
    {
        Offer::where('id', $id)->update(['is_active' => 2]);
        return redirect('/offer/list')->with('message', 'Offer deleted successfully.');
    }

 function api_category_wise_offer(Request $request)
    {
       $category_ids = $request->query('category_ids', ''); // Initialize to empty string
        $vendor_ids = $request->query('vendor_ids', '');     // Initialize to empty string
    
        $query = Offer::leftJoin('vendors', 'vendors.id', '=', 'offers.vendor_id')
            ->leftJoin('product_category', 'product_category.id', '=', 'offers.category_id')
            ->where('offers.is_active', true)
            ->where('offers.featured_category', '!=', 'popular_stores');
    
        if ($category_ids !== '') {
            $category_ids = explode(',', $category_ids);
            $query->whereIn('offers.category_id', $category_ids)
            ->where('offers.featured_category', '!=', 'Popular store');
            
        }
    
        if ($vendor_ids !== '') {
            $vendor_ids = explode(',', $vendor_ids);
            $query->whereIn('vendors.id', $vendor_ids)
            ->where('offers.featured_category', '!=', 'Popular store');
        }
    
        $offers = $query->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")
            ->get();
    
        $availableOffers = [];
    
        foreach ($offers as $offer) {
            $availableOffers[] = [
                'page' => ($offer->vendor_id === null || $offer->vendor_id === "") ? 'category' : 'brand',
                'category_id' =>"{$offer->category_id}",
                'vendor_id' => "{$offer->vendor_id}",
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ];
        }
     $offerCount = count($availableOffers); // Count the number of offers

    return response()->json([
        'status' => true,
        'offer_count' => $offerCount, // Add the offer count to the response
        'category_offers' => $availableOffers
    ], 200);
    }
    
    
}
