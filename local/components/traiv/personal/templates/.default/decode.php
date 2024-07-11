<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
require $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use PhpOffice\PhpSpreadsheet\Writer\Xls;?>
<? include_once 'top.php'; ?>

<div class="row lk_right_menu h-100 g-0">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
	<!-- help -->
	<div class="row d-flex align-items-center lk-item-block g-0 help-decode-area position-relative">
	
	<div class="decode-close-help"><i class="fa fa-remove"></i></div>
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
	<div class="lk-item-block-title-decode">Поиск товаров по вашей номенклатуре</div>
	<p class="pt-3 decode-p-text">Сервис обеспечивает быстрый поиск товаров на основе данных из файла (XLS, XLSX). После загрузки номенклатуры вы получите список товаров, которые смогла найти система. Данные товары вы сможете <b>Добавить в корзину</b> и <b>Оформить заказ</b>.</p>
	

	</div>
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3">
		<div class="row d-flex align-items-center h-100 g-0">
			<div class="col-12 col-xl-6 col-lg-6 col-md-6">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/fileexam.jpg" class="img-responsive"/>
			</div>
			<div class="col-12 col-xl-6 col-lg-6 col-md-6 p-5">
			<p class="pt-3 decode-help-title"><b>Файл должен удовлетворять следующим требованиям:</b></p>
				<ul style="font-size:18px;" class="decode-text-list">
                  <li>Файл Excel в формате XLS, XLSX</li>
                  <li>Строка номенклатуры должна располагаться в первом столбце вашего файла</li>
                  <li>Количество строк в файле не должно быть больше 50</li>
                </ul>
			</div>
		</div>
	</div>
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
	<p class="pt-3 decode-help-title"><b>Загрузка файла и работа с полученными данными:</b></p>
	<p class="pt-3 decode-p-text">Чтобы получить данные по товарам с помощью формы Выберите файл для загрузки и нажмите кнопку Загрузить. После обработки данных из файла вы получите список найденных и не найденных товаров.</p>
	</div>
	
		<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3">
		<div class="row d-flex align-items-center h-100 g-0">
			<div class="col-12 col-xl-6 col-lg-6 col-md-6">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/fileexam1.jpg" class="img-responsive"/>
			</div>
			<div class="col-12 col-xl-6 col-lg-6 col-md-6 p-5">
			<p class="pt-3 decode-help-title"><b>С помощью кнопок вы можетем выполнять следующие действия:</b></p>
<ul style="font-size:18px;" class="decode-text-list">
                  <li>Осуществлять фильтрацию найденных или не найденных товаров и строк</li>
                  <li>Удалять отдельные товары</li>
                  <li>Добавлять в корзину отдельные товары</li>
                  <li>Добавлять в корзину все товары</li>
                  <li>Если на какую-то позицию из вашего файла не будет найден товар, вы можете положить его в корзину. Оператор при обработке вашего заказа, уточнит варианты покупки данного товара</li>
                </ul>
			</div>
		</div>
	</div>
	</div>
	<!-- //help -->
	
	<!-- last-data -->
	<div class="row d-flex align-items-center">
    	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<?php 
    	$hlbl = 15;
    	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
    	
    	$entity = HL\HighloadBlockTable::compileEntity($hlblock);
    	$entity_data_class = $entity->getDataClass();
    	
    	$rsData = $entity_data_class::getList(array(
    	    "select" => array("ID","UF_DECODE_LIST","UF_DATETIME"),
    	    "order" => array("ID" => "ASC"),
    	    "filter" => array("UF_USER_ID"=>$USER->GetID())  // Задаем параметры фильтра выборки
    	));

    	if (intval($rsData->getSelectedRowsCount()) === 1){
    	    while($arData = $rsData->Fetch()){
    	        $decodeList = $arData['UF_DECODE_LIST'];
    	        $decodeDateFile = $arData['UF_DATETIME'];
    	        ?>
    	        <input type="hidden" id="latestDate" value='<?php echo $decodeList;?>'>
    	        <?php 
    	    }
    	}
    	
    	?>
    			
    	</div>
	</div>
	<!-- last-data -->
	
	<div class="row d-flex align-items-center lk-item-block g-0 decode-upload-area">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
	<div class="row d-flex align-items-center h-100 g-0">
	<div class="col-12 col-xl-9 col-lg-9 col-md-9"><div class="lk-item-block-title-decode">Загрузите Ваш файл с номенклатурой (XLS,XLSX)</div></div>
	<div class="col-12 col-xl-3 col-lg-3 col-md-3 text-right">
	<div class="btn-group-blue"><a href="#" class="btn-404 decode-help-link"><span><i class="fa fa-question-circle"></i> Как это работает</span></a></div>
	</div>
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-2">
<!-- <form method="post" id="decodefileForm" enctype="multipart/form-data">-->
  <div class="mb-3">
    <!-- <label for="nomeninput" class="form-label">Загрузка файла (XLS,XLSX,CSV)</label> -->
    <input type="file" id="decodeFileUpload" name="decodeFile" class="show-for-sr">
    <div class="decodeFileUploadError d-none">Выберите файл!</div>
  </div>
  
  <button type="button" class="btn-blue submit-button submit-big-text" id="uploadDecodeFile">Загрузить</button>
<!-- </form> -->
</div>
	</div>
	</div>
	</div>
	
			<!-- FILE -->
		<div class="row d-flex align-items-center lk-item-block g-0 decode-result-area">
		
				            <div class="col-12 col-xl-6 col-lg-6 col-md-6 position-relative decode-control-block d-none">
		            	<div class="decode-button-list d-none">
		            		<span><a href="#" class="decode-tags-area-link" data-filter-res="all"><div class="active">Все позиции из файла</div></a></span>
		            		<span><a href="#" class="decode-tags-area-link" data-filter-res="active"><div class="">Найденные</div></a></span>
		            		<span><a href="#" class="decode-tags-area-link" data-filter-res="none"><div class="">Не найденные</div></a></span>
		            	</div>
		            </div>
		            
		            <div class="col-12 col-xl-6 col-lg-6 col-md-6 position-relative text-right decode-control-block d-none">
		            	<div class="btn-group-blue-small"><a href="#" id="decode-all-to-basket" class="btn-blue-small"><span><i class="fa fa-shopping-cart"></i> Добавить в корзину все товары</span></a></div>
		            </div>
		            
		            <div class="col-12 col-xl-12 col-lg-12 col-md-12 position-relative decode-unsearch-block d-none text-right">
		            <?php 
		            if (!empty($decodeDateFile)){
		                ?>
		                <div class="decodeDateArea">Дата загрузки данных - <?php echo $decodeDateFile;?></div>
		                <?php 
		            }
		            
		            if (isset($_COOKIE["order_decode_list"])){
		                $check = "checked='checked'";
		            } else {
		                $check = "";
		            }
		            ?>
		            <div class="decodeUnsearchArea"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="decodeUnsearch" <?php echo $check;?>><label class="form-check-label" for="decodeUnsearch"><span class="decode_unsearch_label">Добавить ненайденные позиции в комментарий заказа</span></label></div></div>
		            </div>
                    
                    <div class="col-12 col-xl-12 col-lg-12 col-md-12 position-relative">
<div class="decode-preloader-file"></div>

	<div class="row d-none">
				  <div class="col-2 order-1 position-relative text-left"><b>Тип метиза</b></div>
				  <div class="col-2 order-2 position-relative text-left"><b>Стандарт</b></div>
				  <div class="col-1 order-3 position-relative text-left"><b>Диаметр</b></div>
				  <div class="col-1 order-4 position-relative text-left"><b>Длина</b></div>
				  <div class="col-2 order-5 position-relative text-left"><b>Шаг резьбы</b></div>
				  <div class="col-2 order-6 position-relative text-left"><b>Материал</b></div>
				  <div class="col-2 order-7 position-relative text-left"><b>Покрытие</b></div>
</div>

<div id="tableResultfile">

</div>

</div>		
		</div>
		<!-- end FILE -->
	
	
		<div class="row d-flex align-items-center lk-item-block g-0" style="display:none !important;">
		<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<form method="post" id="decodeForm">
  <div class="mb-3">
    <label for="nomeninput" class="form-label">Номенклатура</label>
    <input type="text" name="nomen" class="form-control" id="nomeninput">
    <div class="form-text">Строка номенклатуры - Болт М14Х1,25-6gХ30.88.35.019 ГОСТ 7808-70.</div>
  </div>
  <button type="submit" class="btn-blue submit-button submit-big-text">Отправить</button>
</form>
</div>
<div class="col-12 col-xl-12 col-lg-12 col-md-12 position-relative">
<div class="decode-preloader"></div>
<div class="row" id="tableResult">
	
</div>
</div>
		</div>
		

		
	</div>
</div>
<?
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/decode.js");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/decode.css");
include_once 'bottom.php'; ?>
