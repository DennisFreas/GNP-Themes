<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > Content > Blog
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Blog > List Posts Settings */
    array(
        'type' => 'title',
        'name' => __( 'List Posts', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'    => 'blog-excluded-cats',
        'type'  => 'cat',
        'cols'  => 2,
        'heads' => array( __( 'Blog Page', 'yit' ), __( 'List cat. sidebar', 'yit' ) ),
        'name'  => __( 'Exclude categories', 'yit' ),
        'desc'  => __( 'Select witch categories you want exlude from blog.', 'yit' )
    ),

    array(
        'id'   => 'blog-show-featured-image',
        'type' => 'onoff',
        'name' => __( 'Show featured image', 'yit' ),
        'desc' => __( 'Select if you want to show the featured image of the post. ', 'yit' ),
        'std'  => 'yes',
    ),

    array(
        'id'   => 'blog-show-title',
        'type' => 'onoff',
        'name' => __( 'Show Title', 'yit' ),
        'desc' => __( "Select if you want to show the title of the post.", 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-show-date',
        'type' => 'onoff',
        'name' => __( 'Show date', 'yit' ),
        'desc' => __( 'Select if you want to show the date of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-show-author',
        'type' => 'onoff',
        'name' => __( 'Show author', 'yit' ),
        'desc' => __( 'Select if you want to show the author of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-show-comments',
        'type' => 'onoff',
        'name' => __( 'Show comments', 'yit' ),
        'desc' => __( 'Select if you want to show the comments of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-show-tags',
        'type' => 'onoff',
        'name' => __( 'Show tags', 'yit' ),
        'desc' => __( 'Select if you want to show the tags of the post.', 'yit' ),
        'std'  => 'no'
    ),

    array(
        'id'   => 'blog-show-categories',
        'type' => 'onoff',
        'name' => __( 'Show categories', 'yit' ),
        'desc' => __( 'Select if you want to show the categories of the post.', 'yit' ),
        'std'  => 'no'
    ),

    array(
        'id'   => 'blog-post-format-icon',
        'type' => 'onoff',
        'name' => __( 'Show post format icon', 'yit' ),
        'desc' => __( 'Select if you want to show the post format icon.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-show-read-more',
        'type' => 'onoff',
        'name' => __( 'Show "Read More" button', 'yit' ),
        'desc' => __( 'Select if you want to show the "Read More" button.', 'yit' ),
        'std'  => 'yes',
    ),

    array(
        'id'   => 'blog-read-more-text',
        'type' => 'text',
        'name' => __( 'Read More text', 'yit' ),
        'desc' => __( 'Write what you want to show on more link.', 'yit' ),
        'std'  => 'READ ARTICLE',
        'deps' => array(
            'ids'    => 'blog-show-read-more',
            'values' => 'yes'
        )
    ),

    /* Blog > Single Post Settings */
    array(
        'type' => 'title',
        'name' => __( 'Single Post', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'   => 'blog-single-show-featured-image',
        'type' => 'onoff',
        'name' => __( 'Show featured image', 'yit' ),
        'desc' => __( 'Select if you want to show the featured image of the post. ', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-single-show-title',
        'type' => 'onoff',
        'name' => __( 'Show Title', 'yit' ),
        'desc' => __( "Select if you want to show the title of the post.", 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-single-show-date',
        'type' => 'onoff',
        'name' => __( 'Show date', 'yit' ),
        'desc' => __( 'Select if you want to show the date of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-single-show-author',
        'type' => 'onoff',
        'name' => __( 'Show author', 'yit' ),
        'desc' => __( 'Select if you want to show the author of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-single-show-categories',
        'type' => 'onoff',
        'name' => __( 'Show categories', 'yit' ),
        'desc' => __( 'Select if you want to show the categories of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-single-show-tags',
        'type' => 'onoff',
        'name' => __( 'Show tags', 'yit' ),
        'desc' => __( 'Select if you want to show the tags of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-single-show-comments',
        'type' => 'onoff',
        'name' => __( 'Show comments', 'yit' ),
        'desc' => __( 'Select if you want to show the comments of the post.', 'yit' ),
        'std'  => 'yes'
    ),

    array(
        'id'   => 'blog-single-show-share',
        'type' => 'onoff',
        'name' => __( 'Show "Share"', 'yit' ),
        'desc' => __( 'Select if you want to show the "Share".', 'yit' ),
        'std'  => 'yes'
    ),
);

