$(document).ready(function(){	
var mobileDetect = false;
	
	function checkMobile () {	    
		    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)) {
		      mobileDetect = true; 
		    };
		}
			
	checkMobile();
	
	var hMaintext = $('.land-main-text').height();
	if (mobileDetect == true && hMaintext > 500){
		$('.land-main-text').css('height','500px').css('overflow','hidden');
		
		$('<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pb-5 pt-xl-4 pt-lg-4 pt-md-4 text-center position-relative land-open-text-area"><div class="btn-group"><a href="#" id="land-open-text" class="btn-group-new btn-group-new-land-cons text-center"><span>Показать полностью</span></a></div></div>').insertAfter( ".land-main-text" );
		
		$('#land-open-text').on('click', function(e){
			e.preventDefault();
			$('.land-main-text').css('height','auto').css('overflow','unset');
			$('.land-open-text-area').remove();
		});	
	}
	
	if ($('.i-item-slide-area').length > 0 && mobileDetect == true){
		$('.i-item-slide-area').bxSlider({
				adaptiveHeight: false,
				mode: 'horizontal',
				infiniteLoop: true,
				auto: true,
				autoStart: true,
				autoDirection: 'next',
				autoHover: true,
				pause: 7000,
				autoControls: false,
				pager: true,
				pagerType: 'full',
				controls: true,
				captions: true,
				speed: 500,
				easing: 'linear',
				preloadImages: 'visible'
			});
	}
	
	if ($('.fh-video').length > 0){
		$('.player').YTPlayer();
	}
	
});