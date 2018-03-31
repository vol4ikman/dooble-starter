jQuery(document).ready(function(){
    
    // accessible contact form 7 focus validation
    // list of contact form 7 DOM events: https://contactform7.com/dom-events/
    var cf7_form = jQuery( '.wpcf7' );
    cf7_form.on('wpcf7invalid ', function(event){
        jQuery(this).find('.wpcf7-not-valid').first().focus();
    });
    
});
