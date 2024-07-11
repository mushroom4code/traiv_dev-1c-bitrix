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
		
		console.log(ws_filter + ' ws_filter ');
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
 		standartId = $(this).val();
 		$('#standartIdcurrent').val(standartId);
 		getDiametrlist(standartId);
 	});
 	
 	function getDiametrlist(standartId){
 	 	console.log(standartId + 'standartId');
 		var requestSlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getDiametr' + '&standartId=' + standartId,
 			  success: function(data){
 				  console.log(typeof(data));
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
 	 	console.log(standartId + 'standartId');
 	 	console.log(diametrId + 'diametrId');
 		var requestDlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getDlina' + '&standartId=' + standartId + '&diametrId=' + diametrId,
 			  success: function(data){
 				  console.log(typeof(data));
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
 	 	console.log(standartId + 'standartId');
 	 	console.log(diametrId + 'diametrId');
 	 	console.log(dlinaId + 'dlinaId');
 		var requestDlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getMaterial&standartId=' + standartId + '&diametrId=' + diametrId + '&dlinaId=' + dlinaId,
 			  success: function(data){
 				  console.log(data);
 				  
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
 	 	console.log(standartId + 'standartId');
 	 	console.log(diametrId + 'diametrId');
 	 	console.log(dlinaId + 'dlinaId');
 	 	console.log(materialId + 'materialId');
 		var requestDlist = $.ajax({
 			  type: 'POST',
 			  url: '/ajax/apicalc/ajax_ws.php',
 			  data: 'action=getValue&standartId=' + standartId + '&diametrId=' + diametrId + '&dlinaId=' + dlinaId + '&materialId=' + materialId,
 			  success: function(data){
 				  console.log(data);
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
	
});