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

if (!empty($_GET['tip_tovara'] || $_GET['standart'] || $_GET['diametr_1'] || $_GET['dlina_1'] || $_GET['material_1'] || $_GET['measurment'])) {$isGetFilter = 'Y';};

$sectionsToShow = 9999;
if(count($arResult['SECTIONS'])){
?>

<?If (!$isGetFilter):?>
<div class="section_description" style="min-height: 94px !important;">
    <p>Машиностроение, приборостроение, строительство вообще, и монтаж стальных конструкций в частности, не возможен без применения крепежа. В этом разделе вы можете найти наиболее популярные виды метизов, которые применяются при выполнении отделочных и ремонтных работ, устройстве различных коммуникаций, и т.д. Мы постарались собрать все возможные варианты, чтобы вы могли подобрать крепеж в точном соответствии с предстоящими работами и материалами. Помимо стандартных, общеизвестных видов крепежа, есть множество специализированных.</p>
</div>
<? endif; ?>

<div class="subsection">
    <!--
<div class="text-aligner">
        <div class="text-aligner__cell">
            <h2 class="md-title md-title--blue">Каталог изделий по виду крепежа</h2>
        </div>
    </div>
	-->
    <ul class="row">
    	<?foreach($arResult['SECTIONS'] as $arSection):?>
    	<?
        /*
            if($arItem['PREVIEW_PICTURE']['ID']){
                $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 261, 'height' => 240), BX_RESIZE_IMAGE_EXACT, true);
            } else{
                $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 200, 'height' => 240), BX_RESIZE_IMAGE_EXACT, true);
            }
           */


		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    	?>
	    	<?if(!$sectionsToShow--) break?>
        <? (CSite::InDir('/catalog/index.php')) ? $flag = 'x1d7' : $flag = 'x1d6'?>
        <li class="col <?=$flag?> x1d2--md x1d2--s x2--xs" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
            <div class="category-item">
                <div class="category-item__image">
                    <a href="<?=$arSection['SECTION_PAGE_URL']?>">
                    	<img src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['NAME']?>" class="lazy">
                    </a>
                </div>
                <h4 class="category-item__title">
								<span class="v-aligner">
									<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="v-aligner__cell"><?=$arSection['NAME']?>
									<?echo ($arSection['ELEMENT_CNT'] > 0) ? '('.$arSection['ELEMENT_CNT'].')' : ''?></a>
								</span>
                </h4>
            </div>
        <?/*Закрывающий тег li отсутсвует намеренно*/?>
    	<?endforeach?>
    </ul>
</div>
<? } ?>
<?If (CSite::InDir('/catalog/index.php') && !$isGetFilter):?>

<div class="section_description ">


    <h2>Разновидности металлического крепежа</h2>

    <p>Для того, чтобы не ошибиться с выбором метизов, необходимо понимать, для каких видов работ они лучше всего подходят. В нашем каталоге вы можете найти следующие виды крепежных материалов:</p>

    <ul>
        <li>Дюбели;</li>
        <li>Анкеры;</li>
        <li>Саморезы;</li>
        <li>Шайбы;</li>
        <li>Штифты, шплинты;</li>
        <li>Шпильки;</li>
        <li>Гайки, винты, болты;</li>
        <li>Скобяные изделия.</li>
    </ul>

    <p>Мы создали наш каталог так, чтобы процесс выбора подходящего метиза происходил максимально просто, и не занимал много времени. Компания &laquo;Трайв-Комплект&raquo; предлагает своим покупателям такие специфические метизы, как:</p>

    <ul>
        <li>Болты с правосторонней и левосторонней резьбой;</li>
        <li>Дюймовый крепеж;</li>
        <li>Полиамидный крепеж;</li>
        <li>Метизы малых размеров;</li>
        <li>Запатентованные элементы Mungo;</li>
        <li>Химические анкеры;</li>
        <li>Дюбели для фасада;</li>
        <li>Перфорированный крепеж.</li>
    </ul>

    <p>Для оптовых покупателей, пользующихся нашим порталом, предусмотрены преференции в виде скидки, позволяющей экономить от 5 до 20% по отношению к рыночной стоимости метизов. Размер скидки устанавливается исходя из истории сотрудничества и объема заказа.</p>

    <p>Если вы затрудняетесь с выбором подходящих метизов, позвоните нашим специалистам, они смогут ответить на любые вопросы, и помогут составить грамотный заказ исходя из потребностей клиента и выделенного бюджета.</p>
</div>
<?endif;?>
