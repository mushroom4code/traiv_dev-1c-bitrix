<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*
 * $arResult["NavNum"] - ID - навигации
 * $arResult["NavRecordCount"] - Количество элементов
 * $arResult["NavPageNomer"] - Текущая страница
 * $arResult["NavPageCount"] - Количество страниц
 */
?>
<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
    <script>
        var TRAIV_SYSTEM_PAGENAVIGATION_AJAX_NAV = "PAGEN_<?=$arResult["NavNum"]?>";
        var TRAIV_SYSTEM_PAGENAVIGATION_AJAX_COUNT = <?=$arResult["NavPageCount"]?>;
        var TRAIV_SYSTEM_PAGENAVIGATION_AJAX_CURENT = <?=$arResult["NavPageNomer"]?>;
    </script>

    <a id="traiv-system-pagenavigation-ajax" href="<?=$APPLICATION->GetCurPageParam()?>">Показать ещё +</a>
<? endif;?>