<?php
/**
 * Partial template to display header custom button.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_header_custom_button_label = azure_news_get_customizer_option_value( 'azure_news_header_custom_button_label' );

if ( empty( $azure_news_header_custom_button_label ) ) {
    return;
}

$azure_news_header_custom_button_link = azure_news_get_customizer_option_value( 'azure_news_header_custom_button_link' );

?>
<div class="custom-button-wrap azure-news-icon-elements">
    <a href="<?php echo esc_url( $azure_news_header_custom_button_link ); ?>" target="_blank">
        <span class="custom-button-bell-icon"> <i class="bx bx-bell"></i></span><span class="azure-icon-title-label"><?php echo esc_html( $azure_news_header_custom_button_label );  ?></span>
    </a>
</div><!-- .cusotm-button-wrap -->