<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Azure News
 */

get_header();

/**
 * hook - azure_news_before_page_post_content
 *
 * @since 1.0.0
 */
do_action( 'azure_news_before_page_post_content' );

?>

<div class="404-error page-content-wrapper">
    <div class="azure-news-container">
        <main id="primary" class="site-main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <div class="four-zero-sad-wrapper azure-news-flex">
                        <h1 class="four-zero-four"><?php esc_html_e( '4', 'azure-news' ); ?></h1>
                        <div class="emoji-sad">
                            <div class="face">
                                <div class="eyebrow-left"></div>
                                <div class="eyebrow-right"></div>
                                <div class="eye-left"></div>
                                <div class="eye-right"></div>
                                <div class="mouth-sad"></div>
                            </div>
                        </div>
                        <h1 class="four-zero-four"><?php esc_html_e( '4.', 'azure-news' ); ?></h1>
                    </div><!-- .four-zero-sad-wrapper -->
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'azure-news' ); ?>
                    </h1>
                </header><!-- .page-header -->

                <div class="page-content">

                    <p><?php esc_html_e( 'The page you are looking for doesn’t exist. It may have been moved or removed. Please try searching for some other page.', 'azure-news' ); ?>
                    </p>

                    <?php
							$azure_news_error_page_search_enable = azure_news_get_customizer_option_value( 'azure_news_error_page_search_enable' );
							if ( true === $azure_news_error_page_search_enable ) {
						?>
                    <div class="page-search-wrapper">
                        <?php get_search_form(); ?>
                    </div><!-- .page-search-wrapper -->
                    <?php
							}

							$azure_news_error_page_button_enable = azure_news_get_customizer_option_value( 'azure_news_error_page_button_enable' );
							$azure_news_error_page_button_label  = azure_news_get_customizer_option_value( 'azure_news_error_page_button_label' );
							if ( true === $azure_news_error_page_button_enable && !empty( $azure_news_error_page_button_label ) ) {
						?>
                    <div class="error-button-wrap">
                        <a
                            href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( $azure_news_error_page_button_label ); ?></a>
                    </div><!-- .error-button-wrap -->
                    <?php
							}
						?>

                </div><!-- .page-content -->
            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div> <!-- azure-news container -->
</div><!-- .page-content-wrapper -->

<?php
	/**
	 * hook - azure_news_after_page_post_content
	 *
	 * @since 1.0.0
	 */
	do_action( 'azure_news_after_page_post_content' );

	get_footer();