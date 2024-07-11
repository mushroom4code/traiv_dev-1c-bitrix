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
//$this->setFrameMode(true);
?>
<div class="row d-flex align-items-center">
<? foreach ($arResult['ITEMS'] as $item): ?>
        <?
        //$itemPicture = $item['DETAIL_PICTURE'] ? $item['DETAIL_PICTURE'] : $item['PREVIEW_PICTURE'] ? $item['PREVIEW_PICTURE'] : $arResult['LIST_PICT'];

        $widthsizen="200";
        $heightsizen="200";

        $arFileTmpn = CFile::ResizeImageGet(
            $item['PREVIEW_PICTURE'],
            array("width" => $widthsizen, "height" => $heightsizen),
            BX_RESIZE_IMAGE_EXACT,
            true, $arFilter
        );
        
        $itemPicture = array(
            'SRC' => $arFileTmpn["src"],
            'WIDTH' => $arFileTmpn["width"],
            'HEIGHT' => $arFileTmpn["height"],
        );
        ?>
		<?
		$this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction(
			$item['ID'],
			$item['DELETE_LINK'],
			$strElementDelete,
			$arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($item['ID']);

        $origname = $item["NAME"];
        $formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$origname);
        $formated2name = preg_replace("/КИТАЙ/","",$formated1name);
        $formated3name = preg_replace("/КАНТ/","",$formated2name);
        $formated4name = preg_replace("/Китай/","",$formated3name);
        $formated5name = preg_replace("/Россия/","",$formated4name);
        $formated6name = preg_replace("/Европа/","",$formated5name);
        $formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated6name);
		?>
		
		<div class="col-lg-4 col-md-6 mb-3 text-md-left text-center">
			<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="fe-item bordered">
				<div class="row d-flex align-items-center h-100">
					<div class="col-lg-6 col-md-6 text-md-left text-center">
					<?php 
					if ( $USER->IsAuthorized() )
					{
					    if ($USER->GetID() == '3092') {
					/*echo $itemPicture['SRC'];
					echo "<br>";*/
					    }
					}
					
					?>
					<div style="height:150px;" class="d-flex align-items-center">
							<img src="<?=$itemPicture['SRC']?>" class="img-fluid" alt="<?=$formatedname?>" title="<?=$formatedname?>"">
							</div>
					</div>
					<div class="col-lg-6 col-md-6 mb-30 text-md-left text-center">
						<div><?= $formatedname ?></div>
					</div>
				</div>
			</a>
		</div>
	<? endforeach; ?>
</div>
     