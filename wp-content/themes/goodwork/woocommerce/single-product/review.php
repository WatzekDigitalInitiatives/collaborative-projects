<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" id="li-comment-<?php comment_ID() ?>" class="comment clearfix">

	<?php $av_size = isset($retina) && $retina === 'true' ? 96 : 48; ?>

	<div class="user"><?php echo get_avatar( $comment, $av_size, '', get_comment_author() ); ?></div>

	<div class="message">

		<div class="info">
			<h4 itemprop="author"><?php echo (get_comment_author_url() != '' ? comment_author_link() : comment_author()); ?><?php

						if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
							if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
								echo '<span class="verified">&nbsp;  –  &nbsp;(' . __( 'verified owner', 'goodwork' ) . ')</span> ';

					?></h4>
			<span class="meta" itemprop="datePublished"><?php echo comment_date('F jS, Y \a\t g:i A'); ?></span>
		</div>

		<?php comment_text(); ?>
		
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="await"><?php _e( 'Your review is awaiting moderation.', 'goodwork' ); ?></em>
		<?php endif; ?>

		<?php if ( $rating && get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>

			<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating clearfix" title="<?php echo sprintf(__( 'Rated %d out of 5', 'goodwork' ), $rating) ?>">
				<?php 
					for($i = 1; $i <= 5; $i++){
						if($i <= $rating)
							echo '<b class="star"></b>';
						else
							echo '<b class="no-star"></b>';
					}
				?>
			</div>

		<?php endif; ?>

	</div>