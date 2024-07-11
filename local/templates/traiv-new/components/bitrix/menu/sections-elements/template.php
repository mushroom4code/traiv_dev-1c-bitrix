<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class='service-catalog-left-menu d-none d-lg-block'>
        <ul>

    <?php
    $previousLevel = 0;
    
    foreach($arResult as $arItem):?>
            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
            <?endif?>

            <?if ($arItem["IS_PARENT"]):?>

                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li class="<?if ($arItem['SELECTED']):?>service-catalog-left-menu-item<?else:?>service-catalog-left-menu-item<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem['SELECTED']):?>service-catalog-left-menu-link<?else:?>service-catalog-left-menu-link<?endif?>"><i class="fa fa-angle-right"></i><?=$arItem["TEXT"]?></a>
                                    <ul class="<?if ($arItem['SELECTED']):?>service-catalog-left-submenu<?else:?>service-catalog-left-submenu<?endif?>">
                    <?else:?>
                            <li class="<?if ($arItem['SELECTED']):?>question-element-list__item--active<?else:?>question-element-list__item<?endif?>"><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem['SELECTED']):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
                                    <ul>
                    <?endif?>

            <?else:?>  
                    <?if ($arItem["PERMISSION"] > "D"):?>

                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                    <li class="<?if ($arItem['SELECTED']):?>service-catalog-left-menu-item<?else:?>service-catalog-left-menu-item<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem['SELECTED']):?>service-catalog-left-menu-link<?else:?>service-catalog-left-menu-link<?endif?>"><span class="service-pd-left"></span><?=$arItem["TEXT"]?></a></li>
                            <?else:?>
                                    <li class="<?if ($arItem['SELECTED']):?>question-element-list__item--active<?else:?>service-catalog-left-menu-list__item<?endif?>"><a rel="2" href="<?=$arItem['LINK']?>" class="<?if ($arItem["SELECTED"]):?> item-selected<?else:?>service-catalog-submenu-link<?endif?>"><?=$arItem["TEXT"]?></a></li>
                            <?endif?>

                    <?else:?>

                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                    <li class="<?if ($arItem['SELECTED']):?>question-section--almost-active<?else:?>service-catalog-left-menu-link<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem['SELECTED']):?>question-name question-name--active<?else:?>question-name<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">1<?=$arItem["TEXT"]?></a></li>
                            <?else:?>
                                    <li class="<?if ($arItem['SELECTED']):?>question-element-list__item--active<?else:?>question-element-list__item<?endif?>"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">2<?=$arItem["TEXT"]?></a></li>
                            <?endif?>

                    <?endif?>

            <?endif?>

            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

    <?endforeach?>

    <?if ($previousLevel > 1)://close last item tags?>
            <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

    </ul>
</div>
<?endif?>