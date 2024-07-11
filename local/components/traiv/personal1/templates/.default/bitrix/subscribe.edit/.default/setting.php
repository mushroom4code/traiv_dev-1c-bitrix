<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
?>
<div class="settings">
    <form action="<?=$arResult["FORM_ACTION"]?>" method="post">
    <?echo bitrix_sessid_post();?>
        <div class="header-block2"><?echo GetMessage("subscr_title_settings")?></div>
        
        <label>Ваш e-mail <span>*</span></label>
            <input type="text" class="form-control" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" /></p>
                
    <div class="rubrics">
                    <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                            <label><input type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" checked /><?=$itemValue["NAME"]?></label><br />
                    <?endforeach;?>
    </div>
    <div class="text">Будьте в курсе распродаж, новостей отрасли и акций</div>
    <label class="traiv-container-checkbox">
        <input class="checkbox" type="checkbox" name="checkbox" checked="checked">
        <span class="checkbox-custom"></span>
        <span class="label">Я согласен на обработку персональных данных</span>
    </label>

    <input class="traiv-orange-button save-subscribe" type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />

    <input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
    <input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
    <?if($_REQUEST["register"] == "YES"):?>
            <input type="hidden" name="register" value="YES" />
    <?endif;?>
    <?if($_REQUEST["authorize"]=="YES"):?>
            <input type="hidden" name="authorize" value="YES" />
    <?endif;?>
    </form>
</div>
