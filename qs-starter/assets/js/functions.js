/**
 * Global variables
 */
var sliders = [];

/**************************
    Accessibility
**************************/
// main menu wrapper selector = wrap_main_menu
jQuery('.wrap_main_menu nav ul li.menu-item-has-children a').on('focusin',function(e){
    e.preventDefault();
    var this_el = jQuery(this);
    this_el.parent().addClass('hover');
});

jQuery('body').on('focusout','ul li.menu-item-has-children.hover ul li:last-child a', function(e){
    e.preventDefault();
    var this_el = jQuery(this);
    this_el.parent().parent().parent().removeClass('hover');
});
/*************************
    Slick slider
*************************/


/**
 * Walk through slick slider css selector and generate slick render_sliders
 *
 * @return {[type]} [description]
 */
function render_sliders(){

    if( typeof slick !='undefined' ){

        var slider = jQuery(".slick-slider").each( function(){

            var autoplay        = jQuery(this).data( "autoplay" );
            var dots            = jQuery(this).data( "dots" ) ? jQuery(this).data( "dots" ) : false;
            var arrows          = jQuery(this).data( "arrows" ) ? jQuery(this).data( "arrows" ) : true;
            var slidesToShow    = jQuery(this).data( "slidestoshow" ) ? jQuery(this).data( "slidestoshow" ) : 1;
            var slidesToScroll  = jQuery(this).data( "slidesToScroll" ) ? jQuery(this).data( "slidesToScroll" ) : 1;

            jQuery( this ).slick({
              slidesToShow: 3,
              arrows : arrows,
              slidesToScroll: 1,
              autoplay: autoplay,
              autoplaySpeed: 2000,
              dots : dots
            });

        });

        sliders.push( slider );
    }
}
/*************************
    GENERAL FUNCTION
*************************/

/**
 * Set a cookie
 * @param {[string]} cname  [holds the name of the cookie]
 * @param {[string]} cvalue [the cookie value]
 * @param {[int]} exdays [number of days to hold the cookie]
 */
function setCookie( cname, cvalue, exdays ) {
    var d = new Date();
    d.setTime(d.getTime() + ( exdays*24*60*60*1000 ));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
/**
 * Get a saved cookie
 * @param  {[string]} cname [the nema of the cookie]
 * @return {[string]}       [returns the saved cookie data]
 */
function getCookie( cname ) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/**
 * A helper function to determine wether this is the home page
 * @return {Boolean} [description]
 */
function isHome() {
    if (jQuery('body').hasClass('home')) {
        return true;
    } else {
        return false;
    }
}
/**
 * A helper function to determine wether the user is on a rtl page
 * @return {Boolean} [description]
 */
function isRtl() {
    if (jQuery('body').hasClass('rtl')) {
        return true;
    } else {
        return false;
    }
}
/**
 * A helper function to determine wether the user is on a mobile page
 * @return {Boolean} [description]
 */
function isMobile(width) {
    if ( width === null ) {
        width = 800;
    }

    if (jQuery(window).width() < width) {
        return true;
    } else {
        return false;
    }
}
/**
 * Create scrolled animation
 * @param  {[string]} target [DOM selector , can be either a css class or ID]
 *
 */
function animate_scroll(target){
    jQuery('html, body').animate({
        scrollTop: jQuery(target).offset().top
    }, 1000);
}

/**
* Check if element in view
* Usage: var isInView = Utils.isElementInView(jQuery('.someselector'), false);
*
*/
function Utils() {}
Utils.prototype = {
    constructor: Utils,
    isElementInView: function (element, fullyInView) {
        var pageTop = jQuery(window).scrollTop();
        var pageBottom = pageTop + jQuery(window).height();
        if( typeof jQuery(element).offset() != 'undefined' ){
            var elementTop = jQuery(element).offset().top;
            var elementBottom = elementTop + jQuery(element).height();

            if (fullyInView === true) {
                return ((pageTop < elementTop) && (pageBottom > elementBottom));
            } else {
                return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
            }
        }

    }
};
var Utils = new Utils();
