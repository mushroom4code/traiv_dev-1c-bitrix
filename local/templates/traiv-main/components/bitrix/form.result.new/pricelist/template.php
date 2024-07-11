<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }
    if ($arResult["isFormErrors"] == "Y"){
        //echo $arResult["FORM_ERRORS_TEXT"];
    }
    echo $arResult["FORM_NOTE"], str_replace('<form','<form id="pricelist-form"', $arResult['FORM_HEADER']);

?>
<script>
    $(function() {
        $('[name="phone"], .input_tel').mask("+7 (999) 999 - 99 - 99");
    });
</script>
<h5 class="md-title"><?=$arResult["FORM_TITLE"]?></h5>
<div style="margin: 10px 0;">
    <?=$arResult['FORM_DESCRIPTION']?>
</div>
<div class="row">
    <?

        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {

            switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                case "text" :
                    ?>
                    <div class="col x1d2 x1d1--m form-control-row">
                        <input placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                               value="<?=$_REQUEST['form_text_' . $arQuestion['STRUCTURE'][0]['ID']] ?>"
                               class="form-control <?=($arQuestion["CAPTION"] == "Телефон") ? 'input_tel' : ''?>">
                    </div>
                    <?
                    break;
                case "email" :
                    ?>
                    <div class="col x1d2 x1d1--m form-control-row">
                        <input placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="form_email_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                               value="<?=$_REQUEST['form_email_' . $arQuestion['STRUCTURE'][0]['ID']] ?>"
                               class="form-control form-email">
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
                               name="form_file_<?=$arAnswers[$FIELD_SID][0]['ID']?>"
                               class="form-control">
                    </div>
                    <?
                    break;
                case "hidden" :
                    echo $arQuestion["HTML_CODE"];
                    break;
                case "checkbox" :
                    continue;
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
    <? /*
    if($arResult["isUseCaptcha"] == "Y")
    {
    ?>
    <div class="captcha">
      <?if ($arResult["isFormErrors"] == "Y"):?>
          <?=$arResult["FORM_ERRORS_TEXT"];?>
        <? else: ?>      

        <?endif;?>
        
        
            <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
            <input type="text" class="form-control" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
        </div>
    <div class="clearfix"></div>
    <?
    } // isUseCaptcha
   */ ?>

    <div class="g-recaptcha" data-sitekey="6LekrNYUAAAAABOMKFbne3WrsrtSkmnR_vRoYX6k"></div>

    <td colspan="2" class="license">
        <label><input type="checkbox" name="license" checked="checked" required="required" />Я соглашаюсь на обработку персональных данных в соответствии с<a href="/politika-konfidentsialnosti/" style="margin-left: 3px;">Политикой конфиденциальности</a></label>
    </td>
    <br>
    <br>
                    </div>
    <div class="clearfix"></div>
    <input type="hidden" name="web_form_apply" value="Y"/>
    <input type="hidden" name="ajax_mode" value="y">
    <!--
    <input type="hidden" name="antibot" value="">
    -->
    <input id="sendForm" class="btn btn--submit" onclick="yaCounter18248638.reachGoal ('zakaz_price'); return true;" type="submit" value="Отправить"/>
</div>
<?=$arResult["FORM_FOOTER"]?>
<script src="/local/templates/traiv-main/js/pricelist.js"></script>
