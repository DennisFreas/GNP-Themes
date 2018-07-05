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
 * Return an array with the options for Theme Options > Typography and Color > Buttons
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Buttons */

    array(
        'type' => 'title',
        'name' => __( 'Buttons Flat', 'yit' ),
        'desc' => ''
    ),

        array(
        'id'              => 'button-flat-font',
        'type'            => 'typography',
        'name'            => __( 'Buttons Typography', 'yit' ),
        'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-flat, a.btn-flat, .blog input[type="submit"], #yith-searchsubmit, .button, a.button,
                            .btn-alternative, a.btn-alternative, #submit,
                            #my-account-content .addresses .title a.edit',

            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform'
        )
    ),

    array(
        'id'         => 'button-flat-text-color',
        'type'       => 'colorpicker',
        'name'       => __( 'Buttons Text color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#ffffff',
                'hover'  => '#ffffff'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-flat, a.btn-flat, #yith-searchsubmit, .button, a.button,
                                .btn-alternative, a.btn-alternative, #submit,
                                #my-account-content .addresses .title a.edit,
                                #show-category-product div.category-count div.category-count-content span,
                                .categories-slider div.category-count div.category-count-content span',

                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-flat:hover, a.btn-flat:hover, #yith-searchsubmit:hover, .button:hover, a.button:hover,
                                .btn-alternative:hover, a.btn-alternative:hover, #submit:hover,
                                #my-account-content .addresses .title a.edit:hover',

                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-flat-border-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'name'       => __( 'Buttons border color', 'yit' ),
        'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#4da6b3',
                'hover'  => '#648084'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-flat, a.btn-flat, #yith-searchsubmit, .button, a.button,
                                .btn-alternative, a.btn-alternative, #submit',

                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-flat:hover, a.btn-flat:hover, #yith-searchsubmit:hover, .button:hover, a.button:hover,
                                .btn-alternative:hover, a.btn-alternative:hover, #submit:hover',
                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-flat-background-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'name'       => __( 'Buttons background color', 'yit' ),
        'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#4da6b3',
                'hover'  => '#648084'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-flat, a.btn-flat, #yith-searchsubmit,
                                .widget_price_filter .ui-slider .ui-slider-handle,
                                .widget_price_filter .ui-slider .ui-slider-range,
                                .button, a.button,
                                .btn-alternative, a.btn-alternative, #submit,
                                #my-account-content .addresses .title a.edit,
                                #show-category-product div.category-count,
                                .categories-slider div.category-count',

                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => '.btn-flat:hover, a.btn-flat:hover, #yith-searchsubmit:hover, .button:hover, a.button:hover,
                                .btn-alternative:hover, a.btn-alternative:hover, #submit:hover,
                                #my-account-content .addresses .title a.edit:hover',

                'properties' => 'background-color, background'
            )
        )
    ),

    /* ========= Ghost Button =========== */

    array(
        'type' => 'title',
        'name' => __( 'Ghost Button', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'button-ghost-font',
        'type'            => 'typography',
        'name'            => __( 'Ghost Buttons Typography', 'yit' ),
        'desc'            => __( 'Select the typography for ghost buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-ghost,
                             a.btn-ghost,
                             .woocommerce li.product .add-request-quote-button.button, .woocommerce .summary .add-request-quote-button.button,
                             .yith-ywraq-add-to-quote .yith_ywraq_add_item_response_message,
                             .yith-ywraq-add-to-quote .yith_ywraq_add_item_browse_message a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
        )
    ),

    array(
        'id'         => 'button-hover-color-ghost',
        'type'       => 'colorpicker',
        'name'       => __( 'Ghost Buttons Text Color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the ghost buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit ' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#648084',
                'hover'  => '#ffffff'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-ghost, a.btn-ghost,
                                 .woocommerce li.product .add-request-quote-button.button, .woocommerce .summary .add-request-quote-button.button,
                                 .yith-ywraq-add-to-quote .yith_ywraq_add_item_response_message,
                                 .yith-ywraq-add-to-quote .yith_ywraq_add_item_browse_message a',
                 'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost:hover,
                                a.btn-ghost:hover',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-border-color-ghost',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'linked_to'  => array(
            'normal' => 'theme-color-2'
        ),
        'name'       => __( 'Ghost Buttons border color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#648084',
                'hover'  => '#648084'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-ghost, a.btn-ghost',
                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover',
                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-background-color-ghost',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-3'
        ),
        'name'       => __( 'Ghost Buttons background color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => 'transparent',
                'hover'  => '#648084'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost, .btn-ghost',
                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover',
                'properties' => 'background-color, background'
            )
        )
    ),


    /* ========= Ghost White Button =========== */

    array(
        'type' => 'title',
        'name' => __( 'Ghost White Button', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'button-ghost-white-font',
        'type'            => 'typography',
        'name'            => __( 'Ghost White Buttons Typography', 'yit' ),
        'desc'            => __( 'Select the typography for ghost buttons text.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.btn-ghost-white,
                             a.btn-ghost-white',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
        )
    ),

    array(
        'id'         => 'button-hover-color-ghost-white',
        'type'       => 'colorpicker',
        'name'       => __( 'Ghost White Buttons Text Color', 'yit' ),
        'desc'       => __( 'Select the color of the text for the ghost buttons of every page', 'yit' ),
        'variations' => array(
            'normal' => __( 'Text color', 'yit' ),
            'hover'  => __( 'Text hover color', 'yit ' )
        ),
        'std'        => array(
            'color' => array(
                'normal' => '#ffffff',
                'hover'  => '#000000'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-ghost-white, a.btn-ghost-white',
                 'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost-white:hover,
                                a.btn-ghost-white:hover',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'button-border-color-ghost-white',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Border color', 'yit' ),
            'hover'  => __( 'Border hover color', 'yit' )
        ),
        'linked_to'  => array(
            'normal' => 'theme-color-2'
        ),
        'name'       => __( 'Ghost White Buttons border color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost buttons border of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#ffffff',
                'hover'  => '#ffffff'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.btn-ghost-white, a.btn-ghost-white',
                'properties' => 'border-color'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost-white:hover, a.btn-ghost-white:hover',
                'properties' => 'border-color'
            )
        )
    ),

    array(
        'id'         => 'button-background-color-ghost-white',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Background color', 'yit' ),
            'hover'  => __( 'Background hover color', 'yit ' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-3'
        ),
        'name'       => __( 'Ghost White Buttons background color', 'yit' ),
        'desc'       => __( 'Select a color for the ghost buttons background of all pages.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => 'transparent',
                'hover'  => '#ffffff'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => 'a.btn-ghost-white, .btn-ghost-white',
                'properties' => 'background-color, background'
            ),
            'hover'  => array(
                'selectors'  => '.btn-ghost-white:hover, a.btn-ghost-white:hover',
                'properties' => 'background-color, background'
            )
        )
    )
);

