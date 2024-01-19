<?php
/**
 * Template part for breadcrumb.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_site_breadcrumb_enable = azure_news_get_customizer_option_value( 'azure_news_site_breadcrumb_enable' );

if ( false === $azure_news_site_breadcrumb_enable ) {
    return;
}

$azure_news_site_breadcrumb_types = azure_news_get_customizer_option_value( 'azure_news_site_breadcrumb_types' );

if ( ! function_exists( 'azure_news_breadcrumb_trail' ) ) :

    /**
     *  function to manage the breadcrumb trail
     * 
     * @since 1.0.0
     */
    function azure_news_breadcrumb_trail() {

        $azure_news_body_classes = get_body_class();
        if ( in_array( 'woocommerce', $azure_news_body_classes ) ) {
            woocommerce_breadcrumb();
            return;
        }

        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            // load class file
            require_once get_template_directory() . '/inc/azure-news-class-breadcrumb.php';
        }

        $azure_news_breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );

        breadcrumb_trail( $azure_news_breadcrumb_args );
    }
    
endif;

?>
<div class="azure-news-breadcrumb-wrapper">
    <div class="azure-news-container">
        <?php
            switch ( $azure_news_site_breadcrumb_types ) {
                case 'navxt':
                    if ( function_exists( 'bcn_display' ) ) {
                        echo '<nav id="breadcrumb" class="azure-news-breadcrumb">';
                            bcn_display();
                        echo '</nav>';
                    }
                    break;

                case 'yoast':
                    if ( function_exists( 'yoast_breadcrumb' ) && true === WPSEO_Options::get( 'breadcrumbs-enable', false ) ) {
                        yoast_breadcrumb( '<nav id="breadcrumb" class="azure-news-breadcrumb">', '</nav>' );
                    }
                    break;

                case 'rankmath':
                    if ( function_exists( 'rank_math_the_breadcrumbs' ) && RankMath\Helper::get_settings( 'general.breadcrumbs' ) ) {
                        rank_math_the_breadcrumbs();
                    }
                    break;
                
                default:
                    azure_news_breadcrumb_trail();
                    break;
            }
        ?>
    </div><!-- .azure-news-container -->
</div><!-- .azure-news-breadcrumb-wrapper -->