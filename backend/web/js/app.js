'use strict';

$(document).ready(function(){

    $(function () {
    
        $('#videoFile').change(ev => {
            // ev.preventDefault();
    
            // alert('change');
    
            $(ev.target).closest('form').trigger('submit');
    
        })
    
    });
});


