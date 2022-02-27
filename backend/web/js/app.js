

jQuery( document ).ready(function() {
    'use strict';

    jQuery(function () {
        
        jQuery('#videoFile').change(ev => {      
            jQuery(ev.target).closest('form').trigger('submit');
        })
    });
});




