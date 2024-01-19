/**
 * Admin scripts for listed widgets in the theme.
 *
 * @package Azure News
 */

/**
 * Image upload functions
 */
var ogSelector, frame;
function upload_media_image(ogSelector){
    // ADD IMAGE LINK
    jQuery('body').on( 'click', ogSelector , function( event ){
        event.preventDefault();

        var imgContainer    = jQuery(this).closest('.attachment-media-view').find('.thumbnail-image'),
            placeholder     = jQuery(this).closest('.attachment-media-view').find('.placeholder'),
            imgIdInput      = jQuery(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
            text: 'Use Image'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {

        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        // Send the attachment URL to our custom image input field.
        imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
        placeholder.addClass('hidden');
        imgIdInput.val( attachment.url ).trigger('change');
        });

        // Finally, open the modal on click
        frame.open();
    
    });
}

function delete_media_image(ogSelector){
    // DELETE IMAGE LINK
    jQuery('body').on( 'click', ogSelector, function( event ){

        event.preventDefault();
        var imgContainer    = jQuery(this).closest('.attachment-media-view').find('.thumbnail-image'),
            placeholder     = jQuery(this).closest('.attachment-media-view').find('.placeholder'),
            imgIdInput      = jQuery(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val( '' ).trigger('change');

    });
}

jQuery(document).ready(function($){
    "use strict";

    /**
     * Image upload at widget
     */
    upload_media_image('.cv-upload-button');
    delete_media_image('.cv-delete-button');

});