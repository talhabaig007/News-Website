<?php
/**
 * Template part for displaying a content located in bottom footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_footer_bottom_enable = azure_news_get_customizer_option_value( 'azure_news_footer_bottom_enable' );

if ( false === $azure_news_footer_bottom_enable ) {
    return;
}

?>

<div class="site-info">
    <div class="azure-news-container azure-news-flex">
        <div class="copyright-content-wrapper">
            <span class="copyright-content">
                <?php
                    $copyright_content = azure_news_get_customizer_option_value( 'azure_news_footer_copyright_info' );
                    echo wp_kses_post( str_replace( '{year}', date('Y'), $copyright_content ) );
                ?>
            </span><!-- .copyright-content -->
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'azure-news' ) ); ?>">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Proudly powered by %s', 'azure-news' ), 'WordPress' );
                ?>
            </a>
            <span class="sep"> | </span>
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf( esc_html__( 'Theme: %1$s by %2$s.', 'azure-news' ), 'azure-news', '<a href="https://codevibrant.com/">CodeVibrant</a>' );
                ?>
        </div><!-- .copyright-content-wrapper -->
        <nav id="footer-navigation" class="footer-navigation" <?php azure_news_schema_markup( 'site_navigation' ); ?>>
            <div class="footer-menu-wrap">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer_menu',
                        'menu_id'        => 'footer-menu',
                    )
                );
                ?>
            </div><!-- .footer-menu-wrap -->
        </nav><!-- #site-navigation -->
    </div>
</div><!-- .site-info -->