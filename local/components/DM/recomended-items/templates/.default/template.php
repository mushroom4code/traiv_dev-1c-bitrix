
<?if (is_array($arResult["SIMILARS"]) & (($arResult["ENGINE"]) == "Y")):?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slick-1.8.1/slick.js");?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/slick-1.8.1/slick.css");?>

    <div class="col-12 col-xl-12 col-lg-12 col-md-12 mt-3">
        	<div class="h1title-item"><span>Сопутствующие товары:</span></div>
    </div>
    
<ul class="row slickdiv">
<?
foreach ( $arResult["SIMILARS"] as $item):

    //name
    $origname = $item["NAME"];
    $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
    $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);

    ?><div class="col-3 col-lg-3 col-md-3 col-sm-3 p-3" id='<?//= $strMainID ?>'>
    <div class="catalog-item-tile bordered">
    <div class="row g-0 h-100 align-items-center">
    <a href="<?= $item['DETAIL_PAGE_URL'] ?>">


            <div class="new-item__header-properties" style="display:none;">
                <?

                    $ElUrl = $item['DETAIL_PAGE_URL'];

                    $standart = $item['PROPERTY_606_VALUE'];
                    $diametr = $item['PROPERTY_613_VALUE'];
                    $dlina = $item['PROPERTY_612_VALUE'];
                    $material = $item['PROPERTY_610_VALUE'];
                    $pokrytie = $item['PROPERTY_611_VALUE'];
                    $upakovka = $item['PROPERTY_604_VALUE'];
                    
                    $arPrice = CPrice::GetBasePrice($item['ID']);
                    $BuyUrl = $ElUrl.'?action=ADD2BASKET&id='.$item['ID'].= '&QUANTITY=';
                    


                if (!empty($standart)) echo 'Стандарт: '.$standart.'<br>';
                if (!empty($diametr) & !empty ($dlina)) {echo 'Размер: '.'<div class = "otho" style="display: inline-block">'.'&#8960; '. '</div>  '  .$diametr.' x '. $dlina.'<br>' ;}
                else
                {
                    if (!empty($diametr)) echo 'Диаметр: '.$diametr.'<br>';
                    if (!empty($dlina)) echo 'Длина: '.$dlina.'<br>';
                };
                if (!empty($material)) echo 'Материал: '.$material.'<br>';
                if (!empty($pokrytie)) echo 'Покрытие: '.$pokrytie.'<br>';


                ?>
            </div>


        <div class="col-12 new-item__image text-center d-flex align-items-center justify-content-center" id="img_<?=$item["ID"]?>">

            <?;IF (!empty($item['DETAIL_PICTURE'])) {

                $ImgUrl =$item['DETAIL_PICTURE'];
                //echo $ar_fields['DETAIL_PICTURE'];
            } else {

                $foo = CIBlockSection::GetList(array('NAME' => 'ASC'), array('IBLOCK_ID' => "18", 'ID' => $item["IBLOCK_SECTION_ID"]), false, false, Array("ID", "NAME", "DETAIL_PICTURE", "PICTURE"));
                $bar = $foo -> GetNext();

                $ImgUrl = $bar['PICTURE'] ? $bar['PICTURE'] : $bar['DETAIL_PICTURE'];
            }

            $ResizedImg = CFile::ResizeImageGet($ImgUrl,array('width'=>100, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);


            ?><img class="lazy" src="<?echo $ResizedImg['src']?>" alt="<?= $item['NAME'] ?>" id="<?=$item["ID"]?>">
        </div>
        <div class="col-12 catalog-item-tile-name text-center" >
            <?= $formatedname ?>
        </div>
    </a>

        <div class="col-12 text-center new-item__price">
        
        <?
        
      /*  if ( $USER->IsAuthorized() )
        {
            if ($USER->GetID() == '3092') {
                echo $item['ID'];
            }
        }*/
        
        if ($arPrice["PRICE"] == 0):
        
        ?>
        <div class='new-item__price_val'><span>Цена по запросу</span> 
                 <!-- <a href="#w-form-one-click" class="new-item__buy-btn opt"><div class="opt-btn-label">Запросить</div></a> -->
                 
                  <div class="btn-group-blue-small">
                    <a href="#w-form-one-click" class="btn-blue-small">
                        <span>Запросить</span>
                    </a>
                </div>
                 
                </div>
<?php         
                    else:
                       // echo "<div class='new-item__price_val'>".$item["PRICES"]["BASE"]["VALUE"]. '<i class="fa fa-rub" aria-hidden="true"></i></div>';
                    echo "<div class='new-item__price_val'>".$arPrice["PRICE"]. '<i class="fa fa-rub" aria-hidden="true"></i></div>';
                       ?>

                    <?endif?>
        
        <!-- Цена: --> <?/*= $arPrice["PRICE"] == 0 ? 'запросить' : $arPrice["PRICE"] . ' ' . 'р.' */?>
        </div>

        <div class="new-item__footer">
<div class="col-12">
<div class="row g-0">
<div class="col-6 catalog-item-tile-quantity text-center">

<?$pack = $upakovka ? $upakovka : 1;?>

 <div class="catalog-list-quantity-area">
                                <input type="text" name="QUANTITY" class="quantity section_list" id="<?= $item["ID"]?>-item-quantity" size="5" value="<?=$pack?>" step="<?=$pack?>" min="<?=$pack?>">
                <a href="#" class="quantity_link quantity_link_plus" rel="<?= $item["ID"]?>"><span><i class="fa fa-plus"></i></span></a>
                <a href="#" class="quantity_link quantity_link_minus" rel="<?= $item["ID"]?>"><span><i class="fa fa-minus"></i></span></a>
                </div>   
</div>


            <div class="col-6 text-center d-flex align-items-center justify-content-center">
            

            
             <div class="btn-group-blue">
                        <a data-href="<?= $BuyUrl?>" class="btn-cart-round new-item__buy-btn" data-ajax-order-recomended>
                            <span><i class="fa fa-shopping-cart"></i></span>
                        </a>
                    </div>
            
            </div>

            
<!--             <a  class="new-item__buy-btn col x2d3" data-ajax-order-recomended>В корзину</a> -->

</div>
</div>
        </div>
	</div>
    </div>
    </div>


    <?

endforeach;?>
</ul>

    </div>


<?endif;?>

<link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
