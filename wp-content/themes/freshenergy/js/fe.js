jQuery(document).ready(function(){
	var $ = jQuery;

	//move navigation
	var nav = $('#main-nav');
	var header = $('#site-header');
	header.append(nav).wrapInner('<div class="inner"></div>');

	//circles
	$('#menu-programs a').wrapInner('<span></span>').css('opacity', 1);


	//trim bottom paragraphs
	trimGraphs( $('#fe-homepage-bottom p') );
	trimGraphs( $('.archive .secondary-featured-post p') );

	//category pages
	var main = $('.archive-background .hero')[0];
	var source = $(main).find ('img').attr('src');

	$(main).prepend('<div class="background-container" style="background-image:url(' + source + ')"></div>');

	function trimGraphs(graphs){
		for (var i=0; i<graphs.length; i++){
			var text= $(graphs[i]).text();
			if(text.length > 120) {
				var trimmed = text.substring(0,120);
				trimmed = trimmed.substr(0, Math.min(trimmed.length, trimmed.lastIndexOf(' ')));
			    $(graphs[i]).text(trimmed + '...');
			}
		}
	}
	
});
