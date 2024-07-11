
$(function(){	
	$.komboxInherit(
		'komboxHorizontalSmartFilter', 
		$.komboxSmartFilter, 
		{
			options: { 
				columns: 3
			},
			
			init: function(wrapper, options){
				$.KomboxSmartFilter.prototype.init.call(this, wrapper, options);
				
				if(this.options.columns <= 0)
					this.options.columns = 3;
				$('.kombox-column', this.wrapper).css('width', (100 / this.options.columns) + '%');
			},
			
			recalculateColumns: function(){
				var _this = this;
				var cnt = 0;
				$('.kombox-column', this.wrapper).css('clear', 'none').not('.kombox-hide').each(function(){
					cnt++;
					if(cnt == _this.options.columns + 1)
					{
						$(this).css('clear', 'both');
						cnt = 1;
					}
				});
			},
			
			initToggleProperties: function()
			{
				var _this = this;
				$('.kombox-filter-show-properties a', _this.wrapper).on('click', function(){
					var contaner = $('.kombox-filter-show-properties', _this.wrapper);
					if(contaner.hasClass('kombox-show')){
						$('.kombox-closed', _this.wrapper).show().removeClass('kombox-hide');
						contaner.addClass('kombox-hide').removeClass('kombox-show');
						$.cookie('kombox-filter-closed', false, { path: '/' });
						_this.recalculateColumns();
					}
					else
					{
						$('.kombox-closed', _this.wrapper).hide().addClass('kombox-hide');
						contaner.addClass('kombox-show').removeClass('kombox-hide');
						$.cookie('kombox-filter-closed', true, { path: '/' });
						_this.recalculateColumns();
					}
					return false;
				});
				
				if($.cookie('kombox-filter-closed') != 'false'){
					$('.kombox-closed', _this.wrapper).hide().addClass('kombox-hide');
					$('.kombox-filter-show-properties', _this.wrapper).addClass('kombox-show').removeClass('kombox-hide');
				}
				else{
					$('.kombox-closed', _this.wrapper).show().removeClass('kombox-hide');
					$('.kombox-filter-show-properties', _this.wrapper).addClass('kombox-hide').removeClass('kombox-show');
				}
				
				this.recalculateColumns();
			}
		}
	);
});

var line = $('.kombox-combo.kombox-filter-property-body');

line.each(function(){

var element = $(this).children('.lvl2');
var full_weight=0;
var flag = 0;

	element.each(function(){


		if (full_weight > (line.width()-120)) {

			$(this).css('display','none').addClass('hide');

			flag = 1;

		} else {

			full_weight+=$(this).outerWidth();

		}

	})

	//console.log(full_weight);
	//console.log(flag);

if (flag === 1){
	$(this).children('.more').css('display','block')
}

})

$('.more').click(function() {
	$(this).parent().find('.lvl2').css('display','inline-flex');
	$(this).hide();
	$(this).parent().find('.less').show();
});

$('.less').click(function() {
//	console.log('click');
	$(this).parent().find('.lvl2.hide').hide();
	$(this).hide();
	$(this).parent().find('.more').show();
});