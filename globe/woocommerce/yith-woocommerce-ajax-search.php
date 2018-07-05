<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly


$class = '';

$is_premium = defined( 'YITH_WCAS_PREMIUM' ) ;

$research_post_type = 'product';

if( $is_premium ) {
    wp_enqueue_script( 'yith_wcas_frontend' );

    $class            = 'yith-search-premium';
    $show_search_list = ( get_option( 'yith_wcas_show_search_list' ) == 'yes' );
    if ( $show_search_list ) {
        $class.= ' search_list';
    }
    $show_category_list = ( get_option( 'yith_wcas_show_category_list' ) == 'yes' );
    if ( $show_category_list ) {
        $class.= ' category_list';
    }
    $research_post_type = ( get_option( 'yith_wcas_default_research' ) ) ? get_option( 'yith_wcas_default_research' ) : 'product';

    $class='class="'.$class.'"';
}

?>

<div class="yith-ajaxsearchform-container">
    <form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>" <?php echo $class ?>>
        <div>
            <label class="screen-reader-text" for="yith-s"><?php _e( 'Search for:', 'yit' ) ?></label>

            <div class="search-wrapper">


                <div class="select-wrapper">

                    <?php
                    if ( $is_premium && get_option( 'yith_wcas_show_category_list' ) == 'yes' ):

                        if( function_exists( 'yith_wcas_get_shop_categories' ) ) {
                            $product_categories = yith_wcas_get_shop_categories( get_option( 'yith_wcas_show_category_list_all' ) == 'all' );
                        } else {
                            $product_categories     = get_categories( $args );
                        }

                        $selected_category = ( isset( $_REQUEST['product_cat']) ) ?  $_REQUEST['product_cat'] : '';

                        if( ! empty( $product_categories ) ) : ?>
                            <select class="search_categories selectbox" id="search_categories" name="product_cat">
                                <option value="" <?php selected( '', $selected_category ) ?>><?php _e( 'All Categories', 'yit' ) ?></option>
                                <?php foreach( $product_categories as $cat ): ?>
                                    <option value="<?php echo esc_attr( $cat->slug ) ?>" <?php selected( $cat->slug, $selected_category ) ?>><?php echo $cat->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif ?>

                    <?php endif ?>
                    <?php
                    if ( $is_premium && get_option( 'yith_wcas_show_search_list' ) == 'yes' ):

                        $selected_search = ( isset( $_REQUEST['post_type'] ) ) ? $_REQUEST['post_type'] : $research_post_type; ?>

                        <select class="yit_wcas_post_type selectbox" id="yit_wcas_post_type" name="post_type">
                            <option value="product" <?php selected( 'product', $selected_search ) ?>><?php _e( 'Products', 'yit' ) ?></option>
                            <option value="any" <?php selected( 'any', $selected_search ) ?>><?php _e( 'All', 'yit' ) ?></option>
                        </select>

                    <?php else: ?>
                        <input type="hidden" name="post_type" class="yit_wcas_post_type" id="yit_wcas_post_type" value="<?php echo $research_post_type ?>" />
                    <?php endif; ?>

                </div>

                <div class="input-search-wrapper">
                    <input type="search"
                           value="<?php echo get_search_query() ?>"
                           name="s"
                           id="yith-s"
                           class="yith-s"
                           data-append-to = ".yith-ajaxsearchform-container .input-search-wrapper"
                           placeholder="<?php echo get_option('yith_wcas_search_input_label') ?>"
                           data-loader-icon="<?php echo str_replace( '"', '', apply_filters('yith_wcas_ajax_search_icon', '') ) ?>"
                           data-min-chars="<?php echo get_option('yith_wcas_min_chars'); ?>" />
                </div>

            </div>

            <?php if ( defined( 'ICL_LANGUAGE_CODEICL_LANGUAGE_CODE' ) ): ?>
                <input type="hidden" class="lang_param" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
            <?php endif ?>

            <input type="submit" id="yith-searchsubmit" value="<?php echo get_option('yith_wcas_search_submit_label') ?>" />
        </div>
    </form>
</div>