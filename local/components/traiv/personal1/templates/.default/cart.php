<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<? include_once 'top.php'; ?>

<div class="traiv-personal-cart">
    <div class="hide-mobile">
        <div class="header-block">
            Корзина
            <? if (count($arResult["ITEMS"])> 0):?>
                <div class="button-header">
                    <span class="count"><?=$arResult["MESSAGE"]?></span><a href="#" class="delete_all">Очистить корзину</a>
                </div>
            <? endif;?>
        </div>
        <? if (count($arResult["ITEMS"])> 0):?>
            <div class="form">
                <table>
                    <tr class="table-header">
                        <td class="code">Код</td>
                        <td class="name" colspan="2">Наименование</td>
                        <td class="price-td">Цена</td>
                        <td class="weight">Вес</td>
                        <td class="quantity">Кол-во</td>
                        <td class="total">Сумма</td>
                        <td class="del"></td>
                    </tr>
                    <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                        <tr class="cart-item" data-id="<?=$arItem["ID"]?>">
                            <td class="code"><span><?=$arItem["ARTICLE"]?></span></td>
                            <td class="img"><img src="<?=$arItem["IMG"]?>" /></td>
                            <td class="name"><a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a></td>
                            <td class="price-td"><?=$arItem["PRICE"]?></td>
                            <td class="weight"><?=$arItem["WEIGHT"]?> гр.</td>
                            <td class="quantity">
                                <div class="container-count">
                                    <div class="minus">&mdash;</div>
                                    <input maxlength="5" type="text" value="<?=$arItem["QUANTITY"]?>" />
                                    <div class="plus">+</div>
                                </div>
                            </td>
                            <td class="total"><?=$arItem["TOTAL"]?></td>
                            <td class="del"><a href="#" title="Удалить товар"></a></td>
                        </tr>
                    <? } ?>
                </table>
                <div class="total-block">
                    <div class="total-summ">Итого: <span><?=$arResult["TOTAL"]?></span></div>
                    <div class="total-weight">Общий вес: <span><?=$arResult["WEIGHT"]?></span> кг.</div>
                    <div class="clear"></div>
                    <a class="link-order" href="/personal/order/make/">Оформить заказ</a>
                    <a class="link-catalog" href="/catalog/">Перейти в каталог</a>
                    <div class="clear"></div>
                </div> 
            </div> 
            <div class="clear-cart">
                <div class="clear"></div>
                <div class="button-left">Ваша корзина пуста</div>
                <a class="button-right" href="/catalog">Перейти в каталог</a>
                <div class="clear"></div>
            </div>
        <? else: ?>
            <div class="clear"></div>
            <div class="button-left">Ваша корзина пуста</div>
            <a class="button-right" href="/catalog">Перейти в каталог</a>
            <div class="clear"></div>
        <? endif;?>
        
    </div>
    <div class="hide-desctop">

        <? if (count($arResult["ITEMS"])> 0):?>
            <div class="button-header">
                <span class="count"><?=$arResult["MESSAGE"]?></span><a href="#" class="delete_all">Очистить корзину</a>
            </div>
            <div class="form">
                <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                    <div class="cart-item" data-id="<?=$arItem["ID"]?>">
                        <div class="del">
                            <a href="#" title="Удалить товар"></a>
                        </div>
                        <table class="name">
                            <tr>
                                <? if (!empty($arItem["IMG"])):?>
                                    <td class="td-image"><img src="<?=$arItem["IMG"]?>" /></td>
                                <? endif; ?>
                                <td class="td-name"><a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a> </td>
                            </tr>
                        </table>
                        <table class="prop">
                            <tr>
                                <? if (!empty($arItem["ARTICLE"])):?>
                                    <td class="code">
                                        Код<br>
                                        <span><?=$arItem["ARTICLE"]?></span>
                                    </td>
                                <? endif;?>
                                <td>
                                    Вес<br>
                                    <?=$arItem["WEIGHT"]?> гр.
                                </td>
                            </tr>
                        </table>
                        <table class="prop">
                            <tr>
                                <td class="quantity">
                                    Кол-во<br>
                                    <div class="container-count">
                                        <div class="minus">&mdash;</div>
                                        <input maxlength="5" type="text" value="<?=$arItem["QUANTITY"]?>" />
                                        <div class="plus">+</div>
                                    </div>
                                </td>
                                <td>
                                    Сумма<br>
                                    <?=$arItem["TOTAL"]?>
                                </td>
                            </tr>
                        </table>
                    </div>
                <? } ?>
                <div class="total-block-mobile">
                    <div class="total-weight">Общий вес: <span><?=$arResult["WEIGHT"]?></span> кг.</div>
                    <div class="total-summ">Итого: <span><?=$arResult["TOTAL"]?></span></div>
                    <a class="link-order" href="/personal/order/make/">Оформить заказ</a><br>
                    <a class="link-catalog" href="/catalog/">Перейти в каталог</a>
                </div>
            </div>
            <div class="clear-cart">
                <div class="clear"></div>
                <div class="button-left">Ваша корзина пуста</div>
                <a class="button-right" href="/catalog">Перейти в каталог</a>
                <div class="clear"></div>
            </div>
        <? else: ?>
            <div class="clear"></div>
            <div class="button-left">Ваша корзина пуста</div>
            <a class="button-right" href="/catalog">Перейти в каталог</a>
            <div class="clear"></div>
        <? endif;?>
    </div>
</div>

<? include_once 'bottom.php'; ?>
