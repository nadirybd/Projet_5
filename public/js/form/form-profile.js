var edit_button = $('.edit-button');
var cancel_button = $('.cancel');
var description = $('.description-content');
var form = $('#description-container');

function editDescription(){
	if(edit_button !== null && cancel_button !== null){
		$('.edit-button').on('click', function(e){
			$('.description-content').hide();
			$('#description-container').show(800);
		});
		$('.cancel').on('click', function(e){
			$('.description-content').show(800);
			$('#description-container').hide(0);
		});
	}
};

editDescription();