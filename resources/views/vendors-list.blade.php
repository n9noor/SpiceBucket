@extends("layout")
@section("content")
<main class="main pages mb-80">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Sellers
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="archive-header-2 text-center">
                <h1 class="display-2 mb-50">Sellers</h1>
                <!-- <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="sidebar-widget-2 widget_search mb-50">
                                <div class="search-form">
                                    <form action="#">
                                        <input type="text" placeholder="Search Sellers (by name or ID)..." />
                                        <button type="submit"><i class="fi-rs-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
            </div>
            <div class="row mb-50">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We have <strong class="text-brand">{{count($vendors)}}</strong> Sellers now</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row vendor-grid">
                @foreach($vendors as $vendor)
                <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                    <div class="vendor-wrap mb-40">
                        <div class="vendor-img-action-wrap">
                            <div class="vendor-img"><a href="/brand/{{ $vendor->slug }}"><img src="/assets/imgs/no-image-available.jpg" alt="{{$vendor->store_name}}" class="default-img"></a></div>
                        </div>
                        <div class="vendor-content-wrap">
                            <div class="d-flex justify-content-between align-items-end mb-30">
                                <div>
                                    <div class="product-category"><span class="text-muted">Since {{date('Y',strtotime($vendor->created_at))}}</span></div>
                                    <h4 class="mb-5"><a href="/brand/{{ $vendor->slug }}">{{$vendor->store_name}}</a></h4>
                                </div>
                                <div class="mb-10"><span class="font-small total-product">{{count($vendor->products)}} Products</span></div>
                            </div>
                            <div class="vendor-info mb-30">
                            </div><a href="/brand/{{ $vendor->slug }}" class="btn btn-xs">Visit Store <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>


                @endforeach
                <!--end vendor card-->
            </div>
            <!-- <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div> -->
        </div>
    </div>
</main>
@endsection