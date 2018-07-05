<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$show_slogan             = YIT_Layout()->show_slogan;
$slogan                  = YIT_Layout()->slogan;
$subslogan               = YIT_Layout()->sub_slogan;
$slogan_color            = YIT_Layout()->slogan_color;
$slogan_border           = YIT_Layout()->slogan_border;
$slogan_border_color     = YIT_Layout()->slogan_border_color;
$subslogan_color         = YIT_Layout()->subslogan_color;

if( empty( $show_slogan ) || $show_slogan == 'no' ){

    if ( function_exists( 'WC' ) && ( ( is_cart() && ( sizeof( WC()->cart->get_cart() ) != 0 ) ) || ( is_checkout() && ! is_account_page() ) || is_order_received_page() ) ) {

        $slogan_class           = 'yit-cart-checkout-slogan';
        $show_slogan            = YIT_Layout()->checkout_show_slogan;
        $slogan_color           = YIT_Layout()->checkout_text_color;
        $slogan_active_color    = YIT_Layout()->checkout_active_text_color;
        $slogan_image           = YIT_Layout()->checkout_background_image;
        $slogan_text_style      = array();
        $slogan_text            = array(
            'cart'              => __( YIT_Layout()->checkout_cart_text , 'yit' ),
            'checkout'          => __( YIT_Layout()->checkout_text , 'yit' ),
            'order_complete'    => __( YIT_Layout()->checkout_order_complete_text, 'yit' )
        );

        if( ! empty( $slogan_image ) || 'no' == YIT_Layout()->myaccount_show_slogan ){
            $slogan_background = "background: url({$slogan_image}) no-repeat top center";
        }else{
            $slogan_background = '';
        }

        $slogan_text_style['cart']              = is_cart() ? "color: {$slogan_active_color};" : "color: {$slogan_color};";
        $slogan_text_style['checkout']          = ( is_checkout() && ! is_order_received_page() ) ? "color: {$slogan_active_color};" : "color: {$slogan_color};";
        $slogan_text_style['order_complete']    = is_order_received_page() ? "color: {$slogan_active_color};" : "color: {$slogan_color};";

        ob_start();

        ?>
        <style>
            #slogan.yit-cart-checkout-slogan .slogan-checkout:before,
            #slogan.yit-cart-checkout-slogan .slogan-complete:before{
                color: <?php echo $slogan_color ?>;
            }

            #slogan.yit-cart-checkout-slogan .slogan-cart{
                <?php echo $slogan_text_style['cart'] ?>
            }

            #slogan.yit-cart-checkout-slogan .slogan-checkout{
                <?php echo $slogan_text_style['checkout'] ?>
            }

            #slogan.yit-cart-checkout-slogan .slogan-complete {
                <?php echo $slogan_text_style['order_complete'] ?>
            }

        </style>

        <span class="slogan-cart"><?php echo $slogan_text['cart'] ?></span>

        <span class="slogan-checkout"><?php echo $slogan_text['checkout'] ?></span>

        <span class="slogan-complete"><?php echo $slogan_text['order_complete'] ?></span>
        <?php

        $slogan = ob_get_clean();

    }
    elseif( function_exists( 'WC' ) &&  is_account_page() ) {

        $slogan_class           = 'yit-my-account-slogan';
        $show_slogan            = YIT_Layout()->myaccount_show_slogan;
        $slogan_color           = YIT_Layout()->myaccount_text_color;
        $slogan_border_color    = YIT_Layout()->myaccount_border_color;
        $slogan                 = is_user_logged_in() ? __( YIT_Layout()->myaccount_welcome_text , 'yit' ) : __( YIT_Layout()->myaccount_login_text , 'yit' );
        $slogan_border          = ! empty($slogan) ? 'yes' : 'no';
        $slogan_image           = YIT_Layout()->myaccount_background_image;
        $show_user_name         = YIT_Layout()->myaccount_show_user_name;

        if( ! empty( $slogan_image ) || 'no' == YIT_Layout()->myaccount_show_slogan ){
            $slogan_background = "background: url({$slogan_image}) no-repeat top center";
        }else{
            $slogan_background = '';
        }

        if( 'yes' == $show_user_name && is_user_logged_in() ){
            $current_user = get_user_by( 'id', get_current_user_id() );
            $slogan .= $current_user->display_name;
        }
    }
}

if ( empty( $show_slogan ) || $show_slogan == 'no' ) {
    return;
}

$border = ( $slogan_border == 'yes' ) ? 'border-color:' . $slogan_border_color .'' : 'border: 0px';

$tag = 'h2';
if ( '0' == YIT_Layout()->show_title ) {
    $tag = 'h1';
}

?>

<!-- START SLOGAN -->
<div id="slogan" <?php if( isset( $slogan_class ) ): echo 'class="' .$slogan_class . '"'; endif; ?> style="<?php echo isset( $slogan_background ) ? $slogan_background : ''; ?>" >
    <div class="container">
        <div class="slogan-wrapper">
            <?php echo ( $slogan_border == 'yes') ? '<div class="slogan-border" style="' . $border . '">' : '';  ?>
            <?php if( ! empty( $slogan ) ) : ?>
                <<?php echo $tag ?> <?php if( $slogan_color != '' ) : echo 'style="color: ' .$slogan_color . '"'; endif; ?> ><?php echo $slogan ?></<?php echo $tag ?>>
            <?php endif; ?>
            <?php if( ! empty( $subslogan ) ) : ?>
                <p <?php if( $subslogan_color != '' ): echo 'style="color: ' .$subslogan_color . '"'; endif; ?> ><?php echo do_shortcode( $subslogan ) ?></p>
            <?php endif; ?>
            <?php echo ( $slogan_border == 'yes') ? '</div>' : '';  ?>
        </div>
    </div>
</div>
<!-- END SLOGAN -->

