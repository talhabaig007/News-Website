<?php
/**
 * Content for background settings section in admin area.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( isset( $_POST['cvmn_submit'] ) ) {

    $maintenance_notice_options = get_option( 'maintenance_notice_options' );
    $cvmn_form_values = array(
        'cvmn_page_typography_inherit'          => sanitize_text_field( $_POST['cvmn_page_typography_inherit'] ),
        'cvmn_page_title_font_family'           => sanitize_text_field( $_POST['cvmn_page_title_font_family'] ),
        'cvmn_page_title_font_family_variant'   => sanitize_text_field( $_POST['cvmn_page_title_font_family_variant'] ),
        'cvmn_page_title_text_transform'        => sanitize_text_field( $_POST['cvmn_page_title_text_transform'] ),
        'cvmn_page_title_text_decoration'       => sanitize_text_field( $_POST['cvmn_page_title_text_decoration'] ),
        'cvmn_page_title_font_size'             => sanitize_text_field( $_POST['cvmn_page_title_font_size'] ),
        'cvmn_page_title_font_color'            => sanitize_hex_color( $_POST['cvmn_page_title_font_color'] ),
        'cvmn_page_heading_font_family'           => sanitize_text_field( $_POST['cvmn_page_heading_font_family'] ),
        'cvmn_page_heading_font_family_variant'   => sanitize_text_field( $_POST['cvmn_page_heading_font_family_variant'] ),
        'cvmn_page_heading_text_transform'        => sanitize_text_field( $_POST['cvmn_page_heading_text_transform'] ),
        'cvmn_page_heading_text_decoration'       => sanitize_text_field( $_POST['cvmn_page_heading_text_decoration'] ),
        'cvmn_page_heading_font_size'             => sanitize_text_field( $_POST['cvmn_page_heading_font_size'] ),
        'cvmn_page_heading_font_color'            => sanitize_hex_color( $_POST['cvmn_page_heading_font_color'] ),
        'cvmn_page_description_font_family'           => sanitize_text_field( $_POST['cvmn_page_description_font_family'] ),
        'cvmn_page_description_font_family_variant'   => sanitize_text_field( $_POST['cvmn_page_description_font_family_variant'] ),
        'cvmn_page_description_text_transform'        => sanitize_text_field( $_POST['cvmn_page_description_text_transform'] ),
        'cvmn_page_description_text_decoration'       => sanitize_text_field( $_POST['cvmn_page_description_text_decoration'] ),
        'cvmn_page_description_font_size'             => sanitize_text_field( $_POST['cvmn_page_description_font_size'] ),
        'cvmn_page_description_font_color'            => sanitize_hex_color( $_POST['cvmn_page_description_font_color'] ),
        'cvmn_page_countdown_font_family'           => sanitize_text_field( $_POST['cvmn_page_countdown_font_family'] ),
        'cvmn_page_countdown_font_family_variant'   => sanitize_text_field( $_POST['cvmn_page_countdown_font_family_variant'] ),
        'cvmn_page_countdown_text_transform'        => sanitize_text_field( $_POST['cvmn_page_countdown_text_transform'] ),
        'cvmn_page_countdown_text_decoration'       => sanitize_text_field( $_POST['cvmn_page_countdown_text_decoration'] ),
        'cvmn_page_countdown_font_size'             => sanitize_text_field( $_POST['cvmn_page_countdown_font_size'] ),
        'cvmn_page_countdown_font_color'            => sanitize_hex_color( $_POST['cvmn_page_countdown_font_color'] ),
        'cvmn_button_one_font_family'           => sanitize_text_field( $_POST['cvmn_button_one_font_family'] ),
        'cvmn_button_one_font_family_variant'   => sanitize_text_field( $_POST['cvmn_button_one_font_family_variant'] ),
        'cvmn_button_one_text_transform'        => sanitize_text_field( $_POST['cvmn_button_one_text_transform'] ),
        'cvmn_button_one_text_decoration'       => sanitize_text_field( $_POST['cvmn_button_one_text_decoration'] ),
        'cvmn_button_one_font_size'             => sanitize_text_field( $_POST['cvmn_button_one_font_size'] ),
        'cvmn_button_one_font_color'            => sanitize_hex_color( $_POST['cvmn_button_one_font_color'] ),
        'cvmn_button_one_bg_color'              => sanitize_hex_color( $_POST['cvmn_button_one_bg_color'] ),
        'cvmn_button_one_border_color'          => sanitize_hex_color( $_POST['cvmn_button_one_border_color'] ),
        'cvmn_button_one_hover_text_color'      => sanitize_hex_color( $_POST['cvmn_button_one_hover_text_color'] ),
        'cvmn_button_one_hover_bg_color'        => sanitize_hex_color( $_POST['cvmn_button_one_hover_bg_color'] )
    );
    update_option( 'maintenance_notice_options', wp_parse_args( $cvmn_form_values, $maintenance_notice_options ) );
}

$maintenance_notice_options = get_option( 'maintenance_notice_options' );
// check if value set or not
$cvmn_page_typography_inherit = isset( $maintenance_notice_options['cvmn_page_typography_inherit'] ) ? esc_html( $maintenance_notice_options['cvmn_page_typography_inherit'] ) : 'show';
$cvmn_page_title_font_family = isset( $maintenance_notice_options['cvmn_page_title_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_font_family'] ) : esc_html( 'Roboto' );
$cvmn_page_title_font_family_variant = isset( $maintenance_notice_options['cvmn_page_title_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_font_family_variant'] ) : '';
$cvmn_page_title_text_transform = isset( $maintenance_notice_options['cvmn_page_title_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_text_transform'] ) : 'none';
$cvmn_page_title_text_decoration = isset( $maintenance_notice_options['cvmn_page_title_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_text_decoration'] ) : 'none';
$cvmn_page_title_font_size = isset( $maintenance_notice_options['cvmn_page_title_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_title_font_size'] ) : '14';
$cvmn_page_title_font_color = isset( $maintenance_notice_options['cvmn_page_title_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_title_font_color'] ) : '#000000';

$cvmn_page_heading_font_family = isset( $maintenance_notice_options['cvmn_page_heading_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_font_family'] ) : esc_html( 'Roboto' );
$cvmn_page_heading_font_family_variant = isset( $maintenance_notice_options['cvmn_page_heading_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_font_family_variant'] ) : '';
$cvmn_page_heading_text_transform = isset( $maintenance_notice_options['cvmn_page_heading_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_text_transform'] ) : 'none';
$cvmn_page_heading_text_decoration = isset( $maintenance_notice_options['cvmn_page_heading_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_text_decoration'] ) : 'none';
$cvmn_page_heading_font_size = isset( $maintenance_notice_options['cvmn_page_heading_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_heading_font_size'] ) : '14';
$cvmn_page_heading_font_color = isset( $maintenance_notice_options['cvmn_page_heading_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_heading_font_color'] ) : '#000000';

$cvmn_page_description_font_family = isset( $maintenance_notice_options['cvmn_page_description_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_font_family'] ) : esc_html( 'Roboto' );
$cvmn_page_description_font_family_variant = isset( $maintenance_notice_options['cvmn_page_description_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_font_family_variant'] ) : '';
$cvmn_page_description_text_transform = isset( $maintenance_notice_options['cvmn_page_description_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_text_transform'] ) : 'none';
$cvmn_page_description_text_decoration = isset( $maintenance_notice_options['cvmn_page_description_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_text_decoration'] ) : 'none';
$cvmn_page_description_font_size = isset( $maintenance_notice_options['cvmn_page_description_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_description_font_size'] ) : '14';
$cvmn_page_description_font_color = isset( $maintenance_notice_options['cvmn_page_description_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_description_font_color'] ) : '#000000';

$cvmn_page_countdown_font_family = isset( $maintenance_notice_options['cvmn_page_countdown_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_font_family'] ) : esc_html( 'Roboto' );
$cvmn_page_countdown_font_family_variant = isset( $maintenance_notice_options['cvmn_page_countdown_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_font_family_variant'] ) : '';
$cvmn_page_countdown_text_transform = isset( $maintenance_notice_options['cvmn_page_countdown_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_text_transform'] ) : 'none';
$cvmn_page_countdown_text_decoration = isset( $maintenance_notice_options['cvmn_page_countdown_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_text_decoration'] ) : 'none';
$cvmn_page_countdown_font_size = isset( $maintenance_notice_options['cvmn_page_countdown_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_countdown_font_size'] ) : '14';
$cvmn_page_countdown_font_color = isset( $maintenance_notice_options['cvmn_page_countdown_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_countdown_font_color'] ) : '#000000';

$cvmn_button_one_font_family = isset( $maintenance_notice_options['cvmn_button_one_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_font_family'] ) : esc_html( 'Roboto' );
$cvmn_button_one_font_family_variant = isset( $maintenance_notice_options['cvmn_button_one_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_font_family_variant'] ) : '';
$cvmn_button_one_text_transform = isset( $maintenance_notice_options['cvmn_button_one_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_text_transform'] ) : 'none';
$cvmn_button_one_text_decoration = isset( $maintenance_notice_options['cvmn_button_one_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_text_decoration'] ) : 'none';
$cvmn_button_one_font_size = isset( $maintenance_notice_options['cvmn_button_one_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_button_one_font_size'] ) : '14';
$cvmn_button_one_font_color = isset( $maintenance_notice_options['cvmn_button_one_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_font_color'] ) : '#000000';
$cvmn_button_one_bg_color = isset( $maintenance_notice_options['cvmn_button_one_bg_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_bg_color'] ) : '#ffffff';
$cvmn_button_one_border_color = isset( $maintenance_notice_options['cvmn_button_one_border_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_border_color'] ) : '#ffffff';
$cvmn_button_one_hover_text_color = isset( $maintenance_notice_options['cvmn_button_one_hover_text_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_hover_text_color'] ) : '#ffffff';
$cvmn_button_one_hover_bg_color = isset( $maintenance_notice_options['cvmn_button_one_hover_bg_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_hover_bg_color'] ) : '#ffffff';

// Get google fonts json
$mt_google_fonts_file = apply_filters( 'maintenance_notice_google_fonts_json_file', MAINTENANCE_NOTICE_PATH . '/admin/assets/google-fonts.json' );
if ( ! file_exists( MAINTENANCE_NOTICE_PATH . '/admin/assets/google-fonts.json' ) ) {
    $google_fonts = array();
}
global $wp_filesystem;
WP_Filesystem();

$get_file_content   = $wp_filesystem->get_contents( $mt_google_fonts_file );
$google_fonts   = json_decode( $get_file_content, 1 );
/**
 * Get font variant
 * 
 */
function get_font_variant( $google_fonts, $font_family ) {
    $variants = [];
    foreach( $google_fonts as $key => $values ) {
        foreach( $values as $valueskey => $value ) {
            if ( $font_family === $valueskey ) {
                $variants = $value['variants'];
            }
        }
    }
    return $variants;
}
?>
<div id="cvmn-typography-settings" class="cvmn-content-block-wrapper">
    <div class="cvmn-admin-content">
        <form id="cvmn-maintenance-notice-options-form" method="POST">
            <div class="cvmn-admin-field-options-wrapper">
                <div class="cvmn-admin-single-field cvmn-admin-toggle-field">
                    <label for="cvmn_page_typography_inherit"><?php esc_html_e( 'Inherit to default plugin typography', 'maintenance-notice' ); ?></label>
                    <input type="hidden" value="<?php echo esc_attr( $cvmn_page_typography_inherit ); ?>" name="cvmn_page_typography_inherit"/>
                    <span class="cvmn-switch <?php if ( $cvmn_page_typography_inherit === 'show' ) echo 'active'; ?>"></span>
                </div>
                <!-- Page Title Typo -->
                <div class="cvmn-typography-row">
                    <div class="cvmn-admin-single-field typography-heading">
                        <div class="cvmn-admin-field-heading">
                            <?php esc_html_e( "Page Title", 'maintenance-notice' ); ?>
                            <span class="row-toggle dashicons dashicons-arrow-up"></span>
                        </div>
                    </div>
                    <div class="typography-row-content">
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-field">
                            <label for="cvmn_page_title_font_family"><?php esc_html_e( 'Font Family', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_title_font_family" class="cvmn-select-field">
                                <?php
                                    foreach( $google_fonts as $key => $values ) {
                                        foreach( $values as $valueskey => $value ) {
                                            $selected = ( $cvmn_page_title_font_family === $valueskey ) ? 'selected' : '';
                                            echo '<option value="' .esc_attr( $valueskey ). '" ' .esc_html( $selected ). '>' .esc_attr( $valueskey ). '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-variant-field">
                            <label for="cvmn_page_title_font_family_variant"><?php esc_html_e( 'Variant', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_title_font_family_variant">
                                <?php
                                    $variants = get_font_variant( $google_fonts, $cvmn_page_title_font_family );
                                    foreach( $variants as $variant ) {
                                        $variant_selected = ( $cvmn_page_title_font_family_variant === $variant ) ? 'selected' : '';
                                        echo '<option value="' .esc_attr( $variant ). '" ' .esc_html( $variant_selected ). '>' .esc_attr( $variant ). '</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_title_text_transform"><?php esc_html_e( 'Text Transform', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_title_text_transform">
                                <option value="none" <?php if ( $cvmn_page_title_text_transform === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="uppercase" <?php if ( $cvmn_page_title_text_transform === 'uppercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Uppercase', 'maintenance-notice' ); ?></option>
                                <option value="lowercase" <?php if ( $cvmn_page_title_text_transform === 'lowercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Lowercase', 'maintenance-notice' ); ?></option>
                                <option value="capitalize" <?php if ( $cvmn_page_title_text_transform === 'capitalize' ) { echo 'selected'; } ?>><?php esc_html_e( 'Capitalize', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_title_text_decoration"><?php esc_html_e( 'Text Decoration', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_title_text_decoration">
                                <option value="none" <?php if ( $cvmn_page_title_text_decoration === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="underline" <?php if ( $cvmn_page_title_text_decoration === 'underline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Underline', 'maintenance-notice' ); ?></option>
                                <option value="overline" <?php if ( $cvmn_page_title_text_decoration === 'overline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Overline', 'maintenance-notice' ); ?></option>
                                <option value="line-through" <?php if ( $cvmn_page_title_text_decoration === 'line-through' ) { echo 'selected'; } ?>><?php esc_html_e( 'Line through', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field cvmn-admin-range-field">
                            <label for="cvmn_page_title_font_size"><?php esc_html_e( 'Font Size', 'maintenance-notice' ); ?></label>
                            <input type="range" name="cvmn_page_title_font_size" value="<?php echo esc_attr( $cvmn_page_title_font_size ); ?>" min="2" max="100">
                            <span class="range-value"><?php echo esc_attr( $cvmn_page_title_font_size . 'px' ); ?></span>
                        </div>
                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_title_font_color"><?php esc_html_e( 'Font Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_page_title_font_color ); ?>" name="cvmn_page_title_font_color" class="cvmn-admin-color-field"/>
                        </div>

                    </div><!-- .typography-row-content -->
                </div><!-- .cvmn-typography-row -->
                <!-- Page Title Typo End -->

                <!-- Page Heading Typo -->
                <div class="cvmn-typography-row">
                    <div class="cvmn-admin-single-field typography-heading">
                        <div class="cvmn-admin-field-heading">
                            <?php esc_html_e( "Page Heading", 'maintenance-notice' ); ?>
                            <span class="row-toggle dashicons dashicons-arrow-down"></span>
                        </div>
                    </div>
                    <div class="typography-row-content" style="display:none">
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-field">
                            <label for="cvmn_page_heading_font_family"><?php esc_html_e( 'Font Family', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_heading_font_family" class="cvmn-select-field">
                                <?php
                                    foreach( $google_fonts as $key => $values ) {
                                        foreach( $values as $valueskey => $value ) {
                                            $selected = ( $cvmn_page_heading_font_family === $valueskey ) ? 'selected' : '';
                                            echo '<option value="' .esc_attr( $valueskey ). '" ' .esc_html( $selected ). '>' .esc_attr( $valueskey ). '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-variant-field">
                            <label for="cvmn_page_heading_font_family_variant"><?php esc_html_e( 'Variant', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_heading_font_family_variant">
                                <?php
                                    $variants = get_font_variant( $google_fonts, $cvmn_page_heading_font_family );
                                    foreach( $variants as $variant ) {
                                        $variant_selected = ( $cvmn_page_heading_font_family_variant === $variant ) ? 'selected' : '';
                                        echo '<option value="' .esc_attr( $variant ). '" ' .esc_html( $variant_selected ). '>' .esc_attr( $variant ). '</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_heading_text_transform"><?php esc_html_e( 'Text Transform', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_heading_text_transform">
                                <option value="none" <?php if ( $cvmn_page_heading_text_transform === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="uppercase" <?php if ( $cvmn_page_heading_text_transform === 'uppercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Uppercase', 'maintenance-notice' ); ?></option>
                                <option value="lowercase" <?php if ( $cvmn_page_heading_text_transform === 'lowercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Lowercase', 'maintenance-notice' ); ?></option>
                                <option value="capitalize" <?php if ( $cvmn_page_heading_text_transform === 'capitalize' ) { echo 'selected'; } ?>><?php esc_html_e( 'Capitalize', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_heading_text_decoration"><?php esc_html_e( 'Text Decoration', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_heading_text_decoration">
                                <option value="none" <?php if ( $cvmn_page_heading_text_decoration === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="underline" <?php if ( $cvmn_page_heading_text_decoration === 'underline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Underline', 'maintenance-notice' ); ?></option>
                                <option value="overline" <?php if ( $cvmn_page_heading_text_decoration === 'overline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Overline', 'maintenance-notice' ); ?></option>
                                <option value="line-through" <?php if ( $cvmn_page_heading_text_decoration === 'line-through' ) { echo 'selected'; } ?>><?php esc_html_e( 'Line through', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field cvmn-admin-range-field">
                            <label for="cvmn_page_heading_font_size"><?php esc_html_e( 'Font Size', 'maintenance-notice' ); ?></label>
                            <input type="range" name="cvmn_page_heading_font_size" value="<?php echo esc_attr( $cvmn_page_heading_font_size ); ?>" min="2" max="100">
                            <span class="range-value"><?php echo esc_attr( $cvmn_page_heading_font_size . 'px' ); ?></span>
                        </div>
                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_heading_font_color"><?php esc_html_e( 'Font Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_page_heading_font_color ); ?>" name="cvmn_page_heading_font_color" class="cvmn-admin-color-field"/>
                        </div>

                    </div><!-- .typography-row-content -->
                </div><!-- .cvmn-typography-row -->
                <!-- Page Heading Typo End -->

                <!-- Page Description Typo -->
                <div class="cvmn-typography-row">
                    <div class="cvmn-admin-single-field typography-heading">
                        <div class="cvmn-admin-field-heading">
                            <?php esc_html_e( "Page Description", 'maintenance-notice' ); ?>
                            <span class="row-toggle dashicons dashicons-arrow-down"></span>
                        </div>
                    </div>
                    <div class="typography-row-content" style="display:none">
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-field">
                            <label for="cvmn_page_description_font_family"><?php esc_html_e( 'Font Family', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_description_font_family" class="cvmn-select-field">
                                <?php
                                    foreach( $google_fonts as $key => $values ) {
                                        foreach( $values as $valueskey => $value ) {
                                            $selected = ( $cvmn_page_description_font_family === $valueskey ) ? 'selected' : '';
                                            echo '<option value="' .esc_attr( $valueskey ). '" ' .esc_html( $selected ). '>' .esc_attr( $valueskey ). '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-variant-field">
                            <label for="cvmn_page_description_font_family_variant"><?php esc_html_e( 'Variant', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_description_font_family_variant">
                                <?php
                                $variants = get_font_variant( $google_fonts, $cvmn_page_description_font_family );
                                    foreach( $variants as $variant ) {
                                        $variant_selected = ( $cvmn_page_description_font_family_variant === $variant ) ? 'selected' : '';
                                        echo '<option value="' .esc_attr( $variant ). '" ' .esc_html( $variant_selected ). '>' .esc_attr( $variant ). '</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_description_text_transform"><?php esc_html_e( 'Text Transform', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_description_text_transform">
                                <option value="none" <?php if ( $cvmn_page_description_text_transform === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="uppercase" <?php if ( $cvmn_page_description_text_transform === 'uppercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Uppercase', 'maintenance-notice' ); ?></option>
                                <option value="lowercase" <?php if ( $cvmn_page_description_text_transform === 'lowercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Lowercase', 'maintenance-notice' ); ?></option>
                                <option value="capitalize" <?php if ( $cvmn_page_description_text_transform === 'capitalize' ) { echo 'selected'; } ?>><?php esc_html_e( 'Capitalize', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_description_text_decoration"><?php esc_html_e( 'Text Decoration', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_description_text_decoration">
                                <option value="none" <?php if ( $cvmn_page_description_text_decoration === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="underline" <?php if ( $cvmn_page_description_text_decoration === 'underline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Underline', 'maintenance-notice' ); ?></option>
                                <option value="overline" <?php if ( $cvmn_page_description_text_decoration === 'overline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Overline', 'maintenance-notice' ); ?></option>
                                <option value="line-through" <?php if ( $cvmn_page_description_text_decoration === 'line-through' ) { echo 'selected'; } ?>><?php esc_html_e( 'Line through', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field cvmn-admin-range-field">
                            <label for="cvmn_page_description_font_size"><?php esc_html_e( 'Font Size', 'maintenance-notice' ); ?></label>
                            <input type="range" name="cvmn_page_description_font_size" value="<?php echo esc_attr( $cvmn_page_description_font_size ); ?>" min="2" max="100">
                            <span class="range-value"><?php echo esc_attr( $cvmn_page_description_font_size . 'px' ); ?></span>
                        </div>
                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_description_font_color"><?php esc_html_e( 'Font Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_page_description_font_color ); ?>" name="cvmn_page_description_font_color" class="cvmn-admin-color-field"/>
                        </div>

                    </div><!-- .typography-row-content -->
                </div><!-- .cvmn-typography-row -->
                <!-- Page Description Typo End -->

                <!-- Page Countdown Typo -->
                <div class="cvmn-typography-row">
                    <div class="cvmn-admin-single-field typography-heading">
                        <div class="cvmn-admin-field-heading">
                            <?php esc_html_e( "Countdown ", 'maintenance-notice' ); ?>
                            <span class="row-toggle dashicons dashicons-arrow-down"></span>
                        </div>
                    </div>
                    <div class="typography-row-content" style="display:none">
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-field">
                            <label for="cvmn_page_countdown_font_family"><?php esc_html_e( 'Font Family', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_countdown_font_family" class="cvmn-select-field">
                                <?php
                                    foreach( $google_fonts as $key => $values ) {
                                        foreach( $values as $valueskey => $value ) {
                                            $selected = ( $cvmn_page_countdown_font_family === $valueskey ) ? 'selected' : '';
                                            echo '<option value="' .esc_attr( $valueskey ). '" ' .esc_html( $selected ). '>' .esc_attr( $valueskey ). '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-variant-field">
                            <label for="cvmn_page_countdown_font_family_variant"><?php esc_html_e( 'Variant', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_countdown_font_family_variant">
                                <?php
                                $variants = get_font_variant( $google_fonts, $cvmn_page_countdown_font_family );
                                    foreach( $variants as $variant ) {
                                        $variant_selected = ( $cvmn_page_countdown_font_family_variant === $variant ) ? 'selected' : '';
                                        echo '<option value="' .esc_attr( $variant ). '" ' .esc_html( $variant_selected ). '>' .esc_attr( $variant ). '</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_countdown_text_transform"><?php esc_html_e( 'Text Transform', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_countdown_text_transform">
                                <option value="none" <?php if ( $cvmn_page_countdown_text_transform === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="uppercase" <?php if ( $cvmn_page_countdown_text_transform === 'uppercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Uppercase', 'maintenance-notice' ); ?></option>
                                <option value="lowercase" <?php if ( $cvmn_page_countdown_text_transform === 'lowercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Lowercase', 'maintenance-notice' ); ?></option>
                                <option value="capitalize" <?php if ( $cvmn_page_countdown_text_transform === 'capitalize' ) { echo 'selected'; } ?>><?php esc_html_e( 'Capitalize', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_countdown_text_decoration"><?php esc_html_e( 'Text Decoration', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_page_countdown_text_decoration">
                                <option value="none" <?php if ( $cvmn_page_countdown_text_decoration === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="underline" <?php if ( $cvmn_page_countdown_text_decoration === 'underline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Underline', 'maintenance-notice' ); ?></option>
                                <option value="overline" <?php if ( $cvmn_page_countdown_text_decoration === 'overline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Overline', 'maintenance-notice' ); ?></option>
                                <option value="line-through" <?php if ( $cvmn_page_countdown_text_decoration === 'line-through' ) { echo 'selected'; } ?>><?php esc_html_e( 'Line through', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field cvmn-admin-range-field">
                            <label for="cvmn_page_countdown_font_size"><?php esc_html_e( 'Font Size', 'maintenance-notice' ); ?></label>
                            <input type="range" name="cvmn_page_countdown_font_size" value="<?php echo esc_attr( $cvmn_page_countdown_font_size ); ?>" min="2" max="100">
                            <span class="range-value"><?php echo esc_attr( $cvmn_page_countdown_font_size . 'px' ); ?></span>
                        </div>
                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_page_countdown_font_color"><?php esc_html_e( 'Font Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_page_countdown_font_color ); ?>" name="cvmn_page_countdown_font_color" class="cvmn-admin-color-field"/>
                        </div>

                    </div><!-- .typography-row-content -->
                </div><!-- .cvmn-typography-row -->
                <!-- Page Countdown Typo End -->

                <!-- Page Button One Typo -->
                <div class="cvmn-typography-row">
                    <div class="cvmn-admin-single-field typography-heading">
                        <div class="cvmn-admin-field-heading">
                            <?php esc_html_e( "Button One", 'maintenance-notice' ); ?>
                            <span class="row-toggle dashicons dashicons-arrow-down"></span>
                        </div>
                    </div>
                    <div class="typography-row-content" style="display:none">
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-field">
                            <label for="cvmn_button_one_font_family"><?php esc_html_e( 'Font Family', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_button_one_font_family" class="cvmn-select-field">
                                <?php
                                    foreach( $google_fonts as $key => $values ) {
                                        foreach( $values as $valueskey => $value ) {
                                            $selected = ( $cvmn_button_one_font_family === $valueskey ) ? 'selected' : '';
                                            echo '<option value="' .esc_attr( $valueskey ). '" ' .esc_html( $selected ). '>' .esc_attr( $valueskey ). '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="cvmn-admin-single-field cvmn-admin-font-family-variant-field">
                            <label for="cvmn_button_one_font_family_variant"><?php esc_html_e( 'Variant', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_button_one_font_family_variant">
                                <?php
                                $variants = get_font_variant( $google_fonts, $cvmn_button_one_font_family );
                                    foreach( $variants as $variant ) {
                                        $variant_selected = ( $cvmn_button_one_font_family_variant === $variant ) ? 'selected' : '';
                                        echo '<option value="' .esc_attr( $variant ). '" ' .esc_html( $variant_selected ). '>' .esc_attr( $variant ). '</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_button_one_text_transform"><?php esc_html_e( 'Text Transform', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_button_one_text_transform">
                                <option value="none" <?php if ( $cvmn_button_one_text_transform === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="uppercase" <?php if ( $cvmn_button_one_text_transform === 'uppercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Uppercase', 'maintenance-notice' ); ?></option>
                                <option value="lowercase" <?php if ( $cvmn_button_one_text_transform === 'lowercase' ) { echo 'selected'; } ?>><?php esc_html_e( 'Lowercase', 'maintenance-notice' ); ?></option>
                                <option value="capitalize" <?php if ( $cvmn_button_one_text_transform === 'capitalize' ) { echo 'selected'; } ?>><?php esc_html_e( 'Capitalize', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_button_one_text_decoration"><?php esc_html_e( 'Text Decoration', 'maintenance-notice' ); ?></label>
                            <select name="cvmn_button_one_text_decoration">
                                <option value="none" <?php if ( $cvmn_button_one_text_decoration === 'none' ) { echo 'selected'; } ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                                <option value="underline" <?php if ( $cvmn_button_one_text_decoration === 'underline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Underline', 'maintenance-notice' ); ?></option>
                                <option value="overline" <?php if ( $cvmn_button_one_text_decoration === 'overline' ) { echo 'selected'; } ?>><?php esc_html_e( 'Overline', 'maintenance-notice' ); ?></option>
                                <option value="line-through" <?php if ( $cvmn_button_one_text_decoration === 'line-through' ) { echo 'selected'; } ?>><?php esc_html_e( 'Line through', 'maintenance-notice' ); ?></option>
                            </select>
                        </div>

                        <div class="cvmn-admin-single-field cvmn-admin-range-field">
                            <label for="cvmn_button_one_font_size"><?php esc_html_e( 'Font Size', 'maintenance-notice' ); ?></label>
                            <input type="range" name="cvmn_button_one_font_size" value="<?php echo esc_attr( $cvmn_button_one_font_size ); ?>" min="2" max="100">
                            <span class="range-value"><?php echo esc_attr( $cvmn_button_one_font_size . 'px' ); ?></span>
                        </div>
                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_button_one_font_color"><?php esc_html_e( 'Font Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_button_one_font_color ); ?>" name="cvmn_button_one_font_color" class="cvmn-admin-color-field"/>
                        </div>
                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_button_one_bg_color"><?php esc_html_e( 'Background Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_button_one_bg_color ); ?>" name="cvmn_button_one_bg_color" class="cvmn-admin-color-field"/>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_button_one_border_color"><?php esc_html_e( 'Border Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_button_one_border_color ); ?>" name="cvmn_button_one_border_color" class="cvmn-admin-color-field"/>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_button_one_hover_text_color"><?php esc_html_e( 'Hover Text Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_button_one_hover_text_color ); ?>" name="cvmn_button_one_hover_text_color" class="cvmn-admin-color-field"/>
                        </div>

                        <div class="cvmn-admin-single-field">
                            <label for="cvmn_button_one_hover_bg_color"><?php esc_html_e( 'Hover Background Color', 'maintenance-notice' ); ?></label>
                            <input type="text" value="<?php echo esc_attr( $cvmn_button_one_hover_bg_color ); ?>" name="cvmn_button_one_hover_bg_color" class="cvmn-admin-color-field"/>
                        </div>

                    </div><!-- .typography-row-content -->
                </div><!-- .cvmn-typography-row -->
                <!-- Page Button One Typo End -->

                <div class="cvmn-form-button-wrapper">
                    <div class="cvmn-form-button">
                        <input type="submit" name="cvmn_submit" class="button button-primary" data-saving="<?php esc_html_e( 'Saving..', 'maintenance-notice' ); ?>" data-saved="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" data-save="<?php esc_html_e( 'Save Changes', 'maintenance-notice' ); ?>" value="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" disabled="disabled">
                    </div>
                </div>
                
            </div><!-- .cvmn-admin-field-options-wrapper -->
        </form>
    </div><!-- .cvmn-admin-content -->
</div><!-- .cvmn-dashboard -->