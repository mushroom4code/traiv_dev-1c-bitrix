<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?><?

ShowMessage($arParams["~AUTH_RESULT"]);

?>


<form name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>" class="js-validate">
    <p>Если вы забыли пароль,<br>введите E-Mail.</p>
    <p>Регистрационные данные, <br>будут высланы вам по E-Mail.</p>
    <div class="form-control-row">
        <? if (strlen($arResult["BACKURL"]) > 0) {
            ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?
        }
        ?>
        <input type="hidden" name="AUTH_FORM" value="Y"> <input type="hidden" name="TYPE" value="SEND_PWD">

        <input type="text" name="USER_LOGIN" maxlength="50" value="<?= $arResult["LAST_LOGIN"] ?>" style="display: none;"/>&nbsp;

        <input type="email" placeholder="E-mail" name="USER_EMAIL" class="form-control">
    </div>
    <input class="btn btn--submit" type="submit" name="send_account_info" value="<?= GetMessage("AUTH_SEND") ?>"/>


</form>
<script>
    $(document).ready(function () {


            $("form[name='bform']").validate({

                rules: {
                    'USER_EMAIL': {
                        required: true, email: true,
                    },
                },

                messages: {
                    'USER_EMAIL': "",
                }
            });
        }
    )

</script>
