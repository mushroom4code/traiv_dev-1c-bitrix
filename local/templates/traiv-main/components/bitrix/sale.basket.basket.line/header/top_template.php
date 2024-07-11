<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<?if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'):?>
	<div class="bx-basket-block">
		<i class="fa fa-user"></i>
		<?if ($USER->IsAuthorized()):
			$name = trim($USER->GetFullName());
			if (! $name)
				$name = trim($USER->GetLogin());
			if (strlen($name) > 15)
				$name = substr($name, 0, 12).'...';
			?>
			<a href="<?=$arParams['PATH_TO_PROFILE']?>" rel="nofollow"><?=htmlspecialcharsbx($name)?></a>
			&nbsp;
			<a href="?logout=yes"><?=GetMessage('TSB1_LOGOUT')?></a>
		<?else:?>
			<a href="<?=$arParams['PATH_TO_REGISTER']?>?login=yes" rel="nofollow"><?=GetMessage('TSB1_LOGIN')?></a>
			&nbsp;
			<a href="<?=$arParams['PATH_TO_REGISTER']?>?register=yes" rel="nofollow"><?=GetMessage('TSB1_REGISTER')?></a>
		<?endif?>
	</div>
<?endif?>




