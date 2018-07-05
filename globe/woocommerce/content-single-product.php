<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$size = yit_image_content_single_width();
$style = "";

if ( ! empty( $size ) && $size['content'] != 100 ) {
    $style = 'style="width:' . $size['content'] . '%; padding-left: 20px;"';
}
elseif ( ! empty( $size ) ) {
    $style = 'style="width:' . $size['content'] . '%"';
}

do_action( 'yit_check_single_product_layout' );

?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}

$sidebar = YIT_Layout()->sidebars;

if( $sidebar['layout'] != 'sidebar-no' ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    if ( yit_get_option( 'shop-single-product-name' ) == 'yes' ) add_action( 'yit_product_with_sidebar', 'woocommerce_template_single_title', 5 );
    if ( yit_get_option('shop-enable') == 'yes' && yit_get_option('shop-single-product-price') == 'yes' ) add_action( 'yit_product_with_sidebar', 'woocommerce_template_single_price', 10 );
}

if ( yit_get_option('shop-enable') == 'no' || yit_get_option( 'shop-single-add-to-cart' ) == 'no' ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}

?>

<div itemscope id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

    <?php if( $sidebar['layout'] != 'sidebar-no' ) : ?>
        <div class="clearfix product-title-section">
            <?php do_action('yit_product_with_sidebar'); ?>
        </div>
    <?php endif; ?>

    <?php
    /**
     * woocommerce_before_single_product_summary hook
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action( 'woocommerce_before_single_product_summary' );
    ?>

    <div class="summary entry-summary" <?php echo $style ?>>

        <?php
        /**
         * woocommerce_single_product_summary hook
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         */
        do_action( 'woocommerce_single_product_summary' );
        ?>

    </div><!-- .summary -->

    <div class="clearfix"></div>

    <?php
    /**
     * woocommerce_after_single_product_summary hook
     *
     * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );
    ?>

    <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
