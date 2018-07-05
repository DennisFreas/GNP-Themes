jQuery(document).ready( function($){
    "use strict";

    var $window   = $(window),
        $body     = $(document.body),

        header    = document.getElementById('header'),
        nav       = document.getElementById('nav'),
        primary   = document.getElementById('primary'),
        footer    = document.getElementById('footer'),
        copyright = document.getElementById('copyright'),

        $header    = $( header ),
        $nav       = $( '.nav' ),
        $primary   = $( primary ),
        $footer    = $( footer ),
        $copyright = $( copyright ),

        hAdminBar = $('#wpadminbar').length ? $('#wpadminbar').height() : 0,

        onScrollEnd,

        detectDevice = function(){
            if ( YIT_Browser.isViewportBetween( 1024 ) ) {
                $body.addClass('isMobile');
                $("#animate-css").attr("disabled", "disabled");
            }
            else {
                $body.removeClass('isMobile');
                $("#animate-css").attr("disabled", false);
            }

            if ( YIT_Browser.isViewportBetween( 1024, 768 ) ) {
                $body.addClass('isIpad');
            }
            else {
                $body.removeClass('isIpad');
            }

            if ( YIT_Browser.isViewportBetween( 767 ) ) {
                $body.addClass('isIphone');
            }
            else {
                $body.removeClass('isIphone');
            }
        };

    /*************************
     * MISC
     *************************/

    if ( YIT_Browser.isIE8() ) {
        $('*:last-child').addClass('last-child');
    }

    if( YIT_Browser.isIE10() ) {
        $( 'html' ).attr( 'id', 'ie10' ).addClass( 'ie' );
    }

    // placeholder support
    if($.fn.placeholder) {
        $('input[placeholder], textarea[placeholder]').placeholder();
    }

    // detect device and add the class to body
    _onresize( detectDevice );
    detectDevice();

    /*************************
     * Smooth Scroll Onepage
     *************************/
    $.fn.yit_onepage = function(){
        var nav = $(this);

        //smooth scrolling
        nav.on( 'click', 'a[href*="#"]:not([href="#"])', function(e) {

            var onepage_url = $('#logo-img').attr('href') + '/',
                current_page_url = location.origin + location.pathname;

            if ( onepage_url != current_page_url ){
                e.preventDefault();
                window.location.href = onepage_url + this.hash;
            }else if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
                var target = $(this.hash),
                    offsetSize = 34,
                    header_container_height = $('#header-container').height();

                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');


                if( $header.hasClass('sticky-header') && ! $body.hasClass('force-sticky-header') && target.offset().top - offsetSize > header_container_height ){
                    offsetSize += header_container_height ;
                }

                if ( $body.hasClass('admin-bar') ) {
                    offsetSize += $('#wpadminbar').height();
                }

                if ( target.length ) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - offsetSize
                    }, 1000, 'easeOutCirc');

                    return false;
                }
            }
        });
    };

    $nav.yit_onepage();



    $window.on('scroll', function(){
        $(".owl-carousel").each(function(){
            var owl = $(this).data('owlCarousel');

            if ( onScrollEnd ) clearTimeout( onScrollEnd );

            onScrollEnd = setTimeout(function(){
                owl.play();
            }, 500 );

            owl.stop();
        });
    });


    /*************************
     * Custom select
     *************************/
    /*fix wc 2.3 */
    var calculate_shipping_select = '';
    if(typeof yit_woocommerce !== 'undefined' && parseFloat(yit_woocommerce.version) < 2.3) calculate_shipping_select = '.woocommerce table.shop_table.shipping p select,';
    if ( $.fn.selectbox ) {
        var custom_selects = $('.woocommerce-ordering select, .faq-filters select, '+calculate_shipping_select+' .widget_product_categories select, .widget.widget_archive select, .widget.widget_categories #cat, #buddypress div.item-list-tabs ul li.last select, #buddypress select#whats-new-post-in, select#bbp_stick_topic_select, select#bbp_topic_status_select, select#message-type-select, select#display_name, select#bbp_destination_topic, select#bbp_forum_id, #dropdown_layered_nav_color, .wcml_currency_switcher');
        if ( custom_selects.length > 0 ) {
            custom_selects.selectbox({
                effect: 'fade'
            });
        }
    }

    /*************************
     * Sticky Footer
     *************************/

    if ( $.fn.imagesLoaded ) {
        $primary.imagesLoaded(function () {
            if ( $footer.length > 0) {
                $footer.stickyFooter();
            }
            else {
                $copyright.stickyFooter();
            }
        });
    }

    /*************************
     * Replace type="number" in opera
     *************************/

    $('.opera').find('.quantity input.input-text.qty').replaceWith(function() {
        return '<input type="text" class="input-text qty text" name="quantity" value="' + $(this).attr('value') + '" />';
    });

    /*************************
     * Back to top
     *************************/

    if( $('#back-top').length ){
        $.yit_backToTop();
    }

    /*************************
     * YIT Share
     *************************/

    var yit_share_init = function(){

        $( '.single-post .blog .share' ).add( '.single-post .blog .yit_post_meta .share').off('click').on('click', function(){
            var t       = $(this),
                social  = t.find('.socials-container');

            if( social.is(':visible') ) {
                social.slideUp('slow');
            } else {
                social.slideDown('slow');
            }
        });
    };

    $body.on( 'yit_share_init', yit_share_init).trigger('yit_share_init');


    /*************************
     * MENU
     *************************/

    var show_dropdown = function (t) {

            if ( $(t).closest('.mobile-nav').length ) {
                return;
            }

            var options,
                submenuWidth,
                offsetMenuRight,
                leftPos = 0,
                $headerContainer = $('#header-container').children('.container'),
                containerWidth = $headerContainer.width(),
                containerLeftPost = $headerContainer.offset().left + containerWidth,
                dropdown = $(t);

            if ( dropdown.is('#lang_sel ul > li') ) {
                submenuWidth = dropdown.find('ul').width();
                offsetMenuRight = dropdown.offset().left + submenuWidth;

                if ( offsetMenuRight > containerLeftPost )
                    options = { left: containerLeftPost - offsetMenuRight };
                else
                    options = {};

                dropdown.find('ul li').parent().css(options).stop(true, true).fadeIn(300);

            }  else if ( dropdown.hasClass('bigmenu') ) {
                dropdown.find('ul.sub-menu:not(ul.sub-menu li > div.submenu > ul.sub-menu), ul.children:not(ul.children li > div.submenu > ul.children)').parent().stop(true, true).fadeIn(500);

            } else if ( dropdown.hasClass('login-menu') ) {
                submenuWidth = dropdown.find('div.submenu').outerWidth();
                offsetMenuRight = dropdown.offset().left + submenuWidth - $headerContainer.offset().left;

                if (offsetMenuRight > containerWidth)
                    options = { marginLeft: containerWidth - offsetMenuRight };
                else
                    options = {};

                dropdown.find('.login-box').parent().css(options).stop(true, true).fadeIn(300);
            } else {
                submenuWidth = dropdown.find('div.submenu').outerWidth();
                offsetMenuRight = dropdown.offset().left + submenuWidth - $headerContainer.offset().left;

                if (offsetMenuRight > containerWidth )
                    options = { marginLeft: containerWidth - offsetMenuRight };
                else
                    options = {};

                dropdown.find('ul.sub-menu:not(ul.sub-menu li > div.submenu > ul.sub-menu)').parent().css(options).stop(true, true).fadeIn(300);
                dropdown.find('ul.children:not(ul.children li > ul.children)').css(options).stop(true, true).fadeIn(300);
            }

        },

        hide_dropdown = function (t) {

            if ( $(t).closest('.mobile-nav').length ) {
                return;
            }

            var dropdown = $(t);
            dropdown.find('ul.sub-menu:not(ul.sub-menu li > div.submenu > ul.sub-menu),  div.login-box').parent().fadeOut(300);
            dropdown.find('ul.children:not(ul.children li > ul.children), > ul').fadeOut(300);
        };


    $nav.on( 'mouseenter mouseleave', 'ul > li', function(e){
        if ( e.type == 'mouseenter' ) show_dropdown( this );
        else if ( e.type == 'mouseleave' ) hide_dropdown( this );
    });



    $('.nav ul > li').each(function () {
        var $this_item = $(this);
        if ( $this_item.find('ul').length > 0 ) {
            $this_item.children('a').append('<span class="sf-sub-indicator fa fa-angle-down"></span>');

        }
    });

    $nav.on( 'mouseenter mouseleave', 'li:not(.megamenu) ul.sub-menu li, li:not(.megamenu) > ul.children > li, li:not(.bigmenu) ul.sub-menu li, li:not(.bigmenu) > ul.children > li, #header .widget_nav_menu > div > ul > li', function(e){
        var $this = $(this);

        if ( e.type == 'mouseenter' ) {
            if ( $this.closest('.megamenu').length > 0 ) {
                return;
            }
            var containerWidth = $header.width(),
                containerOffsetRight = $header.offset().left + containerWidth,
                submenuWidth = $this.find('ul.sub-menu, ul.children').parent().width(),
                offsetMenuRight = $this.offset().left + submenuWidth * 2;

            if (offsetMenuRight > containerOffsetRight)
                $this.addClass('left');


            $this.find('ul.sub-menu').parent().stop(true, true).fadeIn(300);
            $this.find('ul.children').stop(true, true).fadeIn(300);
        }
        else if ( e.type == 'mouseleave' ) {
            if ( $this.closest('.megamenu').length > 0 || ( $this.closest('.bigmenu').length > 0 && ! $this.prev().hasClass('.bigmenu') ))
                return;

            $this.find('ul.sub-menu').parent().fadeOut(300);
            $this.find('ul.children').fadeOut(300);
        }
    });



    /*************************
     * sticky header
     *************************/

    if ( $header.hasClass('sticky-header') ) {
        $header.imagesLoaded(function(){

            var is_dark = $header.hasClass('dark'),
                is_transparent = $header.hasClass('transparent'),
                fixedClass = is_transparent ? 'dark-fixed' : 'fixed',
                sticky_header = is_transparent ? $('#header') : $('#header-container'),
                header_height = sticky_header.outerHeight(),
                headerTopOffset = sticky_header.offset().top,
                headerBottomPos = headerTopOffset + header_height,
                hPlaceholder = $('<div />').addClass('header-placeholder').height( header_height ),
                logo = $('#logo'),
                wlogo = logo.width(),
                wlogoimg = logo.find('img').width();

            if( sticky_header.length ){

                var header_sticky_scroll = function(){

                    if( ! $header.hasClass('skin2') ){
                        logo.width( wlogo );
                    }

                    hPlaceholder = hPlaceholder.height( header_height );

                    if( $window.scrollTop() + hAdminBar > headerBottomPos && $window.width() > 767 ){
                        var top = hAdminBar;

                        if( !sticky_header.hasClass( fixedClass ) ){
                            sticky_header.hide().height('')
                                .addClass( fixedClass )
                                .css({
                                    top : - header_height,
                                    display: 'block',
                                    backgroundColor: ! is_transparent ? $header.css('backgroundColor') : '',
                                    backgroundImage: ! is_transparent ? $header.css('backgroundImage') : ''
                                })
                                .delay(500)
                                .animate({ top: top }, 500, function(){
                                    if ( is_transparent ) $header.removeClass('transparent');
                                    if ( is_dark ) $header.removeClass('dark');
                                });


                            logo.find('img').css({
                                width : wlogoimg * 0.8,
                                height: 'auto'
                            });


                            if ( ! is_transparent ){
                                hPlaceholder.insertAfter( sticky_header );
                            }
                        }

                    }else if( $window.scrollTop() + hAdminBar <= headerTopOffset ) {
                        if ( is_dark ) $header.addClass('dark');
                        if ( is_transparent ) $header.addClass('transparent');

                        logo.find('img').css({ width: wlogoimg });
                        sticky_header.stop().removeClass( fixedClass )
                           .css({
                                top: headerTopOffset - ( $body.hasClass('boxed-layout') && hAdminBar > 0 ? hAdminBar : 0 ),
                                height: header_height
                            })
                            .show();

                        setTimeout(function(){sticky_header.height('');}, 1000);

                        //logo.animate({ paddingRight: logopadding },500);

                        if ( ! is_transparent ){
                            hPlaceholder.remove();
                        }

                    }

                }

                $window.on( 'scroll', header_sticky_scroll);
            }
        });
    }

    /*************************
     * Bigmenu
     *************************/

    if( typeof $.fn.yit_bigmenu != 'undefined' ) 
        $nav.yit_bigmenu();


    /*************************
     * FULL WIDTH SECTION
     *************************/

    if( typeof $.fn.yit_fullwidth_section != 'undefined' )
        $('.section_fullwidth').yit_fullwidth_section();


    /*************************
     * PARALLAX
     *************************/

    if( typeof $.fn.yit_parallax != 'undefined' )
        $.yit_parallax();


    /*************************
     * PRETTYPHOTO
     *************************/


    if ($.fn.prettyPhoto) {
        $(".video-button a[rel^='prettyPhoto']").prettyPhoto({
            social_tools  : '',
            default_width : 650,
            default_height: 487,
            show_title    : false
        });
    }


    /*************************
     * MASONRY
     *************************/

    var add_masonry = function(){

        if ( $.fn.imagesLoaded && $.fn.masonry ) {
            $('.blog-masonry, ul.products.masonry, .testimonials').each( function(){
                var container = $(this),
                    item = container.data('item');

                if( item === 'undefined' ){
                    item = '.masonry_item';
                }

                container.imagesLoaded( function(){
                    container.masonry({
                        itemSelector: item,
                        isAnimated: true,
                        isRTL: yit.isRtl
                    });
                }).css( 'visibility', 'visible' );
            });
        }
    };

    $(window).on( 'load resize', add_masonry );

    $(document).on( 'load resize yith_infs_adding_elem', function(){
        if ( $.fn.imagesLoaded && $.fn.masonry ) {
            var $container = $( ' ul.products.masonry' );
            $container.imagesLoaded( function(){
                $container.masonry('reloadItems');
            });
        }
    });

    /*************************
     * Newlsetter Placeholder
     *************************/

    var placeholder = $('.widget input.email-field.text-field.autoclear').attr('placeholder');
    $('.widget input.email-field.text-field.autoclear').on( 'focus', function(){
       var $this = $(this);
       $this.attr('placeholder', '');
    });
    $('.widget input.email-field.text-field.autoclear').on( 'blur', function(){
        var $this = $(this);
        $this.attr('placeholder', placeholder );
    });


    /*************************
     * PostFormat Gallery
     *************************/

    if( $body.hasClass( 'single-format-gallery' ) ){
        $( '.masterslider' ).yit_gallery_post_format();
    }



    /*************************
     * WAYPOINT
     *************************/

    if ( ! YIT_Browser.isMobile() ) {
        $('.yit_animate:not(.animated), .parallaxeos_animate:not(.animated)').each(function(){
            $(this).yit_waypoint();
        });
    }



    /*************************
     * WIDGETS
     *************************/

    $('.yit_toggle_menu ul.menu').each(function(){
        var menu = $(this);

        menu.filter('.open_first').find("> li:first-child").addClass("opened");
        menu.filter('.open_all').find("> li").addClass("opened");

        menu.filter('.open_active').find('li').filter('.current-menu-ancestor').addClass("opened");
        menu.filter('.open_active').find('li').filter('.current-menu-parent').addClass("opened");

        menu.find('> li > ul').hide();
        menu.find('> li.opened > ul').show();

        menu.on( 'click', '> li > a', function (e) {
            e.preventDefault();

            var submenu = $(this).next("ul"),
                li = submenu.parent("li");

            li.hasClass("opened") ? li.removeClass("opened") : li.addClass("opened");

            submenu.slideToggle('slow');
        });
    });

    if ( $.fn.owlCarousel ) {
        $( '.slides-reviews-widget').each( function(){
            var slider = $(this);

            slider.owlCarousel({
                singleItem     : true,
                navigation     : true,
                slideSpeed     : slider.data('slidespeed'),
                navigationText : ['<span class="fa fa-angle-left"></span>','<span class="fa fa-angle-right"></span>'],
                autoPlay       : slider.data('autoplay'),
                pagination     : false

            });
        });
    }



    /****************************
     *toggle
     *************************/
    $('.toggle-content:not(.opened), .content-tab:not(.opened)').hide();
    $('.toggle .toggle-title').on('click', function(){

        var $this = $(this),
            opened_class = $this.children('span').data('opened'),
            closed_class = $this.children('span').data('closed');

        $this.next().slideToggle(600, 'easeOutExpo');
        $this.toggleClass('tab-opened tab-closed');
        $this.children('span').toggleClass(closed_class+' '+opened_class);
        $this.attr('title', ($(this).attr('title') == 'Close') ? 'Open' : 'Close');
        return false;
    });


    /****************************
     * dropdown products category
     *************************/

    var widget = $('.widget.woocommerce.widget_product_categories, .widget.widget_categories');
    var main_ul = widget.find('> ul');

    if ( main_ul.length ) {
        var dropdown_widget_nav = function() {

            main_ul.find('> li').each(function () {

                var main = $(this),
                    link = main.find('> a'),
                    ul = main.find('> ul.children');

                if ( ul.length ) {

                    //init widget
                    if ( main.hasClass('closed') ) {
                        ul.hide();
                        link.after('<i class="icon-plus"></i>');
                    }
                    else if ( main.hasClass('opened') ) {
                        link.after('<i class="icon-minus"></i>');
                    }
                    else {
                        main.addClass('opened');
                        link.after('<i class="icon-minus"></i>');
                    }

                    // on click
                    main.find('i').on('click', function () {

                        ul.slideToggle('slow');

                        if ( main.hasClass('closed') ) {
                            main.removeClass('closed').addClass('opened');
                            main.find('i').removeClass('icon-plus').addClass('icon-minus');
                        }
                        else {
                            main.removeClass('opened').addClass('closed');
                            main.find('i').removeClass('icon-minus').addClass('icon-plus');
                        }
                    });
                }
            });
        };

        $(document).on('yith-wcan-ajax-filtered' );
        dropdown_widget_nav();
    }

    /***********************
    * MOBILE MENU FIX
    ***********************/
    var respmenuclick = $('.st-menu ul.level-1 > li.menu-item-has-children');
    respmenuclick.on('click',function(){
        var t = $(this);
        if ( t.hasClass('open')){
            t.removeClass('open')
        }
        else{
            respmenuclick.removeClass('open');
            t.addClass('open')
        }
    });

    //$header
    //    // menu opening
    //    .on('touchstart click', 'a.menu-trigger', function (e) {
    //        e.preventDefault();
    //
    //        var trigger = $(this),
    //            menu = trigger.siblings('ul');
    //
    //        menu.toggle();
    //    })
    //
    //    // my account
    //    .on('touchstart', 'li.login-menu a', function (e) {
    //        e.preventDefault();
    //
    //        $(this).unbind('mouseenter mouseleave');
    //
    //        document.location = $(this).attr('href');
    //    });



    /***********************
     * GOOGLE MAP
     ***********************/



    $.initializeMap =  function ( gmap_id, lat, lng, address, zoom, marker_icon, black ) {
        var map,
            isDraggable = $window.width() > 768 ? true : false,
            mapStyles;
        if( black ){
            var mapStyles = [
                {
                    stylers: [
                        {hue: "#666666" },
                        {saturation: "-100"},
                        {lightness: "-40"},
                        {gamma: 1}
                    ]
                }
            ];
        }

        var yitMapType = new google.maps.StyledMapType(mapStyles,
            {name: "YIT Map"}),
            geocoder = new google.maps.Geocoder(),
            latlng = new google.maps.LatLng( lat, lng),

            mapOptions = {
            zoom: zoom,
            scrollwheel: false,
            draggable: isDraggable,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'yit_style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: 'yit_style'
        };


        map = new google.maps.Map(document.getElementById(gmap_id), mapOptions);
        map.mapTypes.set('yit_style', yitMapType);

        if (geocoder) {

            geocoder.geocode( { address: address , location: latlng }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map     : map,
                        icon    : marker_icon,
                        title   : address
                    });
                }
            });
        }

    };


    $(".map_canvas").each( function(){
        var gmap = $(this),
            gmap_id = gmap.attr('id'),
            lat = gmap.data('lat'),
            lng = gmap.data('lng'),
            zoom = gmap.data('zoom'),
            marker = gmap.data('marker'),
            style  = ( gmap.data('style') == 'color') ? false : true,
            address = gmap.data('address');


        $.initializeMap( gmap_id, lat, lng, address, zoom, marker, style );

    });


    /*************************
     * Header Search
     *************************/

    if( typeof $.fn.yit_header_search != 'undefined' )
        $.yit_header_search();
    
    if( typeof $.fn.yit_ajax_search != 'undefined' )
        $.yit_ajax_search();

    /*************************
     * Fix mobile video
     *************************/

     if( typeof $.fn.yit_video_mobile_fix != 'undefined' ) 
        $.yit_video_mobile_fix();

});