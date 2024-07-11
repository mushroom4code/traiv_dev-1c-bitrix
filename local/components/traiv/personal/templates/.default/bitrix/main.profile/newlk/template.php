<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/*echo "<pre>";
	print_r($arResult);
	echo "</pre>";*/
	
?>
<div class="row lk_right_profile_menu traiv-personal-profile-default">

<div class="lk_right_profile_menu_white">

    <div class="col-12"><div class="lk-item-block-personal-title">Личные данные</div></div>
    
    <div class="form">
        <?ShowError($arResult["strProfileError"]);?>
        <?
        if ($arResult['DATA_SAVED'] == 'Y')
                ShowNote(GetMessage('PROFILE_DATA_SAVED'));
        ?>

        <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
            <?=$arResult["BX_SESSION_CHECK"]?>
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
            <input type="hidden" id="input-login" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />
            <div class="user-type active">
                <div class="radio"><span></span>Физическое лицо</div>
                <div class="container-slide" style="display: block">
                    <table>
                        <tr>
                            <td class="left">
                                <label>Фамилия Имя Отчество <span>*</span></label>
                                <input class="form-control" type="text" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>" style="text-align:left;"/>
                            </td>
                            <td class="right">Ваше имя необходимо  для того, чтобы мы знали с кем имеем дело</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <label>Телефон</label>
                                <input class="form-control input_tel" type="text" name="PERSONAL_PHONE" placeholder="+7 (___) ___-____" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" style="text-align:left;"/>
                            </td>
                            <td class="right">Контактный телефон нужен для уточнения деталей заказа</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <label>E-mail <span>*</span></label>
                                <input id="input-email" class="form-control" type="text" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" style="text-align:left;"/>
                            </td>
                            <td class="right">Является логином для входа на сайт. Также на него будут приходить уведомления о статусах заказа</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="user-type">
                <div class="radio"><span></span>Юридическое лицо</div>
                <div class="container-slide">
                    <table>
                        <tr>
                            <td class="left">
                                <label>Название организации</label>
                                <input class="form-control" type="text" name="UF_ORGANIZATION" value="<?=$arResult["arUser"]["UF_ORGANIZATION"]?>" />
                            </td>
                            <td class="right"></td>
                        </tr>
                        <tr>
                            <td class="left">
                                <label>ИНН</label>
                                <input class="form-control" type="text" name="UF_INN" value="<?=$arResult["arUser"]["UF_INN"]?>" />
                            </td>
                            <td class="right"></td>
                        </tr>
                        <tr>
                            <td class="left">
                                <label>Сайт компании</label>
                                <input class="form-control" type="text" name="UF_SITE" value="<?=$arResult["arUser"]["UF_SITE"]?>" />
                            </td>
                            <td class="right"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="user-password">
                <div class="change-password">Сменить пароль</div>
                <div class="container-password">
                    <table>
                        <tr>
                            <td class="left">
                                <label>Новый пароль</label>
                                <input class="form-control" type="text" name="NEW_PASSWORD" value="<?=$arResult["arUser"]["NEW_PASSWORD"]?>" />
                            </td>
                            <td class="right"></td>
                        </tr>
                        <tr>
                            <td class="left">
                                <label>Подтверждение нового пароля</label>
                                <input class="form-control" type="text" name="NEW_PASSWORD_CONFIRM" value="<?=$arResult["arUser"]["NEW_PASSWORD_CONFIRM"]?>" />
                            </td>
                            <td class="right"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <input class="btn-blue submit-button submit-lower-text" type="submit" name="save" value="Сохранить изменения">
        </form>
    </div>
</div>
</div>
