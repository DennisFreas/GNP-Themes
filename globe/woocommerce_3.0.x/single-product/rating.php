<?php
/**
 * Single Product Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
    return;

global $product;

$rating_count= $product->get_rating_count();
$rating = $product->get_average_rating();

// if we have some rating we'll show the div content.
if ( $rating_count > 0 ) :
?>
    <div class="rating-single-product" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <?php
            echo '<div class="product-rating"><span class="star-empty"><span class="star" style="width:' . $rating * 20 . '%"></span></span></div>';
            echo "<span class='rating-text'> <span itemprop='reviewCount'>". $rating_count ." </span>". _n( "review", "reviews", $rating_count, "yit" )." </span>";
        ?>
        <meta itemprop="ratingValue" content="<?php echo $rating; ?>" />
    </div>
    <div class="clearfix"></div>
<?php
endif;
?>
