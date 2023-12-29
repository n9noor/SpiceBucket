<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\StaticPage;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use PhpParser\Node\Stmt\StaticVar;
use Illuminate\Support\Facades\Session;

class StaticPageController extends Controller
{
    function index()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-view'] == 0){
            return view('wms.accessdenied');
		}
        $pages = StaticPage::whereNotIn('url', ['header', 'footer', 'contact-us'])->orderBy('url')->get();
        return view('staticpage.index', ['title' => 'Pages - SpiceBucket Administration', 'pages' => $pages]);
    }

    function add_staticpage()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-add'] == 0){
            return view('wms.accessdenied');
		}
        return view('staticpage.add', ['title' => 'Add Page - SpiceBucket Administration']);
    }

    function save_staticpage(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-add'] == 0){
            return view('wms.accessdenied');
		}
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:static_pages,url',
            'description' => 'required'
        ]);
        $data = new StaticPage();
        $data->title = $request->title;
        $data->url = $request->slug;
        $data->description = $request->description;
        $data->seo_title = $request->seo_title;
        $data->seo_keywords = $request->seo_keywords;
        $data->seo_description = $request->seo_description;
        $data->head_part = $request->header_part;
        $data->foot_part = $request->footer_part;
        $data->is_active = true;
        $data->save();

        return redirect('/administrator/static-page')->with('success', 'Page added successfully');
    }

    function edit_staticpage($id)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $page = StaticPage::findorFail($id);
        return view('staticpage.edit', ['title' => 'Edit Page - SpiceBucket Administration', 'page' => $page]);
    }

    function update_staticpage(Request $request, $id)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $data = StaticPage::findorFail($id);
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:static_pages,url,' . $id,
            'description' => 'required'
        ]);
        $data->title = $request->title;
        $data->url = $request->slug;
        $data->description = $request->description;
        $data->seo_title = $request->seo_title;
        $data->seo_keywords = $request->seo_keywords;
        $data->seo_description = $request->seo_description;
        $data->head_part = $request->header_part;
        $data->foot_part = $request->footer_part;
        $data->is_active = true;
        $data->save();

        return redirect('/administrator/static-page')->with('success', 'Page updated successfully');
    }

    function getPage($slug)
    {
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $headercategories = getHeaderCategories();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $page = StaticPage::where('url', $slug)->where('is_active', true)->first();
        if ($page == null) {
            abort(404);
        }
        if ($slug == 'about-us') {
            $activePage = 'about';
        } else {
            $activePage = 'home';
        }
        return view('staticpage', ['activePage' => $activePage, 'page' => $page, 'headercategories' => $headercategories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'categories' => $categories, 'vendors' => $vendors]);
    }

    function staticHeader()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $header = StaticPage::where('url', 'header')->first();
        return view('staticpage.header', ['title' => 'Edit Page - SpiceBucket Administration', 'page' => 'Header', 'header' => ($header == null ? array() : json_decode($header->description, true))]);
    }
    function saveStaticHeader(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $headerData = $request->header;
        $data = StaticPage::where('url', 'header')->first();
        $description = array();
        if ($data == null) {
            $data = new StaticPage();
        } else {
            $description = json_decode($data->description, true);
        }
        $data->title = "Header";
        $data->url = "header";

        $headerData['logoimage'] = (array_key_exists('logoimage', $description) && strlen($description['logoimage']) > 0 ? $description['logoimage'] : '');
        if ($request->hasfile('header.logoimage')) {
            $imageName = 'static-header-logo-image-' . time() .  '.' .  $request->header['logoimage']->extension();
            $request->header['logoimage']->move(public_path('images/staticImages'), $imageName);
            $headerData['logoimage'] = $imageName;
        }
        $data->description = json_encode($headerData);
        $data->save();

        return redirect('/administrator/edit-static-pages/header');
    }
    function staticFooter()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $footerData = StaticPage::where('url', 'footer')->first();
        return view('staticpage.footer', ['title' => 'Edit Page - SpiceBucket Administration', 'page' => 'Footer', 'footerData' => ($footerData == null ? array() : json_decode($footerData->description, true))]);
    }
    function saveStaticFooter(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $footerData = $request->footer;
        $data = StaticPage::where('url', 'footer')->first();
        $description = array();
        if ($data == null) {
            $data = new StaticPage();
        } else {
            $description = json_decode($data->description, true);
        }
        $data->title = "Footer";
        $data->url = "footer";

        $footerData['subscribeimage'] = (array_key_exists('subscribeimage', $description) && strlen($description['subscribeimage']) > 0 ?  $description['subscribeimage'] : '');
        if ($request->hasfile('footer.subscribeimage')) {
            $imageName = 'static-subscribe-image-' . time() .  '.' .  $request->footer['subscribeimage']->extension();
            $request->footer['subscribeimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['subscribeimage'] = $imageName;
        }
        $footerData['logoimage'] = (array_key_exists('logoimage', $description) && strlen($description['logoimage']) > 0 ?  $description['logoimage'] : '');
        if ($request->hasfile('footer.logoimage')) {
            $imageName = 'static-logo-image-' . time() .  '.' .  $request->footer['logoimage']->extension();
            $request->footer['logoimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['logoimage'] = $imageName;
        }
        $footerData['googlereviewimage'] = (array_key_exists('googlereviewimage', $description) && strlen($description['googlereviewimage']) > 0 ?  $description['googlereviewimage'] : '');
        if ($request->hasfile('footer.googlereviewimage')) {
            $imageName = 'static-googlereview-image-' . time() .  '.' .  $request->footer['googlereviewimage']->extension();
            $request->footer['googlereviewimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['googlereviewimage'] = $imageName;
        }
        $footerData['fbimage'] = (array_key_exists('fbimage', $description) && strlen($description['fbimage']) > 0 ?  $description['fbimage'] : '');
        if ($request->hasfile('footer.fbimage')) {
            $imageName = 'static-fb-image-' . time() .  '.' .  $request->footer['fbimage']->extension();
            $request->footer['fbimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['fbimage'] = $imageName;
        }
        $footerData['twitterimage'] = (array_key_exists('twitterimage', $description) && strlen($description['twitterimage']) > 0 ?  $description['twitterimage'] : '');
        if ($request->hasfile('footer.twitterimage')) {
            $imageName = 'static-twitter-image-' . time() .  '.' .  $request->footer['twitterimage']->extension();
            $request->footer['twitterimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['twitterimage'] = $imageName;
        }
        $footerData['linkedinimage'] = (array_key_exists('linkedinimage', $description) && strlen($description['linkedinimage']) > 0 ?  $description['linkedinimage'] : '');
        if ($request->hasfile('footer.linkedinimage')) {
            $imageName = 'static-linkedin-image-' . time() .  '.' .  $request->footer['linkedinimage']->extension();
            $request->footer['linkedinimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['linkedinimage'] = $imageName;
        }
        $footerData['pintrestimage'] = (array_key_exists('pintrestimage', $description) && strlen($description['pintrestimage']) > 0 ?  $description['pintrestimage'] : '');
        if ($request->hasfile('footer.pintrestimage')) {
            $imageName = 'static-pintrest-image-' . time() .  '.' .  $request->footer['pintrestimage']->extension();
            $request->footer['pintrestimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['pintrestimage'] = $imageName;
        }
        $footerData['instagramimage'] = (array_key_exists('instagramimage', $description) && strlen($description['instagramimage']) > 0 ?  $description['instagramimage'] : '');
        if ($request->hasfile('footer.instagramimage')) {
            $imageName = 'static-instagram-image-' . time() .  '.' .  $request->footer['instagramimage']->extension();
            $request->footer['instagramimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['instagramimage'] = $imageName;
        }
        $footerData['youtubeimage'] = (array_key_exists('youtubeimage', $description) && strlen($description['youtubeimage']) > 0 ?  $description['youtubeimage'] : '');
        if ($request->hasfile('footer.youtubeimage')) {
            $imageName = 'static-youtube-image-' . time() .  '.' .  $request->footer['youtubeimage']->extension();
            $request->footer['youtubeimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['youtubeimage'] = $imageName;
        }
        $footerData['playstoreimage'] = (array_key_exists('playstoreimage', $description) && strlen($description['playstoreimage']) > 0 ?  $description['playstoreimage'] : '');
        if ($request->hasfile('footer.playstoreimage')) {
            $imageName = 'static-playstore-image-' . time() .  '.' .  $request->footer['playstoreimage']->extension();
            $request->footer['playstoreimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['playstoreimage'] = $imageName;
        }
        $footerData['appstoreimage'] = (array_key_exists('appstoreimage', $description) && strlen($description['appstoreimage']) > 0 ?  $description['appstoreimage'] : '');
        if ($request->hasfile('footer.appstoreimage')) {
            $imageName = 'static-appstore-image-' . time() .  '.' .  $request->footer['appstoreimage']->extension();
            $request->footer['appstoreimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['appstoreimage'] = $imageName;
        }
        $footerData['securepaymentimage'] = (array_key_exists('securepaymentimage', $description) && strlen($description['securepaymentimage']) > 0 ?  $description['securepaymentimage'] : '');
        if ($request->hasfile('footer.securepaymentimage')) {
            $imageName = 'static-securepayment-image-' . time() .  '.' .  $request->footer['securepaymentimage']->extension();
            $request->footer['securepaymentimage']->move(public_path('images/staticImages'), $imageName);
            $footerData['securepaymentimage'] = $imageName;
        }


        $data->description = json_encode($footerData);
        $data->save();

        return redirect('/administrator/edit-static-pages/footer');
    }
    function staticHome()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $home = StaticPage::where('url', 'home')->first();
        return view('staticpage.home', ['title' => 'Edit Page - SpiceBucket Administration', 'page' => 'Home', 'home' => ($home == null ? array() : json_decode($home->description, true))]);
    }

    function saveStaticHomeBanner(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $homeData = $request->home;
        $data = StaticPage::where('url', 'home')->first();
        $description = array();
        if ($data == null) {
            $data = new StaticPage();
        } else {
            $description = json_decode($data->description, true);
        }
        $data->title = "Home";
        $data->url = "home";
        $homeData['banner'] = (array_key_exists('banner', $description) && count($description['banner']) > 0 ?  $description['banner'] : array());
        if ($request->hasfile('home.banner')) {
            $counter = 1;
            foreach ($request->home['banner'] as $counter => $image) {
                $imageName = 'static-home-banner-image-' . $counter . '-' . time() .  '.' . $image->extension();
                $image->move(public_path('images/staticImages'), $imageName);
                $homeData['banner'][$counter] = $imageName;
                $counter++;
            }
        }
        $homeData['mobilebanner'] = (array_key_exists('mobilebanner', $description) && count($description['mobilebanner']) > 0 ?  $description['mobilebanner'] : array());
        if ($request->hasfile('home.mobilebanner')) {
            $counter = 1;
            foreach ($request->home['mobilebanner'] as $counter => $image) {
                $imageName = 'static-home-mobile-banner-image-' . $counter . '-' . time() .  '.' . $image->extension();
                $image->move(public_path('images/staticImages'), $imageName);
                $homeData['mobilebanner'][$counter] = $imageName;
                $counter++;
            }
        }
        $data->description = json_encode($homeData);
        $data->save();

        return redirect('/administrator/edit-static-pages/home');
    }

    function deleteStaticHomeBanner(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $data = StaticPage::where('url', 'home')->first();
        $description = array();
        if ($data == null) {
            return ;
        }
        $description = json_decode($data->description, true);
        if(!empty($request->bannerimage) && array_key_exists('banner', $description)){
            sort($description['banner']);
            $index = array_search($request->bannerimage, $description['banner']);
            if($index > -1){
                unset($description['banner'][$index]);
                if(File::exists(public_path('/public/images/staticImages/' . $request->bannerimage))){
                    File::delete(public_path('/public/images/staticImages/' . $request->bannerimage));
                }
            }
        }
        if(!empty($request->mobilebannerimage) && array_key_exists('mobilebanner', $description)){
            sort($description['mobilebanner']);
            $index = array_search($request->bannerimage, $description['mobilebanner']);
            if($index > -1){
                unset($description['mobilebanner'][$index]);
                if(File::exists(public_path('/public/images/staticImages/' . $request->mobilebannerimage))){
                    File::delete(public_path('/public/images/staticImages/' . $request->mobilebannerimage));
                }
            }
        }
        $data->description = json_encode($description);
        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'Row delete successfully'
        ]);
    }
    /*function staticAboutUs()
    {
        $homeData = StaticPage::where('url', 'about-us')->first();
        return view('staticpage.aboutus', ['title' => 'Edit Page - SpiceBucket Administration', 'page' => 'About Us', 'about' => ($homeData == null ? array() : json_decode($homeData->description, true))]);
    }*/
    /*function saveStaticAboutUs(Request $request)
    {
        $homeData = $request->about;
        $data = StaticPage::where('url', 'about-us')->first();
        $description = array();
        if ($data == null) {
            $data = new StaticPage();
        } else {
            $description = json_decode($data->description, true);
        }
        $data->title = "About Us";
        $data->url = "about-us";
        $homeData['sideimage'] = (array_key_exists('sideimage', $description) && strlen($description['sideimage']) > 0 ?  $description['sideimage'] : '');
        if ($request->hasfile('about.sideimage')) {
            $imageName = 'static-side-image-' . time() .  '.' . $request->about['sideimage']->extension();
            $request->about['sideimage']->move(public_path('images/staticImages'), $imageName);
            $homeData['sideimage'] = $imageName;
        }
        $homeData['boximage'] = (array_key_exists('boximage', $description) && count($description['boximage']) > 0 ?  $description['boximage'] : array());
        if ($request->hasfile('about.boximage')) {
            $counter = 1;
            foreach ($request->about['boximage'] as $counter => $image) {
                $imageName = 'static-box-image-' . $counter . '-' . time() .  '.' . $image->extension();
                $image->move(public_path('images/staticImages'), $imageName);
                $homeData['boximage'][$counter] = $imageName;
                $counter++;
            }
        }
        $homeData['firstimage'] = (array_key_exists('firstimage', $description) && strlen($description['firstimage']) > 0 ?  $description['firstimage'] : '');
        if ($request->hasfile('about.firstimage')) {
            $imageName = 'static-firstimage-image-' . time() .  '.' . $request->about['firstimage']->extension();
            $request->about['firstimage']->move(public_path('images/staticImages'), $imageName);
            $homeData['firstimage'] = $imageName;
        }

        $data->description = json_encode($homeData);
        $data->save();

        return redirect('/administrator/edit-static-pages/about-us');
    }*/

    function staticContactUs()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $contact = StaticPage::where('url', 'contact-us')->first();
        return view('staticpage.contact', ['title' => 'Edit Page - SpiceBucket Administration', 'page' => 'Contact', 'contact' => ($contact == null ? array() : json_decode($contact->description, true))]);
    }


    function saveStaticContact(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $contactData = $request->contact;
        $data = StaticPage::where('url', 'contact-us')->first();
        if ($data == null) {
            $data = new StaticPage();
        }
        $data->title = "Contact Us";
        $data->url = "contact-us";
        $data->description = json_encode($contactData);
        $data->save();

        return redirect('/administrator/edit-static-pages/contact-us');
    }
	
	function mobileAppHomePage(){
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['static-page-edit'] == 0){
            return view('wms.accessdenied');
		}
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $mobileapp = StaticPage::where('url', 'mobile-app-home')->first();
        return view('staticpage.mobileapphome', ['title' => 'Edit Page - SpiceBucket Administration', 'page' => 'Mobile App Home Page', 'mobileapp' => ($mobileapp == null ? array() : json_decode($mobileapp->description, true)), 'vendors' => $vendors, 'categories' => $categories]);
	}
	
	function saveMobileAppHomePage(Request $request){
        $data = StaticPage::where('url', 'mobile-app-home')->first();
		$description = array();
        if ($data == null) {
            $data = new StaticPage();
        } else {
			$description = json_decode($data->description, true);
		}
        $data->title = "Mobile App Home Page";
        $data->url = "mobile-app-home";
		$mobileapphomepage = $request->mobileapp;
		$mobileapphome['banner'] = (array_key_exists('banner', $description) && count($description['banner']) > 0 ?  $description['banner'] : array());
		if(array_key_exists('banner', $mobileapphomepage))
			$mobileapphome['banner'] = array_replace($mobileapphome['banner'], $mobileapphomepage['banner']);
		if ($request->hasfile('mobileapp.banner')) {
            foreach ($request->mobileapp['banner'] as $counter => $image) {
                $imageName = 'static-mobile-app-banner-image-' . $counter . '-' . time() .  '.' . $image->extension();
                $image->move(public_path('images/staticImages'), $imageName);
                $mobileapphome['banner'][$counter] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
            }
        }

		$mobileapphome['banner_after_latest_offer'] = (array_key_exists('banner_after_latest_offer', $description) && count($description['banner_after_latest_offer']) > 0 ?  $description['banner_after_latest_offer'] : array());
		if(array_key_exists('banner-after-latest-offer', $mobileapphomepage)) {
			foreach($mobileapphomepage['banner-after-latest-offer'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-latest-offer-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['banner_after_latest_offer'][$key]['image'];
				}
				$mobileapphome['banner_after_latest_offer'][$key] = $latestoffer;
			}
		}

		$mobileapphome['banner_after_daily_essentials_need'] = (array_key_exists('banner_after_daily_essentials_need', $description) && count($description['banner_after_daily_essentials_need']) > 0 ?  $description['banner_after_daily_essentials_need'] : array());
		if(array_key_exists('banner-after-daily-essentials-need', $mobileapphomepage)) {
			foreach($mobileapphomepage['banner-after-daily-essentials-need'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-latest-offer-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['banner_after_daily_essentials_need'][$key]['image'];
				}
				$mobileapphome['banner_after_daily_essentials_need'][$key] = $latestoffer;
			}
		}
		$mobileapphome['latest_offers'] = (array_key_exists('latest_offers', $description) && count($description['latest_offers']) > 0 ?  $description['latest_offers'] : array());
		if(array_key_exists('latest-offer', $mobileapphomepage)) {
			foreach($mobileapphomepage['latest-offer'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-latest-offer-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['latest_offers'][$key]['image'];
				}
				$mobileapphome['latest_offers'][$key] = $latestoffer;
			}
		}
		$mobileapphome['highly_discounted_offers'] = (array_key_exists('highly_discounted_offers', $description) && count($description['highly_discounted_offers']) > 0 ?  $description['highly_discounted_offers'] : array());
		if(array_key_exists('highly-discounted-offer', $mobileapphomepage)) {
			foreach($mobileapphomepage['highly-discounted-offer'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-highly-discounted-offer-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = @$mobileapphome['highly_discounted_offers'][$key]['image'];
				}
				$mobileapphome['highly_discounted_offers'][$key] = $latestoffer;
			}
		}
		$mobileapphome['spice_bucket_offer'] = (array_key_exists('spice_bucket_offer', $description) && count($description['spice_bucket_offer']) > 0 ?  $description['spice_bucket_offer'] : array());
		if(array_key_exists('spice-bucket-offer', $mobileapphomepage)) {
			foreach($mobileapphomepage['spice-bucket-offer'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-spice-bucket-offer-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['spice_bucket_offer'][$key]['image'];
				}
				$mobileapphome['spice_bucket_offer'][$key] = $latestoffer;
			}
		}
		$mobileapphome['most_popular_brands'] = (array_key_exists('most_popular_brands', $description) && count($description['most_popular_brands']) > 0 ?  $description['most_popular_brands'] : array());
		if(array_key_exists('most-popular-brand', $mobileapphomepage)) {
			foreach($mobileapphomepage['most-popular-brand'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-most-popular-brand-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['most_popular_brands'][$key]['image'];
				}
				$mobileapphome['most_popular_brands'][$key] = $latestoffer;
			}
		}
		$mobileapphome['featured_offer'] = (array_key_exists('featured_offer', $description) && count($description['featured_offer']) > 0 ?  $description['featured_offer'] : array());
		if(array_key_exists('featured-offer', $mobileapphomepage)) {
			foreach($mobileapphomepage['featured-offer'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-featured-offer-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['featured_offer'][$key]['image'];
				}
				$mobileapphome['featured_offer'][$key] = $latestoffer;
			}
		}
		$mobileapphome['bestsellers'] = (array_key_exists('bestsellers', $description) && count($description['bestsellers']) > 0 ?  $description['bestsellers'] : array());
		if(array_key_exists('bestseller', $mobileapphomepage)) {
			foreach($mobileapphomepage['bestseller'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-bestseller-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['bestsellers'][$key]['image'];
				}
				$mobileapphome['bestsellers'][$key] = $latestoffer;
			}
		}
		$mobileapphome['new_at_spice_bucket'] = (array_key_exists('new_at_spice_bucket', $description) && count($description['new_at_spice_bucket']) > 0 ?  $description['new_at_spice_bucket'] : array());
		if(array_key_exists('new-on-spicebucket', $mobileapphomepage)) {
			foreach($mobileapphomepage['new-on-spicebucket'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-new-on-spicebucket-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['new_at_spice_bucket'][$key]['image'];
				}
				$mobileapphome['new_at_spice_bucket'][$key] = $latestoffer;
			}
		}
		$mobileapphome['daily_essential_needs'] = (array_key_exists('daily_essential_needs', $description) && count($description['daily_essential_needs']) > 0 ?  $description['daily_essential_needs'] : array());
		if(array_key_exists('daily-essentials-need', $mobileapphomepage)) {
			foreach($mobileapphomepage['daily-essentials-need'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-daily-essentials-need-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['daily_essential_needs'][$key]['image'];
				}
				$mobileapphome['daily_essential_needs'][$key] = $latestoffer;
			}
		}
		$mobileapphome['top_selling_brands'] = (array_key_exists('top_selling_brands', $description) && count($description['top_selling_brands']) > 0 ?  $description['top_selling_brands'] : array());
		if(array_key_exists('top-selling-brand', $mobileapphomepage)) {
			foreach($mobileapphomepage['top-selling-brand'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-top-selling-brand-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['top_selling_brands'][$key]['image'];
				}
				$mobileapphome['top_selling_brands'][$key] = $latestoffer;
			}
		}
		$mobileapphome['recommended_for_you'] = (array_key_exists('recommended_for_you', $description) && count($description['recommended_for_you']) > 0 ?  $description['recommended_for_you'] : array());
		if(array_key_exists('recommend-for-you', $mobileapphomepage)) {
			foreach($mobileapphomepage['recommend-for-you'] as $key => $latestoffer) {
				$categoryid = $latestoffer['categoryid'];
				$vendorid = $latestoffer['vendorid'];
				$latestoffer['category_id'] = $categoryid;
				$latestoffer['vendor_id'] = $vendorid;
				$latestoffer['page'] = ($vendorid === '' || is_null($vendorid)) ? 'category' : 'brand';
				$categorydetails = ProductCategory::find($categoryid);
				if(!($categorydetails === '' || is_null($categorydetails))) {
					$latestoffer['category_name'] = $categorydetails->name;
					$latestoffer['category_slug'] = $categorydetails->slug;
				} else {
					$latestoffer['category_name'] = null;
					$latestoffer['category_slug'] = null;
				}
				if(!($vendorid === '' || is_null($vendorid))){
					$vendordetails = Vendor::find($vendorid);
					$latestoffer['vendor_name'] = $vendordetails->store_name;
					$latestoffer['vendor_slug'] = $vendordetails->slug;
				} else {
					$latestoffer['vendor_name'] = null;
					$latestoffer['vendor_slug'] = null;
				}
				if(array_key_exists('image', $latestoffer)){
					$imageName = 'static-mobile-app-recommend-for-you-image-' . $key . '-' . time() .  '.' . $latestoffer['image']->extension();
					$latestoffer['image']->move(public_path('images/staticImages'), $imageName);
					$latestoffer['image'] = url(env('APP_URL') . '/public/images/staticImages/' . $imageName);
				} else {
					$latestoffer['image'] = $mobileapphome['recommended_for_you'][$key]['image'];
				}
				$mobileapphome['recommended_for_you'][$key] = $latestoffer;
			}
		}
        $data->description = json_encode($mobileapphome);
        $data->save();

        return redirect('/administrator/edit-static-pages/mobile-app-home-page');
	}
	
	function deleteMobileAppHomePageElement(Request $request) {
		$type = $request->type;
		$key = $request->key;
        $data = StaticPage::where('url', 'mobile-app-home')->first();
		$description = json_decode($data->description, true);

		if(array_key_exists($type, $description) && array_key_exists($key, $description[$type])) {
			unset($description[$type][$key]);
		}

        $data->description = json_encode($description);
        $data->save();

        return redirect('/administrator/edit-static-pages/mobile-app-home-page');
	}
}
