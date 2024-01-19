<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Azure News
 */

$global_archive_sidebar = azure_news_get_customizer_option_value( 'azure_news_archive_sidebar_layout' );
$global_posts_sidebar   = azure_news_get_customizer_option_value( 'azure_news_posts_sidebar_layout' );
$global_pages_sidebar   = azure_news_get_customizer_option_value( 'azure_news_pages_sidebar_layout' );

if ( is_page() ) {
    if ( 'right-sidebar' !== $global_pages_sidebar && 'both-sidebar' !== $global_pages_sidebar ) {
        return;
    }
} elseif ( is_single() || is_singular() ) {
    if ( 'right-sidebar' !== $global_posts_sidebar && 'both-sidebar' !== $global_posts_sidebar ) {
        return;
    }
}  elseif ( is_archive() ) {
    if ( 'right-sidebar' !== $global_archive_sidebar && 'both-sidebar' !== $global_archive_sidebar ) {
        return;
    }
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
