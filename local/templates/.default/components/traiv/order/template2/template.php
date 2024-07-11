<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>

 <div class="content traiv-order-default">
        <div class="container">
            <div class="container mar-bot">
               
                <h1 class="head-order">Оформление заказа</h1>
                <div class="order bg-white clearfix">
                    <? if (count($arResult["ITEMS"]) > 0):?>
                    <form action="make_order.php" name="make_order" class="form-inp-block" _lpchecked="1" method="post">
                    <div class="form-block"><h4 class="head-form">Данные для связи </h4>

                      <!--  <input name="radio" type="radio" id="ch_1" value="1" checked=""><label style="position: absolute; margin-top: 1px" for="ch_1">Физическое лицо</label><br>  -->
                      <!--  <input name="radio" type="radio" id="ch_2" value="2"><label style="position: absolute; margin-top: 1px" for="ch_2">Юридическое лицо</label><br><br> -->
                            
                        <br>

                     <!--   <div class="person-container" data-id="1">  -->
                            <div class="form-group">
                                <input name="U_FIO" class="input-order" type="text" value="<?=(!empty($arResult["USER"]["NAME"])) ? $arResult["USER"]["NAME"] : ''?>" placeholder="ФИО*" required style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                            </div>
                            <span class="sub-form">Как к вам обращаться?</span>
                            
                            <div class="form-group">
                                <input name="U_PHONE" value="<?=(!empty($arResult["USER"]["PERSONAL_PHONE"])) ? $arResult["USER"]["PERSONAL_PHONE"] : ''?>" class="input-order input_tel" type="text" placeholder="+7 (___) ___ - __ - __*" required>
                            </div>
                            <span class="sub-form">Для оперативного подтверждения заявки</span>
                            
                            <div class="form-group">
                                <input name="U_EMAIL" value="<?=(!empty($arResult["USER"]["EMAIL"])) ? $arResult["USER"]["EMAIL"] : ''?>" class="input-order form-email" type="text" placeholder="Ваш email*" required>
                            </div>
                            <span class="sub-form">Копия заявки будет отправлена на e-mail</span>

<!--                            <div class="form-group">
                                <input name="U_CITY" class="input-order" type="text" placeholder="Санкт-Петербург">
                            </div>
                            <span class="sub-form">Город доставки</span>-->
                            
                            <div class="form-group">
                                <input name="U_ADDRESS" class="input-order" type="text">
                            </div>
                            <span class="sub-form">Адрес доставки</span>

                        <div class="form-group">
                            <textarea name="comments" class="input-order" placeholder="Комментарий к заказу"></textarea>
                        </div>
                        <span class="sub-form">Оставьте свой комментарий</span>

                        <h4 class="head-form">Для юридических лиц (заполнение ускорит обработку заявки) </h4>

                        <div class="form-group">
                            <input name="U_NAME" value="<?=(!empty($arResult["USER"]["UF_ORGANIZATION"])) ? $arResult["USER"]["UF_ORGANIZATION"] : ''?>" class="input-order" type="text">
                        </div>
                        <span class="sub-form">Название компании</span>

                        <div class="form-group">
                            <input name="U_INN" id="u-inn" value="<?=(!empty($arResult["USER"]["UF_INN"])) ? $arResult["USER"]["UF_INN"] : ''?>" class="input-order" type="text" placeholder="Ваш ИНН">
                        </div>
                        <span class="sub-form">ИНН</span>

<!--                        <div class="form-group">
                            <input name="U_KPP" id="u-kpp" value="" class="input-order" type="text" placeholder="780401001">
                        </div>
                        <span class="sub-form">КПП</span>-->


                        <div class="form-group">
                            <input name="U_MANAGER" id="u-manager" value="" class="input-order" type="text" >
                        </div>
                        <span class="sub-form">Имя Вашего менеджера Трайв-Комплект (если знаете)</span>





                    <!--    </div>  -->
                            <!--
                        <div class="person-container" data-id="2" style="display: none;">
                            <div class="form-group">
                                <input name="U_FIO" class="input-order" type="text" value="<?//=(!empty($arResult["USER"]["NAME"])) ? $arResult["USER"]["NAME"] : ''?>" placeholder="Иванов Иван Иванович*" required style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                            </div>
                            <span class="sub-form">Контактное лицо</span>
                            
                            <div class="form-group">
                                <input name="U_NAME" value="<?//=(!empty($arResult["USER"]["UF_ORGANIZATION"])) ? $arResult["USER"]["UF_ORGANIZATION"] : ''?>" class="input-order" type="text" placeholder="ООО Трайв-Комплект">
                            </div>
                            <span class="sub-form">Название компании</span>
                            
                            <div class="form-group">
                                <input name="U_PHONE" value="<?//=(!empty($arResult["USER"]["PERSONAL_PHONE"])) ? $arResult["USER"]["PERSONAL_PHONE"] : ''?>" class="input-order input_tel" type="text" placeholder="+70123456789*" required>
                            </div>
                            <span class="sub-form">Для оперативного подтверждения заявки</span>
                            
                            <div class="form-group">
                                <input name="U_EMAIL" value="<?//=(!empty($arResult["USER"]["EMAIL"])) ? $arResult["USER"]["EMAIL"] : ''?>" class="input-order form-email" type="text" placeholder="ivanov_ivan@mail.ru*" required>
                            </div>
                            <span class="sub-form">Копия заявки будет отправлена на e-mail</span>

                            <div class="form-group">
                                <input name="U_MANAGER" id="u-manager" value="" class="input-order" type="text" >
                            </div>
                            <span class="sub-form">Фамилия Вашего менеджера</span>
                            
                            <div class="form-group">
                                <input name="U_INN" id="u-inn" value="<?//=(!empty($arResult["USER"]["UF_INN"])) ? $arResult["USER"]["UF_INN"] : ''?>" class="input-order" type="text" placeholder="7804618544*" required>
                            </div>
                            <span class="sub-form">ИНН</span>
                            
                            <div class="form-group">
                                <input name="U_KPP" id="u-kpp" value="" class="input-order" type="text" placeholder="780401001">
                            </div>
                            <span class="sub-form">КПП</span>
                            
                            
                            <div class="form-group">
                                <input name="U_CITY" class="input-order" type="text" placeholder="Санкт-Петербург">
                            </div>
                            <span class="sub-form">Город доставки</span>
                            
                            <div class="form-group">
                                <input name="U_ADDRESS" class="input-order" type="text" placeholder="Кондратьевский пр., дом № 15, лит. А., пом. 301/3">
                            </div>
                            <span class="sub-form">Адрес доставки</span>


                        </div>

             -->
                            
                            
                            
                            <div class="checkbox">
                                <input type="checkbox" name="deliv" id="ch1" checked="" value="Y"><label for="ch1">Заказать доставку</label>
                            </div>
  <div class="checkbox">
<input type="checkbox" id="ch1" checked="Y" value="Y">
<?if ($arParams['USER_CONSENT'] == 'Y'):?>
     <?$APPLICATION->IncludeComponent(
      "bitrix:main.userconsent.request",
      "",
      array(
          "ID" => $arParams["USER_CONSENT_ID"],
          "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
          "AUTO_SAVE" => "Y",
          "IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
          "REPLACE" => array(
           'button_caption' => 'Оформить',
           'fields' => array('Email', 'Телефон', 'Имя')
          ),
      )
     );?>
    <?endif;?>
</div>


                            <div class="form-button">
                                <?
                               // if($arParams['IS_SET_MIN_SUM'] == '1' && (int)str_replace(' ', '', $arResult['TOTAL']) < $arParams['MIN_SUM']){?>

                                <div class="block_min_s" style="width:96%; text-align: center;"><b>Обратите внимание: если сумма заказа менее 500 р.,<br> действует розничная наценка 30%</b><br></div>
                                      <!--  Добавьте в корзину товары еще на сумму <?// echo ($arParams['MIN_SUM'] - (int)str_replace(' ', '', $arResult['TOTAL'])) ?> рублей для оформления заказа.  -->


                              <?//} elseif($arParams['IS_SET_MIN_SUM'] == '1' && $arResult['TOTAL'] > $arParams['MIN_SUM']) {?>
                                <button type="submit" onclick="yaCounter18248638.reachGoal ('buy_order'); return true;" class="btn-form">Оформить</button>
<?//}?>
                            </div>


 <pre><?//print_r ($arResult)?></pre>



                    </div>
                        
                    <div class="price-block">
                    

                        <div class="list-block">
                            <? foreach ($arResult["ITEMS"] as $item): ?>
                                <div class="basket-item" data-id="<?=$item["ID"]?>">
                                    <a href="#" rel="nofollow" class="del" title="Удалить"></a>
                                    <div class="container-count">
                                        <!--<div class="minus">—</div>-->
                                        <input class="quantity" type="number" maxlength="6" value="<?=$item["QUANTITY"]?>" step="<?=$item["MEASURE"]?>" min="<?=$item["MEASURE"]?>">
                                        <!--<div class="plus">+</div>-->
                                    </div>
                                        <ul class="first-list">

                                            <?
                                            $origname = $item["NAME"];
                                            $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                                            $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);
                                            ?>


                                            <li class="first-item list-head"><?=$formatedname?></li>
                                            <li class="first-item li-quantity">Кол-во, шт: <span class="quant"><?=$item["QUANTITY"]?></span></li>
                                            <?If ($item["PRICE"] !== "0 р."){?>
                                            <li class="first-item">Цена за шт: <?=$item["PRICE"]?></li>
                                            <?} else echo "Запросить цену" ?>

                                        </ul>
                                </div>
                            <?  endforeach; ?>
                        </div>
                       
                        <div class="big-price">

                               Сумма заказа:
                            <span class="price-numb"><?=$arResult["TOTAL"]?> </span>




                        </div>
                        <div class="weight">
                            Вес:
                            <span class="price-numb"><?=$arResult["WEIGHT"]?></span>
                            кг
                        </div>
                    </div>


                </div>
                </form>
                    <? else: ?>
                    <div class="message-empty">Ваша корзина пуста</div>
                    <? endif?>
            </div>
        </div>
    </div>


<pre><?//print_r($arProps)?></pre>


