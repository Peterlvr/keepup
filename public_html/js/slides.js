$.slides = function(slidesIdPrefix, numSlides) {
	var i = 1;
	for(i = 1; i <= numSlides; i++) {
		$("#" + slidesIdPrefix + i).css("display", "none");
	}
	var currentSlide = numSlides;
	var changeSlide = function() {
		$("#" + slidesIdPrefix + currentSlide).fadeOut(500, function() {
			if(currentSlide == numSlides) {
				currentSlide = 1;
			}
			else {
				currentSlide++;
			}
			$("#" + slidesIdPrefix + currentSlide).fadeIn(500);
		});
	};
	changeSlide();
	setInterval(changeSlide, 5000);
};