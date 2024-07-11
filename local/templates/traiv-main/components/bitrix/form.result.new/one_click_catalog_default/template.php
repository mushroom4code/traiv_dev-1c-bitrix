<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>


<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<tr>
		<td><?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"])
{
?>
	<div class ="FormTitle"><h3><?=$arResult["FORM_TITLE"]?></h3></div>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

		<!--	<p><?//=$arResult["FORM_DESCRIPTION"]?></p> -->
		</td>
	</tr>
	<?
} // endif
	?>

<br />
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>

    <?
    if(!CModule::IncludeModule("iblock"))

        return;


    $res = CIBlockSection::GetByID($arParams["ELEMENT_ID"]);
    if($ar_res = $res->GetNext())
        echo '<b>'.'Меня интересует: '.$ar_res['NAME'].'</b><br><br>';
    ?>

<!-- <table class="form-table data-table"  -->
	<!--<thead>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</thead> -->
	<tbody>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{

			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
		<tr>
			<td>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
				<?endif;?>
                <div class="questions">
				<?//=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?//=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
                </div>
			</td>
			<td ><?=$arQuestion["HTML_CODE"]?></td>

		</tr>
	<?
		}
	} //endwhile
	?>
<? /*
if($arResult["isUseCaptcha"] == "Y")
{
?>
	<!--	<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr> -->
		<tr>
            <div class="captcha">
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
            </div>
        </tr>
		<tr>
		<!--	<td><?//=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td> -->
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
            <br>
		</tr>
<?
} */ // isUseCaptcha
?>
    <div class="g-recaptcha" data-sitekey="6LekrNYUAAAAABOMKFbne3WrsrtSkmnR_vRoYX6k"></div>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">
				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" class="btn" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				<?if ($arResult["F_RIGHT"] >= 15):?>
			<!--	&nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="<?//=GetMessage("FORM_APPLY")?>" /> -->
				<?endif;?>
			<!--	&nbsp;<input type="reset" value="<?//=GetMessage("FORM_RESET");?>" /> -->
			</th>
		</tr>
	</tfoot>
<!-- </table> -->
<pre><?//print_r($arParams)?></pre>

    <p><?=$arResult["FORM_DESCRIPTION"]?></p>

    <div class="place"><span class="error"> </span></div>

    <p>
<?//=$arResult["REQUIRED_SIGN"];?>* - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="/local/templates/traiv-main/js/jquery.inputmask.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#line_block_two").inputmask("+7(999)999-99-99");






        });
    </script>


    <script type="text/javascript">
        $(function(){
            /*jQuery.validate*/
            var f = $('form[name="<?=$arResult["arForm"]["SID"]?>"]');
            f.validate({
                focusInvalid: false,
                focusCleanup: true,
                submitHandler: function(form) {
                    form.submit();
                },
                rules:{
                    <?foreach($arResult["QUESTIONS"] as $FIELD_SID => $q):?>
                    form_<?=$q['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$q['STRUCTURE'][0]['ID']?>: {
                        <?GetValidateRules($arResult["arQuestions"][$FIELD_SID]["COMMENTS"], $q["REQUIRED"])?>
                    },
                    <?endforeach;?>
                },
                messages:{
                    <?foreach($arResult["QUESTIONS"] as $FIELD_SID => $q):?>
                    form_<?=$q['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$q['STRUCTURE'][0]['ID']?>: {
                        <?GetValidateMessages($arResult["arQuestions"][$FIELD_SID]["COMMENTS"])?>
                    },
                    <?endforeach;?>
                },
                errorPlacement: function(error, element) {
                    var erspan = $('<span class="error">'+error.text()+'</span>'+'<br>');
                    $('div.place').html(erspan);
                }
            });
            /*jQuery.validate*/
            // hide error
            $('#full_string').mouseout(function() {
                $('span.error').remove();
            });
        })
    </script>



<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)

?>