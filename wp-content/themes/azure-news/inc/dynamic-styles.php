<?php
/**
 * Managed the theme's dynamic styles.
 *
 * @package Azure News
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*---------------------- Custom CSS ----------------------------*/

    if ( ! function_exists( 'azure_news_custom_css' ) ) :

        /**
         * function to handle azure_news_head_css filter where all the css relation functions are hooked.
         *
         * @since 1.0.0
         */
        function azure_news_custom_css( $output_css = NULL ) {

            // Add filter azure_news_head_css for adding custom css via other functions.
            $output_css = apply_filters( 'azure_news_head_css', $output_css );

            if ( ! empty( $output_css ) ) {
                $output_css = wp_strip_all_tags( azure_news_minify_css( $output_css ) );
                echo "<!--Azure News CSS -->\n<style type=\"text/css\">\n". $output_css ."\n</style>";
            }
        }

    endif;

    add_action( 'wp_head', 'azure_news_custom_css', 9999 );

/*---------------------- General CSS ---------------------------*/

    if ( ! function_exists( 'azure_news_general_css' ) ) :

        /**
         * function to handle the genral css for all sections.
         *
         * @since 1.0.0
         */
        function azure_news_general_css( $output_css ) {
            $azure_news_primary_theme_color    = azure_news_get_customizer_option_value( 'azure_news_primary_theme_color' );
            $primary_darker_color   = azure_news_darker_color( $azure_news_primary_theme_color, '-20' );
            $azure_news_text_color             = azure_news_get_customizer_option_value( 'azure_news_text_color' );
            $azure_news_link_color             = azure_news_get_customizer_option_value( 'azure_news_link_color' );
            $azure_news_link_hover_color       = azure_news_get_customizer_option_value( 'azure_news_link_hover_color' );

            $get_categories = get_categories( array( 'hide_empty' => 1 ) );

            $azure_news_main_container_width   = azure_news_get_customizer_option_value( 'azure_news_main_container_width' );
            $azure_news_boxed_container_width  = azure_news_get_customizer_option_value( 'azure_news_boxed_container_width' );

            //define variable for custom css
            $custom_css = '';

            // Background Color
            $custom_css .= ".azure-news-wave .az-rect,.azure-news-folding-cube .az-cube:before , .azure-news-three-bounce .az-child, .search-icon-close, .navigation .nav-links a, .bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.page-header .page-title::after,.page-header .page-title::before,.navigation .nav-links a.page-numbers:hover,.navigation .nav-links .page-numbers.current,.reply .comment-reply-link,#top-header,.sticky-sidebar-close,.subcribe-ads-button a,#site-navigation #primary-menu > li > a::after,#site-navigation .menu-item-description,.news-ticker-label,.azure-news-banner-wrapper .banner-tabbed-wrapper ul.banner-tabs li.ui-state-active a,.banner-tabbed-wrapper ul.banner-tabs li:hover a,.block-wrapper .block-title:before,.block-wrapper .block-title:after,.widget-title:before,.widget-title:after,.trending-posts .post-thumbnail-wrap .post-count,.azure-news-button.read-more-button a:hover,#azure-news-scrollup,.site-info,.related-post-title::before,.related-post-title::after,.page.type-page .entry-title::before,.page.type-page .entry-title::after,.azure-news-site-layout--boxed,.error-404.not-found .error-button-wrap a {background-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            // Color
            $custom_css .= ".entry-cat .cat-links a:hover,.entry-cat a:hover,.byline a:hover,.posted-on a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,.logged-in-as a,.edit-link a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.entry-title a:hover,.post-title a:hover,.social-icons-wrapper .social-icon i:hover,#site-navigation ul li.current-menu-item > a,#site-navigation ul li.current_page_item > a,#site-navigation ul li.current-menu-ancestor > a,.azure-news-banner-wrapper .tabbed-content-wrapper a:hover,.author-name,.block-posts-wrapper .post-cats-wrap .post-cats-list .post-cat-item a,.trending-posts-wrapper .post-content-wrap .post-cat-item a,.latest-posts-wrapper .post-content-wrap .post-cat-item a,.both-sidebar .azure-news-post-content-wrap .entry-title a:hover,.azure-news-post-content-wrap .entry-meta span a:hover,.azure-news-author-website a,.related-posts-wrapper .post-cats-wrap .post-cat-item a,.azure-news-author-name a,a:hover,a:focus,a:active,.screen-reader-text:hover,.screen-reader-text:active,.screen-reader-text:focus,#cancel-comment-reply-link:before,.azure-news-post-content-wrap .entry-meta span a:hover,.azure-news-post-content-wrap .entry-meta span:hover:before{color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            // Border Color
            $custom_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a.page-numbers:hover,.navigation .nav-links .page-numbers.current,.sticky-sidebar-close,.header-search-wrapper .search-form-wrap .search-submit,.azure-news-banner-wrapper .banner-tabbed-wrapper ul.banner-tabs li.ui-state-active a,.banner-tabbed-wrapper ul.banner-tabs li:hover a,.azure-news-button.read-more-button a:hover{border-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            // Border Left Color
            $custom_css .= "#site-navigation ul.sub-menu,#site-navigation ul.children,#site-navigation ul.sub-menu li,#site-navigation ul.children li{border-left-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            // Border bottom Color
            $custom_css .= ".header-search-wrapper .search-form-wrap::before{border-bottom-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";


            // Border Top Color
            $custom_css .= ".header-search-wrapper .search-form-wrap,#site-navigation .menu-item-description::after,#site-navigation ul li.current-menu-item > a, #site-navigation ul li.current_page_item > a, #site-navigation ul li.current-menu-ancestor > a{border-top-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            // Responsive color
            $custom_css .= "@media (max-width: 769px) { .azure-news-menu-toogle,
                .subcribe-ads-button a,.sidebar-toggle-search-wrapper .sidebar-menu-toggle {background-color: ". esc_attr( $azure_news_primary_theme_color ) ."}}\n";

            //$custom_css .= "@media (max-width: 979px) { .header-main-layout--two .azure-news-menu-toogle:hover {color: ". esc_attr( $azure_news_primary_theme_color ) ."}}\n";

             // Woocommerce Dynamic color

            $custom_css .= ".woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce .product_meta a:hover,.woocommerce-error:before, .woocommerce-info:before, .woocommerce-message:before{color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            $custom_css .= ".woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce ul.products li.product:hover .button,.woocommerce ul.products li.product:hover .added_to_cart,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt.woocommerce nav.woocommerce-pagination ul li a,.woocommerce nav.woocommerce-pagination ul li span.woocommerce span.onsale,.woocommerce div.product .woocommerce-tabs ul.tabs li.active,.woocommerce #respond input#submit.disabled,.woocommerce #respond input#submit:disabled,.woocommerce #respond input#submit:disabled[disabled],.woocommerce a.button.disabled, .woocommerce a.button:disabled,.woocommerce a.button:disabled[disabled],.woocommerce button.button.disabled,.woocommerce button.button:disabled,.woocommerce button.button:disabled[disabled],.woocommerce input.button.disabled,.woocommerce input.button:disabled,.woocommerce input.button:disabled[disabled].woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover.woocommerce,.widget_price_filter .ui-slider .ui-slider-range,.woocommerce-MyAccount-navigation-link a,.woocommerce-store-notice,.woocommerce span.onsale,.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, p.demo_store{background-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            $custom_css .= ".woocommerce ul.products li.product:hover,.woocommerce-page ul.products li.product:hover.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce ul.products li.product:hover .button,.woocommerce ul.products li.product:hover .added_to_cart,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{border-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            $custom_css .= ".woocommerce div.product .woocommerce-tabs ul.tabs{border-bottom-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            $custom_css .= ".woocommerce-error, .woocommerce-info, .woocommerce-message{border-top-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            // Preloader Color
            $custom_css .= ".azure-news-wave .og-rect,.azure-news-three-bounce .og-child,.azure-news-folding-cube .og-cube:before{background-color: ". esc_attr( $azure_news_primary_theme_color ) ."}\n";

            // Text Color
            $custom_css .= "body {color: ". esc_attr( $azure_news_text_color ) ."}\n";

            // Link Color
            $custom_css .= ".page-content a, .entry-content a, .entry-summary a {color: ". esc_attr( $azure_news_link_color ) ."}\n";

            // Link Hover Color
            $custom_css .= ".page-content a:hover, .entry-content a:hover, .entry-summary a:hover{color: ". esc_attr( $azure_news_link_hover_color ) ."}\n";

            // different categories color
            foreach ( $get_categories as $category ) {
                $get_term_id = $category->term_id;
                $get_cat_color = get_theme_mod( 'category_color_'.strtolower( $get_term_id ), '#3b2d1b' );

                $custom_css .= ".block-posts-wrapper .post-cats-wrap .post-cats-list .post-cat-item.cat-". absint( $get_term_id ) ." a, .trending-posts-wrapper .post-content-wrap .post-cat-item.cat-". absint( $get_term_id ) ." a, .azure-news-banner-wrapper .lSSlideWrapper .post-cat-item.cat-". absint( $get_term_id ) ." a, .azure-news-banner-wrapper .block-wrapper .post-cat-item.cat-". absint( $get_term_id ) ." a, .azure-news-post-content-wrap .post-cats-wrap .post-cat-item.cat-". absint( $get_term_id ) ." a,  .latest-posts-wrapper .post-content-wrap .post-cat-item.cat-".absint( $get_term_id ) ." a { color: ". esc_attr( $get_cat_color ) ."}\n";

                $custom_css .= ".block-posts-wrapper .post-cats-wrap .post-cats-list .post-cat-item.cat-". absint( $get_term_id ) ." a, .trending-posts-wrapper .post-content-wrap .post-cat-item.cat-". absint( $get_term_id ) ." a, .azure-news-banner-wrapper .lSSlideWrapper .post-cat-item.cat-". absint( $get_term_id ) ." a, .azure-news-banner-wrapper .block-wrapper .post-cat-item.cat-". absint( $get_term_id ) ." a, .azure-news-post-content-wrap .post-cats-wrap .post-cat-item.cat-". absint( $get_term_id ) ." a, .latest-posts-wrapper .post-content-wrap .post-cat-item.cat-". absint( $get_term_id ) ." a { background-image: linear-gradient(". esc_attr( $get_cat_color ) .", ". esc_attr( $get_cat_color ) .")}\n";

                //$custom_css .= ".post-cats-wrap .post-cats-list li.cat-".absint( $get_term_id ) ." a { color: ". esc_attr( $get_cat_color ) ."}\n";

                //$custom_css .= ".azure-news-banner-wrapper.frontpage-banner-layout--two .tabbed-content-wrapper .post-cats-wrap .post-cats-list li.cat-".absint( $get_term_id ) ." a { color: ". esc_attr( $get_cat_color ) ."}\n";

                //$custom_css .= ".single-posts-layout--two .post-cats-wrap .post-cats-list li.cat-".absint( $get_term_id ) ." a { background-color: ". esc_attr( $get_cat_color ) ."}\n";
            }

            $custom_css .= ".azure-news-container{width: ". absint( $azure_news_main_container_width ) ."px}\n";

            $custom_css .= ".azure-news-site-layout--boxed #page{width: ". absint( $azure_news_boxed_container_width ) ."px}\n";

            // frontpage banner bg type with value
            $azure_news_banner_bg_type = azure_news_get_customizer_option_value( 'azure_news_banner_bg_type' );
            if ( 'bg-image' === $azure_news_banner_bg_type ) {
                $azure_news_banner_bg_image        = azure_news_get_customizer_option_value( 'azure_news_banner_bg_image' );
                $azure_news_banner_bg_image_url    = wp_get_attachment_image_url( $azure_news_banner_bg_image, 'full' );
                $custom_css .= ".azure-news-banner-wrapper{background-image:url(". esc_url( $azure_news_banner_bg_image_url ) .")}\n";
            } elseif ( 'bg-color' === $azure_news_banner_bg_type ) {
                $azure_news_banner_bg_color = azure_news_get_customizer_option_value( 'azure_news_banner_bg_color' );
                $custom_css .= ".azure-news-banner-wrapper{background-color: ". esc_attr( $azure_news_banner_bg_color ) ."}\n";
            }

            // top header bg color
            $azure_news_header_top_bg_color = azure_news_get_customizer_option_value( 'azure_news_header_top_bg_color' );
            $custom_css .= "#top-header{background-color: ". esc_attr( $azure_news_header_top_bg_color ) ."}\n";

            if ( ! empty( $custom_css ) ) {
                $output_css .= $custom_css;
            }

            return $output_css;
        }

    endif;

    add_filter( 'azure_news_head_css', 'azure_news_general_css' );

/*---------------------- Header CSS------------------------ ----*/

    if ( ! function_exists( 'azure_news_main_header_css' ) ) :

        /**
         * function to handle the css for header section.
         *
         * @since 1.0.0
         */
        function azure_news_main_header_css( $output_css ) {

            $azure_news_header_main_bg_type = azure_news_get_customizer_option_value( 'azure_news_header_main_bg_type' );

            $custom_css = '';

            if ( 'bg-image' === $azure_news_header_main_bg_type ) {
                $azure_news_header_main_bg_image        = azure_news_get_customizer_option_value( 'azure_news_header_main_bg_image' );
                $azure_news_header_main_bg_image_url    = wp_get_attachment_image_url( $azure_news_header_main_bg_image, 'full' );
                if ( ! empty( $azure_news_header_main_bg_image_url ) ) {
                    $custom_css .= "background-image:url(". esc_url( $azure_news_header_main_bg_image_url ) .")\n";
                }
            } elseif ( 'bg-color' === $azure_news_header_main_bg_type ) {
                $azure_news_header_main_bg_color = azure_news_get_customizer_option_value( 'azure_news_header_main_bg_color' );
                $custom_css .= "background-color: ". esc_attr( $azure_news_header_main_bg_color ) ."\n";
            }

            if ( ! empty( $custom_css ) ) {
                $output_css .= '/* Main Header CSS */#masthead{'. $custom_css .'}';
            }

            return $output_css;

        }

    endif;

    add_filter( 'azure_news_head_css', 'azure_news_main_header_css' );

/*---------------------- Typography CSS-------------------------*/

    if ( ! function_exists( 'azure_news_typography_css' ) ) :

    /**
     * function to handle the typography css.
     *
     * @since 1.0.0
     */
    function azure_news_typography_css( $output_css ) {

        $custom_css = '';

        /**
         * Body typography
         */
        $azure_news_body_font_family       = azure_news_get_customizer_option_value( 'azure_news_body_font_family' );
        $azure_news_body_font_weight       = azure_news_get_customizer_option_value( 'azure_news_body_font_weight' );
        $azure_news_body_font_style        = azure_news_get_customizer_option_value( 'azure_news_body_font_style' );
        $azure_news_body_font_transform    = azure_news_get_customizer_option_value( 'azure_news_body_font_transform' );
        $azure_news_body_font_decoration   = azure_news_get_customizer_option_value( 'azure_news_body_font_decoration' );

        $custom_css .= "body{
            font-family:        $azure_news_body_font_family;
            font-style:         $azure_news_body_font_style;
            font-weight:        $azure_news_body_font_weight;
            text-decoration:    $azure_news_body_font_decoration;
            text-transform:     $azure_news_body_font_transform;
        }\n";

        /**
         * H1 to H6 typography
         */
        $azure_news_heading_font_family       = azure_news_get_customizer_option_value( 'azure_news_heading_font_family' );
        $azure_news_heading_font_weight       = azure_news_get_customizer_option_value( 'azure_news_heading_font_weight' );
        $azure_news_heading_font_style        = azure_news_get_customizer_option_value( 'azure_news_heading_font_style' );
        $azure_news_heading_font_transform    = azure_news_get_customizer_option_value( 'azure_news_heading_font_transform' );
        $azure_news_heading_font_decoration   = azure_news_get_customizer_option_value( 'azure_news_heading_font_decoration' );

        $custom_css .= "h1, h2, h3, h4, h5, h6 {
            font-family:        $azure_news_heading_font_family;
            font-style:         $azure_news_heading_font_style;
            font-weight:        $azure_news_heading_font_weight;
            text-decoration:    $azure_news_heading_font_decoration;
            text-transform:     $azure_news_heading_font_transform;
        }\n";

        if ( ! empty( $custom_css ) ) {
            $output_css .= '/*/ Typography CSS /*/'. $custom_css;
        }

        return $output_css;
    }

endif;

add_filter( 'azure_news_head_css', 'azure_news_typography_css' );