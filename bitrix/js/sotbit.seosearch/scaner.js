(function() {
	JSeosearchScaner = function()
	{
		this.actionUrl = '/bitrix/admin/sotbit.seosearch_webmaster_list.php?lang=' + BX.message('LANGUAGE_ID');
		this.started = false;
		this.site_id = '';

		BX.ready(BX.delegate(this.onScanComplete, this));
	};

	JSeosearchScaner.prototype.isStarted = function() {
		return this.started;
	};

	JSeosearchScaner.prototype.initializeScaning = function() {
		this.results = [];
		this.started = true;
		this.setProgress(0);
	};

	JSeosearchScaner.prototype.onScanStart = function() {
		BX.show(BX('status_bar'));
		BX.hide(BX('start_button'));
		BX.hide(BX('first_start'));
	};

	JSeosearchScaner.prototype.onScanComplete = function() {
		BX.show(BX('start_container'));
		BX.show(BX('start_button'));
		BX.show(BX('first_start'));
		BX.hide(BX('status_bar'));
	};

	JSeosearchScaner.prototype.setProgress = function(pProgress) {
		BX('progress_text').innerHTML = pProgress + '%';
		BX('progress_bar_inner').style.width = pProgress + '%';
	};

	JSeosearchScaner.prototype.sendScanRequest = function(pAction, pData, pSuccessCallback, pFailureCallback) {
		var action = pAction || 'scan';
		var data = pData || {};
        var site_id = this.site_id;// || 's1';
		var successCallback = pSuccessCallback || BX.delegate(this.processScaningResults, this);
		var failureCallback = pFailureCallback || function(e){alert(BX.message('SEOSEARCH_FINISH_ERROR_WAIT'));};
		data['action'] = action;
        data['site_id'] = site_id;
		data['sessid'] = BX.bitrix_sessid();
		data = BX.ajax.prepareData(data);
		return BX.ajax({
			method: 'POST',
			dataType: 'json',
			url: this.actionUrl+'&site='+this.site_id,
			data:  data,
			onsuccess: successCallback,
			onfailure: failureCallback
		});
	};

	JSeosearchScaner.prototype.startStop = function(site_id) {
        this.site_id = site_id;

		if (this.isStarted()) {
			this.started = false;
			this.onScanComplete();
		} else {
			this.initializeScaning();
			this.sendScanRequest();
			this.onScanStart();
		}
	};

	JSeosearchScaner.prototype.completeScaning = function() {
		this.onScanComplete();
		this.started = false;
		location.reload();
	};

	JSeosearchScaner.prototype.onRequestFailure = function(pReason) {
		this.onScanComplete();
		this.started = false;
	};

	JSeosearchScaner.prototype.processScaningResults = function(pResponce) {
		if(!this.isStarted()) {
			return;
		}

		if(pResponce == 'ok' || pResponce == 'error') {
			return;
		}

		if(pResponce['all_done'] == 'Y') {
			BX('first_start').innerHTML = BX.message('SEOSEARCH_FINISH_SCAN');
			this.completeScaning();
		} else {
			this.sendScanRequest('scan', {lastID: pResponce['last']});
		}

		if(pResponce['percent']) {
			this.setProgress(pResponce['percent']);
		}
	};
})();