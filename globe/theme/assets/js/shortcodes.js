jQuery(document).ready( function($){
    "use strict";

    var $body = $('body'),
        content_width   = $('.content').width(),
        container_width = $('.container').width();


    /*************************
     * FEATURES TAB
     *************************/

    $.fn.yiw_features_tab = function( options ) {
        var config = {
            'tabNav' : 'ul.features-tab-labels',
            'tabDivs': 'div.features-tab-wrapper'
        };

        if( options ) $.extend( config, options );

        this.each( function () {
            var tabNav  = $( config.tabNav, this );
            var tabDivs = $( config.tabDivs, this );
            var labelNumber = tabNav.children( 'li' ).length;

            tabDivs.children( 'div' ).hide();

            var currentDiv = tabDivs.children( 'div' ).eq( tabNav.children( 'li.current-feature' ).index() );
            currentDiv.show();

            $( 'li', tabNav ).hover( function() {
                if( !$( this ).hasClass( 'current-feature' ) ) {
                    var currentDiv = tabDivs.children( 'div' ).eq( $( this ).index() );
                    tabNav.children( 'li' ).removeClass( 'current-feature' );

                    $( this ).addClass( 'current-feature' );

                    tabDivs.children( 'div' ).hide().removeClass( 'current-feature' );   console.log('hover');
                    currentDiv.fadeIn( 'slow', function() {
                        $(document).trigger('feature_tab_opened');
                    });
                }
            });

        });
    };

    $( '.features-tab-container' ).yiw_features_tab();

    /*************************
     * TABS
     *************************/

    $.fn.yiw_tabs = function(options) {
        // valori di default
        var config = {
            'tabNav': 'ul.tabs',
            'tabDivs': '.containers',
            'currentClass': 'current'
        };

        if (options) $.extend(config, options);

        this.each(function() {
            var tabNav = $(config.tabNav, this);
            var tabDivs = $(config.tabDivs, this);
            var activeTab;
            var maxHeight = 0;

            tabDivs.children('div').hide();

            if ( $('li.'+config.currentClass+' a', tabNav).length > 0 )
                activeTab = '#' + $('li.'+config.currentClass+' a', tabNav).data('tab');
            else
                activeTab = '#' + $('li:first-child a', tabNav).data('tab');

            $(activeTab).show().addClass('showing').trigger('yit_tabopened');
            $('li:first-child a', tabNav).parents('li').addClass(config.currentClass);

            $('a', tabNav).click(function(){
                if ( ! $(this).parents('li').hasClass('current') ) {

                    var id = '#' + $(this).data('tab');
                    var thisLink = $(this);

                    $('li.'+config.currentClass, tabNav).removeClass(config.currentClass);
                    $(this).parents('li').addClass(config.currentClass);

                    $('.showing', tabDivs).fadeOut(200, function(){
                        $(this).removeClass('showing').trigger('yit_tabclosed');
                        $(id).fadeIn(200).addClass('showing').trigger('yit_tabopened');
                    });
                }

                return false;
            });


        });
    };

    $('.tabs-container').yiw_tabs({
        tabNav  : 'ul.tabs',
        tabDivs : '.border-box'
    });

    /*************************
     * IMAGE STYLED
     *************************/

    $(window).on('load', function () {
        if ($.fn.prettyPhoto) {
            $(".image-styled .img_frame a[rel^='prettyPhoto']").prettyPhoto({
                social_tools: ''
            });


        }
    });

    /*************************
     * PORTFOLIO SECTION
     *************************/

    if ( $.fn.owlCarousel && $.fn.imagesLoaded ) {
        $('.portfolio-slider').each(function(){
            var t = $(this),
                slides = t.find('.portfolios'),
                owl = null;

            t.imagesLoaded(function(){
                owl = slides.owlCarousel({
                    items : 5,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [991, 3],
                    itemsTablet: [767, 2],
                    itemsMobile: [481, 1],
                    addClassActive: true
                });
            });

            t.on( 'click', '.prev-portfolio', function(e){
                e.preventDefault();
                owl.trigger('owl.prev');
            });

            t.on( 'click', '.next-portfolio', function(e){
                e.preventDefault();
                owl.trigger('owl.next');
            });


            _onresize( function(){
                var active_items  = t.find('.owl-item.active').length,
                    slides_number = t.find('.owl-item').length;

                if( slides_number == active_items ) {
                    t.find('.prev-portfolio, .next-portfolio').hide();
                }else{
                    t.find('.prev-portfolio, .next-portfolio').show();
                }
            } );
        });
    }

    /*************************
     * FIX WIDTH (sections, google maps, ecc...)
     *************************/

    var fixWidth = function(){
        var wrapperWidth = ( $body.hasClass('boxed-layout') ) ? $('#wrapper').outerWidth() : $(window).width();

        $('.portfolio-slider, .section-background, .google-map-frame.full-width .inner').css({
            width:  wrapperWidth
        });
    };

    _onresize( fixWidth );
    fixWidth();


    /*************************
     * SECTION BACKGROUND
     *************************/

    $('.section-background').each( function(){
        var section = $(this),
            section_background_fix_height = function(){
                var current_height = section.data('height');
                if ( current_height == 0 ){
                    var row = section.parents('.wpb_row'),
                        parent_height = row.next().height();

                    row.next().css('margin-bottom','25px');
                    section.css('height', parent_height+60);
                }
            };

        $( window ).on( 'load', section_background_fix_height );
        _onresize( section_background_fix_height );
    });



    /*************************
     * TEASER
     *************************/

    $('.teaser-wrapper').each( function(){

                var teaser = $(this);

                teaser.imagesLoaded(function() {
                    var teaser_height = teaser.find('.image').height();
                    teaser.find('.image_banner_inside').css({height: teaser_height});
                });
    });

    /*************************
     * FAQ
     *************************/

    if( typeof $.fn.yit_faq != 'undefined' ) 
    	$('#faqs-container').yit_faq();

});