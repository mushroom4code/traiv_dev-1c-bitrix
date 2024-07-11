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
if(count($arResult['SECTIONS'])){
?>
<div class="subsection">	
	        <div class='search-text-custom-area'><input type='text' id='search-text-custom' placeholder=''/></div>


    <ul class="row">

    <?
    $j=1;
    foreach($arResult['SECTIONS'] as $arSection):?>

        <? if ($arSection['UF_TAG_SECTION'] == 1) {
            ?>
            <!-- comment 170221 kdv</ul> -->
            </ul>
            <a class="grey-tag-word" href="<?=$arSection['SECTION_PAGE_URL']?>" rel="<?=$arSection['UF_TAG_SECTION'];?>"><?=$arSection['NAME']?><span></span></a>

<?
/*if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092') {*/
	        if($APPLICATION->GetCurPage() == '/catalog/categories/shaiby/' && $j == 1){
	        ?>
<a class="grey-tag-word" href="/catalog/categories/shaiby/din-25201-shaiba-nord-lock/">DIN 25201 Шайба стопорная типа NORD-LOCK<span></span></a>
	        <?php     
	        }
	        $j++;
/*	    }
	}*/
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
        <li class="col <?=$flag?> x1d2--md x1d2--s x2--xs check-data-search" id="<?=$this->GetEditAreaId($arSection['ID'])?>" data-find="<?=$arSection['NAME']?>">
            <a href="<?=$arSection['SECTION_PAGE_URL']?>">
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
        <?/*Закрывающий тег li отсутсвует намеренно*/?>
        </li>
    	<?endforeach?>
    </ul>
</div>
<? } ?>