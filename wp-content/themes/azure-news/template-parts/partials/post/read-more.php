<?php
/**
 * Partial template to display the post read more button
 *
 * @package Azure News
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


$azure_news_read_more_tag = sprintf( '<a href="%1$s">%2$s</a>', esc_url( get_the_permalink() ), esc_html__( 'Read More', 'azure-news' ) );

?>

<div class="azure-news-button read-more-button">
	<?php echo $azure_news_read_more_tag ; ?>
</div><!-- .azure-news-button -->