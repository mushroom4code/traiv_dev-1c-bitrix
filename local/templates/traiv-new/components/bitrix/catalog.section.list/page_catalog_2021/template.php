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

$sectionsToShow = 1;
        ?>
        <div class="row h-100 mb-3">
    	<div class="col-lg-4 col-md-6 text-md-left text-center" id="<?=$this->GetEditAreaId($arResult['SECTIONS'][0]['ID'])?>">
        	<a href="<?=$arResult['SECTIONS'][0]['SECTION_PAGE_URL']?>" class="ca-item bordered text-center ca_main_title">
        	<img src="<?=$arResult['SECTIONS'][0]['RESIZE_IMAGE']['src']?>" alt="<?=$arResult['SECTIONS'][0]['NAME']?>" class="img-fluid mb-3" alt="img">
        	<div class="mb-0"><?/*=$arResult['SECTIONS'][0]['NAME']*/?>Все категории товаров</div>
        	<p class="mb-0">(<?=$arResult['SECTIONS'][0]['ELEMENT_CNT']?>)</p>
        	</a>
    	</div>
    	<div class="col-lg-8 col-md-6 col-sm-12 mb-30 text-md-left text-center">
    	<div class="row d-flex align-items-center">
    	<?
    	foreach($arResult['SECTIONS'] as $arSection){
    	    if ($sectionsToShow !== 1) {
    	        
		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			if ($sectionsToShow > 4){
			    $mt = "mt-4";
			}
			?>
    	<div class="col-lg-4 col-md-6 col-sm-6 <?php echo $mt;?> text-md-left text-center" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
            <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="ca-item bordered text-center">
    			<div class="text-center ca-item-img-area">
    			<img src="<?=$arSection['RESIZE_IMAGE']['src']?>" alt="<?=$arSection['NAME']?>" class="img-fluid mb-3 ca-item-img" alt="img">
    			</div>
    			<span class="mb-0 ca-item-title-child"><?=$arSection['NAME']?></span>
    			<p class="mb-0 ca-item-rows-child">(<?=$arSection['ELEMENT_CNT']?>)</p>
    		</a>
        </div>
    	<?
    	    }
    	    $sectionsToShow++;
}?>
</div>
</div>
</div>

        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-md-left text-left">
        <?If (!$isGetFilter):?>
<div class="section_description" style="min-height: 94px !important;margin-bottom: 0px;">
    <p>Машиностроение, приборостроение, строительство вообще, и монтаж стальных конструкций в частности, не возможен без применения крепежа. В этом разделе вы можете найти наиболее популярные виды метизов, которые применяются при выполнении отделочных и ремонтных работ, устройстве различных коммуникаций, и т.д. Мы постарались собрать все возможные варианты, чтобы вы могли подобрать крепеж в точном соответствии с предстоящими работами и материалами. Помимо стандартных, общеизвестных видов крепежа, есть множество специализированных.</p>
</div>
<? endif; ?>
        </div>
        </div>

        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30 text-md-left text-left">
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
        </div>
        </div>

