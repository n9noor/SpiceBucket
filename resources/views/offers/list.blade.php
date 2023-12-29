@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Offers
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/offer/add'" title="Add Offer" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Offer
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th class="no-sort">Active</th>
                        <th class="no-sort">Image</th>
                        <th class="default-sort">Heading</th>
                        <th>Vendor</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Featured Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/offer/edit/{{$offer->id}}"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/offer/delete/{{$offer->id}}"><i class="btn-icon-wrapper fa fa-trash"></i></a>
                        </td>
                        <td><input data-column="is_active" data-type="offer" data-id="{{$offer->id}}" type="checkbox" {{$offer->is_active == true ? " checked='checked'" : ""}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                        <td><img width="75" height="75" src="{{ env('APP_ENV') == 'production' ? url('/public/images/offers/' . $offer->imagepath) : url('/images/offers/' . $offer->imagepath) }}" alt="{{$offer->heading}}" class="img-thumbnail" /></td>
                        <td>{{$offer->heading}}</td>
                        <td>{{$offer->store_name}}</td>
                        <td>{{$offer->category}} / {{$offer->sub_category}}</td>
                        <td>@if($offer->is_featured == 1) <div class="mb-2 me-2 badge bg-success">Yes</div> @else <div class="mb-2 me-2 badge bg-danger">No</div> @endif</td>
                        <td>
                            @switch($offer->featured_category)
                            @case("most_popular_brands")
                            Most Popular Brands
                            @break
                            @case("latest_offers")
                            Latest Offers
                            @break
                            @case("top_selling_brands")
                            Top Selling Brands
                            @break
                            @case("deal_of_the_day")
                            Deal of the Day
                            @break
                            @case("highly_discounted_offers")
                            Highly Discounted Offer
                            @break
                            @case("new_at_spice_bucket")
                            New At Spice Bucket
                            @break
                            @case("daily_essential_needs")
                            Daily Essential Needs
                            @break
                            @case("popular_stores")
                            Popular Stores
                            @break
                            @case("bestsellers")
                            Bestsellers
                            @break
                            @case("recommended_for_you")
                            Recommended For You
                            @break
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('stylesheets')
<link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-buttons/css/bootstrap4.min.css')}}">
@endpush

@push('externalJavascripts')
<script type="text/javascript" src="{{asset('backend/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/pdfmake.min.js')}}"></script>
@endpush

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/vendors/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/offers.js')}}"></script>
@endpush