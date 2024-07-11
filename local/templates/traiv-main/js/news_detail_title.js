$(document).ready(function(){
	//console.log($(".news-detail:not(:has(.posts-list)"));
	if ($(".news-detail").length > 0){
		let hlist = $(".news-detail").children().not('.posts-list').find("h2,h3,h4,h5,h6");
		//console.log('hlist' + hlist.length);
		if (hlist.length > 0){
			$('.news-date-time').after('<div class="news-detail-content"><span class="news-detail-content-title">Содержание:</span></div>');
			
			$(".news-detail").children().not('.posts-list').find("h2,h3,h4,h5,h6").each(function(e) {
				//console.log($(this));
				$(this).attr('id','h' + e);
				//let tp = parseInt($(this).offset().top);
				$( "<div><a href='#' class='news-detail-content-link' rel='h" + e + "'>"+ (e+1) +". "+ $(this).text() + "</a></div>" ).appendTo( ".news-detail-content" );
			});
			
			$('.news-detail-content-link').on('click',function(e){
				e.preventDefault();
				let tp = $(this).attr('rel');
				 $('body,html').animate({scrollTop: $("#" + tp).offset().top - 168}, 400);
			})
			
			//$('.news-detail-content').append("a");
		}
	}
});