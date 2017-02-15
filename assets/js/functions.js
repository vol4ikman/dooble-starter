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
