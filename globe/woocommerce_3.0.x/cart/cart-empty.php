<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="cart-empty col-sm-12">

    <h2 class="empty-message"><?php _e( 'Your cart is currently empty', 'yit' ) ?></h2>

    <p><?php _e( 'Your have not added any items in your shopping cart', 'yit' ) ?></p>

    <?php do_action( 'woocommerce_cart_is_empty' ); ?>

    <div class="empty-button">
        <p>
            <a class="btn btn-ghost" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Start To Shop', 'yit' ) ?></a>
        </p>
    </div>

</div>