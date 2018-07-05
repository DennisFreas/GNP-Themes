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

$sticky = ( yit_get_option('header-sticky') == 'yes' ) ? ' sticky-header' : '';
$slider = YIT_Layout()->slider_name;
$layout = ! in_array( $slider, array( false, '', 'none' ) ) && class_exists( 'YIT_Slider' ) ? YIT_Slider::get_slider( YIT_Layout()->slider_name )->config->layout : '';

?>
<!-- START HEADER -->
<div id="header" class="clearfix <?php echo $sticky ?><?php if ( 'yes' != yit_get_option('show-dropdown-indicators') ) echo ' no-indicators' ?>">