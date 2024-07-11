<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if($arResult['FILE']!=''):?>
	<div class='wd_marque wd_marque_08'>
		<?$arResult['MARQUE']->Begin();?>
		<?include($arResult['FILE']);?>
		<?$arResult['MARQUE']->End();?>
	</div>
<?endif?>