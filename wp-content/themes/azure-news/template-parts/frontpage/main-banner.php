<?php
/**
 * file to handle the main banner.
 *
 * @package Azure News
 */

$azure_news_banner_slider_order_by = azure_news_get_customizer_option_value( 'azure_news_banner_slider_order_by' );
$order_by = explode( '-', $azure_news_banner_slider_order_by );

$azure_news_banner_args['slider_args'] = array(
    'orderby'               => esc_attr( $order_by[0] ),
    'order'                 => esc_attr( $order_by[1] ),
    'posts_per_page'        => apply_filters( 'azure_news_banner_slider_post_count', 5 ),
    'ignore_sticky_posts'   => true
);

$azure_news_banner_slider_category = azure_news_get_customizer_option_value( 'azure_news_banner_slider_category' );

if ( 'all' !== $azure_news_banner_slider_category ) {
    $azure_news_banner_args['slider_args']['category_name'] = $azure_news_banner_slider_category;
}

$azure_news_banner_slider_date_filter = azure_news_get_customizer_option_value( 'azure_news_banner_slider_date_filter' );
if ( 'all' !== $azure_news_banner_slider_date_filter ) {
    $banner_slider_date_args = azure_news_get_date_format_args( $azure_news_banner_slider_date_filter );
    $azure_news_banner_args['slider_args']['date_query'] = $banner_slider_date_args;
}

$azure_news_banner_block_order_by = azure_news_get_customizer_option_value( 'azure_news_banner_block_order_by' );
$order_by = explode( '-', $azure_news_banner_block_order_by );

$azure_news_banner_args['block_args'] = array(
    'orderby'               => esc_attr( $order_by[0] ),
    'order'                 => esc_attr( $order_by[1] ),
    'posts_per_page'        => apply_filters( 'azure_news_banner_block_post_count', 2 ),
    'ignore_sticky_posts'   => true
);

$azure_news_banner_block_category = azure_news_get_customizer_option_value( 'azure_news_banner_block_category' );

if ( 'all' !== $azure_news_banner_block_category ) {
    $azure_news_banner_args['block_args']['category_name'] = esc_attr( $azure_news_banner_block_category );
}

$azure_news_banner_args['timeline_args'] = array(
    'posts_per_page'        => apply_filters( 'azure_news_banner_timeline_post_count', 5 ),
    'ignore_sticky_posts'   => true
);

$azure_news_banner_bg_type = azure_news_get_customizer_option_value( 'azure_news_banner_bg_type' );

$azure_news_banner_custom_classes[] = 'has-banner-'.esc_attr( $azure_news_banner_bg_type );
$azure_news_banner_column_reorder = azure_news_get_customizer_option_value( 'azure_news_banner_column_reorder' );
if ( empty( $azure_news_banner_column_reorder ) ) {
    return;
}
if ( ! in_array( 'block', $azure_news_banner_column_reorder ) ) {
    $azure_news_banner_custom_classes[] = 'fullwidth-slider';
}
$azure_news_banner_custom_classes[] = 'banner-placed--'.esc_attr( implode( '-', $azure_news_banner_column_reorder ) );
echo '<div class="azure-news-banner-wrapper '. esc_attr( implode( ' ' , $azure_news_banner_custom_classes ) ) .'">';
echo '<div class="azure-news-container azure-news-block">';
foreach ( $azure_news_banner_column_reorder as $key => $value ) {
    if ( 'block' === $value ) {
        get_template_part( 'template-parts/partials/banner/slider', 'block', $azure_news_banner_args );
    } elseif ( 'slider' === $value ) {
        get_template_part( 'template-parts/partials/banner/slider', 'main', $azure_news_banner_args );
    } elseif ( 'tab' === $value ) {
        get_template_part( 'template-parts/partials/banner/slider', 'tab' );
    }
}
echo '</div><!-- .azure-news-container -->';
echo '</div><!-- .azure-news-banner-wrapper -->';