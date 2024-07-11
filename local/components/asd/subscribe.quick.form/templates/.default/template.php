<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (method_exists($this, 'setFrameMode')) {
	$this->setFrameMode(true);
}
?>
<div class="pad-h15">
	<h2 style="color:#777;">Подписаться на новости</h2>
</div>
<?
if ($arResult['ACTION']['status']=='error') {
	echo("<div class='island-15'><div class='red-text'>".$arResult['ACTION']['message']."</div></div>") ;
} elseif ($arResult['ACTION']['status']=='ok') {

	//ShowNote($arResult['ACTION']['message']);
	?><div class='island-15'><div class="green-text">Вы подписаны на новостную рассылку!</div></div><?
	return;
}
?>
<div id="asd_subscribe_res" class="dashboard__col "></div>
<form action="<?= POST_FORM_ACTION_URI?>" method="post" id="asd_subscribe_form"  class="dashboard__col js-validate">

	<?= bitrix_sessid_post()?>
	<input type="hidden" name="asd_subscribe" value="Y" />
	<input type="hidden" name="charset" value="<?= SITE_CHARSET?>" />
	<input type="hidden" name="site_id" value="<?= SITE_ID?>" />
	<input type="hidden" name="asd_rubrics" value="<?= $arParams['RUBRICS_STR']?>" />
	<input type="hidden" name="asd_format" value="<?= $arParams['FORMAT']?>" />
	<input type="hidden" name="asd_show_rubrics" value="<?= $arParams['SHOW_RUBRICS']?>" />
	<input type="hidden" name="asd_not_confirm" value="<?= $arParams['NOT_CONFIRM']?>" />
	<input type="hidden" name="asd_key" value="<?= md5($arParams['JS_KEY'].$arParams['RUBRICS_STR'].$arParams['SHOW_RUBRICS'].$arParams['NOT_CONFIRM'])?>" />


	<div class="form-control-row">
		<label for="asd_email" class="sm-title">Ваш E-mail</label>
		<input type="text" placeholder="anymail@mail.ru" name="asd_email"  value="" class="form-control" id="asd_email">
	</div>

	<?if (isset($arResult['RUBRICS'])):?>
		<div class="form-control-row">
		<h4 class="sm-title">Подписки</h4>
			<div class="u-push-left">
				<?foreach($arResult['RUBRICS'] as $RID => $title):?>
					<label class="checkbox">
						<input type="checkbox" name="asd_rub[]" id="rub<?= $RID?>" value="<?= $RID?>" class="checkbox__input"/>
						<span class="checkbox__inner"><?= $title?></span>
					</label>
				<?endforeach;?>
			</div>
		</div>
	<?endif;?>

	<div class="u-align-center">
		<button value='y' type='submit' id="asd_subscribe_submit" name="asd_submit" class='btn btn--submit'><?=GetMessage("ASD_SUBSCRIBEQUICK_PODPISATQSA")?></button>
	</div>
</form>