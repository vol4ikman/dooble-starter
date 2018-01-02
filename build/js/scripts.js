jQuery(document).ready(function(){
    
});

// Detailed list of CF7 events - https://contactform7.com/dom-events/

// Handle contact form 7 "On sent OK" event
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( "4" == event.detail.contactFormId ) {
        alert( "The contact form ID is 4" );
        // do something productive
    }
}, false );
// Handle contact form 7 "Submit" event
document.addEventListener( 'wpcf7submit', function( event ) {
    if ( '123' == event.detail.contactFormId ) {
        alert( "The contact form ID is 123." );
        // do something productive
    }
}, false );
