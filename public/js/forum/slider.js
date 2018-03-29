$(document).ready(function(){
	slide = carousel('#carousel', 2);
});


var carousel = function(slider, int){
	var that = this;
	this.slider = slider;
	this.int = int;
	this.sliderContainer = $(this.slider).find('.carousel-container');
	this.sliderWidth = $(this.slider).width();
	this.imgWidth = $('.carousel-img').width();
	this.maxMargin = $(this.slider).find('.carousel-img').length;
	this.current = 0;

	setInterval(function(){
		if(that.current <= that.maxMargin - that.int){
			$(that.sliderContainer).animate({
				marginLeft: '-='+that.imgWidth
			}, 1000, function(){
				that.current++;
				if(that.current === that.maxMargin - that.int) {
					that.current = 0;
					$(that.sliderContainer).delay(2000).animate({
						marginLeft: 0
					}, 1000);
				}
			});
		}
	}, 5000);
}
