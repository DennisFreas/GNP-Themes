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
 * Return an array with the options for Theme Options > Typography and Color > General Settings
 *
 * @package Yithemes
 * @author  Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since   2.0.0
 * @return  mixed array
 *
 */
return array(
    /* Typography and Color > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Main general color scheme', 'yit' ),
        'desc' => __( "Set the different colors shades for the main theme's color", 'yit' )
    ),

    array(
        'id'             => 'theme-color-1',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 1', 'yit' ),
        'desc'           => __( 'Set the first shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#3e8e99'
        ),
        'style'          => array(
            'selectors'  => '.shade-1, .toggle .toggle-title .tab-opened h4, .toggle .toggle-title h4:hover',
            'properties' => 'color'
        )
    ),

    array(
        'id'             => 'theme-color-2',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 2', 'yit' ),
        'desc'           => __( 'Set the second shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#000000'
        ),
        'style'          => array(
            'selectors'  => '.shade-2,
                             .dropcap,
                             .random-numbers span.number,
                             .images-slider-sc .flex-direction-nav li a:hover,
                             .logos-slider.wrapper .nav .prev:hover i:before,
                             .logos-slider.wrapper .nav .next:hover i:before,
                             #commentform .comment-form-comment #comment,
                             .tabs-container ul.tabs li.current a, .tabs-container ul.tabs li a:hover,
                             #commentform input:not([type=submit]),
                             .logos-slider .nav .next i:hover,
                             #portfolio_nav > a:hover span.icon-wrap:before,
                             #portfolio_nav > a:hover span.icon-wrap:after,
                             #portfolio_nav > a:hover span.icon-wrap',
            'properties' => 'color'
        )
    ),

        array(
        'id'             => 'theme-color-3',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 3', 'yit' ),
        'desc'           => __( 'Set the second shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#8c8c8c'
        ),
        'style'          => array(
            'selectors'  => '.shade-3, .images-slider-sc .flex-direction-nav li a,
            .logos-slider .nav .next i, .yit_post_quote .fa.shade-1',
            'properties' => 'color'
        )
    ),

    array(
        'id'             => 'general-background-color',
        'type'           => 'colorpicker',
        'name'           => __( 'General Background Color', 'yit' ),
        'desc'           => __( 'Set the general background color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#f2f0f0'
        ),
        'style'          => array(
            'selectors'  => '.faq-title.active .faq-icon, .widget.yit-vertical-megamenu h3,
                             .toggle .toggle-title span.fa.fa-minus.opened',
            'properties' => 'background-color'
        )
    ),


    array(
        'id'    => 'color-website-border-style-1',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 1', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#e7e4e4'
        ),
        'style' => array(
            array(
                'selectors'  => $this->get_selectors( 'border-1-top' ),
                'properties' => 'border-top-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-1-bottom' ),
                'properties' => 'border-bottom-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-1-all' ),
                'properties' => 'border-color'
            ),
            array(
                'selectors'  => '.border-line-1',
                'properties' => 'background-color'
            )
        )
    ),

    array(
        'id'    => 'color-website-border-style-2',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 2', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#454545'
        ),
        'style' => array(
            array(
                'selectors'  => $this->get_selectors( 'border-2-top' ),
                'properties' => 'border-top-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-2-bottom' ),
                'properties' => 'border-bottom-color'
            ),

            array(
                'selectors'  => $this->get_selectors( 'border-2-all' ),
                'properties' => 'border-color'
            ),
            array(
                'selectors'  => '.border-line-2',
                'properties' => 'background-color'
            )
        )
    ),

    array(
        'id'        => 'color-theme-star',
        'type'      => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Empty', 'yit' ),
            'hover'  => __( 'Full', 'yit' )
        ),
        'name'      => __( 'General Stars Color', 'yit' ),
        'desc'      => __( 'Select the color used in the theme for the theme stars.', 'yit' ),
        'std'  => array(
            'color' => array(
                'normal' => '#b5b4b4',
                'hover'  => '#313334'
            )
        ),
        'style'     => array(
            'normal' => array(
                'selectors'   => '.woocommerce ul.products li.product .product-rating span.star-empty,
                                .single-product.woocommerce div.product div.summary .product-rating span.star-empty,
                                .testimonial-wrapper .testimonial-rating span.star-empty,
                                #comments div.comment-text div.meta .product-rating span.star-empty,
                                .yit_recent_reviews .reviews-rating span.star-empty,
                                .widget.testimonial-widget  ul li .name-testimonial .testimonial-rating span.star-empty',
                'properties'  => 'color'
            ),
            'hover' => array(
                'selectors'   => '.woocommerce ul.products li.product .product-rating span.star,
                                .single-product.woocommerce div.product div.summary .product-rating span.star,
                                .testimonial-wrapper .testimonial-rating span.star,
                                #comments div.comment-text div.meta .product-rating span.star,
                                .yit_recent_reviews .reviews-rating span.star,
                                .star-rating:before,
                                .woocommerce-tabs #review_form p.stars a.active,
                                .widget.testimonial-widget  ul li .name-testimonial .testimonial-rating span.star',
                'properties'  => 'color'
            )
        )
    ),
);

