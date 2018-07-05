jQuery(document).ready( function($){
    "use strict";

    var $body = $('body'),
        $topbar = $( document.getElementById('topbar') ),
        $header = $( document.getElementById('header') ),
        $products_sliders = $('.products-slider-wrapper, .categories-slider-wrapper'),
        $single_container = $('.fluid-layout.single-product .content');



    /***************************************
     * UPDATE CALCULATE SHIPPING SELECT
    ***************************************/

    // FIX SHIPPING CALCULATOR SHOW
    $( '.shipping-calculator-form' ).show();

    if (typeof yit_woocommerce !== 'undefined' && parseFloat(yit_woocommerce.version) < 2.3 && $.fn.selectbox ) {

        $('#calc_shipping_state').next('.sbHolder').addClass('stateHolder');

        $body.on('country_to_state_changing', function(){
            $('.stateHolder').remove();
            $('#calc_shipping_state').show().attr('sb', '');

            $('select#calc_shipping_state').selectbox({
                effect: 'fade',
                classHolder: 'stateHolder sbHolder'
            });
        });

    }

    /*************************
     * SHOP STYLE SWITCHER
     *************************/

    $('.content #list-or-grid').on( 'click', 'a', function(e) {
        e.preventDefault();
        var trigger = $(this),
                view = trigger.attr( 'class' ).replace('-view', '');

            $( 'ul.products li' ).removeClass( 'list grid' ).addClass( view );
            trigger.parent().find( 'a' ).removeClass( 'active' );
            trigger.addClass( 'active' );

            $.cookie( yit_shop_view_cookie, view );

            return false;
    });


    /***************************************************
     * HEADER CART
     **************************************************/

    $header.on('mouseover', '.cart_label', function(){
        $(this).next('.cart_wrapper').fadeIn(300);
    }).on('mouseleave', '.cart_label', function(){
        $(this).next('.cart_wrapper').fadeOut(300);
    });

    $header
        .on('mouseenter', '.cart_wrapper', function(){ $(this).stop(true,true).show() })
        .on('mouseleave', '.cart_wrapper',  function(){ $(this).fadeOut(300) });


    /***************************************************
     * ADD TO CART
     **************************************************/
    var $pWrapper = new Array(),
        $i=0,
        $j=0;

    $('ul.products').on('click', 'li.product .add_to_cart_button', function () {

        $pWrapper[$i] = $(this).parents('.product-wrapper');
        var $thumb = $pWrapper[$i].find('.thumb-wrapper');

        if( typeof yit.load_gif != 'undefined' ) {
            $thumb.block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.5, cursor: 'none'}});
        }
        else {
            $thumb.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
        }

        $i++;

    });

    $body.on('added_to_cart', function (e) {
        if (typeof $pWrapper[$j] === 'undefined' )  return;
        var $ico,
            $thumb = $pWrapper[$j].find('.thumb-wrapper');

        $ico = "<div class='added-to-cart-icon'><div class='added-to-cart'><div class='added-to-cart-text'><span>" + yit.added_to_cart_text + "</span></div></div></div>";

        $thumb.append( $ico );

        setTimeout(function () {
            $thumb.find('.added-to-cart-icon').fadeOut(2000, function () {
                $(this).remove();
            });
        }, 3000);

        $thumb.unblock();

        $j++;

    });

    /*******************************************
     * ADD TO WISHLIST
     *****************************************/

    $('ul.products, div.product div.summary').on( 'click', '.yith-wcwl-add-button a', function () {
        if( yit.load_gif != 'undefined' ) {
            $(this).block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.3, cursor: 'none'}});
        } else {
            $(this).block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
        }
    });

    /*************************
     * PRODUCTS SLIDER
     *************************/

    if( $.fn.owlCarousel && $.fn.imagesLoaded && $products_sliders.length ) {
        $products_sliders.each(function(){
            var t = $(this);

            t.imagesLoaded(function(){
                var cols = t.data('columns') ? t.data('columns') : 4;
                var autoplay = (t.attr('data-autoplay')=='true') ? 3000 : false;
                var owl = t.find('.products').owlCarousel({
                    autoPlay: autoplay,
                    items : cols,
                    itemsDesktop : [1199,cols],
                    itemsDesktopSmall : [979,3],
                    itemsTablet : [768, 2],
                    itemsMobile : [481, 1],
                    stopOnHover: true
                });

                // Custom Navigation Events
                t.on('click', '.es-nav-next', function(){
                    owl.trigger('owl.next');
                });

                t.on('click', '.es-nav-prev', function(){
                    owl.trigger('owl.prev');
                });

            });
        });
    }

    /*************************
     * VARIATIONS SELECT
     *************************/

    var variations_select = function(){
        // variations select
        if( $.fn.selectbox ) {
            var form = $('form.variations_form');
            var select = form.find('select:not(.yith_wccl_custom)');

            if( form.data('wccl') ) {
                select = select.filter(function(){
                    return $(this).data('type') == 'select'
                });
            }

            select.selectbox({
                effect: 'fade',
                onOpen: function() {
                    //$('.variations select').trigger('focusin');
                }
            });

            var update_select = function(event){
                select.selectbox("detach");
                select.selectbox("attach");
            };

            // fix variations select
            form.on( 'woocommerce_update_variation_values', update_select);
            form.find('.reset_variations').on('click.yit', update_select);
        }
    };

    variations_select();

     /*************************
     * INQUIRY FORM
     *************************/

    if ( $('#inquiry-form .product-inquiry').length ) {
        $(document).on('click', '#inquiry-form .product-inquiry', function(){
            $(this).next('form.contact-form').slideToggle('slow');
        });
    }

    /*************************
     * Login Form
     *************************/

    $('#login-form').on('submit', function(){
        var a = $('#reg_password').val();
        var b = $('#reg_password_retype').val();
        if(!(a==b)){
            $('#reg_password_retype').addClass('invalid');
            return false;
        }else{
            $('#reg_password_retype').removeClass('invalid');
            return true;
        }
    });

    /*************************
     * Widget Woo Price Filter
     *************************/

    if( typeof yit != 'undefined' && ( typeof yit.price_filter_slider == 'undefined' || yit.price_filter_slider == 'no' ) ) {
        var removePriceFilterSlider = function() {
            $( 'input#min_price, input#max_price' ).show();
            $('form > div.price_slider_wrapper').find( 'div.price_slider, div.price_label' ).hide();
        };

        $(document).on('ready', removePriceFilterSlider);
    }

    /*************************
     * YITH WooCommerce Ajax Search
     *************************/

    $('.yith-ajaxsearchform-container select.yit_wcas_post_type,.yith-ajaxsearchform-container select.search_categories').selectbox({
        effect: 'fade',
        classHolder: 'stateHolder sbHolder'
    });

    /*************************
     * END PRODUCT QUICK VIEW
     *************************/

    $(document).on( 'click' , '.cart_totals.calculated_shipping .cart_update_checkout input[type="submit"]' , function() {

        $('.woocommerce > form input[name="update_cart"]').click();

    } );

});