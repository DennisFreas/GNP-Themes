<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

return array(
    'general' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Newsletter Popup General Settings', 'yiw' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'general' => array(

            array( 'type' => 'open' ),

            array( 'name' => __( 'Enable Newsletter Popup', 'yit' ),
                   'desc' => __( 'Enable the newsletter popup. (Default: Off) ', 'yit' ),
                   'id'   => 'newsletter_popup_enable',
                   'type' => 'on-off',
                   'std'  => 'no' ),

            array( 'name' => __( 'Show on all pages', 'yit' ),
                   'desc' => __( 'Enable newsletter popup for all pages. (Default: Off) ', 'yit' ),
                   'id'   => 'newsletter_enabled_everywhere',
                   'type' => 'on-off',
                   'std'  => 'yes' ),

            array( 'name' => __( 'Select where you want to show popup', 'yit' ),
                   'desc' => __( 'Select pages where you want to show popup. ', 'yit' ),
                   'id'   => 'newsletter_popup_pages',
                   'type' => 'chosen',
                   'multiple' => true,
                   'options' => YIT_Newsletter()->get_available_pages(),
                   'std'  => array(),
                   'deps' => array(
                        'ids' => 'newsletter_enabled_everywhere',
                        'values' => 'no'
                   ) ),

            array( 'name' => __( 'Hide policy', 'yit' ),
                   'desc' => __( 'Select when popup should hide. (Default: Hide only on hiding checkbox checked) ', 'yit' ),
                   'id'   => 'newsletter_hide_policy',
                   'type' => 'select',
                   'options' => array(
                       'always' => __('Hide only on hiding checkbox checked', 'yit'),
                       'session' => __('Show only one time for session', 'yit')
                   ),
                   'std'  => 'yes' ),

            array( 'name' => __( 'Enable Form Popup', 'yit' ),
                   'desc' => __( 'Enable a newsletter subscription form in the popup. (Default: Off) ', 'yit' ),
                   'id'   => 'newsletter_form_enable',
                   'type' => 'on-off',
                   'std'  => 'no' ),

            array( 'name' => __( 'Select newsletter form to use in popup', 'yit' ),
                   'desc' => __( 'Select the form you want to use in your popup; if no form is shown, you may have to create a new one', 'yit' ),
                   'id'   => 'newsletter_form',
                   'type' => 'select',
                   'options' => YIT_Newsletter()->get_newsletter_post(),
                   'std'  => apply_filters( 'yit_newsletter_popup_form_std', false ),
                   'deps' => array(
                       'ids' => 'newsletter_form_enable',
                       'values' => 'yes'
                   ) ),

            array( 'name' => __( 'Cookie Variable', 'yit' ),
                   'desc' => __( 'Write here a name to be given to the cookie generated by the closing link of the popup, in this way, as soon as you\'ll change this value all your visitors will see it again even if they disabled it. Don\'t abuse of this function!', 'yit' ),
                   'id'   => 'newsletter_popup_cookie_var',
                   'type' => 'text',
                   'std'  => __( 'yithpopup', 'yit' ) ),

            array( 'name' => __( 'Popup Title', 'yit' ),
                   'desc' => __( 'The title displayed. You can also use HTML code.', 'yit' ),
                   'id'   => 'newsletter_popup_title',
                   'type' => 'text',
                   'std'  => __( 'Join our faboulous community today!', 'yit' ) ),

            array( 'name' => __( 'Popup Image', 'yit' ),
                   'desc' => __( 'Upload an image. (Tip: best viewed with a rectangular image sized like 315px X 225px)', 'yit' ),
                   'id'   => 'newsletter_popup_image',
                   'type' => 'upload',
                   'std'  => apply_filters( 'yit_newsletter_popup_image_std', YIT_Newsletter()->plugin_assets_url . '/images/popup/popup.jpg') ),

            array( 'name' => __( 'Popup Message', 'yit' ),
                   'desc' => __( 'The message displayed. You can also use HTML code.', 'yit' ),
                   'id'   => 'newsletter_popup_message',
                   'type' => 'textarea',
                   'std'  => __( 'Write your message here', 'yit' ) ),

            array( 'name' => __( 'Hiding text', 'yit' ),
                   'desc' => __( 'The title displayed next to the checkbox that let users hide the popup forever. You can also use HTML code.', 'yit' ),
                   'id'   => 'newsletter_popup_hide_text',
                   'type' => 'text',
                   'std'  =>  __( 'Do not show it anymore.', 'yit' ) ),

            array( 'name' => __( 'Button Class', 'yit' ),
                   'desc' => __( 'The class of form button.', 'yit' ),
                   'id'   => 'newsletter_button_class',
                   'type' => 'text',
                   'std'  => '',
                   'deps' => array(
                       'ids' => 'newsletter_form_enable',
                       'values' => 'yes'
                   ) ),

            array( 'name' => __( 'Custom style', 'yit' ),
                   'desc' => __( 'Insert here your custom CSS style.', 'yit' ),
                   'id'   => 'newsletter_custom_style',
                   'type' => 'textarea',
                   'std'  => '' ),

            array( 'type' => 'close' )
        ),
        /* =================== GENERAL =================== */

    ),
);