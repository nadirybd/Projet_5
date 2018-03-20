var edit_button = document.querySelector('.edit-button');
var cancel_button = document.querySelector('.cancel');
var description = document.querySelector('.description-content');
var form = document.getElementById('description-container');

function editDescription(){
	if(edit_button !== null && cancel_button !== null){
		edit_button.addEventListener('click', function(e){
			description.style.display = 'none';
			form.style.display = 'block';
		});
		cancel_button.addEventListener('click', function(e){
			description.style.display = 'block';
			form.style.display = 'none';
		});
	}
};

editDescription();