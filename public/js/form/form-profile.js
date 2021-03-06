$(document).ready(function(){
	editDescription();
	resolvedForm();
});

var edit_button = $('.edit-button');
var cancel_button = $('.cancel-description');
var description = $('.description-content');
var form = $('#description-container');

function editDescription(){
	if(edit_button !== null && cancel_button !== null){
		$('.edit-button').on('click', function(e){
			$('.description-content').hide();
			$('#description-container').show(800);
		});
		$('.cancel-description').on('click', function(e){
			$('.description-content').show(800);
			$('#description-container').hide(0);
		});
	}
};


function resolvedForm(){
	$('.resolved-button').on('click', function(e){
		$('#resolved-form').fadeIn(700);
		$('.overlay').fadeIn(700);
	});
	$('.close').on('click', function(e){
		$('#resolved-form').hide();
		$('.overlay').hide();
	});
	$('.overlay').on('click', function(e){
		$('#resolved-form').hide();
		$('.overlay').hide();
	});
};
