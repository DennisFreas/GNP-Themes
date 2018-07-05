<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

return array(

    array(
        'name'               => 'Revolution Slider',
        'slug'               => 'revslider',
        'source'             => YIT_THEME_PLUGINS_PATH . '/revslider.zip',
        'required'           => false,
        'version'            => '4.6.3',
        'force_activation'   => false,
        'force_deactivation' => true,
    ),

	array(
		'name'               => 'WPBakery Visual Composer',
		'slug'               => 'js_composer',
		'source'             => YIT_THEME_PLUGINS_PATH . '/js_composer.zip',
		'required'           => true,
		'version'            => '4.3.4',
		'force_activation'   => false,
		'force_deactivation' => true,
	),

	array(
		'name'               => 'Ultimate Addons for Visual Composer',
		'slug'               => 'Ultimate_VC_Addons',
		'source'             => YIT_THEME_PLUGINS_PATH . '/Ultimate_VC_Addons.zip',
		'required'           => false,
		'version'            => '3.5.3',
		'force_activation'   => false,
		'force_deactivation' => true,
	),

    array(
        'name'         => 'WooCommerce',
        'slug' 		   => 'woocommerce',
        'required' 	   => false,
        'version'      => '2.1.9',
    ),

    array(
        'name'         => 'YITH Essential Kit for WooCommerce #1',
        'slug'         => 'yith-essential-kit-for-woocommerce-1',
        'required'     => false,
        'version'      => '1.0.0',
    ),

);