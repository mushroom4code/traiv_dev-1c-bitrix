<?
define("NO_KEEP_STATISTIC", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$_GET['elementid'] = urlencode($_GET['elementid']);

if (isset($_GET['elementid']) && !empty($_GET['elementid']))
{
CModule::IncludeModule('iblock');
//  CModule::IncludeModule('sale');
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_*", "IBLOCK_SECTION_ID");
$arSort = array('NAME'=>'ASC');
$arFilter = array('IBLOCK_ID'=>"18", 'ID'=>
    $_GET['elementid']);
$res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
if (!empty($res)){ ?>

    <li class="col space">
        <div class="item-place">

            <?
            while($ob = $res->GetNextElement())
            {
                $props = $ob->GetProperties();

                $arFields = $ob->GetFields();

                $ElUrl = $arFields['DETAIL_PAGE_URL'];


                $origname = $arFields["NAME"];
                $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);


                $standart = $props['STANDART']['VALUE'];
                $diametr = $props['DIAMETR_1']['VALUE'];
                $dlina = $props['DLINA_1']['VALUE'];
                $material = $props['MATERIAL_1']['VALUE'];
                $pokrytie = $props['POKRYTIE_1']['VALUE'];
                $upakovka = $props['KRATNOST_UPAKOVKI']['VALUE'];

                ?>

                <div class="new-item">
                    <div class="CloseItem"></div>


                    <div class="new-item__header-properties">
                        <?

                        if (!empty($standart)) echo 'Стандарт: '.$standart.'<br>';
                        if (!empty($diametr) & !empty ($dlina)) {echo 'Размер: &#8960; '.$diametr.' x '. $dlina.'<br>' ;}
                        else
                        {
                            if (!empty($diametr)) echo 'Диаметр: '.$diametr.'<br>';
                            if (!empty($dlina)) echo 'Длина: '.$dlina.'<br>';
                        };
                        if (!empty($material)) echo 'Материал: '.$material.'<br>';
                        if (!empty($pokrytie)) echo 'Покрытие: '.$pokrytie.'<br>';


                        ?>
                    </div>



                    <div class="new-item__image" id="img_<?=htmlspecialchars($_GET['elementid'])?>">
                        <?
                        if ($props['ACTION']['VALUE']){?>

                            <div class="bx_stick average left top" title="Распродажа"></div>

                        <?}?>

                        <?;IF (!empty($arFields['DETAIL_PICTURE'])) {

                            $ImgUrl =$arFields['DETAIL_PICTURE'];
                            //echo $ar_fields['DETAIL_PICTURE'];
                        } else {

                            $foo = CIBlockSection::GetList(array('NAME' => 'ASC'), array('IBLOCK_ID' => "18", 'ID' => $arFields["IBLOCK_SECTION_ID"]), false, false, Array("ID", "NAME", "DETAIL_PICTURE", "PICTURE"));
                            $bar = $foo -> GetNext();

                            $ImgUrl =$bar['DETAIL_PICTURE'];

                        }


                        $ResizedImg = CFile::ResizeImageGet($ImgUrl,array('width'=>120, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);


                        ?><img src="<?echo $ResizedImg['src']?>" id="<?=htmlspecialchars($_GET['elementid'])?>" >
                    </div>



                    <div class="new-item__title"  >
                        <a href="<?=$ElUrl?>" target="_blank"><? echo $formatedname?></a>
                    </div>

                    <? $arPrice = CPrice::GetBasePrice($_GET['elementid']);

                    $BuyUrl = $ElUrl.'?action=ADD2BASKET&id='.htmlspecialchars($_GET['elementid']).'&QUANTITY=';

                    ?>

                    <div class="new-item__price">Цена: <?= $arPrice["PRICE"] == 0 ? 'запросить' : $arPrice["PRICE"] . ' ' . 'р.' /* $arPrice["CURRENCY"];*/ ?></div>


                    <div class="new-item__footer">

                        <?$pack = $upakovka ? $upakovka : 1;?>

                        <input type="number" name='QUANTITY' class="quantity section_list col x1d2" id="<?= htmlspecialchars($_GET['elementid'])?>-item-quantity"  size="5" value="<?=$pack?>" step="<?=$pack?>" min="<?=$pack?>">

                        <a data-href="<?= $BuyUrl?>" class="new-item__buy-btn col x1d2" data-ajax-order id="calcbuy">В корзину</a>

                    </div>

                </div>
                <?

            }
            ?>
        </div>


    <?

}

}

?>