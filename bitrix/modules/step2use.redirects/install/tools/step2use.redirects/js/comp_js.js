BX.ready(function() {
    var requestUri = location.pathname;
    
    BX.ajax({   
        url: '/bitrix/tools/step2use.redirects/s2u_composite_ajax.php',
        data: {
            requestUri: requestUri
        },
        method: 'GET',
        dataType: 'json',
        timeout: 10,
        onsuccess: function(response){
            console.log("response !!! ", response);
            if(response.newUrl){
                location.href = response.newUrl;
            }
        }
    });
    
});
/*
$(document).ready(function(){
    var requestUri = location.pathname;
    $.ajax({
        dataType: "json",
        url: '/bitrix/tools/step2use.redirects/s2u_composite_ajax.php',
        data: {
            requestUri: requestUri
        },
        success: function (response) {
            if(response.newUrl){
                location.href = response.newUrl;
            }
        }
    });

});*/