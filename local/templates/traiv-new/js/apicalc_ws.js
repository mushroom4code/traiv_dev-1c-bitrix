$(document).ready(function(){
	
	//var metizId;
	var standartId;
	var diametrId;
	var dlinaId;
	var materialId;
	//var selectMetiz = $('#metizList');
	var selectStandart = $('#standartList');
	var selectDiametr = $('#diametrList');
	var selectDlina = $('#dlinaList');
	var selectMaterial = $('#materialList');
	
	if ($.cookie('apicalcList')) {
        var apicalcList = $.parseJSON($.cookie("apicalcList"));
    } else {
        var apicalcList = [];
    }
    
    /*$('.print_r').on('click', function() {
        window.print();
    });*/
    
    $("body").on("click", ".download_calc_new", function(e){
		e.preventDefault();
		 $('#getfilecalc').submit();
	});
    
    /*$('.download_calc_new').on('click',function(e){
		console.log('download_calc_new');
		e.preventDefault();
		$('#getfilecalc').submit();
		e.preventDefault();
		
	});*/
    
	$('#calc_favorites').on('click', function() { 
	    if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
		      window.sidebar.addPanel(document.title, window.location.href, '');
		    } else if (window.external && ('AddFavorite' in window.external)) { // IE Favorite
		      window.external.AddFavorite(location.href, document.title);
		    } else if (window.opera && window.print) { // Opera Hotlist
		      this.title = document.title;
		      return true;
		    } else { // webkit - safari/chrome
		      alert('Нажмите ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL') + ' + D для добавления страницы в избранное.');
		    }
	});
    
    $("body").on("click", ".save-api-calc", function(e) {
		e.preventDefault();
		$('.apicalc_tb_area').css('display','block');
		var standartIdText = selectStandart.find(":selected").text();
		var diametrIdText = selectDiametr.find(":selected").text();
		var dlinaIdText = selectDlina.find(":selected").text();
		var materialIdText = selectMaterial.find(":selected").text(); 
		var cSht = $("#calculate-sht").val();
		var cWeight = $("#calculate-weight").val();
		
		//console.log(standartIdText + '//' + diametrIdText + ' // ' + dlinaIdText + '//' + materialIdText + '  //' + cSht + ' // '+cWeight);
		
		if(standartIdText != '' && diametrIdText != '' && dlinaIdText != '' && materialIdText != '' && cSht != '' && cWeight != ''){
		var apicalcListid = Math.floor(Math.random() * 1000) + 1;
		apicalcList.push({'apicalcListid': apicalcListid,'standartIdText': standartIdText, 'diametrIdText': diametrIdText, 'dlinaIdText': dlinaIdText, 'materialIdText': materialIdText, 'cSht': cSht, 'cWeight': cWeight});
		$.cookie("apicalcList", JSON.stringify(apicalcList), {expires: 31, path: '/'});
		
		var apicalcAarrTemp = Object.keys(apicalcList).map(function (key) { return apicalcList[key]; });
		var apicalcAarr = apicalcAarrTemp.reverse();
		var apicalcListResult = $('#apicalcListResult');
		//apicalcListResult.empty();
		//$.each(apicalcAarr, function (index, value) {
		    //console.log(value.apicalcListid);
		    var dataName = standartIdText + ' M' + diametrIdText + '*' + dlinaIdText + ' ' + materialIdText;
		    var apicalcListCol = '<tr data-name="' + dataName + '"><td data-label="Стандарт">' + standartIdText + '</td>'
		    + '<td data-label="Диаметр">' + diametrIdText + '</td>'
		    + '<td data-label="Длина">' + dlinaIdText + '</td>'
		    + '<td data-label="Материал">' + materialIdText + '</td>'
		    + '<td data-label="Количество (шт.)">' + cSht + '</td>'
		    + '<td data-label="Вес (кг.)">' + cWeight + '</td>'
		    + '<td data-label="Позиция" class="text-center"><div class="btn-group-blue"><div class="btn-red btn-small apicalc-id-remove" data-apicalcid = ' + apicalcListid + '><span><i class="fa fa-remove"></i></span></div></div></td></tr>';
		    //+ '<td><a href="#" data-name="' + value.standartIdText + ' M' + value.diametrIdText + '*' + value.dlinaIdText + ' ' + value.materialIdText + '">Это</td>'
		    
			//apicalcListResult.append(apicalcListCol);
			if (apicalcList.length == 1){
				$(apicalcListCol).appendTo(apicalcListResult);
			} else {
				$(apicalcListCol).insertBefore(apicalcListResult.children().first());
			}
			var thisTr = $("div").find("[data-apicalcid='" + apicalcListid + "']").parent().parent().parent(); 
			getPosition(dataName,thisTr);
		//});
		
		}	
	});
	
		function getPosition(nomenPosition,thisTr){
			
						$.ajax({
					  type: 'POST',
					  url: '/ajax/decode/ajax.php',
					  data: 'data=' + nomenPosition + '&strnal=1',
					  success: function(data){
						  
						  $.ajax({
					  type: 'POST',
					  url: '/ajax/decode/ajax.php',
					  data: 'artarr=' + data + '&apicalc=1',
					  success: function(datain){
		$('<tr><td colspan="7">'+ datain +'</td></tr>').insertAfter(thisTr);				  
						  }
		  		});	
						  
						  }
		  		});
	}
	
	
	$("body").on("click", ".apicalc-id-remove", function(e) {
		var tr = $(this).parent().parent().parent();
		var trNext = $(this).parent().parent().parent().next();
		var aid = $(this).attr('data-apicalcid');
		var index = getArrayIndexForKey(apicalcList, "apicalcListid", aid);
		if (aid > 0 && index >= 0) {
		 apicalcList = $.grep(apicalcList, function (e) {
	     	return e.apicalcListid != aid;
	     });
	     $.cookie("apicalcList", JSON.stringify(apicalcList), {expires: 31, path: '/'});
	     tr.remove();
	     trNext.remove();
	     if (apicalcList.length == 0){
			 $('.apicalc_tb_area').css('display','none');
		 }
	 }
	});
	
	   function getArrayIndexForKey(arr, key, val) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][key] == val)
                return i;
        }
        return -1;
    }
	
	$('.apicalc-area-link').on('click',function(e){
		e.preventDefault();
		if($(this).hasClass('active')){
			$('.apicalc-area').stop().animate({'left':-500},300,'easeInOutQuint',function(){
				$('.apicalc-area-link').removeClass('active');			
			});
		} else {
			$('.apicalc-area').stop().animate({'left':0},300,'easeInOutQuint',function(){
				$('.apicalc-area-link').addClass('active');			
			});
		}
	});
	
	$("body").on("keyup input", "#searchStandartcalc", function() {
		$(this).val($(this).val().replace(/[,]/g, '.'));
		var ws_filter = $(this).val().toLowerCase();
		var len_filter = $(this).val().toLowerCase().length;
		
		if (len_filter > 0) {
				$("#standartList .standart-calc-name").each( function(){
	 	   		       var $this = $(this);
	 	   		       var value = $this.attr( "data-filter-val" ).toLowerCase(); //convert attribute value to lowercase
	 	   		       if (value.length > 0)
	 	   		    	   {
	 	   		       if (value.includes( ws_filter ))
	 	   		    	   {
	 	   		    	   	$this.css('display','block');
	 	   		    	   
	 	   		    	   }
	 	   		       else
	 	   		    	   {
	 	   		    	   	$this.css('display','none');
	 	   		    	   }
	 	   		    	   }
	 	   		    });
		} else {
			$("#standartList .standart-calc-name").css('display','block');
		}
		
	});
	
 	var requestMlist = $.ajax({
		  type: 'POST',
		  url: '/ajax/apicalc/ajax_ws.php',
		  data: 'action=run',
		  success: function(data){
			  //console.log(typeof(data));	
			  var returnedData = JSON.parse(data);
			  	$.each(returnedData, function(key, value) {
			  		$('<option>').val(value.id).addClass('standart-calc-name').text(value.name).attr('data-filter-val',value.name).appendTo(selectStandart);     
			    });
		  }
		});
 	
 	/*$("body").on("change", '#metizList', function(e) {
		 e.preventDefault();
 		metizId = $(this).val();
 		$('#metizIdcurrent').val(metizId);
 		getStandartlist(metizId);
 	});
 	
 	function getStandartlist(metizId){
 	 	console.log(metizId + 'metizId');
 		var requestSlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax.php',
 			  data: 'action=getStandart&metizId=' + metizId,
 			  success: function(data){
 				  console.log(typeof(data));
 				 selectStandart
 			    .find('option')
 			    .remove();
 				 
 				  var returnedData = JSON.parse(data);
 				  	//$('<option>').val("0").text("Стандарт").appendTo(selectStandart);    
 				  	$.each(returnedData, function(key, value) {
 				  		$('<option>').val(value.id).text(value.name).appendTo(selectStandart);     
 				    });
 				selectStandart.prop("disabled", false);    
 				
 					standartId = $("#standartList option:first").val();
 				    $('#standartIdcurrent').val(standartId);
 					getDiametrlist(metizId,standartId);
 				
 			  }
 			});
 	}*/
 	
 	$("body").on("change", '#standartList', function(e) {
		 e.preventDefault();
		 ym(18248638,'reachGoal','calman');
 		standartId = $(this).val();
 		$('#standartIdcurrent').val(standartId);
 		getDiametrlist(standartId);
 	});
 	
 	function getDiametrlist(standartId){
 		var requestSlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getDiametr' + '&standartId=' + standartId,
 			  success: function(data){
 				  //console.log(typeof(data));
 				 selectDiametr
 			    .find('option')
 			    .remove();
 				 
 				  var returnedData = JSON.parse(data);
 				  	//$('<option>').val("0").text("Диаметр").appendTo(selectDiametr);    
 				  	$.each(returnedData, function(key, value) {
 				  		$('<option>').val(value.id).text(value.name).appendTo(selectDiametr);     
 				    });
 				    selectDiametr.prop("disabled", false);
 				    
 				    diametrId = $("#diametrList option:first").val();
 				    $('#diametrIdcurrent').val(diametrId);
 					getDlinalist(standartId,diametrId);
 			  }
 			});
 	}
 	
 	$("body").on("change", '#diametrList', function(e) {
		 e.preventDefault();
 		diametrId = $(this).val();
 		$('#diametrIdcurrent').val(diametrId);
 		getDlinalist(standartId,diametrId);
 	});
 	
 	function getDlinalist(standartId,diametrId){
 		var requestDlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getDlina' + '&standartId=' + standartId + '&diametrId=' + diametrId,
 			  success: function(data){
 				  //console.log(typeof(data));
 				 selectDlina
 			    .find('option')
 			    .remove();
 				 
 				  var returnedData = JSON.parse(data);
 				  	//$('<option>').val("0").text("Длина").appendTo(selectDlina);    
 				  	$.each(returnedData, function(key, value) {
 				  		$('<option>').val(value.id).text(value.name).appendTo(selectDlina);     
 				    });
 				    selectDlina.prop("disabled", false);
 				    
 				    dlinaId = $("#dlinaList option:first").val();
 				    $('#dlinaIdcurrent').val(dlinaId);
 					getMateriallist(standartId,diametrId,dlinaId);
 			  }
 			});
 	}
 	
 	$("body").on("change", '#dlinaList', function(e) {
		 e.preventDefault();
 		dlinaId = $(this).val();
 		$('#dlinaIdcurrent').val(dlinaId);
 		getMateriallist(standartId,diametrId,dlinaId);
 	});
 	
 	function getMateriallist(standartId,diametrId,dlinaId){
 		var requestDlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getMaterial&standartId=' + standartId + '&diametrId=' + diametrId + '&dlinaId=' + dlinaId,
 			  success: function(data){
 				  //console.log(data);
 				  
 				 selectMaterial
 			    .find('option')
 			    .remove();
 				  var returnedData = JSON.parse(data);
 				  	//$('<option>').val("0").text("Материал").appendTo(selectMaterial);    
 				  	$.each(returnedData, function(key, value) {
 				  		$('<option>').val(value.id).text(value.name).appendTo(selectMaterial);     
 				    });
 				    selectMaterial.prop("disabled", false);
 				    
 				    materialId = $("#materialList option:first").val();
 				    $('#materialIdcurrent').val(materialId);
 					getValue(standartId,diametrId,dlinaId,materialId);
 					
 			  }
 			});
 	}
 	
	$("body").on("change", '#materialList', function(e) {
		e.preventDefault();
 		materialId = $(this).val();
 		$('#materialIdcurrent').val(materialId);
 		$('#calculate-sht,#calculate-weight').prop("disabled", false);
 		getValue(standartId,diametrId,dlinaId,materialId);
 	});
 	
 	 	function getValue(standartId,diametrId,dlinaId,materialId){
 		var requestDlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getValue&standartId=' + standartId + '&diametrId=' + diametrId + '&dlinaId=' + dlinaId + '&materialId=' + materialId,
 			  success: function(data){
 				  //console.log(data);
 				  $('#resultval').val(data);
 				  $('#calculate-sht,#calculate-weight').prop("disabled", false);
 				  getCalculateResultWeight();
 				  /*
 				 selectMaterial
 			    .find('option')
 			    .remove();
 				  var returnedData = JSON.parse(data);
 				  	$('<option>').val("0").text("Материал").appendTo(selectMaterial);    
 				  	$.each(returnedData, function(key, value) {
 				  		$('<option>').val(value.id).text(value.name).appendTo(selectMaterial);     
 				    });
 				    selectMaterial.prop("disabled", false);*/
 			  }
 			});
 	}

		$("body").on("keyup input blur", "#calculate-weight, #calculate-sht", function(e){
			 $(this).val($(this).val().replace(/[,]/g, '.'));
			 var val = $(this).val();
			    if(isNaN(val)){
			         val = val.replace(/[^0-9\.]/g,'');
			         if(val.split('.').length>2) 
			             val = val.replace(/\.+$/,"");
			    }
			    $(this).val(val); 
		});
 	
$("body").on("keypress keyup blur",'#calculate-sht', function (e) {
	getCalculateResultWeight();
});

function getCalculateResultWeight(){
	var mainVal = $("#resultval").val();
	var calculateSht = $("#calculate-sht").val();
	var val = calculateSht*mainVal/1000;
	var res = Number(val.toFixed(3));
	//$kol_vo_stock = round();
	$("#calculate-weight").val(res);
	
	}
	
$("body").on("keypress keyup blur",'#calculate-weight', function (e) {
	getCalculateResultSht();
});

function getCalculateResultSht(){
	var mainVal = $("#resultval").val();
	var calculateWeight = $("#calculate-weight").val();
	
	var val = calculateWeight/mainVal*1000;
	var res = Number(val.toFixed(0));
	//$kol_vo_stock = round();
	$("#calculate-sht").val(res);
	
	}
	
	if($('.apicalc_tb').length > 0){
		
		$('#apicalcListResult tr').each(function(index, value){
			var nomen = $(this).attr('data-name');
			var thisTr = $(this);
			getPosition(nomen,thisTr);
		});
	}
	
	
});