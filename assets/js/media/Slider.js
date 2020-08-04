	$(document).ready(function(){
		$('.bxslider').bxSlider({
			auto: true,
			mode: 'vertical',
			controls : false,
			pager : false,
			speed: 1000,
			pause: 3000
		});

		$('.horizontal-bxslider').bxSlider({
			auto: true,
			mode: 'horizontal',
			controls : false,
			speed: 2000,
			pause: 5000
		});

	});
