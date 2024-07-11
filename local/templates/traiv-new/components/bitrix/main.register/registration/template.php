<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="row traiv-bitrix-main-register-registration">
        <?if($USER->IsAuthorized()):?>

            <p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
        
        <?else:?>
            <!-- <div class="header-block">Регистрация</div>-->
            <!-- <div class="form"> -->
                <!--<table>
                    <tr>
                        <td class="description">После регистрации на сайте вам будет доступна история заказов <br class="hide-mobile">и другие новые возможности.</td>
                    </tr>
                </table>-->
                <?
                if (count($arResult["ERRORS"]) > 0):
                        foreach ($arResult["ERRORS"] as $key => $error)
                                if (intval($key) == 0 && $key !== 0) 
                                        $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

                        ShowError(implode("<br />", $arResult["ERRORS"]));

                elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
                ?>
                    <p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
                <?endif?>

                <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" id="form_reg">
                    <input id="input-login" type="hidden" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]["LOGIN"]?>" />
                <?
                if($arResult["BACKURL"] <> ''):
                ?>
                        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?
                endif;
                ?>

                <!-- <table> -->
                	
            <div class="col-12 col-xl-4 col-lg-4 col-md-4">
				<div class="form-group">
                            <label class="control-label">Фамилия Имя Отчество <span>*</span></label>
                            <input class="form-control new-2020" type="text" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" placeholder="ФИО" />
                </div>
			</div>
                    <div class="col-12 col-xl-4 col-lg-4 col-md-4">
				<div class="form-group">
                            <label class="control-label">Телефон <span>*</span></label>
                            <input class="form-control new-2020 input_tel" type="text" name="REGISTER[PERSONAL_PHONE]" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>" placeholder="+7(999) 999-99-99"/>
                 </div>
			</div>
                <div class="col-12 col-xl-4 col-lg-4 col-md-4">
				<div class="form-group">
                            <label class="control-label">E-mail <span>*</span></label>
                            <input id="input-email" class="form-control new-2020" type="text" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>" placeholder="ivanov_ivan@mail.ru" />
                        </div>
                </div>
                    <div class="col-12 col-xl-4 col-lg-4 col-md-4">
				<div class="form-group">
                            <label class="control-label">Пароль <span>*</span></label>
                            <input class="form-control new-2020" type="password" autocomplete="off" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]["PASSWORD"]?>" />
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 col-lg-4 col-md-4">
				<div class="form-group">
                            <label class="control-label">Подтверждение пароля <span>*</span></label>
                            <input class="form-control new-2020" type="password" autocomplete="off" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" />
                        </div>
                    </div>
                     <div class="col-12 col-xl-4 col-lg-4 col-md-4">
				<div class="form-group">
							<label class="control-label font-weight-normal"><span class="pr-2"><input type="checkbox" name="license" checked="checked" /></span>Я согласен на обработку персональных данных
							<br>
							<a href="/politika-konfidentsialnosti/">Политика конфиденциальности</a></label>
                        </div>
                    </div>
					
					<div class="col-12 col-xl-4 col-lg-4 col-md-4">
				<div class="form-group">
                            <?
                            /* CAPTCHA */
                            if ($arResult["USE_CAPTCHA"] == "Y")
                            {
                                ?>
                                <label class="control-label"><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></label>
                                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                                <br><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span>
                                <br><input type="text" name="captcha_word" maxlength="50" value="" /><br><br>

                                <?
                            }
                            /* !CAPTCHA */
                            ?>
					
					</div>
					</div>
                   <div class="col-12 col-xl-2 col-lg-2 col-md-2">
				<div class="form-group">
                            <input class="btn-blue" type="submit" name="register_submit_button" id="register_submit_button" value="Зарегистрироваться" onclick="ym(18248638,'reachGoal','clickReg'); return true;" />
                        </div>
                    </div>
                    <!-- 
                    <tr>
                        <td colspan="2" style="text-align: center">
                                <a href="/auth/">Войти как пользователь</a>
                        </td>
                    </tr>-->
                <!-- </table> -->



                </form>
            <!-- </div> -->
        <?endif?>
</div>