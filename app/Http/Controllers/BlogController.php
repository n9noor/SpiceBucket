<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\ProductCategory;
use App\Models\StaticPage;
use App\Models\Vendor;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function bloglist(){
        $blogs = Blog::leftjoin('product_category', 'product_category.id', '=', 'blogs.category_id')->leftjoin('users', 'users.id', '=', 'blogs.created_by')->select('blogs.*', 'product_category.name AS categoryname')->get();
        return view('blogs.index', ['title' => 'Blogs List - SpiceBucket Administration', 'blogs' => $blogs]);
    }
	
	public function add(){
		$categories = ProductCategory::where('is_active', true)->get();
        return view('blogs.add', ['title' => 'Add Blog - SpiceBucket Administration', 'categories' => $categories]);
	}
	
	public function save(Request $request){
        $this->validate($request, [
			'category_id' => 'required',
			'slug' => 'required|unique:blogs',
			'title' => 'required',
			'description' => 'required'
        ]);
		$blog = new Blog();
		$blog->category_id = $request->category_id;
		$blog->title = $request->title;
		$blog->description = $request->description;
		$blog->slug = $request->slug;
		$blog->created_by = Session::get('admin-loggedin-id');
        if ($request->hasfile('image')) {
			$imageName = 'blog-' . time() . '.' . $request->image->extension();
			$request->image->move(public_path('images/blogs'), $imageName);
			$blog->featured_image = $imageName;
		}
		$blog->save();
        return redirect('/administrator/blogs')->with('message', 'Blog saved successfully.');
	}
	
	public function edit($id) {
		$blog = Blog::find($id);
		$categories = ProductCategory::where('is_active', true)->get();
        return view('blogs.edit', ['title' => 'Edit Blog - SpiceBucket Administration', 'categories' => $categories, 'blog' => $blog]);
	}
	
	public function update(Request $request, $id) {
        $this->validate($request, [
			'category_id' => 'required',
			'slug' => 'required|unique:blogs,slug,'.$id,
			'title' => 'required',
			'description' => 'required'
        ]);
		$blog = Blog::find($id);
		$blog->category_id = $request->category_id;
		$blog->title = $request->title;
		$blog->description = $request->description;
		$blog->slug = $request->slug;
		$blog->updated_by = Session::get('admin-loggedin-id');
        if ($request->hasfile('image')) {
			$imageName = 'blog-' . time() . '.' . $request->image->extension();
			$request->image->move(public_path('images/blogs'), $imageName);
			$blog->featured_image = $imageName;
		}
		$blog->save();
        return redirect('/administrator/blogs')->with('message', 'Blog updated successfully.');
	}
	
	public function deleteblog() {
		
	}
	
	public function frontpage($category = null){
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
		
		if($category != null){
			$blogs = Blog::leftjoin('product_category', 'product_category.id', '=', 'blogs.category_id')->leftjoin('users', 'users.id', '=', 'blogs.created_by')->select('blogs.*', 'product_category.name AS categoryname', 'product_category.slug AS category_slug', DB::raw('CONCAT(users.firstname, " ", users.lastname) AS created_by'))->where('product_category.slug', $category)->get();
		} else {
			$blogs = Blog::leftjoin('product_category', 'product_category.id', '=', 'blogs.category_id')->leftjoin('users', 'users.id', '=', 'blogs.created_by')->select('blogs.*', 'product_category.name AS categoryname', 'product_category.slug AS category_slug', DB::raw('CONCAT(users.firstname, " ", users.lastname) AS created_by'))->get();
		}
		
		return view('blogs.frontend', ['activePage' => 'blog', 'headercategories' => $headercategories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'categories' => $categories, 'vendors' => $vendors, 'blogs' => $blogs]);
	}
	
	public function frontpage_detail($category, $slug){
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();

		$blog = Blog::leftjoin('product_category', 'product_category.id', '=', 'blogs.category_id')->leftjoin('users', 'users.id', '=', 'blogs.created_by')->select('blogs.*', 'product_category.name AS categoryname', 'product_category.slug AS category_slug', DB::raw('CONCAT(users.firstname, " ", users.lastname) AS created_by'))->where('blogs.slug', $slug)->where('product_category.slug', $category)->first();
		
		return view('blogs.frontend-detail', ['activePage' => 'blog-detail', 'headercategories' => $headercategories, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'categories' => $categories, 'vendors' => $vendors, 'blog' => $blog]);
	}
}