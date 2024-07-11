<?
$sendButtonValue = strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ?
  GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];
$sendButtonValue = htmlspecialcharsbx($sendButtonValue);

$userNameInputPlaceholder = 'Имя';
$phoneInputPlaceholder = 'Телефон';

$userNameInputName = 'form_text_24';
$phoneInputName = 'form_text_23';

/*
$formClassAttribute = "class='popup-dialog mfp-hide js-validate'";
$formIDAttribute = "id='recall-form'";
$stringToBeReplaced = "<form";
$stringToBeReplacing = "<form $formIDAttribute $formClassAttribute";
$arResult['FORM_HEADER'] = str_replace(
	$stringToBeReplaced, 
	$stringToBeReplacing, 
	$arResult['FORM_HEADER']
);
 */
?>

<script>
    $(function() {
        $('[name="phone"], .input_tel').mask("+7 (999) 999 - 99 - 99");
    });
</script>

<?=$arResult["FORM_HEADER"]?>

  <input type="hidden" name="web_form_apply" value="Y" />
  <h5 class="md-title"><?=$arResult["FORM_TITLE"]?></h5>
  <p>Введите ваши данные и мы перезвоним вам</p>
  
  <div class="form-control-row">
    <div class="col x1d2 x1d1--m form-control-row">
      <input 
        type="text" 
        placeholder="<?=$userNameInputPlaceholder?>" 
        name="<?=$userNameInputName?>" 
        class="form-control"
        value="<?=$arResult["arrVALUES"]["form_text_24"]?>">
    </div>

    <div class="col x1d2 x1d1--m form-control-row">
      <input 
        type="text" 
        placeholder="<?=$phoneInputPlaceholder?>" 
        name="<?=$phoneInputName?>" 
        class="form-control input_tel"
        value="<?=$arResult["arrVALUES"]["form_text_23"]?>">
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
    */?>



        <div class="clearfix"></div>

      <div class="g-recaptcha" data-sitekey="6LekrNYUAAAAABOMKFbne3WrsrtSkmnR_vRoYX6k"></div>

		 <div>

</div>
<br>
      <br>
      <br>
<div class="col x1d1 x1d1--m form-control-row">
    <div class="block_min_s" style="width: 100%;"><div style="text-align:center;"><strong>Минимальная сумма заказа составляет 3 000 рублей.</strong></div></div>
</div>
      <td colspan="2" class="license">
          <label><input type="checkbox" name="license" checked="checked" required="required"/>Я соглашаюсь на обработку персональных данных
              <br>в соответствии с<a href="/politika-konfidentsialnosti/" style="margin-left: 3px;">Политикой конфиденциальности</a></label>
      </td>
      <br>
      <br>
    <div class="form-control-row">
      <button 
      type='submit'
      value="<?=$sendButtonValue?>"
      name='web_form_submit'
      class="btn btn--submit"><?=$sendButtonValue?></button>
    </div>


    <?=$arResult["FORM_DESCRIPTION"]?>
  </div>



<?=$arResult["FORM_FOOTER"]?>
