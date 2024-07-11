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

$sectionsToShow = 1;
        ?>
        <ul class="catalog_parents_left_menu">
    	<?
    	$i = 0;
    	foreach($arResult['SECTIONS'] as $arSection){
    	    if ($sectionsToShow !== 1) {
    	        
		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			if ($i >= 7)
			{
			    $style = "action";
			}
			else {
			    $style = "";
			}
			?>
			<li>
            <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="text-left catalog_parents_left_menu <?php echo $style;?>">
    			<span class=""><?=$arSection['NAME']?></span>
    		</a>
    		</li>
    	<?
    	$i++;
    	    }
    	    $sectionsToShow++;
}?>
</ul>
<a href="#" class="catalog_parents_left_menu_all">Показать все...</a>


