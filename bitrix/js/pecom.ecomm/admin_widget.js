// 2.8.70

BX.addCustomEvent('onAjaxSuccess', addblock);
BX.addCustomEvent('onAjaxSuccess', checkError);

BX.addCustomEvent('onAjaxFailure', callbackError);
BX.addCustomEvent('onAjaxFailure', checkError);

var pecomEcomm = {
    widget: {
        url: null,
        loadTimeout: 30,
        isLoad: false,
        isChangeLocation: false,
        location: '',
        address: '',
        isLoadFail: false,
        isFirstLoad: true,
    },
    cost: '',
    days: '',
    cost_out: 0,
    addressSelected: 0,
    addressFieldNode: '',
    isDeliveryPec: false,
    isDeliveryLoad: false,
    callbackFunction: function(data) {
        this.widget.isLoad = true;

        $('#old_delivery_price').val(data.price);
        $('#pec_cost_out').val(pecomEcomm.params.PEC_COST_OUT);
        $('#pec_to_address').val(data.toAddress);
        $('#pec_address').val(data.toAddress);
        $('#pec_address_1').val(data.toAddress);

        $('#pec_widget_data').val(JSON.stringify(data));

        let marginPrice = '';

        if (pecomEcomm.params.MAIN.marginType === '%') {
            marginPrice = parseFloat(pecomEcomm.params.MAIN.marginValue/100 * data.price);
        } else {
            if(pecomEcomm.params.MAIN.marginValue === null){
                pecomEcomm.params.MAIN.marginValue = 0;
            }
            marginPrice = parseFloat(pecomEcomm.params.MAIN.marginValue);
        }

        $('#pec_price').val(data.price + marginPrice);
        $('#pec_price_1').val(data.price + marginPrice);

        $('#pec_address_txt').html(this.widget.address);
    },
    callbackError(error) {
        try {
            if (!this.widget.isLoad) {
                // pecomEcomm.widget.isLoadFail = true;
                this.widget.isLoad = true;
                $('#bx-soa-order-form').append('<input type="hidden" id="pec_cost_delivery_error" name="pec_cost_delivery_error" value="Y">');
            }
        } catch (e) {
        }
        checkError();
    },
    hidePecCostBloks: function() {
        // $('.bx-soa-pp-price').html('');
        // $('.bx-soa-pp-list-description').html('');
        // $('.bx-soa-price-free').html('');
        // $('.bx-soa-pp-company.bx-selected .bx-soa-pp-delivery-cost').html('');
        // $('.bx-soa-cart-total .bx-soa-cart-d').hide();
        // $('.bx-soa-cart-total:first .bx-soa-cart-d:first').show();
        // $('.bx-soa-cart-total:last .bx-soa-cart-d:first').show();
    },
    replacePecCostBloks: function() {
        if (pecomEcomm.isDeliveryPec) {
            let cost_text = (pecomEcomm.params.cost_text) ? this.cost_out + '<br>' + pecomEcomm.params.cost_text : this.cost;
            let totalPrice = $('#bx-soa-total .bx-soa-cart-total-line-total .bx-soa-cart-d').text();
            let cost_title = (pecomEcomm.params.cost_title) ? totalPrice + ' ' + '<br><span style="color: #257210;font-size: 14px;" ">'+pecomEcomm.params.cost_title+'</span>' : totalPrice;
            $('.bx-soa-price-free').html(cost_text);
            $('#bx-soa-total .bx-soa-cart-total-line-total .bx-soa-cart-d').html(cost_title);
        }

        $('.bx-soa-pp-company #ID_DELIVERY_ID_'+localStorage.getItem("deliveryId")).parent().find('.bx-soa-pp-delivery-cost').html(this.cost_out);
        $('.bx-soa-pp-company #ID_DELIVERY_ID_'+localStorage.getItem("deliveryId")).parent().parent().find('.bx-soa-pp-delivery-cost').html(this.cost_out);
        $('.bx-soa-cart-total .bx-soa-cart-d').show();
    },
    isChecked: false,
    params: {},
    isWidgetReload: false,
};

function checkError(a = null, b = null, c = null) {
    // Если выбрана другая доставка

    // Если виджет загрузился без ошибок
    if (!pecomEcomm.widget.isLoadFail) {
        return;
    }

    // Подписываем кнопки на событие
    document.querySelectorAll('.bx-soa-editstep, .btn').forEach(element => {
        element.addEventListener('click', checkError);
    });
}

function callbackError(a = null, b = null, c = null) {
    pecomEcomm.callbackError(a);
}

function showError()
{
}



function addblock(a,b,c) {
    if (!a.hasOwnProperty('order')) return;

    a.order.DELIVERY.forEach(delivery => {
        if (delivery.hasOwnProperty('CALCULATE_ERRORS') && delivery.IS_PEC_DELIVERY === 'Y') {
            pecomEcomm.callbackError(a);
        }
    })

    if (pecomEcomm.widget.isLoadFail) {
        hideHtmlBlockDeliveryPec();
        pecomEcomm.callbackError(a);
        return;
    }

    if (a.order.hasOwnProperty('ORDER_PROP')) {
        for (var key in a.order.ORDER_PROP.properties) {
            if (a.order.ORDER_PROP.properties[key].CODE == 'ADDRESS') {
                pecomEcomm.addressFieldNode = '#soa-property-' + a.order.ORDER_PROP.properties[key].ID;
            } else if (a.order.ORDER_PROP.properties[key].CODE == 'FLAT_NUM') {
                pecomEcomm.apartmentFieldNode = '#soa-property-' + a.order.ORDER_PROP.properties[key].ID;
            }
        }
    }

    if (document.querySelector('pecomEcomm-delivery-widget')) return;

    if (a.order.hasOwnProperty('DELIVERY')) {
        a.order.DELIVERY.forEach(function (item) {
            if (item.hasOwnProperty('CHECKED') && item.CHECKED == 'Y') {
                let ID = parseInt(item.ID);
                let deliveryId = parseInt(localStorage.getItem("deliveryId"));
                if (ID === deliveryId) {
                    pecomEcomm.isDeliveryPec = true;
                    pecomEcomm.isDeliveryLoad = true;
                    pecomEcomm.isChecked = true;
                    $('#pec_address_selected').val(0);
                    let address = pecomEcomm.widget.address.split(', кв./офис ')[0];
                    $(pecomEcomm.addressFieldNode).val(address).prop('readonly', true);
                    let apartment = pecomEcomm.widget.address.split(', кв./офис ')[1];
                    $(pecomEcomm.apartmentFieldNode).val(apartment).prop('readonly', true);
                } else {
                    $(pecomEcomm.addressFieldNode).prop('readonly', false);
                    $(pecomEcomm.apartmentFieldNode).prop('readonly', false);
                    pecomEcomm.isDeliveryPec = false;
                    pecomEcomm.isDeliveryLoad = false;
                    pecomEcomm.isChecked = false;
                }
            }
        });
    }

    if (a.hasOwnProperty('locations')) {
        for (let key in a.locations) {
            if (a.locations[key].lastValue) {
                if (pecomEcomm.widget.location && pecomEcomm.widget.location !== a.locations[key].lastValue) {
                    pecomEcomm.widget.location = a.locations[key].lastValue;
                    pecomEcomm.widget.isChangeLocation = true;
                } else {
                    pecomEcomm.widget.isChangeLocation = false;
                    pecomEcomm.widget.location = a.locations[key].lastValue;
                }
            } else {
                pecomEcomm.widget.location = 'empty';
            }
        }
    }

    if (!pecomEcomm.isDeliveryPec && $('#bx-soa-delivery').attr('data-visited')) {
        hideHtmlBlockDeliveryPec();
        // hidePecPickup();
    } else {
        addHtmlBlockDeliveryPec();
    }

    if (!pecomEcomm.isDeliveryLoad && (pecomEcomm.isChecked || pecomEcomm.widget.isChangeLocation))
        addHtmlBlockDeliveryPec();
    pecomEcomm.isWidgetReload = false;
}

function pecomEcommParamsAjax()
{
    $.ajax({
        url: '/bitrix/js/pecom.ecomm/ajax.php',
        type: 'post',
        data: {method: 'orderParams', sessid: BX.bitrix_sessid()},
        async: false,
        success: function (data) {
            if (data === '' || data === 'null') {
                pecomEcomm.callbackError(data);
                pecomEcomm.params = null;
                return;
            }
            pecomEcomm.params = JSON.parse(data);
            if (pecomEcomm.params) {
                localStorage.setItem('deliveryId', pecomEcomm.params.deliveryId);
                pecomEcomm.widget.url = pecomEcomm.params.WIDGET_URL;
                pecomEcomm.options = pecomEcomm.params.options;
            }
        },
        error: function (error) {
            pecomEcomm.callbackError(error);
        }
    });
}

function addHtmlBlockDeliveryPec() {
    pecomEcommParamsAjax();

    if (pecomEcomm.params == null) {
        pecomEcomm.callbackError(pecomEcomm.params);
    }

    if (pecomEcomm.params) {
        let toAddress = pecomEcomm.params.ADDRESS;
        let costOut = pecomEcomm.params.PEC_COST_OUT;
        let pecPrice = '';
        let pecDays = '';

        let addressText = pecomEcomm.params.hasOwnProperty('text') ? pecomEcomm.params.text.address : '';
        let addressToText = pecomEcomm.params.hasOwnProperty('text') ? pecomEcomm.params.text.address_to : '';
        let changeText = pecomEcomm.params.hasOwnProperty('text') ? pecomEcomm.params.text.change : '';
        let termText = pecomEcomm.params.hasOwnProperty('text') ? pecomEcomm.params.text.term : '';
        let btnText = pecomEcomm.params.hasOwnProperty('text') ? pecomEcomm.params.text.btn : '';
        let errorText = pecomEcomm.params.hasOwnProperty('text') ? pecomEcomm.params.text.error : '';

        let src = widgetGetSrcPEC();

        let txt = `
        <div id="bx-soa-pickupPEK-hidden" class="bx-soa-section">
        <div class="bx-soa-section-title-container d-flex justify-content-between align-items-center flex-nowrap">
        <div class="bx-soa-section-title col-sm-9">
        <span class="bx-soa-section-title-count"></span>${addressText}
        </div>
        <div class="col-xs-12 col-sm-3 text-right"><a href class="bx-soa-editstep">${changeText}</a></div>
        </div>
        
        <div class="bx-soa-section-content">
        
        <div style="clear: both;"></div>
        
        </div>
        </div>
    `;
        let txt_h = `
        <div id="bx-soa-pickupPEK" class="bx-soa-section bx-active" data-visited="true" style="flex-shrink: inherit; display: none">
            <div class="bx-soa-section-title-container d-flex justify-content-between align-items-center flex-nowrap">
                <div class="bx-soa-section-title col-sm-9">
                    <span class="bx-soa-section-title-count"></span>${addressText}
                </div>
                <div class="col-xs-12 col-sm-3 text-right">
                    <a href="javascript:void(0);" onclick="toggleIframe()" class="bx-soa-editstep">${changeText}</a>
                </div>
            </div>
            
            <div class="bx-soa-section-content">
                <input type="hidden" id="pec_type" name="pec_type" value="">
                <input type="hidden" id="pec_price" name="pec_price" value="${pecPrice}">
                <input type="hidden" id="pec_days" name="pec_days" value="${pecDays}">
                <input type="hidden" id="pec_to_address" name="pec_to_address" value="">
                <input type="hidden" id="pec_widget_data" name="pec_widget_data" value="">
                <input type="hidden" id="pec_to_uid" name="pec_to_uid" value="">
                <input type="hidden" id="pec_last_select_to_uid" name="pec_last_select_to_uid" value="">
                <input type="hidden" id="pec_to_type" name="pec_to_type" value="">
                <input type="hidden" id="pec_address_selected" name="pec_address_selected" value="${pecomEcomm.addressSelected}">
                
                <div class="pec__hidden-block">
                    <span>${addressToText}<span id="pec_address_txt"> </span></span><br>
                    <span>${termText}<span id="pec_days_txt">${pecDays}</span></span>
                </div>
                <div class="pec__show-block">`;

        if (pecomEcomm.params.PEC_SHOW_TYPE_WIDGET !== 'modal') {
            txt_h +=
                `<iframe id="pecWidjetOrig" src='${(src)}' width="100%" height="552" frameborder="0"></iframe>`;
        }
        txt_h +=
            `</div>
            <div style="clear: both;"></div>
            </div>
            </div>`;

        let modal ='';
        let txt_btn = '';

        if (pecomEcomm.params.PEC_SHOW_TYPE_WIDGET == 'modal') {
            txt_btn = `
            <div id="PEC_BTN" style="display: block">
                <div>
                    <a href="javascript:void(0);" id="pec_widget_btn" class="btn-default" onclick="selectPVZ(); return false;" style="white-space: normal;">${btnText}</a><br>
                    <span id="pec_address_pvz">${pecomEcomm.widget.address}</span><br>
                </div>
            </div>`;

            modal = `
            <div id="pec_modal_label" onclick="modalCloseActive()" style="width: 100%; height: 100%; opacity: 0.8; position: fixed; z-index: 1000; background-color: black; display: none; top: 0; padding: 5px;"></div>
            <div id="pec_pvz" style="position: fixed; z-index: 1001; display: none; background-color: white; padding: 10px;width: 100%; max-width: 1200px; left: 0; right: 0; margin: auto;">
                <div id="apiship_head">
                    <div id="modal_close" style="position: absolute; right: 15px; z-index: 1000; cursor: pointer; font-size: 30px; color: #8c8b8b;" onclick="modalCloseActive()">×</div>
                    <div style="clear: both;"></div>
                </div>
                <div class="pec__show-block_modal">`;
            if (pecomEcomm.params.PEC_SHOW_TYPE_WIDGET == 'modal')
                modal +=`<iframe id="pecWidjetModal" src='${(src)}' width="100%" height="552" frameborder="0"></iframe>`;
            modal +=
                `</div>
            </div>`;
        }

        if (pecomEcomm.widget.isChangeLocation) {
            $('#pec_pvz').remove();
            $('body').append(modal);
            $('#bx-soa-pickupPEK').remove();
            $('#bx-soa-delivery').after(txt_h);
            initBlockPec();
            if (pecomEcomm.isDeliveryLoad) {
                $('#bx-soa-pickupPEK').show();
            }
        }

        if (!$('#pec_pvz').length && pecomEcomm.params.PEC_SHOW_TYPE_WIDGET == 'modal') {
            $('body').append(modal);
        }
        if (!$('#bx-soa-pickupPEK').length) {
            $('#' + pecomEcomm.params.options.ID_FOR_INSERT_AFTER_PEC_PICKUP_BLOCK).after(txt_h);
            initBlockPec();
        }

        if (!$('#bx-soa-pickupPEK-hidden').length) {
            $('#bx-soa-delivery-hidden').after(txt);
        }

        if (pecomEcomm.widget.isFirstLoad) {
            let widgetListener = window.addEventListener('message', (event) => {
                if (pecomEcomm.widget.isLoadFail || !event.data.hasOwnProperty('pecDelivery')) {
                    return;
                }
                if (event.data.pecDelivery.hasOwnProperty('result')) {
                    if (pecomEcomm.widget.lock && event.data.pecDelivery.result.toAddress != pecomEcomm.widget.address) {
                        pecomEcomm.widget.lock = false;
                        return;
                    }
                    pecomEcomm.callbackFunction(event.data.pecDelivery.result);
                }
                if (event.data.pecDelivery.hasOwnProperty('error')) {
                    pecomEcomm.widget.lock = false;
                    pecomEcomm.callbackError(event.data.pecDelivery.error);
                }
            });
            setTimeout(function () {
                if (!pecomEcomm.widget.isLoad && !pecomEcomm.widget.isLoadFail) {
                    pecomEcomm.widget.isLoadFail = true;
                    widgetListener = null;
                    pecomEcomm.callbackError(errorText);
                }
            }, pecomEcomm.widget.loadTimeout * 1000);

            pecomEcomm.widget.isFirstLoad = false;
        }

        if (!$('#bx-soa-pickupPEK').hasClass('bx-active') && pecomEcomm.isDeliveryLoad) {
            $('#bx-soa-pickupPEK').addClass('bx-active');
            $('#bx-soa-pickupPEK').show();
        }

        if (pecomEcomm.params.PEC_SHOW_TYPE_WIDGET == 'modal' && pecomEcomm.isDeliveryLoad) {
            hideHtmlBlockDeliveryPec();

            if ($('#bx-soa-delivery .bx-soa-pp .bx-soa-pp-company.bx-selected .bx-soa-pp-company-description').length) {
                $('#bx-soa-delivery .bx-soa-pp .bx-soa-pp-company.bx-selected .bx-soa-pp-company-description').after(txt_btn);
            } else {
                $('#bx-soa-delivery .bx-soa-pp-desc-container .bx-soa-pp-company .bx-soa-pp-company-block').eq(0).append(txt_btn);
                $('#bx-soa-delivery-hidden .bx-soa-pp-desc-container .bx-soa-pp-company .bx-soa-pp-company-block').eq(0).append(txt_btn);
            }
        }

        if (costOut) {
            pecomEcomm.replacePecCostBloks();
            if (pecomEcomm.isDeliveryLoad) {
                $('#bx-soa-delivery .bx-soa-pp-price').html(pecomEcomm.cost_out);
            }
        }
    }
}

function selectPVZ () {
    $('#pec_pvz').css({'top' : (window.innerHeight - 700) / 2}).show();
    $('#pec_modal_label').show();
}

function modalClose () {
    $('#pec_pvz').hide();
    $('#pec_modal_label').hide();
}

function widgetGetAddressPEC() {
    let input = $('#pec_address')[0];
    if (input) {
        return encodeURI(input.value);
    } else {
        return pecomEcomm.widget.address
            ? encodeURI(ppecomEcomm.widget.address)
            : encodeURI(pecomEcomm.params.ADDRESS)
    }
}

function widgetGetSrcPEC() {
    let urlPecWidget = pecomEcomm.widget.url;
    let toAddress = widgetGetAddressPEC();
    let fromAddress = pecomEcomm.params.FROM_ADDRESS;
    let price = pecomEcomm.params.PRICE;
    let volume = pecomEcomm.params.VOLUME;
    let weight = pecomEcomm.params.WEIGHT;
    let selfPack = pecomEcomm.params.SELF_PACK;
    let fromType = pecomEcomm.params.FROM_TYPE === 'store' ? 1 : 0;
    let dimensions = pecomEcomm.params.DIMENSION;
    let transportationType;

    switch (pecomEcomm.params.transportationType) {
        case 'avia':
        case 'easyway':
            transportationType = pecomEcomm.params.transportationType;
            break;
        default:
            transportationType = 'auto'
            break;
    }

    let addressType = 'department';
    try {
        addressType = $('#pec_to_type').val();
    } catch (e) {}
    if (!addressType) {
        addressType = 'department';
    }

    let departmentUid = ''
    try {
        departmentUid = $('#pec_last_select_to_uid').val();
        if (!departmentUid || departmentUid === '') {
            departmentUid = $('#pec_to_uid').val();
        }
    } catch (e) {}
    if (!departmentUid) {
        departmentUid = '';
    }

    let deliveryParams;

    if (addressType === 'address') {
        deliveryParams = '&delivery=1&address-to=' + toAddress;
        if (!!departmentUid) {
            deliveryParams += '&department-to-uid=' + departmentUid;
        }
    } else if (!departmentUid) {
        deliveryParams = '&delivery=0&address-to=' + toAddress;
    } else {
        deliveryParams = '&delivery=0&address-to=' + toAddress + '&department-to-uid=' + departmentUid;
    }

    let src = urlPecWidget +
        '?address-from=' + fromAddress +
        '&department-from-uid=' + pecomEcomm.params.FROM_DEPARTMENT_UID +
        '&intake=' + fromType +
        deliveryParams +
        '&weight=' + weight +
        '&volume=' + volume +
        '&width=' + dimensions.WIDTH +
        '&height=' + dimensions.HEIGHT +
        '&length=' + dimensions.LENGTH +
        '&declared-amount=' + price +
        '&packing-rigid=' + selfPack +
        '&transportation-type=' + transportationType +
        '&auto-run=1' +
        '&hide-price=1' +
        '&hide-terms=1' +
        '&margin_value=' + pecomEcomm.params.MAIN.marginValue +
        '&margin_type=' + pecomEcomm.params.MAIN.marginType +
        '&inn=' + pecomEcomm.params.INN +
        '&kpp=' + pecomEcomm.params.KPP
    ;
    return src;
}

function modalCloseActive () {
    pecomEcomm.widget.lock = true;
    modalClose();

    $('#pec_pvz iframe').attr('src', widgetGetSrcPEC());
}

function hideHtmlBlockDeliveryPec() {
    if ($('#bx-soa-pickupPEK').length) {
        $('#bx-soa-pickupPEK').hide();
        $('#bx-soa-pickupPEK').removeClass('bx-active');
    }
}

function initBlockPec () {
    BX.Sale.OrderAjaxComponentExt.getBlockFooterPec($('#bx-soa-pickupPEK .bx-soa-section-content'));
    if (pecomEcomm.params.PEC_SHOW_TYPE_WIDGET != 'show')
        $('#bx-soa-pickupPEK .pec__show-block').hide();
}

function toggleIframe() {
    event.stopImmediatePropagation();
    $('#bx-soa-pickupPEK .pec__show-block').toggle();
}

BX.ready(function() {
    if (pecomEcomm.isChecked)
        addHtmlBlockDeliveryPec();
});
