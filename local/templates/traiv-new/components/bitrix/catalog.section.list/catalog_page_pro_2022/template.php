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

<div class="row d-flex align-items-center h-100">
    	<?foreach($arResult['SECTIONS'] as $arSection):?>
    	<?
		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    	?>
	    	<?if(!$sectionsToShow--) break?>
        <? (CSite::InDir('/catalog/index.php')) ? $flag = 'x1d7' : $flag = 'x1d6'?>
        <!-- <li class="col-2 check-data-search" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
        <a href="/catalog/categories/vinty/" class="category-item-link">
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
            </a>-->
            
            <div class="col-lg-4 col-md-6 mb-3 text-md-left text-center">
					<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="fe-item bordered">
    					<div class="row d-flex align-items-center h-100">
        					<div class="col-lg-6 col-md-6 text-md-left text-center">
        						<img src="<?=$arSection['PICTURE']['src']?>" class="img-fluid" alt="<?=$arSection['NAME']?>">
        					</div>
        					<div class="col-lg-6 col-md-6 mb-30 text-md-left text-center">
        						<?=$arSection['NAME']?> <?echo ($arSection['ELEMENT_CNT'] > 0) ? '('.$arSection['ELEMENT_CNT'].')' : ''?>
        					</div>
    					</div>
					</a>
				</div>
            
    	<?endforeach?>
    </div>
<!-- </div> -->
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
