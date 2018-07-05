<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

    <h5 class="list-title"><?php _e( 'Recently Added', 'yit' ) ?></h5>

    <ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                ?>
                <li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <?php
                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                        esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                        __( 'Remove this item', 'yit' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                    ), $cart_item_key ); 
                    ?>
                    <a href="<?php echo get_permalink( $product_id ); ?>" class="mini-cart-thumb"><?php echo $thumbnail?></a>
                    <span class="mini-cart-item-info">
                        <a href="<?php echo get_permalink( $product_id ); ?>"><?php echo $product_name; ?></a>
                        <span class="mini-cart-item-subtotal">
                              <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                              <?php echo apply_filters( 'woocommerce_cart_item_subtotal', '<span class="subtotal">'. WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ). '</span>', $cart_item, $cart_item_key ); ?>
                        </span>
                    </span>

                    <?php echo WC()->cart->get_item_data( $cart_item ); ?>

                </li>
            <?php
            }
        }
        ?>

    </ul><!-- end product list -->

    <p class="total"><span><?php _e( 'Cart total', 'yit' ); ?></span> <?php echo WC()->cart->get_cart_subtotal(); ?>
    </p>

    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

    <p class="buttons">
        <a href="<?php echo wc_get_cart_url(); ?>" class="button wc-forward btn-ghost"><?php _e( 'View Cart', 'yit' ); ?></a>
        <a href="<?php echo wc_get_checkout_url(); ?>" class="button checkout wc-forward btn-flat"><?php _e( 'Checkout', 'yit' ); ?></a>
    </p>

<?php else : ?>

    <p class="empty"><?php _e( 'No products in the cart.', 'yit' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>