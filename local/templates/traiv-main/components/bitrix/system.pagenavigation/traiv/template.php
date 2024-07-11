<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$page_counts = array("12","36","62","80");

?>

<div class="u-offset-top-25 overflow-h">
	<div class="row">
		<div class="col x2d10 x1d1--t">
            <? if($arResult["nEndPage"] > 1){ ?>
			<ul class="pagination">
                <?if($arResult["NavPageNomer"] > 1):?>
                    <li class="pagination__item"><a
                            class='pagination__link'
                            rel="prev"
                            href='<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>'>&lt;</a></li>
                <?endif?>
                <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
                    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?><li class="pagination__item is-active"><a class='pagination__link'
                                href="#"><?=$arResult["nStartPage"]?>
                            </a></li><?else:?>
                        <?php
                            $rel = '';
                            if(abs($arResult["nStartPage"] - $arResult["NavPageNomer"]) == 1){
                                $rel = $arResult["nStartPage"] - $arResult["NavPageNomer"] > 0 ? 'next' : 'prev';
                            }else{
                                $rel = '';
                            }
                        ?><li class="pagination__item"><a class='pagination__link'
                               rel="<?= $rel ?>"
                                href='<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>'><?=$arResult["nStartPage"]?></a></li><?endif?>
                    <?$arResult["nStartPage"]++?>
                <?endwhile?>

                <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                    <li class="pagination__item"><a
                            class='pagination__link'
                            rel="next"
                            href='<?= $arResult["sUrlPath"] ?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>'>&gt;</a></li>
                <?endif?>

			</ul>
            <?}?>
		</div>

		<div class="col x1d4 u-align-right">Показать по:</div>

		<div class="col x2d10">
			<ul class="pagination">
				<? foreach ($page_counts as $page_count) {?>
					<li class="pagination__item <?if($_SESSION["PAGE_COUNT"] == $page_count) echo "is-active";?>">
						<a class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("PAGE_COUNT=$page_count",array("PAGE_COUNT")); ?>'><?=$page_count?></a>
					</li>
				<?}?>
				<?/*
					<li class="pagination__item <?if($_REQUEST["PAGE_COUNT"]==$arResult["NavRecordCount"]) echo "is-active";?>">
						<a class='pagination__link' style="width:30px;" href='<?=$APPLICATION->GetCurPageParam("PAGE_COUNT=". $arResult["NavRecordCount"] ,array("PAGE_COUNT")); ?>'>Все</a>
					</li>
				*/?>
			</ul>
		</div>

        <? if(explode('/', $APPLICATION->GetCurDir())[1] == 'catalog'){ ?>
            <div class="col x4d12  u-align-right u-pull-right">
                <ul class="pagination">
                    <li class="pagination__item <?if($_SESSION["catalog_items_in_list"]=="y") echo "is-active";?>">
                        <a title="Список" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("catalog_items_in_list=y",array("catalog_items_in_list")); ?>'><i class="icon icon--menu fa fa-th-list"></i></a>
                    </li>
                    <li class="pagination__item <?if($_SESSION["catalog_items_in_list"]=="n") echo "is-active";?>">
                        <a title="Плитка" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("catalog_items_in_list=n",array("catalog_items_in_list")); ?>'><i class="icon icon--menu fa fa-th-large"></i></a>
                    </li>
                </ul>
            </div>
        <? } ?>
	</div>
</div>
