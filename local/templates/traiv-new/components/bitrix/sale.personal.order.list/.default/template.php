<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="traiv-personal-sale-personal-order-list">
    <div class="header-block">
        <?=($_REQUEST["filter_history"] == "Y") ? "История заказов" : "Текущие заказы" ?>
    </div>

    <div class="form hide-mobile">
        <? if (count($arResult["ORDERS"]) > 0):?>
            <table>
                <tr class="head-table">
                    <td>Номер</td>
                    <td>Стоимость</td>
                    <td>Статус заказа</td>
                    <td>Оплата</td>
                </tr>
                <? foreach ($arResult["ORDERS"] as $arItem):?>
                    <tr>
                        <td><?=$arItem["ORDER"]["ID"]?></td>
                        <td><?=$arItem["ORDER"]["FORMATED_PRICE"]?></td>
                        <td><?=$arResult["INFO"]["STATUS"][$arItem["ORDER"]["STATUS_ID"]]["NAME"]?></td>
                        <td><?=$arResult["INFO"]["PAY_SYSTEM"][$arItem["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?></td>
                    </tr>
                <? endforeach; ?>
            </table>
        <? else: ?>
            <?= ShowError("Заказы отсутствуют")?>
        <? endif; ?>
    </div>
    <div class="hide-desctop">
        <? if (count($arResult["ORDERS"]) > 0):?>
            <? foreach ($arResult["ORDERS"] as $arItem):?>
                <table>
                    <tr>
                        <td class="left-td">Номер</td>
                        <td class="right-td"><?=$arItem["ORDER"]["ID"]?></td>
                    </tr>
                    <tr>
                        <td class="left-td">Стоимость</td>
                        <td class="right-td"><?=$arItem["ORDER"]["FORMATED_PRICE"]?></td>
                    </tr>
                    <tr>
                        <td class="left-td">Статус заказа</td>
                        <td class="right-td"><?=$arResult["INFO"]["STATUS"][$arItem["ORDER"]["STATUS_ID"]]["NAME"]?></td>
                    </tr>
                    <tr>
                        <td class="left-td">Оплата</td>
                        <td class="right-td"><?=$arResult["INFO"]["PAY_SYSTEM"][$arItem["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?></td>
                    </tr>
                 </table>
            <? endforeach; ?>
        <? else: ?>
            <?= ShowError("Заказы отсутствуют")?>
        <? endif; ?>
    </div>
    <div class="clear"></div>
    <? if ($_REQUEST["filter_history"] == "Y"): ?>
        <a href="/personal/orders/" class="button-left">Посмотреть текущие заказы</a>
    <? else: ?>
        <a href="/personal/orders/?filter_history=Y" class="button-left">Посмотреть историю заказов</a>
    <? endif;?>
    
    <a href="/catalog/" class="button-right">Перейти в каталог</a>
    <div class="clear"></div>
</div>

