<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for shows a box, with Title and icons on left and a text of section (you can use HTML tags)'
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

$a_before = $a_after = '';

$layout = isset( $layout ) ? $layout : '';

if ( ! isset( $title_size) || $title_size == '' ) {
    $title_size = 'h4';
}

$last_class = (isset($last) && $last == 'yes' ) ? ' last' : '';

if( isset( $border ) && $border == 'yes' ) {
    $class .= '-border';
}

if ( ! empty( $link ) ) {
    $link = esc_url( $link );
    if ( ! empty( $link_title ) )
        $link_title = ' title="' . $link_title . '"';
    $a_before = '<a href="' . $link . '"' . $link_title . '>';
    $a_after  = '</a>';
}

$icon_type = ( $icon_type == '' ) ? 'simple_line' : $icon_type;

$animate = ( $animate != '' ) ? ' yit_animate '.$animate : '';
$delay = ( $animation_delay  != '' ) ? 'data-delay="'.$animation_delay.'"' : '';
$margin_left = ( $layout == 'horizontal' ) ? 55: 0;


?>

<div class="clearfix margin-bottom box-sections <?php echo $class . $last_class. $animate; ?> <?php echo $layout?>" <?php echo $delay ?>>
    <?php

    echo $a_before;
    echo '<div class="box-icon">';

    if ( $icon_type == 'awesome' ) {
        $border = ( $circle_size != 0 ) ? 1 : 0;
        $margin_left = ( $circle_size != 0 && $layout == 'horizontal' ) ? ( $circle_size + 30 ) : $margin_left;

        echo '<span class="icon-circle" style="border-width:'.$border.'px;width:'. $circle_size.'px; height:'.$circle_size.'px;border-color: '. $color_circle .';">';

        $color = ( $color == '' ) ? '' : 'color:'.$color;
        $icon_size = ( $icon_size == '' ) ? '14' : $icon_size;
        echo '<span class="icon"><i class="fa fa-'.$icon_awesome.'" style="color:'. $color.'; font-size:'.$icon_size.'px"></i></span>';

        echo '</span>';

    }elseif ( $icon_type == 'simple_line' ) {

        $border = ( $circle_size_simple_line != 0 ) ? 1 : 0;
        $margin_left = ( $circle_size_simple_line != 0 && $layout == 'horizontal' ) ? ( $circle_size_simple_line + 30 ) : $margin_left;

        echo '<span class="icon-circle" style="border-width:'.$border.'px;width:'. $circle_size_simple_line.'px; height:'.$circle_size_simple_line.'px;border-color: '. $color_circle_simple_line .';">';

        echo '<span class="icon"><i class="'.$icon_simple_line.'" style="color:'. $color_simple_line.'; font-size:'.$icon_size_simple_line.'px"></i></span>';
        echo '</span>';
    }
    elseif (  strcmp ( $icon_custom , '' ) != 0  ) {
        $image = yit_image( "echo=no&src=" . $icon_custom . "&getimagesize=1");
        $size = getimagesize($icon_custom);

        echo '<span class="icon">' . $image . '</span>';

        $margin_left = ( isset( $size[0] ) && $size[0] != 0 && $layout == 'horizontal' ) ? ( $size[0] + 60 ) : $margin_left;
    }

    echo '</div><div class="box-content clearfix" style="margin-left:' . $margin_left . 'px">';
    if ( $title != '' ) : echo '<' . $title_size . '>' . $title . '</' . $title_size . '>'; endif;

    echo $a_after;

    ?>
    <?php echo wpautop(do_shortcode($content)); ?>
    <?php echo '</div>' ?>
</div>
