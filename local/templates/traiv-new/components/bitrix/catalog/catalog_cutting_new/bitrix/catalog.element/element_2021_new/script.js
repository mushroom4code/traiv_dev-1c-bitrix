(function (window)
{
	if (!!window.JCItemRS)
	{
		return;
	}

	window.JCItemRS = function (containerId, options)
	{
		if (containerId && options)
		{
			//console.log(options);
			var container = BX(containerId);
			if (container)
			{
				var itemRScont = BX.findChildByClassName(container, options.itemRScont, true);
				var itemRSlink = BX.findChildByClassName(container, options.itemRSlink, true);
				var itemRSmodal = BX.findChildByClassName(container, options.itemRSmodal, true);
				/*var ProductLabelParentImage = BX.findChildByClassName(container, options.imageParentContainerClassName, true);*/
				
				if (/*itemRSlink && */options.itemID && options.sectionID)
				{
					var itemRS = new JCItemRS;
					itemRS.Init(itemRSlink, itemRScont, itemRSmodal, options);
				}
			}
		}
	};

	window.JCItemRS.prototype.Init = function(itemRSlink, itemRScont, itemRSmodal, options)
	{
		this.actionRequestUrl = options.actionRequestUrl;
		this.itemRScont = itemRScont;
		this.itemRSmodal = options.itemRSmodal;
		this.itemID = options.itemID;
		this.sectionID = options.sectionID;
		this.materialID = options.materialID;
		var preloader = document.getElementsByClassName("preloader-rs")[0];
		//console.log(preloader);
		
		
		BX.ajax({
			url: this.actionRequestUrl,
			method: 'POST',
			data: {
				'sessid': BX.bitrix_sessid(),
				'itemID':this.itemID,
				'sectionID':this.sectionID,
				'materialID':this.materialID,
			},
			timeout: 60,
			dataType: 'html',
			processData: true,
			onsuccess: BX.proxy(function(data){
				data = data || {};
				
				    	preloader.style.display = 'none';
				
				this.itemRScont.innerHTML = data;
				
				BX.bindDelegate(
					      document.body, 'mouseover', {className: 'thisitem' },
					      function(e){
					    	  var d = this.getAttribute('data-check-d');
					    	  var l = this.getAttribute('data-check-l');
					    	  var childDivs = document.querySelectorAll('#table_size_list td');
					    	  
					    	  for(var i = 0; i < childDivs.length; i++) {
							    		childDivs[i].setAttribute('style','background-color:white;');
					    	  }
					    	  
					    	  for(var i = 0; i < childDivs.length; i++) {
					    		        var ditem = childDivs[i].getAttribute('data-check-d');
								    	var litem = childDivs[i].getAttribute('data-check-l');
								    	
								    	if (d == ditem || l == litem) {
								    		childDivs[i].setAttribute('style','background-color:#f1f1f1;');
								    	}
					    		}
					    	  /*if(!e)
					            e = window.event;
					         
					         DEMOLoad();
					         return BX.PreventDefault(e);*/
					      }
					   );
	
			/*	if(data.error)
				{
					callbackFailure.apply(this, [data]);
				}
				else if(callbackSuccess)
				{
					callbackSuccess.apply(this, [data]);
				}*/
			}, this),
			onfailure: BX.proxy(function(){
				/*var data = {'error': true, 'text': ''};
					callbackFailure.apply(this, [data]);*/
			}, this)
		});
		
		//вывод по ссылке
		//BX.bind(itemRSlink, 'click', BX.delegate(this.viewTable, this));
	}
	
	window.JCItemRS.prototype.viewTable = function(e)
	{
		/*var modal = document.getElementById(this.itemRSmodal);
		var span = document.getElementsByClassName("modalitemrs-close")[0];
		var itemRSresult = document.getElementsByClassName("item-rs-result")[0];
		
		modal.style.display = "block";

		span.onclick = function() {
			  modal.style.display = "none";
			}
		
		window.onclick = function(event) {
			  if (event.target == modal) {
			    modal.style.display = "none";
			  }
			}
*/
		//console.log(itemRSresult);
		BX.ajax({
			url: this.actionRequestUrl,
			method: 'POST',
			data: {
				'sessid': BX.bitrix_sessid(),
				'itemID':this.itemID,
				'sectionID':this.sectionID,
				'materialID':this.materialID,
			},
			timeout: 60,
			dataType: 'html',
			processData: true,
			onsuccess: BX.proxy(function(data){
				data = data || {};
				this.itemRScont.innerHTML = data;
				//itemRSresult.innerHTML = data;
				
				BX.bindDelegate(
					      document.body, 'mouseover', {className: 'thisitem' },
					      function(e){
					    	  var d = this.getAttribute('data-check-d');
					    	  var l = this.getAttribute('data-check-l');
					    	  var childDivs = document.querySelectorAll('#table_size_list td');
					    	  
					    	  for(var i = 0; i < childDivs.length; i++) {
							    		childDivs[i].setAttribute('style','background-color:white;');
					    	  }
					    	  
					    	  for(var i = 0; i < childDivs.length; i++) {
					    		        var ditem = childDivs[i].getAttribute('data-check-d');
								    	var litem = childDivs[i].getAttribute('data-check-l');
								    	
								    	if (d == ditem || l == litem) {
								    		childDivs[i].setAttribute('style','background-color:#dedede;');
								    	}
					    		}
					    	  /*if(!e)
					            e = window.event;
					         
					         DEMOLoad();
					         return BX.PreventDefault(e);*/
					      }
					   );
	
			/*	if(data.error)
				{
					callbackFailure.apply(this, [data]);
				}
				else if(callbackSuccess)
				{
					callbackSuccess.apply(this, [data]);
				}*/
			}, this),
			onfailure: BX.proxy(function(){
				/*var data = {'error': true, 'text': ''};
					callbackFailure.apply(this, [data]);*/
			}, this)
		});
	}
	

}
)(window);