<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
    use Bitrix\Main\Localization\Loc as Loc;

    Loc::loadMessages(__FILE__);


   switch (strtoupper($arResult["REGION_NAME"])){
       case "САНКТ-ПЕТЕРБУРГ":?>
           <script>
               $(document).ready(function() {
                   //doesn't wait for images, style sheets etc..
                   //is called after the DOM has been initialized 
                   $(".header-phone").hide();
                   $("#header-phone-spb").show();
               });
           </script>
           <?break;
       case "МОСКВА":?>
           <script>
               $(document).ready(function() {
                   //doesn't wait for images, style sheets etc..
                   //is called after the DOM has been initialized
                   $(".header-phone").hide();
                   $("#header-phone-mosca").show();
               });
           </script>
           <?break;
       case "ЕКАТЕРИНБУРГ":?>
           <script>
               $(document).ready(function() {
                   //doesn't wait for images, style sheets etc..
                   //is called after the DOM has been initialized
                   $(".header-phone").hide();
                   $("#header-phone-ekb").show();
               });
           </script>
           <?break;
       default:?>
           <script>
               $(document).ready(function() {
                   //doesn't wait for images, style sheets etc..
                   //is called after the DOM has been initialized
                   $(".header-phone").hide();
                   $("#header-phone-rus").show();
               });
           </script>
<?
       break;
   }
?>
<div class="header-phone" id="header-phone-spb">
<?

    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW"     => "file",
            "EDIT_TEMPLATE"      => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH"               => "/include/spb_tel_1.php"
        ),
        false
    );

?>
</div>
<div class="header-phone" id="header-phone-mosca">
<?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW"     => "file",
            "EDIT_TEMPLATE"      => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH"               => "/include/mosca_phone.php"
        ),
        false
    );
?>
</div>
<div class="header-phone" id="header-phone-ekb">
<?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW"     => "file",
            "EDIT_TEMPLATE"      => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH"               => "/include/ekb_phone.php"
        ),
        false
    );
?>
</div>
<div class="header-phone" id="header-phone-rus">
<?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW"     => "file",
            "EDIT_TEMPLATE"      => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH"               => "/include/rus_phone.php"
        ),
        false
    );
?>
</div>