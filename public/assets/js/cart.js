$(document).ready(function () {
    showCart();
    $(document).on("click", ".btn-add-to-cart", function () {
        var pid = $(this).data('productid');
        if (typeof (pid) == "undefined") {
            pid = $(this).attr('data-productid');
        }
        $.ajax({
            method: "GET", url: "/mycart", data: { product_id: pid }, success: function (response) {
                if (response.status == true) {
                    //alertify.success(response.message);
                    showCart();
                }
            }, dataType: 'json'
        });
    });

    window.showAlert = (messageType, message) => {
        if (messageType && message !== '') {
            let alertId = Math.floor(Math.random() * 1000);

            let html = `<div class="alert ${messageType} alert-dismissible" id="${alertId}">
            <span class="btn-close" data-bs-dismiss="alert" aria-label="close"></span>
            <i class="fi-rs-` + (messageType === 'alert-success' ? 'check' : 'cross') + ` message-icon"></i>
            ${message}
            </div>`;

            $('#alert-container').append(html).ready(() => {
                window.setTimeout(() => {
                    $(`#alert-container #${alertId}`).remove();
                }, 3000);
            });
        }
    }


    $(document).on("click", ".quick-view-btn-add-to-cart", function () {
        $('#quick-view-modal').find('.quick-view-content').html('');
        $('#quick-view-modal').find('.modal-body').addClass('modal-empty');
        $('#quick-view-modal').find('.loading-spinner').show();
        $('#quick-view-modal').modal('show');

        var pid = $(this).data('product-id');
        if (typeof (pid) == "undefined") {
            pid = $(this).attr('data-productid');
        }

        $.ajax({
            method: "GET", url: "/quickviewProduct", data: { productid: pid }, success: function (response) {
                $('#quick-view-modal').find('.loading-spinner').hide();
                $('#quick-view-modal').find('.modal-body').removeClass('modal-empty');
                $('#quick-view-modal .quick-view-content').html(response.html);

                $('#quick-view-modal').find('.product-image-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rtl: isRTL,
                    arrows: false,
                    fade: false,
                    asNavFor: '.slider-nav-thumbnails',
                });

                $('#quick-view-modal').find('.slider-nav-thumbnails').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    vertical: true,
                    rtl: isRTL,
                    asNavFor: '.product-image-slider',
                    dots: false,
                    focusOnSelect: true
                });

                // Remove active class from all thumbnail slides
                $('#quick-view-modal').find('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

                // Set active class to first thumbnail slides
                $('#quick-view-modal').find('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

                // On before slide change match active thumbnail to current slide
                $('#quick-view-modal').find('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                    let mySlideNumber = nextSlide;
                    $('#quick-view-modal').find('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
                    $('#quick-view-modal').find('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
                });

                $('#quick-view-modal').find('.product-image-slider').magnificPopup({
                    delegate: '.slick-slide:not(.slick-cloned) a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });

                $(window).trigger('resize');

                const minus = $('.quantity__minus');
                const plus = $('.quantity__plus');
                minus.click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr('id').replace("quantity-minus-", "");
                    var value = parseInt($('#quantity-input-' + id).val());
                    if (value > 1) {
                        value--;
                    }
                    $('#quantity-input-' + id).val(value);
                });

                plus.click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr('id').replace("quantity-plus-", "");
                    var value = parseInt($('#quantity-input-' + id).val());
                    value++;
                    $('#quantity-input-' + id).val(value);
                });

                $('#quick-view-modal').modal('show');
                $('.modal-backdrop').css('z-index', '1039');
                $('#quick-view-modal').css('z-index', '1040');

            }, error: function (jqXHR, textStatus, errorThrown) {
                alertify.error(errorThrown);
                $('#quick-view-modal').modal('hide');
            }, dataType: 'json'
        });
    });

    $(document).on('click', '.button-add-to-cart', function () {
        var productid = $('#quickview_productid').val();
        var variantid = $('#product-price-variant-id').val();
        var quantity = $('#quantity-input-' + productid).val();

        if (variantid.length == 0) {
            alertify.error('Please select the variant.');
            return;
        }

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            method: 'post',
            url: '/update-cart',
            data: { productid: productid, variantid: variantid, qty: quantity },
            success: function (result) {
                if (result.status == true) {
                    $('#quick-view-modal').modal('hide');
                    showCart();
                    alertify.success(result.message);
                     
                } else {
                    alertify.error('Cart not updated.');
                }
            },
            dataType: 'json'
        });
    });
	 $(document).on('click', '.qbutton-add-to-cart', function () {
		 
        var productid = $('#qquickview_productid').val();
        var variantid = $('#qproduct-price-variant-id').val();
        var quantity = $('#quantity-input-' + productid).val();
        console.log(productid);
        console.log(variantid);
        console.log(quantity);

        if (variantid.length == 0) {
            alertify.error('Please select the variant.');
            return;
        }

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            method: 'post',
            url: '/update-cart',
            data: { productid: productid, variantid: variantid, qty: quantity },
            success: function (result) {
                if (result.status == true) {
                    $('#quick-view-modal').modal('hide');
                    showCart();
                    alertify.success(result.message);
                     
                } else {
                    alertify.error('Cart not updated.');
                }
            },
            dataType: 'json'
        });
    });
    $(document).on('click', '.buy-now', function () {
        $('.button-add-to-cart').trigger('click');
        setTimeout(function () {
            window.location.href = "/cart";
        }, 1000);
    });
	$(document).on('click', '.qbuy-now', function () {
       // $('.qbutton-add-to-cart').trigger('click');
        setTimeout(function () {
            window.location.href = "/cart";
        }, 1000);
    });
    // Wishlist
    $(document).on("click", ".add-wishlist-btn", function () {
        var pid = $(this).data('product-id');
        if (typeof (pid) == "undefined") {
            pid = $(this).attr('data-product-id');
        }

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        if ($(this).children().hasClass('fi-rs-heart')) {
            $.ajax({
                method: "POST", url: "/wishlist", data: { product_id: pid }, success: function (response) {
                    if (response.status == true) {
                        $('.add-wishlist-btn[data-product-id="' + pid + '"] i').removeClass('fi-rs-heart').addClass('fa fa-heart');
                        alertify.success(response.message);
                        $('.mini-cart-icon-wishlist span').text(response.count);
                    }
                }, dataType: 'json'
            });
        }
        else {
            $.ajax({
                method: "POST", url: "/remove-wishlist", data: { product_id: pid }, success: function (response) {
                    if (response.status == true) {
                        $('.add-wishlist-btn[data-product-id="' + pid + '"] i').removeClass('fa fa-heart').addClass('fi-rs-heart');
                        alertify.success(response.message);
                        $('.mini-cart-icon-wishlist span').text(response.count);
                    }
                }, dataType: 'json'
            });
        }
    });

    $('#remove-discount-coupon-code').hide();
    $(document).on("click", "#discount-coupon-code", function () {
       // $('input[name="payment_option"][value="online"]').prop('checked', true);
       // $('input[name="payment_option"]:checked').trigger('change');
        var couponCodeText = $('#coupon-code-text').val();
        var payment_mode =$('input[name="payment_option"]:checked').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            method: "POST", url: "/verify-coupon", data: { couponCodeText: couponCodeText ,payment_mode:payment_mode}, success: function (response) {
                if (response.status == true) {
                    if (response.discount > 0) {
                        $('#copoun-change-div').show();
                        $('#discount-coupon-code').hide();
                        $('#remove-discount-coupon-code').show();
                        $('#coupon-code-text').attr("disabled", true);
                        var cod_charges = parseFloat($('#cod_charges').val());
                        var totalamount = parseFloat($('.cart-total-text').attr('data-price')) - parseFloat(response.discount) + cod_charges;
                        $('.coupon-discount-text i').text(response.discount.toFixed(2));
                        $('#coupon_discount').val(response.discount);
                        $('#coupon_id').val(response.couponid);
                        $('#totalcartamout').val(totalamount);
                        $('.cart-total-text span').text(totalamount.toFixed(2));
                        alertify.success("Coupon applied successfully");
                    }
                    else {
                        
                         alertify.error("Discount not available");
                          $('#coupon_discount').val(0);
						$('#copoun-change-div').hide();
						$('#remove-discount-coupon-code').hide();
						$('#discount-coupon-code').show();
						$('#coupon-code-text').attr("disabled", false);
						var cod_charges = parseFloat($('#cod_charges').val());
						var totalamount = parseFloat($('.cart-total-text').attr('data-price')) + cod_charges;
						$('#totalcartamout').val(totalamount);
						$('.cart-total-text span').text(totalamount.toFixed(2));
                    }
                }
                else {
                    
                    
                        alertify.error(response.message);
                         $('#coupon_discount').val(0);
						$('#copoun-change-div').hide();
						$('#remove-discount-coupon-code').hide();
						$('#discount-coupon-code').show();
						$('#coupon-code-text').attr("disabled", false);
						var cod_charges = parseFloat($('#cod_charges').val());
						var totalamount = parseFloat($('.cart-total-text').attr('data-price')) + cod_charges;
						$('#totalcartamout').val(totalamount);
						$('.cart-total-text span').text(totalamount.toFixed(2));
                }
            }, dataType: 'json'
        });
    });



    $(document).on("click", "#remove-discount-coupon-code", function () {
        //$('input[name="payment_option"][value="online"]').prop('checked', true);
        //$('input[name="payment_option"]:checked').trigger('change');
        alertify.success("Coupon removed Succesfully");
        $('#coupon_discount').val(0);
        $('#copoun-change-div').hide();
        $('#remove-discount-coupon-code').hide();
        $('#discount-coupon-code').show();
        $('#coupon-code-text').attr("disabled", false);
        var cod_charges = parseFloat($('#cod_charges').val());
        var totalamount = parseFloat($('.cart-total-text').attr('data-price')) + cod_charges;
        $('#totalcartamout').val(totalamount);
        $('.cart-total-text span').text(totalamount.toFixed(2));
    });

});

//end wishlist


//carts functions
function showCart() {
    $.ajax({
        method: "GET", url: "/show-cart", success: function (response) {
            $('.cart-dropdown-panel').html(response.html);
            $('.mini-cart-icon span').text(response.count);
            $(document).ready(function () {
                const minus = $('.cart__quantity__minus');
                const plus = $('.cart__quantity__plus');
                minus.off('click').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).attr('id').replace("cart__quantity-minus-", "").split("-");
                    var pid = id[0];
                    var vid = id[1];
                    var value = parseInt($('.cart__quantity-input-' + pid + '-' + vid).val());
                    if (value > 1) {
                        value--;
                    }
                    $('.cart__quantity-input-' + pid + '-' + vid).val(value);
                    updateCartAttributes(pid, vid, value, 'dec', $('.cart__quantity-input-' + pid + '-' + vid));
                });
                plus.off('click').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).attr('id').replace("cart__quantity-plus-", "").split("-");
                    var pid = id[0];
                    var vid = id[1];
                    var value = parseInt($('.cart__quantity-input-' + pid + '-' + vid).val());
                    value++;
                    $('.cart__quantity-input-' + pid + '-' + vid).val(value);
                    updateCartAttributes(pid, vid, value, 'inc', $('.cart__quantity-input-' + pid + '-' + vid));
                })
            });
        }
    });
    $.ajax({
        method: "GET", url: "/wishlist-count", success: function (response) {
            $('.mini-cart-icon-wishlist span').text(response.count);
        }
    });
     
}

function removeCart(pid, vid) {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        method: 'POST',
        url: "/remove-mycart",
        data: { product_id: pid, variant_id: vid },
        success: function (response) {
            if (response.status == true) {
                $('tr#cart-row-' + pid + '-' + vid).remove();
                $('#sub-cart-price').html(response.totalsubprice);
                $('#shipping-cart-price').html(response.shippingcharge)
                for (var i in response.remainingamount) {
                    if (parseFloat(response.remainingamount[i]) > 0) {
                        $('#remaining-amount-for-free-delievery-' + i + '').html('<marquee width="100%" direction="left" height="auto"><small>Note: Add <i class="fa fa-rupee-sign"></i> ' + response.remainingamount[i] + ' More For Free Shipping</small></marquee>');
                        $('#remaining-amount-for-free-delievery-' + i + '').addClass('remain').removeClass('free');
                    } else {
                        $('#remaining-amount-for-free-delievery-' + i + '').html('<small>Note: Congratulation you are eligible for free Shipping for this seller.</small>');
                        $('#remaining-amount-for-free-delievery-' + i + '').addClass('free').removeClass('remain');
                    }
                }
                $('#total-cart-price').html(response.totalprice);
                $('#gst-cart-price').html(response.totalgstprice);
                alertify.success(response.message);
                showCart();
            } else {
                alertify.error(response.message);
            }
        }
    });
}

function removeWishlist(pid) {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        method: 'POST',
        url: "/remove-wishlist",
        data: { product_id: pid },
        success: function (response) {
            if (response.status == true) {
                $('tr#wishlist-row-' + pid).remove();
                alertify.success(response.message);
                $('.mini-cart-icon-wishlist span').text(response.count);
            } else {
                alertify.error(response.message);
            }
        }
    });
}
