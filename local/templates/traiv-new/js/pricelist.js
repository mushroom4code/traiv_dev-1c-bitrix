// (function(){
//
//     var params = {};
//     params.selector = "#pricelist-form";
//     $(document).on('submit', params.selector, function(event){
//         $(params.selector).off('submit');
//         event.preventDefault();
//
//         /*Send*/
//         var formData = $(params.selector).serialize();
//         var request = {};
//         request.type = "POST";
//         request.url = '/ajax/forms/pricelist.php';
//         //request.url = window.location;
//         request.data = formData;
//         request.dataType = 'html';
//         request.success = function(response){
//             $(params.selector).html(response);
//         };
//         $.ajax(request);
//
//         return false;
//     });
// })(jQuery);

// Проверка правильности ввода EMAIL
 function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

(function(){
    
    $(document).ready(function() {
        //$oneClickForm.submit(function(event){
    	
        /*section filter-filex search*/
        $(".section-filter-ttl-search-input-filex").on('keyup input',function(e) {
    	    e.preventDefault();
        	var rel_filter = $(this).attr('rel');
        	var ws_filter = $(this).val().toLowerCase();
        	var len_filter = $(this).val().toLowerCase().length;
    	        	if (len_filter > 0) {
        
        		$("#section-filter-block-" + rel_filter + " .section-filter-field-filex").each( function(){
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
        		$("#section-filter-block-" + rel_filter + " .section-filter-field-filex").css('display','block');
        	}
    	});
        /*end section filter-filex search*/
        

        
    	var download_price = false;
    	$("body").on("click", "#download_price", function(e) {
    		e.preventDefault();
    		if ($('input[name="standart[]"]:checked').length == 0) {
    			$('#filex-standart-note').css('opacity','1');
    		} else {
    			$('#filex-standart-note').css('opacity','0');
    			download_price = true;
    		}
    		
    		setTimeout(function(){
    			$('#filex-standart-note').animate({'opacity':0},300);
    		}, 2000);
    		
    		if (download_price == true) {
    			$(this).closest('form').submit();
    			/*if (ym(18248638,'reachGoal','get_items_list')) {
    				console.log('Отправлено');
    			} else {
    				console.log('Не Отправлено');
    			}*/
    		}
    	});
    	
        $("body").on("click", "#pricelist-form .btn-blue.submit-button", function() {
            var $oneClickForm = $("#pricelist-form");
            
            // Проверка на заполненность полей
            var stop = false;
            var callt_list = [];
            $("#pricelist-form .form-control").each(function() {

            	if ($(this).hasClass("form-email")) {
                    if (isValidEmailAddress($(this).val())) {
                        $(this).removeClass("f-input-error");
                        //console.log($(this).attr('name'));
                        callt_list.push({'email': $(this).val()}); 
                    } else {
                        $(this).addClass("f-input-error");
                        stop = true;
                    }
                } else { 
                    if ($(this).val() == '') {
                        $(this).addClass("f-input-error");
                        stop = true;
                    } else {
                    	//console.log($(this).attr('name'));
                    	
                    	  if($(this).attr('name') === "form_text_11"){
             		    	 callt_list.push({'fio': $(this).val()}); 
             		     } else if($(this).attr('name') === "form_text_13"){
             		    	 callt_list.push({'phoneNumber': $(this).val()}); 
             		     } else if($(this).attr('name') === "form_textarea_15"){
             		    	 callt_list.push({'comment': $(this).val()}); 
             		     }
                    	
                        $(this).removeClass("f-input-error");
                    }
                }
                //return false;
            });
            
            // Проверка согласия
            if ($("#pricelist-form input[type=checkbox]").prop("checked")) {
                $("#pricelist-form input[type=checkbox]").closest("div").css("color", "#000");
            } else {
                $("#pricelist-form input[type=checkbox]").closest("div").css("color", "red");
                stop = true;
            }
            
            if (stop) {
                return false;
            }
            //return false;

            //$oneClickForm.off('submit');
            event.preventDefault();
            $.ajax(
                {
                    type : "POST",
                    url: '/ajax/forms/pricelist.php',
                    data: $oneClickForm.serialize(),
                    success: function(response){
                        $oneClickForm.closest("div").html(response);
                        
                      //  console.log(callt_list);
                        
                        
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
                        
                		if (callt_list) {
                			var unix = Math.round(+new Date()/1000);
                			var dformat = formatDate(new Date());
                			var ct_site_id = '52033';
                			var ct_data = {             
                			fio: callt_list[0].fio,
                			phoneNumber: callt_list[2].phoneNumber,
                			email: callt_list[1].email,
                			subject: 'Заказать прайс-лист',
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
                }
            );
        });
    });
})();