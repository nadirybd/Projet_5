$('#addtopic_cat').on('blur', function(e){
	var id = e.target.value;
	
	$.post('indexAjax.php?req=subcategories', {id: id}, function(response){
		$('#sub-option').html(response);
	});
});