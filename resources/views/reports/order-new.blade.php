@extends("wms.layout")
@section("content")
<!--<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Orders
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
    </div>
</div>-->
<div class="mb-3 p-3 card">
<h2>Order Detail</h2>
	<hr>
    <form method="post" id="order-search-frm" class="form-horizontal mx-2">
        @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative mb-3">
                            <label for="orderno" class="form-label">Order No:</label>
                            <input type="text" class="form-control" name="orderno" id="orderno" placeholder="Enter Order No" value="{{old('orderno')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative mb-3">
                            <label for="paymentmode" class="form-label">Payment Mode:</label>
                            <select class="form-control" name="paymentmode" id="paymentmode">
                                <option value="">All</option>
                                <option value="cash">Cash</option>
                                <option value="prepaid">Prepaid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative mb-3">
                            <label for="paymentstatus" class="form-label">Payment Status:</label>
                            <select class="form-control" name="paymentstatus" id="paymentstatus">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                    </div>
					</div>
					<div class="row">
					<div class="col-md-4">
						<div class="position-relative mb-3">
							<label class="control-label form-label">Date Range:</label><br>
							<button type="button" class="btn btn-primary" id="daterange" style="width: 100%;">
								<i class="fa fa-calendar pe-1"></i>
								<span></span>
								<i class="fa ps-1 fa-caret-down"></i>
							</button>
							<input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="{{old('formdate')}}">
							<input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="{{old('todate')}}">
						</div>
					</div>
					<div class="col-md-3">
                        <div class="position-relative mb-3">
                            <label for="deliverystatus" class="form-label">Delivery Status:</label>
                            <select class="form-control" name="deliverystatus" id="deliverystatus">
                                <option value="">All</option>
                                @foreach($delivery as $status)
                                <option value="{{$status->delivery_status}}">{{$status->delivery_status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
					<div class="col-md-3">
                        <div class="position-relative mb-3">
                            <label for="orderstatus" class="form-label">Order Status:</label>
                            <select class="form-control" name="orderstatus" id="orderstatus">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="complete">Completed</option>
                                <option value="cancel">Cancelled</option>
                                <option value="return">Returned</option>
                            </select>
                        </div>
                    </div>
					<div class="col-md-2 mt-4">
						<button type="submit" name="search-product" id="search-product" class="btn btn-secondary">Search</button>
					</div>
                </div>
            <!--<div class="col-md-3">
                <div class="position-relative mb-3">
                    <label class="control-label form-label">Date Range;</label>
                    <button type="button" class="btn btn-primary" id="daterange">
                        <i class="fa fa-calendar pe-1"></i>
                        <span></span>
                        <i class="fa ps-1 fa-caret-down"></i>
                    </button>
                    <input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="{{old('formdate')}}">
                    <input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="{{old('todate')}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="deliverystatus" class="form-label">Delivery Status:</label>
                            <select class="form-control" name="deliverystatus" id="deliverystatus">
                                <option value="">All</option>
                                @foreach($delivery as $status)
                                <option value="{{$status->delivery_status}}">{{$status->delivery_status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="orderstatus" class="form-label">Order Status:</label>
                            <select class="form-control" name="orderstatus" id="orderstatus">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="complete">Completed</option>
                                <option value="cancel">Cancelled</option>
                                <option value="return">Returned</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 mt-4">
                <button type="submit" name="search-product" id="search-product" class="btn btn-secondary">Search</button>
            </div>-->
    </form>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered dark" style="width:100%; overflow-x:scroll; overflow-y:auto !important;">
                <thead>
                    <tr>
                        <th nowrap>Order No</th>
                        <th nowrap class="default-sort">Order Date</th>
                        <th nowrap>Dispatch Date</th>
                        <th nowrap>Delivered Date</th>
                        <th nowrap>Customer Name</th>
                        @if(session('admin-logged-in') == true)
                        <th nowrap>Seller</th>
                        @endif
                        <th nowrap>Sub Total</th>
                        <th nowrap>Tax Amount</th>
                        <th nowrap>Discount</th>
                        <th nowrap>Shipping</th>
                        <th nowrap>COD</th>
                        <th nowrap>Total Amount</th>
                        <th nowrap>Total Quantity</th>
                        <th nowrap>Payment Method</th>
                        <th nowrap>Payment Status</th>
                        <th nowrap>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td nowrap><a href="/sellers/orders/view/{{$order->idoforder}}">{{$order->orderid}}</a></td>
                        <td data-sort="{{strtotime($order->order_datetime)}}" nowrap>{{date('dS M Y, h:i A', strtotime($order->order_datetime))}}</td>
                        <td data-sort="{{strtotime($order->tentative_dispatch_date)}}" nowrap>{{!is_null($order->tentative_dispatch_date) ? date('dS M Y, h:i A', strtotime($order->tentative_dispatch_date)) : ""}}</td>
                        <td data-sort="{{strtotime($order->tentative_delivery_date)}}" nowrap>{{!is_null($order->tentative_delivery_date) ? date('dS M Y, h:i A', strtotime($order->tentative_delivery_date)) : ""}}</td>
                        <td nowrap>{{is_null($order->customerName) ? ($order->firstname . " " . $order->lastname) : $order->customerName}} </td>
                        @if(session('admin-logged-in') == true)
                        <td nowrap>{{$order->vendor}}</td>
                        @endif
                        @php
                        $baseshippingprice = round(($order->shipping_charges * 100) / (100 + $order->gst_rate), 2);
                        $gstshippingprice = $order->shipping_charges - $baseshippingprice;
                        @endphp
                        <td style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->payment_amount, 2)}} </td>
                        <td  style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> {{number_format(($order->gst_on_amount), 2)}} </td>
                        @if($order->discount > 0)
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->discount, 2)}} </td>
                        @else
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> 0.00</td>
                        @endif
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> {{number_format($baseshippingprice, 2)}} </td>
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->cod_charges, 2)}} </td>
                        <td  style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->total_amount, 2)}} </td>
                        <td  style="text-align: center;"  nowrap>{{strtoupper($order->quantity)}}</td>
                        <td nowrap>{{$order->payment_source == 'cod' ? "Cash On Delivery" : "Razorpay"}}</td>
                        <td nowrap>{{$order->payment_status == 'pending' ? ucwords($order->payment_status) : "Received"}}</td>
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
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>-->
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/datatables.net-buttons/js/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/moment/moment.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/vendors/daterangepicker/daterangepicker.js')}}"></script>
@endpush

@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/generate-report.js')}}"></script>
@endpush