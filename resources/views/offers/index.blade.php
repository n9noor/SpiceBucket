@extends("layout")

@section("content")



<main class="main pages">

    <div class="page-header breadcrumb-wrap">

        <div class="container">

            <div class="breadcrumb">

                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                <span></span> Offers

            </div>

        </div>

    </div>

    <div class="container mb-30">

        <div class="row">

            <div class="col-lg-12 m-auto">

                <div class="row flex-row-reverse">

                    <div class="col-xl-9">
                        <div id="seller-top-product-filter" class="col-lg-12 m-auto my-5">
                            <a class="shop-filter-toggle active" href="#">
                                <span class="fi-rs-filter mr-5"></span>
                                <span class="title">Filters</span>
                                <i class="fi-rs-angle-small-up angle-up"></i>
                                <i class="fi-rs-angle-small-down angle-down"></i>
                            </a>
                            <form action="" method="GET">
                                <div class="shop-product-filter-header mb-3 page_speed_1000893246">
                                    <div class="row">
                                        @if (count($categories) > 0)
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                                            <h5 class="mb-20 widget__title" data-title="Category">By categories</h5>
                                            <div class="custome-checkbox ps-custom-scrollbar"><span></span>
                                                @foreach($categories as $category)
                                                <input class="form-check-input category-filter-input" name="searchcategories[]" type="checkbox" id="top-category-filter-{{ $category->id }}" value="{{ $category->id }}" @if (in_array($category->id, (array)request()->input('searchcategories', []))) checked @endif>

                                                <label class="form-check-label" for="top-category-filter-{{ $category->id }}">

                                                    <span class="d-inline-block">{{$category->name}}</span>

                                                </label>

                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        @if (count($vendors) > 0)

                                        <div class="widget-category-2 mb-10 widget-filter-item">

                                            <h5 class="section-title style-1 mb-10 widget__title" data-title="Category">By Brands</h5>

                                            <div class="custome-checkbox">

                                                @foreach($vendors as $brand)

                                                <input class="form-check-input" name="searchbrands[]" type="checkbox" id="top-brand-filter-{{ $brand->id }}" value="{{ $brand->id }}" @if (in_array($brand->id, (array)request()->input('searchbrands', []))) checked @endif>

                                                <label class="form-check-label" for="top-brand-filter-{{ $brand->id }}">

                                                    <span class="d-inline-block">{{is_null($brand->vendor_alias) ? $brand->store_name : $brand->vendor_alias}}</span>

                                                </label>

                                                <br>

                                                @endforeach

                                            </div>

                                        </div>

                                        @endif
                                        <div class="widget"><button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5 ml-0"></i> Filter</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="products-listing position-relative">

                            <div class="list-content-loading">

                                <div class="half-circle-spinner">

                                    <div class="circle circle-1"></div>

                                    <div class="circle circle-2"></div>

                                </div>

                            </div>

                            <div class="shop-product-filter">

                                <div class="total-product">

                                    <p>We found <strong class="text-brand">{{count($offers)}}</strong> offers for you!</p>

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

                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=created&orderby=asc">New Arrivals</a></li>
                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=discount&orderby=desc">Discount: High to Low</a></li>
                                                <li><a href="{{Request::url()}}?min_price={{Request::get('min_price', 0)}}&max_price={{Request::get('max_price', 10000)}}&min_discount={{Request::get('min_discount', 0)}}&max_discount={{Request::get('max_discount', 70)}}&sortby=discount&orderby=asc">Discount: Low to High</a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row product-grid">

                                @forelse ($offers as $offer)

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12 col-sm-6">

                                    @if(is_null($offer->vendor_id) || $offer->vendor_id == "")

                                    <a href="/offers?category={{$offer->category_id}}">

                                        @else

                                        <a href="/brand/{{$offer->vendor_slug}}">

                                            @endif

                                            <div class="product-cart-wrap mb-30 offers-grid">

                                                <div class="product-img-action-wrap">

                                                    <div class="product-img product-img-zoom">
                                                       
                                                        <img class="default-img" src="/images/offers/{{ $offer->imagepath}}">

                                                        

                                                    </div>

                                                </div>

                                            </div>

                                        </a>

                                </div>

                                @empty

                                <div class="mt__60 mb__60 text-center">

                                    <!--<p>No offer found!</p> -->
									<img src="{{ URL::to('/') }}/images/coming-soon.png" alt="coming soon" class="image">
                                </div>

                                @endforelse

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-3 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">

                            <div class="sidebar-widget widget-area">

                                <form action="" method="GET">

                                    @if (count($categories) > 0)

                                    <div class="widget-category-2 widget-filter-item">

                                        <h5 class="section-title style-1 mb-10 widget__title" data-title="Category">By Categories</h5>

                                        <div class="custome-checkbox">

                                            @foreach($categories as $category)

                                            <input class="form-check-input" name="searchcategories[]" type="checkbox" id="category-filter-{{ $category->id }}" value="{{ $category->id }}" @if (in_array($category->id, (array)request()->input('searchcategories', []))) checked @endif>

                                            <label class="form-check-label" for="category-filter-{{ $category->id }}">

                                                <span class="d-inline-block">{{$category->name}}</span>

                                            </label>

                                            <br>

                                            @endforeach

                                        </div>

                                    </div>

                                    @endif

                                    <hr>


                                    @if (count($vendors) > 0)

                                    <div class="widget-category-2 mb-10 widget-filter-item">

                                        <h5 class="section-title style-1 mb-10 widget__title" data-title="Category">By Brands</h5>

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
                                    <button class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Apply</button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>
<script type="text/javascript">
      setTimeout(function() {
    $('.title').trigger('click');
  }, 1000);

</script>
@endsection

@push('externaljavascript')

<script src="/assets/js/plugins/slider-range.js"></script>

@endpush
