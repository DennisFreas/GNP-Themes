<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$args = array(
    'before_title' => '<a href="#" class="trigger-search icon-magnifier">',
    'after_title' => '</a>'
);

$instance = array(
    'title' => __( 'Search', 'yit' )
);

?>

<div id="header-search">

    <?php

    if ( class_exists('YITH_WCAS') ) {
        the_widget( 'YITH_WCAS_Ajax_Search_Widget', $instance, $args );
    } else {
        the_widget( 'WP_Widget_Search',$instance, $args );
    }

    ?>

</div>
