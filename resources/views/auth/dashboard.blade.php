@extends('layout')
@section('content')

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-20 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link backToOrders" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab"  aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
									
									
									
									<li class="nav-item">
                                        <a class="nav-link" id="wallet-tab" data-bs-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="true">
										<i class="fi fi-rs-wallet"></i><strong>Wallet</strong></a>
                                    </li>
									
									
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/logout"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            @if(Session::has('success'))
                            <h3 class="alert alert-success">{{ Session::get('success') }}</h3>
                            <p class="alert alert-success">{{ Session::get('subsuccess') }}</p>
                            @endif
                            <div class="tab-content account dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Hello, {{ Session::get('customer-loggedin-name') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                                manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                            </p>

                                            <style>
                                                #myChart {
                                                    height: 100%;
                                                    width: 100%;
                                                    min-height: 150px;
                                                }

                                                .zc-ref {
                                                    display: none;
                                                }
                                            </style>

                                            <!--<div id='myChart'></div>-->

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card" id="totalOrders">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead style="text-align: center;">
                                                        <tr>
                                                            <th nowrap="">Order ID</th>
                                                            <th nowrap="">Date</th>
                                                            <th nowrap="">Status</th>
                                                            <th nowrap="">Total</th>
                                                            <th nowrap="">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center;">
                                                        @foreach ($orders as $order)
                                                        <tr>
                                                            <td nowrap="" >{{ $order->orderid }}</td>
                                                            <td nowrap="" >{{date('d/M/Y h:i A', strtotime($order->created_at)) }}
                                                            </td>
                                                            <td nowrap="">{{ strtolower($order->order_status) == 'cancel' ? 'Cancelled' : ucwords($order->order_status) }}</td>
                                                            <td nowrap=""><i class="fa fa-rupee-sign"></i> {{ $order->total_amount }}</td>
                                                            <td nowrap=""><a href="javascript:void(0)" onclick="getInvoiceDetail({{$order->id}})" class="btn-small d-block">View</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invoceDiv">
                                    </div>
                                </div>
								<!------------------Mywallet------->
								<div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                                    <!-- <div class="row">
                                       
                                       <div class="col-lg-6 dashboard-address-item  is-address-default ">
                                            <div class="card h-100 mb-3 mb-lg-0 mb-2">
                                                <div class="card-header">
                                                   
                                                  
                                                    </div>
                                                <div class="card-body">
                                                    <address>
													
                                                       MYwallet<br /> 
                                                       Amount - <?php //echo $walletdetail;?><br />
                                                
                                                    </address>
                                                
                                                </div>
                                                <div class="card-footer border-top-0">
                                                    <div class="row">
                          <div class="col-auto me-auto">
						  <a href="javascript:void(0)"  onclick="insertDataButton" class="edit-address-info"><i class="fas fa-edit"></i> 
						  
						  Add Wallet Amount</a>
						</div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-12 m-2">
										<a href="javascript:void(0)" type="button" id="Add_wallet" class="add-address"><i class="fa fa-plus"></i> <span>
										Add Wallet</span></a></div>
                                    </div>-->
									
									<div class="card-body" style="margin-top:-80px;">
                                            <form  name="wallet" id="wallet" method="POST" action="razorpaypaymentwallet"  enctype="multipart/form-data">
                                                @csrf  
                                                <div class="row">
                                                 <div class="form-group col-md-12"> 
                                                  <label>Wallet Amount<span class="required"></span></label>
                                   <input required="" class="form-control" name="Wallet_amount" readonly="readonly" id="Wallet_amount" type="text" value="<?php echo $walletdetail;?>" /></div>
								   <input class="form-control" name="userid" id="userid" type="hidden" value="<?php echo session('customer-loggedin-id');?>" />
								    <input class="form-control" name="email" id="email" type="text" value="<?php echo session('customer-loggedin-email');?>" />
									<input class="form-control" name="phone" id="phone" type="text" value="<?php echo session('customer-loggedin-phone');?>" />
									<input class="form-control" name="Name" id="Name" type="text" value="<?php echo "Madhav";?>"  />
									<input class="form-control" name="logo" id="logo" type="text" value="https://spicebucket.com/assets/imgs/logoSB.png" />
									
								   
								   <input class="form-control" name="currency" id="currency" type="hidden" value="<?php echo 'INR';?>" />
								   <input class="form-control" name="company_name" id="company_name" type="hidden" value="<?php echo 'spicebucket';?>" />
								  
                                          <div class="col-md-12">
      <!-- <button type="button" class="btn btn-fill-out submit font-weight-bold" name="Add_wallet2" id="Add_wallet2" 
	   onclick="Addwallet('<?php //echo $walletdetail;?>','<?php //echo session('customer-loggedin-id');?>');"  value="Submit">Add Wallet</button>-->
												   <input type="submit" name="submit" id="submit" class="btn btn-fill-out submit font-weight-bold" value="Save"/>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                </div>
								
						<!-----------------END--------------------->

                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        @foreach($addresses as $address)
                                        <div class="col-lg-6 dashboard-address-item  is-address-default ">
                                            <div class="card h-100 mb-3 mb-lg-0 mb-2">
                                                <div class="card-header">
                                                    <h5 class="mb-0">{{$address->firstname}} {{$address->lastname}}
                                                        <small class="badge address-dashboard">{{strtoupper($address->address_type)}}</small>
                                                    </h5>
                                                    @if($address->is_default == 1)
                                                    <small class="badge default-dashboard">DEFAULT</small>
                                                    @else
                                                    <small style="cursor: pointer;" data-id="{{$address->id}}" class="badge  address-mark-as-default">MARK DEFAULT</small>
                                                    @endif
                                                                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        {{$address->address_line_1}}<br />
                                                        {{$address->address_line_2}}<br />
                                                        {{$address->address_line_3}}
                                                    </address>
                                                    <p>City : {{$address->city}}</p>
                                                    <p>State : {{$address->state}}</p>
                                                    <p>Pin Code : {{$address->pincode}}</p>
                                                    <p>Country : {{$address->country}}</p>
                                                </div>
                                                <div class="card-footer border-top-0">
                                                    <div class="row">
                                                        <div class="col-auto me-auto"><a href="javascript:void(0)" onclick="editAddress({{$address->id}})" class="edit-address-info"><i class="fas fa-edit"></i> Edit</a></div>
                                                        <div class="col-auto"><a href="javascript:void(0)" onclick="removeAddress({{$address->id}})" class="text-danger btn-trigger-delete-address removeAddress"><i class="fas fa-trash-alt"></i> Remove</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach   
                                        <div class="col-12 m-2"><a href="javascript:void(0)" type="button" id="new-address" class="add-address"><i class="fa fa-plus"></i> <span>Add a new address</span></a></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javascript:void(0)" name="enq">
                                                @php $name = !is_null($customer->name) ? $customer->name : ' ';
                                                list($firstName, $lastName) = explode(' ', $name); @endphp
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>First Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="first_name" id="first_name" type="text" value="{{$firstName}}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Last Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="last_name" id="last_name" value="{{$lastName}}" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Phone<span class="required">*</span></label>
                                                        <input required="" class="form-control" name="phone" id="phone" type="text" value="{{$customer->phone}}" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email" id="email" type="email" value="{{$customer->emailid}}" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-fill-out submit font-weight-bold" name="submit" id="update-customer-details" value="Submit">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
<script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>
@endpush
@push('javascript')

<script>
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
    window.feed = function(callback) {
        var tick = {};
        tick.plot0 = Math.ceil(350 + (Math.random() * 500));
        callback(JSON.stringify(tick));
    };

    var myConfig = {
        type: "gauge",
        globals: {
            fontSize: 25
        },
        plotarea: {
            marginTop: 80
        },
        tooltip: {
            borderRadius: 5
        },
        scaleR: {
            aperture: 270,
            minValue: 0,
            maxValue: {{$maxValue}},
            center: {
                visible: false
            },
            tick: {
                visible: false
            },
            labels: @json($rewards),
            ring: {
                size: 50,
                rules: [{
                        rule: '%v >= 0 ',
                        backgroundColor: '#e3273A'
                    },
                ]
            }
        },
       
        series: [{
            values: [{{ $rewardhistory }}], 
            backgroundColor: 'black',
            animation: {
                effect: 2,
                method: 1,
                sequence: 4,
                speed: 100
            },
        }]
    };

    zingchart.render({
        id: 'myChart',
        data: myConfig,
        height: 500,
        width: '100%'
    });

    $(document).on('click', 'small.address-mark-as-default', function() {
        var id = $(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '/update-default-address',
            data: {
                id: id
            },
            success: function() {
                getAddresses();
            }
        });
    });



       // $('#Add_wallet').click(function() {
		function Addwallet(e,d) { 
		 var Wallet_amount  = $("#Wallet_amount").val();
		 var userid = $("#userid").val();
		 var formdata = $('#wallet').serialize();
		 alert(e);
		 alert(d);
		 
          $.ajax({
                url: '/paymentwalletcodtest',
                type: 'get',
                data: {amount : e,userid : d},
						
                success: function(response) {
                    console.log(response.message);
                    
                },
                error: function(error) {
                    console.error('Error:', error);
                   
                }
            });
     
	}

</script>
@endpush