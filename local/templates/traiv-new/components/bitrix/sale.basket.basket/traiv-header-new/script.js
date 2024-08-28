function declOfNum(number, titles) {
	var cases = [2, 0, 1, 1, 1, 2];
	return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
}


//Замена суммы с нулем
window.onload = function(){
	if (!$('#bx-soa-order').length) {
		if (
			(
				document.documentElement.textContent || document.documentElement.innerText
			).indexOf('Запросить цену') > -1
		) {

			$("#allSum_FORMATED").text("будет сформирована для вас менеджером");

			$('.rubls').hide();
		};

		recalcBasketAjax({});
	}
};


BasketPoolQuantity = function()
{
	this.processing = false;
	this.poolQuantity = {};
	this.updateTimer = null;
	this.currentQuantity = {};

	this.updateQuantity();
};


BasketPoolQuantity.prototype.updateQuantity = function()
{
	var items = BX('basket_items');

	if (!!items && items.rows.length > 0)
	{
		for (var i = 1; items.rows.length > i; i++)
		{
			var itemId = items.rows[i].id;
			if (itemId>0){
				this.currentQuantity[itemId] = BX('QUANTITY_' + itemId).value;
			}

		}
	}

};


BasketPoolQuantity.prototype.changeQuantity = function(itemId)
{


	var quantity = BX('QUANTITY_' + itemId).value;
	var isPoolEmpty = this.isPoolEmpty();

	if (this.currentQuantity[itemId] && this.currentQuantity[itemId] != quantity)
	{
		this.poolQuantity[itemId] = this.currentQuantity[itemId] = quantity;
	}

	if (!isPoolEmpty)
	{
		this.enableTimer(true);
	}
	else
	{
		this.trySendPool();
	}
};


BasketPoolQuantity.prototype.trySendPool = function()
{
	if (!this.isPoolEmpty() && !this.isProcessing())
	{
		this.enableTimer(false);
		recalcBasketAjax({});
	}
};

BasketPoolQuantity.prototype.isPoolEmpty = function()
{
	return ( Object.keys(this.poolQuantity).length == 0 );
};

BasketPoolQuantity.prototype.clearPool = function()
{
	this.poolQuantity = {};
};

BasketPoolQuantity.prototype.isProcessing = function()
{
	return (this.processing === true);
};

BasketPoolQuantity.prototype.setProcessing = function(value)
{
	this.processing = (value === true);
};

BasketPoolQuantity.prototype.enableTimer = function(value)
{
	clearTimeout(this.updateTimer);
	if (value === false)
		return;

	this.updateTimer = setTimeout(function(){ basketPoolQuantity.trySendPool(); }, 1500);
};

/**
 * @param basketItemId
 * @param {{BASKET_ID : string, BASKET_DATA : { GRID : { ROWS : {} }}, COLUMNS: {}, PARAMS: {}, DELETE_ORIGINAL : string }} res
 */
function updateBasketTable(basketItemId, res)
{
	var table = BX("basket_items"),
		rows,
		newBasketItemId,
		arItem,
		lastRow,
		newRow,
		arColumns,
		bShowDeleteColumn = false,
		bShowDelayColumn = false,
		bShowPropsColumn = false,
		bShowPriceType = false,
		bUseFloatQuantity,
		origBasketItem,
		oCellMargin,
		i,
		oCellName,
		imageURL,
		cellNameHTML,
		oCellItem,
		cellItemHTML,
		bSkip,
		j,
		val,
		propId,
		arProp,
		bIsImageProperty,
		full,
		arVal,
		valId,
		arSkuValue,
		selected,
		valueId,
		k,
		arItemProp,
		oCellQuantity,
		oCellQuantityHTML,
		ratio,
		max,
		isUpdateQuantity,
		oldQuantity,
		oCellPrice,
		fullPrice,
		id,
		productID,
		oCellDiscount,
		oCellWeight,
		oCellCustom,
		customColumnVal;

	if (!table || typeof res !== 'object')
	{
		return;
	}

	rows = table.rows;
	lastRow = rows[rows.length - 1];
	bUseFloatQuantity = (res.PARAMS.QUANTITY_FLOAT === 'Y');

	// update product params after recalculation
	if (!!res.BASKET_DATA)
	{
		for (id in res.BASKET_DATA.GRID.ROWS)
		{
			if (res.BASKET_DATA.GRID.ROWS.hasOwnProperty(id))
			{
				var item = res.BASKET_DATA.GRID.ROWS[id];

				if(BX(id) === null){
					//insert new row
					var $tr = $('#template-cart__row').clone();
					$tr.html($tr.html().replace(/{ID}/g, id));


					let replacer1 = /PU=S|PU=K|RU=S|RU=K|PU=К|КИТАЙ|Конт|Китай|Россия|Европа/g;
					let replacer2 = /\([^)]+(шт.\)|шт\))/;

					let eraser = '';
					item.NAME = item.NAME.replace(replacer1,eraser);
					item.NAME = item.NAME.replace(replacer2,eraser);

					$tr.html($tr.html().replace(/{name}/g, item.NAME));
					$tr.html($tr.html().replace(/{current_url}/g, location.url));
					$tr.html($tr.html().replace(/{href}/g, item.DETAIL_PAGE_URL));


					//	if (item.DETAIL_PICTURE_SRC.length == 0) {
					$.ajax({
						type: "POST",
						url: "/local/templates/traiv-new/components/bitrix/sale.basket.basket/traiv/ratio.php",
						dataType: "json",
						data: {
							id: item.PRODUCT_ID,
						},
						success: function (data) {

							$tr.html($tr.html().replace(/{art}/g, data.art));
							
							$tr.find('img.responsive').attr('src', data['img']);

							if (data['ratio'] === 0 && ($('#QUANTITY').val()) !== undefined){data['ratio'] = $('#QUANTITY').val();}
							else if (data['ratio'] === 0){data['ratio'] = 1};


							$tr.html($tr.html().replace(/{rat}/g, data['ratio']));

							let itemlistquant = $('#'+item.PRODUCT_ID+'-item-quantity').val();

							if (itemlistquant > 1) {
								BX('QUANTITY_INPUT_' + id).value = itemlistquant;
								BX('QUANTITY_INPUT_' + id).defaultValue = data['ratio'];
								BX('QUANTITY_' + id).value = itemlistquant;
							}else {
								BX('QUANTITY_INPUT_' + id).value = data['ratio'];
								BX('QUANTITY_INPUT_' + id).defaultValue = data['ratio'];
								BX('QUANTITY_' + id).value = data['ratio'];
							}

							//	$tr.html($tr.html().replace(/{packs_number}/g, data['ratio']));


							//counting packs

							var del1 = parseInt(BX('QUANTITY_INPUT_' + id).value);
							var del2 =parseInt($('#QUANTITY_INPUT_' + id).attr('step'));
							var quant_packs = del1 / del2;


							var number = $('#QUANTITY_INPUT_' + id).parent().parent().parent().find('.quantity_packs'); //shitty
							number.html(quant_packs);

							var pack = $('#QUANTITY_INPUT_' + id).parent().parent().parent().find('.word_packs');

							if (quant_packs === del1){pack.remove();number.parent().parent().parent().css('margin-right', '5em'); number.remove();}

							//pack.html(declOfNum(quant_packs, [' упаковка', ' упаковки', ' упаковок']));
							pack.html('уп.');

						}

					});

					//	} else {

					//		$tr.find('img.responsive').attr('src', item.DETAIL_PICTURE_SRC.length ? item.DETAIL_PICTURE_SRC : '/images/no_image_50x50.png');

					//	}

					$tr.attr('data-product_id', item.PRODUCT_ID);
					$tr.attr('id', id);
					$tr.appendTo('#basket-content');

				}

				if (BX('discount_value_' + id))
					BX('discount_value_' + id).innerHTML = item.DISCOUNT_PRICE_PERCENT_FORMATED.replace('руб.', '');

				if (BX('current_price_' + id))
					BX('current_price_' + id).innerHTML = item.PRICE_FORMATED.replace('руб.', '');

				if (BX('old_price_' + id))
					BX('old_price_' + id).innerHTML = (item.FULL_PRICE_FORMATED != item.PRICE_FORMATED) ? item.FULL_PRICE_FORMATED.replace('руб.', '') : '';

				if (BX('sum_' + id))
					BX('sum_' + id).innerHTML = (item.SUM !== undefined ? item.SUM.replace('руб.', '') : 0);

				// if the quantity was set by user to 0 or was too much, we need to show corrected quantity value from ajax response
				if (BX('QUANTITY_' + id))
				{
					BX('QUANTITY_INPUT_' + id).value = item.QUANTITY;
					BX('QUANTITY_INPUT_' + id).defaultValue = item.QUANTITY;

					BX('QUANTITY_' + id).value = item.QUANTITY;
				}

				//counting packs

				var del1 = parseInt(BX('QUANTITY_INPUT_' + id).value);
				var del2 =parseInt($('#QUANTITY_INPUT_' + id).attr('step'));
				var quant_packs = del1 / del2;


				var number = $('#QUANTITY_INPUT_' + id).parent().parent().parent().find('.quantity_packs');
				number.html(quant_packs);

				var pack = $('#QUANTITY_INPUT_' + id).parent().parent().parent().find('.word_packs');

				if (quant_packs === del1){pack.remove();number.parent().parent().parent().css('margin-right', '5em'); number.remove();}

				//pack.html(declOfNum(quant_packs, [' упаковка', ' упаковки', ' упаковок']));
				pack.html('уп.');

				//update cart red counter

				var red = $('.cart-item > .cart__row').length;

				$('.cart_total_count').html(red > 0 ? red : '+');


			}
		}
	}

	// update coupon info
	if (!!res.BASKET_DATA)
		couponListUpdate(res.BASKET_DATA);

	// update warnings if any
	if (res.hasOwnProperty('WARNING_MESSAGE'))
	{
		var warningText = '';

		for (i = res['WARNING_MESSAGE'].length - 1; i >= 0; i--)
			warningText += res['WARNING_MESSAGE'][i] + '<br/>';

		BX('warning_message').innerHTML = warningText;
	}


	// update total basket values
	if (!!res.BASKET_DATA)
	{
		res['BASKET_DATA']['allSum_FORMATED'].replace(/руб./, '');

		if (BX('allWeight_FORMATED'))
			BX('allWeight_FORMATED').innerHTML = res['BASKET_DATA']['allWeight_FORMATED'].replace(/\s/g, '&nbsp;');

		if (BX('allSum_wVAT_FORMATED'))
			BX('allSum_wVAT_FORMATED').innerHTML = res['BASKET_DATA']['allSum_wVAT_FORMATED'].replace(/\s/g, '&nbsp;');

		if (BX('allVATSum_FORMATED'))
			BX('allVATSum_FORMATED').innerHTML = res['BASKET_DATA']['allVATSum_FORMATED'].replace(/\s/g, '&nbsp;');

		if (BX('allSum_FORMATED'))
			BX('allSum_FORMATED').innerHTML = res['BASKET_DATA']['allSum_FORMATED'].replace(/руб./, '');

		if (BX('PRICE_WITHOUT_DISCOUNT'))
			BX('PRICE_WITHOUT_DISCOUNT').innerHTML = (res['BASKET_DATA']['PRICE_WITHOUT_DISCOUNT'] != res['BASKET_DATA']['allSum_FORMATED']) ? res['BASKET_DATA']['PRICE_WITHOUT_DISCOUNT'].replace(/\s/g, '&nbsp;').replace(/руб./, '') : '';

		BX.onCustomEvent('OnBasketChange');
	}

	reindexBasketItems();

}
/**
 * @param couponBlock
 * @param {COUPON: string, JS_STATUS: string} oneCoupon - new coupon.
 */
function couponCreate(couponBlock, oneCoupon)
{
	var couponClass = 'disabled';

	if (!BX.type.isElementNode(couponBlock))
		return;
	if (oneCoupon.JS_STATUS === 'BAD')
		couponClass = 'bad';
	else if (oneCoupon.JS_STATUS === 'APPLYED')
		couponClass = 'good';

	couponBlock.appendChild(BX.create(
		'div',
		{
			props: {
				className: 'bx_ordercart_coupon'
			},
			children: [
				BX.create(
					'input',
					{
						props: {
							className: couponClass,
							type: 'text',
							value: oneCoupon.COUPON,
							name: 'OLD_COUPON[]'
						},
						attrs: {
							disabled: true,
							readonly: true
						}
					}
				),
				BX.create(
					'span',
					{
						props: {
							className: couponClass
						},
						attrs: {
							'data-coupon': oneCoupon.COUPON
						}
					}
				),
				BX.create(
					'div',
					{
						props: {
							className: 'bx_ordercart_coupon_notes'
						},
						html: oneCoupon.JS_CHECK_CODE
					}
				)
			]
		}
	));
}

/**
 * @param {COUPON_LIST : []} res
 */
function couponListUpdate(res)
{
	var couponBlock,
		couponClass,
		fieldCoupon,
		couponsCollection,
		couponFound,
		i,
		j,
		key;

	if (!!res && typeof res !== 'object')
	{
		return;
	}

	couponBlock = BX('coupons_block');
	if (!!couponBlock)
	{
		if (!!res.COUPON_LIST && BX.type.isArray(res.COUPON_LIST))
		{
			fieldCoupon = BX('coupon');
			if (!!fieldCoupon)
			{
				fieldCoupon.value = '';
			}
			couponsCollection = BX.findChildren(couponBlock, { tagName: 'input', property: { name: 'OLD_COUPON[]' } }, true);

			if (!!couponsCollection)
			{
				if (BX.type.isElementNode(couponsCollection))
				{
					couponsCollection = [couponsCollection];
				}
				for (i = 0; i < res.COUPON_LIST.length; i++)
				{
					couponFound = false;
					key = -1;
					for (j = 0; j < couponsCollection.length; j++)
					{
						if (couponsCollection[j].value === res.COUPON_LIST[i].COUPON)
						{
							couponFound = true;
							key = j;
							couponsCollection[j].couponUpdate = true;
							break;
						}
					}
					if (couponFound)
					{
						couponClass = 'disabled';
						if (res.COUPON_LIST[i].JS_STATUS === 'BAD')
							couponClass = 'bad';
						else if (res.COUPON_LIST[i].JS_STATUS === 'APPLYED')
							couponClass = 'good';

						BX.adjust(couponsCollection[key], {props: {className: couponClass}});
						BX.adjust(couponsCollection[key].nextSibling, {props: {className: couponClass}});
						BX.adjust(couponsCollection[key].nextSibling.nextSibling, {html: res.COUPON_LIST[i].JS_CHECK_CODE});
					}
					else
					{
						couponCreate(couponBlock, res.COUPON_LIST[i]);
					}
				}
				for (j = 0; j < couponsCollection.length; j++)
				{
					if (typeof (couponsCollection[j].couponUpdate) === 'undefined' || !couponsCollection[j].couponUpdate)
					{
						BX.remove(couponsCollection[j].parentNode);
						couponsCollection[j] = null;
					}
					else
					{
						couponsCollection[j].couponUpdate = null;
					}
				}
			}
			else
			{
				for (i = 0; i < res.COUPON_LIST.length; i++)
				{
					couponCreate(couponBlock, res.COUPON_LIST[i]);
				}
			}
		}
	}
	couponBlock = null;
}

function skuPropClickHandler(e)
{
	if (!e)
	{
		e = window.event;
	}
	var target = BX.proxy_context,
		basketItemId,
		property,
		property_values = {},
		postData = {},
		action_var,
		all_sku_props,
		i,
		sku_prop_value,
		m;

	if (!!target && target.hasAttribute('data-value-id'))
	{
		BX.showWait();

		basketItemId = target.getAttribute('data-element');
		property = target.getAttribute('data-property');
		action_var = BX('action_var').value;

		property_values[property] = target.getAttribute('data-value-id');

		// if already selected element is clicked
		if (BX.hasClass(target, 'bx_active'))
		{
			BX.closeWait();
			return;
		}

		// get other basket item props to get full unique set of props of the new product
		all_sku_props = BX.findChildren(BX(basketItemId), {tagName: 'ul', className: 'sku_prop_list'}, true);
		if (!!all_sku_props && all_sku_props.length > 0)
		{
			for (i = 0; all_sku_props.length > i; i++)
			{
				if (all_sku_props[i].id !== 'prop_' + property + '_' + basketItemId)
				{
					sku_prop_value = BX.findChildren(BX(all_sku_props[i].id), {tagName: 'li', className: 'bx_active'}, true);
					if (!!sku_prop_value && sku_prop_value.length > 0)
					{
						for (m = 0; sku_prop_value.length > m; m++)
						{
							if (sku_prop_value[m].hasAttribute('data-value-id'))
							{
								property_values[sku_prop_value[m].getAttribute('data-property')] = sku_prop_value[m].getAttribute('data-value-id');
							}
						}
					}
				}
			}
		}

		postData = {
			'basketItemId': basketItemId,
			'sessid': BX.bitrix_sessid(),
			'site_id': BX.message('SITE_ID'),
			'props': property_values,
			'action_var': action_var,
			'select_props': BX('column_headers').value,
			'offers_props': BX('offers_props').value,
			'quantity_float': BX('quantity_float').value,
			'count_discount_4_all_quantity': BX('count_discount_4_all_quantity').value,
			'price_vat_show_value': BX('price_vat_show_value').value,
			'hide_coupon': BX('hide_coupon').value,
			'use_prepayment': BX('use_prepayment').value
		};

		postData[action_var] = 'select_item';

	}
}

function getColumnName(result, columnCode)
{
	if (BX('col_' + columnCode))
	{
		return BX.util.trim(BX('col_' + columnCode).innerHTML);
	}
	else
	{
		return '';
	}
}

function leftScroll(prop, id, count)
{
	count = parseInt(count, 10);
	var el = BX('prop_' + prop + '_' + id);

	if (el)
	{
		var curVal = parseInt(el.style.marginLeft, 10);
		if (curVal <= (6 - count)*20)
			el.style.marginLeft = curVal + 20 + '%';
	}
}

function rightScroll(prop, id, count)
{
	count = parseInt(count, 10);
	var el = BX('prop_' + prop + '_' + id);

	if (el)
	{
		var curVal = parseInt(el.style.marginLeft, 10);
		if (curVal > (5 - count)*20)
			el.style.marginLeft = curVal - 20 + '%';
	}
}

function checkOut()
{
	if (!!BX('coupon'))
		BX('coupon').disabled = true;
	BX("basket_form").submit();
	return true;
}

function updateBasket()
{
	recalcBasketAjax({});
}

function enterCoupon()
{
	var newCoupon = BX('coupon');
	if (!!newCoupon && !!newCoupon.value)
		recalcBasketAjax({'coupon' : newCoupon.value});
}

// check if quantity is valid
// and update values of both controls (text input field for PC and mobile quantity select) simultaneously
function updateQuantity(controlId, basketId, ratio, bUseFloatQuantity, productID)
{


	var prodID = $('#'+basketId).attr('data-product_id');
	//var intprodID = parseInt(newVal);
	//console.log(prodID);

	var oldVal = BX(controlId).defaultValue,
		newVal = parseFloat(BX(controlId).value) || 0,
		bIsCorrectQuantityForRatio = false,
		autoCalculate = ((BX("auto_calculation") && BX("auto_calculation").value == "Y") || !BX("auto_calculation"));

	if (ratio === 0 || ratio == 1)
	{
		bIsCorrectQuantityForRatio = true;

	}

	else
	{

		var newValInt = newVal * 10000,
			ratioInt = ratio * 10000,
			reminder = newValInt % ratioInt,
			newValRound = parseInt(newVal);

		if (reminder === 0)
		{
			bIsCorrectQuantityForRatio = true;
		}
	}

	var bIsQuantityFloat = false;

	if (parseInt(newVal) != parseFloat(newVal))
	{
		bIsQuantityFloat = true;
	}

	newVal = (bUseFloatQuantity === false && bIsQuantityFloat === false) ? parseInt(newVal) : parseFloat(newVal).toFixed(4);
	newVal = correctQuantity(newVal);

	if (bIsCorrectQuantityForRatio)
	{
		BX(controlId).defaultValue = newVal;

		BX("QUANTITY_INPUT_" + basketId).value = newVal;

		// set hidden real quantity value (will be used in actual calculation)
		BX("QUANTITY_" + basketId).value = newVal;

		if (autoCalculate)
		{
			basketPoolQuantity.changeQuantity(basketId);
		}
	}
	else
	{
		newVal = getCorrectRatioQuantity(newVal, ratio, bUseFloatQuantity);
		newVal = correctQuantity(newVal);

		if (newVal != oldVal)
		{
			BX("QUANTITY_INPUT_" + basketId).value = newVal;
			BX("QUANTITY_" + basketId).value = newVal;

			if (autoCalculate)
			{
				basketPoolQuantity.changeQuantity(basketId);
			}
		}else
		{
			BX(controlId).value = oldVal;
		}
	}
}

// used when quantity is changed by clicking on arrows
function setQuantity(basketId, ratio, sign, bUseFloatQuantity, productID)
{
	if (ratio === 0 || ratio == 1 ){
		bIsCorrectQuantityForRatio = true;

	}

	var curVal = parseFloat(BX("QUANTITY_INPUT_" + basketId).value),
		newVal;

	newVal = (sign == 'up') ? curVal + ratio : curVal - ratio;


	if (newVal < 0)
		newVal = 0;

	if (bUseFloatQuantity)
	{
		newVal = parseFloat(newVal).toFixed(4);
	}
	newVal = correctQuantity(newVal);


	if (ratio > 0 && newVal < ratio)
	{
		newVal = ratio + productID;
	}

	if (!bUseFloatQuantity && newVal != newVal.toFixed(4))
	{
		newVal = parseFloat(newVal).toFixed(4);
	}

	var step = parseFloat(BX("QUANTITY_INPUT_" + basketId).step);
	if (ratio != step){ratio = step};

	newVal = getCorrectRatioQuantity(newVal, ratio, bUseFloatQuantity);
	newVal = correctQuantity(newVal);

	BX("QUANTITY_INPUT_" + basketId).value = newVal;
	BX("QUANTITY_INPUT_" + basketId).defaultValue = newVal;

	updateQuantity('QUANTITY_INPUT_' + basketId, basketId, ratio, bUseFloatQuantity);

}

function getCorrectRatioQuantity(quantity, ratio, bUseFloatQuantity)
{
	var newValInt = quantity * 10000,
		ratioInt = ratio * 10000,
		reminder = (quantity / ratio - ((quantity / ratio).toFixed(0))).toFixed(6),
		result = quantity,
		bIsQuantityFloat = false,
		i;
	ratio = parseFloat(ratio);

	if (reminder == 0)
	{
		return result;
	}

	if (ratio !== 0 && ratio != 1)
	{
		for (i = ratio, max = parseFloat(quantity) + parseFloat(ratio); i <= max; i = parseFloat(parseFloat(i) + parseFloat(ratio)).toFixed(4))
		{
			result = i;
		}

	}else if (ratio === 1)
	{
		result = quantity | 0;
	}

	if (parseInt(result, 10) != parseFloat(result))
	{
		bIsQuantityFloat = true;
	}

	result = (bUseFloatQuantity === false && bIsQuantityFloat === false) ? parseInt(result, 10) : parseFloat(result).toFixed(4);
	result = correctQuantity(result);
	return result;
}

function correctQuantity(quantity)
{
	return parseFloat((quantity * 1).toString());
}

function reindexBasketItems(){
	/*$('#basket-content tr').each ( function (i) {
		$(this).find('.item_index').text(i+1+'. ');
	});*/
}


/**
 *
 * @param {} params
 */
function recalcBasketAjax(params)
{

	if (basketPoolQuantity.isProcessing())
	{
		return false;
	}

	BX.showWait();



	var property_values = {},
		action_var = BX('action_var').value,
		items = BX('basket_items'),
		delayedItems = BX('delayed_items'),
		postData,
		i;


	postData = {
		'sessid': BX.bitrix_sessid(),
		'site_id': BX.message('SITE_ID'),
		'props': property_values,
		'action_var': action_var,
		'select_props': BX('column_headers').value,
		'offers_props': BX('offers_props').value,
		'quantity_float': BX('quantity_float').value,
		'count_discount_4_all_quantity': BX('count_discount_4_all_quantity').value,
		'price_vat_show_value': BX('price_vat_show_value').value,
		'hide_coupon': BX('hide_coupon').value,
		'use_prepayment': BX('use_prepayment').value
	};

	// console.log(postData);

	postData[action_var] = 'recalculate';
	if (!!params && typeof params === 'object')
	{
		for (i in params)
		{
			if (params.hasOwnProperty(i))
				postData[i] = params[i];
		}
	}

	if (!!items && items.rows.length > 0)
	{
		for (i = 1; items.rows.length > i; i++)
			if (items.rows[i].id > 0){
				postData['QUANTITY_' + items.rows[i].id] = BX('QUANTITY_' + items.rows[i].id).value;
			}
	}

	if (!!delayedItems && delayedItems.rows.length > 0)
	{
		for (i = 1; delayedItems.rows.length > i; i++)
			postData['DELAY_' + delayedItems.rows[i].id] = 'Y';
	}

	basketPoolQuantity.setProcessing(true);
	basketPoolQuantity.clearPool();


	BX.ajax({
		url: '/bitrix/components/bitrix/sale.basket.basket/ajax.php',
		method: 'POST',
		data: postData,
		dataType: 'json',
		onsuccess: function(result)
		{
			//   console.log(result);


			BX.closeWait();
			basketPoolQuantity.setProcessing(false);

			if(params.coupon)
			{
				//hello, gifts!
				if(!!result && !!result.BASKET_DATA && !!result.BASKET_DATA.NEED_TO_RELOAD_FOR_GETTING_GIFTS)
				{
					BX.reload();
				}
			}

			if (basketPoolQuantity.isPoolEmpty())
			{
				updateBasketTable(null, result);
				basketPoolQuantity.updateQuantity();
			}
			else
			{
				basketPoolQuantity.enableTimer(true);
			}


			if(result.BASKET_DATA.BASKET_ITEMS_COUNT == 0) {
				items.style.display = 'none';
				BX('basket_items_button_list').style.display = 'none';
				BX('errortext_area').style.display = 'none';
				BX('cart-inner-area').style.display = 'none';


			}
			else {
				items.style.display = 'table';
				BX('basket_items_button_list').style.display = 'block';
				BX('errortext_area').style.display = 'block';
				BX('cart-inner-area').style.display = 'block';
			}

		}
	});
}

function showBasketItemsList(val)
{
	BX.removeClass(BX("basket_toolbar_button"), "current");
	BX.removeClass(BX("basket_toolbar_button_delayed"), "current");
	BX.removeClass(BX("basket_toolbar_button_subscribed"), "current");
	BX.removeClass(BX("basket_toolbar_button_not_available"), "current");

	BX("normal_count").style.display = 'inline-block';
	BX("delay_count").style.display = 'inline-block';
	BX("subscribe_count").style.display = 'inline-block';
	BX("not_available_count").style.display = 'inline-block';

	if (val == 2)
	{
		if (BX("basket_items_list"))
			BX("basket_items_list").style.display = 'none';
		if (BX("basket_items_delayed"))
		{
			BX("basket_items_delayed").style.display = 'block';
			BX.addClass(BX("basket_toolbar_button_delayed"), "current");
			BX("delay_count").style.display = 'none';
		}
		if (BX("basket_items_subscribed"))
			BX("basket_items_subscribed").style.display = 'none';
		if (BX("basket_items_not_available"))
			BX("basket_items_not_available").style.display = 'none';
	}
	else if(val == 3)
	{
		if (BX("basket_items_list"))
			BX("basket_items_list").style.display = 'none';
		if (BX("basket_items_delayed"))
			BX("basket_items_delayed").style.display = 'none';
		if (BX("basket_items_subscribed"))
		{
			BX("basket_items_subscribed").style.display = 'block';
			BX.addClass(BX("basket_toolbar_button_subscribed"), "current");
			BX("subscribe_count").style.display = 'none';
		}
		if (BX("basket_items_not_available"))
			BX("basket_items_not_available").style.display = 'none';
	}
	else if (val == 4)
	{
		if (BX("basket_items_list"))
			BX("basket_items_list").style.display = 'none';
		if (BX("basket_items_delayed"))
			BX("basket_items_delayed").style.display = 'none';
		if (BX("basket_items_subscribed"))
			BX("basket_items_subscribed").style.display = 'none';
		if (BX("basket_items_not_available"))
		{
			BX("basket_items_not_available").style.display = 'block';
			BX.addClass(BX("basket_toolbar_button_not_available"), "current");
			BX("not_available_count").style.display = 'none';
		}
	}
	else
	{
		if (BX("basket_items_list"))
		{
			BX("basket_items_list").style.display = 'block';
			BX.addClass(BX("basket_toolbar_button"), "current");
			BX("normal_count").style.display = 'none';
		}
		if (BX("basket_items_delayed"))
			BX("basket_items_delayed").style.display = 'none';
		if (BX("basket_items_subscribed"))
			BX("basket_items_subscribed").style.display = 'none';
		if (BX("basket_items_not_available"))
			BX("basket_items_not_available").style.display = 'none';
	}
}

function deleteCoupon(e)
{
	var target = BX.proxy_context,
		value;

	if (!!target && target.hasAttribute('data-coupon'))
	{
		value = target.getAttribute('data-coupon');
		if (!!value && value.length > 0)
		{
			recalcBasketAjax({'delete_coupon' : value});
		}
	}
}

BX.ready(function() {

	basketPoolQuantity = new BasketPoolQuantity();
	var sku_props = BX.findChildren(BX('basket_items'), {tagName: 'li', className: 'sku_prop'}, true),
		i,
		couponBlock;
	if (!!sku_props && sku_props.length > 0)
	{
		for (i = 0; sku_props.length > i; i++)
		{
			BX.bind(sku_props[i], 'click', BX.delegate(function(e){ skuPropClickHandler(e);}, this));
		}
	}
	couponBlock = BX('coupons_block');
	if (!!couponBlock)
		BX.bindDelegate(couponBlock, 'click', { 'attribute': 'data-coupon' }, BX.delegate(function(e){deleteCoupon(e); }, this));

	if (basketJSParams['EVENT_ONCHANGE_ON_START'] && basketJSParams['EVENT_ONCHANGE_ON_START'] == "Y")
	{
		BX.onCustomEvent('OnBasketChange');
	}
});

