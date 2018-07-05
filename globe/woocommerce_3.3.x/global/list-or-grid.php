<?php
/**
 * Shop list or grid
*/

if ( is_single() || ! have_posts() ) return;

$shop_view = wc_get_loop_prop('view');
if ( empty( $shop_view ) ) {
    wc_set_loop_prop('view', yit_get_option('shop-view-type', 'grid'));
    $shop_view = yit_get_option('shop-view-type', 'grid');
}
?>
<div id="list-or-grid">
    <span class="view-title"><?php _e( 'view style', 'yit' ); ?>:</span>

    <a class="grid-view<?php if ( $shop_view == 'grid' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'grid' ) ) ?>" title="<?php _e( 'Switch to grid view', 'yit' ) ?>"></a>

    <a class="list-view<?php if ( $shop_view == 'list' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'list' ) ) ?>" title="<?php _e( 'Switch to list view', 'yit' ) ?>"></a>
</div>