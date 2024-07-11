<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="location-chooser dropdown">
    <a href="#" class="iconed iconed--left2 location-chooser__current dropdown-toggle"><span class="location"><?=$arResult["REGIONS"][$arResult["SELECTED"]]["CITY"]?></span><i class="icon icon--location"></i></a>
    <div class="location-chooser__dropdown dropdown-inner">
        <ul class="u-clear-list">
            <? foreach ($arResult["REGIONS"] as $code => $arItem): ?>
                <li id="loc_<?=$code?>"><a href="#"><?=$arItem["CITY"]?></a></li>
            <? endforeach; ?>
        </ul>
    </div>
</div>

<? if (SHOW_PHONE != "1") {?>
<? $this->SetViewTarget('region-select-phone');?>
    <?
    define("SHOW_PHONE", "1");
    ?>
    <? foreach ($arResult["REGIONS"] as $code => $arItem): 
        $style = ($code == $arResult["SELECTED"]) ? '' : 'style="display: none"'?>
        <a href="tel:<?=$arItem["LINK_PHONE"]?>" class="header-phone" id="header-phone-<?=$code?>" <?=$style?>><?=$arItem["PHONE"]?></a>
    <? endforeach; ?>
<? $this->EndViewTarget(); ?>
<? }?>