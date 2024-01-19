<?php
/**
 * file to handle the fullwidth section.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_front_fullwidth_blocks = azure_news_get_customizer_option_value( 'azure_news_front_fullwidth_blocks' );

if ( empty ( $azure_news_front_fullwidth_blocks ) ) {
    return;
}

$azure_news_front_fullwidth_blocks = json_decode( $azure_news_front_fullwidth_blocks );
if ( ! in_array( true, array_column( $azure_news_front_fullwidth_blocks , 'option' ) ) ) {
    return;
}

?>

<div id="frontpage-fullwidth" class="frontpage-section azure-news-clearfix">
    <?php
        foreach ( $azure_news_front_fullwidth_blocks as $block ) :
            if ( $block->option ) {
                $block_type = $block->type;
                switch ( $block_type ) {
                    case 'news-featured':

                        $post_orderby       = $block->postOrderby;
                        $order_by           = explode( '-', $post_orderby );
                        $block_category     = $block->category;
                        $block_posts_count  = $block->postCount;
                        $post_date_filter   = $block->postDatefilter;
                        
                        $block_args = array(
                            'post_args' => array(
                                'orderby'               => esc_attr( $order_by[0] ),
                                'order'                 => esc_attr( $order_by[1] ),
                                'posts_per_page'        => absint( $block_posts_count ),
                                'ignore_sticky_posts'   => true
                            ),
                            'post_options' => $block
                        );
                        if ( 'all' !== $block_category ) {
                            $block_args['post_args']['category_name'] = esc_attr( $block_category );
                        }
                        if ( 'all' !== $post_date_filter ) {
                            $post_date_args = azure_news_get_date_format_args( $post_date_filter );
                            $block_args['post_args']['date_query'] = $post_date_args;
                        }

                        get_template_part( 'template-parts/frontpage/'. esc_attr( $block_type ) . '/layout', 'one', $block_args );
                        break;

                    case 'ad-block':
                        $block_args = array(
                            'block_options' => $block
                        );
                        get_template_part( 'template-parts/frontpage/ad', 'block', $block_args );
                        break;
                    
                    default:
                        // code...
                        break;
                }
            }
        endforeach;
    ?>
</div><!-- #frontpage-fullwidth -->