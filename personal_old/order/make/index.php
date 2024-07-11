<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");

\Bitrix\Main\Page\Asset::getInstance()->addJs("/personal/order/make/js/dist/min/jquery.inputmask.bundle.min.js");
\Bitrix\Main\Page\Asset::getInstance()->addJs("/personal/order/make/js/dist/inputmask/inputmask.regex.extensions.js");
\Bitrix\Main\Page\Asset::getInstance()->addJs("/personal/order/make/script.js");
\Bitrix\Main\Page\Asset::getInstance()->addCss("/personal/order/make/style.css");

CModule::IncludeModule("sale");
$arID = array();
$arBasketItems = array();

//ИНИЦИАЛИЗАЦИЯ PHPMorphy
require_once($_SERVER["DOCUMENT_ROOT"].'/local/lib/phpmorphy/common.php');
$opts = array(
    // storage type, follow types supported
    // PHPMORPHY_STORAGE_FILE - use file operations(fread, fseek) for dictionary access, this is very slow...
    // PHPMORPHY_STORAGE_SHM - load dictionary in shared memory(using shmop php extension), this is preferred mode
    // PHPMORPHY_STORAGE_MEM - load dict to memory each time when phpMorphy intialized, this useful when shmop ext. not activated. Speed same as for PHPMORPHY_STORAGE_SHM type
    'storage' => PHPMORPHY_STORAGE_MEM,
    // Enable prediction by suffix
    'predict_by_suffix' => true,
    // Enable prediction by prefix
    'predict_by_db' => true,
    // TODO: comment this
    'graminfo_as_text' => true,
);
$dir = $_SERVER["DOCUMENT_ROOT"].'/local/lib/phpmorphy/dicts';
$lang = 'ru_RU';

try {
    $morphy = new phpMorphy($dir, $lang, $opts);
} catch (phpMorphy_Exception $e) {
    echo $e;
    $morphy = null;
}
//=================================================================================================

$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC",
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
    ),
    false,
    false,
    array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS")
);
while ($arItems = $dbBasketItems->Fetch()) {
    if ('' != $arItems['PRODUCT_PROVIDER_CLASS'] || '' != $arItems["CALLBACK_FUNC"]) {
        CSaleBasket::UpdatePrice($arItems["ID"],
            $arItems["CALLBACK_FUNC"],
            $arItems["MODULE"],
            $arItems["PRODUCT_ID"],
            $arItems["QUANTITY"],
            "N",
            $arItems["PRODUCT_PROVIDER_CLASS"]
        );
        $arID[] = $arItems["ID"];
    }
}
if (!empty($arID)) {
    $dbBasketItems = CSaleBasket::GetList(
        array(
            "NAME" => "ASC",
            "ID" => "ASC",
        ),
        array(
            "ID" => $arID,
            "ORDER_ID" => "NULL",
        ),
        false,
        false,
        array()
    );
    while ($arItems = $dbBasketItems->Fetch()) {
        $arBasketItems[] = $arItems;
    }
} else { ?>

    <div class="content">
        <div class="container">
            Корзина пуста!
        </div>
    </div>
    <?

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

    return;
}

//типы плательщиков
// Выведем переключатели для выбора типа плательщика для текущего сайта
$db_ptype = CSalePersonType::GetList(Array("SORT" => "ASC"), Array("LID" => SITE_ID));
$bFirst = true;

//достаем текущего пользователя, если он авторизован
if ($USER->IsAuthorized()){
    $filter = Array
    (
        "ID"                  => $USER->GetID(),
        "ACTIVE"              => "Y",
    );

    $rsUsers= CUser::GetList(($by=""), ($order=""), $filter,array("SELECT"=>array("UF_*")));
    $arr = $rsUsers->GetNext();


}

?>


    <div class="content">
        <div class="container">
            <div class="container mar-bot">
                <h3 class="head-order">Оформление заказа</h3>
                <div class="order bg-white clearfix">
                    <div id="error-message" style="color: red;"></div>
                    <form action="make_order.php" name="make_order" class="form-inp-block" _lpchecked="1" method="post">
                    <div class="form-block"><h4 class="head-form">Данные для связи </h4>


                            <? while ($ptype = $db_ptype->Fetch()) {
                                ?>
                                <input name="radio" type="radio" id="ch_<?= $ptype["ID"] ?>" value="<? echo $ptype["ID"] ?>"<? if ($bFirst) {
                                    echo " checked";
                                } ?>>
                                <label style="position: absolute; margin-top: 1px" for="ch_<?= $ptype["ID"] ?>"><?= $ptype["NAME"] ?></label>

                                <br><?
                                $bFirst = false;
                            } ?>
                            <br>

                            <div class="form-group">
                                <input name="FIO" class="input-order" type="text"
                                    <?
                                    $FIO = '';

                                    $FIO = (empty($arr["~LAST_NAME"]) == true) ? '' :  $arr["~LAST_NAME"];
                                    $FIO .= (empty($arr["~NAME"]) == true) ? '' : " ". $arr["~NAME"];
                                    $FIO .= (empty($arr["~SECOND_NAME"]) == true) ? '' :  " ".$arr["~SECOND_NAME"];
                                    $FIO = trim($FIO);
                                    echo (empty($FIO)) ? '' :  'value="'.$FIO.'"';
                                    ?>
                                    placeholder="ФИО*" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                            </div>
                            <span class="sub-form">Как к вам обращаться?
										</span>
                            <div class="form-group">
                                <input name="email" <?
                                    echo (empty($arr["~EMAIL"]) == true) ? '' :  'value="'.$arr["~EMAIL"].'"';
                                ?> class="input-order" type="text" placeholder="E-mail*">
                            </div>
                            <span class="sub-form">Копия заявки будет отправлена на e-mail</span>
                            <?
                            if (!$USER->IsAuthorized()) {
                                ?>
                                <div class="form-group">
                                    <input class="input-order" name="password" type="password" placeholder="Пароль*">
                                </div>
                                <span class="sub-form">Пароль для регистрации/авторизации на сайте</span>
	                            <span id="password-message"></span>
                            <? } ?>


                            <div class="form-group">
                                <input name="INN" data-inputmask-regex="([0-9])*" class="input-order" type="text"


                                <?
                                echo (empty($arr["~UF_INN"]) == true) ? '' :  'value="'.$arr["~UF_INN"].'"';
                                ?>

                                    placeholder="ИНН">
                            </div>
                            <span class="sub-form">Ваш ИНН</span>

                            <div class="form-group">
                                <input name="city" class="input-order" type="text" placeholder="Город">
                            </div>
                            <span class="sub-form">Город доставки</span>
                            <div class="form-group">
                                <input name="address" class="input-order" type="text" placeholder="Адрес">
                            </div>
                            <span class="sub-form">Адрес доставки</span>
                            <div class="form-group">
                                <input name="telephone"

                                    <?
                                    echo (empty($arr["~PERSONAL_PHONE"]) == true) ? '' :  'value="'.$arr["~PERSONAL_PHONE"].'"';
                                    ?>

                                    class="input-order" type="text" placeholder="Телефон*">
                            </div>
                            <span class="sub-form">Для оперативного подтверждения заявки
										</span>

                            <div class="form-group">
                                <textarea name="comments" class="input-order" placeholder="Комментарий"></textarea>
                            </div>
                            <span class="sub-form">Оставьте свой комментарий</span>

                            <div class="checkbox">
                                <input type="checkbox" name="deliv" id="ch1" checked=""><label for="ch1">Заказать доставку</label>
                            </div>
                            <div class="form-button">
                                <button type="submit" class="btn-form">Оформить</button>
                            </div>

                            <input type="hidden" name="hash" value="<?=md5($_SESSION["fixed_session_id"])?>">


                    </div>
                    <div class="price-block">
                        <div class="list-block">

                            <?
                            $summ = 0;
                            $weight = 0;

                            foreach ($arBasketItems as $item) {
                                $summ += round($item["PRICE"], 2) * $item["QUANTITY"];
                                $weight += $item["WEIGHT"];
                                ?>
                                <ul class="first-list">
                                    <li class="first-item list-head"><?= $item["NAME"] ?></li>
                                    <li class="first-item">Кол-во<?
                                        if (!empty($item["MEASURE_NAME"])) {

                                            $measure = $item["MEASURE_NAME"];
                                            if (function_exists('iconv')) {
                                                $measure = iconv('utf-8', $morphy->getEncoding(), $measure);
                                                $paradigms = $morphy->findWord(strtoupper($measure));
                                                if ($paradigms !== false) {
                                                    $arr = $morphy->getAllFormsWithGramInfo(strtoupper($measure));
                                                    $measureM = strtolower($arr[0]["forms"][9]);
                                                    $measureE = strtolower($arr[0]["forms"][6]);
                                                }
                                            }

                                            if (!empty($measureM)) {
                                                echo ", ".$measureM;
                                            } else {
                                                echo ", ".$measure;
                                            }


                                        }
                                        ?>: <?= $item["QUANTITY"] ?></li>
                                    <li class="first-item">Цена
                                        <?
                                        if (!empty($item["MEASURE_NAME"])) {
                                            if (!empty($measureE)) {
                                                echo "за ".$measureE;
                                            } else {
                                                echo "за ".$item["MEASURE_NAME"];
                                            }
                                        }

                                        ?>: <?= str_replace(".", ",", round($item["PRICE"], 2)) ?> руб.
                                    </li>
                                </ul>
                                <?
                            }

                            ?>
                        </div>
                        <div class="big-price">
                            Сумма заказа:
                            <span class="price-numb"><?= str_replace(".", ",", round($summ, 2)) ?> </span>
                            руб.
                        </div>
                        <div class="weight">
                            Вес:
                            <span class="price-numb"><?= str_replace(".", ",", round($weight / 1000, 2)) ?></span>
                            кг
                        </div>
                    </div>

                        <input type="hidden" name="sum" value="<?=round($summ, 2)?>">
                        <input type="hidden" name="antibot" value="">


                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {



            $("input[name='telephone']").inputmask({"mask": "+9 999 999-9999", "placeholder":"+_ ___ ___-____", "onincomplete": function(){ $("input[name='telephone']").val('') } });
            $("input[name='INN']").inputmask("Regex");


            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
              $("form[name='make_order']").submit(function (e) {
             e.preventDefault(); //Отменили нативное действие
             return false;
             });


            $("form[name='make_order']").validate({


                submitHandler: function (form) {

                    $("form[name='make_order'] button").attr("disabled", true);


                    if ($("form[name='make_order']").valid() == true) {

                        if ($("input[name='deliv']").is(':checked')){
                            checked = "Y"
                        } else {
                            checked = "";
                        }

                        $.ajax({
                            type: 'POST',
                            url: 'make_order.php',
                            data: {<?
                            if (!$USER->IsAuthorized()){?>
                                password: removeDoubleSpacesAndTrim($("input[name='password']").val()),
                            <?}?>
                                radio: removeDoubleSpacesAndTrim($("input[name='radio']:checked").val()),
                                FIO:removeDoubleSpacesAndTrim($("input[name='FIO']").val()),
                                email: removeDoubleSpacesAndTrim($("input[name='email']").val()),
                                INN: removeDoubleSpacesAndTrim($("input[name='INN']").val()),
                                city: removeDoubleSpacesAndTrim($("input[name='city']").val()),
                                address: removeDoubleSpacesAndTrim($("input[name='address']").val()),
                                telephone: removeDoubleSpacesAndTrim($("input[name='telephone']").val()),
                                comments: removeDoubleSpacesAndTrim($("textarea[name='comments']").val()),
                                deliv: checked,
	                            antibot: $("input[name='antibot']").val(),
                                hash: $("input[name='hash']").val(),
	                            summ: $("input[name='sum']").val(),
                            },
                            cache: false,
                            success: function(data) {
                                $("#error-message").html('');
                                if(data.indexOf('ERROR') == -1) {
                                    $(".container.mar-bot").html(data);
                                } else {
                                    if (data == "ERRORПара логин/пароль неверна"){
                                        $("#password-message").html(data.substring(data.indexOf('ERROR')+5));
                                    } else {
                                        $("#error-message").html(data.substring(data.indexOf('ERROR')+5));
                                    }


                                    $("form[name='make_order'] button").attr("disabled", false);
                                }
                            },
                            error:function (xhr, ajaxOptions, thrownError){
                                $("form[name='make_order'] button").attr("disabled", false);
                                $(".container.mar-bot").html("Произошла ошибка, попробуйте позже.");
                            },
                        });


                    } else {
                        $("form[name='make_order'] button").attr("disabled", false);
                    }
                },

                rules: {
                    FIO: "required",
                    email: {
                        required: true,
                        email: true,
                    },
                    <?
                    if (!$USER->IsAuthorized()){?>
                    password:{ required: true,
                    minlength: 3},
                    <?}?>
                    telephone: "required",
                },

                messages: {
                    FIO: "",
                    email: "",
                    telephone: "",
                    password: ""
                }
            });

        });


    </script>


<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>