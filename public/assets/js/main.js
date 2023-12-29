let isRTL = $('body').prop('dir') === 'rtl';
(function ($) {
    ("use strict");
    // Page loading
    $(window).on("load", function () {
        $("#preloader-active").delay(250).fadeOut("slow");
        $("body").delay(250).css({
            overflow: "visible"
        });
        $("#onloadModal").modal("show");
    });
	 
      function logoutAccount() {
            if (confirm("Do you really want to logout your account?")) {
                location.href = '/logout';
            }
        }
    /*  Login page */
    $('#verify-otp').hide();

    //On click method for Send OTP
    $('#send-otp').click(function () {
        $(this).prop('disabled', true);
        var error = 0;
        $('.invalid-feedback').remove();
        if ($.trim($('#email').val()).length == 0) {
            $('#email').addClass('is-invalid');
            $('#email').attr('aria-describedby', 'email-error');
            $('#email').attr('aria-invalid', 'true');
            $('#email').parent().append("<em id='email-error' class='error invalid-feedback'>Email ID or Phone is required.</em>");
            error++;
        }
        if (error == 0) {
            $.post('/send-otp', { emailphone: $('#email').val(), "_token": $('input[name="_token"]').val() }, function (result) {
                if (result.status == true) {
                    $('#sign-in').hide();
                    $('#verify-otp').show();
                } else {
                    $('#send-otp').prop('disabled', false);
                    $('#email').addClass('is-invalid');
                    $('#email').attr('aria-describedby', 'email-error');
                    $('#email').attr('aria-invalid', 'true');
                    $('#email').parent().append("<em id='email-error' class='error invalid-feedback'>" + result.error.join("<br />") + "</em>");
                    error++;
                }
            }, 'json');
        } else {
            $(this).prop('disabled', false);
        }
    });
    $('.back-bt-login').click(function () {
        $('#send-otp').prop('disabled', false);
        $('#sign-in').show();
        $('#verify-otp').hide();
    })
    $('.resend-otp').click(function () {
        $.post('/send-otp', { emailphone: $('#email').val(), "_token": $('input[name="_token"]').val() }, function (result) {
            if (result.status == true) {
                alertify.success("OTP sent successfully")
            }
        }, 'json');
    })


    /*----------------
    Mobile slider JS 
    ----------------*/

    const list = document.querySelectorAll('.list');

    function accordion(e) {
        e.stopPropagation();
        if (this.classList.contains('active')) {
            this.classList.remove('active');
        }
        else if (this.parentElement.parentElement.classList.contains('active')) {
            this.classList.add('active');
        }
        else {
            for (i = 0; i < list.length; i++) {
                list[i].classList.remove('active');
            }
            this.classList.add('active');
        }
    }
    for (i = 0; i < list.length; i++) {
        list[i].addEventListener('click', accordion);
    }

    /*-----------------
    Menu Stick
    -----------------*/
    var header = $(".sticky-bar");
    var win = $(window);
    win.on("scroll", function () {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass("stick");
            $(".header-style-2 .categories-dropdown-active-large").removeClass("open");
            $(".header-style-2 .categories-button-active").removeClass("open");
        } else {
            header.addClass("stick");
        }
    });

    /* Cart number increment and decrement */
    $(document).ready(function () {
        const minus = $('.quantity__minus');
        const plus = $('.quantity__plus');
        minus.click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id').replace("quantity-minus-", "");
            var value = parseInt($('#quantity-input-' + id).val());
            var minvalue = parseInt($('#min-quantity-input-' + id).val());
            if (value > minvalue) {
                value--;
            }
            $('#quantity-input-' + id).val(value);
        });

        plus.click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id').replace("quantity-plus-", "");
            var value = parseInt($('#quantity-input-' + id).val());
            var maxvalue = parseInt($('#max-quantity-input-' + id).val());
            if (value < maxvalue) {
                value++;
            }
            $('#quantity-input-' + id).val(value);
        });
    });
    /*Cart page minus plus*/
    $(document).ready(function () {
        const minus = $('.cart__quantity__minus');
        const plus = $('.cart__quantity__plus');
        minus.click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id').replace("cart__quantity-minus-", "").split("-");
            var pid = id[0];
            var vid = id[1];
            var value = parseInt($('.cart__quantity-input-' + pid + '-' + vid).val());
            var minvalue = parseInt($('#min-quantity-input-' + pid + '-' + vid).val());
            if (value > minvalue) {
                value--;
            }
            $('.cart__quantity-input-' + pid + '-' + vid).val(value);
            updateCartAttributes(pid, vid, value, 'dec', $('.cart__quantity-input-' + pid + '-' + vid));
        });
        plus.click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id').replace("cart__quantity-plus-", "").split("-");
            var pid = id[0];
            var vid = id[1];
            var value = parseInt($('.cart__quantity-input-' + pid + '-' + vid).val());
            var maxvalue = parseInt($('#max-quantity-input-' + pid + '-' + vid).val());
            if (value < maxvalue) {
                value++;
            }
            $('.cart__quantity-input-' + pid + '-' + vid).val(value);
            updateCartAttributes(pid, vid, value, 'inc', $('.cart__quantity-input-' + pid + '-' + vid));
        })
    });
    /*------ ScrollUp -------- */
    $.scrollUp({
        scrollText: '<i class="fi-rs-arrow-small-up"></i>',
        easingType: "linear",
        scrollSpeed: 900,
        animation: "fade"
    });

    /*------ Wow Active ----*/
    new WOW().init();

    //sidebar sticky
    if ($(".sticky-sidebar").length) {
        $(".sticky-sidebar").theiaStickySidebar();
    }

    // Slider Range JS
    if ($("#top-slider-range").length) {
        $(".noUi-handle").on("click", function () {
            $(this).width(50);
        });
        var rangeSlider = document.getElementById("top-slider-range");
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: "₹"
        });
        noUiSlider.create(rangeSlider, {
            start: [parseInt($('#top-min-price').val()), parseInt($('#top-max-price').val())],
            step: 1,
            range: {
                min: [parseInt($('#top-min-price').attr('data-min'))],
                max: [parseInt($('#top-max-price').attr('data-max'))]
            },
            format: moneyFormat,
            connect: true
        });
        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            document.getElementById("top-slider-range-value1").innerHTML = values[0];
            document.getElementById("top-slider-range-value2").innerHTML = values[1];
            document.getElementById("top-min-price").value = moneyFormat.from(values[0]);
            document.getElementById("top-max-price").value = moneyFormat.from(values[1]);
        });
    }
    if ($("#top-slider-range-discount").length) {
        $(".noUi-handle").on("click", function () {
            $(this).width(50);
        });
        var rangeSlider = document.getElementById("top-slider-range-discount");
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            postfix: "%"
        });
        noUiSlider.create(rangeSlider, {
            start: [parseInt($('#top-min-discount').val()), parseInt($('#top-max-discount').val())],
            step: 1,
            range: {
                min: [parseInt($('#top-min-discount').attr('data-min'))],
                max: [parseInt($('#top-max-discount').attr('data-max'))]
            },
            format: moneyFormat,
            connect: true
        });
        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            document.getElementById("top-slider-range-discount1").innerHTML = values[0];
            document.getElementById("top-slider-range-discount2").innerHTML = values[1];
            document.getElementById("top-min-discount").value = moneyFormat.from(values[0]);
            document.getElementById("top-max-discount").value = moneyFormat.from(values[1]);
        });
    }
    if ($("#slider-range").length) {
        $(".noUi-handle").on("click", function () {
            $(this).width(50);
        });
        var rangeSlider = document.getElementById("slider-range");
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: "₹"
        });
        noUiSlider.create(rangeSlider, {
            start: [parseInt($('#min-price').val()), parseInt($('#max-price').val())],
            step: 1,
            range: {
                min: [parseInt($('#min-price').attr('data-min'))],
                max: [parseInt($('#max-price').attr('data-max'))]
            },
            format: moneyFormat,
            connect: true
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            document.getElementById("slider-range-value1").innerHTML = values[0];
            document.getElementById("slider-range-value2").innerHTML = values[1];
            document.getElementById("min-price").value = moneyFormat.from(values[0]);
            document.getElementById("max-price").value = moneyFormat.from(values[1]);
        });
    }

    if ($("#slider-range-discount").length) {
        $(".noUi-handle").on("click", function () {
            $(this).width(50);
        });
        var rangeSlider = document.getElementById("slider-range-discount");
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            postfix: "%"
        });
        noUiSlider.create(rangeSlider, {
            start: [parseInt($('#min-discount').val()), parseInt($('#max-discount').val())],
            step: 1,
            range: {
                min: [parseInt($('#min-discount').attr('data-min'))],
                max: [parseInt($('#max-discount').attr('data-max'))]
            },
            format: moneyFormat,
            connect: true
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            document.getElementById("slider-range-discount1").innerHTML = values[0];
            document.getElementById("slider-range-discount2").innerHTML = values[1];
            document.getElementById("min-discount").value = moneyFormat.from(values[0]);
            document.getElementById("max-discount").value = moneyFormat.from(values[1]);
        });
    }

    /*------ Hero slider 1 ----*/
    $(".hero-slider-1").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: true,
        prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
        nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
        appendArrows: ".hero-slider-1-arrow",
        autoplay: true
    });

    /*Carausel 8 columns*/
    $(".carausel-8-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: true,
            slidesToShow: 8,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });

    /*Carausel 10 columns*/
    $(".carausel-10-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: false,
            slidesToShow: 10,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });

    /*Carausel 6 columns*/
    $(".carausel-6-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });
    /*Carausel 4 columns*/
    $(".carausel-4-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });
    /*Carausel 3 columns*/
    $(".carausel-3-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });

    /*Fix Bootstrap 5 tab & slick slider*/

    $('button[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
        $(".carausel-4-columns").slick("setPosition");
    });

    /*------ Timer Countdown ----*/

    $("[data-countdown]").each(function () {
        var $this = $(this),
            finalDate = $(this).data("countdown");
        $this.countdown(finalDate, function (event) {
            $(this).html(event.strftime("" + '<span class="countdown-section"><span class="countdown-amount hover-up">%D</span><span class="countdown-period"> days </span></span>' + '<span class="countdown-section"><span class="countdown-amount hover-up">%H</span><span class="countdown-period"> hours </span></span>' + '<span class="countdown-section"><span class="countdown-amount hover-up">%M</span><span class="countdown-period"> mins </span></span>' + '<span class="countdown-section"><span class="countdown-amount hover-up">%S</span><span class="countdown-period"> sec </span></span>'));
        });
    });

    /*------ Product slider active 1 ----*/
    $(".product-slider-active-1").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        fade: false,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="pro-icon-1-prev"><i class="fi-rs-angle-small-left"></i></span>',
        nextArrow: '<span class="pro-icon-1-next"><i class="fi-rs-angle-small-right"></i></span>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*------ Testimonial active 1 ----*/
    $(".testimonial-active-1").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="pro-icon-1-prev"><i class="fi-rs-angle-small-left"></i></span>',
        nextArrow: '<span class="pro-icon-1-next"><i class="fi-rs-angle-small-right"></i></span>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*------ Testimonial active 3 ----*/
    $(".testimonial-active-3").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*------ Categories slider 1 ----*/
    $(".categories-slider-1").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*----------------------------
    Category toggle function
    ------------------------------*/
    var searchToggle = $(".categories-button-active");
    searchToggle.on("click", function (e) {
        e.preventDefault();
        if ($(this).hasClass("open")) {
            $(this).removeClass("open");
            $(this).siblings(".categories-dropdown-active-large").removeClass("open");
        } else {
            $(this).addClass("open");
            $(this).siblings(".categories-dropdown-active-large").addClass("open");
        }
    });

    /*-------------------------------
    Sort by active
    -----------------------------------*/
    if ($(".sort-by-product-area").length) {
        var $body = $("body"),
            $cartWrap = $(".sort-by-product-area"),
            $cartContent = $cartWrap.find(".sort-by-dropdown");
        $cartWrap.on("click", ".sort-by-product-wrap", function (e) {
            e.preventDefault();
            var $this = $(this);
            if (!$this.parent().hasClass("show")) {
                $this.siblings(".sort-by-dropdown").addClass("show").parent().addClass("show");
            } else {
                $this.siblings(".sort-by-dropdown").removeClass("show").parent().removeClass("show");
            }
        });
        /*Close When Click Outside*/
        $body.on("click", function (e) {
            var $target = e.target;
            if (!$($target).is(".sort-by-product-area") && !$($target).parents().is(".sort-by-product-area") && $cartWrap.hasClass("show")) {
                $cartWrap.removeClass("show");
                $cartContent.removeClass("show");
            }
        });
    }

    /*-----------------------
    Shop filter active
    ------------------------- */
    $(".shop-filter-toogle").on("click", function (e) {
        e.preventDefault();
        $(".shop-product-fillter-header").slideToggle();
    });
    var shopFiltericon = $(".shop-filter-toogle");
    shopFiltericon.on("click", function () {
        $(".shop-filter-toogle").toggleClass("active");
    });

    /*-------------------------------------
    Product details big image slider
    ---------------------------------------*/
    $(".pro-dec-big-img-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: ".product-dec-slider-small , .product-dec-slider-small-2"
    });

    /*---------------------------------------
    Product details small image slider
    -----------------------------------------*/
    $(".product-dec-slider-small").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: ".pro-dec-big-img-slider",
        dots: false,
        focusOnSelect: true,
        fade: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });

    /*-----------------------
    Magnific Popup
    ------------------------*/
    $(".img-popup").magnificPopup({
        type: "image",
        gallery: {
            enabled: true
        }
    });

    $('.btn-close').on('click', function (e) {
        $('.zoomContainer').remove();
    });

    $('#quickViewModal').on('show.bs.modal', function (e) {
        $(document).click(function (e) {
            var modalDialog = $('.modal-dialog');
            if (!modalDialog.is(e.target) && modalDialog.has(e.target).length === 0) {
                $('.zoomContainer').remove();
            }
        });
    });

    $('#trackOrder_pop').on('show.bs.modal', function (e) {
        $(document).click(function (e) {
            var modalDialog = $('.modal-dialog');
            if (!modalDialog.is(e.target) && modalDialog.has(e.target).length === 0) {
                $('.zoomContainer').remove();
            }
        });
    });
    /*---------------------
    Select active
    --------------------- */
    $(".select-active").select2();

    /*--- Checkout toggle function ----*/
    $(".checkout-click1").on("click", function (e) {
        e.preventDefault();
        $(".checkout-login-info").slideToggle(900);
    });

    /*--- Checkout toggle function ----*/
    $(".checkout-click3").on("click", function (e) {
        e.preventDefault();
        $(".checkout-login-info3").slideToggle(1000);
    });

    /*-------------------------
    Create an account toggle
    --------------------------*/
    $(".checkout-toggle2").on("click", function () {
        $(".open-toggle2").slideToggle(1000);
    });

    $(".checkout-toggle").on("click", function () {
        $(".open-toggle").slideToggle(1000);
    });

    /*-------------------------------------
    Checkout paymentMethod function
    ---------------------------------------*/
    paymentMethodChanged();
    function paymentMethodChanged() {
        var $order_review = $(".payment-method");

        $order_review.on("click", 'input[name="payment_method"]', function () {
            var selectedClass = "payment-selected";
            var parent = $(this).parents(".sin-payment").first();
            parent.addClass(selectedClass).siblings().removeClass(selectedClass);
        });
    }

    /*---- CounterUp ----*/
    $(".count").counterUp({
        delay: 10,
        time: 2000
    });

    // Isotope active
    $(".grid").imagesLoaded(function () {
        // init Isotope
        var $grid = $(".grid").isotope({
            itemSelector: ".grid-item",
            percentPosition: true,
            layoutMode: "masonry",
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: ".grid-item"
            }
        });
    });

    /*====== SidebarSearch ======*/
    function sidebarSearch() {
        var searchTrigger = $(".search-active"),
            endTriggersearch = $(".search-close"),
            container = $(".main-search-active");

        searchTrigger.on("click", function (e) {
            e.preventDefault();
            container.addClass("search-visible");
        });

        endTriggersearch.on("click", function () {
            container.removeClass("search-visible");
        });
    }
    sidebarSearch();

    /*====== Sidebar menu Active ======*/
    function mobileHeaderActive() {
        var navbarTrigger = $(".burger-icon"),
            endTrigger = $(".mobile-menu-close"),
            container = $(".mobile-header-active"),
            wrapper4 = $("body");

        wrapper4.prepend('<div class="body-overlay-1"></div>');

        navbarTrigger.on("click", function (e) {
            e.preventDefault();
            container.addClass("sidebar-visible");
            wrapper4.addClass("mobile-menu-active");
        });

        endTrigger.on("click", function () {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
        });

        $(".body-overlay-1").on("click", function () {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
        });
    }
    mobileHeaderActive();

    /*---------------------
    Mobile menu active
    ------------------------ */
    var $offCanvasNav = $(".mobile-menu"),
        $offCanvasNavSubMenu = $offCanvasNav.find(".dropdown");

    /*Add Toggle Button With Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span>');

    /*Close Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.slideUp();

    /*Category Sub Menu Toggle*/
    $offCanvasNav.on("click", "li a, li .menu-expand", function (e) {
        var $this = $(this);
        if (
            $this
                .parent()
                .attr("class")
                .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
            ($this.attr("href") === "#" || $this.hasClass("menu-expand"))
        ) {
            e.preventDefault();
            if ($this.siblings("ul:visible").length) {
                $this.parent("li").removeClass("active");
                $this.siblings("ul").slideUp();
            } else {
                $this.parent("li").addClass("active");
                $this.closest("li").siblings("li").removeClass("active").find("li").removeClass("active");
                $this.closest("li").siblings("li").find("ul:visible").slideUp();
                $this.siblings("ul").slideDown();
            }
        }
    });

    /*--- language currency active ----*/
    $(".mobile-language-active").on("click", function (e) {
        e.preventDefault();
        $(".lang-dropdown-active").slideToggle(900);
    });

    /*--- categories-button-active-2 ----*/
    $(".categories-button-active-2").on("click", function (e) {
        e.preventDefault();
        $(".categori-dropdown-active-small").slideToggle(900);
    });

    /*--- Mobile demo active ----*/
    var demo = $(".tm-demo-options-wrapper");
    $(".view-demo-btn-active").on("click", function (e) {
        e.preventDefault();
        demo.toggleClass("demo-open");
    });

    /*-----More Menu Open----*/
    $(".more_slide_open").slideUp();
    $(".more_categories").on("click", function () {
        $(this).toggleClass("show");
        $(".more_slide_open").slideToggle();
    });

    /*-----Modal----*/

    /*--- VSticker ----*/
    $("#news-flash, #mobile-news-flash").vTicker({
        speed: 500,
        pause: 3000,
        animation: "fade",
        mousePause: false,
        showItems: 1
    });

    //Add Customer Full Details 
    $(document).on('click', "#add-customer-full-details", function () {
        var firstname = $('.after-login-modal #first_name').val();
        var lastname = $('.after-login-modal #last_name').val();
        var email = $('.after-login-modal #email').val();
        var phone = $('.after-login-modal #phone').val();
        var addressline1 = $('.after-login-modal #adddressline1').val();
        var addressline2 = $('.after-login-modal #adddressline2').val();
        var addressline3 = $('.after-login-modal #adddressline3').val();
        var city = $('.after-login-modal #city').val();
        var state = $('.after-login-modal #state').val();
        var pincode = $('.after-login-modal #pincode').val();
        var country = $('.after-login-modal #country').val();
        // var company = $('.after-login-modal #company').val();
        // var additionalinfo = $('.after-login-modal #additionalinfo').val();
        var error = 0;
        var errormessage = [];

        if ($.trim(firstname).length == 0) {
            errormessage.push('Firstname is required.');
            error++;
        }


        if (error == 0) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                method: 'post',
                url: '/add-customer-detail',
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    phone: phone,
                    addressline1: addressline1,
                    addressline2: addressline2,
                    addressline3: addressline3,
                    city: city,
                    state: state,
                    pincode: pincode,
                    country: country,
                    // company: company,
                    // additionalinfo: additionalinfo,
                },
                success: function (result) {
                    if (result.status == true) {
                        alertify.success(result.message);
                        setTimeout(location.reload(), 5000);

                    } else {
                        alertify.error(result.message);
                    }
                },
                dataType: 'json'
            });
        } else {
            alertify.error(errormessage.join("<br />"));
        }
    });

    // Update Customer Address from customer Dashboard
    $(document).on('click', ".btn-update-customer-address", function () {
        var id = $('#update-address-modal #update-customer-address-id').val();
        var addresstype = $('#update-address-modal #addresstype').val();
        var firstname = $('#update-address-modal #firstname').val();
        var lastname = $('#update-address-modal #lastname').val();
        var email = $('#update-address-modal #editemail').val();
        var phone = $('#update-address-modal #editphone').val();
        var addressline1 = $('#update-address-modal #addressline1').val();
        var addressline2 = $('#update-address-modal #addressline2').val();
        var addressline3 = $('#update-address-modal #addressline3').val();
        var city = $('#update-address-modal #editcity').val();
        var state = $('#update-address-modal #editstate').val();
        var pincode = $('#update-address-modal #editpincode').val();
        var country = $('#update-address-modal #editcountry').val();
        // var company = $('#update-address-modal #company').val();
        // var additionalinfo = $('#update-address-modal #additionalinfo').val();
        var error = 0;
        var errormessage = [];

        if ($.trim(addresstype).length == 0) {
            errormessage.push('Address Type is required.');
            error++;
        }
        else if (!(/^\w+$/i).test($.trim(addresstype))) {
            errormessage.push('Address Type is not in Valid Format.');
            error++;
        }
        if ($.trim(firstname).length == 0) {
            errormessage.push('Firstname is required.');
            error++;
        }
        else if (!(/^\w[\s\w]+$/i).test($.trim(firstname))) {
            errormessage.push('First Name is not in Valid Format.');
            error++;
        }
        if ($.trim(email).length == 0) {
            errormessage.push('Email Id is required.');
            error++;
        }
        else if (!(/^[(a-z)(0-9).-_]+@[(a-z)(0-9)]+\.[(a-z).]{2,6}$/).test($.trim(email))) {
            errormessage.push('Email Id is not Valid.');
            error++;
        }
        if ($.trim(phone).length == 0) {
            errormessage.push('Phone Number is required.');
            error++;
        }
        else if (!(/^[6-9][0-9]{9}$/).test($.trim(phone))) {
            errormessage.push('Phone Number is not Valid.');
            error++;
        }
        if ($.trim(addressline1).length == 0) {
            errormessage.push('Address Line 1 is required.');
            error++;
        }
        if ($.trim(city).length == 0) {
            errormessage.push('City is required.');
            error++;
        }
        if ($.trim(state).length == 0) {
            errormessage.push('State is required.');
            error++;
        }
        if ($.trim(pincode).length == 0) {
            errormessage.push('Pincode is required.');
            error++;
        }
        else if (!(/^[1-9][0-9]{5}$/).test($.trim(pincode))) {
            errormessage.push('Pincode is not Valid.');
            error++;
        }
        if ($.trim(country).length == 0) {
            errormessage.push('Country is required.');
            error++;
        }

        if (error == 0) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                method: 'post',
                url: '/update-customer-addresss',
                data: {
                    id: id,
                    addresstype: addresstype,
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    phone: phone,
                    addressline1: addressline1,
                    addressline2: addressline2,
                    addressline3: addressline3,
                    city: city,
                    state: state,
                    pincode: pincode,
                    country: country,
                    // company: company,
                    // additionalinfo: additionalinfo,
                },
                success: function (result) {
                    if (result.status == true) {
                        alertify.success(result.message);
                        $('#update-address-modal').modal('hide');
                        getAddresses();
                    } else {
                        alertify.error(result.message);
                    }
                },
                dataType: 'json'
            });
        } else {
            alertify.error(errormessage.join("<br />"));
        }
    });



    // Update Customer Details From Customer Dashboard
    $(document).on('click', "#update-customer-details", function () {
        var firstname = $('#first_name').val();
        var lastname = $('#last_name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var error = 0;
        var errormessage = [];

        if ($.trim(firstname).length == 0) {
            errormessage.push('Firstname is required.');
        }
        else if (!(/^\w+$/i).test($.trim(firstname))) {
            errormessage.push('First Name is not in Valid Format.');
            error++;
        }
        if ($.trim(email).length == 0) {
            errormessage.push('Email Id is required.');
            error++;
        }
        else if (!(/^[(a-z)(0-9).-_]+@[(a-z)(0-9)]+\.[(a-z).]{2,6}$/).test($.trim(email))) {
            errormessage.push('Email Id is not Valid.');
            error++;
        }
        if ($.trim(phone).length == 0) {
            errormessage.push('Phone Number is required.');
            error++;
        }
        else if (!(/^[6-9][0-9]{9}$/).test($.trim(phone))) {
            errormessage.push('Phone Number is not Valid.');
            error++;
        }

        if (error == 0) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                method: 'post',
                url: '/dashboard',
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    phone: phone,
                },
                success: function (result) {
                    if (result.status == true) {
                        alertify.success(result.message);
                    } else {
                        alertify.error(result.message);
                    }
                },
                dataType: 'json'
            });
        } else {
            alertify.error(errormessage.join("<br />"));
        }
    });

    $(document).on('click', "#new-address", function () {
        editAddress(0);
    });

    // For Inovice View


    $(document).on('click', '.backToOrders', function () {
        $(".invoceDiv").empty().hide();
        $("#totalOrders").show();
    });

})(jQuery);


function getInvoiceDetail(id) {
    $("#totalOrders").hide();
    $(".invoceDiv").load("get-order-invoice", 'id=' + id).show();

}

function updateCartAttributes(attrid, variantid, qty, type, selector) {

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        type: 'post',
        url: '/update-cart',
        data: { productid: attrid, variantid: variantid, qty: qty },
        success: function (response) {
            if (response.status == true) {
                $('#price-span-' + attrid + '-' + variantid).html(response.price);
                $('#sub-cart-price').html(response.totalsubprice);
                $('#shipping-cart-price').html(response.shippingcharge);
                for (var i in response.remainingamount) {
                    if (parseFloat(response.remainingamount[i]) > 0) {
						
						var achievedPercent = Math.round( ( (response.price * 100)/499));
						var remainingPercent = (100 - achievedPercent);
						 
                                        //achievedAmount: Rs. ' + response.price + ' remainingprogressbar: Rs. ' + response.remainingamount[i] +'
						$('#remaining-amount-for-free-delievery-' + i + '').html('<div class="container-fluid"> <div class="progress"><div class="progress-bar  green-progressbar-start progress-bar-striped active" role="progressbar" aria-valuenow="'+achievedPercent +'" aria-valuemin="0" aria-valuemax="100" style="width:'+(100-remainingPercent)+'%">Rs. ' + response.price + '</div><div class="progress-bar remainingprogressbar progress-bar-striped active" role="progressbar" aria-valuenow="'+remainingPercent+'" aria-valuemin="0" aria-valuemax="100" style="width:'+remainingPercent+'%" style="color:#333333;">Rs. '+ response.remainingamount[i]+'</div></div></div><marquee width="100%" direction="left" height="auto"><small>Note: Add <i class="fa fa-rupee-sign"></i> ' + response.remainingamount[i] + ' More For Free Shipping</small></marquee>');  
						
						
						
                        //$('#remaining-amount-for-free-delievery-' + i + '').html('<marquee width="100%" direction="left" height="auto"><small>Note: Add <i class="fa fa-rupee-sign"></i> ' + response.remainingamount[i] + ' More For Free Shipping</small></marquee>');
                        $('#remaining-amount-for-free-delievery-' + i + '').addClass('remain').removeClass('free');
                    } else {
                        $('#remaining-amount-for-free-delievery-' + i + '').html('<small>Note: Congratulation you are eligible for free Shipping for this seller.</small>');
                        $('#remaining-amount-for-free-delievery-' + i + '').addClass('free').removeClass('remain');
                    }
                }
                $('#total-cart-price').html(response.totalprice);
                $('#gst-cart-price').html(response.totalgstprice);
                showCart();
				alertify.success(result.message);
            } else {
                alertify.error(response.message);
                if (type == 'inc') {
                    qty--;
                } else {
                    qty++;
                }
                selector.val(qty);
            }
        },
        dataType: 'json'
    });


}

// Modal For Add new Address and Edit Existing Address
function editAddress(id) {
    $('.custom-modal input, .custom-modal textarea, .custom-modal select').val('');
    $('#update-customer-address-id').val(id);
    $('#update-address-modal').modal('show');
    if (id > 0) {
        $.get('/get-customer-address', { id: id }, function (result) {
            if (result.status == true) {
                var data = result.data;
                for (var i in data) {
                    $('#' + i).val(data[i]);
                }
            } else {
                alertify.error(result.message);
                $('#update-address-modal').modal('hide');
            }
        }, 'json');
    }
}


// Remove Customer Address From Dasboard
function removeAddress(id) {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        type: 'post',
        url: '/delete-customer-address',
        data: { id: id },
        success: function (result) {
            if (result.status == true) {
                alertify.success(result.message);
                getAddresses();
            }
            else {
                alertify.error(result.message);
            }
        },
        dataType: 'json'
    });
}

function getAddresses() {
    $.ajax({
        type: 'get',
        url: '/get-customer-addresses',
        success: function (result) {
            $('#address .row').html(result.html);
            if ($('select[id^="address-billing-"]').length > 0) {
                var html = '';
                for (var i in result.data) {
                    html += '<option data-pincode="' + result.data[i].pincode + '" data-format="' + result.data[i].format + '" value="' + i + '">' + result.data[i].type + '</option>';
                }
                html += '<optgroup label="---------------------------------------------------------"><option data-format="" value="0">Add New Address</option></optgroup>';
                var addressbilling = $('select[id^="address-billing-"]');
                for (var i in addressbilling) {
                    var value = addressbilling[i].value;
                    var id = addressbilling[i].id;
                    $('#' + id).html(html);
                    $('#' + id).val(value);
                }
                var shippingbilling = $('select[id^="address-shipping-"]');
                for (var i in shippingbilling) {
                    var value = shippingbilling[i].value;
                    var id = shippingbilling[i].id;
                    $('#' + id).html(html);
                    $('#' + id).val(value);
                }
            }
        },
        dataType: 'json'
    });
}
// : function (result) {
//             $('#address .row').html(result.html);
//             if ($('select[id^="address-billing-"]').length > 0) {
//                 var html = '';
//                 for (var i in result.data) {
//                     html += '<option data-pincode="' + result.data[i].pincode + '" data-format="' + result.data[i].format + '" value="' + i + '">' + result.data[i].type + '</option>';
//                 }
//                 html += '<optgroup label="---------------------------------------------------------"><option data-format="" value="0">Add New Address</option></optgroup>';
//                 var addressbilling = $('select[id^="address-billing-"]');
//                 for (var i in addressbilling) {
//                     var value = addressbilling[i].value;
//                     var id = addressbilling[i].id;
//                     $('#' + id).html(html);
//                     $('#' + id).val(value);
//                 }
//                 var shippingbilling = $('select[id^="address-shipping-"]');
//                 for (var i in shippingbilling) {
//                     var value = shippingbilling[i].value;
//                     var id = shippingbilling[i].id;
//                     $('#' + id).html(html);
//                     $('#' + id).val(value);
//                 }
//             }
//         },
//         dataType: 'json'
//     });
// }



console.log("hello layoutpage")
 
