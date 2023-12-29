@extends("layout")
@section("content")
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Wishlist
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mb-10 mt-10">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="mb-10">
                        <h1 class="heading-2 mb-10">Your Wishlist</h1>
                        <h6 class="text-body">There are <span class="text-brand">{{count($products)}}</span> products in this list</h6>
                    </div>
                    @if(count($products) > 0)
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" colspan="2" class="pl-30 start">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="pt-30" id="wishlist-row-{{$product->id}}">
                                    <td class="image product-thumbnail pt-10 pl-30">
                                        <img alt="{{ $product->name }}" src="{{(env('APP_ENV') == "production" ? url('/public/images/products/' . $product->image) : url('/images/products/' . $product->image))}}">
                                    </td>
                                    <td class="product-des product-name" style="width:35%;">
                                        <p class="product-name">
                                            <a href="/product/{{ $product->slug }}">{{$product->name}}</a>
                                        </p>
                                        <!-- <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">({{ $product->reviews_count }})</span>
                                            </div> -->
                                    </td>
                                    <td class="price" data-title="Price">
                                        <span class="text-brand"><i class="fa fa-rupee-sign"></i> {{$product->net_price}}</span>
                                    </td>
                                    <td class="detail-info" data-title="Stock">
                                        <span class="stock-status in-stock mb-0">
                                            In Stock
                                        </span>
                                    </td>
                                    <td class="text-center" data-title="Action">
                                        <button class="button quick-view-btn-add-to-cart" data-productid="{{$product->id}}"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</button>
                                    </td>

                                    <td class="action" data-title="Remove">
                                        <a href="javascript:void(0)" onclick="removeWishlist({{$product->id}})" class="js-remove-from-wishlist-button"><i class="fi-rs-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <!--<p>No item in wishlist!</p> -->
                    <img src="{{ URL::to('/') }}/images/coming-soon.png" alt="coming soon" class="image">
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection