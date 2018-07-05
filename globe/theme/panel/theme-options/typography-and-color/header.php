<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > Typography and Color > Header
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > General Custom Background */
    array(
        'type' => 'title',
        'name' => __( 'General Custom Background', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'    => 'header-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Header background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your header', 'yit' ),
        'std'   => array(
            'color'   => '#ffffff',
            'opacity' => 100,
        ),
        'style' => array(
            'selectors'  => '#header',
            'properties' => 'background-color'
        )
    ),

    array(
        'id'    => 'typography-header-background-image',
        'type'  => 'upload',
        'name'  => __( 'Header background image', 'yit' ),
        'desc'  => __( 'Select the image to use as background on your page header', 'yit' ),
        'std'   => '',
        'style' => array(
            'selectors'  => '#header',
            'properties' => 'background-image'
        )
    ),

    array(
        'id'      => 'typography-header-background-repeat',
        'type'    => 'select',
        'options' => array(
            'repeat'    => __( 'Repeat', 'yit' ),
            'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
            'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
            'no-repeat' => __( 'No Repeat', 'yit' )
        ),
        'name'    => __( 'Background repeat', 'yit' ),
        'desc'    => __( 'Select the repeat mode for the background image of header.', 'yit' ),
        'std'     => 'no-repeat',
        'style'   => array(
            'selectors'  => '#header',
            'properties' => 'background-repeat'
        )
    ),

    array(
        'id'      => 'typography-header-background-position',
        'type'    => 'select',
        'options' => array(
            'center'        => __( 'Center', 'yit' ),
            'top left'      => __( 'Top Left', 'yit' ),
            'top center'    => __( 'Top Center', 'yit' ),
            'top right'     => __( 'Top Right', 'yit' ),
            'bottom left'   => __( 'Bottom Left', 'yit' ),
            'bottom center' => __( 'Bottom Center', 'yit' ),
            'bottom right'  => __( 'Bottom Right', 'yit' ),
        ),
        'name'    => __( 'Background position', 'yit' ),
        'desc'    => __( 'Select the position for the background image of header.', 'yit' ),
        'std'     => 'top left',
        'style'   => array(
            'selectors'  => '#header',
            'properties' => 'background-position'
        )
    ),

    array(
        'id'      => 'typography-header-background-attachment',
        'type'    => 'select',
        'options' => array(
            'scroll' => __( 'Scroll', 'yit' ),
            'fixed'  => __( 'Fixed', 'yit' )
        ),
        'name'    => __( 'Background attachment', 'yit' ),
        'desc'    => __( 'Select the attachment for the background image of header.', 'yit' ),
        'std'     => 'scroll',
        'style'   => array(
            'selectors'  => '#header',
            'properties' => 'background-attachment'
        )
    ),

    array(
        'id'              => 'typography-header-logo-font',
        'type'            => 'typography',
        'name'            => __( 'Logo font', 'yit' ),
        'desc'            => __( 'Select the type to use for the logo font.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 48,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '800',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#logo #textual',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-logo-highlight-font',
        'type'            => 'typography',
        'name'            => __( 'Logo font highlight', 'yit' ),
        'desc'            => __( 'Select the type to use for the logo font highlight.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 48,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '800',
            'color'     => '#4da6b3',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'linked_to'       => 'theme-color-1',
        'style'           => array(
            'selectors'  => '#logo span.title-highlight',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-tagline-font',
        'type'            => 'typography',
        'name'            => __( 'Tagline font', 'yit' ),
        'desc'            => __( 'Select the type to use for the tagline below the logo.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#8c8c8c',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '#logo #tagline',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-tagline-highlight-font',
        'type'            => 'typography',
        'name'            => __( 'Tagline font highlight', 'yit' ),
        'desc'            => __( 'Select the type to use for the tagline highlight.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#4da6b3',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'linked_to'       => 'theme-color-1',
        'style'           => array(
            'selectors'  => '#logo #tagline span.title-highlight',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Slogan */
    array(
        'type' => 'title',
        'name' => __( 'Slogan', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-header-slogan-font',
        'type'            => 'typography',
        'name'            => __( 'Slogan font', 'yit' ),
        'desc'            => __( 'Select the type to use for the slogan.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 28,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#ffffff',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#slogan h2, #slogan h1',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-subslogan-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Slogan font', 'yit' ),
        'desc'            => __( 'Select the type to use for the sub slogan.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#b0b0b0',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '#slogan p',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'        => 'typography-slogan-highlight',
        'type'      => 'colorpicker',
        'name'      => __( 'Slogan title highlight', 'yit' ),
        'desc'      => __( 'Select the color to use for the highlight of titles', 'yit' ),
        'std'       => array(
            'color' => '#4da6b3'
        ),
        'linked_to' => 'theme-color-2',
        'style'     => array(
            'selectors'  => '#slogan h2 span.title-highlight, #slogan p span.title-highlight, #slogan.yith-checkout-single span.current',
            'properties' => 'color'
        )
    ),

    array(
        'id'    => 'typography-slogan-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Slogan background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your slogans', 'yit' ),
        'std'   => array(
            'color' => '#ffffff'
        ),
        'style' => array(
            'selectors'  => '#slogan',
            'properties' => 'background-color'
        )
    ),


    /* Typography and Color > i */
    array(
        'type' => 'title',
        'name' => __( 'Topbar', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-topbar-font',
        'type'            => 'typography',
        'name'            => __( 'Topbar font', 'yit' ),
        'desc'            => __( 'Select the font to use for the topbar.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 10,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#7b7b7b',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'linked_to'       => array(
            ''
        ),
        'style'           => array(
            'selectors'  => '#topbar, #topbar p',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-topbar-highlight-font',
        'type'            => 'typography',
        'name'            => __( 'Topbar highlight font', 'yit' ),
        'desc'            => __( 'Select the font to use for the highlight text topbar.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 10,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'linked_to'       => array(
            ''
        ),
        'style'           => array(
            'selectors'  => '#topbar .shortcode-highlight',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'    => 'typography-topbar-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Topbar background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your page topbar', 'yit' ),
        'std'   => array(
            'color' => '#f1f2f1'
        ),
        'style' => array(
            'selectors'  => '#topbar',
            'properties' => 'background-color'
        )
    ),

    array(
        'id'    => 'typography-topbar-border-bottom-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Topbar border bottom color', 'yit' ),
        'desc'  => __( 'Select the color to use as border bottom on your topbar', 'yit' ),
        'linked_to'  => array(
            'hover' => 'color-website-border-style-1',
        ),
        'std'   => array(
            'color' => '#f2f1f1'
        ),
        'style' => array(
            'selectors'  => '#topbar .header-wrapper',
            'properties' => 'border-bottom-color'
        )
    ),
    array(
        'id'         => 'topbar-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' )
        ),
        'name'       => __( 'Links', 'yit' ),
        'desc'       => __( 'Select the type to use for the links in your page header.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#000000',
                'hover'  => '#3e8e99'
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-1',
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '#topbar a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#topbar a:hover',
                'properties' => 'color'
            ),
        )
    ),


    array(
        'id'         => 'topbar-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' )
        ),
        'name'       => __( 'Topbar Menu Link color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in topbar menu', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#000000',
                'hover'  => '#3e8e99'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '#topnav .nav, .nav > ul > li:after',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#topbar .nav a:hover,
                                #topbar .nav ul > li:hover > a,
                                #topbar .nav .current-menu-item > a,
                                #topbar .nav .current-menu-ancestor > a,
                                #topbar .nav .current-page-item > a
                                #topbar .nav ul.sub-menu li a:hover,
                                #topbar .nav ul.children li a:hover,
                                #topbar .nav ul.sub-menu li a:hover,
                                #topbar .nav ul.children li a:hover,
                                #topbar .nav div.submenu li > div.submenu li a:hover',
                'properties' => 'color'
            ),
        )
    ),



    /* Typography and Color > Navigation */
    array(
        'type' => 'title',
        'name' => __( 'Navigation', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-navigation-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Navigation font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the navigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.header-nav ul li a,
                             #welcome-menu > ul > li > a,
                             #welcome-menu-login > ul > li > a,
                             .yit-mini-cart-icon .cart-items-number,
                              #header .widget_icl_lang_sel_widget li a,
                              .whislist_nav a,
                              .yit-vertical-megamenu .nav > ul > li > a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'typography-navigation-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' ),
        ),
        'name'       => __( 'Navigation Links Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in navigation menu', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#8c8c8c',
                'hover'  => '#3e8e99'
            )
        ),
        'linked_to'  => array(
            'hover' => 'typography-link-color-2',
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.header-nav ul li a,
                                 #welcome-menu > ul > li > a,
                                 #welcome-menu-login > ul > li > a,
                                 #header .widget_search a.trigger-search,
                                 #header .widget_product_search a.trigger-search,
                                 .yit-mini-cart-icon .cart-items-number,
                                 #header .widget_icl_lang_sel_widget li a,
                                 .whislist_nav a,
                                 .yit-vertical-megamenu .nav > ul > li > a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.header-nav ul li:hover > a,
                                 #welcome-menu > ul > li:hover > a,
                                 #welcome-menu-login > ul > li:hover > a,
                                 .header-nav ul li.current_page_item a,
                                 .header-nav ul li.current-menu-ancestor a,
                                 #header .widget_search a.trigger-search:hover,
                                 #header .widget_product_search a.trigger-search:hover,
                                 #header .widget_icl_lang_sel_widget li a:hover,
                                 .whislist_nav a:hover,
                                 .yit-vertical-megamenu .nav > ul > li > a:hover',
                'properties' => 'color'
            )
        )
    ),



    /* Typography and Color > Sub Navigation */
    array(
        'type' => 'title',
        'name' => __( 'Sub Navigation', 'yit' ),
        'desc' => ''
    ),
    array(
        'id'    => 'typography-subnavigation-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Sub Navigation background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your subnavigation bar', 'yit' ),
        'std'   => array(
            'color' => '#ffffff'
        ),
        'style' => array(
            'selectors'  => '.nav div.submenu',
            'properties' => 'background-color'
        )
    ),


    array(
        'id'              => 'typography-subnavigation-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Navigation font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the subnavigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav div.submenu ul li a,  #header .widget_icl_lang_sel_widget li ul li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'typography-subnavigation-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' ),
        ),
        'name'       => __( 'Subnavigation Links Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in submenu', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#8c8c8c',
                'hover'  => '#000000'
            )
        ),
        'linked_to'  => array(
            'hover' => 'typography-link-color-2',
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.nav div.submenu ul li a, .lang_sel_sel + li > a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.nav div.submenu ul li:hover a',
                'properties' => 'color'
            )
        )
    ),

    /* Typography and Color > Megamenu */
    array(
        'type' => 'title',
        'name' => __( 'Bigmenu', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-big-menu-title-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Navigation Title Big Menu font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the title in subnavigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav .bigmenu > .submenu > ul.sub-menu > li > a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-big-menu-subnavigation-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Navigation Big Menu font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the subnavigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav .bigmenu div.submenu li>div.submenu li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'typography-big-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'title-normal'   => __( 'Title', 'yit' ),
            'title-hover'    => __( 'Title hover', 'yit' ),
            'submenu-normal' => __( 'Submenu', 'yit' ),
            'submenu-hover'  => __( 'Submenu hover', 'yit' )
        ),
        'name'       => __( 'Bigmenu Links Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in bigmenu', 'yit' ),
        'std'        => array(
            'color' => array(
                'title-normal'   => '#000000',
                'title-hover'    => '#000000',
                'submenu-normal' => '#8c8c8c',
                'submenu-hover'  => '#000000'
            )
        ),
        'linked_to'  => array(
            'submenu-hover' => 'theme-color-2',
        ),
        'style'      => array(
            'title-normal'   => array(
                'selectors'  => '.nav .bigmenu > .submenu > ul.sub-menu > li > a',
                'properties' => 'color'
            ),
            'title-hover'    => array(
                'selectors'  => '.nav .bigmenu > .submenu > ul.sub-menu > li:hover > a',
                'properties' => 'color'
            ),
            'submenu-normal' => array(
                'selectors'  => '.nav .bigmenu div.submenu li>div.submenu li a',
                'properties' => 'color'
            ),
            'submenu-hover'  => array(
                'selectors'  => '.nav .bigmenu div.submenu li>div.submenu li:hover a,
                                 .nav .bigmenu div.submenu li>div.submenu li.current-menu-item a,
                                 .nav .bigmenu div.submenu li>div.submenu li.current_page_item a',
                'properties' => 'color'
            ),
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Mini Search Colors', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'         => 'mini-search-label-text',
        'type'       => 'typography',
        'name'       => __( 'Mini Search Font', 'yit' ),
        'desc'       => __( 'Choose the font type, size and color for the mini search', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#8c8c8c',
            'align'     => 'left',
            'transform' => 'uppercase'
        ),
        'style'           => array(
            'selectors'  => '#header-search label',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              color,
                              text-align'
        )
    ),

    array(
        'id'         => 'mini-search-text',
        'type'       => 'typography',
        'name'       => __( 'Mini Search Input Text Font', 'yit' ),
        'desc'       => __( 'Choose the font type, size and color for the text input of mini search', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#8b8685',
            'align'     => 'left',
            'transform' => 'none'
        ),
        'style'           => array(
            'selectors'  => '#header-search input#s, #header-search input#yith-s',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              color,
                              text-align'
        )
    ),

    array(
        'id'         => 'mini-search-border-suggestions',
        'type'       => 'colorpicker',
        'name'       => __( 'Mini Search Border of Suggestions', 'yit' ),
        'desc'       => __( 'Choose the color of border in search ajax suggestions box', 'yit' ),
        'std'             => array(
            'color'     => '#f2f0f0',
        ),
        'style'           => array(
            'selectors'  => '#header-search .autocomplete-suggestion',
            'properties' => 'border-color'
        )
    ),


);
