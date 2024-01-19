<?php
/**
 * Partial template to display top header menu
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_header_top_menu_enable = azure_news_get_customizer_option_value( 'azure_news_header_top_menu_enable' );

if ( false === $azure_news_header_top_menu_enable ) {
    return;
}

?>

<nav id="top-navigation" class="top-bar-navigation azure-news-flex">
    <?php
        wp_nav_menu( array(
            'theme_location'    => 'top_header_menu',
            'menu_id'           => 'top-header-menu',
            'depth'             => 1,
            'fallback_cb'       => false
        ) );
    ?>
</nav><!-- #top-navigation -->