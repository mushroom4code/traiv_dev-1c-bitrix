<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
$i = 0;    
?>

<div class="traiv-menu-catalog-section-footer">
<div class="footer-catalog-menu-title">Каталог</div>
    <div class="wrap-table">
        <div class="column-menu">
            <? foreach ($arResult as $arItem) {
                if ($arItem["DEPTH_LEVEL"] == 2 && preg_match("/categories/", $arItem["LINK"]) && ($arItem["TEXT"] !== 'Гвозди' && $arItem["TEXT"] !== 'Дюбели' && $arItem["TEXT"] !== 'Кабельная продукция' && $arItem["TEXT"] !== 'Проход для кровли' && $arItem["TEXT"] !== 'Металлоконструкции' && $arItem["TEXT"] !== 'Хомуты' && $arItem["TEXT"] !== 'Подшипники')) {
                    $i++;
                    $arPath = explode("/", $arItem["LINK"]);
                    $code = $arPath[3];
                    ?>
            <div><a href="<?=$arItem["LINK"]?>" class="traiv-sprite"><i class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></i><?=$arItem["TEXT"]?></a></div>
                    <?
                    if ($i == 9) {
                        $i = 0;
                        ?></div><div class="column-menu"><?
                    }
                    ?>
                <?}
            }
            ?>
        </div>
    </div>
</div>