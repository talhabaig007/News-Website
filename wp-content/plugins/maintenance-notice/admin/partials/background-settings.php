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
        'cvmn_maintenance_page_background_type' => sanitize_text_field( $_POST['cvmn_maintenance_page_background_type'] ),
        'cvmn_background_color'         => sanitize_hex_color( $_POST['cvmn_background_color'] ),
        'cvmn_background_image'         => esc_url_raw( $_POST['cvmn_background_image'] ),
        'cvmn_background_video_url'     => esc_url_raw( $_POST['cvmn_background_video_url'] ),
        'cvmn_background_overlay_type'  => sanitize_text_field( $_POST['cvmn_background_overlay_type'] ),
        'cvmn_background_overlay_opacity'  => sanitize_text_field( $_POST['cvmn_background_overlay_opacity'] )
    );
    update_option( 'maintenance_notice_options', wp_parse_args( $cvmn_form_values, $maintenance_notice_options ) );
}

$maintenance_notice_options = get_option( 'maintenance_notice_options' );
// check if value set or not
$cvmn_maintenance_page_background_type = isset( $maintenance_notice_options['cvmn_maintenance_page_background_type'] ) ? esc_html( $maintenance_notice_options['cvmn_maintenance_page_background_type'] ) : 'none';
$cvmn_background_color = isset( $maintenance_notice_options['cvmn_background_color'] ) ? esc_html( $maintenance_notice_options['cvmn_background_color'] ) : '#000000';
$cvmn_background_image = isset( $maintenance_notice_options['cvmn_background_image'] ) ? esc_url( $maintenance_notice_options['cvmn_background_image'] ) : '';
$cvmn_background_video_url = isset( $maintenance_notice_options['cvmn_background_video_url'] ) ? esc_url( $maintenance_notice_options['cvmn_background_video_url'] ) : '';
$cvmn_background_overlay_type = isset( $maintenance_notice_options['cvmn_background_overlay_type'] ) ? esc_html( $maintenance_notice_options['cvmn_background_overlay_type'] ) : 'none';
$cvmn_background_overlay_opacity = isset( $maintenance_notice_options['cvmn_background_overlay_opacity'] ) ? esc_html( $maintenance_notice_options['cvmn_background_overlay_opacity'] ) : '0.5';
$cvmn_slide_settings_infinite_loop = isset( $maintenance_notice_options['cvmn_slide_settings_infinite_loop'] ) ? esc_html( $maintenance_notice_options['cvmn_slide_settings_infinite_loop'] ) : 'show';
$cvmn_slide_settings_auto = isset( $maintenance_notice_options['cvmn_slide_settings_auto'] ) ? esc_html( $maintenance_notice_options['cvmn_slide_settings_auto'] ) : 'show';
$cvmn_slide_settings_speed = isset( $maintenance_notice_options['cvmn_slide_settings_speed'] ) ? absint( $maintenance_notice_options['cvmn_slide_settings_speed'] ) : 3000;
$cvmn_slide_settings_pause = isset( $maintenance_notice_options['cvmn_slide_settings_pause'] ) ? absint( $maintenance_notice_options['cvmn_slide_settings_pause'] ) : 8000;
?>
<div id="cvmn-background-settings" class="cvmn-content-block-wrapper">
    <div class="cvmn-admin-content">
        <form id="cvmn-maintenance-notice-options-form" method="POST">
            <div class="cvmn-admin-field-options-wrapper">
                <div class="cvmn-admin-single-field">
                    <label for="cvmn_maintenance_page_background_type"><?php esc_html_e( 'Background Type', 'maintenance-notice' ); ?></label>
                    <p class="cvmn-admin-description"><?php esc_html_e( 'Background appears as a full page wrapper behind the content', 'maintenance-notice' ); ?></p>
                    <select name="cvmn_maintenance_page_background_type">
                        <option value="none" <?php if ( $cvmn_maintenance_page_background_type === 'none' ) echo 'selected'; ?>><?php esc_html_e( 'None', 'maintenance-notice' ); ?></option>
                        <option value="plain-color" <?php if ( $cvmn_maintenance_page_background_type === 'plain-color' ) echo 'selected'; ?>><?php esc_html_e( 'Color Background', 'maintenance-notice' ); ?></option>
                        <option value="static-image" <?php if ( $cvmn_maintenance_page_background_type === 'static-image' ) echo 'selected'; ?>><?php esc_html_e( 'Static Image Background', 'maintenance-notice' ); ?></option>
                        <option value="video-background" <?php if ( $cvmn_maintenance_page_background_type === 'video-background' ) echo 'selected'; ?>><?php esc_html_e( 'Video Background', 'maintenance-notice' ); ?></option>
                    </select>
                </div><!-- .cvmn-admin-single-field -->

               <div class="cvmn-admin-single-field" data-control="cvmn_maintenance_page_background_type" data-value="plain-color" <?php if ( $cvmn_maintenance_page_background_type !== 'plain-color' ) echo 'style="display:none"'; ?>>
                    <label for="cvmn_background_color"><?php esc_html_e( 'Background Color', 'maintenance-notice' ); ?></label>
                    <input type="text" value="<?php echo esc_attr( $cvmn_background_color ); ?>" name="cvmn_background_color" class="cvmn-admin-color-field"/>
                </div>

                <div class="cvmn-admin-single-field cvmn-meta-upload-field" data-control="cvmn_maintenance_page_background_type" data-value="static-image" <?php if ( $cvmn_maintenance_page_background_type !== 'static-image' ) echo 'style="display:none"'; ?>>
                    <label for="cvmn_background_image"><?php esc_html_e( 'Background Image', 'maintenance-notice'); ?></label>
                    <div class="placeholder <?php if ( ! empty( $cvmn_background_image ) ) { echo 'hidden'; } ?>"><?php esc_html_e( 'No image selected', 'maintenance-notice' ); ?></div>
                    <div class="cvmn-thumbnail bg-thumbnail">
                        <?php if ( ! empty( $cvmn_background_image ) ) { ?>
                            <img src="<?php echo esc_url( $cvmn_background_image ); ?>" style="width:60px;"/>
                        <?php } ?>
                    </div><!-- .cvmn-thumbnail -->
                    <input id="cvmn_background_image" name="cvmn_background_image" type="hidden" value="<?php echo esc_url( $cvmn_background_image );?>"/>
                    <div class="cvmn-buttons-wrapper">
                        <button id="cvmn-media-upload-btn" class="button"><?php esc_html_e( 'Upload Image', 'maintenance-notice' ); ?></button>
                        <button id="cvmn-media-remove-btn" class="button"><?php esc_html_e( 'Remove Image', 'maintenance-notice' ); ?></button>
                    </div><!-- .cvmn-buttons-wrapper -->
                </div>

                <div class="cvmn-admin-single-field" data-control="cvmn_maintenance_page_background_type" data-value="video-background" <?php if ( $cvmn_maintenance_page_background_type !== 'video-background' ) echo 'style="display:none"'; ?>>
                    <label for="cvmn_background_video_url"><?php esc_html_e( 'Background Video Url', 'maintenance-notice'); ?></label>
                    <p class="cvmn-admin-description"><?php esc_html_e( 'Plays as the background video', 'maintenance-notice' ); ?></p>
                    <input id="cvmn_background_video_url" name="cvmn_background_video_url" placeholder="<?php echo esc_url( 'https://www.youtube.com/watch?v=kPXMBBSqRJw' ); ?>" type="url" value="<?php echo esc_url( $cvmn_background_video_url );?>"/>
                </div>

                <div class="cvmn-admin-single-field cvmn-radio-image-field">
                    <label for="cvmn_background_overlay_type"><?php esc_html_e( 'Background Overlay Type', 'maintenance-notice' ); ?></label>
                    <input type="hidden" name="cvmn_background_overlay_type" value="<?php echo esc_html( $cvmn_background_overlay_type ); ?>"/>
                    <span class="image-selector <?php if ( $cvmn_background_overlay_type === 'none' ) echo 'isActive'; ?>" data-value="none"><img src="<?php echo MAINTENANCE_NOTICE_ADMIN_URL . '/assets/images/background-overlay-none.png' ?>" alt=""/></span>
                    <span class="image-selector <?php if ( $cvmn_background_overlay_type === 'type-one' ) echo 'isActive'; ?>" data-value="type-one"><img src="<?php echo MAINTENANCE_NOTICE_ADMIN_URL . '/assets/images/background-overlay-one.png' ?>" alt=""/></span>
                    <span class="image-selector <?php if ( $cvmn_background_overlay_type === 'type-two' ) echo 'isActive'; ?>" data-value="type-two"><img src="<?php echo MAINTENANCE_NOTICE_ADMIN_URL . '/assets/images/background-overlay-two.png' ?>" alt=""/></span>
                    <span class="image-selector <?php if ( $cvmn_background_overlay_type === 'type-three' ) echo 'isActive'; ?>" data-value="type-three"><img src="<?php echo MAINTENANCE_NOTICE_ADMIN_URL . '/assets/images/background-overlay-three.png' ?>" alt=""/></span>
                    <span class="image-selector <?php if ( $cvmn_background_overlay_type === 'type-four' ) echo 'isActive'; ?>" data-value="type-four"><img src="<?php echo MAINTENANCE_NOTICE_ADMIN_URL . '/assets/images/background-overlay-four.png' ?>" alt=""/></span>
                </div><!-- .cvmn-radio-image-field -->

                <div class="cvmn-admin-single-field">
                    <label for="cvmn_background_overlay_opacity"><?php esc_html_e( 'Overlay Opcacity', 'maintenance-notice' ); ?></label>
                    <input type="number" value="<?php echo esc_attr( $cvmn_background_overlay_opacity ); ?>" name="cvmn_background_overlay_opacity" step="0.1" min="0.5" max="3"/>
                </div><!-- .cvmn-admin-single-field -->

                <div class="cvmn-form-button-wrapper">
                    <div class="cvmn-form-button">
                        <input type="submit" name="cvmn_submit" class="button button-primary" data-saving="<?php esc_html_e( 'Saving..', 'maintenance-notice' ); ?>" data-saved="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" data-save="<?php esc_html_e( 'Save Changes', 'maintenance-notice' ); ?>" value="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" disabled="disabled">
                    </div>
                </div>
                
            </div><!-- .cvmn-admin-field-options-wrapper -->
        </form>
    </div><!-- .cvmn-admin-content -->
</div><!-- .cvmn-dashboard -->