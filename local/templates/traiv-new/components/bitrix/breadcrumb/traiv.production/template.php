<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (empty($arResult)) return;
$lastCrumb = array(
  'index'=> count($arResult) -1,
  'class'=> 'is-active',
  'href'=> '#'
);

ob_start();
?>
<ul class="crumbs">
	<li class="crumbs__item">
		<a href="/" class="crumbs__link">
			<i class="icon--home"></i>
		</a>
	</li>
	<?for ($index = 0; $index <= $lastCrumb['index']; $index++):?>
	<?
		$crumbTitle = htmlspecialcharsex($arResult[$index]["TITLE"]);
		$isLast = ($index === $lastCrumb['index']);
		$crumbClass = $isLast ? $lastCrumb['class'] : '';
		$crumbHref = $isLast ? $lastCrumb['href'] : $arResult[$index]['LINK'];
	?>
	<li class="crumbs__item <?=$crumbClass?>">
		<? if(!$isLast){ ?>
			<a href="<?=$crumbHref?>" class="crumbs__link"><?=$crumbTitle?></a>
		<? }else{ ?>
		<h1 class="crumbs__link"><?=$crumbTitle?></h1>
		<? } ?>
	</li>
	<?endfor?>
</ul>
<?
$output = ob_get_contents();
ob_end_clean();
return $output;

