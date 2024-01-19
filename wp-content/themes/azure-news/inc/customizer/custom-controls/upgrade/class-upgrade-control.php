<?php
/**
 * Customizer Upgrade Control.
 * 
 * @package Azure News
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Azure_News_Control_Upgrade' ) ) :

	/**
	 * Upgrade control.
     *
     * @since 1.0.0
     */
	class Azure_News_Control_Upgrade extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         * @since 1.0.0
         */
        public $type = 'cv-upgrade';

        /**
         * Custom links for this control.
         *
         * @access public
         * @var url
         * @since 1.0.0
         */
        public $url = '';

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         * @since 1.0.0
         */
        public function to_json() {
            parent::to_json();
            
            $this->json['choices']  = $this->choices;
            $this->json['url']      = esc_url( $this->url );
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         * @since 1.0.0
         */
        protected function content_template() {
            ?>
                <div class="cv-upgrade-pro-wrapper">
                    <div class="upgrade-title-wrap">
                        <# if ( data.label ) { #>
                            <span class="upgrade-title">{{{ data.label }}}</span>
                        <# } #>
                        <# if ( data.description ) { #>
                            <span class="description customize-control-description upgrade-description">{{{ data.description }}}</span>
                        <# } #>
                    </div><!-- .upgrade-title -->

                    <# if ( data.choices ) { #>
                        <ul class="upgrade-list-item">
                            <# for ( key in data.choices ) { #>
                                <li class="upgrade-item">{{{ data.choices[ key ] }}}</li>
                            <# } #>
                        </ul><!-- .upgrade-list-item -->
                    <# } #>
                    <a class="cv-upgrade-btn" href="https://codevibrant.com/pricing/?product_id=12736" target="_blank"><?php esc_html_e( 'upgrade to pro', 'azure-news' ); ?></a>
                </div><!-- .cv-upgrade-pro-wrapper -->
            <?php
        }

    }

endif;