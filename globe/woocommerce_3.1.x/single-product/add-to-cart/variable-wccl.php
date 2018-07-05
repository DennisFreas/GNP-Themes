<?php
/**
 * Variable product add to cart
 *
 * @author  Your Inspiration Themes
 * @package YITH WooCommerce Colors and Labels Variations
 * @version 1.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>" data-wccl="true">
        <?php if ( ! empty( $available_variations ) ) : ?>
            <ul class="variations" cellspacing="0">

                <?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop ++; ?>
                    <li>
                        <label for="<?php echo sanitize_title( $name ); ?>"><?php echo wc_attribute_label( $name ); ?></label>
                        <select id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo sanitize_title( $name ); ?>" data-type="<?php echo $attributes_types[$name] ?>">
                            <option value=""><?php echo __( 'Choose an option', 'yit' ) ?>&hellip;</option>
                            <?php
                            if ( is_array( $options ) ) {

                                $selected_value = isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) : $product->get_variation_default_attribute( $name );

								// Get terms if this is a taxonomy - ordered
                                if ( $product && taxonomy_exists( $name ) ) {

                                    if ( function_exists( 'wc_get_product_terms' ) ) {
                                        $terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );
                                    } else {
                                        $terms = get_terms( $name, $args );
                                    }

                                    foreach ( $terms as $term ) {
                                        if ( ! in_array( $term->slug, $options ) ) {
                                            continue;
                                        }
                                        $value = get_woocommerce_term_meta( $term->term_id, $name . '_yith_wccl_value' );
                                        echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . ' data-value="'. $value .'">' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
                                    }

                                } else {

                                    foreach ( $options as $option ) {
                                        // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                                        $selected = sanitize_title( $selected_value ) === $selected_value ? selected( $selected_value, sanitize_title( $option ), false ) : selected( $selected_value, $option, false );
                                        echo '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </li>
                <?php endforeach;?>
            </ul>

            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

            <?php
            if ( sizeof( $attributes ) == $loop ) {
                echo '<a class="reset_variations" href="#reset">- ' . __( 'Clear selection', 'yit' ) . '</a>';
            }
            ?>

            <div class="clearfix"></div>

            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

            <div class="single_variation_wrap" style="display:none;">
                <?php
                /**
                 * woocommerce_before_single_variation Hook
                 */
                do_action( 'woocommerce_before_single_variation' );

                /**
                 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                 * @since 2.4.0
                 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                 */
                do_action( 'woocommerce_single_variation' );

                /**
                 * woocommerce_after_single_variation Hook
                 */
                do_action( 'woocommerce_after_single_variation' );
                ?>

            </div>

            <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

        <?php else : ?>

            <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'yit' ); ?></p>

        <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>

    </form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
