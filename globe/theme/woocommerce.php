<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

define('WC_LATEST_VERSION' , '3.4' );
/* === HOOKS === */
function yit_woocommerce_hooks() {

    if ( ! defined( 'YIT_DEBUG' ) || ! YIT_DEBUG ) {
        $message = get_option( 'woocommerce_admin_notices', array() );
        $message = array_diff( $message, array( 'template_files' ) );
        update_option( 'woocommerce_admin_notices', $message );
    }

    add_action( 'yit_activated', 'yit_woocommerce_default_image_dimensions' );

    add_filter( 'woocommerce_enqueue_styles', 'yit_enqueue_wc_styles' );
    add_filter( 'woocommerce_template_path', 'yit_set_wc_template_path' );
    if( yit_is_old_ie() ) {
        add_action( 'wp_head', 'yit_add_wc_styles_to_assets', 0 );
    }
    add_action( 'wp_head', 'yit_size_images_style' );
    add_action( 'woocommerce_before_main_content', 'yit_shop_page_meta' );

    // Ajax search loading
    add_filter( 'yith_wcas_ajax_search_icon', 'yit_loading_search_icon' , 15 );

    // Use WC 2.0 variable price format, now include sale price strikeout
    add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
    add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

    // Add to cart button text
    add_filter( 'add_to_cart_text', 'yit_add_to_cart_text' );
    // View details button text
    add_filter( 'yit_view_details_product_text', 'yit_view_details_text' );

    // Custom Pagination
    add_filter( 'woocommerce_pagination_args', 'yit_pagination_shop_args' );

    // Add Custom metabox in My Account and checkout page
    add_action( 'admin_init', 'yit_register_shop_metabox' );


    /*============= SHOP PAGE ===============*/

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


    add_action( 'woocommerce_before_shop_loop_item_title', 'yit_out_stock_icon', 15 );

    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 );

    add_filter( 'loop_shop_per_page', 'yit_products_per_page' );
    add_action( 'shop-page-meta', 'yit_wc_catalog_ordering', 15 );

    if ( yit_get_option( 'shop-view-type' ) != 'masonry' && yit_get_option( 'shop-grid-list-option' ) != 'no' ) {
        add_action( 'shop-page-meta', 'yit_wc_list_or_grid', 5 );
    }
    if( yit_get_option( 'shop-products-per-page-option' ) != 'no' ) {
        add_action( 'shop-page-meta', 'yit_wc_num_of_products', 10 );
    }

    if( yit_get_option( 'shop-product-rating' ) == 'yes' ) {
        add_action( 'woocommerce_after_shop_loop_item_title', 'yit_shop_rating', 15 );
    }

    add_action( 'woocommerce_after_shop_loop_item_title', 'yit_shop_product_description', 25 );

    if( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) && yit_get_option( 'shop-view-wishlist-button' ) == 'yes' && get_option( 'yith_wcwl_enabled' ) == 'yes' ) {
        add_action( 'woocommerce_after_shop_loop_item', 'yit_shop_wishlist_action', 20 );
    }
    add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash' );

    if ( yit_get_option('shop-enable') == 'no' || yit_get_option( 'shop-product-price' ) == 'no' ) {
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
    }

    /*======== SINGLE PRODUCT PAGE =========*/

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    add_action( 'yit_single_page_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );

    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

    add_action( 'woocommerce_single_product_summary', 'yit_product_modal_window', 25 );

    if ( yit_get_option('shop-single-product-name') == 'no' ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    if ( yit_get_option( 'shop-single-metas' ) == 'no' ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    if ( yit_get_option('shop-enable') == 'no' || yit_get_option( 'shop-single-product-price' ) == 'no' ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

    add_action( 'woocommerce_single_product_summary', 'yit_woocommerce_add_inquiry_form', 27 );

    /* related products */
    if ( yit_get_option( 'shop-show-related' ) == 'no' ) remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    if ( yit_get_option( 'shop-show-custom-related' ) == 'yes' )  {
        if (version_compare( WC()->version , '2.7', '>' ) ) {
            add_filter('woocommerce_output_related_products_args','yit_custom_woocommerce_output_related_products_args');
        }else{
            add_filter('woocommerce_related_products_args', 'yit_related_posts_per_page');
        }
    }

    function yit_custom_woocommerce_output_related_products_args( $args ){
        $args['posts_per_page'] = yit_get_option( 'shop-number-related' );
        return $args;
    }

    /* tabs */
    if ( yit_get_option( 'shop-remove-reviews' ) == 'yes' ){
        add_filter( 'woocommerce_product_tabs', 'yit_remove_reviews_tab', 98 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    }
    add_filter( 'woocommerce_product_tabs', 'yit_woocommerce_add_tabs' );

    add_action('woocommerce_after_single_product_summary', 'yit_add_extra_content', 12);

    if( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) && get_option( 'yith_wcwl_enabled' ) == 'yes' && yit_get_option('shop-single-show-wishlist') == 'yes' ) {
        add_action( 'woocommerce_single_product_summary', 'yit_shop_wishlist_action', 45 );
    }

    /*============== CART ============*/

    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

    /*============= CHECKOUT =========== */

    if( yit_get_option( 'shop-checkout-form-coupon' ) == 'no' ) {
        remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );
    }

    /*============== ADMIN  ==============*/

    add_action( 'woocommerce_product_options_general_product_data', 'yit_woocommerce_admin_product_ribbon_onsale' );
    add_action( 'woocommerce_process_product_meta', 'yit_woocommerce_process_product_meta', 2, 2 );

    /*===== MANAGE VAT AND SSN FIELDS =====*/

    if ( yit_get_option( 'shop-enable-vat' ) == 'yes' && yit_get_option( 'shop-enable-ssn' ) == 'yes' ) {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_ssn_vat' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_ssn_vat' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_fields_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_fields_admin' );
    }
    elseif ( yit_get_option( 'shop-enable-vat' ) == 'yes' ) {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_vat' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_vat' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_vat_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_vat_admin' );
        add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data_vat' );
    }
    elseif ( yit_get_option( 'shop-enable-ssn' ) == 'yes') {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_ssn' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_ssn' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
        add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data_ssn' );
    }

    /*======== Support to YITH Plugins =========*/

    add_action( 'init', 'yit_plugins_support' );



    /**
     * Compatibility with woocommerce 2.4.x
     */

    if( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.4', '>=' ) ) {

        remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );

        add_action( 'woocommerce_single_variation', 'yit_custom_single_variation', 20 );

        if( yit_get_option( 'shop-product-title' ) != 'yes'  ) {
            remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
        }
    }

}
add_action( 'after_setup_theme', 'yit_woocommerce_hooks' );


if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.3', '<' ) ) {
    add_filter( 'add_to_cart_redirect' , 'yit_remove_add_to_cart_redirect' );
}else{
    add_filter( 'woocommerce_add_to_cart_redirect' , 'yit_remove_add_to_cart_redirect' );
}

if( ! function_exists( 'yit_custom_single_variation' ) ) {
    /**
     * yit custom template for single variation
     */
    function yit_custom_single_variation() {
        wc_get_template( 'single-product/add-to-cart/yit-single-variation.php' );
    }
}

// Useful for opening cart in header
function yit_remove_add_to_cart_redirect() {
    return false;
}
//add_filter( 'add_to_cart_redirect', 'yit_remove_add_to_cart_redirect' );



/**
 * For WooCommerce 2.5.x
 */
if( ! function_exists('yit_woocommerce_shop_loop_subcategory_title') ) {

    function yit_woocommerce_shop_loop_subcategory_title( $category , $show_counter = 1 ) { ?>

        <div class="category-name">
            <h4>
                <?php echo $category->name; ?>
            </h4>
        </div>

        <?php if ( ( isset( $show_counter ) && $show_counter == 1 ) && $category->count > 0 ) : ?>
            <div class="category-count">
                <div class="category-count-content">
                    <?php
                    echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . _n( " product", " products", $category->count, "yit" ) . '</span>', $category );
                    ?>
                </div>
            </div>
        <?php endif; ?>

    <?php }

    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
    add_action( 'woocommerce_shop_loop_subcategory_title' , 'yit_woocommerce_shop_loop_subcategory_title' , 10 , 2 );

}



/********
* SIZES
**********/
// shop small
if ( ! function_exists( 'yit_shop_catalog_w' ) ) : function yit_shop_catalog_w() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_catalog_h' ) ) : function yit_shop_catalog_h() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_catalog_c' ) ) : function yit_shop_catalog_c() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['crop'];
} endif;

// shop thumbnail
if ( ! function_exists( 'yit_shop_thumbnail_w' ) ) : function yit_shop_thumbnail_w() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_thumbnail_h' ) ) : function yit_shop_thumbnail_h() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_thumbnail_c' ) ) : function yit_shop_thumbnail_c() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['crop'];
} endif;

//shop large
if ( ! function_exists( 'yit_shop_single_w' ) ) : function yit_shop_single_w() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_single_h' ) ) : function yit_shop_single_h() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_single_c' ) ) : function yit_shop_single_c() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['crop'];
} endif;

if ( ! function_exists( 'yit_add_to_cart_text' ) ) {
    /**
     * Set Add to Cart label from Theme Options
     *
     * @return string
     *
     * @since 1.0.0
     */
    function yit_add_to_cart_text() {
        global $product;

        $porduct_type = property_exists( 'WC_Product', 'product_type' ) ? $product->product_type : $product->get_type();

        if ( $porduct_type != 'external' ) {
            $text = __( yit_get_option( 'shop-add-to-cart-text' ), 'yit' );
        }
        return $text;
    }
}

if( ! function_exists( 'yit_view_details_text' ) ) {
    /**
     * Set View Details label from Theme Options
     *
     * @return string
     *
     * @since 1.0.0
     */
    function yit_view_details_text() {
        $text = __( yit_get_option( 'shop-view-details-text' ), 'yit' );

        return $text;
    }
}

if ( ! function_exists( 'yit_enqueue_wc_styles' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    if ( ! function_exists( 'yit_enqueue_wc_styles' ) ) {
        /**
         * Remove Woocommerce Styles add custom Yit Woocommerce style
         *
         * @param $styles
         *
         * @return array list of style files
         * @since    2.0.0
         */
        function yit_enqueue_wc_styles( $styles ) {

            $path = 'woocommerce';
            $version = WC()->version;

            if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $version ), WC_LATEST_VERSION, '<' ) ) {
                $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x';
            }
            /* 2.3 add select2 on cart page*/
            else{
                if(is_cart()){
                    wp_enqueue_script( 'select2' );
                    wp_enqueue_style( 'select2', WC()->plugin_url() . '/assets/css/select2.css' );
                }
            }

            unset( $styles['woocommerce-general'], $styles['woocommerce-layout'], $styles['woocommerce-smallscreen'] );

            $styles ['yit-layout'] = array(
                'src'     => get_stylesheet_directory_uri() . '/' . $path . '/style.css',
                'deps'    => '',
                'version' => '1.0',
                'media'   => ''
            );
            return $styles;
        }
    }
}

if( ! function_exists( 'yit_add_wc_styles_to_assets' ) ){
    function yit_add_wc_styles_to_assets(){
         $stylepicker_css = array(
             'src'       => get_stylesheet_directory_uri() . '/woocommerce/style.css',
             'enqueue'   => true,
             'media'     => 'all'
        );

        if( function_exists( 'YIT_Asset' ) ){
            YIT_Asset()->set( 'style', 'yit-woocommerce', $stylepicker_css, 'after', 'theme-stylesheet' );
        }
    }
}

if ( ! function_exists( 'yit_set_wc_template_path' ) ) {
    /**
     * Return the folder of custom woocommerce templates
     *
     * @param $path standard wc path
     *
     * @return string template folder
     *
     * @since    2.0.0
     */
    function yit_set_wc_template_path( $path ) {

        $version = WC()->version;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $version ), WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x/';
        }

        return $path;
    }
}

function woocommerce_template_loop_product_thumbnail() {

    global $product, $woocommerce_loop;

    $attachments = method_exists( 'WC_Product', 'get_gallery_image_ids' ) ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();

    $original_size = wc_get_image_size( 'shop_catalog' );

    if ( $woocommerce_loop['view'] == 'masonry_item' ) {
        $size = $original_size;
        $size['height'] = 0;
        YIT_Registry::get_instance()->image->set_size('shop_catalog', $size );
    }

    if( isset( $attachments[0] ) ) {
        echo '<a href="' . get_permalink() . '" class="thumb backface"><span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
        echo '<span class="face back">';
        yit_image( "id=$attachments[0]&size=shop_catalog&class=image-hover" );
        echo '</span></a>';
    }
    else {
        echo '<a href="' . get_permalink() . '" class="thumb"><span class="face">' . woocommerce_get_product_thumbnail() . '</span></a>';
    }

    if ( $woocommerce_loop['view'] == 'masonry_item' ) {
        YIT_Registry::get_instance()->image->set_size('shop_catalog', $original_size );
    }
}

if ( ! function_exists( 'yit_shop_rating' ) ) {

    function yit_shop_rating() {
        global $product;

        echo '<div class="product-rating"><span class="star-empty"><span class="star" style="width:' . ( $product->get_average_rating() ) * 20 . '%"></span></span></div>';
    }
}

if ( ! function_exists( 'yit_shop_wishlist_action' ) ) {
    /**
     * Add wishlist button in shop page
     *
     * @since   2.0.0
     */
    function yit_shop_wishlist_action() {

        echo '<div class="product-actions-wrapper">';
        echo do_shortcode( '[yith_wcwl_add_to_wishlist use_button_style="no"]' );
        echo '</div>';
    }
}

if ( ! function_exists( 'yit_get_current_cart_info' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @internal param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_get_current_cart_info() {

        $items     = yit_get_option( 'shop-mini-cart-total-items' ) ? WC()->cart->get_cart_contents_count() : count( WC()->cart->get_cart() );
        $cart_icon = yit_get_option( 'shop-mini-cart-icon' );
        $cart_icon_dark = yit_get_option( 'header-dark-shop-mini-cart-icon' );

        return array(
            $items,
            $cart_icon,
            $cart_icon_dark
        );
    }
}

if ( ! function_exists( 'yit_shop_product_description' ) ) {
    /**
     * Add short product description in shop
     *
     */
    function yit_shop_product_description() {

        global $product;

        $excerpt = property_exists( 'WC_Product', 'post' ) ? $product->post->post_excerpt : get_post_field( 'post_excerpt', $product->get_id() );

        if ( $excerpt != "" ) :
            echo '<div class="product-description"><p>';
            echo wp_trim_words( $excerpt );
            echo '</p></div>';
        endif;

    }
}

function yit_woocommerce_admin_product_ribbon_onsale() {
    wc_get_template( 'admin/custom-onsale.php' );
}

function yit_woocommerce_process_product_meta( $post_id, $post ) {

    $active = ( isset( $_POST['_active_custom_onsale'] ) ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_active_custom_onsale', esc_attr( $active ) );

    if ( isset( $_POST['_preset_onsale_icon'] ) ) {
        update_post_meta( $post_id, '_preset_onsale_icon', esc_attr( $_POST['_preset_onsale_icon'] ) );
    }
    if ( isset( $_POST['_custom_onsale_icon'] ) ) {
        update_post_meta( $post_id, '_custom_onsale_icon', esc_attr( $_POST['_custom_onsale_icon'] ) );
    }
}

if ( ! function_exists( 'yit_add_to_cart_success_ajax' ) ) {

    function yit_add_to_cart_success_ajax( $datas ) {

        list( $cart_items, $cart_icon, $cart_icon_dark ) = yit_get_current_cart_info();
        $datas['.yit_cart_widget .cart_label .cart-items .yit-mini-cart-icon'] = '<span class="yit-mini-cart-icon"><span class="cart-items-number">' . $cart_items . '</span></span>';
        return $datas;
    }

    if( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.4', '<' ) ) {
        add_filter( 'add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );
    }
    else {
        add_filter( 'woocommerce_add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );
    }
}

if ( ! function_exists( 'yit_size_images_style' ) ) {

    function yit_size_images_style() {

        $content_width      = $GLOBALS['content_width'];
        $shop_catalog_w     = ( 100 * yit_shop_catalog_w() ) / $content_width;
        $info_product_width = 100 - $shop_catalog_w;
        ?>
        <style type="text/css">
            .woocommerce ul.products li.product.list .product-wrapper .thumb-wrapper {
                width: <?php echo $shop_catalog_w ?>%;
                height: auto;
            }
            .woocommerce ul.products li.product.list .product-wrapper .product-actions-wrapper,
            .woocommerce ul.products li.product.list .product-wrapper .product-meta-wrapper {
                width: <?php echo $info_product_width -2?>%;
            }

        </style>
    <?php
    }
}

if ( ! function_exists( 'yit_wc_list_or_grid' ) ) {
    /*
     * Add list/grid switch
     */
    function yit_wc_list_or_grid() {
        wc_get_template( '/global/list-or-grid.php' );
    }
}

if ( ! function_exists( 'yit_wc_num_of_products' ) ) {
    /*
     * Custom number of products switch
     */
    function yit_wc_num_of_products() {
        wc_get_template( '/global/number-of-products.php' );
    }
}

if ( ! function_exists( 'yit_products_per_page' ) ) {
    /*
     * Custom number of product per page
     */
    function yit_products_per_page() {

        $num_prod = ( isset( $_GET['products-per-page'] ) ) ? $_GET['products-per-page'] : yit_get_option( 'shop-products-per-page' ) ;

        if ( $num_prod == 'all' ) {
            $num_prod = wp_count_posts( 'product' )->publish;
        }

        return $num_prod;
    }
}

if ( ! function_exists( 'yit_shop_page_meta' ) ) {
    /*
     * Page meta for shop page
     */
    function yit_shop_page_meta() {
        if ( is_single() ) {
            return;
        }
        wc_get_template( '/global/page-meta.php' );
    }
}

if ( ! function_exists( 'yit_wc_catalog_ordering' ) ) {

    function yit_wc_catalog_ordering() {
        if ( ! is_single() && have_posts() ) {
            woocommerce_catalog_ordering();
        }
    }
}

if ( ! function_exists( 'yit_related_posts_per_page' ) ) {

    function yit_related_posts_per_page() {
        global $product;
        $related = $product->get_related( yit_get_option( 'shop-number-related' ) );
        return array(
            'posts_per_page'      => - 1,
            'post_type'           => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => 1,
            'post__in'            => $related
        );
    }
}


/* variation price format */
function wc_wc20_variation_price_format( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price  = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
    }
    return $price;
}

if( ! function_exists( 'yit_remove_reviews_tab' ) ){

    function yit_remove_reviews_tab ( $tabs ) {

        unset( $tabs[ 'reviews' ] );
        return $tabs;
    }
}

/* CUSTOM TABS */

function yit_woocommerce_add_tabs( $tabs = array() ) {

    global $post;

    $custom_tabs = yit_get_post_meta( $post->ID, '_custom_tab' );

    if ( ! empty( $custom_tabs ) ) {
        foreach ( $custom_tabs as $tab ) {
            $tabs['custom' . $tab["position"]] = array(
                'title'      => $tab["name"],
                'priority'   => 30,
                'callback'   => 'yit_woocommerce_add_custom_panel',
                'custom_tab' => $tab
            );
        }
    }
    return $tabs;
}

function yit_woocommerce_add_custom_panel( $key, $tab ) {
    wc_get_template( 'single-product/tabs/custom.php', array( 'key' => $key, 'tab' => $tab ) );
}

/*******************
 * MY ACCOUNT
 *******************/

function yit_add_my_account_endpoint() {
    if ( function_exists( 'WC' ) ) {
        WC()->query->query_vars['recent-downloads'] = 'recent-downloads';
        WC()->query->query_vars['wishlist']         = 'wishlist';
    }
}

add_action( 'after_setup_theme', 'yit_add_my_account_endpoint' );

if ( ! function_exists( 'yit_my_account_template' ) ) {
    /**
     * Add custom template form my-account page
     *
     * @return   void
     * @since    2.0.0
     * @author   Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_my_account_template() {

        if ( ! function_exists( 'WC' ) || ! is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) return;

        global $wp;

        if ( is_user_logged_in() ){

            echo '<div class="row" id="my-account-page">';

            echo '<div class ="col-sm-12" id="my-account-user">';
            wc_get_template( 'myaccount/my-account-user.php');
            echo '</div>';

            // echo '<div class="col-sm-3" id="my-account-sidebar">';
            // wc_get_template( '/myaccount/my-account-menu.php' );
            // echo '</div>';

            echo '<div class="col-sm-12" id="my-account-content">';

            wc_print_notices();

            if ( isset( $wp->query_vars['view-order'] ) && empty( $wp->query_vars['view-order'] ) ) {
                wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => -1 ) );
            }
            elseif ( isset( $wp->query_vars['recent-downloads'] ) ) {
                wc_get_template( 'myaccount/my-downloads.php' );
            }
            elseif ( isset( $wp->query_vars['wishlist'] ) ) {
                echo do_shortcode( '[yith_wcwl_wishlist]' );
            }
            else {
                yit_content_loop();
            }
            echo '</div>';

            echo '</div>';

        }
        else {
            echo '<div id="my-account-content">';
            if( isset( $wp->query_vars['lost-password'] ) ) {
                WC_Shortcode_My_Account::lost_password();
            } else {
                wc_get_template( 'myaccount/form-login.php' );
            }
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'yit_loading_search_icon' ) ) {

    function yit_loading_search_icon() {
        return '"' . YIT_THEME_ASSETS_URL . '/images/search.gif"';
    }
}

if ( ! function_exists( 'yit_add_inquiry_form_action' ) ) {
    /**
     * Add meta for inquiry form in edit product
     *
     */
    function yit_add_inquiry_form_action(){

        if( ! function_exists('YIT_Contact_Form') ){
            return;
        }
        $args = array(
            'info_form' => array(
                'label' => __( 'Show inquiry form?', 'yit' ),
                'desc'  => __( 'Set YES if you want a section with the inquiry form. Set options in Theme Options->Shop->Single Product Page', 'yit' ),
                'type'  => 'onoff',
                'std'   => 'no',
            )
        );
        $meta_prod = YIT_Metabox( 'yit-product-setting' );
        $meta_prod->add_field( 'settings', $args, 'before', 'modal_window' );
    }
}

add_action( 'after_setup_theme', 'yit_add_inquiry_form_action', 40 );

if ( ! function_exists( 'yit_woocommerce_add_inquiry_form' ) ) {
    /**
     * Get Template for inquiry form
     */
    function yit_woocommerce_add_inquiry_form() {
        wc_get_template( 'single-product/inquiry-form.php' );
    }
}

if ( ! function_exists( 'yit_product_modal_window' ) ){
    /**
     * Get template for modal in single product page
     */
    function yit_product_modal_window(){
        wc_get_template( 'single-product/modal-window.php');
    }
}

if ( ! function_exists( 'yit_pagination_shop_args' ) ) {
    /**
     * Custom pagination for shop page
     *
     * @return array
     * @since 1.0.0
     */
    function yit_pagination_shop_args(){

        global $wp_query;

        $args = array(
            'base'         => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'       => '',
            'current'      => max( 1, yit_get_post_current_page() ),
            'total'        => $wp_query->max_num_pages,
            'type'         => 'plain',
            'prev_next'    => true,
            'prev_text' => '&lt;',
            'next_text' => '&gt;',
            'end_size'     => 3,
            'mid_size'     => 3,
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number' => ''
        );

        return $args;
    }
}

/***********************
 * VAT SSN FIELDS
 ***********************/

function yit_woocommerce_add_billing_ssn_vat( $fields ) {
    $fields['billing_vat'] = array(
        'label'       => apply_filters( 'yit_vat_label', __( 'VAT', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-first' ),
        'clear'       => false
    );

    $fields['billing_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-last' ),
        'clear'       => true
    );

    return $fields;
}
function yit_woocommerce_add_shipping_ssn_vat( $fields ) {
    $fields['shipping_vat'] = array(
        'label'       => apply_filters( 'yit_vat_label', __( 'VAT', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-first' ),
        'clear'       => false
    );

    $fields['shipping_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-last' ),
        'clear'       => true
    );

    return $fields;
}
function woocommerce_add_billing_shipping_fields_admin( $fields ) {
    $fields['vat'] = array(
        'label' => apply_filters( 'yit_vatssn_label', __( 'VAT', 'yit' ) )
    );
    $fields['ssn'] = array(
        'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
    );

    return $fields;
}
function yit_woocommerce_add_billing_vat( $fields ) {
    $fields['billing_vat'] = array(
        'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT / SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}
function yit_woocommerce_add_shipping_vat( $fields ) {
    $fields['shipping_vat'] = array(
        'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT / SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}
function woocommerce_add_billing_shipping_vat_admin( $fields ) {
    $fields['vat'] = array(
        'label' => apply_filters( 'yit_vatssn_label', __( 'VAT/SSN', 'yit' ) )
    );

    return $fields;
}
function woocommerce_add_var_load_order_data_vat( $fields ) {
    $fields['billing_vat']  = '';
    $fields['shipping_vat'] = '';
    return $fields;
}
function yit_woocommerce_add_billing_ssn( $fields ) {
    $fields['billing_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}

function yit_woocommerce_add_shipping_ssn( $fields ) {
    $fields['shipping_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}
function woocommerce_add_billing_shipping_ssn_fields_admin( $fields ) {
    $fields['ssn'] = array(
        'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
    );

    return $fields;
}
function woocommerce_add_var_load_order_data_ssn( $fields ) {
    $fields['billing_ssn']  = '';
    $fields['shipping_ssn'] = '';
    return $fields;
}


// SET LAYOUT FOR SHOP PAGE

function yit_sidebar_shop_page( $value, $key, $id ) {

    $new_layout = ( isset( $_GET['layout-shop'] ) ) ? $_GET['layout-shop'] : '';

    if( isset( $value['layout'] ) && $new_layout != '' && $key == 'sidebars' ) {

        $value['layout'] = $new_layout;

        if( $value['sidebar-left'] == -1 ){
            $value['sidebar-left'] = $value['sidebar-right'];
        }
        elseif( $value['sidebar-right'] == -1 ){
            $value['sidebar-right'] = $value['sidebar-left'];
        }
    }

    return $value;
}
add_filter( 'yit_get_option_layout', 'yit_sidebar_shop_page', 10, 3 );


// add image for product category page

function woocommerce_taxonomy_archive_description() {
    if ( is_tax( apply_filters('yit_term_desciption_tax', array( 'product_cat', 'product_tag' ) ) ) && get_query_var( 'paged' ) == 0 ) {

        $description = apply_filters( 'the_content', term_description() );

        if ( $description && yit_get_option( 'shop-category-show-page-description' ) == 'yes' ) {
            echo '<div class="term-description">' . $description . '</div>';
        }
    }
}



if ( ! function_exists( 'yit_image_content_single_width' ) ) {
    /**
     * Set image and content width for single product image
     *
     * @return array
     * @since 1.0.0
     * @author Francesco Licando <francesco.licandro@yithemes.it>
     */
    function yit_image_content_single_width() {

        $size = array();

        $img_size = yit_shop_single_w();

        if ( intval( $img_size ) < $GLOBALS['content_width'] ) {
            $size['image'] = ( intval( $img_size ) * 100 ) / $GLOBALS['content_width'];
        }
        else {
            $size['image'] = 100;
        }

        $size['content'] = 100 - ( $size['image'] );
        $min_size = ( wp_is_mobile() ) ? '40' : '20';

        if ( $size['content'] < $min_size ) {
            $size['content'] = 100;
        }

        return $size;

    }
}

function yit_remove_unused_wishlist_options( $options ){
    unset( $options['general_settings'][5] );
    unset( $options['styles'][1] );

    return $options;
}
add_filter( 'yith_wcwl_tab_options', 'yit_remove_unused_wishlist_options' );


function yit_add_extra_content(){

    global $post;

    $extra = '';

    $add_extra = yit_get_post_meta( $post->ID, '_add_extra_content');
    if( $add_extra == "yes" ) {
        $extra = yit_get_post_meta( $post->ID, '_extra_content' );
    }

    echo do_shortcode( $extra );
}

if ( ! function_exists( 'yit_out_stock_icon' ) ) {
    /*
     * Add icon out of stock
     *
     * @since 2.0.0
     */
    function yit_out_stock_icon() {

        global $product;

        if ( ! $product->is_in_stock() ) : ?>
            <div class="out-of-stock-icon">
                <div class="out-of-stock">
                    <div class="out-of-stock-text">
                        <span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out Of Stock', 'yit' ) ); ?></span>
                    </div>
                </div>
            </div>
        <?php endif;
    }
}

if( ! function_exists( 'yit_register_shop_metabox' ) ){
    /**
     * Add custom metabox in shop page admin
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0.0
     * @return void
     */
    function yit_register_shop_metabox(){

        $post_id            = yit_admin_post_id();
        $my_account_page_id = wc_get_page_id( 'myaccount' );
        $checkout_page_id   = wc_get_page_id( 'checkout' );
        $cart_page_id       = wc_get_page_id( 'cart' );
        $metaboxes_file     = apply_filters( 'yit_extra_shop_metaboxes', YIT_THEME_PATH . '/shop-metabox.php' );
        $metaboxes          = include( $metaboxes_file );

        switch( $post_id ){

            case $my_account_page_id:
                YIT_Metabox( 'yit-page-setting' )->remove_fields( $metaboxes['remove'] );
                YIT_Metabox( 'yit-page-setting' )->add_field( 'settings', $metaboxes['myaccount'], 'last' );
                break;

            case $checkout_page_id:
            case $cart_page_id:
                YIT_Metabox( 'yit-page-setting' )->remove_fields( $metaboxes['remove'] );
                YIT_Metabox( 'yit-page-setting' )->add_field( 'settings', $metaboxes['checkout'], 'last' );
                break;
        }
    }
}

/* EXTEND YITH WOOCOMMERCE AJAX SEARCH */

function yith_woocommerce_ajax_search_suggestion( $suggestions, $product ) {

    if ( 'yes' == yit_get_option( 'show-image-on-search' ) ) {
        $suggestions['img'] = $product->get_image( 'shop_thumbnail' );
    }

    if ( 'yes' == yit_get_option( 'show-price-on-search' ) ) {
        $suggestions['price'] = $product->get_price_html();
    }

    return $suggestions;
}
add_filter( 'yith_wcas_suggestion', 'yith_woocommerce_ajax_search_suggestion', 10, 2 );


if( ! function_exists( 'yit_woocommerce_object' ) ) {

    function yit_woocommerce_object() {

        wp_localize_script( 'jquery', 'yit_woocommerce', array(
            'version' => WC()->version,

        ));

    }

}

if ( ! function_exists( 'yit_plugins_support' ) ) {
    /**
     * YITH Plugins support
     *
     * @return string
     * @since 1.0
     */
    function yit_plugins_support(){

        $is_multi_vendor_premium_installed = class_exists( 'YITH_Vendors_Frontend_Premium' );
        $is_multi_vendor_installed = function_exists( 'YITH_Vendors' );

        /* === YITH WooCommerce Multi Vendor */
        if ( $is_multi_vendor_premium_installed && $is_multi_vendor_installed ) {
            $obj = YITH_Vendors()->frontend;
            remove_action( 'woocommerce_archive_description', array( $obj, 'add_store_page_header' ) );
            add_action( 'yith_before_shop_page_meta', array( $obj, 'add_store_page_header' ) );

            add_filter( 'yith_wpv_quick_info_button_class', 'yith_multi_vendor_button_class' );
            add_filter( 'yith_wpv_report_abuse_button_class', 'yith_multi_vendor_button_class' );
        }

        if ( ! function_exists( 'yith_multi_vendor_quick_info_button_class' ) ) {

            /**
             * YITH Plugins support -> Multi Vendor widgets submit button
             *
             * @param string $class
             * @return string
             * @since 1.0
             */
            function yith_multi_vendor_button_class( $class ) {
                return 'btn btn-flat alignright';
            }
        }

        /* ===== MULTI VENDOR ====== */

        if ( $is_multi_vendor_installed ) {

            if( ! function_exists( 'yit_contact_form_to_vendor' ) ) {
                function yit_contact_form_to_vendor( $to ){
                    $vendor_email = false;
                    if( ! empty( $_POST['yit_contact']['product_id'] ) && yit_get_option( 'send-email-to-vendor' ) == 'yes' ){
                        $vendor = yith_get_vendor( $_POST['yit_contact']['product_id'], 'product' );
                        if( $vendor->is_valid() ){
                            $vendor_email = $vendor->store_email;
                            if( empty( $vendor_email ) ){
                                $vendor_owner = get_user_by( 'id', absint( $vendor->get_owner() ) );
                                $vendor_email = $vendor_owner instanceof WP_User ? $vendor_owner->user_email : false;
                            }
                        }
                    }
                    return $vendor_email ? $vendor_email : $to;
                }
            }

            add_filter( 'yit_contact_form_email_to', 'yit_contact_form_to_vendor' );
        }

        /* =============================' */

        /* === YITH WooCommerce Advanced Review */

        if ( defined( 'YITH_YWAR_VERSION' ) ) {

            global $YWAR_AdvancedReview;

            remove_action( 'yith_advanced_reviews_before_reviews', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );

            add_action( 'yith_advanced_reviews_before_review_list', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );
        }

        if( defined('YITH_YWAR_PREMIUM') ) {

            add_filter( 'yith_advanced_reviews_loader_gif', 'yit_loading_search_icon' );

        }

        /* Request a Quote */

        if ( defined( 'YITH_YWRAQ_VERSION' ) ) {

            $yith_request_quote = YITH_Request_Quote();

            if ( method_exists( $yith_request_quote, 'add_button_shop' ) ) {
                remove_action( 'woocommerce_after_shop_loop_item', array( $yith_request_quote, 'add_button_shop' ), 15 );
                add_action( 'woocommerce_after_shop_loop_item_title', array( $yith_request_quote, 'add_button_shop' ), 30);
            }

            add_filter( 'ywraq_product_in_list', 'yit_ywraq_change_product_in_list_message' );

            function yit_ywraq_change_product_in_list_message() {
                return __( 'In your quote list', 'yit' );
            }

            add_filter( 'ywraq_product_added_view_browse_list', 'yit_ywraq_product_added_view_browse_list_message' );

            function yit_ywraq_product_added_view_browse_list_message() {
                return __( 'View list &gt;', 'yit' );
            }

            add_filter( 'yith_admin_tab_params' , 'yith_wraq_remove_layout_options' );

            if ( ! function_exists( 'yith_wraq_remove_layout_options' ) ) {

                /**
                 * Remove Layout option from Request a Quote
                 *
                 * @param array $array
                 * @return array
                 * @since 1.0
                 */
                function yith_wraq_remove_layout_options( $array ) {

                    if ( $array['page'] == 'yith_woocommerce_request_a_quote' ) {
                        unset( $array['available_tabs']['layout'] );
                    }

                    return $array;
                }
            }
        }

        /* ===== WISHLIST ====== */

        if( defined( 'YITH_WCWL' ) ) {

            add_action( 'woocommerce_account_wishlist_endpoint' , 'yit_wishlist_content' );

            function yit_wishlist_content() {
                echo do_shortcode( '[yith_wcwl_wishlist]' );
            }

        }

        /* ===================== */

        /**
         * WPML
         */
        function yit_wpml_endpoint_hack_for_after() {
            global $yit_wpml_hack_endpoint;
            $yit_wpml_hack_endpoint = WC()->query->query_vars;

            // add the options
            foreach ( $yit_wpml_hack_endpoint as $endpoint => $value ) {
                add_option( 'woocommerce_myaccount_'.$endpoint.'_endpoint', $value );
            }
        }
        add_action( 'after_setup_theme', 'yit_wpml_endpoint_hack_for_after', 11 );

        function yit_wpml_my_account_endpoint() {
            global $woocommerce_wpml, $yit_wpml_hack_endpoint;

            if ( ! isset( $woocommerce_wpml->endpoints ) ) {
                return;
            }

            $endpoints = array(
                'recent-downloads',
                'wishlist',
            );

            $wc_vars = WC()->query->query_vars;

            foreach ( $endpoints as $endpoint ) {
                if ( ! isset( $yit_wpml_hack_endpoint[ $endpoint ] ) ) {
                    return;
                }

                $wc_vars_endpoint = isset( $wc_vars[ $endpoint ] ) ? $wc_vars[ $endpoint ] : $endpoint;

                WC()->query->query_vars[$endpoint] = $woocommerce_wpml->endpoints->get_endpoint_translation( $yit_wpml_hack_endpoint[$endpoint] , $wc_vars_endpoint );

            }

            unset( $yit_wpml_hack_endpoint );
        }

        add_action( 'init', 'yit_wpml_my_account_endpoint', 3 );


    }

}

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'yith_before_shop_page_meta', 'woocommerce_taxonomy_archive_description' );

/* ********************** */
/* ***** WC 2.6 FIX ***** */
/* ********************** */

if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.6', '>=' ) ) {

    // My Account
    add_filter( 'woocommerce_account_menu_items' , 'yit_woocommerce_account_menu_items' );
    
    // Loop
    add_filter( 'post_class', 'yit_wc_product_post_class', 30, 3 );
    add_filter( 'product_cat_class', 'yit_wc_product_product_cat_class', 30, 3 );


    // remove unused template
    yit_wc_2_6_removed_unused_template();
    
}

/**
 * @author Andre Frascaspata
 */
function yit_wc_2_6_removed_unused_template () {

    if( function_exists( 'yit_remove_unused_template' ) ) {

        $option = 'yit_wc_2_6_template_remove';

        $files = array(
            'myaccount/my-account.php',
            'myaccount/my-account-menu.php',
            'single-product/review.php',
            'single-product/add-to-cart/external.php'
        );

        yit_remove_unused_template( 'woocommerce' , $option , $files );

    }

}

if ( ! function_exists( 'yit_woocommerce_account_menu_items' ) ) {
    /**
     * @author Andrea Frascaspata
     */
    function yit_woocommerce_account_menu_items( $menu_list ) {

        unset( $menu_list['customer-logout'] );

        $menu_list['orders']       = __( 'My Orders', 'yit' );
        $menu_list['downloads']    = __( 'My Downloads', 'yit' );
        $menu_list['edit-address'] = __( 'Edit Address', 'yit' );
        $menu_list['edit-account'] = __( 'Edit Account', 'yit' );

        if ( defined( 'YITH_WCWL' ) ) {
            $menu_list['wishlist'] = __( 'My Wishlist', 'yit' );
        }


        return $menu_list;

    }
}

if ( ! function_exists( 'yit_get_myaccount_menu_icon' ) ) {

    /**
     * @param $endpoint
     * @return mixed|string
     * @author Andrea Frascaspata
     */
    function yit_get_myaccount_menu_icon( $endpoint ) {

        $icon_list = apply_filters( 'yit_get_myaccount_menu_icon_list_fa' , array(
                'dashboard'       => 'fa-book',
                'orders'          => 'fa-folder-open',
                'downloads'       => 'fa-download',
                'edit-address'    => 'fa-pencil-square-o',
                'payment-methods' => 'fa-credit-card',
                'edit-account'    => 'fa-pencil-square-o',
                'wishlist'        => 'fa-heart-o',
                'waiting-list'    => 'fa-clock-o'
            )
        );

        if( isset( $icon_list[ $endpoint ] ) ) {
            return $icon_list[ $endpoint ];
        } else {
            return '';
        }

    }

}

if ( ! function_exists( 'yit_wc_product_post_class' ) ) {
    /**
     * @param        $classes
     * @param string $class
     * @param string $post_id
     *
     * @return array
     */
    function yit_wc_product_post_class( $classes, $class = '', $post_id = '' ) {

        global $product, $woocommerce_loop;

        if ( ( !isset( $woocommerce_loop['name'] ) || empty( $woocommerce_loop['name'] ) ) && !isset( $woocommerce_loop['view'] ) ) {
            return $classes;
        }

        $woocommerce_loop['shown_product'] = true;

        //product countdown compatibility

        global $ywpc_loop;
        if ( $ywpc_loop && $ywpc_loop == 'ywpc_widget' ) {
            $woocommerce_loop['view'] = 'grid';
        }

        //--------------------------

        $classes[] = $woocommerce_loop['view'];

        // check if is mobile
        $isMobile = YIT_Mobile()->isMobile();

        // Set column
        if ( ( is_shop() || is_product_category() || is_product_taxonomy() ) && ! $isMobile && yit_get_option( 'shop-custom-num-column' ) == 'yes' ) {
            $classes[] = 'col-sm-' . intval( 12 / intval( yit_get_option( 'shop-num-column' ) ) );
            $woocommerce_loop['columns']    = intval( yit_get_option( 'shop-num-column' ) );
        }
        elseif ( isset( $product_in_a_row ) ){
            $classes[] = 'col-sm-' . intval( 12 / intval( $product_in_a_row ) );
            $woocommerce_loop['columns']    = intval( $product_in_a_row );
        }
        else {

            $sidebar = YIT_Layout()->sidebars;

            if ( $sidebar['layout'] == 'sidebar-double' ) {
                $classes[] = 'col-sm-4 col-xs-6';
                $woocommerce_loop['columns']    = '3';
            }
            elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
                $classes[] = 'col-sm-3 col-xs-6';
                $woocommerce_loop['columns']    = '4';
            }
            else {
                $classes[] = 'col-sm-2 col-xs-6';
                $woocommerce_loop['columns']    = '6';
            }
        }

        return $classes;

    }
    
}

if ( ! function_exists( 'yit_wc_product_product_cat_class' ) ) {
    function yit_wc_product_product_cat_class( $classes, $class, $category ) {

        global $woocommerce_loop;

        // Store loop count we're currently on
        if ( empty( $woocommerce_loop['loop'] ) ) {
            $woocommerce_loop['loop'] = 0;
        }

        //standard li class
        $classes[] = 'product-category product';

        if ( YIT_Layout()->sidebars['layout'] == 'sidebar-double' ) {
            $classes[] = 'col-sm-6';
            $woocommerce_loop['columns'] = '2';
        }
        elseif ( YIT_Layout()->sidebars['layout'] == 'sidebar-right' || YIT_Layout()->sidebars['layout'] == 'sidebar-left' ) {
            $classes[] = 'col-sm-4';
            $woocommerce_loop['columns'] = '3';
        }
        else {
            $classes[] = 'col-sm-3';
            $woocommerce_loop['columns'] = '4';
        }

        return $classes;

    }
}

/* ********************** */
/* ***** END WC 2.6 ***** */
/* ********************** */

if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.7', '>=' ) ) {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
    add_action( 'woocommerce_shop_loop_item_title', 'yit_woocommerce_shop_loop_item_title' );
}
function yit_woocommerce_shop_loop_item_title() { ?>
    <h3 class="product-name">
        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
    </h3><?php
}
