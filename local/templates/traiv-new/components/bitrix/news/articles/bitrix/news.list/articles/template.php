<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
?>

<div class="row">
<!-- <div class="articles_area">-->
<!-- <div class="posts-list posts-list-np">-->
<div class="col-12 mb-3">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
</div>

<div class="col-12">
<div class="row posts-list posts-list-np">
    <?
    /*echo "<pre>";
   print_r( $arResult["ITEMS"][0] );
   echo "</pre>";*/
    foreach ($arResult["ITEMS"] as $arItem): ?><?

            if ($arItem['PROPERTIES']['NO_INDEX']['VALUE'] == 'Y'){
                echo "<noindex>";
            }
     
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        
        	<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts2-i" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" itemscope itemtype="http://schema.org/Article">
        	<meta itemprop="author" content="Трайв">
        	<a class="posts-i-a" href="<?=$arItem['DETAIL_PAGE_URL']?>">
		<div class="posts-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>"><span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span></div>
		<meta itemprop="image" content="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"/>
		<time class="posts-i-date" datetime="<?=$arItem['DISPLAY_ACTIVE_FROM'] ?>"><span><?=substr($arItem['DISPLAY_ACTIVE_FROM'],0,2) ?></span> 
		<?php 
		echo month3char(substr($arItem['DISPLAY_ACTIVE_FROM'],3,2));
		$ddd = strtotime($arItem["DISPLAY_ACTIVE_FROM"]);
		$realDP = date("c", $ddd);
		?>
		<meta itemprop="datePublished" content="<? echo $realDP; ?>">  
		
		</time>
		<div class="posts-i-ttl"><div href="<?=$arItem['DETAIL_PAGE_URL']?>"><span itemprop="headline"><?=$arItem['NAME']?></span></div></div>
		<p><?=TruncateText($arItem['PREVIEW_TEXT'], 150)?></p>		
		<div class="articles-more-area">
			<div class="row">
				<div class="col-6">
					<div href="<?=$arItem['DETAIL_PAGE_URL']?>" class="posts-i-more">Подробнее...</div>
				</div>
				
				<div class="col-3 text-right">
    				
    				<div class="articles-char">
                    	<div><i class="fa fa-eye"></i><span>
                    	
                    	
                    	<?php 
                    	$res = CIBlockElement::GetByID($arItem["ID"]);
                    	if($ar_res = $res->GetNext())
                    	    $ar_res_hundred = $ar_res['SHOW_COUNTER'] + 100 + $_SESSION['counter']++;
                    	    echo $ar_res_hundred;
                    	    
                    	/*echo rand(100,4000);*/?></span></div>
                    </div>
    				
				</div>
				
				
				<div class="col-3 text-right">
    				
    				<div class="articles-char">
                    	<div><i class="fa fa-clock-o"></i><span><?php echo rand(5,10);?> мин.</span></div>
                    </div>
    				
				</div>
				
			</div>
		</div>
		</a>
	</div>
        	<?php 
	        if ($arItem['PROPERTIES']['NO_INDEX']['VALUE'] == 'Y'){
	            echo "</noindex>";
	        }
	 
	?>
    <? endforeach; ?>
    </div>
    </div>
    <div class="col-12 mt-3">
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    </div>
<!-- </div> -->
<!-- </div> -->
</div>


