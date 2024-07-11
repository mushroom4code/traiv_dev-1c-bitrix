<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//*************************************
//show confirmation form
//*************************************
?>
<div class="confirmation">
    <form action="<?=$arResult["FORM_ACTION"]?>" method="get">
        <div class="header-block2"><?echo GetMessage("subscr_title_confirm")?></div>

        <label><?echo GetMessage("subscr_conf_code")?><span></span></label>
        <input autocomplete="off" class="form-control" type="text" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" />
        <div class="btn-group-blue mt-2">
        <input class="btn btn--submit btn-blue submit-button submit-big-text w100 traiv-orange-button" type="submit" name="confirm" value="<?echo GetMessage("subscr_conf_button")?>" />
        </div>
    <div class="date mt-2" style="display:block;"><b><?echo GetMessage("subscr_conf_date")?></b>: <?echo $arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?></div>

                    <?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
    
    <input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
    <?echo bitrix_sessid_post();?>
    </form>
</div>
