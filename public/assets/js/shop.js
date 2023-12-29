(function ($) {
    'use strict';
    /*Product Details*/
    var productDetails = function () {
        $('.product-image-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: isRTL,
            arrows: false,
            fade: false,
            asNavFor: '.slider-nav-thumbnails',
        });

        $('.slider-nav-thumbnails').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            vertical: true,
            rtl: isRTL,
            asNavFor: '.product-image-slider',
            dots: false,
            focusOnSelect: true
        });

        // Remove active class from all thumbnail slides
        $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

        // Set active class to first thumbnail slides
        $('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

        // On before slide change match active thumbnail to current slide
        $('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var mySlideNumber = nextSlide;
            $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
            $('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
        });

        $('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var img = $(slick.$slides[nextSlide]).find("img");
            $('.zoomWindowContainer,.zoomContainer').remove();
            if ($(window).width() > 768) {
                $(img).elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                });
            }
        });

        // Magnific 
        $('.product-image-slider').magnificPopup({
            delegate: '.slick-slide:not(.slick-cloned) a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        //Elevate Zoom
        if ($(".product-image-slider").length) {
            if ($(window).width() > 768) {
                $('.product-image-slider .slick-active img').elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                });
            }
        }

        //Filter color/Size
        $('.list-filter').each(function () {
            $(this).find('a').on('click', function (event) {
                event.preventDefault();
                $(this).parent().siblings().removeClass('active');
                $(this).parent().toggleClass('active');
                $(this).parents('.attr-detail').find('.current-size').text($(this).text());
                $(this).parents('.attr-detail').find('.current-color').text($(this).attr('data-color'));
            });
        });
        //Qty Up-Down
        /*$('.detail-qty').each(function () {
            var qtyval = parseInt($(this).find(".qty-val").val(), 10);

            $('.qty-up').on('click', function (event) {
                event.preventDefault();
                qtyval = qtyval + 1;   
                $(this).prev().val(qtyval);
            });

             $(".qty-down").on("click", function (event) {
                 event.preventDefault(); 
                 qtyval = qtyval - 1;
                 if (qtyval > 1) {
                     $(this).next().val(qtyval);
                 } else {
                     qtyval = 1;
                     $(this).next().val(qtyval);
                 }
             });
        });*/

        $('.dropdown-menu .cart_list').on('click', function (event) {
            event.stopPropagation();
        });
    };


    $(".shop-filter-toggle").on("click", (function (e) {
        e.preventDefault(), $(".shop-product-filter-header").slideToggle(), $(".shop-filter-toggle").toggleClass("active")
    })), window.closeShopFilterSection = function () {
        $(".shop-filter-toggle").hasClass("active") && ($(".shop-product-filter-header").slideToggle(), $(".shop-filter-toggle").removeClass("active"))
    }, $(".pro-dec-big-img-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: isRTL,
        arrows: !1,
        draggable: !1,
        fade: !1,
        asNavFor: ".product-dec-slider-small , .product-dec-slider-small-2"
    })

    //Load functions
    $(document).ready(function () {
        productDetails();
    });

})(jQuery);

