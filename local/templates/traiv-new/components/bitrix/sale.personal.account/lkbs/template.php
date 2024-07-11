<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (is_array($arResult["ACCOUNT_LIST"]))
{
	?>
	<div class="lkbs-container h-100">
		<div class="lkbs-container-title justify-content-center">
			<!-- <div><?=Bitrix\Main\Localization\Loc::getMessage('SPA_BILL_AT')?>
			<?=$arResult["DATE"];?></div>-->
			<?
					foreach($arResult["ACCOUNT_LIST"] as $accountValue)
					{
					    if ($accountValue['CURRENCY'] == 'TRC') {
						?>
							<span><?=$accountValue['SUM']?></span> баллов
						<?
					    }
					}
				?>
		</div>
	</div>
	<?
}