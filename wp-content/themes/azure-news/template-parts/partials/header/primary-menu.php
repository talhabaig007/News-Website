<?php
/**
 * Partial template to display primary menu
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * hook: azure_news_before_primary_menu
 *
 * @since 1.0.0
 */
do_action( 'azure_news_before_primary_menu' );

?>

<nav id="site-navigation" class="main-navigation azure-news-flex" <?php azure_news_schema_markup( 'site_navigation' ); ?>>
    <button class="azure-news-menu-toogle" aria-controls="primary-menu" aria-expanded="false"> Menu <i class="bx bx-menu"> </i> </button>
    <div class="primary-menu-wrap">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary_menu',
                'menu_id'        => 'primary-menu',
            )
        );
        ?>
    </div><!-- .primary-menu-wrap -->
</nav><!-- #site-navigation -->

<?php
/**
 * hook: azure_news_after_primary_menu
 *
 * @since 1.0.0
 */
do_action( 'azure_news_after_primary_menu' );