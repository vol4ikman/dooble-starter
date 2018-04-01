var sliders = [];

var methods = {
    /**
     * Show sub menu on parent item focus
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    accessibility_show_sub_menu: function( e ){
        var $element = jQuery( e.currentTarget );

        e.preventDefault();

        $element.parent().addClass('hover');
    },
    /**
     * Skip to next parent on tab
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    accessibility_exit_sub_menu: function(  e ){
        var $element = jQuery( e.currentTarget );

        e.preventDefault();

        $element.parent().parent().removeClass('hover');
    },
    /**
     * Render slick sliders
     * @return {[type]} [description]
     */
    render_sliders: function(){

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
    },
    /**
     * Set a cookie
     * @param {[string]} cname  [holds the name of the cookie]
     * @param {[string]} cvalue [the cookie value]
     * @param {[int]} exdays [number of days to hold the cookie]
     */
    setCookie: function( cname, cvalue, exdays ) {
        var d = new Date();
        d.setTime(d.getTime() + ( exdays*24*60*60*1000 ));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },
    /**
     * Get a saved cookie
     * @param  {[string]} cname [the nema of the cookie]
     * @return {[string]}       [returns the saved cookie data]
     */
    getCookie: function( cname ) {
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
    },
    /**
     * A helper function to determine wether this is the home page
     * @return {Boolean} [description]
     */
    isHome: function() {
        if (jQuery('body').hasClass('home')) {
            return true;
        } else {
            return false;
        }
    },
    /**
     * A helper function to determine wether the user is on a rtl page
     * @return {Boolean} [description]
     */
    isRtl: function() {
        if (jQuery('body').hasClass('rtl')) {
            return true;
        } else {
            return false;
        }
    },
    /**
     * A helper function to determine wether the user is on a mobile page
     * @return {Boolean} [description]
     */
    isMobile: function(width) {
        if ( width === null ) {
            width = 800;
        }

        if (jQuery(window).width() < width) {
            return true;
        } else {
            return false;
        }
    },
    /**
     * Create scrolled animation
     * @param  {[string]} target [DOM selector , can be either a css class or ID]
     *
     */
    animate_scroll: function( target , speed ){
        if( typeof speed == 'undefined' ){
            speed = 1000;
        }

        jQuery('html, body').animate({
            scrollTop: jQuery(target).offset().top
        }, speed);
    },
    /**
     * An example of how to use
     * @param  {[type]} e [description]
     * @return {[type]}   [description]
     */
    do_something: function(e){
        element = jQuery( e.currentTarget );
        console.log(element);

        this.animate_scroll();
    }

};
