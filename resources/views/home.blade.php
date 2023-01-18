@extends("layout")
@section("content")
<section class="section ec-product-tab section-space-p" id="collection">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<div class="section-title">
<h2 class="ec-bg-title">Our Products</h2>
<h2 class="ec-title">Our Products</h2>
<p class="sub-title">Browse Our Products</p>
</div>
</div>
</div>
<div class="row">
@foreach($products as $product)
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
<div class="ec-product-inner">
<div class="ec-pro-image-outer">
<div class="ec-pro-image">
<a href="javascript:void(0)" class="image">
<img class="main-image" src="{{url('/images/no-image-available.jpg')}}" alt="Product" />
<img class="hover-image" src="{{url('/images/no-image-available.jpg')}}" alt="Product" />
</a>
<span class="percentage">{{$product->discount}}</span>
<a href="#" class="quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal">
<img src="{{asset('frontend/assets/images/icons/quickview.svg')}}" class="svg_img pro_svg" alt="" />
</a>
<div class="ec-pro-actions">
<a href="javascript:void(0)" class="ec-btn-group compare" title="Compare">
<img src="{{asset('frontend/images/icons/compare.svg')}}" class="svg_img pro_svg" alt="" /></a>
<button title="Add To Cart" class="add-to-cart"><img src="{{asset('frontend/images/icons/cart.svg')}}" class="svg_img pro_svg" alt="" /> Add To Cart</button>
<a class="ec-btn-group wishlist" title="Wishlist"><img src="{{asset('frontend/images/icons/wishlist.svg')}}" class="svg_img pro_svg" alt="" /></a>
</div>
</div>
</div>
<div class="ec-pro-content">
<h5 class="ec-pro-title"><a data-id="{{$product->id}}" href="javascript:void(0)">{{$product->name}}</a></h5>
<div class="ec-pro-rating">
<i class="ecicon eci-star fill"></i>
<i class="ecicon eci-star fill"></i>
<i class="ecicon eci-star fill"></i>
<i class="ecicon eci-star fill"></i>
<i class="ecicon eci-star"></i>
</div>
<div class="ec-pro-list-desc">{{$product->description}}</div>
<span class="ec-price">
<span class="new-price">{{$product->net_price}}</span>
</span>
</div>
</div>
</div>
@endforeach
</div>
</div>
</section>
@endsection