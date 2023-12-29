@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Orders View
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/sellers/orders'" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i>Back
            </button>
        </div>
    </div>
</div>
<form action="/sellers/update-order-details" method="POST">
    @csrf
    <div class="main-card mb-3 card">
        <div class="card-body">
            <input type="hidden" name="customer_code" id="customer_code" value="{{env('DTDCCLIENTCODE')}}">
            <input type="hidden" name="load_type" id="load_type" value="NON-DOCUMENT">
            <input type="hidden" name="orderID" id="orderID" value="{{$orderview[0]->idoforder}}">
            <div class="row order-view-page">
                <h4><strong>Order Details</strong></h4>
				<hr>
                <div class="col-md-3">
                    <div class="position-relative">
                        <label for="order-id" class="form-label">Order ID</label>
                        <br>
                        <strong>{{$orderview[0]->orderid}}</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative">
                        <label for="order-date" class="form-label">Order Date & Time</label>
                        <br>
                        <strong>{{date('d/M/Y h:i A', strtotime($orderview[0]->order_datetime)) }}</strong>
                        <!--<p>Inititated On : {{$orderview[0]->order_datetime}}</p>-->
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative">
                        <label for="amount" class="form-label">Amount</label>
                        <br>
                        @php $orderTotalAmount = 0; $existingvendor = array(); $productgstrate = 0; @endphp
                        @foreach($orderview as $orderdetails)
                        @php
                        $orderTotalAmount += (($orderdetails->product_price + $orderdetails->gst_on_product_price) * $orderdetails->product_qunatity);
                        if($productgstrate < $orderdetails->productgstrate){
							$productgstrate = $orderdetails->productgstrate;
						}
						if(!in_array($orderdetails->vendor_id, $existingvendor)){
							$orderTotalAmount += $orderdetails->shipping_charges + $orderdetails->codAmount;
							array_push($existingvendor, $orderdetails->vendor_id);
						}
						@endphp
						@endforeach
						@if(session('vendor-logged-in') == true)
						<strong><i class="fa fa-rupee-sign"></i> {{number_format($orderTotalAmount - $orderview[0]->discountVendorWise, 2)}} </strong>
						@else
						<strong><i class="fa fa-rupee-sign"></i> {{number_format($orderTotalAmount - $orderview[0]->mainDiscount, 2)}} </strong>
						@endif
                        </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative">
                        <label for="payment-info" class="form-label">Payment Info</label>
                        <br>
                        <strong>{{$orderview[0]->payment_source}}</strong>
                        <button type="button" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-secondary">{{$orderview[0]->payment_status}}</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative">
                        <label for="order-status" class="form-label">Order Status</label>
                        <br>
                        @if(session('vendor-logged-in') == true)
                        <button type="button" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-secondary">{{$orderview[0]->orderStatus}}</button>
                        @else
                        <button type="button" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-secondary">{{$orderview[0]->order_status}}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-card mt-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative">
                        <h4 style="font-weight: 600;">Registered Customer <span style="font-size: 12px; color: #444444;">( {{$orderview[0]->createdDate}} )</span></h4>
                        <hr>
                        <h5><strong>{{$orderview[0]->customerName}}</strong></h5>
                        <h6>{{$orderview[0]->customerEmail}}</h6>
                        <h6>{{$orderview[0]->customerPhone}}</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <h4 style="font-weight: 600;">BILLING ADDRESS</h4>
                        <hr>
                        <h6><strong> Name:</strong> {{$orderview[0]->firstname}} {{$orderview[0]->lastname}}</h6>
                        <h6><strong> Email:</strong> {{$orderview[0]->cbaEmail}}</h6>
                        <h6><strong> Name:</strong> {{$orderview[0]->phonenumber}}</h6>

                        <h6><strong>Address:</strong> {{$orderview[0]->billingAddress}}</h6>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <h4 style="font-weight: 600;">SHIPPING ADDRESS</h4>
                        <hr>
                        <h6><strong> Name:</strong> {{$orderview[0]->firstname}} {{$orderview[0]->lastname}}</h6>
                        <h6><strong> Email:</strong> {{$orderview[0]->csaEmail}}</h6>
                        <h6><strong> Name:</strong> {{$orderview[0]->phonenumber}}</h6>

                        <h6><strong>Address:</strong> {{$orderview[0]->shippingAddress}}</h6>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-card mt-3 card">
        <div class="card-body">
            <h4 class="mb-3"><strong>Products</strong></h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th nowrap="">#</th>
                            <th nowrap="">Image</th>
                            <th nowrap="">Product</th>
                            <th nowrap="" align="center" class="text-center">Quantity</th>
							
                            <th nowrap="" align="center" class="text-center">Weight(Kg)</th>
							<th nowrap="" align="center" class="text-center">Total Weight(Kg)</th>
                            <th nowrap="" align="center" class="text-center">Amount</th>
							
							<th nowrap="" align="center" class="text-center">Total Amount</th>
                            <th nowrap="" align="center" class="text-center">GST</th>
							<th nowrap="" align="center" class="text-center">Total GST</th>
                            <th class="price text-center" nowrap="">Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalQuantity = 0;
                        $totalWeight = 0.00;
                        $existingvendor = array();
                        @endphp
                        @php $counter=1; $vendorTotalAmount=0; $subTotalAmount = 0; $totalGST=0; $totalCod=0; $totalShipping=0; @endphp
                        @foreach($orderview as $orderdetail)
                        <tr>
                            <td class="align-middle" nowrap="">{{$counter}}</td>
                            <td nowrap="" class="align-middle"><img src="{{(env('APP_ENV') == "production" ? url('/public/images/products/' . $orderdetail->productImage) : url('/images/products/' . $orderdetail->productImage))}}" width="50" alt="{{$orderdetail->productname}}"></td>
                            <td nowrap="" class="align-middle">
                                <input type="hidden" name="commodity_name" id="commodity_name" value="{{$orderdetail->productname}}">
                                {{$orderdetail->productname}}
                                <p><small>
                                        @if(!is_null($orderdetail->productvariantname1) && !is_null($orderdetail->variantvalue1))
                                        {{$orderdetail->productvariantname1}}: {{$orderdetail->variantvalue1}}
                                        @endif
                                        @if(!is_null($orderdetail->productvariantname2) && !is_null($orderdetail->variantvalue2))
                                        , {{$orderdetail->productvariantname2}}: {{$orderdetail->variantvalue2}}
                                        @endif
                                        @if(!is_null($orderdetail->productvariantname3) && !is_null($orderdetail->variantvalue3))
                                        , {{$orderdetail->productvariantname3}}: {{$orderdetail->variantvalue3}}
                                        @endif
                                        <p class="d-block mb-0 sold-by"><small>Brand: <a href="/brand/{{$orderdetail->vendor_slug}}">{{(!is_null($orderdetail->vendor_alias) && !empty($orderdetail->vendor_alias)) ? $orderdetail->vendor_alias : $orderdetail->store_name}}</a></small></p>
                            </td>
                            <td nowrap="" align="center" class="align-middle text-center" id="declared_value">{{$orderdetail->product_qunatity }}</td>
							
                            <td nowrap="" class="align-middle text-center">
                                {{number_format($orderdetail->net_weight/1000,3)}}
                            </td>
							
							<td nowrap="" class="align-middle text-center">
                               
								
								{{number_format(($orderdetail['net_weight'] * $orderdetail['product_qunatity']/1000),3)}}
								
                            </td>
							
							
                            <td nowrap="" class="align-middle text-center"><i class="fa fa-rupee-sign"></i> {{$orderdetail->product_price }} </td>
							  <td style="text-align: center;"><i class="fa fa-rupee-sign"></i> {{number_format(($orderdetail['product_price'] * $orderdetail['product_qunatity']),2)}}</td>
                            <td nowrap="" class="align-middle text-center"><i class="fa fa-rupee-sign"></i> {{$orderdetail->gst_on_product_price}}</td>
							<td nowrap="" class="align-middle text-center"><i class="fa fa-rupee-sign"></i> 
							{{number_format(($orderdetail['gst_on_product_price'] * $orderdetail['product_qunatity']),2)}}
							
							</td>
                            <td nowrap="" class="align-middle text-center"><i class="fa fa-rupee-sign"></i> <strong>{{$orderdetail->total_product_price}}</strong></td>
                        </tr>
                        @php
                        $totalQuantity += $orderdetail->product_qunatity;
                       
						 $totalWeight += $orderdetail->net_weight * $orderdetail->product_qunatity;
					


                        @endphp

                        @php $counter++; @endphp
                        @php
                        $subTotalAmount += $orderdetail->product_price * $orderdetail->product_qunatity;
                        $totalGST += $orderdetail->gst_on_product_price * $orderdetail->product_qunatity;
                        $vendorTotalAmount += (($orderdetail->product_price + $orderdetail->gst_on_product_price) * $orderdetail->product_qunatity);
                        if(!in_array($orderdetail->vendor_id, $existingvendor)){
                        $baseshippingprice = round(($orderdetail->shipping_charges * 100) / (100 + $productgstrate), 2);
                        $gstshippingprice = round(($orderdetail->shipping_charges - ($orderdetail->shipping_charges * 100) / (100 + $productgstrate)), 2);
                        $totalShipping += $baseshippingprice;
                        $totalGST += $gstshippingprice;
                        $totalCod += $orderdetail->codAmount;
                        array_push($existingvendor, $orderdetail->vendor_id);
                        $vendorTotalAmount += $orderdetail->shipping_charges + $orderdetail->codAmount;
                        }
                        @endphp
                        @endforeach
                        <tr>
                            <th class="text-end" colspan="3">Total: </th>
                            <th class="align-middle text-center">
                                {{$totalQuantity}}
                            </th>
							<th class="align-middle text-center" colspan="1">
                                
                            </th>
                            <th class="align-middle text-center" colspan="1" width="250" style="width: 250px;">
                                {{number_format($totalWeight/1000,3)}}
                            </th>
							<th class="align-middle text-center" colspan="2">
                                
                            </th>
							<th class="align-middle text-center" colspan="2">
                                
                            </th>
							<th class="align-middle text-center" colspan="2">
                                
                            </th>
							
                           
                        </tr>
						<tr>
							<th colspan="9"></th>
							<th class="align-middle" colspan="">
                                Sub Total:
                            </th>
                            <th><i class="fa fa-rupee-sign"></i> {{number_format($subTotalAmount,2)}}</th>
						</tr>
                        <tr>
                            <th colspan="9"></th>
                            <th class="allign-middle">Tax: </th>
                            <th><i class="fa fa-rupee-sign"></i> {{number_format($totalGST,2)}}</th>
                        </tr>                        
                        @if($orderview[0]->discountVendorWise)
                        <tr>
                            <th colspan="9"></th>
                            <th class="allign-middle">Discount: </th>
                            @if(session('vendor-logged-in') == true)
                            <th><i class="fa fa-rupee-sign"></i> {{number_format($orderview[0]->discountVendorWise,2)}}</th>
                            @else
                                <th><i class="fa fa-rupee-sign"></i> {{number_format($orderview[0]->mainDiscount,2)}}</th>
                            @endif
                        </tr>
                        @endif
                        <tr>
                            <th colspan="9"></th>
                            <th class="allign-middle">Shipping Fee: </th>
                            <th><i class="fa fa-rupee-sign"></i> {{number_format($totalShipping,2)}}</th>
                        </tr>
                        <tr>
                            <th colspan="9"></th>
                            <th class="allign-middle">COD <span>(charges waived off)</span>: </th>
                            <th><i class="fa fa-rupee-sign"></i> {{number_format($totalCod,2)}}</th>
                        </tr>
                        <tr>
                            <th colspan="9"></th>
                            <th class="allign-middle">Grand Total: </th>
                            @if(session('vendor-logged-in') == true)
                            <th><i class="fa fa-rupee-sign"></i> {{number_format($vendorTotalAmount - $orderview[0]->discountVendorWise,2)}}</th>
                            @else
                            <th><i class="fa fa-rupee-sign"></i> {{number_format($vendorTotalAmount - $orderview[0]->mainDiscount,2)}}</th>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="main-card mt-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <h4>PAYMENT STATUS</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <label class="form-label">Payment Mode</label>
                        <select disabled class="mb-2 form-control">
                            <option selected>{{$orderview[0]->payment_source}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <label for="paymentstatus" class="form-label">Payment Status</label>
                        <select name="paymentstatus" class="mb-2 form-control">
                            <option {{$orderview[0]->payment_status == 'refunded' ? "selected='selected'" : ""}} value="refunded">Refunded</option>
                            <option {{$orderview[0]->payment_status == 'partiallyRefunded' ? "selected='selected'" : ""}} value="partiallyRefunded">Partially Refunded</option>
                            <option {{$orderview[0]->payment_status == 'pending' ? "selected='selected'" : ""}} value="pending">Pending</option>
                            <option {{($orderview[0]->payment_status == 'recieved' || $orderview[0]->payment_status == 'captured') ? "selected='selected'" : ""}} value="recieved">Recieved</option>
                            <option {{$orderview[0]->payment_status == 'failed' ? "selected='selected'" : ""}} value="failed">Failed</option>
                            <option {{$orderview[0]->payment_status == 'chargeback' ? "selected='selected'" : ""}} value="chargeback">Chargeback</option>

                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <h4>DELIVERY STATUS</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <label for="deliverymode" class="form-label">Delivery Mode</label>
                        <select disabled class="mb-2 form-control">
                            <option selected>Shipping</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <label for="deliverystatus" class="form-label">Delivery Status</label>
                        <select name="deliverystatus" id="deliverystatus" class="mb-2 form-control">
                            @foreach($delivery as $status)
                            <option {{$orderview[0]->order_status == $status->delivery_status ? "selected='selected'" : ""}} data-value="{{$status->id}}" value="{{$status->delivery_status}}">{{$status->delivery_status}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div id="dtdcdiv">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>Dimension</h5>
                            <div class="position-relative mt-3">
                                <label for="length" class="form-label">Length (CM)</label>
                                <input type="text" class="form-control" id="length" name="length" value="{{$orderview[0]->shipping_length}}">
                            </div>
                            <div class="position-relative mt-3">
                                <label for="width" class="form-label">Width (CM)</label>
                                <input type="text" class="form-control" id="width" name="width" value="{{$orderview[0]->shipping_width}}">
                            </div>
                            <div class="position-relative mt-3">
                                <label for="height" class="form-label">Height (CM)</label>
                                <input type="text" class="form-control" id="height" name="height" value="{{$orderview[0]->shipping_height}}">
                            </div>
                            <div class="position-relative mt-3">
                                <label for="weight" class="form-label">Weight (KG)</label>
                                <input type="weight" class="form-control" id="weight" name="weight" value="{{$orderview[0]->shipping_weight}}">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="main-card mt-3 card">
                                <div class="card-body">
                                    <h5>Shipping Agency</h5>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="position-relative mt-4 shipping-agency-radio">
                                                <input type="radio" class="form-check-input" id="dtdcradio" value="dtdc" name="shipping_agency" {{$orderview[0]->shipping_agency == "dtdc" ? "checked='checked'" : ""}}>
                                                <label for="dtdcradio" class="form-check-label">DTDC</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mt-3">
                                                <select id="service_type_id" name="service_type_id" class="mb-2 form-control">
                                                    <option>--Select Service Type--</option>
                                                    @foreach($service as $type)
                                                    <option {{$orderview[0]->shipping_service == $type->service_type ? "selected='selected'" : ""}} value="{{$type->service_type}}">{{$type->service_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative mt-3">
                                                <button type="button" class="mb-2 mr-2 btn-square btn-hover-shine btn btn-primary" id="waybillno">Generate Waybill No</button>
                                                
                                                <a target="_blank" href="{{(env('APP_ENV') == "production" ? url('/public' . $orderview[0]->shipping_label) : url('' . $orderview[0]->shipping_label))}}" width="50" alt="{{$orderdetail->productname}}" class="mb-2 mr-2 btn-square btn-hover-shine btn btn-primary" id="download-label">Download label</a>

                                                @if(!empty($orderview[0]->invoice_number))
                                                <a target="_blank"  download 
                                                href="{{url('/public/backend/invoices/'.   $orderview[0]->invoice_number  . '.pdf') }}"
                                                 width="50" alt="{{$orderdetail->productname}}" class="mb-2 mr-2 btn-square btn-hover-shine btn btn-primary" id="download-label">Download Invoice</a>
                                                 @endif
												<button type="button" class="mb-2 mr-2 btn-square btn-hover-shine btn btn-primary" id="cancelwaybillno">Cancel</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-4">
                                            <div class="position-relative mt-3">
                                                <label for="carriername" class="form-label">Courier Name</label>
                                                <input type="text" class="form-control" id="carriername" name="carriername" value="{{$orderview[0]->shipping_carrier_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mt-3">
                                                <label for="trackingno" class="form-label">Tracking No</label>
                                                <input type="text" class="form-control" id="trackingno" name="trackingno" value="{{$orderview[0]->shipping_tracking_no}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative mt-3">
                                                <label for="shippingdate" class="form-label">Shipping Date</label>
                                                <input type="date" class="form-control" id="shippingdate" name="shippingdate" value="{{$orderview[0]->shipping_date}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative mt-3">
                                                <label for="trackingurl" class="form-label">Tracking URL</label>
                                                <input type="text" class="form-control" id="trackingurl" name="trackingurl" value="{{$orderview[0]->shipping_tracking_url}}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <h4>NOTIFICATION</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <input type="checkbox" checked class="form-check-input" id="notifyemail" name="notifyemail">
                        <label for="notifyemail" class="form-check-label">Notify customer by email</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <input type="checkbox" checked class="form-check-input" id="notifysms" name="notifysms">
                        <label for="notifysms" class="form-check-label">Notify customer by SMS</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-card mt-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <h4>TENTATIVE DATE</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <input type="date" class="form-control" id="dispatchdate" name="dispatchdate">
                        <label for="dispatchdate" class="form-label">Tentative Dispatch Date</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mt-3">
                        <input type="date" class="form-control" id="deliverydate" name="deliverydate">
                        <label for="deliverydate" class="form-label">Tentative Delivery Date</label>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <hr>
                <div class="col-md-12">
                    <h4>Remarks</h4>
                    <div class="position-relative mt-3">
                        <label for="remarks" class="form-label">Remarks will be visible to admin only</label>
                        <textarea class="form-control" id="remarks" rows="5" name="remarks"></textarea>
                    </div>
                </div>
            </div>
            <button class="mt-1 mb-3 btn btn-primary"> <i class="fa fa-check"></i> Update</button>
        </div>
    </div>
</form>
@endsection
@push('javascripts')
<script>
    @if(is_null($orderview[0]->shipping_reference_no) || strlen($orderview[0]->shipping_reference_no) == 0)
    $('#dtdcdiv').hide();
    $('#cancelwaybillno').hide();
    $('#download-label').hide();
    @else
    $('#waybillno').hide();
    @endif
    $('#deliverystatus').change(function() {
        var value = parseInt($(this).find("option:selected").attr('data-value'));
        if (isNaN(value)) {
            return false;
        }
        if (value == 3 || value == 4) {
            $('#dtdcdiv').show();
        } else {
            $('#dtdcdiv').hide();
        }
    });
    $('#deliverystatus').trigger('change');
    $(document).on('click', '#waybillno', function() {
        $('#waybillno').attr('disabled', true);
        var customercode = $('#customer_code').val();
        var serviceType = $('#service_type_id').val();
        var loadType = $('load_type').val();
        var orderID = $('#orderID').val();
        var length = $('#length').val();
        var width = $('#width').val();
        var height = $('#height').val();
        var weight = $('#weight').val();
        var agency = $('input[type="radio"][name="shipping_agency"]:checked').val();
        $.ajax({
            type: 'post',
            url: '/sellers/generate-waybill-reference-number',
            data: {
                _token: $('#defaultcsrftoken').val(),
                customercode: customercode,
                serviceType: serviceType,
                loadType: loadType,
                orderID: orderID,
                length: length,
                width: width,
                height: height,
                weight: weight,
                agency: agency
            },
            success: function(result) {
                if (result.status == true) {
                    toastr["success"](result.message);
                    $('#cancelwaybillno').show();
                    $('#cancelwaybillno').attr('disabled', false);
                    $('#waybillno').hide();
                    $('#download-label').attr("href", result.pathfile);
                    $('#download-label').show();
                    $('#carriername').val(result.courier_partner);
                    $('#trackingno').val(result.courier_partner_reference_number);
                    var date = new Date();
                    var year = date.getFullYear();
                    var month = (date.getMonth() + 1) > 10 ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1));
                    var day = date.getDate() > 10 ? date.getDate() : ('0' + date.getDate());
                    $('#shippingdate').val(year + '-' + month + '-' + day);
                    $('#trackingurl').val(result.shpping_tracking_url);
                } else {
                    toastr["error"](result.message);
                    $('#waybillno').attr('disabled', false);
                }
            }
        });
    });
    $('#cancelwaybillno').click(function() {
        if (confirm("Do you really want to cancel this airway bill?")) {
            $('#cancelwaybillno').attr('disabled', true);
            $.ajax({
                type: 'post',
                url: '/sellers/cancelled-waybill-reference-number',
                data: {
                    _token: $('#defaultcsrftoken').val(),
                    awbno: "{{$orderview[0]->shipping_tracking_no}}",
                    order_id: $('#orderID').val()
                },
                success: function(result) {
                    if (result.status == true) {
                        toastr["success"](result.message);
                        $('#cancelwaybillno').hide();
                        $('#waybillno').attr('disabled', false);
                        $('#waybillno').show();
                        $('#download-label').attr("href", "");
                        $('#download-label').hide();
                        $('#carriername').val('');
                        $('#trackingno').val('');
                        $('#shippingdate').val('');
                        $('#trackingurl').val('');
                    } else {
                        toastr["error"](result.message);
                        $('#cancelwaybillno').attr('disabled', false);
                    }
                }
            });
        }
    });
</script>
@endpush