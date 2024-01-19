<?php
/**
 * Template part for displaying a content located in main header layout one.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * hook - azure_news_before_main_header
 *
 * @since 1.0.0
 */
do_action( 'azure_news_before_main_header' );

$azure_news_header_main_bg_type = azure_news_get_customizer_option_value( 'azure_news_header_main_bg_type' );

?>

<header id="masthead" class="site-header header--<?php echo esc_attr( $azure_news_header_main_bg_type ); ?>"
    <?php azure_news_schema_markup( 'header' ); ?>>


    <div class="main-header-wrapper ">
        <div class="azure-news-container azure-news-flex">
            <div class="sidebar-toggle-search-wrapper azure-news-flex">
                <?php
                    // sticky sidebar toggle icon
                    azure_news_sticky_sidebar_toggle();

                    // search icon
                    get_template_part( 'template-parts/partials/header/search' );
                ?>
            </div>
            <!-- sidebar-toggle-search-wrapper -->
            <?php
                // site logo
                get_template_part( 'template-parts/partials/header/site', 'logo' );
            ?>

            <div class=" subcribe-ads-button logo-ads-wrapper">
                <?php

                    // site mode switcher
                    azure_news_site_mode_switcher();

                    // custom button
                    get_template_part( 'template-parts/partials/header/custom', 'button' );
                ?>
                </div><!-- .logo-ads-wrapper -->

        </div>
    </div> <!-- main-header-wrapper -->
    <div class="bottom-header-wrapper">
        <div class="azure-news-container azure-news-flex">
            <?php
                // primary menu
                get_template_part( 'template-parts/partials/header/primary', 'menu' );

            ?>
        </div><!-- .azure-news-container -->
        <div class="azure-advertisement-wrapper">
            <div class="azure-news-container">
        <?php
        // header ads
                get_template_part( 'template-parts/partials/header/ads' );
        ?>
        </div><!-- .azure-news-container -->
      </div><!-- .azure-advertisement-wrapper -->
    </div> <!-- bottom-header-wrapper -->
</header><!-- #masthead -->