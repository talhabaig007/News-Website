/**
 * Ajax for changing typography variants
 *
 * @package Azure News
 */
 
jQuery(document).ready(function($) {

    $(document).on('change', '.typography_face', function() {
        var font_family = $(this).val();
        var dis = $(this);
        $.ajax({
            url: ajaxurl,
            data: ({
                'action': 'get_google_font_variants',
                'font_family': font_family,
            }),
            success: function(response) {
                dis.parent('.typography-font-family').next('.typography-font-weight').children('select').html(response);
            }
        });
    });

});