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

$sectionsToShow = 7;
        ?>
        <div class="subsection">
    <div class="text-aligner">
        <div class="text-aligner__cell">
			<h1 class="md-title md-title--blue" style="text-align:left;">Каталог крепежа и метизов</h1>
        </div>
        <div class="text-aligner__cell">
			<a href="/catalog/" class="iconed iconed--right index">
                <span>Показать весь каталог товаров</span>
                <i class="icon icon--add index"></i>
            </a>
        </div>
    </div>
    <ul class="row">
    	<?foreach($arResult['SECTIONS'] as $arSection):?>
    	<?
		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    	?>
	    	<?if(!$sectionsToShow--) break?>
        <li class="col x1d7 x1d3--md x1d2--s x2--xs" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
        <a href="<?=$arSection['SECTION_PAGE_URL']?>">
            <div class="category-item">
                <div class="category-item__image">
                    	<img src="<?=$arSection['RESIZE_IMAGE']['src']?>" alt="<?=$arSection['NAME']?>">
                </div>
                <div class="category-item__title_mp">
								<span class="v-aligner">
									<?=$arSection['NAME']?> (<?=$arSection['ELEMENT_CNT']?>)
								</span>
                </div>
            </div>
            </a>
        </li>
    	<?endforeach?>
    </ul>
    <div class="hide-desctop" style="text-align: center;">
		<a href="/catalog/" class="iconed iconed--right">
                <span>Показать весь каталог товаров</span>
                <i class="icon icon--add"></i>
            </a>
    </div>
</div>

