<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<!-- <section id="content">-->
    <div class="container">
    
    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>
         <?php 
         $dir = $APPLICATION->GetCurDir();
         $arr_check = explode("/", $dir);
         //print_r($arr_check);
         if(!in_array("orderview",$arr_check)){
         ?>
            
<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1 class="title-mb-0"><span><?$APPLICATION->ShowTitle(false)?></span></h1>
</div>
</div>

        <?php 
         }
        if (!$USER->IsAuthorized()) {
            $vis = "d-none";
            $class = "col-xl-12 col-lg-12 col-md-12";
            $style = "style='padding:0px;'";
        } else {
            $vis = "";
            $class = "col-xl-10 col-lg-10 col-md-10";
            $style = "";
        }
        ?>
    
    <div class="row traiv-new-lk g-0" <?php echo $style;?>>

        <div class="col-12 col-xl-2 col-lg-2 col-md-2 <?php echo $vis;?>">
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
        
        <div class="<?php echo $class;?>">