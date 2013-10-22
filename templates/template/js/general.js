$(document).ready(function(){
	$('.slider .item').click(function(){
		elem = this;
		$('.slider .opened').removeClass('opened').addClass('closed');
		$(elem).removeClass('closed').addClass('opened');
		$('.sliderimage').attr('src', $(elem).find('img').attr('src'));
		return false;
	});
	
	$(".twitter .text").getTwitter({
		userName: "themesline"
	});
});