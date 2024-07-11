$(document).ready(function(){

var files;
$('input[type=file]').on('change', function(){
	files = this.files;
	$('.decodeFileUploadError').addClass('d-none');
});

$("body").on("change.bootstrapSwitch", "#decodeUnsearch", function(e){
	console.log(e);
	    var latestData = $('#latestDate').val();
	    var nDecodelist = [];
	    
		$.each( JSON.parse(latestData), function( key, value ){
			if (value.art){
				nDecodelist.push({'dElement': value.true_name});
			}
		});
	    
    	if(e.target.checked == true) {
		    $("#decodeUnsearch").attr("checked", "checked");
		    $.cookie("order_decode_list", JSON.stringify(nDecodelist), {expires: 31, path: '/'});
    	} else {
			$.cookie('order_decode_list', null, {expires: 7, path: '/'});
    	    $("#decodeUnsearch").removeAttr("checked");
    	}
});

$('#uploadDecodeFile').on('click',function(e){

if ($('#decodeFileUpload').get(0).files.length === 0) {
    $('.decodeFileUploadError').removeClass('d-none');
    return false;
}

			var trParentFile = $('#tableResultfile');
			$('#tableResultfile').empty();

$('.decode-preloader-file').animate({'opacity':1},100);
$('.decode-control-block,.decode-button-list,.decode-unsearch-block').addClass('d-none');
	e.stopPropagation();
	e.preventDefault();

	if( typeof files == 'undefined' ) return;

	var data = new FormData();
	
	$.each( files, function( key, value ){
		data.append( key, value );
	});

	data.append( 'action', 'uploadFile' );
	$('.decodeDateArea').remove();
	$.ajax({
		url: '/ajax/decode/ajax.php',
		type        : 'POST',
		data        : data,
		cache       : false,
		dataType    : 'json',
		processData : false,
		contentType : false,
		success     : function( result, status, jqXHR ){

			if( typeof result.error === 'undefined' ){

		  $('.decode-preloader-file').animate({'opacity':0},100, function(){
				
				$('.decode-control-block,.decode-button-list,.decode-unsearch-block').removeClass('d-none');
				
				var returnedData = result;
				
				$.ajax({
					  type: 'POST',
					  url: '/ajax/decode/ajax.php',
					  data: 'artarr=' + JSON.stringify(returnedData),
					  success: function(data){
						  trParentFile.append( data );
						  	//$('.getArtItem' + returnedData[index].art).append( data );
						  }
		  		});				
				 $("#decodeFileUpload").val(null); 
			  });
			}
			else {
				//console.log('ОШИБКА: ' + result.error );
				$('.decode-preloader-file').animate({'opacity':0},100, function(){
					$('.decode-control-block,.decode-button-list,.decode-unsearch-block').addClass('d-none');
					trParentFile.append( '<div class="error-decode">' + result.error + '</div>' );
				}); 
			}
		},
		error: function( jqXHR, status, errorThrown ){
			console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
		}
	});

});


/*load Latest data*/

if ($('#latestDate').length > 0){
	$('.decode-preloader-file').animate({'opacity':1},100);
	var latestData = $('#latestDate').val();
	var trParentFile = $('#tableResultfile');
			$('#tableResultfile').empty();
			
			
			
	$.ajax({
					  type: 'POST',
					  url: '/ajax/decode/ajax.php',
					  data: 'artarr=' + latestData,
					  success: function(data){
						  $('.decode-preloader-file').animate({'opacity':0},100, function(){
							  $('.decode-control-block,.decode-button-list,.decode-unsearch-block').removeClass('d-none');
							  trParentFile.append( data );
							  });
						  
						  	//$('.getArtItem' + returnedData[index].art).append( data );
						  }
		  		});	
}

/*end load Latest data*/

$("body").on("click", "#decode-all-to-basket", function(e){
	e.preventDefault();
	var arrToBasket = [];
	$('.item-decode-file').each(function(i){
		var checkActive = $(this).attr('data-find-res');
		if (checkActive == 'active'){
			var itemID = $(this).find('.catalog-list-line').attr('id');
			arrToBasket.push({'item_id': itemID,'type': 'active','name': 'none'});
		}
		
		if (checkActive == 'none'){
			var itemName = $(this).find('.item-decode-file-truename').attr('data-name');
			arrToBasket.push({'item_id': '','type': 'none','name': itemName});
		}
	});
	
	if (arrToBasket){
		var arrTobsc = JSON.stringify(arrToBasket);
		
		console.log(arrTobsc);
		
		var requestData = $.ajax({
		  type: 'POST',
		  url: '/ajax/decode/tobsc.php',
		  data: 'action=tobsc&data=' + arrTobsc,
		  success: function(result){
			  $.ajax({
       type: "post",
       url: '/',
       data: 'AJAX_CALL=N',
       dataType: "html",
       success: function (html) {
           html = $.parseHTML( html );
           html = $(html).find('#decodeCardNums').html();
           $('#decodeCardNums').html(html);
       }
   });
		  }
		});
		
	}
	
});

$("body").on("click", ".decode-help-link", function(e){
	e.preventDefault();
	$('.help-decode-area').addClass('active');
	$('.decode-upload-area').addClass('active');
	$('.decode-result-area').addClass('active');
});

$("body").on("click", ".decode-close-help", function(e){
	e.preventDefault();
	$('.help-decode-area').removeClass('active');
	$('.decode-upload-area').removeClass('active');
	$('.decode-result-area').removeClass('active');
});


$("body").on("click", ".item-decode-remove", function(e){
	e.preventDefault();
	var id = $(this).attr('data-item-decode-id');
	$('#item-remove' + id).remove();
});

$("body").on("click", ".decode-tags-area-link", function(e){
	e.preventDefault();
	$('.decode-tags-area-link').children('div').removeClass('active');
	$(this).children('div').addClass('active');
	var typeFilter = $(this).attr('data-filter-res');
	console.log('typeFilter=' + typeFilter);
	if (typeFilter == 'all'){
		$('.item-decode-file').removeClass('d-none');
	} else {
		$('.item-decode-file').addClass('d-none');
		$('.item-decode-file[data-find-res=' + typeFilter + ']').removeClass('d-none');
	}
});
	
	$('#decodeForm').on('submit', function(e){
		
		$('#nomeninput').on('focus',function(){
			$(this).removeClass('error');
		});
		
		if($('#nomeninput').val().length == 0){
			$('#nomeninput').addClass('error');
			return false;
		}
		
		//if ($('#nomeninput').val() == 0);
		
		$('#tableResult').empty();
		$('.decode-preloader').animate({'opacity':1},100);
		
		var $form = $(this);
$.post(
'/ajax/decode/ajax.php',
$form.serialize()
)
.done(function(result){
	$('.decode-preloader').animate({'opacity':0},100,function(){
	
	var trParent = $('#tableResult');
	$('#tableResult').empty();
	console.log(result);
	var returnedData = JSON.parse(result);
	if (returnedData.error){
		tr = '<div class="col-12 order-1 position-relative text-center">Доступ запрещен!</div>';
		trParent.append( tr );
	} else {
	var tr = '';
	var standartStr = '';
	$.each(returnedData, function(index,val) {
		
		if (index == 'type'){
			 tr += '<div class="col-2 order-1 position-relative text-center"><div class="position-absolute;top:-50px;"><b>Тип метиза</b></div>' + val + '</div>';
		} else if (index == 'type_standart'){
			standartStr += val + ' ';
			//tr += '<div class="col order-2">' + val + '</div>';
		}
		else if (index == 'standart_name'){
			standartStr += val;
			//tr += '<div class="col order-3">' + val + '</div>';
			tr += '<div class="col-2 order-2 position-relative text-center"><div class="position-absolute;top:-50px;"><b>Стандарт</b></div>' + standartStr + '</div>';
		} else if (index == 'diametr_name'){
			tr += '<div class="col-1 order-4 position-relative text-center"><div class="position-absolute;top:-50px;"><b>Диаметр</b></div>' + val + '</div>';
		}
		else if (index == 'dlina_name'){
			tr += '<div class="col-1 order-5 position-relative text-center"><div class="position-absolute;top:-50px;"><b>Длина</b></div>' + val + '</div>';
		}
		else if (index == 'thread_name'){
			tr += '<div class="col-2 order-8 position-relative text-center"><div class="position-absolute;top:-50px;"><b>Шаг резьбы</b></div>' + val + '</div>';
		}
		else if (index == 'material_name'){
			tr += '<div class="col-2 order-6 position-relative text-center"><div class="position-absolute;top:-50px;"><b>Материал</b></div>' + val + '</div>';
		}
		else if (index == 'coating_name'){
			tr += '<div class="col-2 order-7 position-relative text-center"><div class="position-absolute;top:-50px;"><b>Покрытие</b></div>' + val + '</div>';
		}
		
		});
		trParent.append( tr );
		}
		});	

}).fail(function(){
    console.log("server error");
});
	e.preventDefault();	
		return false;
	});
	
});