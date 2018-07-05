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
 * Return an array with the options for Theme Options > Typography and Color > Shop
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @author  Francesco Licandro <francesco.licandro@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Shop > Shop Page */
    array(
        'type' => 'title',
        'name' => __( 'Shop Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-page-product-name-font',
        'type'            => 'typography',
        'name'            => __( 'Product title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#454545',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.product-meta h3.product-name, .product-meta h3.product-name a,
                             #product-nav > a h5,
                             .woocommerce table.cart td.product-name div.product-name a,
                             .widget_shopping_cart .widget_shopping_cart_content .mini-cart-item-info a,
                             .widget_shopping_cart .widget_shopping_cart_content .total span.amount,
                             .wishlist_table tr td.product-name a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-product-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#454545',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.product-meta .price, .product-meta .price .amount, .widget.woocommerce ul.product_list_widget span.product_price,
                             #product-nav > a div.product-info p span',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-layout-selector',
        'type'            => 'typography',
        'name'            => __( 'Page and Layout Selector font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#686868',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#list-or-grid span, #number-of-products span,
                            #page-meta form.woocommerce-ordering .sbHolder .sbSelector,
                            #number-of-products a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-cart-stock-icon',
        'type'            => 'typography',
        'name'            => __( 'Added to Cart and Out of Stock Icon', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#636363',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.woocommerce ul.products li.product .thumb-wrapper .out-of-stock-icon .out-of-stock-text span,
                             .woocommerce ul.products li.product .thumb-wrapper .added-to-cart-icon .added-to-cart-text span',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-notice-font',
        'type'            => 'typography',
        'name'            => __( 'Woocommerce Notice font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#7b7b7b',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.woocommerce-info, .woocommerce-message, .woocommerce-error,
                             .woocommerce .coupon-form-checkout .coupon_link, .woocommerce .login-form-checkout .login-form-link',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Shop > Product Detail Page */

    array(
        'type' => 'title',
        'name' => __( 'Single Product Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-single-product-name-font',
        'type'            => 'typography',
        'name'            => __( 'Product name font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 24,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#454545',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary h1,
                             .single-product.woocommerce div.product div.product-title-section h1',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 24,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#939393',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary .price,
                             .single-product.woocommerce div.product div.summary .price span.amount,
                             .single-product.woocommerce div.product div.product-title-section .price,
                             .single-product.woocommerce div.product div.product-title-section .price span.amount',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-label-font',
        'type'            => 'typography',
        'name'            => __( 'Product page label font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#454545',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary form.cart h4,
                            .single-product.woocommerce div.product form.cart ul.variations label,
                            div.summary.entry-summary form.variations_form.cart .single_variation_wrap h4',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-tabs-font',
        'type'            => 'typography',
        'name'            => __( 'Product tabs title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#989898',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.woocommerce-tabs ul.tabs li a,
                            #product-nav span.icon-wrap',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'    => 'shop-out-of-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Out of Stock" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Out of Stock" label.', 'yit' ),
        'std'   => array(
            'color' => '#9d1414'
        ),
        'style' => array(
            'selectors'  => '.woocommerce div.product .stock.out-of-stock,
                             .woocommerce-page div.product .stock.out-of-stock',
            'properties' => 'color'
        )
    ),

    array(
        'id'    => 'shop-in-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Stock Quantity" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Stock Quantity" label.', 'yit' ),
        'std'   => apply_filters( 'yit_shop-in-stock-color_std', array(
            'color' => '#85ad74'
        ) ),
        'style' => apply_filters( 'yit_shop-in-stock-color_style', array(
            'selectors'  => '.woocommerce div.product .stock,
                             .woocommerce-page div.product .stock,
                             .wishlist_table tr td.product-stock-status span.wishlist-in-stock',
            'properties' => 'color'
        ) )
    ),


    /* Typography and Color > Shop > My-Account page */
    array(
        'type' => 'title',
        'name' => __( 'My Account Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'my-account-page-menu-font',
        'type'            => 'typography',
        'name'            => __( 'My Account sidebar menu font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#989898',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#my-account-sidebar ul li > a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),


    array(
        'id'              => 'my-account-content-title-font',
        'type'            => 'typography',
        'name'            => __( 'My Account content title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#454545',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#my-account-content h2',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'    => 'my-account-login-border-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Border color of Login Box', 'yit' ),
        'desc'  => __( 'Select a color for the border of Login Box', 'yit' ),
        'std'   => array(
            'color' => '#eeeeee'
        ),
        'style' => array(
            'selectors'  => '#customer_login .already_registered,
            .cta-phone,
            .cta-phone.call-to-action h3:after,
            .cta-phone.call-to-action h3:after,
            .cta-phone.call-to-action .cta-phone-phone:after',
            'properties' => 'border-color'
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Widget List Products', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-widget-title-price-font',
        'type'            => 'typography',
        'name'            => __( 'Widget Product title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#060606',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.widget.woocommerce ul.product_list_widget a span.product_title,
                             .single-product.woocommerce ul.product_list_widget a span.product_title,
                             .widget.yit_products_category a span.product_title,
                             .widget.woocommerce.widget_recent_reviews ul.product_list_widget li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-widget-price-font',
        'type'            => 'typography',
        'name'            => __( 'Widget Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#939393',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.widget.woocommerce ul.product_list_widget a span.product_price,
                            .single-product.woocommerce ul.product_list_widget a span.product_price,
                             .widget.yit_products_category a span.product_price',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Cart Header Widget', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-cart-header-widget-label-font',
        'type'            => 'typography',
        'name'            => __( 'Cart header title', 'yit' ),
        'desc'            => __( 'Select the font to use for the title before the products list.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#header .widget_shopping_cart .widget_shopping_cart_content h5.list-title',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'shop-cart-header-widget-link-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'     => __( 'Link', 'yit' ),
            'hover' => __( 'Link hover', 'yit' ),
        ),
        'name'       => __( 'Cart Header Widget Link Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header cart link', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'    => '#454545',
                'hover'     => '#3e8e99',
            )
        ),
        'style'      => array(
            'normal'     => array(
                'selectors'  => '
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a,
                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a,
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal,

                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal',
                'properties' => 'color'
            ),
            'hover' => array(
                'selectors'  => '
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a:hover,
                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a:hover',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'shop-cart-header-widget-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Cart Header Widget Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header cart widget border and background', 'yit' ),
        'std'        => array(
            'color' => array(
                'border'     => '#f7f7f9',
                'background' => '#ffffff',
            )
        ),
        'style'      => array(
            'border'     => array(
                'selectors'  => '.woocommerce #header-sidebar .yit_cart_widget .cart_wrapper, #header-sidebar .yit_cart_widget .cart_wrapper .widget_shopping_cart_content',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '.woocommerce #header-sidebar .yit_cart_widget .cart_wrapper, #header-sidebar .yit_cart_widget .cart_wrapper .widget_shopping_cart_content',
                'properties' => 'background'
            )
        )
    )
);

