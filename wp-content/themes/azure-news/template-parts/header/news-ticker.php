<?php
/**
 * Template part to display header news ticker.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_header_ticker_enable = azure_news_get_customizer_option_value( 'azure_news_header_ticker_enable' );

if ( false === $azure_news_header_ticker_enable ) {
    return;
}

$azure_news_header_ticker_label = azure_news_get_customizer_option_value( 'azure_news_header_ticker_label' );
$ticker_post_count = apply_filters( 'azure_news_ticker_post_count', 6 );
$ticker_args = array(
    'posts_per_page'    => absint( $ticker_post_count )
);

$azure_news_ticker_posts_date_filter = azure_news_get_customizer_option_value( 'azure_news_ticker_posts_date_filter' );
if ( 'all' !== $azure_news_ticker_posts_date_filter ) {
    $ticker_date_args = azure_news_get_date_format_args( $azure_news_ticker_posts_date_filter );
    $ticker_args['date_query'] = $ticker_date_args;
}

$dir_class = 'left';
$dir = 'ltr';
if ( is_rtl() ) {
    $dir_class = 'right';
    $dir = 'ltr';
}

?>
<div class="header-news-ticker-wrapper">
    <div class="azure-news-container azure-news-clearfix">
        <?php if ( ! empty( $azure_news_header_ticker_label ) ) { ?>
        <div class="news-ticker-label">
            <div class="news-ticker-loader">
                <div style='left:0;top:0;animation-delay:0s'></div>
                <div style='left:17px;top:0px;animation-delay:0.25s'></div>
                <div style='left:0;top:17px;animation-delay:0.75s'></div>
                <div style='left:17px;top:17px;animation-delay:0.5s'></div>
            </div>

           <span> <?php echo esc_html( $azure_news_header_ticker_label ); ?> </span>

        </div><!-- .news-ticker-label -->
        <?php } ?>
        <div class="news-ticker-posts-wrapper ticker-posts" direction="<?php echo esc_attr( $dir_class ); ?>"
            dir="<?php echo esc_attr( $dir ); ?>">
            <?php
                $ticker_query = new WP_Query( $ticker_args );
                if ( $ticker_query->have_posts() ) :

                    while ( $ticker_query->have_posts() ) {
                        $ticker_query->the_post();
                        if ( has_post_thumbnail() ) {
                            $post_img      = 'has-image';
                        } else {
                            $post_img      = 'no-image';
                        }
            ?>
            <div class="single-post-wrap <?php echo esc_attr( $post_img ); ?>">
                <div class="news-post-thumb">
                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                </div><!-- .post-thumb -->
                <div class="news-post-content-wrap">
                    <?php the_title( '<h3 class="news-ticker-post-title"> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                </div><!-- .post-content-wrap -->
            </div><!-- .single-post-wrap -->
            <?php
                    }

                endif;
            ?>
        </div><!-- .news-ticker-posts-wrapper -->
    </div><!-- .azure-news-container -->
</div><!-- .header-news-ticker-wrapper -->