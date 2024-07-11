
$(function(){	
	$.komboxInherit(
		'komboxHorizontalSmartFilter', 
		$.komboxSmartFilter, 
		{
			initRanges: function(){
				var _this = this;
				var listAutoResizeWidth = function(list) {
					var change = true;
					while(change)
					{
						change = false;
						var i = 0,
							currentRow = -1,
							currentRowStart = 0,
							rowDivs = new Array();
							
						list.each(function() {
							var $el = $(this);
							var topPosition = $el.position().top;
					
							if (currentRowStart != topPosition) {
								currentRow++;
								i = 0;
								currentRowStart = topPosition;
							}
							
							if(typeof rowDivs[i] == 'undefined')
								rowDivs[i] = new Array();
							
							rowDivs[i][currentRow] = $el;
							
							i++;
						});
						
						$.each(rowDivs, function(key, value ){
							if(value.length > 1){
								var width = 0;
								$.each(value, function(key, el ){
									if(typeof el != 'undefined')
										if(el.width() > width)
											width = el.width();
								});
								
								$.each(value, function(key, el ){
									if(typeof el != 'undefined')
										if(el.width() != width)
										{
											change = true;
										}
										el.width(width);
								});
								
							}
						});
					}
					
					$.each(rowDivs, function(key, value ){
						if(value.length > 1){
							var width = 0;
							$.each(value, function(key, el ){
								if(typeof el != 'undefined'){
									el.width('auto');
									if(el.width() > width)
										width = el.width();
									}
							});
							
							$.each(value, function(key, el ){
								if(typeof el != 'undefined')
									el.width(width);
							});
							
						}
					});
				};
			
				$(window).resize(function() {
					$('.kombox-combo', _this.wrapper).each(function(){
						listAutoResizeWidth($(this).find('li'));
					});
				});
				
				$('.kombox-combo', _this.wrapper).each(function(){
					listAutoResizeWidth($(this).find('li'));
				});
				
				$('.kombox-num table', _this.wrapper).each(function(){
					var $this = $(this);
					$this.width($this.width());
				});
				
				$.KomboxSmartFilter.prototype.initRanges.call(this);
			},
			
			initToggleProperties: function()
			{
				var _this = this;
				$('.kombox-filter-show-properties a', _this.wrapper).on('click', function(){
					var contaner = $('.kombox-filter-show-properties', _this.wrapper);
					if(contaner.hasClass('kombox-show')){
						$('.kombox-closed', _this.wrapper).show();
						contaner.addClass('kombox-hide').removeClass('kombox-show');
						$.cookie('kombox-filter-closed', false, { path: '/' });
					}
					else
					{
						$('.kombox-closed', _this.wrapper).hide();
						contaner.addClass('kombox-show').removeClass('kombox-hide');
						$.cookie('kombox-filter-closed', true, { path: '/' });
					}
					return false;
				});
				
				if($.cookie('kombox-filter-closed') != 'false'){
					$('.kombox-closed', _this.wrapper).hide();
					$('.kombox-filter-show-properties', _this.wrapper).addClass('kombox-show').removeClass('kombox-hide');
				}
				else
					$('.kombox-filter-show-properties', _this.wrapper).addClass('kombox-hide').removeClass('kombox-show');
			}
		}
	);
});