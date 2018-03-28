$(document).ready(function(){
	$('#btn-delete-msg').on('click', function(){
		$('#edit-message-form').hide();
		$('#section-delete-message').show();
	});

	$('#btn-edit-msg').on('click', function(){
		$('#section-delete-message').hide();
		$('#edit-message-form').show();
	});
});