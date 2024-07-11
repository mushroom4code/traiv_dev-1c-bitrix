<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Онлайн калькулятор массы крепежа. Моментальный перевод метизов из шт в кг и из кг в штуки. Считайте потребность в крепеже правильно!");
$APPLICATION->SetTitle("Калькулятор метизов: расчет веса крепежа в режиме онлайн");
?><section id="content">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "",
		"SITE_ID" => "zf",
		"START_FROM" => "0"
	)
);?>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Калькулятор расчета веса крепежа и метизов</span></h1>
    </div>
</div>

 <?
 
 if ( $USER->IsAuthorized() )
 {
     if (/*$USER->GetID() == '3092'*/1==2) {
         ?>
         
         <div style="background-color:#f1f1f1;padding:20px 0px;margin:30px 0px;">
         
              <form method="post" id="decodeForm">
     	<div class="container">
            	<div class="row position-relative">
            	
            	<!-- <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left">
            		<div class="apicalc-form-input">
            			<input type="hidden" name="metiz" id="metizIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Тип метиза:</label>
            			<select class="form-select" id="metizList">
            			<option value="0">Начать</option>
            			</select>
            		</div>
            	</div>-->
            	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center text-sm-left">
            		<div class="apicalc-form-input">
            			<input type="text" class="form-control" id="searchStandartcalc" placeholder="Поиск по стандарту"/>
            		</div>
            		<div class="apicalc-form-input">
            			<input type="hidden" name="standartId" id="standartIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Стандарт:</label>
            			<select class="form-select" id="standartList" size="5">
            			<!-- <option value="0">Начать</option>-->
            			</select>
            		</div>
            	</div>
            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left">
            	<div class="apicalc-form-input">
            			<input type="hidden" name="diametrId" id="diametrIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Диаметр:</label>
            			<select class="form-select" id="diametrList" disabled="disabled">
            			<option value="0"></option>
            			</select>
            		</div>
            	</div>
            	
            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left">
            	<div class="apicalc-form-input">
            			<input type="hidden" name="dlinaId" id="dlinaIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Длина:</label>
            			<select class="form-select" id="dlinaList" disabled="disabled">
            			<option value="0"></option>
            			</select>
            		</div>
            	</div>
            	
            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left">
            	<div class="apicalc-form-input">
            			<input type="hidden" name="materialId" id="materialIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Материал:</label>
            			<select class="form-select" id="materialList" disabled="disabled">
            			<option value="0"></option>
            			</select>
            		</div>
            	</div>
            	
            	
            	</div>
            	
            	<div class="row position-relative">
                	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left">
                		<div class="apicalc-form-input">
                		  	<label for="exampleFormControlInput1" class="form-label">Количество (шт.):</label>
  							<input type="text" class="form-control" id="calculate-sht" value="1000" autocomplete="off" disabled="disabled">
						</div>
                	</div>	
                	
                	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left">
                		<div class="apicalc-form-input">
                		  	<label for="exampleFormControlInput2" class="form-label">Вес (кг.):</label>
  							<input type="text" class="form-control" id="calculate-weight" value="" autocomplete="off" disabled="disabled">
						</div>
                	</div>	
            	</div>
            	
     </div>
     </form>
     <input type="hidden" id="resultval"/>
     </div>
         <?php 
     }
     else {
         $APPLICATION->IncludeComponent(
             "traiv:calculator1",
             "",
             Array(
                 "AJAX_MODE" => "Y"
             )
             );
     }
 }
 else
 {
     $APPLICATION->IncludeComponent(
         "traiv:calculator1",
         "",
         Array(
             "AJAX_MODE" => "Y"
         )
         );
 }
 
?>
<br>
<br>
<?php
        $link_bp = $APPLICATION->GetCurPage(false);
        
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(6)->fetch();
        
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        
        $data = $entity_data_class::getList(array(
            "select" => array("*"),
            "filter" => array(
                'LOGIC' => 'AND',
                array('%=UF_BP_LINK' => '%'.$link_bp.'%')
            )
        ));
        
        if (intval($data->getSelectedRowsCount()) > 0){
            while($arData = $data->Fetch()){
                $tolink = $arData['UF_BP_LINK_TO'];
                $bptype = $arData['UF_BP_TYPE'];
                $bptext = $arData['UF_BP_TEXT'];
            }
            
            ?>
		<div class="bp-area">
      		<div class="bp-area-content"><span><?php echo $bptext;?></span></div>	
      		<div class="bp-area-button">
      			<div class="btn-group-blue"><a href="<?php echo $tolink;?>" class="btn-cart-roundw-big font new-item-line-buy"><span>Заказать на производстве!</span></a></div>
      		</div>
      	</div>
<?php
             
        }
        ?>

<p>Специалисты компании &laquo;Трайв-Комплект&raquo; разработали и ввели в действие новейший калькулятор расчета массы крепежа. Инструмент дает возможность быстро, в режиме онлайн, пересчитать метизы из штук в килограммы или обратно. Процедура особенно важна для заказов с большими объемами и широкой номенклатурой.</p>

<p>Посредством калькулятора крепежа удобно выполнять предварительный онлайн расчет веса по всему перечню закупаемых позиций. Промежуточные результаты система сохраняет и суммирует их по общему итогу. Финальный документ можно сохранить, распечатать или отправить в корзину для оформления заказа.</p>

	</div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
);?></section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>