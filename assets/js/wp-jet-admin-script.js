// The "Upload" button
jQuery(document).on('click', '.wp-jet-upload-image-button', function() {
    var button = jQuery(this);

    var frametitle = button.data('frametitle');
    var framebutton = button.data('framebutton');
    var frametypes = button.data('frametypes');

    wp_jet_media_frame = wp.media.frames.items = wp.media({
        title: frametitle,
        frame: 'select',
        button: {
            text: framebutton
        },
        library: {
                type: frametypes
        },
    });

    wp_jet_media_frame.on( 'select', function() {
        var attachment = wp_jet_media_frame.state().get('selection').first().toJSON();
        if ( jQuery(button).data('type') == 'img' ) {
            var attachmentUrl = attachment.sizes.thumbnail.url != undefined ? attachment.sizes.thumbnail.url : attachment.url
            jQuery(button).parent().prev().attr('src', attachment.url);
        }
        else {
            jQuery(button).parent().prev().val( attachment.url );
        }
        jQuery(button).prev().val(attachment.id);
    });

    wp_jet_media_frame.open(button);
    return false;
});

// The "Remove" button (remove the value from input type='hidden')
jQuery(document).on('click', '.wp-jet-remove-image-button', function() {
    var answer = confirm('Are you sure?');
    if (answer == true) {
        var src = jQuery(this).parent().prev().attr('data-src');
        jQuery(this).parent().prev().attr('src', src);
        jQuery(this).prev().prev().val('');
    }
    return false;
});

jQuery(document).on('click', '.wp-jet-add-quality', function() {
    var parentRow = jQuery(this).closest('tr');
    parentRow.clone().insertAfter(parentRow).find('input').val('');
    return false;
});

jQuery(document).on('click', '.wp-jet-remove-quality', function() {
    var answer = confirm('Are you sure?');
    if (answer == true) {
        jQuery(this).closest('tr').remove();
    }
    return false;
});

var skinRadioEle =  'input[type="radio"][name="wp-jet-skin[loading][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[state][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[play][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[pause][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[volume][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[volumeClose][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[subtitle][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[screenshot][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[setting][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[fullscreen][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[fullscreenWeb][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[pip][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[prev][type]"]';
skinRadioEle     += ', input[type="radio"][name="wp-jet-skin[next][type]"]';


jQuery(document).on('change', skinRadioEle, function() {
    if ( jQuery(this).val() == 'default' ) {
        jQuery(this).closest('tr').find('input[type="text"]').attr('readonly', true);
    }
    else {
        jQuery(this).closest('tr').find('input[type="text"]').removeAttr('readonly');
    }
});

jQuery('input.wp-jet-video-shortcode').click( function() {
    jQuery(this).select();
});

jQuery('input.wp-jet-video-shortcode-btn').click( function() {
    var dataEle = jQuery(this).closest("td").find('input.wp-jet-video-shortcode');
    dataEle.select();
    document.execCommand("copy");
    var msgEle = jQuery(this).closest("td").find('.wp-jet-msg-copy');
    msgEle.html('Copied: '+dataEle.val()).show();
    setTimeout( function(){ 
        msgEle.hide(); 
    }, 3000);
});