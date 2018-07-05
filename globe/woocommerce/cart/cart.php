<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" class="clearfix cart-page">

    <div class="row">

        <div class="col-sm-8 cart-list">

            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <table class="shop_table cart woocommerce-cart-form__contents" cellspacing="0">
                <thead class="border">
                <tr>
                    <th class="product-remove"></th>
                    <th class="product-name"><?php _e( 'Description', 'yit' ); ?></th>
                    <th class="product-quantity"><?php _e( 'Quantity', 'yit' ); ?></th>
                    <th class="product-subtotal"><?php _e( 'Subtotal', 'yit' ); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> border">

                                <!-- Remove from cart link -->
                                <td class="product-remove">
                                    <?php
                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" title="%s" class="remove a-style-2">X</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), __( 'Remove this item', 'yit' ) ), $cart_item_key );
                                    ?>
                                </td>
                                <!-- Product Name -->
                                <td class="product-name">
                                    <!-- The thumbnail -->
                                    <div class="product-thumbnail">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                        if ( ! $_product->is_visible() )
                                            echo wp_kses_post( $thumbnail );
                                        else
                                            printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), wp_kses_post( $thumbnail) );
                                        ?>
                                    </div>

                                    <div class="product-name-price">
                                        <div class="product-name">
                                            <?php
                                            if ( ! $_product->is_visible() )
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                            else
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', $_product->get_permalink( $cart_item ), $_product->get_name() ), $cart_item, $cart_item_key ) );

                                            // Meta data
                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                            // Backorder notification
                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo '<p class="backorder_notification">' . __( 'Available on backorder', 'yit' ) . '</p>';
                                            }
                                            ?>
                                        </div>


                                        <!-- Product price -->
                                        <div class="product-price">
                                            <?php
                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                            ?>
                                        </div>
                                    </div>
                                </td>


                                <!-- Quantity inputs -->
                                <td class="product-quantity">
                                    <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                    }
                                    else {

                                        $product_quantity = woocommerce_quantity_input( array(
                                            'input_name'  => "cart[{$cart_item_key}][qty]",
                                            'input_value' => $cart_item['quantity'],
                                            'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                            'min_value'   => '0'
                                        ), $_product, false );
                                    }

                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </td>

                                <!-- Product subtotal -->
                                <td class="product-subtotal">
                                    <?php
                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </td>

                            </tr>
                        <?php
                        }
                    }

                do_action( 'woocommerce_cart_contents' );
                ?>

                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                </tbody>
            </table>

            <?php do_action( 'woocommerce_after_cart_table' ); ?>

                <div class="row after-cart">

                    <?php if ( wc_coupons_enabled() ) : ?>
                        <div class="col-sm-12">
                            <h3 class="head"><?php _e( 'Promotional code', 'yit' ); ?></h3>
                            <table class="shop_table coupon" cellspacing="0">
                                <tr>
                                    <td>
                                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Enter your promotional code', 'yit' ); ?>" />
                                        <input type="submit" class="btn btn-flat" name="apply_coupon" value="<?php _e( 'Apply', 'yit' ); ?>" />

                                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php endif ?>
                </div>

            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
        </div>


        <div class="col-sm-4 cart-user-info">

            <div class="cart-collaterals border">
                <?php do_action( 'woocommerce_cart_collaterals' ); ?>
            </div>

        </div>

    </div>

    </form>

    <div class="row">
        <div class="col-sm-8 woocommerce-shipping-calculator-box">
            <div class="after-cart">
                <?php woocommerce_shipping_calculator(); ?>
            </div>
        </div>
    </div>

<?php do_action( 'woocommerce_after_cart' ); ?>