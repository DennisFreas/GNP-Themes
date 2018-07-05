<?php
/**
 * Single variation product add to cart
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

?>

<div class="variations_button group">
	<h4 class="quantity_label"><?php _e( 'Quantity: ', 'yit' ) ?></h4>
	<?php woocommerce_quantity_input(); ?>
	<button type="submit" class="single_add_to_cart_button btn btn-flat"><?php echo apply_filters( 'add_to_cart_text' , $product->single_add_to_cart_text() ); ?></button>
</div>

<input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>" />
<input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>" />
<input type="hidden" name="variation_id" value="" />