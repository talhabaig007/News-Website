<?php
/**
 * File to define functions and hooks related to preloader
 * 
 * @package Azure News
 */

if ( ! function_exists( 'azure_news_preloader_items' ) ) :

	/**
	 * function to manage the requested preloader items
	 * 
	 * @since 1.0.0
	 */
	function azure_news_preloader_items() {
		$azure_news_preloader_enable = azure_news_get_customizer_option_value( 'azure_news_preloader_enable' );

		if ( false === $azure_news_preloader_enable ) {
			return;
		}

		$azure_news_preloader_style = azure_news_get_customizer_option_value( 'azure_news_preloader_style' );

?>
		<div id="azure-news-preloader" class="preloader-background">
			<div class="preloader-wrapper">
				<?php
					switch ( $azure_news_preloader_style ) {
						case 'three_bounce':
				?>
							<div class="azure-news-three-bounce">
	                            <div class="az-child az-bounce1"></div>
	                            <div class="az-child az-bounce2"></div>
	                            <div class="az-child az-bounce3"></div>
	                        </div>
				<?php
							break;

						case 'wave':
				?>
							<div class="azure-news-wave">
	                            <div class="az-rect az-rect1"></div>
	                            <div class="az-rect az-rect2"></div>
	                            <div class="az-rect az-rect3"></div>
	                            <div class="az-rect az-rect4"></div>
	                            <div class="az-rect az-rect5"></div>
	                        </div>
				<?php
							break;

						case 'folding_cube':
				?>
							<div class="azure-news-folding-cube">
	                            <div class="az-cube1 az-cube"></div>
	                            <div class="az-cube2 az-cube"></div>
	                            <div class="az-cube4 az-cube"></div>
	                            <div class="az-cube3 az-cube"></div>
	                        </div>
				<?php
							break;
						
						default:
				?>
							<div class="azure-news-three-bounce">
	                            <div class="az-child az-bounce1"></div>
	                            <div class="az-child az-bounce2"></div>
	                            <div class="az-child az-bounce3"></div>
	                        </div>
				<?php
							break;
					}
				?>
			</div><!-- .preloader-wrapper -->
		</div><!-- #azure-news-preloader -->
<?php
	}

endif;

add_action( 'azure_news_before_page', 'azure_news_preloader_items', 5 );