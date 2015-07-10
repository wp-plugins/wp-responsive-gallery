jQuery(document).ready(function($) {

            // WP Media Uploader
        var z_popup_uploader;
         
        jQuery('.upload_image_button').live('click', function( event ){
         
            event.preventDefault();

            // Create the media frame.
            z_popup_uploader = wp.media.frames.z_popup_uploader = wp.media({
              title: 'Pr Responsive Gallery',
              button: {
                text: 'Insert it',
              },
              multiple: true  // Set to true to allow multiple files to be selected
            });
         
            // When an image is selected, run a callback.
            z_popup_uploader.on( 'select', function() {
              // We set multiple to false so only get one image from the uploader
              attachment = z_popup_uploader.state().get('selection').first().toJSON();
                jQuery('.append-images').append('<div class="img-pup"><span class="dashicons dashicons-no-alt"></span><img class="img-thumbnail " src="'+attachment.url+'" ></div>');
            });
         
            // Finally, open the modal
            z_popup_uploader.open();
        });

     jQuery('body').on('click', '.save-settings', function(event) {
        event.preventDefault();
        var images = [];
        jQuery('.append-images div').each(function(index) {
            images[index] = jQuery(this).find('img').attr('src');
        });
        
        var data = {
            action: 'saving_gallery_images',
            images: images,
        }
        console.log(data);

        jQuery.post(urls.ajax, data, function(resp) {
           alert('Saved!');
        });
});
     ///Delet Images
     $(".dashicons").click(function() {
       $(this).closest('.append-images div').remove();
     });
});
