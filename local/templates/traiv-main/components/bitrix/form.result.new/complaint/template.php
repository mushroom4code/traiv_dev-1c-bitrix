<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }
    if ($arResult["isFormErrors"] == "Y"){
        echo $arResult["FORM_ERRORS_TEXT"];
    }
    echo $arResult["FORM_NOTE"], str_replace('<form','<form id="complaint-form"', $arResult['FORM_HEADER']);

?>

<h5 class="md-title"><?=$arResult["FORM_TITLE"]?></h5>
<div style="margin: 10px 0;">
    <?=$arResult['FORM_DESCRIPTION']?>
</div>
<div class="row">
    <?
        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
            //die();
            switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                case "text" :
                    ?>
                    <div class="col x1d2 x1d1--m form-control-row">
                        <input placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                               value="<?=$_REQUEST['form_text_' . $arQuestion['STRUCTURE'][0]['ID']] ?>"
                               class="form-control">
                    </div>
                    <?
                    break;
                case "email" :
                    ?>
                    <div class="col x1d2 x1d1--m form-control-row">
                        <input placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="form_email_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                               value="<?=$_REQUEST['form_email_' . $arQuestion['STRUCTURE'][0]['ID']] ?>"
                               class="form-control">
                    </div>
                    <?
                    break;
                case "textarea" :
                    ?>
                    <div class="col x1d1 form-control-row">
                             <textarea placeholder="<?=$arQuestion["CAPTION"]?>"
                                       name="form_textarea_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                                       class="form-control"><?=$_REQUEST['form_textarea_' . $arQuestion['STRUCTURE'][0]['ID']] ?></textarea>
                    </div>
                    <?
                    break;

                case "file" :
                    ?>
                    <div class="col x1d1 x1d1--m form-control-row">
                        <input type="file" placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="form_file_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                               class="form-control">
                    </div>
                    <?
                    break;
                case "hidden" :
                    echo $arQuestion["HTML_CODE"];
                    break;
                case "checkbox" :
                    ?>
                    <div class="col x1d2 x1d1--m form-control-row">
                        <?=$arQuestion["CAPTION"]?>
                        <input type="checkbox"
                               checked
                               name="form_checkbox_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
                    </div>
                    <?
                    break;
            }

        } //endwhile
    ?>
    <input type="hidden" name="web_form_apply" value="Y"/>
    <input type="hidden" name="ajax_mode" value="y">
    <!--
    <input type="hidden" name="antibot" value="">
    -->
    <input id="" class="btn btn--submit" type="submit" onclick="yaCounter18248638.reachGoal('otpravit_zayavky'); return true;" value="<?=GetMessage("FORM_APPLY")?>"/>
</div>
<?=$arResult["FORM_FOOTER"]?>