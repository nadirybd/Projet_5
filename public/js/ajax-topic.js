$(document).ready(function(){
	$('#addtopic_cat').on('click', function(e){
		var id = e.target.value;
		
		$.post('indexAjax.php?req=subcategories', {id: id}, function(response){
			$('#sub-option').html(response);
		});
	});
});