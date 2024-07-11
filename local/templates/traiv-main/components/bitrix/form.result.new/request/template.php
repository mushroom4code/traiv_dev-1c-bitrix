<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }
?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<script>
    $(function() {
        $('[name="phone"], .input_tel').mask("+7 (999) 999 - 99 - 99");
    });
</script>
<?=$arResult["FORM_HEADER"]?>


<h5 class="md-title"><?=$arResult["FORM_TITLE"]?></h5>

<div class="row">

    <?
        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
            ?>
                <?

            switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                case "text" :
                    $name = "form_text_".$arQuestion['STRUCTURE'][0]['ID'];
                    ?>
                    <div class="col x1d2 x1d1--m form-control-row">
                        <input type="text" maxlength="25" placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="<?=$name?>"
                               value="<?=$arResult["arrVALUES"][$name]?>"
                               class="form-control <?=($FIELD_SID == "PHONE") ? 'input_tel' : ''?>">
                    </div>
                    <?
                    break;
                case "email" :
                    $mail = "form_email_" . $arQuestion['STRUCTURE'][0]['FIELD_ID'];
                    ?>
                    <div class="col x1d1 x1d1--m form-control-row">
                        <input type="text" maxlength="45" placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="<?=$mail?>"
                               value="<?=$arResult["arrVALUES"][$mail]?>"
                               class="form-control form-email">
                    </div>
                    <?
                    
                    break;
                case "textarea" :
                    $text = "form_textarea_" . $arQuestion['STRUCTURE'][0]['FIELD_ID'];
                    ?>
                    <div class="col x1d1 form-control-row">
                             <textarea maxlength="350" placeholder="<?=$arQuestion["CAPTION"]?>"
                                       name="<?=$text?>"
                                       class="form-control"><?=$arResult["arrVALUES"][$text]?></textarea>
                    </div>
                    <?
                    break;

                case "file" :
                    ?>
                    <div class="col x1d1 x1d1--m form-control-row">
                        <input type="file" placeholder="<?=$arQuestion["CAPTION"]?>"
                               name="form_file_<?=$arQuestion['STRUCTURE'][0]['FIELD_ID']?>"
                               class="form-control">
                    </div>
                    <?
                    $file = "form_text_" . $arQuestion['STRUCTURE'][0]['FIELD_ID'];
                    break;
                case "hidden" :
                    echo $arQuestion["HTML_CODE"];
                    break;

            }

        } //endwhile
    ?>

    <? // if ($arResult["isFormErrors"] == "Y"):?>
    <?//=$arResult["FORM_ERRORS_TEXT"];?>
    <? //else: ?>
    <!-- <p>Введите символы с картинки</p>  -->
    <?//endif;?>
    <!--  <div class="col x1d2 x1d1--m form-control-row">
            <input type="hidden" name="captcha_sid" value="<?//=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
        </div>
        <div class="col x1d2 x1d1--m form-control-row">
            <input type="text" class="form-control" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
        </div> -->

 <!--   <script src='https://www.google.com/recaptcha/api.js?hl=ru'></script>  -->


    <form action="" method="post">

    <div class="g-recaptcha" data-sitekey="6LekrNYUAAAAABOMKFbne3WrsrtSkmnR_vRoYX6k"></div>
    <?
    // } // isUseCaptcha
    ?>



    <div class="col x1d1 x1d1--m form-control-row">
    <div class="block_min_s" style="width: 100%;"><div style="text-align:center;"><strong>Минимальная сумма заказа составляет 3 000 рублей.</strong></div></div>
    <div class="block_min_s" style="width: 100%;"><div style="text-align:center;">После <a href="/registration/">регистрации</a> на сайте вам будет доступна история заказов и другие новые возможности.</div></div>
    </div>

    <div class="clearfix"></div>
    <td colspan="2" class="license">
        <label><input type="checkbox" name="license" checked="checked" required="required" />Я соглашаюсь на обработку персональных данных
            <br>в соответствии с<a href="/politika-konfidentsialnosti/" style="margin-left: 3px;">Политикой конфиденциальности</a></label>
    </td>
<br>
<br>
    <input id="request_submit" class="btn btn--submit" onclick="yaCounter18248638.reachGoal('otpravit_zayavky'); return true;" type="submit" name="web_form_submit" value="Отправить">

    </form>


    <?
    if (isset($_REQUEST["g-recaptcha-response"])) //Если мы получили хеш проверки с формы
    {
        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); //Подключаем ядро Битрикса
        $request = new \Bitrix\Main\Web\HttpClient(); //Создает объект HttpClient

        //Формируем запрос на проверку в Google
        $post = $request->post("https://www.google.com/recaptcha/api/siteverify", Array(
            "secret" => "6LekrNYUAAAAAKD2g0uYghJvaSTcPY4_i20QRTHz", //Наш секретный ключ от Google
            "response" => $_REQUEST["g-recaptcha-response"], //Сам хеш с формы
            "remoteip" => $_SERVER["REMOTE_ADDR"] //IP адрес пользователя проходящего проверку
        ));
        $post = json_decode($post); //Декодируем ответ от Google
        if ($post->success == 'true') //Если проверка прошла удачно
        {
            echo 'TRUE';
            $_SESSION["SESS_GRABBER_STOP_TIME"] = ""; //Очищаем ключ блокировки в сессии
            ?>
    <h2>Поздравляем, Вы не робот.</h2>
    <a  class="btn btn-system" href="<?=$APPLICATION->GetCurPageParam("", array("g-recaptcha-response"))?>">Обновить страницу</a>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.location.replace('<?=$APPLICATION->GetCurPageParam("", array("g-recaptcha-response"))?>');
            window.location.reload();
        });
    </script>
    <?
        }else{
            echo 'FALSE';
            //Выполняем действие если не прошел проверку на reCAPTCHA
            $APPLICATION->throwException("Вы не прошли проверку подтверждения личности");
            return false;
        }
    }
    ?>

</div>




<?=$arResult["FORM_FOOTER"]?>


<? }?>

