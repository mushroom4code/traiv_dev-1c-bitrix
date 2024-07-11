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
        foreach ($arResult["ITEMS"] as $arItem): ?><?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        
        	<div class="col-4 posts2-i" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<a class="posts-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>"><span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span></a>
		<time class="posts-i-date" datetime="<?=$arItem['DISPLAY_ACTIVE_FROM'] ?>"><span><?=substr($arItem['DISPLAY_ACTIVE_FROM'],0,2) ?></span> 
		<?php 
		echo month3char(substr($arItem['DISPLAY_ACTIVE_FROM'],3,2));
		?>
		</time>
		<div class="posts-i-ttl"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
		<p><?=TruncateText($arItem['PREVIEW_TEXT'], 150)?></p>		
		<div class="articles-more-area">
			<div class="row">
				<div class="col-6">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="posts-i-more">Подробнее...</a>
				</div>
				
				<div class="col-3 text-right">
    				
    				<div class="articles-char">
                    	<div><i class="fa fa-eye"></i><span><?php echo rand(100,4000);?></span></div>
                    </div>
    				
				</div>
				
				
				<div class="col-3 text-right">
    				
    				<div class="articles-char">
                    	<div><i class="fa fa-clock-o"></i><span><?php echo rand(5,10);?> мин.</span></div>
                    </div>
    				
				</div>
				
			</div>
		</div>
	</div>
        
    <? endforeach; ?>
<?php 
    }
?>
    <!-- </div>
</div>-->