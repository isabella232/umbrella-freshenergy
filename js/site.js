$(function() {
	$('#featured-in a.view-all').click(function() {
		$(this).hide('fast');
		$('#featured-in h3').show('fast');
		return false;
	});
	
	$('#sidebar .popular ul li:odd').addClass('end');
	$('#sidebar .popular ul li:odd').after('<li class="breaker">&nbsp;</li>');
	
});