<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var $number
 * @var $before_widget
 * @var $after_widget
 * @var $title
 * @var $tweets
 */

echo wp_kses_post ( $before_widget );
echo wp_kses_post ( $title );
?>
<ul class="tweet_list">
	<?php
	foreach ( $widget_tweets as $tweet ) : ?>
		<li>
			<div class="tweet">
				<div class="tweet_avatar">
					<img src="<?php echo esc_url( $tweet['profile_image_url']); ?>" alt="<?php echo esc_attr( $tweet['name'] ); ?>">
				</div>
				<div class="tweet_right">
					<span class="tweet_text">
						<?php echo wp_kses_post ( $tweet['text'] ); ?>
					</span>
					 <span class="tweet_time">
						 <?php echo wp_kses_post ( $tweet['created_at'] ); ?>
					 </span>
				</div>
			</div>
		</li>
	<?php endforeach; ?>
</ul>
<?php echo wp_kses_post ( $after_widget ); ?>