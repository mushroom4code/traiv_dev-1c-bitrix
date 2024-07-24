<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? include_once 'top.php'; ?>

<div class="row g-0 pb-3" id="lk-cart-list">

    <? if (count($arResult["ITEMS"]) > 0): ?>
        <div class="row g-0">
            <div class="col-12">
                <div class="row g-0 d-flex align-items-center h-100">
                    <div class="col-6">
                        <span class="lk-cart-list-count"><?= $arResult["MESSAGE"] ?></span>
                    </div>

                    <div class="col-6 text-right">
                        <div class="btn-group-blue">
                            <a href="#" class="btn-typographic btn-404 delete_all">
                                <span><i class="fa fa-trash"></i> Очистить корзину</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endif; ?>


    <? if (count($arResult["ITEMS"]) > 0): ?>

        <div class="row g-0 mt-4" id="lk-cart-list-shadow">
            <div class="col-12 d-none d-lg-block" id="catalog-list-line-th">
                <div class="row g-0">
                    <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center">Фото</div>
                    <div class="col-5 col-xl-4 col-lg-4 col-md-4">Наименование</div>
                    <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center">Артикул</div>
                    <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center">Вес</div>
                    <div class="col-2 col-xl-2 col-lg-2 col-md-2 text-center">Цена за шт.</div>
                    <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center">Кол-во</div>
                    <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center">Сумма</div>
                    <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center"></div>
                </div>
            </div>

            <div class="row traiv-catalog-line-default g-0">

                <? foreach ($arResult["ITEMS"] as $arItem) {

                    $origname = $arItem["NAME"];
                    $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/", "", $origname);
                    $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Евр|Ев|PU=.*|RU=.*/", "", $formatedPACKname);
                    ?>

                    <div class="col-12 catalog-list-line pt-1 pb-1" data-id="<?= $arItem["ID"] ?>">
                        <div class="row g-0 position-relative">

                            <div class="col-3 col-xl-1 col-lg-1 col-md-1 text-center">

                                <div class="new-item-line__image overflow-h">

                                    <a href="<?= $arItem["URL"] ?>" rel="<?php echo $arItem["URL"]; ?>">
                                        <?
                                        if (!empty($arItem["IMG"])) {
                                            $picturl = CFile::ResizeImageGet($arItem["IMG"], array('width' => 35, 'height' => 35), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                                            <img src="<?= $arItem["IMG"] ?>" alt="<?= $formatedname ?>"
                                                 id="<?= $arItem["ID"] ?>"/>
                                            <?
                                        }
                                        ?>
                                    </a></div>

                            </div>

                            <div class="col-7 col-xl-4 col-lg-3 col-md-3"><a href="<?= $arItem["URL"] ?>"
                                                                             style="font-size:14px;padding-right:20px;"><?= $formatedname ?></a>
                            </div>
                            <div class="col-2 col-xl-1 col-lg-1 col-md-1 text-center">
                                <span><?= $arItem["ARTICLE"] ?></span></div>
                            <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center d-none d-lg-block"><?= $arItem["WEIGHT"] ?>
                                гр.
                            </div>
                            <div class="col-4 col-xl-2 col-lg-2 col-md-2 text-center"><?= $arItem["PRICE"] ?></div>
                            <div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center">
                                <div class="catalog-list-quantity-area">
                                    <?
                                    $ymarket = $item["PROPERTIES"]["YMARKET"]["VALUE"];
                                    !$ymarket ? $pack = $item["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] : $pack = 1;
                                    !$pack && $pack = 1; ?>
                                    <input type="text" name='QUANTITY' class="quantity section_list"
                                           id="<?= $item["ID"] ?>-item-quantity" size="5"
                                           value="<?= $arItem["QUANTITY"] ?>" step="<?= $arItem["PACK"] ?>"
                                           min="<?= $arItem["PACK"] ?>">
                                    <a href="#" class="quantity_link quantity_link_plus" rel="<?= $item["ID"] ?>"><span><i
                                                    class="fa fa-plus"></i></span></a>
                                    <a href="#" class="quantity_link quantity_link_minus"
                                       rel="<?= $item["ID"] ?>"><span><i class="fa fa-minus"></i></span></a>
                                </div>
                            </div>

                            <div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center total_line_item"><?= $arItem["TOTAL"] ?></div>

                            <div class="col-4 col-xl-1 col-lg-1 col-md-1 text-right text-md-center text-sm-center text-xl-center cart-remove-block">
                                <a href="#" title="Удалить товар" class="lk-cart-item-del"><i
                                            class="fa fa-close"></i></a>
                            </div>
                        </div>
                    </div>

                    <?php

                }
                ?>

            </div>
        </div>

        <div class="row g-0 pb-3">
            <div class="col-12 mt-4">
                <div class="row d-flex align-items-center">
                    <div class="col-12 col-xl-2 col-lg-2 col-md-2 text-left">
                        <span class="lk-cart-list-total">Итого: <span><?= $arResult["TOTAL"] ?></span></span>
                    </div>
                    <div class="col-12 col-xl-3 col-lg-3 col-md-3 text-left">
                        <span class="lk-cart-list-weight">Общий вес: <?= $arResult["WEIGHT"] * 1000 ?> г</span>
                    </div>

                    <div class="col-12 col-xl-5 col-lg-5 col-md-5 text-center text-lg-right">
                        <div class="btn-group-blue <?= ($arResult['TOTAL_UNFORMATED'] < 5000) ? 'd-none' : ''?>"><a href="#buy-one-click"
                                                       class="btn-blue-contour btn-blue btn-one-click"
                                                       rel="nofollow"><span>Купить в 1 клик</span></a></div>
                    </div>

                    <div class="col-12 col-xl-2 col-lg-2 col-md-2 text-center text-lg-right">

                        <div class="btn-group-blue <?= ($arResult['TOTAL_UNFORMATED'] < 5000) ? 'd-none' : ''?>">
                            <a href="/personal/order/make/" class="btn-404">
                                <span> Оформить заказ</span>
                            </a>
                        </div>

                    </div>


                </div>
            </div>
        </div>

        <div class="cart_condition_block row g-0 pb-3 <?= ($arResult['TOTAL_UNFORMATED'] < 5000) ? '' : 'd-none'?>">
            <div class="col-12">
                <div class="row d-flex align-items-center">
                    <div class="check_type_pack_basket cart_condition">
                        <i class="fa fa-info-circle"></i>
                        <span>Минимальная сумма заказа 5 000 рублей</span>
                    </div>
                </div>
            </div>
        </div>


    <? else: ?>

        <div class="row g-0">
            <div class="col-12">
                <div class="row g-0 d-flex align-items-center h-100">
                    <div class="col-12 pt-3 text-center">
                        <span class="lk-cart-list-count">Ваша корзина пуста</span>
                    </div>

                    <div class="col-12 pt-3 pb-3 text-center">
                        <div class="btn-group-blue">
                            <a href="/catalog/" class="btn-404 delete_all" rel="1">
                                <span>Перейти в каталог</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <? endif; ?>

    <div class="row g-0" id="lk-cart-empty-button">
        <div class="col-12">
            <div class="row g-0 d-flex align-items-center h-100">
                <div class="col-12 pt-3 text-center">
                    <span class="lk-cart-list-count">Ваша корзина пуста</span>
                </div>

                <div class="col-12 pt-3 pb-3 text-center">
                    <div class="btn-group-blue">
                        <a href="/catalog/" class="btn-404" rel="2">
                            <span>Перейти в каталог</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<? include_once 'bottom.php'; ?>
