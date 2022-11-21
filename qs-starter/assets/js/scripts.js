jQuery(document).ready(function () {
	// accessible contact form 7 focus validation
	// list of contact form 7 DOM events: https://contactform7.com/dom-events/
	var cf7_form = jQuery(".wpcf7");
	cf7_form.on("wpcf7invalid ", function (event) {
		jQuery(this).find(".wpcf7-not-valid").first().focus();
	});

	// accessibility handle browser zoom level
	jQuery(window).resize(function () {
		var browserZoomLevel = Math.round(window.devicePixelRatio * 100);
		console.log(browserZoomLevel);
		if (browserZoomLevel < 401) {
			jQuery("body").removeClass(
				"zoom-level-90 zoom-level-100 zoom-level-110 zoom-level-120 zoom-level-130 zoom-level-140 zoom-level-150 zoom-level-160 zoom-level-170 zoom-level-180 zoom-level-190 zoom-level-200 zoom-level-210 zoom-level-220 zoom-level-230 zoom-level-240 zoom-level-250 zoom-level-260 zoom-level-270 zoom-level-280 zoom-level-290 zoom-level-300 zoom-level-310 zoom-level-320 zoom-level-330 zoom-level-340 zoom-level-350 zoom-level-360 zoom-level-370 zoom-level-380 zoom-level-390 zoom-level-400"
			);
			jQuery("body").addClass("zoom-level-" + browserZoomLevel);
		}
	});
});
