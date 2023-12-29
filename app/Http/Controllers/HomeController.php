<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Faqs;
use App\Models\Offer;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\SearchHistory;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Vendor;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductVerient;
use App\Models\ProductVerientPrice;
use App\Models\ProductVerientValue;
use App\Models\Review;
use App\Models\StaticPage;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Mail as MailModel;
use App\Models\Message;


class HomeController extends Controller
{
    public function index()
    {
        $offers['mostpopularbrands'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category', 'most_popular_brands')->limit(6)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['latestoffers'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category', 'latest_offers')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['topsellingbrands'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'top_selling_brands')->limit(4)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['dealsoftheday'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'deal_of_the_day')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['highlydiscountedoffers'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'highly_discounted_offers')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['newatspicebucket'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'new_at_spice_bucket')->limit(4)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['dailyessentialneeds'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'daily_essential_needs')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['popularstores'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'popular_stores')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['bestsellers'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'bestsellers')->limit(4)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        $offers['recommendedforyou'] = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'recommended_for_you')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();

        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $home = StaticPage::where('url', 'home')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        return view('home', [
            'offers' => $offers, 'headercategories' => $headercategories, 'activePage' => 'home', 'header' => ($header == null ? array() : json_decode($header->description, true)), 'home' => ($home == null ? array() : json_decode($home->description, true)) , 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'categories' => $categories, 'vendors' => $vendors
        ]);
    }
    public function aboutus()
    {
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $about = StaticPage::where('url', 'about-us')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        return view('aboutus', [
            'activePage' => 'about', 'headercategories' => $headercategories, 'categories' => $categories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'about' => ($about == null ? array() : json_decode($about->description, true)), 'vendors' => $vendors
        ]);
    }

    public function contact()
    {
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $contact = StaticPage::where('url', 'contact-us')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        return view('contact', [
            'activePage' => 'contact', 'headercategories' => $headercategories, 'contact' => ($contact == null ? array() : json_decode($contact->description, true)), 'categories' => $categories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'vendors' => $vendors
        ]);
    }



     public function our_sellers()
    {
         $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();  
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        return view('our_sellers', [
            'activePage' => 'Our Sellers',  'vendors' => $vendors,'headercategories' => $headercategories,'header' => ($header == null ? array() : json_decode($header->description, true)),'categories' => $categories,'footer' => ($footer == null ? array() : json_decode($footer->description, true))
        ]);
    }

    public function enquiry(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-z][a-z\s]+$/i',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'subject' => 'required',
            'content' => 'required'
        ]);
        $enquiry = array();
        $enquiry['type'] = $request->type;
        $enquiry['name'] = $request->name;
        $enquiry['email'] = $request->email;
        $enquiry['address'] = $request->address;
        $enquiry['phone'] = $request->phone;
        $enquiry['subject'] = $request->subject;
        $enquiry['content'] =  $request->content;

        Mail::send('mailtemplate.enquries', array('enquiry' => $enquiry), function ($message) use ($enquiry) {
            $message->to('jain03435@gmail.com')->subject('New enquiry generated');
            $message->from($enquiry['email'], 'Spice Bucket');
        });
        Session::flash('message', 'Thankyou for contacting we will get back to you soon!'); 
        return redirect('/contact-us');
    }

    public function faq()
    {
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $faqdata = Faqs::all();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        return view('faq', [
            'activePage' => 'faq', 'headercategories' => $headercategories, 'categories' => $categories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'vendors' => $vendors, 'faqs' => $faqdata
        ]);
    }


    public function vendors_list()
    {
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::with('products')->where('vendors.is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        return view('vendors-list', [
            'vendors' => $vendors, 'activePage' => 'vendor', 'headercategories' => $headercategories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'categories' => $categories
        ]);
    }

    public function shop(Request $request)
    {
        $searchvendors = $request->searchvendors;
        $searchcategories = $request->searchcategories;
        $whereData = array(['products.is_active', true]);
        if (!empty($request->searchquery)) {
            if (!empty($request->category)) {
                array_push($whereData, ['products.category_id', $request->category]);
            }
            array_push($whereData, ['products.name', 'like', '%' . $request->searchquery . '%']);
        }
        if (!empty($request->max_price) && $request->max_price > 0) {
            array_push($whereData, ['products.net_price', '>=', $request->min_price]);
            array_push($whereData, ['products.net_price', '<=', $request->max_price]);
        }
        $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->join('product_images', 'product_images.id', '=', 'product_variant_price.image_id')
            ->where('products.is_approved', true)->where($whereData)
            ->when(!empty($searchvendors) && is_array($searchvendors), function ($query) use ($searchvendors) {
                $query->whereIn('products.vendor_id', $searchvendors);
            })
            ->when(!empty($searchcategories) && is_array($searchcategories), function ($query) use ($searchcategories) {
                $query->whereIn('products.category_id', $searchcategories);
            })
            ->orderBy('id', 'desc')
            ->selectRaw('products.*, product_images.image, product_variant_price.net_price as netPrice,product_variant_price.product_mrp as product_mrp, product_category.slug as categoryslug, product_category.name as categoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName, vendors.slug as vendor_slug')->get();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $headercategories = getHeaderCategories();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        return view('shop', ['products' => $products, 'categories' => $categories, 'vendors' => $vendors, 'activePage' => 'shop', 'headercategories' => $headercategories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true))]);
    }

    public function quickviewProduct(Request $request)
    {
        $products = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
            ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->where('products.is_approved', true)->where('products.id', $request->productid)
            ->selectRaw('products.*, GROUP_CONCAT(CONCAT(product_images.id, "|", product_images.image) ORDER BY product_images.id DESC) AS images, product_variant_price.id AS variantpriceid, product_variant_price.image_id, product_variant_price.net_price as netPrice,product_variant_price.product_mrp as product_mrp, product_variant_price.variant_value_id_1 AS variant1, product_variant_price.variant_value_id_2 AS variant2, product_variant_price.variant_value_id_3 AS variant3, product_variant_price.quantity AS qty, pc1.name as categoryName, pc1.slug as category_slug, pc2.name as subCategoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName')->get();

        $productvariantprice = array();
        $productsvariants = array();
        $productsvariantspricelist = ProductVerientPrice::where('product_id', $request->productid)
            ->select(DB::raw('variant_value_id_1, variant_value_id_2, variant_value_id_3, quantity, net_price'))->get();
        if ($productsvariantspricelist->count() > 0) {
            foreach ($productsvariantspricelist as $price) {
                if (!is_null($price->variant_value_id_1) && !in_array($price->variant_value_id_1, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_1);
                }
                if (!is_null($price->variant_value_id_2) && !in_array($price->variant_value_id_2, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_2);
                }
                if (!is_null($price->variant_value_id_3) && !in_array($price->variant_value_id_3, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_3);
                }
                if (!array_key_exists($price->variant_value_id_1, $productvariantprice)) {
                    $productvariantprice[$price->variant_value_id_1] = array();
                }
                if (!is_null($price->variant_value_id_1)) {
                    if (!is_null($price->variant_value_id_2)) {
                        if (!is_null($price->variant_value_id_3)) {
                            $variantpricearray[$price->variant_value_id_2][$price->variant_value_id_3] = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                        } else {
                            $variantpricearray[$price->variant_value_id_2] = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                        }
                    } else {
                        $variantpricearray = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                    }
                    $productvariantprice[$price->variant_value_id_1] = $variantpricearray;
                }
            }
        }

        $variants  = ProductVerient::join('product_variant_values', 'product_variant_values.variant_id', '=', 'product_variants.id')
            ->where('product_variants.is_active', true)->select('product_variants.*', DB::raw('GROUP_CONCAT(CONCAT(product_variant_values.value,"|",product_variant_values.id) ORDER BY product_variant_values.weight DESC) AS variantvalues'))->groupBy('product_variants.id')->get();

        return response()->json(['html' => view('quickview', ['product' => $products[0], 'variants' => $variants, 'productsvariants' => $productsvariants, 'productvariantprice' => $productvariantprice])->render()]);
    }

    public function quickviewVariantProductPrice(Request $request)
    {
        $filters = explode(",", $request->filters);
        $whereData = array(array('product_id', $request->productid));
        if (array_key_exists(0, $filters) && !empty($filters[0])) {
            array_push($whereData, array('variant_value_id_1', $filters[0]));
        }
        if (array_key_exists(1, $filters) && !empty($filters[1])) {
            array_push($whereData, array('variant_value_id_2', $filters[1]));
        }
        if (array_key_exists(2, $filters) && !empty($filters[2])) {
            array_push($whereData, array('variant_value_id_3', $filters[2]));
        }
        $productVariantPrice = ProductVerientPrice::where($whereData)->with('products')->get();
        if (count($productVariantPrice) > 0) {
            $imageid = $productVariantPrice[0]->image_id;
            if (is_null($imageid)) {
                $imageid = ProductVerientPrice::where('product_id', $request->productid)->where('mark_as_default', 1)->first()->image_id;
            }
            $image = ProductImage::find($imageid);
            $image = is_null($imageid) ? url('/assets/imgs/no-image-placeholder.png') : (env('APP_ENV') == 'production' ? url('/public/images/products/' . $image->image) : url('/images/products/' . $image->image));
            return response()->json(['ok' => true, 'data' => array('price' => $productVariantPrice[0]->net_price, 'prdocutmrp' => $productVariantPrice[0]->product_mrp, 'variantpriceid' => $productVariantPrice[0]->id, 'productsku' => $productVariantPrice[0]->sku, 'quantity' => $productVariantPrice[0]->quantity, 'minoq' => $productVariantPrice[0]->minoq, 'variantimageid' => $imageid, 'variantimage' => $image)]);
        }
        return response()->json(['ok' => false]);
    }

    public function product_category_view(Request $request, $slug)
    {
        $category = ProductCategory::where('slug', $slug)->first();
        $whereData = array(['products.category_id', $category->id]);
        if (!empty($request->max_price) && $request->max_price > 0) {
            array_push($whereData, ['products.net_price', '>=', $request->min_price]);
            array_push($whereData, ['products.net_price', '<=', $request->max_price]);
        }

        $searchvendors = $request->searchvendors;
        $searchcategories = $request->searchcategories;
        $column = 'products.created_at';
        switch ($request->sortby) {
            case 'relevance':
                $column = "products.id";
                break;
            case 'discount':
                $column = "products.discount_percentage";
                break;
            case 'name':
                $column = "products.name";
                break;
            case 'rating':
                $column = "products.id";
                break;
            case 'created':
                $column = "products.created_at";
                break;
            case 'price':
                $column = "products.net_price";
                break;
        }
        $sorting = $request->has('orderby') ? $request->orderby : 'desc';

        $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->join('product_images', 'product_images.id', '=', 'product_variant_price.image_id')
            ->where('products.is_approved', true)->where('products.is_active', true)->where($whereData)
            ->when(!empty($searchvendors) && is_array($searchvendors), function ($query) use ($searchvendors) {
                $query->whereIn('products.vendor_id', $searchvendors);
            })
            ->when(!empty($searchcategories) && is_array($searchcategories), function ($query) use ($searchcategories) {
                $query->whereIn('products.sub_category_id', $searchcategories);
            })
            ->selectRaw('products.*, product_images.image, product_category.slug as categoryslug,product_variant_price.net_price as netPrice,product_variant_price.product_mrp as product_mrp, product_category.name as categoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName, vendors.slug as vendor_slug')->orderBy($column, $sorting)->get();

        $headercategories = getHeaderCategories();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $subcategories = ProductCategory::where('is_active', true)->where('parent', $category->id)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        return view('product-category', ['activePage' => '', 'products' => $products, 'headercategories' => $headercategories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'vendors' => $vendors, 'subcategories' => $subcategories, 'category' => $category, 'categories' => $categories]);
    }

    public function product_view($slug)
    {
        $products = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
            ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->leftjoin('product_images AS pi', 'product_variant_price.image_id', '=', 'pi.id')
            ->where('products.slug', $slug)
            ->selectRaw('products.*, GROUP_CONCAT(CONCAT(product_images.id, "|", product_images.image) ORDER BY product_images.id DESC) AS images, product_variant_price.id AS variantpriceid, product_variant_price.image_id, product_variant_price.net_price as netPrice, product_variant_price.discount_percentage as discountPercentage, product_variant_price.product_mrp as product_mrp, product_variant_price.variant_value_id_1 AS variant1, product_variant_price.variant_value_id_2 AS variant2, product_variant_price.variant_value_id_3 AS variant3, product_variant_price.quantity AS qty,  pi.image AS defaultImage, pc1.name as categoryName, pc1.slug as category_slug, pc2.name as subCategoryName, vendors.store_name as vendorName, vendors.address as vendor_address, vendors.phone as vendor_phone, vendors.vendor_alias as vendorNickName, vendors.slug AS vendor_slug, vendors.shipping_pincode AS vendor_shipping_pincode')->get();

        $productvariantprice = array();
        $productsvariants = array();
        $productsvariantspricelist = ProductVerientPrice::where('product_id', $products[0]->id)
            ->select(DB::raw('variant_value_id_1, variant_value_id_2, variant_value_id_3, quantity, net_price'))->get();
        if ($productsvariantspricelist->count() > 0) {
            foreach ($productsvariantspricelist as $price) {
                if (!is_null($price->variant_value_id_1) && !in_array($price->variant_value_id_1, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_1);
                }
                if (!is_null($price->variant_value_id_2) && !in_array($price->variant_value_id_2, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_2);
                }
                if (!is_null($price->variant_value_id_3) && !in_array($price->variant_value_id_3, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_3);
                }
                if (!array_key_exists($price->variant_value_id_1, $productvariantprice)) {
                    $productvariantprice[$price->variant_value_id_1] = array();
                }
                if (!is_null($price->variant_value_id_1)) {
                    if (!is_null($price->variant_value_id_2)) {
                        if (!is_null($price->variant_value_id_3)) {
                            $variantpricearray[$price->variant_value_id_2][$price->variant_value_id_3] = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                        } else {
                            $variantpricearray[$price->variant_value_id_2] = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                        }
                    } else {
                        $variantpricearray = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                    }
                    $productvariantprice[$price->variant_value_id_1] = $variantpricearray;
                }
            }
        }
        $relatedProducts = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->join('product_images', 'product_images.id', '=', 'product_variant_price.image_id')
            ->where('products.is_approved', true)->where('products.is_active', true)
            ->where('products.vendor_id', $products[0]->vendor_id)
            ->where('products.slug', '<>', $slug)
            ->selectRaw('products.*, product_images.image, product_variant_price.net_price as netPrice, product_variant_price.product_mrp as product_mrp,product_category.slug as categorySlug, product_category.name as categoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName, vendors.slug as vendor_slug')->orderBy(DB::raw('RAND()'))->limit(8)->get();

        $productreviews = array();
        $reviews = Review::leftjoin('customers', 'customers.id', '=', 'reviews.customerid')->leftjoin('review_image', 'review_image.reviewid', '=', 'reviews.id')->where('reviews.productid', $products[0]->id)->select('reviews.*', 'customers.name', DB::raw('GROUP_CONCAT(review_image.image) AS images'))->groupBy('reviews.id')->get();
        foreach ($reviews as $review) {
            array_push($productreviews, array('star' => $review->star, 'customer_name' => (!is_null($review->name) ? $review->name : "Anonymous"), 'time_difference' => '', 'description' => $review->review, 'images' => (!is_null($review->images) ? explode(",", $review->images) : array())));
        }

        $productreviewcount = array('total' => 0, 'avg' => 0.00, 'star5' => 0.00, 'star4' => 0.00, 'star3' => 0.00, 'star2' => 0.00, 'star1' => 0.00);
        $reviewcount = Review::select(DB::raw('count(*) AS total'), DB::raw('SUM(star) AS totalstar'), DB::raw('SUM(CASE WHEN star=5 THEN 1 ELSE 0 END) AS star5'), DB::raw('SUM(CASE WHEN star=4 THEN 1 ELSE 0 END) AS star4'), DB::raw('SUM(CASE WHEN star=3 THEN 1 ELSE 0 END) AS star3'), DB::raw('SUM(CASE WHEN star=2 THEN 1 ELSE 0 END) AS star2'), DB::raw('SUM(CASE WHEN star=1 THEN 1 ELSE 0 END) AS star1'))->where('productid', $products[0]->id)->first();
        $productreviewcount['total'] = $reviewcount->total;
        $productreviewcount['avg'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->totalstar / $reviewcount->total), 2);
        $productreviewcount['star5'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star5 * 100 / $reviewcount->total), 2);
        $productreviewcount['star4'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star4 * 100 / $reviewcount->total), 2);
        $productreviewcount['star3'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star3 * 100 / $reviewcount->total), 2);
        $productreviewcount['star2'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star2 * 100 / $reviewcount->total), 2);
        $productreviewcount['star1'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star1 * 100 / $reviewcount->total), 2);

        $variants  = ProductVerient::join('product_variant_values', 'product_variant_values.variant_id', '=', 'product_variants.id')
            ->where('product_variants.is_active', true)->select('product_variants.*', DB::raw('GROUP_CONCAT(CONCAT(product_variant_values.value,"|",product_variant_values.id) ORDER BY product_variant_values.weight DESC) AS variantvalues'))->groupBy('product_variants.id')->get();

        $productVariant = ProductVerientPrice::leftjoin('product_variant_values AS ppv1', 'ppv1.id', '=', 'product_variant_price.variant_value_id_1')->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'ppv1.variant_id')->leftjoin('product_variant_values AS ppv2', 'ppv2.id', '=', 'product_variant_price.variant_value_id_2')->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'ppv2.variant_id')->leftjoin('product_variant_values AS ppv3', 'ppv3.id', '=', 'product_variant_price.variant_value_id_3')->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'ppv3.variant_id')->leftjoin('product_images', 'product_images.id', '=', 'product_variant_price.image_id')->select('product_variant_price.*', 'ppv1.value AS Object1Value', 'ppv2.value AS Object2Value', 'ppv3.value AS Object3Value', 'pv1.name AS Object1', 'pv2.name AS Object2', 'pv3.name AS Object3', DB::raw('IF(product_images.image IS NULL, "", product_images.image) AS variantImage'))->where('product_variant_price.product_id', $products[0]->id)->get();
        $mappedVariant = array();
        foreach ($productVariant as $variant) {
            if (!is_null($variant->variant_value_id_1) && !in_array($variant->variant_value_id_1, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_1);
            }
            if (!is_null($variant->variant_value_id_2) && !in_array($variant->variant_value_id_2, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_2);
            }
            if (!is_null($variant->variant_value_id_3) && !in_array($variant->variant_value_id_3, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_3);
            }
        }

        $variant_news = ProductVerient::where('is_active', true)->get();
        $variantsValueMap = array();
        foreach ($variant_news as $variant) {
            if (!array_key_exists($variant->id, $variantsValueMap)) {
                $variantsValueMap[$variant->id] = array('name' => $variant->name, 'checked' => 0, 'values' => array());
            }
        }
        $variantsValue = ProductVerientValue::where('is_active', true)->whereIn('variant_id', array_keys($variantsValueMap))->select('variant_id', DB::raw('GROUP_CONCAT(CONCAT(id, "|", value)) AS variantvalues'))->groupBy('variant_id')->orderBy('weight', 'desc')->get();

        $variantAvailable=[]; 
        foreach ($variantsValue as $variant) {
            if (array_key_exists($variant->variant_id, $variantsValueMap)) {
                $variantsValueMap[$variant->variant_id]['values'] = array_map(function ($value) use ($mappedVariant) {
                    list($key, $val) = explode("|", $value);
                    return array('id' => $key, 'value' => $val, 'selected' => (in_array($key, $mappedVariant) ? 1 : 0));
                }, explode(",", $variant->variantvalues));
                if (array_sum(array_column($variantsValueMap[$variant->variant_id]['values'], 'selected')) > 0) {
                    $variantsValueMap[$variant->variant_id]['checked'] = 1;
                    $variantAvailable[$variant->variant_id]= 1;
                }
            }
        }    
 
        $headercategories = getHeaderCategories();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        
        return view('product', ['product' => $products[0], 'variants' => $variants,'variantAvailable' => $variantAvailable, 'productsvariants' => $productsvariants, 'activePage' => '', 'headercategories' => $headercategories, 'productvariantprice' => $productvariantprice, 'relatedProducts' => $relatedProducts, 'categories' => $categories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'vendors' => $vendors, 'reviews' => $productreviews, 'productreviewcount' => $productreviewcount]);
    }

    public function product_live_view($id)
    {
        if (Session::get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please log in.");
        }
        $products = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
            ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_images', 'product_images.product_id', '=', 'products.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->join('product_images AS pi', 'product_variant_price.image_id', '=', 'pi.id')
            ->where('products.id', $id)
            ->selectRaw('products.*, GROUP_CONCAT(CONCAT(product_images.id, "|", product_images.image) ORDER BY product_images.id DESC) AS images, product_variant_price.id AS variantpriceid, product_variant_price.image_id, product_variant_price.net_price as netPrice,product_variant_price.product_mrp as product_mrp, product_variant_price.variant_value_id_1 AS variant1, product_variant_price.variant_value_id_2 AS variant2, product_variant_price.variant_value_id_3 AS variant3, product_variant_price.quantity AS qty,  pi.image AS defaultImage, pc1.name as categoryName, pc1.slug as category_slug, pc2.name as subCategoryName, vendors.store_name as vendorName, vendors.address as vendor_address, vendors.phone as vendor_phone, vendors.vendor_alias as vendorNickName, vendors.slug AS vendor_slug, vendors.shipping_pincode AS vendor_shipping_pincode')->get();

        $productvariantprice = array();
        $productsvariants = array();
        $productsvariantspricelist = ProductVerientPrice::where('product_id', $products[0]->id)
            ->select(DB::raw('variant_value_id_1, variant_value_id_2, variant_value_id_3, quantity, net_price'))->get();
        if ($productsvariantspricelist->count() > 0) {
            foreach ($productsvariantspricelist as $price) {
                if (!is_null($price->variant_value_id_1) && !in_array($price->variant_value_id_1, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_1);
                }
                if (!is_null($price->variant_value_id_2) && !in_array($price->variant_value_id_2, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_2);
                }
                if (!is_null($price->variant_value_id_3) && !in_array($price->variant_value_id_3, $productsvariants)) {
                    array_push($productsvariants, $price->variant_value_id_3);
                }
                if (!array_key_exists($price->variant_value_id_1, $productvariantprice)) {
                    $productvariantprice[$price->variant_value_id_1] = array();
                }
                if (!is_null($price->variant_value_id_1)) {
                    if (!is_null($price->variant_value_id_2)) {
                        if (!is_null($price->variant_value_id_3)) {
                            $variantpricearray[$price->variant_value_id_2][$price->variant_value_id_3] = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                        } else {
                            $variantpricearray[$price->variant_value_id_2] = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                        }
                    } else {
                        $variantpricearray = array('price' => $price->net_price, 'quantity' => (is_null($price->quantity) ? 0 : $price->quantity));
                    }
                    $productvariantprice[$price->variant_value_id_1] = $variantpricearray;
                }
            }
        }
        $relatedProducts = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->join('product_images', 'product_images.id', '=', 'product_variant_price.image_id')
            ->where('products.is_approved', true)->where('products.is_active', true)
            ->where('products.vendor_id', $products[0]->vendor_id)
            ->where('products.id', '<>', $id)
            ->selectRaw('products.*, product_images.image, product_variant_price.net_price as netPrice, product_variant_price.product_mrp as product_mrp,product_category.slug as categorySlug, product_category.name as categoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName, vendors.slug as vendor_slug')->orderBy(DB::raw('RAND()'))->limit(8)->get();

        $productreviews = array();
        $reviews = Review::join('customers', 'customers.id', '=', 'reviews.customerid')->join('review_image', 'review_image.reviewid', '=', 'reviews.id')->where('reviews.productid', $products[0]->id)->select('reviews.*', 'customers.name', DB::raw('GROUP_CONCAT(review_image.image) AS images'))->groupBy('reviews.id')->get();
        foreach ($reviews as $review) {
            array_push($productreviews, array('customer_name' => $review->name, 'time_difference' => '', 'description' => $review->review, 'images' => (!is_null($review->images) ? explode(",", $review->images) : array())));
        }

        $productreviewcount = array('total' => 0, 'avg' => 0.00, 'star5' => 0.00, 'star4' => 0.00, 'star3' => 0.00, 'star2' => 0.00, 'star1' => 0.00);
        $reviewcount = Review::select(DB::raw('count(*) AS total'), DB::raw('SUM(star) AS totalstar'), DB::raw('SUM(CASE WHEN star=5 THEN 1 ELSE 0 END) AS star5'), DB::raw('SUM(CASE WHEN star=4 THEN 1 ELSE 0 END) AS star4'), DB::raw('SUM(CASE WHEN star=3 THEN 1 ELSE 0 END) AS star3'), DB::raw('SUM(CASE WHEN star=2 THEN 1 ELSE 0 END) AS star2'), DB::raw('SUM(CASE WHEN star=1 THEN 1 ELSE 0 END) AS star1'))->where('productid', $products[0]->id)->first();
        $productreviewcount['total'] = $reviewcount->total;
        $productreviewcount['avg'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->totalstar / $reviewcount->total), 2);
        $productreviewcount['star5'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star5 * 100 / $reviewcount->total), 2);
        $productreviewcount['star4'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star4 * 100 / $reviewcount->total), 2);
        $productreviewcount['star3'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star3 * 100 / $reviewcount->total), 2);
        $productreviewcount['star2'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star2 * 100 / $reviewcount->total), 2);
        $productreviewcount['star1'] = $reviewcount->total == 0 ? 0 : round(($reviewcount->star1 * 100 / $reviewcount->total), 2);

        $variants  = ProductVerient::join('product_variant_values', 'product_variant_values.variant_id', '=', 'product_variants.id')
            ->where('product_variants.is_active', true)->select('product_variants.*', DB::raw('GROUP_CONCAT(CONCAT(product_variant_values.value,"|",product_variant_values.id) ORDER BY product_variant_values.weight DESC) AS variantvalues'))->groupBy('product_variants.id')->get();
        $headercategories = getHeaderCategories();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        return view('product', ['product' => $products[0], 'variants' => $variants, 'productsvariants' => $productsvariants, 'activePage' => '', 'headercategories' => $headercategories, 'productvariantprice' => $productvariantprice, 'relatedProducts' => $relatedProducts, 'categories' => $categories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'vendors' => $vendors, 'reviews' => $productreviews, 'productreviewcount' => $productreviewcount]);
    }

    public function vendor_view(Request $request, $slug)
    {
        $whereData = array(['products.is_active', true]);
        if (!empty($request->max_price) && $request->max_price > 0) {
            array_push($whereData, ['product_variant_price.net_price', '>=', $request->min_price]);
            array_push($whereData, ['product_variant_price.net_price', '<=', $request->max_price]);
            array_push($whereData, ['product_variant_price.discount_percentage', '>=', $request->min_discount]);
            array_push($whereData, ['product_variant_price.discount_percentage', '<=', $request->max_discount]);
        }

        $searchcategories = $request->searchcategories;
        $selectedvendor = Vendor::where('slug', $slug)->where('is_active', 1)->where('is_approved', 1)->first();
        if ($selectedvendor == null) {
            abort(404);
        }
        $column = 'products.created_at';
        switch ($request->sortby) {
            case 'relevance':
                $column = "products.id";
                break;
            case 'discount':
                $column = "product_variant_price.discount_percentage";
                break;
            case 'name':
                $column = "products.name";
                break;
            case 'rating':
                $column = "products.id";
                break;
            case 'created':
                $column = "products.created_at";
                break;
            case 'price':
                $column = "product_variant_price.net_price";
                break;
        }
        $sorting = $request->has('orderby') ? $request->orderby : 'desc';
        $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->leftjoin('product_images', 'product_images.id', '=', 'product_variant_price.image_id')
            ->where('products.is_approved', true)->where($whereData)
            ->where('products.vendor_id', $selectedvendor->id)
            ->when(!is_null($searchcategories) && !empty($searchcategories) && is_array($searchcategories), function ($query) use ($searchcategories) {
                $query->whereIn('products.category_id', $searchcategories);
            })
            ->selectRaw('products.*, product_images.image, product_category.slug as categoryslug, product_variant_price.net_price as net_price,product_variant_price.product_mrp as product_mrp, product_category.name as categoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName, vendors.slug as vendor_slug')->orderBy($column, $sorting)->groupBy('products.id')->get();
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        // $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        // $parentcategories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $categories = ProductCategory::with('product_category')->where('is_active', true)->orderBy('parent', 'ASC')->get();
        $cat_subcategories = [];
     
        foreach($categories as $parent){
            $parentcategory = [];
            $parentcategory['id'] = $parent->id;
            $parentcategory['name'] = $parent->name;
            $parentcategory['slug'] = $parent->slug;
            // $parentcategory['description'] = $parent->description;
            $parentcategory['image'] = $parent->image;
            $parentcategory['parent'] = $parent->parent;
            $parentcategory['is_active'] = $parent->is_active;
            $parentcategory['subcat'] = [];
            if($parent->parent == 0)
                $cat_subcategories[$parent->id] = $parentcategory;
            foreach($categories as $inner_parent){
                if($parent->id == $inner_parent->parent){
                    $childcategory = [];
                    $childcategory['id'] = $inner_parent->id;
                    $childcategory['name'] = $inner_parent->name;
                    $childcategory['slug'] = $inner_parent->slug;
                    array_push($cat_subcategories[$parent->id]['subcat'], $childcategory);
                }
            }
        }
        // echo "<pre>";
        // print_r($cat_subcategories);
        // die;

        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $popularstores = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'popular_stores')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        return view('brand', ['activePage' => '', 'products' => $products, 'headercategories' => $headercategories, 'vendors' => $vendors, 
            'header' => ($header == null ? array() : json_decode($header->description, true)), 
            'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 
            'categories' => $categories, 'cat_subcategories' => $cat_subcategories, 'selectedvendor' => $selectedvendor, 'popularstores' => $popularstores]);
    }

    public function addCustomerDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => array('required', 'regex:/^[\w\s]+$/i'),
            'email' => array('required', 'regex:/^[(a-z)(0-9).-_]+@[(a-z)(0-9)]+\.[(a-z).]{2,6}$/'),
            'phone' => array('required', 'regex:/^[6-9][0-9]{9}$/'),
            'addressline1' => array('required'),
            'city' => array('required', 'regex:/^[\w\s]+$/i'),
            'state' => array('required', 'regex:/^[\w\s]+$/i'),
            'pincode' => array('required', 'regex:/^[1-9][0-9]{5}$/')
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }

        try {
            $email = $request->email;
            $phone = $request->phone;
            $existingCustomer = Customer::where('id', '<>', Session::get('customer-loggedin-id'))
                ->when(!empty($email), function ($query) use ($email) {
                    $query->where('emailid', $email);
                })
                ->first();
            if (!is_null($existingCustomer)) {
                return response()->json(['status' => false, 'message' => "Emailid is already in use"]);
            }
            $existingCustomer = Customer::where('id', '<>', Session::get('customer-loggedin-id'))
                ->when(!empty($phone), function ($query) use ($phone) {
                    $query->where('phone', $phone);
                })
                ->first();
            if (!is_null($existingCustomer)) {
                return response()->json(['status' => false, 'message' => "Phone Number is already in use"]);
            }
            $customer = Customer::find(Session::get('customer-loggedin-id'));
            $customer->name = $request->firstname . ' ' . $request->lastname;
            $customer->emailid = $request->email;
            $customer->phone = $request->phone;
            $customer->save();

            $request->session()->put('customer-loggedin-name', $customer->name);
            $request->session()->put('customer-loggedin-email', $customer->emailid);
            $request->session()->put('customer-loggedin-phone', $customer->phone);
        } catch (QueryException $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()]);
        }

        try {
            $customerInfo = new CustomerAddress();
            $customerInfo->customer_id = $request->session()->get('customer-loggedin-id');
            $customerInfo->firstname = $request->firstname;
            $customerInfo->lastname = $request->lastname;
            $customerInfo->emailid = $request->email;
            $customerInfo->phonenumber = $request->phone;
            $customerInfo->address_line_1 = $request->addressline1;
            $customerInfo->address_line_2 = $request->addressline2;
            $customerInfo->address_line_3 = $request->addressline3;
            $customerInfo->city = $request->city;
            $customerInfo->state = $request->state;
            $customerInfo->pincode = $request->pincode;
            $customerInfo->country = $request->country;
            $customerInfo->is_default = true;
            // $customerInfo->companyname = $request->company;
            // $customerInfo->addition_information = $request->additionalinfo;
            $customerInfo->save();
            Mail::send('mailtemplate.verifyemail', array('verifyEmail' => Crypt::encryptString(Session::get("customer-loggedin-id"))), function ($message) use ($request) {
                $message->to(Session::get('customer-loggedin-email'))->subject('Verify your email.');
                $message->from('info@spicebucket.net', 'Spice Bucket');
            });
        } catch (QueryException $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()]);
        }

        return response()->json(['status' => true, 'message' => 'Profile Updated.']);
    }


    public function editCustomerDetial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => array('required', 'regex:/^\w+$/i'),
            'email' => array('required', 'regex:/^[(a-z)(0-9).-_]+@[(a-z)(0-9)]+\.[(a-z).]{2,6}$/'),
            'phone' => array('required', 'regex:/^[6-9][0-9]{9}$/')
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }
        try {
            $email = $request->email;
            $phone = $request->phone;
            $existingCustomer = Customer::where('id', '<>', Session::get('customer-loggedin-id'))
                ->when(!empty($email), function ($query) use ($email) {
                    $query->where('emailid', $email);
                })
                ->first();
            if (!is_null($existingCustomer)) {
                return response()->json(['status' => false, 'message' => "Emailid is already in use"]);
            }
            $existingCustomer = Customer::where('id', '<>', Session::get('customer-loggedin-id'))
                ->when(!empty($phone), function ($query) use ($phone) {
                    $query->where('phone', $phone);
                })
                ->first();
            if (!is_null($existingCustomer)) {
                return response()->json(['status' => false, 'message' => "Phone Number is already in use"]);
            }

            $customer = Customer::find(Session::get('customer-loggedin-id'));
            $customer->name = $request->firstname . ' ' . $request->lastname;
            $customer->emailid = $request->email;
            $customer->phone = $request->phone;
            $customer->save();

            $request->session()->put('customer-loggedin-name', $customer->name);
            $request->session()->put('customer-loggedin-email', $customer->emailid);
            $request->session()->put('customer-loggedin-phone', $customer->phone);
        } catch (QueryException $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'message' => 'Profile Updated.']);
    }

    public function editCustomerAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'addresstype' => array('required', 'regex:/^\w+$/i'),
            'firstname' => array('required', 'regex:/^\w[\w\s]+$/i'),
            'email' => array('required', 'regex:/^[(a-z)(0-9).-_]+@[(a-z)(0-9)]+\.[(a-z).]{2,6}$/'),
            'phone' => array('required', 'regex:/^[6-9][0-9]{9}$/'),
            'addressline1' => array('required'),
            'city' => array('required', 'regex:/^\w+$/i'),
            'state' => array('required', 'regex:/^\w+$/i'),
            'pincode' => array('required', 'regex:/^[1-9][0-9]{5}$/')
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }
        try {
            $customerInfo = new CustomerAddress();
            if (!empty($request->id)) {
                $customerInfo = CustomerAddress::find($request->id);
            }
            $customerInfo->customer_id = $request->session()->get('customer-loggedin-id');
            $customerInfo->address_type = $request->addresstype;
            $customerInfo->firstname = $request->firstname;
            $customerInfo->emailid = $request->email;
            $customerInfo->phonenumber = $request->phone;
            $customerInfo->address_line_1 = $request->addressline1;
            $customerInfo->address_line_2 = $request->addressline2;
            $customerInfo->address_line_3 = $request->addressline3;
            $customerInfo->city = $request->city;
            $customerInfo->state = $request->state;
            $customerInfo->pincode = $request->pincode;
            $customerInfo->country = $request->country;
            $customerInfo->companyname = $request->company;
            $customerInfo->addition_information = $request->additionalinfo;
            $customerInfo->save();
        } catch (QueryException $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()]);
        }

        return response()->json(['status' => true, 'message' => 'Address Updated.']);
    }

    public function getCustomerAddress(Request $request)
    {
        $address = CustomerAddress::find($request->id);
        if ($address->count() > 0) {
            return response()->json([
                'status' => true,
                'data' => array(
                    'addresstype' => $address->address_type,
                    'firstname' => $address->firstname,
                    'lastname' => $address->lastname,
                    'editphone' => $address->phonenumber,
                    'editemail' => $address->emailid,
                    'addressline1' => $address->address_line_1,
                    'addressline2' => $address->address_line_2,
                    'addressline3' => $address->address_line_3,
                    'editcity' => $address->city,
                    'editstate' => $address->state,
                    'editpincode' => $address->pincode,
                    'editcountry' => $address->country,
                    // 'company' => $address->companyname,
                    // 'additionalinfo' => $address->addition_information
                )
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No address found. Please add new."
            ], 200);
        }
    }

    public function deleteCustomerAddress(Request $request)
    {
        $address = ['is_active' => false];
        if ($request->id > 0) {
            $customerAddress = CustomerAddress::where('customer_id', Session::get('customer-loggedin-id'))->where('is_active', true)->get();
            if (count($customerAddress) > 1) {
                CustomerAddress::where('id', $request->id)->update($address);
            } else {
                return response()->json(['status' => false, 'message' => 'Can\'t Delete atleast one Address should be there.']);
            }
        }
        return response()->json(['status' => true, 'message' => 'Address Deleted Succesfully.']);
    }

    public function getCustomerAddresses()
    {
        $addresses = CustomerAddress::where('customer_id', Session::get('customer-loggedin-id'))->where('is_active', true)->get();
        $html = '';
        $data = array();
        foreach ($addresses as $address) {
            $data[$address['id']] = array('type' => $address->address_type, 'pincode' => $address['pincode'], 'format' => "<p class='mb-0'><small>" .  $address->firstname  . " " .  $address->lastname  . " <br />" .  $address->address_line_1  . " " .  $address->address_line_2  . " " .  $address->address_line_3  . " " .  $address->city  . ", " .  $address->state  . "-" .  $address->pincode  . ", " .  $address->country  . "</small></p>");
            $html .=  '<div class="col-lg-6 dashboard-address-item  is-address-default ">
                        <div class="card h-100 mb-3 mb-lg-0 mb-2">
                            <div class="card-header">
                                <h5 class="mb-0">' . $address['firstname'] . ' ' . $address['lastname'] . '
                                    <small class="badge bg-primary">' . strtoupper($address->address_type) . '</small>
                                </h5>';
            if ($address->is_default == 1) {
                $html .= '<small class="badge bg-success">DEFAULT</small>';
            } else {
                $html .= '<small style="cursor: pointer;" data-id="' . $address->id . '" class="badge bg-danger address-mark-as-default">MARK DEFAULT</small>';
            }
            $html .= '</div>
                            <div class="card-body">
                                <address>
                                    ' . $address['address_line_1'] . '<br />
                                    ' . $address['address_line_2'] . '<br />
                                    ' . $address['address_line_3'] . '
                                </address>
                                <p>City : ' . $address['city'] . '</p>
                                <p>State : ' . $address['state'] . '</p>
                                <p>Pin Code : ' . $address['pincode'] . '</p>
                                <p>Country : ' . $address['country'] . '</p>
                            </div>
                            <div class="card-footer border-top-0">
                                <div class="row">
                                    <div class="col-auto me-auto"><a href="javascript:void(0)" onclick="editAddress(' . $address['id'] . ')" class="edit-address-info">Edit</a></div>
                                    <div class="col-auto"><a href="javascript:void(0)"  onclick="removeAddress(' . $address['id'] . ')" class="text-danger btn-trigger-delete-address removeAddress">Remove</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
        }
        $html .= '<div class="col-12 m-2"><a href="javascript:void(0)" type="button" id="new-address" class="add-address"><i class="fa fa-plus"></i> <span>Add a new address</span></a></div>';
        return response()->json(['html' => $html, 'data' => $data]);
    }
    public function getOrderInvoice(Request $request){
         $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
            ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
            ->leftjoin('pincode_master', 'pincode_master.pincode', '=', 'vendors.shipping_pincode')
            ->leftjoin('orders_extra_charges', function ($joins) {
                $joins->on('orders_extra_charges.order_id', '=', 'orders.id');
                $joins->on('orders_extra_charges.vendor_id', '=', 'vendors.id');
            })
            ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
            ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
            ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
            ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
            ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
            ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
            ->where('orders.id', $request->id)->select('*', 'orders.orderid AS orderID','cba.firstname','cba.lastname','cba.phonenumber', DB::raw('CONCAT("<strong>", cba.firstname, " ", cba.lastname, "</strong><br />", cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), ",", cba.city,", ", cba.state, ", ", cba.country, ", ", cba.pincode) as billingAddress'), DB::raw('CONCAT("<strong>", csa.firstname, " ", csa.lastname, "</strong><br />", csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), ",", csa.city,", ", csa.state, ", ", csa.country, ", ", csa.pincode) as shippingAddress'), 'products.name AS productName', 'products.id AS productID', 'order_details.product_price AS preproductprice','products.slug AS productslug', 'order_details.product_qunatity AS productquantity', 'order_details.gst_on_product_price AS perproductgst', 'order_details.product_price AS productprice', 'orders.discount AS cartDiscount', 'orders.delivery_fee AS cartDeliveryCharge', 'orders.cod_charges AS codOnCart', 'orders.payment_amount AS paymentAmount', 'orders.gst_on_amount AS totalCartGst', 'orders.total_amount AS totalCartAmount', 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'orders_extra_charges.shipping_charges AS vendorDeliveryFee', 'orders_extra_charges.cod_charges AS vendorCodCharges', 'orders_extra_charges.discount AS vendorDiscount', 'vendors.id AS storeid','vendors.store_name AS storeName', 'vendors.address AS storeaddress', 'vendors.gst AS storeGST', 'pincode_master.statecode AS storeStateCode', 'pincode_master.gstcode', 'pincode_master.city AS storeCity', 'order_details.vendor_order_id AS invoiceNumber', 'order_details.order_status as vendorwiseorderstatus', DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();


               $vendorWiseDetail = array();
        $orderID = $orderDateTime = $paymentSource = '';
        $codOnCart = $cartDiscount = 0;
        $product_id=[];
        $addCustomerDetail =[];
        $vendors=[];
        
        foreach ($orderDetails as $orderDetail) {
                $CustomerDetail =array('firstname'=>$orderDetail->firstname,'lastname'=>$orderDetail->lastname,'email'=>$orderDetail->emailid ,'billingAddress'=>$orderDetail->address,'phonenumber'=>$orderDetail->phonenumber);
            
            $product_id[] = $orderDetail->productID;
            if (!array_key_exists($orderDetail->vendor_id, $vendorWiseDetail)) {
                $vendorWiseDetail[$orderDetail->vendor_id] = array('paymentSource' => $orderDetail->payment_source, 'discount' => $orderDetail->vendorDiscount, 'cod_charges' => $orderDetail->vendorCodCharges, 'shippingFee' => $orderDetail->vendorDeliveryFee, 'invoiceNumber' => $orderDetail->invoiceNumber, 'storeCity' => $orderDetail->storeCity, 'storeStateCode' => $orderDetail->storeStateCode, 'vendor_gst' => $orderDetail->storeGST, 'gstcode'=>$orderDetail['gstcode'],'vendor_alias' => $orderDetail->vendor_alias, 'store_name' => $orderDetail->storeName, 'store_address' => $orderDetail->storeaddress, 'orderID' => $orderDetail->orderID, 'orderDateTime' => $orderDetail->order_datetime,'vendorDiscount' => $orderDetail->vendorDiscount,  'customerbillinginfo' => $orderDetail->billingAddress, 'customershippinginfo' => $orderDetail->shippingAddress, 'vendorEmailid' => (!is_null($orderDetail->alternateemail_business_emailid) ? $orderDetail->alternateemail_business_emailid : $orderDetail->business_emailid), 'products' => array());
                $orderID = $orderDetail->orderID;
                $orderDateTime = $orderDetail->order_datetime;
                $cartDiscount = $orderDetail->cartDiscount;
                $codOnCart = $orderDetail->codOnCart;
                $paymentSource = $orderDetail->paymentSource;
            }
             $vendorname = (!is_null($orderDetail->vendor_alias) && !empty($orderDetail->vendor_alias)) ? $orderDetail->vendor_alias : $orderDetail->store_name;
            if (!array_key_exists($vendorname, $vendors)) {
                $vendors[$vendorname] = array('vendor_alias' => $orderDetail->vendor_alias, 'vendorID' => $orderDetail->storeid, 'vendorwiseorderstatus' => $orderDetail->vendorwiseorderstatus, 'storeslug' => $orderDetail->slug, 'invoice_number' => $orderDetail->invoice_number, 'child' => array()); 
            }
            array_push($vendors[$vendorname]['child'], array('productname' => $orderDetail->productName, 'variantname1' => $orderDetail->productvariantname1, 'variantvalue1' => $orderDetail->variantvalue1, 'variantname2' => $orderDetail->productvariantname2, 'variantvalue2' => $orderDetail->variantvalue2, 'variantname3' => $orderDetail->productvariantname3, 'variantvalue3' => $orderDetail->variantvalue3, 'image' => $orderDetail->productImage, 'subtotal' => $orderDetail->preproductprice, 'totalgst' => $orderDetail->gst_on_product_price, 'totalamount' => $orderDetail->total_product_price, 'perproductquantity' => $orderDetail->product_qunatity, 'productid' => $orderDetail->productID));

            array_push($vendorWiseDetail[$orderDetail->vendor_id]['products'], array('producdescription' => $orderDetail['description'], 'productname' => $orderDetail['productName'], 'productvariantname1' => $orderDetail['productvariantname1'], 'variantvalue1' => $orderDetail['variantvalue1'], 'productvariantname2' => $orderDetail['productvariantname2'], 'variantvalue2' => $orderDetail['variantvalue2'], 'productvariantname3' => $orderDetail['productvariantname3'], 'variantvalue3' => $orderDetail['variantvalue3'], 'productImage' => $orderDetail['productImage'], 'productslug' => $orderDetail['productslug'], 'productprice' => $orderDetail['productprice'], 'productqty' => $orderDetail['productquantity'], 'shippingCharge' => $orderDetail['vendorDeliveryFee'], 'perproductgst' => $orderDetail['perproductgst'], 'sku' => $orderDetail['sku'], 'shippingFee' => $orderDetail['delivery_fee'], 'gst_rate' => $orderDetail['gst_rate'], 'store_name' => $orderDetail['store_name']));
        }

         $productReview = Review::whereIn('productid', $product_id)->where('customerid', Session::get('customer-loggedin-id'))->get();

          
	 
        return view('invoice', ['vendors' => $vendors, 'vendorWiseDetail'=>$vendorWiseDetail,'CustomerDetail'=>$CustomerDetail,'orderdetails' => $orderDetails, 'orderID' => $orderID, 'orderDateTime' => $orderDateTime, 'discountAmount' => $cartDiscount, 'cod_charges' => $codOnCart, 'paymentSource' => $paymentSource,'productReview'=>$productReview]);


    } 
    public function getOrderInvoice_old(Request $request)
    {


        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
            ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
            ->leftjoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
            ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
            ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
            ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
            ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
            ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
            ->where('orders.id', $request->id)->select('*', 'products.name AS productname', 'products.id AS productID', 'order_details.product_price AS preproductprice', 'vendors.id AS storeid', 'customers.name AS customername', DB::raw('CONCAT(cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), cba.city, 
            ", ", cba.state, ", ", cba.country, ", ", cba.pincode) as billingAddress'), DB::raw('CONCAT(csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), csa.city,", ",  csa.state,", ",  csa.country,", ",  csa.pincode) as shippingAddress'), 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'order_details.order_status as vendorwiseorderstatus', 'orders.id AS idoforder',  DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();

        $vendors = array();
         $product_id=[];
        foreach ($orderDetails as $details) {
            $product_id[] = $details->productID;
            $vendorname = (!is_null($details->vendor_alias) && !empty($details->vendor_alias)) ? $details->vendor_alias : $details->store_name;
            if (!array_key_exists($vendorname, $vendors)) {
                $vendors[$vendorname] = array('vendor_alias' => $details->vendor_alias, 'vendorID' => $details->storeid, 'vendorwiseorderstatus' => $details->vendorwiseorderstatus, 'storeslug' => $details->slug, 'invoice_number' => $details->invoice_number, 'child' => array()); 
            }
            array_push($vendors[$vendorname]['child'], array('productname' => $details->productname, 'variantname1' => $details->productvariantname1, 'variantvalue1' => $details->variantvalue1, 'variantname2' => $details->productvariantname2, 'variantvalue2' => $details->variantvalue2, 'variantname3' => $details->productvariantname3, 'variantvalue3' => $details->variantvalue3, 'image' => $details->productImage, 'subtotal' => $details->preproductprice, 'totalgst' => $details->gst_on_product_price, 'totalamount' => $details->total_product_price, 'perproductquantity' => $details->product_qunatity, 'productid' => $details->productID));
        }

        $productReview = Review::whereIn('productid', $product_id)->where('customerid', Session::get('customer-loggedin-id'))->get();

        return view('invoice', ['activePage' => '', 'orderdetails' => $orderDetails, 'vendors' => $vendors,'productReview'=>$productReview]);
    }

    public function getOrderInvoicePdf(Request $request)
    {
         
        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
            ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
            ->leftjoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
            ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
            ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
            ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
            ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
            ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
            ->where('orders.id', $request->id)->select('*', 'products.name AS productname', 'order_details.product_price AS preproductprice', 'vendors.id AS storeid', 'customers.name AS customername', DB::raw('CONCAT(cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), cba.city, 
            ", ", cba.state, ", ", cba.country, ", ", cba.pincode) as billingAddress'), DB::raw('CONCAT(csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), csa.city,", ",  csa.state,", ",  csa.country,", ",  csa.pincode) as shippingAddress'), 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'orders.id AS idoforder',  DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();

        $vendors = array();

        foreach ($orderDetails as $details) {
            $vendorname = (!is_null($details->vendor_alias) && !empty($details->vendor_alias)) ? $details->vendor_alias : $details->store_name;
            if (!array_key_exists($details[$vendorname], $vendors)) {
                $vendors[$vendorname] = array('vendor_alias' => $details->vendor_alias, 'storeslug' => $details->slug, 'child' => array());
            }
            array_push($vendors[$vendorname]['child'], array('productname' => $details->productname, 'variantname1' => $details->productvariantname1, 'variantvalue1' => $details->variantvalue1, 'variantname2' => $details->productvariantname2, 'variantvalue2' => $details->variantvalue2, 'variantname3' => $details->productvariantname3, 'variantvalue3' => $details->variantvalue3, 'image' => $details->productImage, 'subtotal' => $details->preproductprice, 'totalgst' => $details->gst_on_product_price, 'totalamount' => $details->total_product_price, 'perproductquantity' => $details->product_qunatity));
        }
        // dd($vendors);


        return view('invoicepdf', ['activePage' => '', 'orderdetails' => $orderDetails, 'vendors' => $vendors]);
    }

    public function sellerToCustomerInvoice(Request $request)
    {

        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
            ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
            ->leftjoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
            ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
            ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
            ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
            ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
            ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
            ->where('orders.id', $request->id)->select('*', 'products.name AS productname', 'order_details.product_price AS preproductprice', 'vendors.id AS storeid', 'customers.name AS customername', DB::raw('CONCAT(cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), cba.city, 
            ", ", cba.state, ", ", cba.country, ", ", cba.pincode) as billingAddress'), DB::raw('CONCAT(csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), csa.city,", ",  csa.state,", ",  csa.country,", ",  csa.pincode) as shippingAddress'), 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'orders.id AS idoforder',  DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();

        $vendors = array();

        foreach ($orderDetails as $details) {
            $vendorname = (!is_null($details->vendor_alias) && !empty($details->vendor_alias)) ? $details->vendor_alias : $details->store_name;
            if (!array_key_exists($details[$vendorname], $vendors)) {
                $vendors[$vendorname] = array('vendor_alias' => $details->vendor_alias, 'storeslug' => $details->slug, 'child' => array());
            }
            array_push($vendors[$vendorname]['child'], array('productname' => $details->productname, 'variantname1' => $details->productvariantname1, 'variantvalue1' => $details->variantvalue1, 'variantname2' => $details->productvariantname2, 'variantvalue2' => $details->variantvalue2, 'variantname3' => $details->productvariantname3, 'variantvalue3' => $details->variantvalue3, 'image' => $details->productImage, 'subtotal' => $details->preproductprice, 'totalgst' => $details->gst_on_product_price, 'totalamount' => $details->total_product_price, 'perproductquantity' => $details->product_qunatity));
        }
        return view('selleretocustomerpdf', ['activePage' => '', 'orderdetails' => $orderDetails, 'vendors' => $vendors]);
    }
    public function api_search_suggestion(Request $request){
        
          $whereData = [['products.is_active', true]];
        $products =[];
        $filterCategory=[];  
        if (!empty($request->searchquery)) {
            $searchQuery = $request->searchquery;
            

            //search in category 
            $categories = ProductCategory::where('is_active',1)->Where('product_category.name', 'like', '%' . $searchQuery . '%')->get();
            
            if(!empty($categories)){
                $categories= $categories->toArray();
                foreach ($categories as $key => $cat) {
                   $image_path= !empty($cat['image'])?
                    url(env('APP_URL') . ('/public/images/products/') .$cat['image']):'';
                    $cat['image'] =$image_path;
                    $filterCategory[] =$cat;   
                }
            }
             

            $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                ->where('products.is_approved', true)
                ->where(function($query) use ($searchQuery) {
                    $query->where('products.name', 'like', '%' . $searchQuery . '%')
                          ->orWhere('product_category.name', 'like', '%' . $searchQuery . '%');
                })
                ->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, product_category.slug as slug, product_category.name as categoryName,product_category.image as categoryImage, vendors.store_name as vendorName')
                ->get();

                
        }
                
         
        $productData = [];
        
        foreach ($products as $product) {
            $productId = $product->id;
            
            $productVariants = ProductVerientPrice::join('product_variant_values AS pv1', 'product_variant_price.variant_value_id_1', '=', 'pv1.id')
                ->join('product_variant_values AS pv2', 'product_variant_price.variant_value_id_2', '=', 'pv2.id')
                ->where('product_variant_price.product_id', $productId)
                ->selectRaw('product_variant_price.*, pv1.value AS size, pv2.value AS packing')
                ->get();
            
            $productVariantsData = [];
            foreach ($productVariants as $variant) {
                $productVariantsData[] = [
                    'id' => $variant['id'],
                    'product_id' => $variant['product_id'],
                    'variant_value_id_1' => $variant['size'],
                    'variant_value_id_2' => $variant['packing'],
                    'variant_value_id_3' => $variant['variant_value_id_3'],
                    'product_mrp' => $variant['product_mrp'],
                    'discount_price' => $variant['discount_price'],
                    'discount_percentage' => $variant['discount_percentage'],
                    'net_price' => $variant['net_price'],
                    'b2b_price' => $variant['b2b_price'],
                    'sku' => $variant['sku'],
                    'barcode' => $variant['barcode'],
                    'net_weight' => $variant['net_weight'],
                    'quantity' => $variant['quantity'],
                    'mark_as_default' => $variant['mark_as_default'],
                    'image_id' => $variant['image_id'],
                    'created_by' => $variant['created_by'],
                    'updated_by' => $variant['updated_by'],
                    'created_at' => $variant['created_at'],
                    'updated_at' => $variant['updated_at'], 
                                                    
                ];
            }
            
            // $images = ProductImage::where('product_id', $productId)->get();
            
            $productArray = $product->toArray();
            // $productArray['product_images'] = $images->toArray();
            $productArray['product_variant'] = $productVariantsData;
            
            $productData[] = $productArray;
        }
        
        return response()->json([
            'status' => true,
            'Categories' => $filterCategory,
            'products' => $productData
        ]);
    }
    public function api_product_search(Request $request)
    {
       
        $whereData = [['products.is_active', true]];

        if (!empty($request->searchquery)) {
            $searchQuery = $request->searchquery;
    
            $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                ->where('products.is_approved', true)
                ->where(function($query) use ($searchQuery) {
                    $query->where('products.name', 'like', '%' . $searchQuery . '%')
                          ->orWhere('product_category.name', 'like', '%' . $searchQuery . '%');
                })
                ->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, product_category.slug as slug, product_category.name as categoryName, vendors.store_name as vendorName')
                ->get();

                if(!empty(count($products))){
                 $search =[];
                 $searchConditions=[]; 
                 $search['search_data'] =$searchQuery;                  
                 $Conditionlink['search_data'] =$searchQuery;                
                 $link['created_at'] =Carbon::now();
                 $link['updated_at'] =Carbon::now();
                 
                 SearchHistory::updateOrCreate($Conditionlink,$link);
                }
        }
        else {
            $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                ->where('products.is_approved', true)
                ->where($whereData)
                ->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, product_category.slug as slug, product_category.name as categoryName, vendors.store_name as vendorName')
                ->get();
        }       
         
        $productData = [];
        
        foreach ($products as $product) {
            $productId = $product->id;
            
            $productVariants = ProductVerientPrice::join('product_variant_values AS pv1', 'product_variant_price.variant_value_id_1', '=', 'pv1.id')
                ->join('product_variant_values AS pv2', 'product_variant_price.variant_value_id_2', '=', 'pv2.id')
                ->where('product_variant_price.product_id', $productId)
                ->selectRaw('product_variant_price.*, pv1.value AS size, pv2.value AS packing')
                ->get();
            
            $productVariantsData = [];
            foreach ($productVariants as $variant) {
                $productVariantsData[] = [
                    'id' => $variant['id'],
                    'product_id' => $variant['product_id'],
                    'variant_value_id_1' => $variant['size'],
                    'variant_value_id_2' => $variant['packing'],
                    'variant_value_id_3' => $variant['variant_value_id_3'],
                    'product_mrp' => $variant['product_mrp'],
                    'discount_price' => $variant['discount_price'],
                    'discount_percentage' => $variant['discount_percentage'],
                    'net_price' => $variant['net_price'],
                    'b2b_price' => $variant['b2b_price'],
                    'sku' => $variant['sku'],
                    'barcode' => $variant['barcode'],
                    'net_weight' => $variant['net_weight'],
                    'quantity' => $variant['quantity'],
                    'mark_as_default' => $variant['mark_as_default'],
                    'image_id' => $variant['image_id'],
                    'created_by' => $variant['created_by'],
                    'updated_by' => $variant['updated_by'],
                    'created_at' => $variant['created_at'],
                    'updated_at' => $variant['updated_at'], 
                                                    
                ];
            }
            
            // $images = ProductImage::where('product_id', $productId)->get();
            
            $productArray = $product->toArray();
            // $productArray['product_images'] = $images->toArray();
            $productArray['product_variant'] = $productVariantsData;
            
            $productData[] = $productArray;
        }
        
        return response()->json([
            'status' => true,
            'products' => $productData
        ]);
    }
    public function verifyEmail(Request $request, $encryptId)
    {
        $decryptid = Crypt::decryptString($encryptId);
        $customer = Customer::find($decryptid);
        if (is_null($customer)) {
            return redirect('/')->with('message', 'Customer Does\'nt exists.');
        } else {
            Session::put('customer-logged-in', true);
            Session::put('customer-loggedin-id', $decryptid);
            Session::put('customer-loggedin-name', $customer->name);
            Session::put('customer-loggedin-email', $customer->email);
            Session::put('customer-loggedin-phone', $customer->phone);
            Customer::where('id', $decryptid)->update(['verified' => true]);
            $mailContent = MailModel::GetMailDetail(11);
            if(!empty($mailContent)){

                $mailbody = $mailContent['message'];          
                 // replace otp here 
                $content =  str_replace("{{CUSTOMERNAME}}",@Session::get("customer-loggedin-name"),$mailbody);  
                Mail::send('mailtemplate.mailbody', array('content' => $content), function ($message) use ($request,$mailContent) {
                        $message->to($request->emailphone)->subject($mailContent['subject']);
                        $message->from($mailContent['from_email'], $mailContent['from_name']);
                });      
            }else{
                die('Please contact to us');
            }
            // Mail::send('mailtemplate.welcome', array('customerName' => Session::get("customer-loggedin-name")), function ($message) use ($request) {
            //     $message->to(Session::get('customer-loggedin-email'))->subject('Welcome to Spice Bucket family');
            //     $message->from('info@spicebucket.net', 'Spice Bucket');
            // });
            return redirect('/')->with('message', 'Customer Verified.');
        }
    }

    public function api_banner_list()
    {
        return response()->json([
            'status' => true,
            'images' => [
                env('APP_URL') . '/assets/imgs/slider/mobile-banner1.png',
                env('APP_URL') . '/assets/imgs/slider/mobile-banner2.png',
                env('APP_URL') . '/assets/imgs/slider/mobile-banner3.png',
                env('APP_URL') . '/assets/imgs/slider/mobile-banner4.png'
            ]
        ], 200);
    }

    public function api_top_selling_product()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'top_selling_brands')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_most_popular_product()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category', 'most_popular_brands')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_latest_offer()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category', 'latest_offers')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_highly_discounted_offer()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'highly_discounted_offers')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_recommended_for_you()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'recommended_for_you')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_besellers()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'bestsellers')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_new_at_spicebucket()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'new_at_spice_bucket')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_daily_essential_needs()
    {
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'daily_essential_needs')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        return response()->json([
            'status' => true,
            'offers' => $availableOffer
        ], 200);
    }

 
     public function api_home_page_details($customerid=null)
    {
        $homepageBanners = array();
        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'top_selling_brands')->limit(4)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['top_selling_brands'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category', 'most_popular_brands')->limit(6)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
         $homepageBanners['most_popular_brands'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category', 'latest_offers')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        } 
        $homepageBanners['latest_offers'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'highly_discounted_offers')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['highly_discounted_offers'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'recommended_for_you')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['recommended_for_you'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'bestsellers')->limit(4)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['bestsellers'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'new_at_spice_bucket')->limit(4)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['new_at_spice_bucket'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'daily_essential_needs')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['daily_essential_needs'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'flash_sale')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['flash_sale'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'spice_bucket_offers')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $homepageBanners['spice_bucket_offers'] = $availableOffer;

        $offers = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'featured_offers')->limit(8)->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug", "vendors.store_name AS vendor_name", "product_category.name AS category_name")->get();
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'category_name' => $offer->category_name,
                'vendor_name' => $offer->vendor_name,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $totalcartQuantity = Cart::where('customerid', $customerid)->sum('quantity');
        $totalwishlistQuantity = Wishlist::where('customer_id', $customerid)->count('product_id');
        $homepageBanners['featured_offers'] = $availableOffer;
        $totalOffers = array_sum(array_map('count', $homepageBanners));   
       
        $url = 'mobile-app-home';
        $page = StaticPage::where('url', $url)->first();
        $data =[];
        if ($page) {
            $data = json_decode($page->description, true);
		}
        // converting data for bannner 
        $filters_data=[];
        if(!empty($data)){
            foreach($data as $key=>$value){
                $innerdata=[];
                if($key=='banner'){
                    foreach($value as $image){
                        $innerdata[]=array('image'=>$image);
                    }
                }elseif($key=='banner_after_latest_offer'){
                     foreach($value as $image){

                        $innerdata[]=$image;
                    }
                     
                }
                else{
                     foreach($value as $innervalue){
                        if($innervalue['vendorid']>0){
                            $innerdata[]=$innervalue;
                        } 
                    }
                     
                }

               $filters_data[$key]=$innerdata;
            }

        }
         //dd($filters_data);
        return response()->json([
            'status' => true,
            'totaCartItems'  => $totalcartQuantity,
            'wishlistCount' => $totalwishlistQuantity,
            'total_notification' =>  $totalOffers,
            'offers' => $homepageBanners,
            'mobile_images' =>$filters_data,
            'images_base_path'=>"https://spicebucket.com/assets/imgs/slider/"
        ], 200);
    }

    public function downloadInvoice($filename)
    {
        $fileDirectory = public_path('invoices');
        $filePath = $fileDirectory . '/' . $filename;

        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            return response()->download($filePath, $filename, $headers);
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function updateDefaultAddress(Request $request)
    {
        $id = $request->id;
        CustomerAddress::where('customer_id', Session::get('customer-loggedin-id'))->update(['is_default' => false]);
        $customerAddress = CustomerAddress::find($id);
        $customerAddress->is_default = true;
        $customerAddress->save();
    }
	
	public function getCityStatePincode(Request $request)
	{
		$pincode = $request->pincode;
		$result = DB::table('pincode_master')->where('pincode', $pincode)->select('city', 'state')->first();
		if($result == null){
			return response()->json([
				'status' => false,
				'message' => 'Pincode is not valid'
			], 200);
		} else {
			return response()->json([
				'status' => true,
				'city' => $result->city,
				'state' => $result->state,
				'message' => "Pincode is valid"
			], 200);
		}
	}
}
