/**
 * Created by Евгений Семашко on 15.09.2016.
 */
$(document).ready(function () {
    $(".location-chooser__dropdown.dropdown-inner li").on("click",function () {

        //достаем название города в сокращенном виде
        $id = $(this).attr("id");
        $cityCode = $id.substring($id.indexOf("loc_")+4);

        $(".header-phone").hide();
        $("#header-phone-"+$cityCode).show();
    });
});