$(document).ready(function(){
	
	$('#header_magazine').scrollToFixed({	
		preFixed: function() {
			$('#header_magazine').addClass('header-magazine-shadow');
		},
		postFixed: function() {
			$('#header_magazine').removeClass('header-magazine-shadow');
		},
	});
	
	$('.drawer-hamburger').on('click',function(e){
		e.preventDefault();
		$('.magazine-left-menu').stop().animate({'left':'0px'},150);
		$( "<div></div>" ).appendTo( 'body' ).addClass( "magazine-data-layer" );
		$( ".drawer-hamburger-icon, .drawer-hamburger-icon:before, .drawer-hamburger-icon:after" ).stop().animate({'width':'0px','opacity':'0'},150);
		$('.logotype-magazine').stop().animate({'left':'0px'},150);
		
	});
	
	$('.drawer-hamburger-close').on('click',function(e){
		e.preventDefault();
		$('.magazine-data-layer').remove();
		$('.magazine-left-menu').stop().animate({'left':'-280px'},150);
		$( ".drawer-hamburger-icon, .drawer-hamburger-icon:before, .drawer-hamburger-icon:after" ).stop().animate({'width':'90%','opacity':'1'},150);
		$('.logotype-magazine').stop().animate({'left':'50px'},150);
		
	});
	
	$("body").on("click",'.magazine-data-layer', function (e) {
		e.preventDefault();
		$(this).remove();
		$('.magazine-left-menu').stop().animate({'left':'-280px'},150);
		$( ".drawer-hamburger-icon, .drawer-hamburger-icon:before, .drawer-hamburger-icon:after" ).stop().animate({'width':'90%','opacity':'1'},150);
		$('.logotype-magazine').stop().animate({'left':'50px'},150);
	});
	
	$(".btn-magazine-search").on('click',function(){
		let state_search = $(this).attr('rel');

		if (state_search == 'close') {
			$( ".magazine-search-input-area" ).animate({'width':'90%'}, 100,function(){
				$(".btn-magazine-search").attr('rel','open');
			});
		} else {
			$( ".magazine-search-input-area" ).animate({'width':'40px'}, 100,function(){
				$(".btn-magazine-search").attr('rel','close');
			});
		}
	});
	
	$('.btn-more-articles').on('click',function(e){
		e.preventDefault();
	});
	
    setTimeout(function(){
    	
	if ($(".magazine_area_item_content").length > 0){
		let hlist = $(".magazine_area_item_content")/*.children()*/.not('.posts-list').find("h2,h3,h4,h5,h6");
//console.log('hlist' + hlist.length);
		if (hlist.length > 0){
		    if (hlist.length >= 6) {
var hs = $('.magazine_detail_picture').height() - $('#article-char-elem').height() - 10;
			$('<div class="news-detail-content" style="height:'+ hs +'px;"><span class="news-detail-content-title">Содержание:</span></div>').appendTo('.news-detail-content-area');
        		}
		    else
		    {
			$('<div class="news-detail-content"><span class="news-detail-content-title">Содержание:</span></div>').appendTo('.news-detail-content-area');
    		    }
			
			//$('.news-detail-content').css('height', hdetail_picture + 'px');
			$(".magazine_area_item_content")/*.children()*/.not('.posts-list').find("h2,h3,h4,h5,h6").each(function(e) {
				console.log('fff');
				$(this).attr('id','h' + e);
				//let tp = parseInt($(this).offset().top);
				$( "<div><a href='#' class='news-detail-content-link' rel='h" + e + "'>"+ (e+1) +". "+ $(this).text() + "</a></div>" ).appendTo( ".news-detail-content" );
			});
if (hlist.length >= 6){
			$( "<div><a href='#' class='news-detail-content-link-all'>Смотреть все</a></div>" ).appendTo( ".news-detail-content" );
}
			
			$('.news-detail-content-link').on('click',function(e){
				e.preventDefault();
				let tp = $(this).attr('rel');
				 $('body,html').animate({scrollTop: $("#" + tp).offset().top - 168}, 400);
			});
			
			//$('.news-detail-content').append("a");

			$('.news-detail-content-link-all').on('click',function(e){
				e.preventDefault();
				$(this).css('display','none');
				$('.news-detail-content').animate({height: 100+'%'}, 400);
			});
			
		}
	}
    }, 2000);
	
});