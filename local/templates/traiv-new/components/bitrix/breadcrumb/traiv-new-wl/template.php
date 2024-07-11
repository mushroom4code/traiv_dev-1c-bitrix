<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (empty($arResult)) return;
$lastCrumb = array(
  'index'=> count($arResult) -1,
   'indexPl'=> count($arResult) -2,
  'class'=> 'is-active',
  'href'=> '#'
);

ob_start();
?>
<ul class="crumbs">
	<li class="crumbs__item">
		<a href="/" class="crumbs__link">
			Главная страница
		</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<?for ($index = 0; $index <= $lastCrumb['index']; $index++):?>
	<?
		$crumbTitle = htmlspecialcharsex($arResult[$index]["TITLE"]);
		$isLast = ($index === $lastCrumb['index']);
		$isLastPl = ($index === $lastCrumb['indexPl']);
		$crumbClass = $isLast ? $lastCrumb['class'] : '';
		$crumbHref = $isLast ? $lastCrumb['href'] : $arResult[$index]['LINK'];
	?>
	<li class="crumbs__item <?=$crumbClass?>">
		<? if(!$isLast){ ?>
			<a href="<?=$crumbHref?>" class="crumbs__link"><?=$crumbTitle?></a>
			<?php
			if(!$isLastPl){
			    ?>
			    <i class="fa fa-angle-right fa_bread"></i>
			    <?php 
			} else {
			    
			}
			?>
			
		<? }else{ 
		    /*if ($crumbTitle == "Новости") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    else if ($crumbTitle == "Статьи о крепеже и метизах") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    if ($crumbTitle == "Технический раздел") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    else if ($crumbTitle == "Акции") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    else */if ($crumbTitle == "Стандарты") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    else if ($crumbTitle == "Направления") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    else if ($crumbTitle == "Производители") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    else if ($crumbTitle == "По виду материалов") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    else if ($crumbTitle == "По свойствам") {
		        echo "<h1 class='crumbs__link'>".$crumbTitle."</h1>";
		    }
		    
		?>
		<!-- <span class="crumbs__link"><?=$crumbTitle?></span>  -->
		<? } ?>
		
	</li>
	<?endfor?>
</ul>
<?
$output = ob_get_contents();
ob_end_clean();
return $output;

