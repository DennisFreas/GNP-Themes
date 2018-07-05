<?php
/**
 * Content Wrappers
 */

if( is_product() ) return;
?>
<!-- PAGE META -->
<div id="page-meta" class="clearfix group">

    <?php if ( ( ! is_product_category() && ( yit_get_option( 'shop-show-page-title' ) == 'yes' || YIT_Layout()->show_title == 1 ) )
        || ( is_product_category() && ( yit_get_option( 'shop-category-show-page-title' ) == 'yes' || YIT_Layout()->show_title == 1 ) ) ) : ?>
        <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php do_action( 'yith_before_shop_page_meta' );  ?>

    <?php do_action( 'shop-page-meta' );

    ?>
</div>
<!-- END PAGE META -->