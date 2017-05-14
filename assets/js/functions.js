function isHome() {
    if (jQuery('body').hasClass('home')) {
        return true;
    } else {
        return false;
    }
}

function isRtl() {
    if (jQuery('body').hasClass('rtl')) {
        return true;
    } else {
        return false;
    }
}

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
function animate_scroll(target){
    jQuery('html, body').animate({
        scrollTop: jQuery(target).offset().top
    }, 1000);
}

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
var sliders = [];

function render_sliders(){
    
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
