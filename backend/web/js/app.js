

$( document ).ready(function() {
    'use strict';

    $(function () {
        
        $('#videoFile').change(ev => {      
            $(ev.target).closest('form').trigger('submit');
        })
    });
});




