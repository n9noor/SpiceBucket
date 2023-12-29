<div class="row">
    <div>
        <a href="javascript:void(0)" id="backToOrders" class="btn btn-danger btn-sm ml-2">Bact To Orders</a>
    </div>

    <div class="col-md-12">
        <div class="tab-content account dashboard-content">
            <div id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab" class="tab-pane fade active show">
                <div class="card">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Order ID: {{$orderdetails[0]->orderid}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="customer-order-detail">
                                <div class="row">
                                    <div class="col-auto me-auto">
                                        <div class="order-slogan"><img width="100" src="/assets/imgs/theme/logo-color.png" alt="Nest - Laravel Multipurpose eCommerce Script"> <br></div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="order-meta"><span class="d-inline-block">Time:</span> <strong class="order-detail-value">{{date('d/M/Y h:i A', strtotime($orderdetails[0]->order_datetime))}}</strong></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 border-top pt-2">
                                        <h4>Order information</h4>
                                        <div>
                                            <div><span class="d-inline-block">Order status:</span> <strong class="order-detail-value">{{$orderdetails[0]->order_status}}</strong></div>
                                            <div><span class="d-inline-block">Payment method:</span> <strong class="order-detail-value"> {{ $orderdetails[0]->payment_source == 'cod' ? "Cash on Delivery (COD)" : ucfirst($orderdetails[0]->payment_source) }}</strong></div>
                                            <div><span class="d-inline-block">Payment status:</span> <strong class="order-detail-value"> Pending</strong></div>
                                            <div><span class="d-inline-block">Amount:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i> {{$orderdetails[0]->total_amount}}</strong></div>
                                            <div><span class="d-inline-block">Tax:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i> {{$orderdetails[0]->gst_on_amount}}</strong></div>
                                            <div><span class="d-inline-block">Discount:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"> {{$orderdetails[0]->discount}}</i>
                                                </strong></div>
                                            <div><span class="d-inline-block">Shipping fee:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i>{{$orderdetails[0]->delivery_fee}} </strong></div>
                                            @if($orderdetails[0]->cod_charges > 0)
                                            <div><span class="d-inline-block">COD Charges:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i>{{$orderdetails[0]->cod_charges}} </strong></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 border-top pt-2 text-end">
                                        <h4>Customer</h4>
                                        <div>
                                            <div><span class="d-inline-block">Full Name:</span> <strong class="order-detail-value">{{$orderdetails[0]->firstname}} {{$orderdetails[0]->lastname}}</strong></div>
                                            <div><span class="d-inline-block">Phone:</span> <strong class="order-detail-value">{{$orderdetails[0]->phonenumber}} </strong></div>
                                            <div><span class="d-inline-block">Email:</span> <strong class="order-detail-value">{{$orderdetails[0]->emailid}}</strong></div>
                                            <div class="row">
                                                <div class="col-12"><span class="d-inline-block">Billing Address:</span> <span class="order-detail-value">{{$orderdetails[0]->billingAddress}} </span><br>
                                                    <span class="d-inline-block">Shipping Address:</span> <span class="order-detail-value">{{$orderdetails[0]->shippingAddress}} </span>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="mt-3 mb-1">Products</h4>
                                    <div class="table-responsive">
                                        @foreach($vendors as $aliasname => $orderdetail)
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4>Seller: <a href="/brand/{{$orderdetail['storeslug']}}">{{$aliasname}}</a></h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-auto me-auto text-end mb-3" id="trackorder"><a href="javascript:void(0)" class="btn btn-info btn-sm">Track</a></div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Product</th>
                                                    <th>Amount</th>
                                                    <th>GST</th>
                                                    <th style="width: 100px;">Quantity</th>
                                                    <th class="price text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $counter=1; @endphp
                                                @foreach($orderdetail['child'] as $vendor)
                                                <tr>
                                                    <td class="align-middle">{{$counter}}</td>
                                                    <td class="align-middle"><img src="{{(env('APP_ENV') == "production" ? url('/public/images/products/' . $vendor['image']) : url('/images/products/' . $vendor['image']))}}" width="50" alt="{{$vendor['productname']}}"></td>
                                                    <td class="align-middle">
                                                        {{$vendor['productname']}}
                                                        <p><small>
                                                                @if(!is_null($vendor['variantname1']) && !is_null($vendor['variantvalue1']))
                                                                {{$vendor['variantname1']}}: {{$vendor['variantvalue1']}}
                                                                @endif
                                                                @if(!is_null($vendor['variantname2']) && !is_null($vendor['variantvalue2']))
                                                                {{$vendor['variantname2']}}: {{$vendor['variantvalue2']}}
                                                                @endif
                                                                @if(!is_null($vendor['variantname3']) && !is_null($vendor['variantvalue3']))
                                                                {{$vendor['variantname3']}}: {{$vendor['variantvalue3']}}
                                                                @endif
                                                    </td>
                                                    <td class="align-middle text-end"><i class="fa fa-rupee-sign"></i> {{$vendor['subtotal']}}</td>
                                                    <td class="align-middle text-end"><i class="fa fa-rupee-sign"></i> {{$vendor['totalgst']}}</td>
                                                    <td class="align-middle text-center">{{$vendor['perproductquantity'] }}</td>
                                                    <td class="text-end align-middle"><i class="fa fa-rupee-sign"></i> <strong>{{$vendor['totalamount']}}</strong></td>
                                                </tr>
                                                @php $counter++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>

                                        @endforeach
                                    </div> <br>
                                    <h5>Shipping Information:</h5>
                                    <p><span class="d-inline-block">Shipping Status</span>: <strong class="d-inline-block text-info"><span class="label-warning status-label">Pending</span></strong></p>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
