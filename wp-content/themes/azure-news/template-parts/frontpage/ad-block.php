<?php
/**
 * file to handle the top fullwidth ad block.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( $args );

if ( ! isset( $block_options->imgSrc ) || empty( $block_options->imgSrc ) ) {
    return;
}

?>

<section class="frontpage-block ad-block">
    <div class="azure-news-container">
        <div class="block-wrapper">
            <a href="<?php echo esc_url( $block_options->imgUrl ); ?>" rel="nofollow" <?php if ( $block_options->newTab ) echo 'target="_blank"'; ?>>
                <img src="<?php echo esc_url( $block_options->imgSrc ); ?>">
            </a>
        </div><!-- .block-wrapper -->
    </div> <!-- .azure-news-container -->
</section><!-- .ad-block -->