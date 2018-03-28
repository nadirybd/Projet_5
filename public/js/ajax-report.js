$(document).ready(function(){
	report();
});

function report(){
	$('.report-form').on('submit', function(e){
		e.preventDefault();
		var report_id = e.target[0].value;

		$.post('indexAjax.php?req=report', {report_id: report_id}, function(response){
			$('.notif').html(response);
			$('.notif').fadeIn();
		});
	});
	
	$('.notif').on('click', function(){
		$('.notif').fadeOut();
	});
}


