$(document).ready(function(){
	var container = $('#side-bar').get(0);
	var containerChild = $('#side-bar').children().html();

	var display = $('#side-bar').css('display');

	$('#user-menu .fa-user-circle').on('click', function(e){
		if(display == 'none'){
			$('#side-bar').fadeIn();
		}
	});

	$(window).on('mouseup', function(e){
		if(e.target !== container && e.target.offsetParent !== container){
        	$('#side-bar').fadeOut();
    	}
	});
});