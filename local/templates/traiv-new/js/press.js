$(document).ready(function(){
	$('.press-more').on('click',function(e){
		e.preventDefault();
		
		$('.posts2-i').each(function() {
		    let vis = $(this).attr('rel');
		    //console.log('vis' + vis);
		    if (vis > 6) {
		    	$(this).removeClass('d-none');
		    }
		});
		$('.press_load_area').addClass('d-none');	
	});
	
	$('.press-tags-area-link').on('click',function(e){
		e.preventDefault();
		let tag_pro_name = $(this).attr( "data-pro-tags" ).toLowerCase();
		if (tag_pro_name == 'all'){
			$(".press-tags-area").find('.press-tags-area-link').children('div').removeClass('active');
			$(this).children('div').addClass('active');
			$(".press-list-in").children("li").css('display','block');	
		} else {
		$(".press-tags-area").find('.press-tags-area-link').children('div').removeClass('active');
		$(this).children('div').addClass('active');
		
		$(".press-list-in").children("li").each( function(){
		       var $this = $(this);
		       var value = $this.attr( "data-pro-tags" ).toLowerCase();
		       
		       if (value.includes( tag_pro_name ))
		    	   {
		    	   	$this.css('display','block');
		    	   }
		       else
		    	   {
		    	   	$this.css('display','none');
		    	   }
		});
		}
		
	});
});