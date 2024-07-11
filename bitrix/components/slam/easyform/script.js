if (typeof JCEasyForm !== 'undefined' && $.isFunction(JCEasyForm)) {

    console.log('reconnection attempt JCEasyForm');

} else {
    
    var JCEasyForm = function(arParams) {
        if (typeof arParams === 'object') {
            if(!window.jQuery) {
                console.log('Form error: Connect jQuery');
                return false;
            }
            this.form = $('#' + arParams.FORM_ID);
            if(arParams.SHOW_MODAL == 'Y'){
                this.modalSuccess = $('#frm-modal-' + arParams.FORM_ID);
            }
            this.isModalSuccess = false;

            this.modalForm = $('#modal' + arParams.FORM_ID);
            this.isModalForm = false;
            this.params = arParams;
            JCEasyForm.prototype.init(this);
        }
    };

    JCEasyForm.prototype.init = function (_this) {

        if (!_this.form.length) {
            console.log('Form error: ID form no search. Specify the form ID in the easyform.');
            return false;
        }

        if(!window.jQuery) {
            console.log('Form error: Connect jQuery');
            return false;
        }


        if (_this.params.SEND_AJAX && !window.jQuery.ajax) {
            console.log('Form error: Connect jQuery ajax');
            return false;
        }


        if(_this.params.SHOW_MODAL == 'Y' && _this.modalSuccess.length){
            if($.fn.modal){
                _this.isModalSuccess = true;
            } else {
                console.log('Form error: the bootstrap library is not connected. You can connect the bootstrap library in the easyform configuration.');
            }
        }

        if(_this.modalForm.length){
            if($.fn.modal){
                _this.isModalForm = true;
            } else {
                console.log('Form error: the bootstrap library is not connected. You can connect the bootstrap library in the easyform configuration.');
            }
        }

        if(_this.params.FORM_SUBMIT && _this.modalForm.length){
			if($.fn.modal){
				_this.modalForm.modal('show');
			}else {
                console.log('Form error: the bootstrap library is not connected. You can connect the bootstrap library in the easyform configuration.');
            }
        }

        if(!_this.form.find('.alert-success').hasClass('hidden')) {
            setTimeout(function () {
                _this.form.find('.alert-success').addClass('hidden');
            }, 4000);
        }


        _this.switchSelect();

        if (_this.params.USE_CAPTCHA) {
            _this.captcha();
        }

        if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
            if (_this.params.USE_FORM_MASK_JS == 'Y') {
                try {

                    Inputmask({
                        oncomplete: function () {
                            if($(this).attr('required')) {
                                _this.form.data('bootstrapValidator').updateStatus($(this).attr('name'), 'VALID', null);
                            }
                        }, onincomplete: function () {
                            if($(this).attr('required')) {
                                _this.form.data('bootstrapValidator').updateStatus($(this).attr('name'), 'INVALID', null);
                            }
                        }, onKeyValidation: function (key, result) {
                            if (result) {
                                if($(this).attr('required')) {
                                    _this.form.data('bootstrapValidator').updateStatus($(this).attr('name'), 'NOT_VALIDATED', null);
                                }
                            }
                        }
                    }).mask(_this.form.find('[data-inputmask-mask]'));

                } catch (e) {
                    console.log('error inputmask');
                }
            }
        } else if (_this.params.USE_FORM_MASK_JS == 'Y') {

            try{
                Inputmask({clearIncomplete: true }).mask(_this.form.find('[data-inputmask-mask]'));
            } catch(e) {
                console.log('error inputmask');
            }
        }

		function padTo2Digits(num) {
			  return num.toString().padStart(2, '0');
			}

			function formatDate(date) {
			  return (
			    [
			     padTo2Digits(date.getDate()),
			     padTo2Digits(date.getMonth() + 1),
			      date.getFullYear(),
			      ].join('.') +
			    ' ' +
			    [
			      padTo2Digits(date.getHours()),
			      padTo2Digits(date.getMinutes()),
			      padTo2Digits(date.getSeconds()),
			    ].join(':')
			  );
			}
        
        if (_this.params.SEND_AJAX) {
            if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
                _this.form.bootstrapValidator().on('success.form.bv', function (e) {

                    e.preventDefault();

                    if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
                        if (!_this.form.data('bootstrapValidator').isValid()) {
                            return false;
                        }
                    }
                    
                    try {

						grecaptcha.ready(function () {
                            grecaptcha.execute(_this.params['RECAPTCHA_V3_KEY'], {action: 'submit'}).then(function (token) {

                        var dataParams = _this.form.serializeArray();
                        var oldParams = _this.params['OLD_PARAMS'];
                        for( var i in oldParams ) {
                            dataParams.push({name: 'arParams[' + i + ']', value: oldParams[i]});
                        }
						dataParams.push({name: 'token', value: token}, {name: 'action', value: 'submit'});
                        _this.form.find('.submit-button').addClass('spinner');

                        $.ajax({
                            type: 'POST',
                            url: _this.params.TEMPLATE_FOLDER,
                            data: dataParams,
                            success: function (data) {
                                data = JSON.parse(data);
                                if (data.result === 'ok') {
                                	
                                	//console.log('this' + _this.params.FORM_ID);
                                	
                                	if (_this.params.FORM_ID === 'FORM3') {
                                		ym(18248638,'reachGoal','otpravit_zayavky');	
                                		
                                		var callt_list = [];

                                		$.each(dataParams, function(i) {

                                		     if(this.name === "FIELDS[TITLE]"){ 
                                		    	 callt_list.push({'fio': this.value}); 
                                		     } else if (this.name === "FIELDS[PHONE]") {
                                		    	 callt_list.push({'phoneNumber': this.value}); 
                                		     } else if (this.name === "FIELDS[EMAIL]") {
                                		    	 callt_list.push({'email': this.value}); 
                                		     } else if (this.name === "FIELDS[MESSAGE]") {
                                		    	 callt_list.push({'comment': this.value}); 
                                		     }
                                		});
                                		
                                		if (callt_list) {
                                			
                                			var unix = Math.round(+new Date()/1000);
                                			var dformat = formatDate(new Date());
                                			var ct_site_id = '52033';
                                			var ct_data = {             
                                			fio: callt_list[0].fio,
                                			phoneNumber: callt_list[2].phoneNumber,
                                			email: callt_list[1].email,
                                			subject: 'Отправить запрос',
                                			//requestNumber: unix,
                                			requestDate: dformat,
                                			tags: location.hostname,
                                			comment: callt_list[3].comment,
                                			requestUrl: location.href,
                                			sessionId: window.ct('calltracking_params','qpdnl9xy').sessionId
                                			};
                                			jQuery.ajax({  
                                			  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',      
                                			  dataType: 'json',         
                                			  type: 'POST',          
                                			  data: ct_data
                                			});
                                			
                                		}                                		
                                	}
                                	
                                	if (_this.params.FORM_ID === 'FORM4') {	
                                		
                                		var callt_list = [];

										ym(18248638,'reachGoal','optcena');

                                		$.each(dataParams, function(i) {
                                			//console.log(this.name + ' ---- ' +this.value);
                                		     if(this.name === "FIELDS[TITLE]"){
                                		    	 callt_list.push({'fio': this.value}); 
                                		     } else if (this.name === "FIELDS[PHONE]") {
                                		    	 callt_list.push({'phoneNumber': this.value}); 
                                		     } else if (this.name === "FIELDS[EMAIL]") {
                                		    	 callt_list.push({'email': this.value}); 
                                		     } else if (this.name === "FIELDS[MESSAGE]") {
                                		    	 callt_list.push({'comment': this.value}); 
                                		     }
                                		});
                                		
                                		if (callt_list) {
                                			var unix = Math.round(+new Date()/1000);
                                			var dformat = formatDate(new Date());
                                			var ct_site_id = '52033';
                                			var ct_data = {             
                                			fio: callt_list[0].fio,
                                			phoneNumber: callt_list[2].phoneNumber,
                                			email: callt_list[1].email,
                                			subject: 'Оптовая цена',
                                			//requestNumber: unix,
                                			requestDate: dformat,
                                			tags: location.hostname,
                                			comment: callt_list[3].comment,
                                			requestUrl: location.href,
                                			sessionId: window.ct('calltracking_params','qpdnl9xy').sessionId
                                			};
                                			jQuery.ajax({  
                                			  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',      
                                			  dataType: 'json',         
                                			  type: 'POST',          
                                			  data: ct_data
                                			});
                                			
                                		}
                                	}
                                	
                                	if (_this.params.FORM_ID === 'FORM44') {
											ym(18248638,'reachGoal','wrdir');
									}
									if (_this.params.FORM_ID === 'FORM20') {
											ym(18248638,'reachGoal','import');
									}
                                	
                                	if (_this.params.FORM_ID === 'FORM15') {	
                                		
                                		var callt_list = [];

                                		$.each(dataParams, function(i) {
                                			//console.log(this.name + ' ---- ' +this.value);
                                		     if(this.name === "FIELDS[TITLE]"){
                                		    	 callt_list.push({'fio': this.value}); 
                                		     } else if (this.name === "FIELDS[PHONE]") {
                                		    	 callt_list.push({'phoneNumber': this.value}); 
                                		     } else if (this.name === "FIELDS[EMAIL]") {
                                		    	 callt_list.push({'email': this.value}); 
                                		     } else if (this.name === "FIELDS[MESSAGE]") {
                                		    	 callt_list.push({'comment': this.value}); 
                                		     }
                                		});
                                		
                                		//console.log(callt_list);
                                		
                                		if (callt_list) {
                                			var unix = Math.round(+new Date()/1000);
                                			var dformat = formatDate(new Date());
                                			var ct_site_id = '52033';
                                			var ct_data = {             
                                			fio: callt_list[0].fio,
                                			phoneNumber: callt_list[2].phoneNumber,
                                			email: callt_list[1].email,
                                			subject: 'Откликнуться на вакансию',
                                			//requestNumber: unix,
                                			requestDate: dformat,
                                			tags: location.hostname,
                                			comment: callt_list[3].comment,
                                			requestUrl: location.href,
                                			sessionId: window.ct('calltracking_params','qpdnl9xy').sessionId
                                			};
                                			jQuery.ajax({  
                                			  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',      
                                			  dataType: 'json',         
                                			  type: 'POST',          
                                			  data: ct_data
                                			});
                                			
                                		}
                                	}
                                	/*заявки с лендинга производства*/
                                	if (_this.params.FORM_ID === 'FORM109' || _this.params.FORM_ID === 'FORM110') {	
                                		ym(18248638,'reachGoal','prodrecall');
                                		
                                		var callt_list = [];

                                		$.each(dataParams, function(i) {
                                		     if(this.name === "FIELDS[TITLE]"){
                                		    	 callt_list.push({'fio': this.value}); 
                                		     } else if (this.name === "FIELDS[PHONE]") {
                                		    	 callt_list.push({'phoneNumber': this.value}); 
                                		     } else if (this.name === "FIELDS[EMAIL]") {
                                		    	 callt_list.push({'email': this.value}); 
                                		     }
                                		});

                                		if (callt_list) {
                                			var unix = Math.round(+new Date()/1000);
                                			var dformat = formatDate(new Date());
                                			var ct_site_id = '52033';
                                			var ct_data = {             
                                			fio: callt_list[0].fio,
                                			phoneNumber: callt_list[1].phoneNumber,
                                			email: callt_list[2].email,
                                			subject: 'Заявка с лендинга производство',
                                			//requestNumber: unix,
                                			requestDate: dformat,
                                			tags: location.hostname,
                                			comment: '',
                                			requestUrl: location.href,
                                			sessionId: window.ct('calltracking_params','qpdnl9xy').sessionId
                                			};
                                			jQuery.ajax({  
                                			  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',      
                                			  dataType: 'json',         
                                			  type: 'POST',          
                                			  data: ct_data
                                			});
                                			
                                		}
                                	}
                                	/*end заявки с лендинга производства*/
                                	
                                	
                                    try {
                                        var funcName = _this.params._CALLBACKS;
                                        if (funcName) {
                                            eval(funcName)(data);
                                        } else {
                                            _this._showMessage(true, data.message);
                                        }
                                    } catch (e) {
                                        _this._showMessage(true, data.message);
                                    }

                                    setTimeout(function () { _this.form.find('.alert').addClass('hidden'); }, 4000);

                                    _this._resetForm();
                                } else {
                                    _this._showMessage(false, data.message);
                                }
                                _this.form.find('.submit-button').removeClass('spinner');
                                _this.form.find('[disabled="disabled"]').removeAttr('disabled');

                            },
                            error: function () {
                                _this._showMessage(false);
                            }
                        });
                            });
                        });
                    } catch (e) {
                        console.log('error ajax');
                    }

                    return false;

                });
            } else {
                _this.form.on('submit', function (e) {
                    e.preventDefault();

                    if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
                        if (!_this.form.data('bootstrapValidator').isValid()) {
                            return false;
                        }
                    }


                    try {

                        _this.form.find('.submit-button').addClass('spinner');

                        var dataParams = _this.form.serializeArray();
                        var oldParams = _this.params['OLD_PARAMS'];
                        for( var i in oldParams ) {
                            dataParams.push({name: 'arParams[' + i + ']', value: oldParams[i]});
                        }

                        $.ajax({
                            type: 'POST',
                            url: _this.params.TEMPLATE_FOLDER,
                            data: dataParams,
                            success: function (data) {
                                data = JSON.parse(data);
                                if (data.result === 'ok') {

                                console.log('this1' + _this.params.FORM_ID);
                                	
                                	if (_this.params.FORM_ID === 'FORM5') {
                                		ym(18248638,'reachGoal','obrtzv');
                                		
                                	/*	var callt_list = [];

                                		$.each(dataParams, function(i) {

                                		     if(this.name === "FIELDS[TITLE]"){ 
                                		    	 callt_list.push({'fio': this.value}); 
                                		     } else if (this.name === "FIELDS[PHONE]") {
                                		    	 callt_list.push({'phoneNumber': this.value}); 
                                		     }
                                		});
                                		
                                		
                                		
                                		if (callt_list) {
                                			var unix = Math.round(+new Date()/1000);
                                			var dformat = formatDate(new Date());
                                			var ct_site_id = '52033';
                                			var ct_data = {             
                                			fio: callt_list[0].fio,
                                			phoneNumber: callt_list[1].phoneNumber,
                                			email: '',
                                			subject: 'Заказать звонок',
                                			requestNumber: unix,
                                			requestDate: dformat,
                                			tags: '',
                                			comment: '',
                                			requestUrl: location.href,
                                			sessionId: window.ct('calltracking_params','qpdnl9xy').sessionId
                                			};
                                			jQuery.ajax({  
                                			  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',      
                                			  dataType: 'json',         
                                			  type: 'POST',          
                                			  data: ct_data
                                			});
                                			
                                		}
                                		*/
                                		
                                	}
                                	
                                	if (_this.params.FORM_ID === 'FORM44') {
											ym(18248638,'reachGoal','wrdir');
									}
									if (_this.params.FORM_ID === 'FORM20') {
											ym(18248638,'reachGoal','import');
									}
                                	
                                	if (_this.params.FORM_ID === 'FORM12') {	
                                		
                                		var callt_list = [];

                                		$.each(dataParams, function(i) {

                                		     if(this.name === "FIELDS[Ваше Имя]"){
                                		    	 callt_list.push({'fio': this.value}); 
                                		     } else if (this.name === "FIELDS[Телефон для связи]") {
                                		    	 callt_list.push({'phoneNumber': this.value}); 
                                		     } else if (this.name === "FIELDS[Ваш комментарий]") {
                                		    	 callt_list.push({'comment': this.value}); 
                                		     }
                                		});
                                		
                                		if (callt_list) {
                                			var unix = Math.round(+new Date()/1000);
                                			var dformat = formatDate(new Date());
                                			var ct_site_id = '52033';
                                			var ct_data = {             
                                			fio: callt_list[1].fio,
                                			phoneNumber: callt_list[2].phoneNumber,
                                			email: '',
                                			subject: 'Заявка на производство',
                                			//requestNumber: unix,
                                			requestDate: dformat,
                                			tags: location.hostname,
                                			comment: callt_list[0].comment,
                                			requestUrl: location.href,
                                			sessionId: window.ct('calltracking_params','qpdnl9xy').sessionId
                                			};
                                			jQuery.ajax({  
                                			  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',      
                                			  dataType: 'json',         
                                			  type: 'POST',          
                                			  data: ct_data
                                			});
                                			
                                		}
                                		
                                		
                                	}
                                	
                                    try {
                                        var funcName = _this.params._CALLBACKS;
                                        if (funcName) {
                                            eval(funcName)(data);
                                        } else {
                                            _this._showMessage(true, data.message);
                                        }
                                    } catch (e) {
                                        _this._showMessage(true, data.message);
                                    }


                                    _this._resetForm();
                                } else {
                                    _this._showMessage(false, data.message);
                                }
                                _this.form.find('.submit-button').removeClass('spinner');
                                _this.form.find('[disabled="disabled"]').removeAttr('disabled');

                            },
                            error: function () {
                                _this._showMessage(false);
                            }
                        });

                    } catch (e) {
                        console.log('error ajax');
                    }

                    return false;
                });
            }
        }  else {
            if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
                _this.form.bootstrapValidator().on('success.form.bv', function (e) {
                    if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
                        if (!_this.form.data('bootstrapValidator').isValid()) {
                            return false;
                        }
                    }
                });
            }
        }
    };

    JCEasyForm.prototype.captcha = function () {

        var _this = this;
        var captchaCallback = function (response) {

            if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
                if (response !== undefined) {
                    $('input[name="captchaValidator"]').val(1);
                } else {
                    $('input[name="captchaValidator"]').val('');
                }

                _this.form.bootstrapValidator('updateStatus', "captchaValidator", 'NOT_VALIDATED').bootstrapValidator('validateField', "captchaValidator");
            }
        };
        try {

            setTimeout(function () {
                grecaptcha.render(_this.params.FORM_ID + '-captchaContainer', {
                    'sitekey': _this.params.CAPTCHA_KEY,
                    'callback': captchaCallback,
                    'expired-callback': captchaCallback
                });
            }, 9500);

        } catch (e) {

        }

    };

    JCEasyForm.prototype._showMessage = function (status, message) {

        var alert,
            alertSuccess,
            alertDanger,
            serverMessage,
            modalTitle;

        alert = this.form.find('.alert');
        if (status === undefined || !alert.length) {
            return false;
        }
        alertSuccess = alert.filter('.alert-success');
        alertDanger = alert.filter('.alert-danger');

        if (status === true) {
            alert.addClass('hidden');
            if (this.isModalSuccess) {
                if(this.isModalForm)
                    this.modalForm.modal('hide');

                if(message){
                    this.modalSuccess.find('.ok-text').html(message);
                }

                if (!this.modalSuccess.hasClass('in'))
                    this.modalSuccess.addClass('in');
                this.modalSuccess.modal('show');
            } else {
                serverMessage = message || alertSuccess.data('message');
                alertSuccess.html(serverMessage);
                alertSuccess.removeClass('hidden');
            }
            function countdown() {
                location.href = '#w-form__close';
            }
            setInterval(function(){ countdown(); },5000);
        } else if (status === false) {
            alert.addClass('hidden');
            serverMessage = message || alertDanger.data('message');

            alertDanger.html(serverMessage);
            alertDanger.removeClass('hidden');
        } else {
            alert.addClass('hidden');
        }

    };

    JCEasyForm.prototype._resetForm = function () {
        var _this = this;

        setTimeout(function () {
            if (_this.params.USE_FORMVALIDATION_JS == 'Y') {
                _this.form.data('bootstrapValidator').resetForm(true);
            }
            _this.form[0].reset();

            var switchSelects = _this.form.find('.switch-select');
            switchSelects.find('select').trigger('refresh');

            if (_this.params.USE_CAPTCHA) {
                try {
                    grecaptcha.reset();
                } catch (e) {

                }

            }
            var fileArea = _this.form.find('.file-extended');
            if (fileArea.length) {
                fileArea.find('.file-placeholder-tbody').html('');
                _this.form.find('.file-selectdialog-switcher').attr('style', '');
                fileArea.parent().find('input[type="hidden"]').remove();
            }
        }, 1000);

    };

    JCEasyForm.prototype.switchSelect = function () {
        // switch select
        var switchSelects = this.form.find('.switch-select');

        if (switchSelects.length) {

            var _this = this;
            switchSelects.each(function () {
                var self = $(this);
                var parent = self.find('.switch-parent');
                var child = self.find('.switch-child');
                var btnBack = self.find('.btn-switch-back');
                var select = self.find('select');
                if (select.length && btnBack.length && child.length && parent.length) {
                    select.on('change', function () {
                        var optionSelected = select.find('option:selected');
                        var dataSwitch = optionSelected.data('switch');
                        if (dataSwitch !== undefined) {
                            parent.addClass('hidden');
                            child.removeClass('hidden');
                        }
                    });
                    btnBack.on('click', function (e) {
                        e.preventDefault();
                        parent.removeClass('hidden');
                        child.addClass('hidden');
                        select.find('option').eq(0).prop('selected', true);
                        setTimeout(function () {
                            select.trigger('refresh');
                        }, 1);
                    });

                    _this.form.on('reset', function () {
                        parent.removeClass('hidden');
                        child.addClass('hidden');
                        select.find('option').eq(0).prop('selected', true);
                        setTimeout(function () {
                            select.trigger('refresh');
                        }, 1);
                    });
                }
            });
        }
    };

}