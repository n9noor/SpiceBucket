@extends('layout')

@section('content')

<main class="main">

    <div class="page-header breadcrumb-wrap">

        <div class="container">

            <div class="breadcrumb">

                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                <span></span> Checkout

            </div>

        </div>

    </div>

    <div class="container mb-80 mt-10 checkout-page">

        <div class="row">

            <div class="col-lg-8 mb-10">

                <!--<h3 class="heading-2 mb-10">Checkout</h3>-->

                <div class="d-flex justify-content-between bg-light-msg">

                    <h6 class="text-body">There are <span class="text-brand">{{ count(array_keys(Session::get('customer-cart'))) }}</span> products in your cart, Please Proceed checkout this page with these sellers:</h6>

                </div>

            </div>

            <!--<div class="col-lg-4 mt-10">

                <button style="background-color: #f52136;line-height: 25px; border-radius: 5px; border-color: #f52136; padding: 0 15px; font-family: 'Inter', sans-serif; font-size: 16px; color: #fff; float:right;" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Back</button>

            </div>-->

        </div>

        <form id="razorpay-payment-frm" action="/razorpaypayment" method="post">

            <input type="hidden" name="customer_address_id" id="customer-address-id" value="0" />

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <div class="row">

                <div class="col-lg-9 col-md-12">

                    <div id="cart-item" class="position-relative">

                        <div class="payment-info-loading" style="display: none;">

                            <div class="payment-info-loading-content">

                                <i class="fas fa-spinner fa-spin"></i>

                            </div>

                        </div>

                        <!--<div class="bg-light p-2">

                            <p class="font-weight-bold mb-0">Please Proceed checkout this page with these sellers:</p>

                        </div>-->

                        <div class="checkout-products-marketplace" id="shipping-method-wrapper">

                            <div class="row">

                                @php $carttotalsubprice = $carttotalgstprice = $carttotalprice = 0;
									
								 	$shippingforbrand = array(); @endphp

                                @foreach ($customercart as $store_name => $cart)

                                <div class="col-md-12">
                                    <div class="check-container">
                                        <div class="bg-light">

                                            <div class="check-head">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-3 pr0">
                                                        <div class="seller-logo-check">
                                                            <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $cart['vendor_image']) : url('/images/vendors/' . $cart['vendor_image']) }}" alt="{{!is_null($cart['vendor_alias']) && !empty($cart['vendor_alias']) ? $cart['vendor_alias'] : $store_name }}" class="img-fluid rounded" width="30">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-xs-4 pr0">
                                                        <div class="seller-name-check">
                                                            <span class="font-weight-bold"> {{!is_null($cart['vendor_alias']) && !empty($cart['vendor_alias']) ? $cart['vendor_alias'] : $store_name }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7 col-xs-5">
                                                        <div class="seller-trating-check">
                                                            <div class="rating_wrap">

                                                                <div class="rating">

                                                                    <div class="product_rate" style="width: 80%"></div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-3 cart-lists">

                                                @php $vendortotalsubprice = $vendortotalgstprice = $vendortotalprice = 0;
												 	$shippingbasepriceforBrand = array();
												  	$netpriceforBrand = array(); 
												 @endphp

                                                @foreach ($cart['child'] as $product)

                                                <div class="row cart-item">

                                                    <div class="col-2">

                                                        <div class="checkout-product-img-wrapper">

                                                            <img class="item-thumb img-thumbnail img-rounded" src="{{ env('APP_ENV') == 'production' ? url('/public/images/products/' . $product['image']) : url('/images/products/' . $product['image']) }}" alt="{{ $product['title'] }}">

                                                            <span class="checkout-quantity">{{ $product['quantity'] }}</span>

                                                        </div>

                                                    </div>

                                                    <div class="col-5">

                                                        <p class="mb-0">{{ $product['title'] }}</p>

                                                        <p class="mb-0">

                                                            <small>{{ $product['variant'] }}</small>

                                                        </p>

                                                    </div>

                                                    <div class="col-4 text-end">

                                                        <p><i class="fa fa-rupee-sign"></i> {{ $product['price'] }}

                                                        </p>

                                                    </div>

                                                </div>

                                                @php

                                                $vendortotalsubprice += $product['price'] * $product['quantity'];

                                                $vendortotalgstprice += $product['gst_amount'] * $product['quantity'];

                                                $vendortotalprice = $vendortotalsubprice + $vendortotalgstprice;

                                                if(!array_key_exists($cart['storeid'], $netpriceforBrand)){

                                                $netpriceforBrand[$cart['storeid']] = 0;

                                                }

                                                $netpriceforBrand[$cart['storeid']] += $product['price'] * $product['quantity'];

                                                if(!array_key_exists($cart['storeid'], $shippingbasepriceforBrand)){

                                                $shippingbasepriceforBrand[$cart['storeid']] = $cart['shippingGstAmount'];

                                                }

                                                @endphp

                                                @endforeach

                                            </div>

                                            <div class="row px-3">

                                                <div class="col-6">



                                                    <div class="address-sec">
                                                        <h4>Billing Address</h4>
                                                        <div class='form-group'>

                                                            <select class="form-control" id="address-billing-{{ $cart['storeid'] }}" name="address[billing][{{ $cart['storeid'] }}]">

                                                                @foreach ($addresses as $address)

                                                                <option data-format="<p class='mb-0'><small>{{ $address->firstname }} {{ $address->lastname }} </br>{{ $address->address_line_1 }} {{ $address->address_line_2 }} {{ $address->address_line_3 }} {{ $address->city }}, {{ $address->state }}-{{ $address->pincode }}, {{ $address->country }}</p>" value='{{ $address->id }}'>

                                                                    {{ ucfirst($address->address_type) }}

                                                                </option>

                                                                @endforeach

                                                                <optgroup label="---------------------------------------------------------">

                                                                    <option data-format="" value="0">Add New Address</option>

                                                                </optgroup>

                                                            </select>

                                                        </div>

                                                        <div id='address-billing-{{ $cart['storeid'] }}-fulladdress'>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="address-sec">
                                                        <h4>Shipping Address | <span class="change-your-address blink_text">Change Address</span></h4>

                                                        <div class='form-group'>

                                                            <select data-vendor-shipping-pincode="{{$cart['vendor_shipping_pincode']}}" class="form-control" id="address-shipping-{{ $cart['storeid'] }}" name="address[shipping][{{ $cart['storeid'] }}]">

                                                                @foreach ($addresses as $address)

                                                                <option data-pincode="{{$address->pincode}}" data-format="<p class='mb-0'><small>{{ $address->firstname }} {{ $address->lastname }} <br />{{ $address->address_line_1 }} {{ $address->address_line_2 }} {{ $address->address_line_3 }} {{ $address->city }}, {{ $address->state }}-{{ $address->pincode }}, {{ $address->country }}</small></p>" value='{{ $address->id }}'>

                                                                    {{ ucfirst($address->address_type) }}

                                                                </option>

                                                                @endforeach

                                                                <optgroup label="---------------------------------------------------------">

                                                                    <option data-format="" value="0">Add New Address</option>

                                                                </optgroup>

                                                            </select>

                                                        </div>

                                                        <div id='address-shipping-{{ $cart['storeid'] }}-fulladdress'>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        @php 
											
											
										if($vendortotalprice >= 499){

                                        $vendortotalshippingprice = 0;

                                        }else if($vendortotalprice <=149){ $vendortotalshippingprice=50; }
										else if($vendortotalprice <=349 && $vendortotalprice> 149){
												$vendortotalshippingprice = 70;

                                            }else if($vendortotalprice <=498 && $vendortotalprice> 349){

                                                		$vendortotalshippingprice = 100;
													}

                                                $baseshippingprice = round(($vendortotalshippingprice * 100) / (100 + $shippingbasepriceforBrand[$cart['storeid']]), 2);

                                                $gstshippingprice = round(($vendortotalshippingprice - $baseshippingprice), 2);

                                                array_push($shippingforbrand, array('shippingprice' => $vendortotalshippingprice, 'baseshippingprice' => $baseshippingprice, 'gstshippingprice' => $gstshippingprice)); @endphp

                                                <div class="p-3 chek-single-cal">

                                                    <div class="row">

                                                        <div class="col-6">

                                                            <p>Subtotal:</p>

                                                        </div>

                                                        <div class="col-6 text-end">

                                                            <p class="price-text sub-total-text text-end"><i class="fa fa-rupee-sign"></i>

                                                                {{ number_format($vendortotalsubprice, 2) }}

                                                            </p>

                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">

                                                        <div class="col-6">

                                                            <p>Tax:</p>

                                                        </div>

                                                        <div class="col-6 text-end">

                                                            <p class="price-text tax-price-text"><i class="fa fa-rupee-sign"></i>

                                                                {{ number_format(($vendortotalgstprice + $gstshippingprice), 2) }}

                                                            </p>

                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">

                                                        <div class="col-6">

                                                            <p>COD:</p>

                                                        </div>

                                                        <div class="col-6 text-end">

                                                            <p class="price-text cod-price-text"><i class="fa fa-rupee-sign"></i>



                                                            </p>

                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">

                                                        <div class="col-6">

                                                            <p>Shipping Fee:</p>

                                                        </div>

                                                        <div class="col-6 text-end">

                                                            <p class="price-text tax-price-text"><i class="fa fa-rupee-sign"></i>

                                                                {{ number_format($baseshippingprice, 2) }}

                                                            </p>

                                                            <input type="hidden" name="delivery_fee[{{$cart['storeid']}}]" id="delivery-fee-{{$cart['storeid']}}" value="{{$vendortotalshippingprice}}" />

                                                        </div>

                                                    </div>
                                                    <hr>
													
													<!-------------- MYcod ----------->
													@php
													
															$carttotalprice = $carttotalprice;
															$wallet_amount = $wallet_amount;
															$shipping_total = array_sum(array_column($shippingforbrand, 'shippingprice'));
															$total = $carttotalprice + $wallet_amount + $shipping_total;
													
															 
														if(isset($wallet_amount) && $wallet_amount > 0) 
																if ($wallet_amount <= $total) 
																  $total = $total - $wallet_amount;
															 else 
																	 $total = number_format($total, 2);
															
															
														  @endphp
												<!-------------- END ----------->
													
                                                    <div class="row">

                                                        <div class="col-6">

                                                            <p>Total:</p>

                                                        </div>

                                                        <div class="col-6 float-end">

                                                            <p class="total-text raw-total-text mb-0 vendor-amount-text" id="walletaddon_406" data-price="{{ $vendortotalprice + $vendortotalshippingprice + $total}}"><i class="fa fa-rupee-sign"></i>

                                                                <span>{{ number_format(($vendortotalprice + $vendortotalshippingprice + $total), 2) }}</span>

                                                            </p>

                                                        </div>

                                                    </div>

                                                </div>
                                    </div>
                                </div>

                                @php

                                $carttotalsubprice += $vendortotalsubprice;

                                $carttotalgstprice += $vendortotalgstprice;

                                $carttotalprice += $vendortotalprice;


                                @endphp

                                @endforeach

															
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-12">

                    <div class="checkout-right sticky">

                        <div class="mt-2 mb-5">

                            <div class="checkout-discount-section"><a href="#" class="btn-open-coupon-form">Have you a Coupon Code?</a></div>

                            <div class="coupon-wrapper">

                                <div class="row promo coupon coupon-section">

                                    <div class="col-lg-8 col-md-8 col-8 pl0">

                                        <input type="text" name="coupon_code" class="form-control coupon-code input-md checkout-input" id="coupon-code-text" placeholder="Enter coupon code...">

                                        <div class="coupon-error-msg">

                                            <span class="text-danger"></span>

                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-4 col-4 pr0 pl0 text-end apply-remove-btn-class">

                                        <input type="hidden" name="coupon_id" id="coupon_id" value="0" />

                                        <button class="btn btn-md btn-gray btn-info apply-coupon-code float-end" id="discount-coupon-code" type="button" style="margin-top: 0;padding: 10px 20px;"><i class="fa fa-gift"></i>

                                            Apply</button>

                                        <button class="btn btn-md btn-gray btn-info remove-coupon-code float-end" id="remove-discount-coupon-code" type="button" style="margin-top: 0;padding: 10px 20px;"><i class="fa fa-trash"></i>Remove</button>

                                    </div>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                        </div>

                        <div class="coupon">

                            <div class="coupon-block">

                                <h3>Available Coupons</h3>

                            </div>

                            <div class="coupon-block-list">

                                <ul>

                                    @foreach($coupons as $coupon)

                                    <li class="coupon-list" title="Apply">

                                        <div class="co-code"><span class="promo">{{$coupon->coupon_code}}</span><a class="apply-btn" data-coupon="{{$coupon->coupon_code}}" href="javascript:void(0);">Apply</a></div>

                                        <div class="coupon-detail"> <a href="javascript:void(0)" data-description='{!! $coupon->coupon_description !!}'> Coupon Detail</a></div>

                                        <!--<p class="expire">Expires: {{date('M d, Y', strtotime($coupon->end_datetime))}}</p>-->

                                    </li>

                                    <!--<li data-coupon="{{$coupon->coupon_code}}">

                                    <p>{{$coupon->title}} Use Promo Code: <a href="javascript:void(0);"><span title="Apply" class="promo">{{$coupon->coupon_code}}</span></a></p>

                                    <p class="expire">Expires: {{date('M d, Y', strtotime($coupon->end_datetime))}}</p>

                                </li>-->

                                    @endforeach

                                </ul>

                            </div>

                        </div>
                        <hr>
                        <div class="mt-2 p-2 chek-single-cal">

                            <div class="row horizontal-row">

                                <div class="col-8">

                                    <p>Subtotal:</p>

                                </div>

                                <div class="col-4 pl0">

                                    <p class="price-text sub-total-text" id="cartsubtotalprice" data-price="{{$carttotalsubprice}}"><i class="fa fa-rupee-sign"></i>

                                        {{ number_format($carttotalsubprice, 2) }}

                                        <input type="hidden" id="cartTotlaPriceForPoints" name="cartTotlaPriceForPoints" value="{{ number_format($carttotalsubprice, 2) }}" />

                                    </p>

                                </div>

                            </div>



                            <div class="row horizontal-row">

                                <div class="col-8">

                                    <p>Shipping fee:</p>

                                </div>

                                <div class="col-4 pl0">

                                    <p class="price-text shipping-price-text"><i class="fa fa-rupee-sign"></i> {{number_format(array_sum(array_column($shippingforbrand, 'baseshippingprice')), 2)}}</p>

                                </div>

                            </div>



                            <div class="row horizontal-row">

                                <div class="col-8">

                                    <p>Tax:</p>

                                </div>

                                <div class="col-4 pl0">

                                    <p class="price-text tax-price-text"><i class="fa fa-rupee-sign"></i>

                                        {{ number_format($carttotalgstprice + array_sum(array_column($shippingforbrand, 'gstshippingprice')), 2) }}



                                    </p>

                                </div>

                            </div>

                            <div class="row horizontal-row" id="copoun-change-div">

                                <div class="col-8">

                                    <p>Discount:</p>

                                </div>

                                <div class="col-4 pl0">

                                    <p class="price-text tax-price-text coupon-discount-text">(-) <i class="fa fa-rupee-sign"></i>

                                    </p>

                                </div>

                            </div>



                            <div class="row horizontal-row" id="cod-charge-div">

                                <div class="col-8">

                                    <p>COD Charges:</p>

                                </div>

                                <div class="col-4 pl0">

                                    <p class="price-text cod-charges-text"><i class="fa fa-rupee-sign"></i>

                                    </p>

                                </div>

                            </div>



                            <div class="row horizontal-row" id="cod-charge-div-discount">

                                <div class="col-8">

                                    <p>COD Waived off:</p>

                                </div>

                                <div class="col-4 pl0">

                                    <p class="price-text cod-charges-text">(-) <i class="fa fa-rupee-sign"></i>

                                    </p>

                                </div>

                            </div>

                            <div class="row horizontal-row">

                                <div class="col-8">

                                    <p><strong>Total</strong>:</p>

                                </div>

                                <div class="col-4 float-end pl0">
										
                                    <p class="total-text raw-total-text cart-total-text" id="walletaddon" data-price="{{ $carttotalprice + $total +  array_sum(array_column($shippingforbrand, 'shippingprice')) }}"><i class="fa fa-rupee-sign"></i> <span>
													<!--<div id="walletaddon"></div>-->
													{{ $carttotalprice + $total + array_sum(array_column($shippingforbrand, 'shippingprice')) }}
												</span> </p>

                                    <input type="hidden" name="totalcartamout" id="totalcartamout" value="{{ $carttotalprice + array_sum(array_column($shippingforbrand, 'shippingprice')) }}" />

                                    <input type="hidden" name="cod_charges" id="cod_charges" value="0" />

                                    <input type="hidden" name="coupon_discount" id="coupon_discount" value="0" />

                                    <input type="hidden" name="total_delivery_fee" id="total_delivery_fee" value="{{ array_sum(array_column($shippingforbrand, 'shippingprice')) }}" />

                                </div>

                            </div>
							
							
							
							<div class="row horizontal-row">

                                <div class="col-8">

                                    <p><strong>Wallet Amount</strong>:</p>

                                </div>

                                <div class="col-4 float-end pl0">
								
										<h4><span id="tots"></span></h4>
										<input type="checkbox" name="something" class="checks" checked="checked" style="height:10px;" data-price="<?php   print_r($wallet_amount);?>">

                                    <p class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-rupee-sign"></i> <span><?php   echo $wallet_amount;?>
									</span> </p>
									<p></p>
							 </div>
							</div>
							

                        </div>
                        <div class="payment mt-10 mb-10">

                            <h4 class="mb-10">Payment</h4>

                            <div class="payment_option">

                                <div class="custome-radio">

                                    <input class="form-check-input" value="cod" required="" type="radio" name="payment_option" id="payment_option_cod" />

                                    <label class="form-check-label" for="payment_option_cod" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>

                                </div>

                                <div class="custome-radio">

                                    <input class="form-check-input" value="online" required="" type="radio" name="payment_option" id="payment_option_online" checked="" />

                                    <label class="form-check-label" for="payment_option_online" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>

                                </div>

                            </div>

                            <div class="payment-logo d-flex">

                                <img class="mr-15" src="assets/imgs/payment-strip.png" alt="">

                                <!--<img class="mr-15" src="assets/imgs/theme/icons/payment-visa.svg" alt="">

                    <img class="mr-15" src="assets/imgs/theme/icons/payment-master.svg" alt="">

                    <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">-->

                            </div>

                            <button id="place-order-btn" type="button" class="btn btn-fill-out btn-block mt-30">Place an

                                Order <i class="fi-rs-sign-out ml-15"></i></button>

                        </div>
                    </div>


                </div>






                <hr>

            </div>



        </form>

    </div>

</main>


<div class="modal fade lg sm" id="coupon-detail-modal" tabindex="-1" aria-labelledby="coupon-detail-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="check-close">
				<i class="fa fa-times btn-close" data-bs-dismiss="modal" aria-hidden="true"></i>
            </div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@push('externaljavascript')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

@endpush



@push('javascript')

<script type="text/javascript">
    document.addEventListener('contextmenu', event => event.preventDefault());

    document.onkeydown = function(e) {

        // disable F12 key

        if (e.keyCode == 123) {

            return false;

        }

        // disable U key

        if (e.ctrlKey && e.keyCode == 85) {

            return false;

        }

    }

    $(document).ready(function() {

        $('.coupon-block-list li .apply-btn').click(function() {

            var couponcode = $(this).attr('data-coupon');

            $('#coupon-code-text').val(couponcode);

            $('#discount-coupon-code').trigger('click');

        });

        $('input[name="payment_option"]').change(function() {
            $('#place-order-btn').prop('disabled', false);
            $('#cod-charge-div').hide();
            $('#cod-charge-div-discount').hide();
            $('.cod-price-text i').parent().parent().parent().hide();
            var value = $('input[name="payment_option"]:checked').val();
             var isDisabled = $('#coupon-code-text').prop('disabled');
            if (value == "cod") {

                
                if(isDisabled== true){
                     alertify.error('You have used the coupon code, it is  not available for COD. Please remove the current coupon or choose another coupon to proceed with COD');
                     $('#payment_option_online').prop('checked', true);
                }else{
                    

                    var totalamount = parseFloat($('.cart-total-text').attr('data-price'));
                    var codcharge = 30;
                    var coupon_discount = parseFloat($('#coupon_discount').val());
                    // if ((totalamount - coupon_discount) <= 1999) {
                    //     codcharge = 30
                    // } else if ((totalamount - coupon_discount) > 1999) {
                    //     var tempval = ((totalamount - coupon_discount) * 1) / 100
                    //     codcharge = tempval;
                    // }
                    totalamount = totalamount - coupon_discount;
                    $('.vendor-amount-text').each(function() {
                        var value = parseInt($(this).attr('data-price'))
                        $(this).find('span').text((value + codcharge).toFixed(2));
                    });
                    $('.cod-price-text i').text(codcharge.toFixed(2));
                    $('#cod_charges').val(0);
                    $('#cod-charge-div .cod-charges-text i').text((codcharge * $('.cod-price-text i').length).toFixed(2));
                    $('#cod-charge-div-discount .cod-charges-text i').text((codcharge * $('.cod-price-text i').length).toFixed(2));
                    $('#totalcartamout').val(totalamount);
                    $('#cod-charge-div .cart-total-text span').text(totalamount.toFixed(2));
                    $('#cod-charge-div-discount .cart-total-text span').text(totalamount.toFixed(2));
                    $('.cod-price-text i').parent().parent().parent().show();
                    $('#cod-charge-div').show();
                    $('#cod-charge-div-discount').show();
                }


                // alertify.confirm("An addition charge will be application for COD. Agree to pay that?", function() {

                //     var totalamount = parseFloat($('.cart-total-text').attr('data-price'));
                //     var codcharge = 30;
                //     var coupon_discount = parseFloat($('#coupon_discount').val());
                //     // if ((totalamount - coupon_discount) <= 1999) {
                //     //     codcharge = 30
                //     // } else if ((totalamount - coupon_discount) > 1999) {
                //     //     var tempval = ((totalamount - coupon_discount) * 1) / 100
                //     //     codcharge = tempval;
                //     // }
                //     totalamount = totalamount - coupon_discount;
                //     $('.vendor-amount-text').each(function() {
                //         var value = parseInt($(this).attr('data-price'))
                //         $(this).find('span').text((value + codcharge).toFixed(2));
                //     });
                //     $('.cod-price-text i').text(codcharge.toFixed(2));
                //     $('#cod_charges').val(0);
                //     $('#cod-charge-div .cod-charges-text i').text((codcharge * $('.cod-price-text i').length).toFixed(2));
                //     $('#cod-charge-div-discount .cod-charges-text i').text((codcharge * $('.cod-price-text i').length).toFixed(2));
                //     $('#totalcartamout').val(totalamount);
                //     $('#cod-charge-div .cart-total-text span').text(totalamount.toFixed(2));
                //     $('#cod-charge-div-discount .cart-total-text span').text(totalamount.toFixed(2));
                //     $('.cod-price-text i').parent().parent().parent().show();
                //     $('#cod-charge-div').show();
                //     $('#cod-charge-div-discount').show();
                // }, function() {
                //     this.checked = false;
                //     $('#payment_option_online').prop('checked', true);
                // });

            } else {
                if(isDisabled== true){
                     alertify.error('You have used the coupon online, it is  not available for Online. Please remove the current coupon or choose another coupon to proceed with Online');
                     $('#payment_option_cod').prop('checked', true);
                }

                var totalamount = parseFloat($('.cart-total-text').attr('data-price'));
                var codcharge = 0;
                var coupon_discount = parseFloat($('#coupon_discount').val());
                totalamount = totalamount + codcharge - coupon_discount;
                $('#cod_charges').val(codcharge);
                $('.cod-charges-text i').text(codcharge.toFixed(2));
                $('#totalcartamout').val(totalamount);
                $('.cart-total-text span').text(totalamount.toFixed(2));
                $('.vendor-amount-text').each(function() {
                    var value = parseInt($(this).attr('data-price'))
                    $(this).find('span').text(value.toFixed(2));
                });
            }

        });

        $('#copoun-change-div').hide();

        $('input[name="payment_option"]:checked').trigger('change');

        $('select[id^="address-billing-"], select[id^="address-shipping-"]').change(function() {

            if ($(this).val() == "0") {

                $('#update-address-modal').modal('show');

            } else {
                var id = $(this).attr('id');
                var html = $(this).find('option:selected').attr('data-format');
                $('#' + id + '-fulladdress').html(html);

                if (id.split("-")[1] == 'shipping') {
                    var destinationPincode = $(this).find('option:selected').attr('data-pincode');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/check-pincode-availablity',
                        data: {
                            originPincode: $(this).attr('data-vendor-shipping-pincode'),
                            destinationPincode: destinationPincode
                        },
                        success: function(result) {
                            if (result.status == false) {
                                alertify.error(result.message);
                            }
                        }
                    });
                }

            }

        });

        $('select[id^="address-billing-"], select[id^="address-shipping-"]').trigger('change');

        //Place order button working

        $('#place-order-btn').click(function(e) {

            $(this).attr('disabled', true);
             setTimeout(function(){
                 
                 $('#place-order-btn').attr('disabled', false);
                
            }, 3000);

            var flag = 0;
            var selected = $('select[id^="address-billing-"]');
            for (var i in selected) {
                if (selected[i].value == 0) {
                    flag = 1;
                    break;
                }
            }
            if (flag == 1) {
                alertify.error("Please select an address for billing.");
                return false;
            }

            var selected = $('select[id^="address-shipping-"]');
            for (var i in selected) {
                if (selected[i].value == 0) {
                    flag = 1;
                    break;
                }
            }
            if (flag == 1) {
                alertify.error("Please select an address for shipping.");
                return false;
            }

            e.preventDefault();

            if ($('input[name="payment_option"]:checked').val() == 'online') {

                $('#razorpay-payment-frm').attr('action', '/razorpaypayment');

                var amount = $('#totalcartamout').val();

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });



                $.ajax({

                    type: 'post',

                    url: 'orderid-generate',

                    data: $('#razorpay-payment-frm').serialize(),

                    success: function(data) {

                        var orderid = '';

                        if (data.orderid) {

                            orderid = data.orderid;

                        }



                        var options = {

                            key: "{{ env('RAZOR_KEY') }}",

                            amount: (amount * 100),

                            currency: 'INR',

                            name: "Spice Bucket",

                            description: "Spice Bucket Payment",

                            image: "{{ asset('images/logo-color.png') }}",

                            order_id: orderid,

                            handler: function(response) {

                                $('#razorpay-payment-frm').append(

                                    "<input type='hidden' name='razorpay_payment_id' id='razorpay_payment_id' value='" +

                                    response.razorpay_payment_id + "' />");

                                $('#razorpay-payment-frm').submit();

                            },

                            prefill: {

                                name: "{{ Session::get('customer-loggedin-name') }}",

                                email: "{{ Session::get('customer-loggedin-email') }}",

                                contact: "{{ Session::get('customer-loggedin-phone') }}"

                            },

                            theme: {

                                color: "#ff7529"

                            }

                        };

                        var rzp1 = new Razorpay(options);

                        rzp1.on('payment.failed', function(response) {



                        });

                        rzp1.open();

                    }

                });

            } else {

                $('#razorpay-payment-frm').attr('action', '/razorpaypaymentcod');

                $('#razorpay-payment-frm').submit();

            }

        });

    });
</script>

<script>
    $(document).off("click", ".coupon-detail a").on("click", ".coupon-detail a", function() {
        $('#coupon-detail-modal .modal-body .row .col-lg-12').html($(this).attr('data-description'));
        $('#coupon-detail-modal').modal('show');
    });
	
	
	$(document).on("click", ".checks", function() {
			  if ($(this).prop('checked') == true) {
				//var price = $(this).attr("data-price"); //price 17.94
				
				var price = "<?php echo $carttotalprice +  array_sum(array_column($shippingforbrand, 'shippingprice'));?>";  // total but without walletamount
				
				var walletAmount = "<?php echo $total;?>";
				var ffp = Number(price) + Number(walletAmount);
				
				$('#walletaddon').text(ffp);
				$('#walletaddon_406').text(ffp);
			  } else if ($(this).prop('checked') == false) {
			  //alert("Second");
				var price = "<?php echo $carttotalprice + $total + array_sum(array_column($shippingforbrand, 'shippingprice'));?>";; // toal amount with wallet amount (113+50)
				
				
				var walletAmount = "<?php echo $total;?>";
				var wallet = Number(walletAmount);
				
				var ffp =   Number(price) - Number(wallet);
				$('#walletaddon').text(ffp);
				$('#walletaddon_406').text(ffp);
			  }
		});
	
</script>

@endpush



@push('externalcss')

<style>
    body {

        font-family: Arial;

    }
</style>

@endpush