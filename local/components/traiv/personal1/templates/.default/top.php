<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<div class="content traiv-personal-default <?=$arResult["TEMPLATE"]?>">
    <div class="container">
        <div class="left">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "left",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "personal",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "personal",
                    "USE_EXT" => "N"
                ),
                $component
           );?>
        </div>
        <div class="right">