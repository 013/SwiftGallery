;(function( $ ) {
    
    $.fn.removeWhitespace = function() 
    {
        this.contents().filter(
            function() {
                return (this.nodeType == 3 && !/\S/.test(this.nodeValue));
            }
        ).remove();
        return this;
    }
    
})( jQuery );
$(document).ready(function() {
	//	$('.Collage').removeWhitespace().collagePlus();
	var resizeTimer = null;
	$(window).bind('resize', function() {
		// hide all the images until we resize them
		// set the element you are scaling i.e. the first child nodes of ```.Collage``` to opacity 0
		$('.Collage .Image_Wrapper').css("opacity", 0);
		// set a timer to re-apply the plugin
		if (resizeTimer) clearTimeout(resizeTimer);
		resizeTimer = setTimeout(collage, 200);
	});

	function collage() {
		$('.Collage').removeWhitespace().collagePlus({
			'targetHeight' : 250,
			'fadeSpeed' : 2000,
			'allowPartialLastRow' : true
		});
	};

	$('.abc').hover(function() {
		$(this).width($(this).width()+10);
		$(this).height($(this).height()+10);
		$(this).css({ 'margin': '-5px' });
	},function() {
		$(this).width($(this).width()-10);
		$(this).height($(this).height()-10);
		$(this).css({ 'margin': '0' });
	});
	
	collage();
});

