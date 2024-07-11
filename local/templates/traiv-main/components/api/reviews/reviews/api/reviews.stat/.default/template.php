<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent         $component
 *
 * @var array                    $arParams
 * @var array                    $arResult
 *
 * @var string                   $templateName
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var array                    $templateData
 *
 * @var string                   $componentPath
 * @var string                   $parentTemplateFolder
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */

//$this - объект шаблона
//$component - объект компонента

//$this->GetFolder()
//$tplId = $this->GetEditAreaId($arResult['ID']);

//Объект родительского компонента
//$parent = $component->getParent();
//$parentPath = $parent->getPath();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(method_exists($this, 'setFrameMode'))
	$this->setFrameMode(true);

if($arParams['INCLUDE_CSS'] == 'Y') {
	$this->addExternalCss($templateFolder . '/theme/' . $arParams['THEME'] . '/style.css');
}

include 'ajax.php';

/*
$reviewsId = "API_REVIEWS_STAT_" . $component->randString();
?>
<div id="<?=$reviewsId?>">
	<?
	$dynamicArea = new \Bitrix\Main\Page\FrameStatic(ToLower($reviewsId));
	$dynamicArea->setAnimation(true);
	$dynamicArea->setStub('');
	$dynamicArea->setContainerID($reviewsId);
	$dynamicArea->startDynamicArea();
	include 'ajax.php';
	$dynamicArea->finishDynamicArea();
	?>
</div>
<?
*/
?>
