<?php
/**
 * Content for countdown settings section in admin area.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( isset( $_POST['cvmn_submit'] ) ) {
    $maintenance_notice_options = get_option( 'maintenance_notice_options' );
    $cvmn_form_values = array(
        'cvmn_countdown_display'                => sanitize_text_field( $_POST['cvmn_countdown_display'] ),
        'cvmn_countdown_end_date'               => sanitize_text_field( $_POST['cvmn_countdown_end_date'] ),
        'cvmn_countdown_end_time'               => sanitize_text_field( $_POST['cvmn_countdown_end_time'] ),
        'cvmn_countdown_end_popup_content'      => wp_kses_post( $_POST['cvmn_countdown_end_popup_content'] )
    );
    update_option( 'maintenance_notice_options', wp_parse_args( $cvmn_form_values, $maintenance_notice_options ) );
}

$maintenance_notice_options = get_option( 'maintenance_notice_options' );
$allowed_tags = wp_kses_allowed_html('post');
// check if value set or not
$cvmn_countdown_display = isset( $maintenance_notice_options['cvmn_countdown_display'] ) ? esc_html( $maintenance_notice_options['cvmn_countdown_display'] ) : 'show';
$cvmn_countdown_end_date = isset( $maintenance_notice_options['cvmn_countdown_end_date'] ) ? esc_html( $maintenance_notice_options['cvmn_countdown_end_date'] ) : '';
$cvmn_countdown_end_time = isset( $maintenance_notice_options['cvmn_countdown_end_time'] ) ? esc_html( $maintenance_notice_options['cvmn_countdown_end_time'] ) : '12:00';
$cvmn_countdown_end_popup_content = isset( $maintenance_notice_options['cvmn_countdown_end_popup_content'] ) ? wp_kses( stripslashes( $maintenance_notice_options['cvmn_countdown_end_popup_content'] ), $allowed_tags ) : '';
?>
<div id="cvmn-countdown-settings" class="cvmn-content-block-wrapper">
    <div class="cvmn-admin-content">
        <form id="cvmn-maintenance-notice-options-form" method="POST">
            <div class="cvmn-admin-field-options-wrapper">

                <!--------------------- Countdown control fields ------------------------>
                <div class="cvmn-admin-single-field">
                    <div class="cvmn-admin-field-heading">
                        <?php esc_html_e( "Countdown clock Settings", 'maintenance-notice' ); ?>
                        </span>
                    </div>
                    <div class="cvmn-admin-single-field cvmn-admin-toggle-field">
                        <label for="cvmn_countdown_display"><?php esc_html_e( 'Show countdown clock', 'maintenance-notice' ); ?></label>
                        <input type="hidden" value="<?php echo esc_attr( $cvmn_countdown_display ); ?>" name="cvmn_countdown_display"/>
                        <span class="cvmn-switch <?php if ( $cvmn_countdown_display === 'show' ) echo 'active'; ?>"></span>
                    </div>
                    <div class="cvmn-admin-single-field" data-control="cvmn_countdown_display" data-value="show"  >
                        <label for="cvmn_countdown_end_date"><?php esc_html_e( 'Set Countdown date upto', 'maintenance-notice' ); ?></label>
                        <input type="date" value="<?php echo esc_attr( $cvmn_countdown_end_date ); ?>" name="cvmn_countdown_end_date"/>
                    </div>
                    <div class="cvmn-admin-single-field" data-control="cvmn_countdown_display" data-value="show">
                        <label for="cvmn_countdown_end_time"><?php esc_html_e( 'Set Countdown time upto', 'maintenance-notice' ); ?></label>
                        <input type="time" value="<?php echo esc_attr( $cvmn_countdown_end_time ); ?>" name="cvmn_countdown_end_time"/>
                    </div>
                    <div class="cvmn-admin-single-field" data-control="cvmn_countdown_display" data-value="show">
                        <label for="cvmn_countdown_end_popup_content"><?php esc_html_e( 'Popup Content ( This content will popup after countdown time ends )', 'maintenance-notice' ); ?></label>
                        <?php
                            wp_editor( $cvmn_countdown_end_popup_content, 'cvmn_countdown_end_popup_content', array(
                                'teeny'         => 1,
                                'textarea_rows' => 5,
                                'media_buttons' => 0,
                                'tinymce'       => true
                            ));
                        ?>
                    </div>
                </div>
                <!--------------------- Countdown control fields Ends ------------------------>
                <div class="cvmn-form-button-wrapper">
                    <div class="cvmn-form-button">
                        <input type="submit" name="cvmn_submit" class="button button-primary" data-saving="<?php esc_html_e( 'Saving..', 'maintenance-notice' ); ?>" data-saved="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" data-save="<?php esc_html_e( 'Save Changes', 'maintenance-notice' ); ?>" value="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" disabled="disabled">
                    </div>
                </div>
            </div><!-- .cvmn-admin-field-options-wrapper -->
        </form>
    </div><!-- .cvmn-admin-content -->
</div><!-- .cvmn-countdown-settings -->