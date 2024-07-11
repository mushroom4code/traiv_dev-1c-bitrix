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

/*echo '<pre>'; print_r($arResult); echo '</pre>';*/

$select = ['IBLOCK_ID', 'ID', 'NAME', "UF_TAG_LINK", 'PICTURE', 'SECTION_PAGE_URL'];

$sort = ["SORT" => "ASC"];

$filter = [
    'IBLOCK_ID' => 18,
    'UF_TAG_LINK' => $arResult['SECTION']['ID'],
];

$rsResult = CIBlockSection::GetList($sort, $filter, false, $select);
while ($UFResult = $rsResult->GetNext()) {
    $arResult['SECTIONS'][] = $UFResult;
}

/*sort by element-cnt*/
usort($arResult['SECTIONS'], 'sortByOption');
function sortByOption($a, $b) {
    return strnatcmp((int)($b['ELEMENT_CNT']), (int)($a['ELEMENT_CNT']));
}

$i = 0;
foreach($arResult['SECTIONS'] as $arSection1) {
    if ($arSection1['UF_TAG_SECTION'] == '1') {
        $v = $arResult['SECTIONS'][$i];
        unset($arResult['SECTIONS'][$i]);
        $arResult['SECTIONS'][] = $v;
    }
    $i++;
}


$sectionsToShow = 9999;
$check_br = false;
if(count($arResult['SECTIONS'])){

        /*if($APPLICATION->GetCurPage() == "/catalog/po-vidy-materialov/stalnoi-krepezh/") {
        ?>
        <div class="col-12">
        <blockquote><p>Внимание! Данный раздел находится в разработке.</blockquote>
        </div>
        <?php 
        }*/
?>

<div class="col-12" id="subcategory-area" rel="0">
	
<div class='search-text-custom-area'><input type='text' id='search-text-custom' placeholder=''/></div>
    <ul class="row d-flex justify-content-center">

    <?
    if (count($arResult['SECTIONS']) > 10) {
        $shadow = 'Y';
    }
    
    $j=1;
    foreach($arResult['SECTIONS'] as $arSection):?>

        <? if ($arSection['UF_TAG_SECTION'] == 1) {
            if ($check_br == false) {
                echo "<div></div>";
                $check_br = true;
            }
            ?>
            <a class="grey-tag-word" href="<?=$arSection['SECTION_PAGE_URL']?>" rel="<?=$arSection['UF_TAG_SECTION'];?>"><?=$arSection['NAME']?><span></span></a>

<?
if($APPLICATION->GetCurPage() == '/catalog/categories/shaiby/' && $j == 1){
	        ?>
<a class="grey-tag-word" href="/catalog/categories/shaiby/din-25201-shaiba-nord-lock/">DIN 25201 Шайба стопорная типа NORD-LOCK<span></span></a>
	        <?php     
	        }
	        $j++;
	?>

        <?}else{
        /*
            if($arItem['PREVIEW_PICTURE']['ID']){
                $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 261, 'height' => 240), BX_RESIZE_IMAGE_EXACT, true);
            } else{
                $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 200, 'height' => 240), BX_RESIZE_IMAGE_EXACT, true);
            }
           */


		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    	?>
	    	<?if(!$sectionsToShow--) break?>

        <? (CSite::InDir('/catalog/index.php')) ? $flag = 'x1d7' : $flag = 'x1d6'?>
        
        <?php 
        /*if ( $USER->IsAuthorized() )
        {
            if ($USER->GetID() == '3092') {*/
                if ( $arSection['ID'] == '948') {
                    ?>
                    
                    <li class="col-2 check-data-search" id="bx_4145281613_5130" data-find="Шайбы NORD-LOCK/2fix"><a href="/catalog/categories/shaiby/din-25201-shaiba-nord-lock/shayby_nord_lock_2fix/" class="category-item-link"><div class="category-item"><div class="category-item__image"><img src="/upload/adwex.minified/webp/e24/100/e24871238f1953daab0c23a19ce333d6.webp" loading="lazy" alt="Шайбы NORD-LOCK/2fix"></div><div class="category-item__title_mp"><span class="v-aligner">
									Шайбы NORD-LOCK/2fix																	</span></div><div class="category-item-nums"> 15 </div></div></a></li>
                    
                    <?php 
                }
/*            }
        }*/
        ?>
        
        <li class="col-2 check-data-search" id="<?=$this->GetEditAreaId($arSection['ID'])?>" data-find="<?=$arSection['NAME']?>" rel="1">
                <div class="category-item-fullname">
                <?php if ($arSection['NAME'] == 'Режущий инструмент') {
                    $link = "/cutting/";
                } else {
                    $link = $arSection['SECTION_PAGE_URL'];
                }?>
                <a href="<?=$link?>" class="category-item-fullname-text"><?php echo $arSection['NAME'];?></a>
                </div>
            <a href="<?=$link?>" class="category-item-link">
            <div class="category-item">
                <div class="category-item__image">
                    
                        <?if (!isset($arSection['PICTURE']['src'])):
                            $src = CFile::GetPath($arSection['PICTURE']);
                        else:
                            $src = $arSection['PICTURE']['src'];
                        endif;
                        ?>
                    	<img src="<?=$src?>" alt="<?=$arSection['NAME']?>">
                  
                </div>
                
                <div class="category-item__title_mp">
                    <?if (!isset($arSection['ELEMENT_CNT'])):
                    $countElementsInSection = (new CIBlockSection)->GetSectionElementsCount(
                        $arSection['ID'],
                        ['CNT_ACTIVE' => 'Y']
                    );
                    else:
                    $countElementsInSection = $arSection['ELEMENT_CNT'];
                    endif;
                    ?>
								<span class="v-aligner">
									<?=TruncateText($arSection['NAME'],35)?>
									<?/*echo ($countElementsInSection > 0) ? '('.$countElementsInSection.')' : ''*/?>
								</span>
                </div>
                
                <?
	        echo ($countElementsInSection > 0) ? "<div class='category-item-nums'> $countElementsInSection </div>" : '';
	?>
                
            </div>
            </a>
            <?}?>
            </li>
        <?/*Закрывающий тег li отсутсвует намеренно*/?>
    	<?endforeach?>
    	<?php
    	if ($shadow == 'Y'){
        	?>
        		<div class="subcategory-area-shadow"></div>
        	<?php 
    	}
    	?>
    </ul>
</div>

<?php
    	if ($shadow == 'Y'){
        	?>
<div class='text-center' id="subcategory-link-more-area">
	<a href="#" class="subcategory-link-more"><span>Больше категорий</span><i class="fa fa-angle-down"></i></a>
</div>
<? } ?>

<? } ?>