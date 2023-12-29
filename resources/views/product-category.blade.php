@extends("layout")
@section("content")
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Category
                <span></span> {{$category->name}}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="products-listing position-relative">
                    <div class="list-content-loading">
                        <div class="half-circle-spinner">
                            <div class="circle circle-1"></div>
                            <div class="circle circle-2"></div>
                        </div>
                    </div>
                    <div class="shop-product-filter">
                        <div class="total-product">
                            <p>We found <strong class="text-brand">{{count($products)}}</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover products_sortby">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span><span>{{Request::get('sortby', 'Relevance')}}</span> <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown products_ajaxsortby" data-name="sort-by">
                                    <ul>
                                        <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=relevance&orderby=desc">Relevance</a></li>
                                        <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=discount&orderby=asc">Discount</a></li>
                                        <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=name&orderby=asc">Name</a></li>
                                        <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=rating&orderby=desc">Customer Top Rated</a></li>
                                        <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=created&orderby=asc">New Arrivals</a></li>
                                        <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=price&orderby=asc">Price: High to Low</a></li>
                                        <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=price&orderby=desc">Price: Low to High</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                                <div class="sidebar-widget widget-area">
                                    <form action="" method="GET">
                                        @if (count($subcategories) > 0)
                                        <div class="widget-category-2 mb-30 widget-filter-item">
                                            <h5 class="section-title style-1 mb-30 widget__title" data-title="Category">By Sub Categories</h5>
                                            <div class="custome-checkbox">
                                                @foreach($subcategories as $category)
                                                <input class="form-check-input" name="searchcategories[]" type="checkbox" id="category-filter-{{ $category->id }}" value="{{ $category->id }}" @if (in_array($category->id, (array)request()->input('searchcategories', []))) checked @endif>
                                                <label class="form-check-label" for="category-filter-{{ $category->id }}">
                                                    <span class="d-inline-block">{{$category->name}}</span>
                                                </label>
                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <br>
                                        @if (count($vendors) > 0)
                                        <div class="widget-category-2 mb-30 widget-filter-item">
                                            <h5 class="section-title style-1 mb-30 widget__title" data-title="Category">By Brands</h5>
                                            <div class="custome-checkbox">
                                                @foreach($vendors as $brand)
                                                <input class="form-check-input" name="searchbrands[]" type="checkbox" id="brand-filter-{{ $brand->id }}" value="{{ $brand->id }}" @if (in_array($brand->id, (array)request()->input('searchbrands', []))) checked @endif>
                                                <label class="form-check-label" for="brand-filter-{{ $brand->id }}">
                                                    <span class="d-inline-block">{{is_null($brand->vendor_alias) ? $brand->store_name : $brand->vendor_alias}}</span>
                                                </label>
                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <br>
                                        <div data-type="price" class="price_range range mb-30 widget-filter-item">
                                            <h5 class="section-title style-1 mb-30">Filter by price</h5>
                                            <div class="price-filter">
                                                <div class="price-filter-inner">
                                                    <div class="price-filter range">
                                                        <div class="price-filter-inner">
                                                            <div id="slider-range"></div>
                                                            <input type="hidden" class="min_price min-range" id="min-price" name="min_price" value="{{Request::get('min_price', 0)}}" data-min="0" data-label="min price" />
                                                            <input type="hidden" class="min_price max-range" id="max-price" name="max_price" value="{{Request::get('max_price', 10000)}}" data-max="10000" data-label="max price" />
                                                            <div class="price_slider_amount">
                                                                <div class="label-input">
                                                                    <span class="d-inline-block">Range: </span>
                                                                    <span id="slider-range-value1" class="from d-inline-block"></span>
                                                                    <span id="slider-range-value2" class="to d-inline-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-default mt-3"><i class="fi-rs-filter mr-5"></i> Apply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <div class="row product-grid">
                                @forelse ($products as $product)
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="/product/{{ $product->slug }}">

                                                    @php $imagearray=array('path_folder'=>'/images/products/','image'=>     $product->image,'size'=>[250,250]); 
                                                     @endphp  
                                                    <img class="default-img" src="{{ imageRender($imagearray)}}" alt="{{ $product->name }}">
                                                    <img class="hover-img" src="{{ imageRender($imagearray)}}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Add To Wishlist" data-product-id="{{$product->id}}" class="action-btn add-wishlist-btn fill-and-blank" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">

                                            <div class="product-category">
                                                @if(url()->current() == env('APP_URL') . "/product-categories/$product->categoryslug")
                                                <a href="#">{{$product->categoryName}}</a>
                                                @else
                                                <a href="/product-categories/{{$product->categoryslug}}" target="_blank">{{$product->categoryName}}</a>
                                                @endif
                                            </div>

                                            <h2><a href="/product/{{ $product->slug }}" target="_blank">{{$product->name}}</a></h2>
                                            <div>
                                                <span class="font-small text-muted">Brand: <a href="/brand/{{ $product->vendor_slug }}" target="_blank">{{!is_null($product->vendorNickName) && !empty($product->vendorNickName) ? $product->vendorNickName :$product->vendorName }}</a></span>
                                            </div>
                                            @php $discountPrice = ($product->product_mrp - $product->netPrice);

                                            @endphp
                                            <div class="product-card-bottom">
                                                <div class="product-price">
                                                    <ul>
                                                        <li><span>Price: <i class="fa fa-rupee-sign"></i>
                                                                {{ $product->netPrice }}</span>
                                                        </li>
                                                        <li>
                                                            MRP: <del><i class="fa fa-rupee-sign"></i>{{ $product->product_mrp}}</del> ({{number_format($product->discount_percentage,1)}}% off)
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--
                                        <div class="add-cart">
                                            <a class="add quick-view-btn-add-to-cart" data-productid="{{$product->id}}" href="javascript:void(0)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
										-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="mt__60 mb__60 text-center">
                                    <p>No products found!</p>
                                    <div class="row product-grid">

                                
                                        <div class="mt__60 mb__60 text-center">

                                            <!--<p>No offer found!</p> -->
                                            <img src="https://spicebucket.com/images/coming-soon.png" alt="coming soon" class="image">
                                        </div>

                                        
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('externaljavascript')
<script src="/assets/js/plugins/slider-range.js"></script>
@endpush