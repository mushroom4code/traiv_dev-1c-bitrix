BX.namespace('BX.Sale.PersonalOrderComponent');

(function() {
	BX.Sale.PersonalOrderComponent.PersonalOrderDetail = {
		init : function(params)
		{
			var linkMoreOrderInformation = document.getElementsByClassName('sale-order-detail-more-info-more')[0];
			var linkLessOrderInformation = document.getElementsByClassName('sale-order-detail-more-info-less')[0];
			var clientInformation = document.getElementsByClassName('sale-order-detail-more-info-details')[0];
			var listShipmentWrapper = document.getElementsByClassName('sale-order-detail-payment-options-shipment');
			var listPaymentWrapper = document.getElementsByClassName('sale-order-detail-payment-options-methods');
			var shipmentTrackingId = document.getElementsByClassName('sale-order-detail-shipment-id');

			var orderRepeatLink = document.getElementById('repeat-order');
			var orderRepeatCart = document.getElementById('repeat-cart');
			
			//console.log(orderRepeatLink);

			if (shipmentTrackingId[0])
			{
				Array.prototype.forEach.call(shipmentTrackingId, function(blockId)
				{
					var clipboard = blockId.parentNode.getElementsByClassName('sale-order-detail-shipment-id-icon')[0];
					if (clipboard)
					{
						BX.clipboard.bindCopyClick(clipboard, {text : blockId.innerHTML});
					}
				});
			}



			BX.bind(orderRepeatCart, 'click', function(e){
				e.preventDefault();

				BX.ajax.post(
							params.repeatUrlcart,
							{
								'ajax_call':'y',
								'ORDER_ID':params.repeatUrlNumber
							},
							function(result)
							{
								console.log(result);								
								if (result == 'true') {
									window.location.replace("https://traiv-komplekt.ru/personal/order/make/");
								}
							}
						);

			},this);
			
			BX.bind(orderRepeatLink, 'click', function(e){
				e.preventDefault();

				BX.ajax.post(
							params.repeatUrlorder,
							{
								'ajax_call':'y',
								'ORDER_ID':params.repeatUrlNumber
							},
							function(result)
							{
								if (result == 'true') {
									console.log('new order');
								}
							}
						);

			},this);


			BX.bind(linkMoreOrderInformation, 'click', function()
			{

				clientInformation.style.display = 'flex';
				linkMoreOrderInformation.style.display = 'none';
				linkLessOrderInformation.style.display = 'inline-block';
			},this);
			BX.bind(linkLessOrderInformation, 'click', function()
			{
				clientInformation.style.display = 'none';
				linkMoreOrderInformation.style.display = 'inline-block';
				linkLessOrderInformation.style.display = 'none';
			},this);

			Array.prototype.forEach.call(listShipmentWrapper, function(shipmentWrapper)
			{
				var detailShipmentBlock = shipmentWrapper.getElementsByClassName('sale-order-detail-payment-options-shipment-composition-map')[0];
				var showInformation = shipmentWrapper.getElementsByClassName('sale-order-detail-show-link')[0];
				var hideInformation = shipmentWrapper.getElementsByClassName('sale-order-detail-hide-link')[0];

				BX.bindDelegate(shipmentWrapper, 'click', { 'class': 'sale-order-detail-show-link' }, BX.proxy(function()
				{
					showInformation.style.display = 'none';
					hideInformation.style.display = 'inline-block';
					detailShipmentBlock.style.display = 'flex';
				}, this));
				BX.bindDelegate(shipmentWrapper, 'click', { 'class': 'sale-order-detail-hide-link' }, BX.proxy(function()
				{
					showInformation.style.display = 'inline-block';
					hideInformation.style.display = 'none';
					detailShipmentBlock.style.display = 'none';
				}, this));
			});

			Array.prototype.forEach.call(listPaymentWrapper, function(paymentWrapper)
			{
				var rowPayment = paymentWrapper.getElementsByClassName('sale-order-detail-payment-options-methods-info')[0];

				BX.bindDelegate(paymentWrapper, 'click', { 'class': 'active-button' }, BX.proxy(function()
				{
					BX.toggleClass(paymentWrapper, 'sale-order-detail-active-event');
				}, this));

				BX.bindDelegate(rowPayment, 'click', { 'class': 'sale-order-detail-payment-options-methods-info-change-link' }, BX.proxy(function(event)
				{
					event.preventDefault();

					var btn = rowPayment.parentNode.getElementsByClassName('sale-order-detail-payment-options-methods-button-container')[0];
					var linkReturn = rowPayment.parentNode.getElementsByClassName('sale-order-detail-payment-inner-row-template')[0];
					BX.ajax(
						{
							method: 'POST',
							dataType: 'html',
							url: params.url,
							data:
							{
								sessid: BX.bitrix_sessid(),
								orderData: params.paymentList[event.target.id],
								templateName : params.templateName,
								returnUrl: params.returnUrl,
							},
							onsuccess: BX.proxy(function(result)
							{
								rowPayment.innerHTML = result;
								if (btn)
								{
									btn.parentNode.removeChild(btn);
								}
								linkReturn.style.display = "block";
								BX.bind(linkReturn, 'click', function()
								{
									window.location.reload();
								},this);
							},this),
							onfailure: BX.proxy(function()
							{
								return this;
							}, this)
						}, this
					);

				}, this));
			});
		}
	};
})();
