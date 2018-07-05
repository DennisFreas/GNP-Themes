<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for show the products
 *
 * @package Yithemes
 * @author  Emanuela Castorina <emanuela.castorina@yithemes.com>
 * @since   1.0.0
 */

$query_args = array(
    'posts_per_page' => 1,
    'p'             => $product_id,
    'post_type'      => 'product',
);


$products = new WP_Query( $query_args );
$last_element = ( $last_element == 'yes' ) ? ' last' : '';
$animate = ( $animate != '' ) ? ' yit_animate '.$animate : '';
$delay = ( $animation_delay  != '' ) ? 'data-delay="'.$animation_delay.'"' : '';

if ( $products->have_posts() ) :
    echo '<div class="woocommerce single-product">';
    echo '<ul class="product_list_widget' . $last_element . '">';
    while( $products->have_posts() ):
        $products->the_post();
        wc_get_template( 'content-widget-product.php' );
    endwhile;
    echo '</div>';
endif;

wp_reset_query();

?>
