<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="traiv-system-auth-changepasswd-default">     
    <div class="container">
        <div class="auth-traiv-wrapper">
            <div class="header-block"><?=GetMessage("AUTH_CHANGE_PASSWORD")?></div>
            <div class="form">
                <?
                ShowMessage($arParams["~AUTH_RESULT"]);
                ?>
                <form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
                    <?if (strlen($arResult["BACKURL"]) > 0): ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                    <? endif ?>
                    <input type="hidden" name="AUTH_FORM" value="Y">
                    <input type="hidden" name="TYPE" value="CHANGE_PWD">
                    <table>
                        <tr>
                            <td>
                                <label><?=GetMessage("AUTH_LOGIN")?><span>*</span></label>
                                <input class="form-control" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
                            </td>
			</tr>
			<tr>
                            <td>
                                <label><?=GetMessage("AUTH_CHECKWORD")?><span>*</span></label>
                                <input class="form-control" type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" />
                            </td>
			</tr>
                        <tr>
                            <td>
                                <label><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?><span>*</span></label>
                                <input class="form-control" type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?><span>*</span></label>
                                <input class="form-control" type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off" />
                            </td>
                        </tr>
			<tr>
                            <td class="submit">
                                <input class="traiv-orange-button" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
                            </td>
			</tr>
                        <tr>
                            <td>
                                <div class="wrapper-link">
                                    <a href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a>
                                </div>
                            </td>
			</tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>