<?
$sendButtonValue = strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ?
  GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];
$sendButtonValue = htmlspecialcharsbx($sendButtonValue);

$userNameInputPlaceholder = 'Имя';
$phoneInputPlaceholder = 'Телефон';

$userNameInputName = 'form_text_4';
$phoneInputName = 'form_text_5';
$elementInputName = 'form_text_6';

$formClassAttribute = "js-validate'";
$formIDAttribute = "";
$stringToBeReplaced = "<form";
$stringToBeReplacing = "<form $formIDAttribute $formClassAttribute";
$arResult['FORM_HEADER'] = str_replace(
	$stringToBeReplaced, 
	$stringToBeReplacing, 
	$arResult['FORM_HEADER']
);
?>

<script>
    $(function() {
        $('[name="phone"], .input_tel').mask("+7 (999) 999 - 99 - 99");
    });
</script>
<?=$arResult["FORM_HEADER"]?>

  <input type="hidden" name="web_form_apply" value="Y" />
  <input type='hidden' name='<?=$elementInputName?>' value="<?=$arParams['ELEMENT_ID']?>">
  <h5 class="md-title"><?=$arResult["FORM_TITLE"]?></h5>
  <p>Перезвоним и уточним информацию по телефону</p>

  <div class="form-control-row">
    <div class="col x1d2 x1d1--m form-control-row">
      <input 
        type="text" 
        placeholder="<?=$userNameInputPlaceholder?>" 
        name="<?=$userNameInputName?>" 
        value="<?=$arResult["arrVALUES"]["form_text_4"]?>" 
        class="form-control">
    </div>

    <div class="col x1d2 x1d1--m form-control-row">
      <input 
        type="text" 
        placeholder="<?=$phoneInputPlaceholder?>" 
        name="<?=$phoneInputName?>" 
        value="<?=$arResult["arrVALUES"]["form_text_5"]?>" 
        class="form-control input_tel">
    </div>
    <div class="col x1d1 x1d1--m form-control-row">
      <input 
        type="text" 
        placeholder="E-mail" 
        name="form_email_31" 
        value="<?=$arResult["arrVALUES"]["form_email_31"]?>" 
        class="form-control form-email">
    </div>
      
          <? /*
    if($arResult["isUseCaptcha"] == "Y")
    {
    ?>
      <?if ($arResult["isFormErrors"] == "Y"):?>
          <?=$arResult["FORM_ERRORS_TEXT"];?>
        <? else: ?>      

        <?endif;?>
        
        <div class="col x1d2 x1d1--m form-control-row">
            <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
        </div>
        <div class="col x1d2 x1d1--m form-control-row">
            <input type="text" class="form-control" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
        </div>
    <?
    } // isUseCaptcha
   */ ?>
      <div class="g-recaptcha" data-sitekey="6LekrNYUAAAAABOMKFbne3WrsrtSkmnR_vRoYX6k"></div>
      <br>
            <div class="clearfix"></div>
    <div class="form-control-row">
      <button 
      type='submit' onclick="yaCounter18248638.reachGoal ('buy_cheaper'); return true;"
      value="<?=$sendButtonValue?>"
      name='web_form_submit'
      class="btn btn--submit"><?=$sendButtonValue?></button>
    </div>

      <td colspan="2" class="license">
          <label><input type="checkbox" name="license" checked="checked" required="required" />Я соглашаюсь на обработку персональных данных
              <br>в соответствии с<a href="/politika-konfidentsialnosti/" style="margin-left: 3px;">Политикой конфиденциальности</a></label>
      </td>
  </div>

<?=$arResult["FORM_FOOTER"]?>
