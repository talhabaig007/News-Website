<?php
/**
 * Partial template to display search icon.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_header_search_enable = azure_news_get_customizer_option_value( 'azure_news_header_search_enable' );
if ( false === $azure_news_header_search_enable ) {
    return;
}

/**
 * hook: azure_news_before_header_search
 *
 * @since 1.0.0
 */
do_action( 'azure_news_before_header_search' );
?>

<div class="header-search-wrapper azure-news-icon-elements">
    <span class="search-icon"><a href="javascript:void(0)"><i class="bx bx-search"></i></a></span>
    <div class="search-form-wrap">
    <span class="search-icon-close"><a href="javascript:void(0)"><i class="bx close bx-x"></i></a></span>
        <?php get_search_form(); ?>
    </div><!-- .search-form-wrap -->
</div><!-- .header-search-wrapper -->

<?php
/**
 * hook: azure_news_after_header_search
 *
 * @since 1.0.0
 */
do_action( 'azure_news_after_header_search' );