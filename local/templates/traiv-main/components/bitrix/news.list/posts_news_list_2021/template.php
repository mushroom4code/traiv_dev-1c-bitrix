<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<!-- <div class="traiv-news-list-main-page-news">-->

<?php
    if(count($arResult['ITEMS']) > 0){
?>

    <h3 class="md-title md-title--blue" style="font-size: 22px;">Похожие статьи</h3>

    <!-- <div class="row">-->
    
        <?
        function month3char($mname){
            
            if ($mname == '01'){
                $mname_true = "янв";
            }
            else if ($mname == '02'){
                $mname_true = "фев";
            }
            else if ($mname == '03'){
                $mname_true = "мар";
            }
            else if ($mname == '04'){
                $mname_true = "апр";
            }
            else if ($mname == '05'){
                $mname_true = "май";
            }
            else if ($mname == '06'){
                $mname_true = "июн";
            }
            else if ($mname == '07'){
                $mname_true = "июл";
            }
            else if ($mname == '08'){
                $mname_true = "авг";
            }
            else if ($mname == '09'){
                $mname_true = "сен";
            }
            else if ($mname == '10'){
                $mname_true = "окт";
            }
            else if ($mname == '11'){
                $mname_true = "ноя";
            }
            else if ($mname == '12'){
                $mname_true = "дек";
            }
            return $mname_true;
        }
        foreach($arResult['ITEMS'] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            
	<div class="col x2d6 x1d2--md x1d1--s x2--xs posts2-i" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a class="posts-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>"><span style="background: url(<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>)"></span></a>
		<time class="posts-i-date" datetime="<?=$arItem['DISPLAY_ACTIVE_FROM'] ?>"><span><?=substr($arItem['DISPLAY_ACTIVE_FROM'],0,2) ?></span> 
		<?php 
		echo month3char(substr($arItem['DISPLAY_ACTIVE_FROM'],3,2));
		?>
		</time>
		<h3 class="posts-i-ttl"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
		<p><?=TruncateText($arItem['PREVIEW_TEXT'], 150)?></p>		<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="posts-i-more">Подробнее...</a>
	</div>
            
            <!-- <div class="col x1d2 x1d1--s" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="preview-item">
                    <div class="image" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>)"></div>
                    <div class="description">
                        <div class="date"><?=$arItem['DISPLAY_ACTIVE_FROM'] ?></div>
                        <h4 class="preview-item__title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                        </h4>

                        <div class="text"><?=TruncateText($arItem['PREVIEW_TEXT'], 150)?></div>
                    </div>

                </div>
            </div>-->
        <?endforeach;?>
<?php 
    }
?>
    <!-- </div>
</div>-->