<?php
/**
 * Partial template for main banner tabbed.
 * 
 * @package Azure News
 */

$azure_news_banner_tab_label_latest   = azure_news_get_customizer_option_value( 'azure_news_banner_tab_label_latest' );
$azure_news_banner_tab_label_popular  = azure_news_get_customizer_option_value( 'azure_news_banner_tab_label_popular' );
$azure_news_banner_tab_label_trending  = azure_news_get_customizer_option_value( 'azure_news_banner_tab_label_trending' );
            
?>

<div id="banner-tabbed" class="banner-tabbed-wrapper">
    <ul class="banner-tabs">
        <li><a href="#tab-latest"><i class='bx bx-time' ></i><?php echo esc_html( $azure_news_banner_tab_label_latest ); ?></a></li>
        <li><a href="#tab-popular"><i class='bx bxs-hot' ></i><?php echo esc_html( $azure_news_banner_tab_label_popular ); ?></a></li>
        <li><a href="#tab-trendng"><i class='bx bxs-bolt' ></i><?php echo esc_html( $azure_news_banner_tab_label_trending ); ?></a></li>
    </ul><!-- .banner-tab -->
    <div class="tabbed-content-wrapper">
        <div id="tab-latest" class="tab-content-wrap">
            <?php azure_news_render_tab_posts( 'latest' ); ?>
        </div><!-- .tab-content-wrap -->
        <div id="tab-popular" class="tab-content-wrap" role="presentation">
            <?php azure_news_render_tab_posts( 'popular' ); ?>
        </div><!-- .tab-content-wrap -->
        <div id="tab-trendng" class="tab-content-wrap">
            <?php azure_news_render_tab_posts( 'trending' ); ?>
        </div><!-- .tab-content-wrap -->
    </div><!-- .tabbed-content-wrapper -->
</div><!-- .banner-tabbed-wrapper -->