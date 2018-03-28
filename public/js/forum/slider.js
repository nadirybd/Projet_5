$(document).ready(function(){
	slider();
});

function slider(){
	var current = 0;
	$('.next').on('click', function(){
		if(current < 6){
			current++;
			$('.carousel-img').animate({
				left: '-=250'
			}, 1000);
		}
	});	

	$('.prev').on('click', function(){
		if(current >= 0){
			current--;
			$('.carousel-img').animate({
				left: 20
			}, 1000);
		}
	});
}
