<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    
<div class="traiv-system-auth-forgotpasswd-default">     
    <div class="container">
    <div class="auth-traiv-wrapper">
        <div class="header-block"><?=GetMessage("AUTH_GET_CHECK_STRING")?></div>
        <div class="form">
            <table>
                <tr>
                    <td class="description"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></td>
                </tr>
            </table>
        <?
        ShowMessage($arParams["~AUTH_RESULT"]);

        ?>
        <form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <?
            if (strlen($arResult["BACKURL"]) > 0)
            {
            ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?
            }
            ?>
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="SEND_PWD">

            <table class="table-body">
                <tr>
                    <td>
                        <label><?=GetMessage("AUTH_EMAIL")?><span>*</span></label>
                        <input class="form-control" type="text" name="USER_EMAIL" value="">
                    </td>
                </tr>
                <tr>
                    <td class="submit">
                        <input class="traiv-orange-button" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
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
        <script type="text/javascript">
        document.bform.USER_LOGIN.focus();
        </script>
        </div>
    </div>
</div>