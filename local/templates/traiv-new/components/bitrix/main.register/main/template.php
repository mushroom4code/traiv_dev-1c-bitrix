<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}



?>




<? if ($USER->IsAuthorized()): ?>

    <p><? echo GetMessage("MAIN_REGISTER_AUTH") ?></p>

<? else: ?><?
    if (count($arResult["ERRORS"]) > 0):
        foreach ($arResult["ERRORS"] as $key => $error) {
            if (intval($key) == 0 && $key !== 0) {
                $arResult["ERRORS"][$key] = str_replace(
                    "#FIELD_NAME#",
                    "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;",
                    $error
                );
            }
        }

        ShowError(implode("<br />", $arResult["ERRORS"]));

    elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
        ?>
        <p><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></p>
    <? endif ?>


    <?
    if (!empty($arResult["VALUES"]["USER_ID"]) && count($arResult["ERRORS"]) == 0){
        ?>

        <script>
            $(document).ready(function() {
                //doesn't wait for images, style sheets etc..
                //is called after the DOM has been initialized
                $("#sign-up").hide();
                $("#registration-success").show();
            });
        </script>

        <?
    }?>

    <form action="<?= POST_FORM_ACTION_URI ?>" name="regform" method="post" id="register-form" class="js-validate">
        <input type="hidden" class="api-mf-antibot" value="" name="ANTIBOT[NAME]">
        <input type="hidden" value="" name="antibot">
        <?
        if ($arResult["BACKURL"] <> ''):
            ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?
        endif;
        foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
            <div class="form-control-row">
            <? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?><? endif ?><?

            $placeholder = GetMessage("REGISTER_FIELD_".$FIELD);
            switch ($FIELD) {
                case "PASSWORD":
                    ?>
                    <input style="display:none" type="password" name="fakepasswordremembered"/>
                    <input class="form-control" type="password" placeholder="<?= $placeholder ?>" autocomplete="off" class="bx-auth-input" value="<?= $arResult["VALUES"][$FIELD] ?>" placeholder="Пароль" name="REGISTER[<?= $FIELD ?>]" id="password" class="form-control">
                    <? if ($arResult["SECURE_AUTH"]): ?>
                    <span class="bx-auth-secure" id="bx_auth_secure" title="<? echo GetMessage(
                        "AUTH_SECURE_NOTE"
                    ) ?>" style="display:none">
                                 <div class="bx-auth-secure-icon"></div>
                                    <noscript>
                                        <span class="bx-auth-secure" title="<? echo GetMessage(
                                            "AUTH_NONSECURE_NOTE"
                                        ) ?>">
                                            <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                        </span>
                                    </noscript>
                                    <script type="text/javascript">
                                        document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                    </script>
                                </span></div>

                <? endif ?><?
                    break;
                case "CONFIRM_PASSWORD":
                    ?>
                    <input placeholder="<?= $placeholder ?>" name="REGISTER[<?= $FIELD ?>]"  class="form-control" size="30" type="password" name="REGISTER[<?= $FIELD ?>]" value="<?= $arResult["VALUES"][$FIELD] ?>" autocomplete="off" /><?
                    break;

                case "PERSONAL_GENDER":
                    ?><select name="REGISTER[<?= $FIELD ?>]">
                    <option value=""><?= GetMessage("USER_DONT_KNOW") ?></option>
                    <option value="M"<?= $arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : "" ?>><?= GetMessage(
                            "USER_MALE"
                        ) ?></option>
                    <option value="F"<?= $arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : "" ?>><?= GetMessage(
                            "USER_FEMALE"
                        ) ?></option>
                    </select><?
                    break;

                case "PERSONAL_COUNTRY":
                case "WORK_COUNTRY":
                    ?><select name="REGISTER[<?= $FIELD ?>]"><?
                    foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value) {
                        ?>
                        <option value="<?= $value ?>"<? if ($value == $arResult["VALUES"][$FIELD]): ?> selected="selected"<? endif ?>><?= $arResult["COUNTRIES"]["reference"][$key] ?></option>
                        <?
                    }
                    ?></select><?
                    break;

                case "PERSONAL_PHOTO":
                case "WORK_LOGO":
                    ?>
                    <input placeholder="<?= $placeholder ?>" class="form-control" size="30" type="file" name="REGISTER_FILES_<?= $FIELD ?>" /><?
                    break;

                case "LOGIN":
                    ?>
                    <input placeholder="<?= $placeholder ?>" class="form-control" size="30" type="text" name="REGISTER[<?= $FIELD ?>]" value="" /><?
                    break;

                case "PERSONAL_NOTES":
                case "WORK_NOTES":
                    ?>
                    <textarea cols="30" rows="5" name="REGISTER[<?= $FIELD ?>]"><?= $arResult["VALUES"][$FIELD] ?></textarea><?
                    break;
                default:
                    if ($FIELD == "PERSONAL_BIRTHDAY"): ?>
                        <small><?= $arResult["DATE_FORMAT"] ?></small><br/><?endif;
                    ?>
                    <input placeholder="<?= $placeholder ?>" class="form-control" size="30" type="text" name="REGISTER[<?= $FIELD ?>]" value="<?= $arResult["VALUES"][$FIELD] ?>" /><?
                    if ($FIELD == "PERSONAL_BIRTHDAY") {
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.calendar',
                            '',
                            array(
                                'SHOW_INPUT' => 'N',
                                'FORM_NAME' => 'regform',
                                'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                'SHOW_TIME' => 'N',
                            ),
                            null,
                            array("HIDE_ICONS" => "Y")
                        );
                    }

            } ?>
            </div>
            <?
        endforeach ?>

        <input type="submit" class="btn btn--submit" name="register_submit_button" value="<?= GetMessage("AUTH_REGISTER") ?>"/>

    </form>
<? endif ?>

<script>

    $(document).ready(function () {

            BX.addCustomEvent( 'onAjaxSuccess', function(){
                //console.log(123);
            });


            $("input[name='REGISTER[EMAIL]']").hide();
            $("input[name='REGISTER[EMAIL]']").val("_@_._");
            $("input[name='REGISTER[LOGIN]']").attr('placeholder', $("input[name='REGISTER[EMAIL]']").attr('placeholder'));

            if ($.fn.mask) {
                $('[name="REGISTER[PERSONAL_PHONE]"]').mask("+7 (999) 999 - 99 - 99");
            }

            $("form[name='regform']").on("submit",function(){
               // BX.closeWait();
            });



            $("form[name='regform']").validate({

                submitHandler: function (form) {
                    BX.closeWait();
                    if ($("form[name='regform']").valid() == true) {
                        BX.showWait();
                        ///$("form[name='regform']").submit();
                        return true;
                    } else {
                        BX.closeWait();
                        return false;
                    }
                },

                rules: {
                    'REGISTER[PERSONAL_PHONE]': "required",
                    'REGISTER[LOGIN]': {
                        required: true, email: true,
                    },
                    'REGISTER[PASSWORD]': {
                        required: true,
                        minlength: 6
                    },
                    'REGISTER[CONFIRM_PASSWORD]': {
                        required: true,
                        equalTo: '#password'
                    },

                },

                messages: {
                    'REGISTER[PERSONAL_PHONE]': "",
                    'REGISTER[LOGIN]': "",
                    'REGISTER[PASSWORD]': {
                        required: "",
                        minlength: "Минимум 6 символов"
                    },
                    'REGISTER[CONFIRM_PASSWORD]': {
                        required: "",
                        equalTo: "Пароли не совпадают"
                    },
                }
            });
        }
    )

</script>
