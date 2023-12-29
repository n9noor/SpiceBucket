@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div>
                Orders
            </div>
        </div>
    </div>
</div>
<div class="mb-3 p-3 card">
    <form method="post" id="order-search-frm" class="form-horizontal mx-2">
        @csrf
        <div class="row">
			
            <div class="col-md-10">
                <div class="position-relative">
                    <button type="button" class="btn btn-primary" id="daterange">
                        <i class="fa fa-calendar pe-1"></i>
                        <span></span>
                        <i class="fa ps-1 fa-caret-down"></i>
                    </button>
                    <input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="{{old('formdate')}}">
                    <input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="{{old('todate')}}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" name="search-product" id="search-product" class="btn btn-secondary">Search</button>
            </div>
        </div>
    </form>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive" style="">
            <table class="table table-bordered table-striped" style="">
                <thead>
                    <tr>
                        <th nowrap class="no-sort">#</th>
                        <th nowrap class="default-sort">Created At</th>
                        <th nowrap>Order Id</th>
                        <th nowrap>Customer Name</th>
                        @if(session('admin-logged-in') == true)
                        <th nowrap>Seller</th>
                        @endif
                        <th nowrap>Sub Total </th>
                        <th nowrap>Tax Amount</th>
                        <th nowrap>Discount</th>
                        <th nowrap>Shipping</th>
                        <th nowrap>COD</th>
                        <th nowrap>Total Amount</th>
                        <th nowrap>Payment Method</th>
                        <th nowrap>Payment Status</th>
                        <th nowrap>Status</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach($orders as $order)

                    <tr>
                        <td nowrap><a href="/sellers/orders/view/{{$order->idoforder}}">View</a></td>
                        <td data-sort="{{strtotime($order->order_datetime)}}" nowrap>{{date('d/M/Y h:i A', strtotime($order->order_datetime)) }}</td>
                        <td nowrap>{{$order->orderid}}</td>
                        <td nowrap>{{is_null($order->customerName) ? ($order->firstname . " " . $order->lastname) : $order->customerName}} </td>
                        @if(session('admin-logged-in') == true)
                        <td nowrap>{{$order->vendor}}</td>
                        @endif
                        @php
                        $baseshippingprice = round(($order->shipping_charges * 100) / (100 + $order->gst_rate), 2);
                        $gstshippingprice = $order->shipping_charges - $baseshippingprice;
                        @endphp
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->payment_amount, 2)}} </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format(($order->gst_on_amount), 2)}} </td>
                        @if($order->discount > 0)
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->discount, 2)}} </td>
                        @else
                        <td nowrap><i class="fa fa-rupee-sign"></i> 0.00</td>
                        @endif
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($baseshippingprice, 2)}} </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->cod_charges, 2)}} </td>
                        <td style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->total_amount, 2)}} </td>
                        <td nowrap>{{strtoupper($order->payment_source)}}</td>
                        <td nowrap>{{ucwords($order->payment_status)}}</td>
                        <td nowrap>{{ucwords($order->order_status)}}</td>
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
<script type="text/javascript" src="{{asset('backend/vendors/moment/moment.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/daterangepicker/daterangepicker.js')}}"></script>
@endpush

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/order-details.js')}}"></script>
@endpush