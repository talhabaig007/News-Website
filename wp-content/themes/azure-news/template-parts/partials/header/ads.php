<?php
/**
 * Partial template to display header ads.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_header_ads_image = azure_news_get_customizer_option_value( 'azure_news_header_ads_image' );

if ( empty( $azure_news_header_ads_image ) || 0 == $azure_news_header_ads_image ) {
    return;
}

$azure_news_header_ads_image_link = azure_news_get_customizer_option_value( 'azure_news_header_ads_image_link' );
$ads_image_src = wp_get_attachment_image( $azure_news_header_ads_image, 'full' );
?>

<div class="azure-news-header-ads-wrap">
    <a href="<?php echo esc_url( $azure_news_header_ads_image_link ); ?>">
        <?php echo wp_kses_post( $ads_image_src ); ?>
    </a>
</div><!-- .azure-news-header-ads-wrap -->