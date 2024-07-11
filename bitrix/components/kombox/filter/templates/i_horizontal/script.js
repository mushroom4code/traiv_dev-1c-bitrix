
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
var more = $('.more');
//var i =0;
line.each(function(){

	var element = $(this).children('.lvl2');
	var full_weight=0;
	var flag = 0;

	element.each(function(){


		if (full_weight > (line.width() - more.outerWidth()*2.70)) {

			$(this).css('display','none').addClass('hide');

			flag = 1;

		} else {

			full_weight+=$(this).outerWidth();

		}

	})


	if (flag === 1){
		$(this).children('.more').css({'display':'block','position':'absolute','right':'0'})
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

let isAscOrder = true;
$('.more.standart').click(function() {

	let mylist = $(this).parent();
	let listitems = mylist.children('.lvl2').get();

	listitems.sort(function(a, b) {
		let compA = $(a).text().toUpperCase();
		let compB = $(b).text().toUpperCase();

		return (isAscOrder ? 1 : -1) * ((compA < compB) ? -1 : (compA > compB) ? 1 : 0);
	});

	isAscOrder = !isAscOrder;

	$.each(listitems, function(idx, itm) { mylist.append(itm); mylist.append($('.less.standart')); mylist.append($('.more.standart')); });

	$(this).parent().attr('class', 'kombox-combo kombox-filter-property-body-standart');

	let all = $(this).parent().find('.lvl2').length;
	let hid = $(this).parent().find('.lvl2.hide').length;
	let vis = all - hid;
	let deli = (all/vis).toFixed(0);

	let btnHeight = $(this).parent().find('.lvl2').outerHeight(true);

	let colHeight = btnHeight * deli;

	/*
        console.log(all);
        console.log(hid);
        console.log(vis);
        console.log(deli);
        console.log(btnHeight);
    */
	// console.log( $(".lvl2:hidden").length );

	$('.kombox-combo.kombox-filter-property-body-standart').css({'height': colHeight});
	$(this).parent().find('.lvl2').css({'margin-left': '3px'});

});

$('.less.standart').click(function() {
	$(this).parent().attr('class', 'kombox-combo kombox-filter-property-body');

	$(this).parent().css({'height': 'unset'});
	$(this).parent().find('.lvl2').css({'width': 'unset'});

	$(this).hide();
	$(this).parent().find('.more.standart').show();
});

/*
$(":checkbox").click(function(){

	var cord1 = $(this).parent().offset()['left'];
	var cord2 = $('.modef').offset()['left'];
	var lefttarget = cord2 - cord1;

	$('.modef').css({'position' : 'absolute', 'z-index' : '11100'}).offset({left:cord1});

	console.log('cord1');
	console.log(cord1);
	console.log('cord2');
	console.log(cord2);
	console.log('cord3');
	console.log(lefttarget);

	$('.modef').animate({
		left: -lefttarget,
		top:-10,

		}, 500, function() {
		console.log($('.modef').offset()['left']);
	});




});
*/
