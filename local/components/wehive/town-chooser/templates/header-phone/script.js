/**
 * Created by Евгений Семашко on 15.09.2016.
 */
$(document).ready(function () {
    $(".location-chooser__dropdown.dropdown-inner li").on("click",function () {

        //достаем название города в сокращенном виде
        $id = $(this).attr("id");
        $cityCode = $id.substring($id.indexOf("loc_")+4);


/*
        $.ajax({
            type: 'POST',
            url: '',
            //data: JSON.stringify(parameters),
            data: '',
            contentType: 'application/json;',
            dataType: 'json',
            cache: false,    
            success: function(data) {
                // do something with ajax data
                
            },
            error:function (xhr, ajaxOptions, thrownError){
                console.log('error...', xhr);
                //error logging
            },
            complete: function(){
                //afer ajax call is completed
            } 
        });*/
return true;
    });
});