<?php
/**
 * Content for content settings section in admin area.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( isset( $_POST['cvmn_submit'] ) ) {
    $maintenance_notice_options = get_option( 'maintenance_notice_options' );
    $cvmn_form_values = array(
        'cvmn_page_title'                           => sanitize_text_field( $_POST['cvmn_page_title'] ),
        'cvmn_page_heading'                         => sanitize_text_field( $_POST['cvmn_page_heading'] ),
        'cvmn_page_description'                     => wp_kses_post( $_POST['cvmn_page_description'] ),
        'cvmn_logo'                                 => esc_url_raw( $_POST['cvmn_logo'] ),
        'cvmn_button_one_label'                     => sanitize_text_field( $_POST['cvmn_button_one_label'] ),
        'cvmn_button_one_link'                      => esc_url_raw( $_POST['cvmn_button_one_link'] )
    );
    update_option( 'maintenance_notice_options', wp_parse_args( $cvmn_form_values, $maintenance_notice_options ) );
}

$maintenance_notice_options = get_option( 'maintenance_notice_options' );
// check if value set or not
$allowed_tags = wp_kses_allowed_html('post');
$cvmn_maintenance_page_display = isset( $maintenance_notice_options['cvmn_maintenance_page_display'] ) ? esc_html( $maintenance_notice_options['cvmn_maintenance_page_display'] ) : 'hide';

$cvmn_page_title = isset( $maintenance_notice_options['cvmn_page_title'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title'] ) : get_bloginfo( 'name' );
$cvmn_page_heading = isset( $maintenance_notice_options['cvmn_page_heading'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading'] ) : '';
$cvmn_page_description = isset( $maintenance_notice_options['cvmn_page_description'] ) ? wp_kses( stripslashes( $maintenance_notice_options['cvmn_page_description'] ), $allowed_tags ) : '';
$cvmn_logo = isset( $maintenance_notice_options['cvmn_logo'] ) ? esc_url( $maintenance_notice_options['cvmn_logo'] ) : '';
$allowed_tags = wp_kses_allowed_html('post');
$cvmn_button_one_label = isset( $maintenance_notice_options['cvmn_button_one_label'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_label'] ) : esc_html__( 'Subscribe Us', 'maintenance-notice' );
$cvmn_button_one_link = isset( $maintenance_notice_options['cvmn_button_one_link'] ) ? esc_url( $maintenance_notice_options['cvmn_button_one_link'] ) : '';
?>
<div id="cvmn-content-settings" class="cvmn-content-block-wrapper">
    <?php
        esc_html_e( 'Manage your maintenance mode content', 'maintenance-notice' );
    ?>
    <div class="cvmn-admin-content">
        <form id="cvmn-maintenance-notice-options-form" method="POST">
            <div class="cvmn-admin-field-options-wrapper">
            <div class="cvmn-admin-single-field cvmn-meta-upload-field">
                    <label for="cvmn_logo"><?php esc_html_e( 'Logo', 'maintenance-notice'); ?></label>
                    <div class="placeholder <?php if ( ! empty( $cvmn_logo ) ) { echo 'hidden'; } ?>"><?php esc_html_e( 'No image selected', 'maintenance-notice' ); ?></div>
                    <div class="cvmn-thumbnail logo-thumbnail">
                        <?php if ( ! empty( $cvmn_logo ) ) { ?>
                            <img src="<?php echo esc_url( $cvmn_logo ); ?>" style="width:60px;"/>
                        <?php } ?>
                    </div><!-- .cvmn-thumbnail -->
                    <input id="cvmn_logo" name="cvmn_logo" type="hidden" value="<?php echo esc_url( $cvmn_logo );?>"/>
                    <div class="cvmn-buttons-wrapper">
                        <button id="cvmn-media-upload-btn" class="button"><?php esc_html_e( 'Upload Image', 'maintenance-notice' ); ?></button>
                        <button id="cvmn-media-remove-btn" class="button"><?php esc_html_e( 'Remove Image', 'maintenance-notice' ); ?></button>
                    </div><!-- .cvmn-buttons-wrapper -->
                </div>
                
                <div class="cvmn-admin-single-field">
                    <label for="cvmn_page_title"><?php esc_html_e( 'Page Title', 'maintenance-notice' ); ?></label>
                    <input type="text" value="<?php echo esc_attr( $cvmn_page_title ); ?>" name="cvmn_page_title"/>
                </div><!-- .cvmn-admin-single-field -->
                
                <div class="cvmn-admin-single-field">
                    <label for="cvmn_page_heading"><?php esc_html_e( 'Heading', 'maintenance-notice' ); ?></label>
                    <input type="text" value="<?php echo esc_attr( $cvmn_page_heading ); ?>" name="cvmn_page_heading"/>
                </div>
                <div class="cvmn-admin-single-field">
                    <label for="cvmn_page_description"><?php esc_html_e( 'Description', 'maintenance-notice' ); ?></label>
                    <?php
                        wp_editor( $cvmn_page_description, 'cvmn_page_description', array(
                            'teeny'         => 1,
                            'textarea_rows' => 5,
                            'media_buttons' => 0,
                            'tinymce'       => true
                        ));
                    ?>
                </div>

                <!--------------------- Button control fields ------------------------>
                <div class="cvmn-admin-single-field cvmn-button-input-field">
                    <label for="cvmn_button_one_label"><?php esc_html_e( 'Button One Label', 'maintenance-notice' ); ?></label>
                    <input type="text" value="<?php echo esc_attr( $cvmn_button_one_label ); ?>" name="cvmn_button_one_label"/>
                </div>
                <div class="cvmn-admin-single-field cvmn-button-input-field">
                    <label for="cvmn_button_one_link"><?php esc_html_e( 'Button One Url', 'maintenance-notice' ); ?></label>
                    <input type="url" value="<?php echo esc_url( $cvmn_button_one_link ); ?>" name="cvmn_button_one_link"/>
                </div>
                <!--------------------- Button control fields Ends ------------------------>

                <div class="cvmn-form-button-wrapper">
                    <div class="cvmn-form-button">
                        <input type="submit" name="cvmn_submit" class="button button-primary" data-saving="<?php esc_html_e( 'Saving..', 'maintenance-notice' ); ?>" data-saved="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" data-save="<?php esc_html_e( 'Save Changes', 'maintenance-notice' ); ?>" value="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" disabled="disabled">
                    </div>
                </div>

            </div><!-- .cvmn-admin-field-options-wrapper -->
        </form>
    </div><!-- .cvmn-admin-content -->
</div><!-- .cvmn-content-settings -->