<?php
/**
 * Template part for displaying a scroll top in footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_scroll_top_enable = azure_news_get_customizer_option_value( 'azure_news_scroll_top_enable' );

if ( false === $azure_news_scroll_top_enable ) {
    return;
}

/**
 * hook - azure_news_before_scroll_top
 * 
 * @since 1.0.0
 */
do_action( 'azure_news_before_scroll_top' );

$azure_news_scroll_top_arrow = azure_news_get_customizer_option_value( 'azure_news_scroll_top_arrow' );
?>
    <div id="azure-news-scrollup">
        <i class="bx <?php echo esc_attr( $azure_news_scroll_top_arrow ); ?>"></i>
    </div><!-- #azure-news-scrollup -->
<?php
/**
 * hook - azure_news_after_scroll_top
 * 
 * @since 1.0.0
 */
do_action( 'azure_news_after_scroll_top' );