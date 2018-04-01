$(document).ready(function(){
	/*****************
	* User sidebar *
	******************/

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

	/*****************
	* Burger sidebar *
	******************/
	var mainMenu = $('#main-menu').get(0);

	$('.burger').on('click', function(){
		if($('#burger-sidebar').css('display') === 'none'){
			$('#burger-sidebar').fadeIn();
			$('.overlay').fadeIn();
		} else {
			$('#burger-sidebar').fadeOut();
			$('.overlay').fadeOut();
		}
	});

	$('.overlay').on('click', function(){
		if ($('#burger-sidebar').css('display') === 'block') {
			$('#burger-sidebar').fadeOut();
			$('.overlay').fadeOut();
		}
	});

});