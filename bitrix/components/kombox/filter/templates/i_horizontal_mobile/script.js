
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

let line = $('.kombox-filter-property-body');

//var i =0;
/*line.each(function(){

let element = $(this).find('.lvl2');
let full_weight=0;
let flag = 0;

	if ($(this).children('.lvl2').length == 1){$(this).children('.lvl2').children('input').prop('checked', true);}

	element.each(function(){

		let rightArrow = $('.fa-angle-right');

		if ($(this).text() == 'DIN 7/ГОСТ 3128-70'){$(this).html('<label class="checkbox-label">ГОСТ 3128-70</label>')}


		if (full_weight > (line.width() - rightArrow.outerWidth()-100)) {

			$(this).css('display','none').addClass('hide');

			flag = 1;

		} else {

			full_weight+=$(this).outerWidth();

		}

	})


if (flag === 1){
	$(this).parent().find('.fa-angle-right').css({'display':'block', 'position':'absolute', 'right':'0'})
	$(this).parent().find('.fa-angle-left').css({'display':'block', 'position':'absolute', 'left':'0'})
}

	$(this).children('.lvl2').css({'display': 'block'})

})*/

/*$(function() {
	var leftArrow = $('.fa-angle-left');
	var rightArrow = $('.fa-angle-right');

	var currentLeftValue = 0;
	var maximumOffset = 0;
	var pixelsOffset = 125;

	leftArrow.click(function () {

		var elementsList = $(this).parent().find('.kombox-filter-property-elements');

		var elementsCount = elementsList.find('.lvl2').length;
		var minimumOffset = -((elementsCount - 5) * pixelsOffset);

		$(this).parent().find('.lvl2').css({'display': 'block'})
		if (currentLeftValue != maximumOffset) {
			currentLeftValue += 125;
			elementsList.animate({left: currentLeftValue + "px"}, 500);
		}
	});

	rightArrow.click(function () {

		var elementsList = $(this).parent().find('.kombox-filter-property-elements');

		var elementsCount = elementsList.find('.lvl2').length;
		/!*var minimumOffset = -((elementsCount - 5) * pixelsOffset);*!/
		var minimumOffset = -($(this).parent().find('.kombox-filter-property-elements').outerWidth())+100;

		$(this).parent().find('.lvl2').css({'display': 'block'})
		console.log(currentLeftValue);
		console.log(minimumOffset);

		if (currentLeftValue > minimumOffset) {
			currentLeftValue -= 125;
			elementsList.animate({left: currentLeftValue + "px"}, 500);
		}
	});
})*/

$(function() {
	var leftArrow = $('.fa-angle-left');
	var rightArrow = $('.fa-angle-right');

	let scrollValue = 0;

	$('.kombox-filter-property-elements').each(function() {

	if ($(this).width() < this.scrollWidth){
		$(this).parent().find('.fa-angle-left').show();
		$(this).parent().find('.fa-angle-right').show();
	}
	})

	leftArrow.click(function () {
		if (scrollValue >= 0) {
		scrollValue -=125;
			$(this).parent().find('.kombox-filter-property-elements').scrollLeft(scrollValue);
		}
	});

	rightArrow.click(function () {
		let fullWidth = $(this).parent().find('.kombox-filter-property-elements')[0].scrollWidth;
		if (scrollValue <= fullWidth-125) {
			scrollValue += 125;
			$(this).parent().find('.kombox-filter-property-elements').scrollLeft(scrollValue);
		}
	});
})

	$('.kombox-filter-uncheck').click(function () {
	console.log ('mr. Cleaner!');
	$('.lvl2').find('input').prop('checked', false).removeAttr('disabled');
	$('.for_modef').hide();
		});


/*$('.more').click(function() {

	let body = $(this).parent();
	let head = $(this).parent().parent().find('.kombox-filter-property-head');
	body.before(head); //sic!

	$(this).parent().find('.lvl2').css('display','inline-flex');
	$(this).hide();
	$(this).parent().find('.less').show();

});

$('.less').click(function() {

	let body = $(this).parent();
	let head = $(this).parent().parent().find('.kombox-filter-property-head');
	head.prependTo(body);

	$(this).parent().find('.lvl2.hide').hide();
	$(this).hide();
	$(this).parent().find('.more').show();
});*/


$(document).ready(function(event) {

	let isAscOrder = true;

	let mylist = $("[data-name='standart']");
	let listitems = mylist.find('.lvl2').get();

	listitems.sort(function(a, b) {
		let compA = $(a).text().toUpperCase();
		let compB = $(b).text().toUpperCase();

		return compB.indexOf("DIN") - compA.indexOf("DIN") || compA.indexOf("ГОСТ") - compB.indexOf("ГОСТ")  || compA.length - compB.length || (isAscOrder ? 1 : -1) * ((compA < compB) ? -1 : (compA > compB) ? 1 : 0);
	});

	isAscOrder = !isAscOrder;

	$.each(listitems, function(idx, itm) { mylist.find('.kombox-filter-property-elements').append(itm);});

//	$(this).parent().attr('class', 'kombox-combo kombox-filter-property-body-standart');

    /*let label = $(this).parent().find('.checkbox-label');

    label.each(function(){
        if ($(this).width() < 40){$(this).width(46)};

    });*/

	/*let all = $(this).parent().find('.lvl2').length;
	let hid = $(this).parent().find('.lvl2.hide').length;
	let vis = all - hid;
	let deli = (all/vis).toFixed(0);

	let btnHeight = $(this).parent().find('.lvl2').outerHeight(true);

	let colHeight = btnHeight * deli;

	$('.kombox-combo.kombox-filter-property-body-standart').css({'height': colHeight});
	 $(this).parent().find('.lvl2').css({'margin-left': '3px'});*/

});

/*$('.less.standart').click(function() {
	$(this).parent().attr('class', 'kombox-combo kombox-filter-property-body');

	$(this).parent().css({'height': 'unset'});
	$(this).parent().find('.lvl2').css({'width': 'unset'});

	$(this).hide();
	$(this).parent().find('.more.standart').show();
});*/

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
