<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="container traiv-bitrix-main-register-registration">
    <div class="wrapper">
        <div class="content">
        <?if($USER->IsAuthorized()):?>

            <p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
        
        <?else:?>
            <div class="header-block">Регистрация</div>
            <div class="form">
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

                <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
                    <input id="input-login" type="hidden" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]["LOGIN"]?>" />
                <?
                if($arResult["BACKURL"] <> ''):
                ?>
                        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?
                endif;
                ?>

                <table>
                    <tr>
                        <td>
                            <label>Фамилия Имя Отчество <span>*</span></label>
                            <input class="form-control new-2020" type="text" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" placeholder="ФИО" />
                        </td>
                        <!--<td class="right">Ваше имя необходимо для того, чтобы мы знали с кем имеем дело :)</td>-->
                    </tr>
                    <tr>
                        <td class="left">
                            <label>Телефон <span>*</span></label>
                            <input class="form-control new-2020 input_tel" type="text" name="REGISTER[PERSONAL_PHONE]" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>" placeholder="+70123456789" />
                        </td>
                        <!--<td class="right">Контактный телефон нужен для уточнения деталей заказа.</td>-->
                    </tr>
                    <tr>
                        <td class="left">
                            <label>E-mail <span>*</span></label>
                            <input id="input-email" class="form-control new-2020" type="text" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>" placeholder="ivanov_ivan@mail.ru" />
                        </td>
                        <!--<td class="right">Является логином для входа на сайт. Также на него будут приходить уведомления о статусах заказа.</td>-->
                    </tr>
                    <tr>
                        <td class="left">
                            <label>Пароль <span>*</span></label>
                            <input class="form-control new-2020" type="password" autocomplete="off" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]["PASSWORD"]?>" />
                        </td>
                        <!--<td class="right">Длина пароля не менее 6 символов.</td>-->
                    </tr>
                    <tr>
                        <td class="left">
                            <label>Подтверждение пароля <span>*</span></label>
                            <input class="form-control new-2020" type="password" autocomplete="off" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" />
                        </td>
                        <!--<td class="right">Повторите пароль.</td>-->

                    </tr>
                    <tr>
                        <td colspan="2" class="license">
							<label><input type="checkbox" name="license" checked="checked" />Я согласен на обработку персональных данных
							<br>
							<a href="/politika-konfidentsialnosti/" style="margin-left: 37px;">Политика конфиденциальности</a></label>
                        </td>
                    </tr>
					
					<tr><td style="text-align: center">
                            <?
                            /* CAPTCHA */
                            if ($arResult["USE_CAPTCHA"] == "Y")
                            {
                                ?>
                                <?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b><br><br>

                                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                                <br><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span>
                                <br><input type="text" name="captcha_word" maxlength="50" value="" /><br><br>

                                <?
                            }
                            /* !CAPTCHA */
                            ?>
					
					</td></tr>
                    <tr>
                        <td colspan="2" class="submit" style="text-align: center">
                            <input class="btn traiv-orange-button" type="submit" name="register_submit_button" value="Зарегистрироваться" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <!--<div class="wrapper-link">-->
                                <a href="/auth/">Войти как пользователь</a>
                            <!--</div>-->
                        </td>
                    </tr>
                </table>



                </form>
            </div>
        <?endif?>
    </div>
    </div>
</div>