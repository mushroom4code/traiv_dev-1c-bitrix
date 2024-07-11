<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;?>
<?if (is_array($arResult)):?>

        <nav id="main-nav">
  <ul>
    <li><a href="#">Услуги производства</a>
    
    <ul>
    <?php 
    foreach ($arResult['utp_menu'] as $key=>$val){
        ?>
        <li><a href="<?php echo $val['LINK'];?>"><?php echo $val['NAME'];?></a></li>
        <?php 
    }
    ?>
        
    </ul>
    
    </li>
    <li>
      <a href="#">Производство на заказ (по чертежам)</a>
      <ul>
        
        <?php 
        foreach ($arResult['pro_menu'] as $key=>$val){
            //if (count($val['SUBMENU']) > 0){
            if(is_array($val['SUBMENU']) && count($val['SUBMENU'])>0){
                $link = "#";
            } else {
                $link = $val['LINK'];
            }
            ?>
        <li><a href="<?php echo $link?>"><?php echo $val['NAME']?></a>
        <?php 
        //if (count($val['SUBMENU']) > 0){
        if(is_array($val['SUBMENU']) && count($val['SUBMENU'])>0){
            ?>
         <ul>
        <?php 
        foreach ($val['SUBMENU'] as $keysub=>$valsub){
            ?>
            <li><a href="<?php echo $valsub['LINK'];?>"><?php echo $valsub['NAME'];?></a></li>
            <?php 
        }
        ?>
            
        </ul>   
            <?php 
        }
        ?>
        </li>    
            <?php 
        }
        ?>
      </ul>
    </li>
        <li><a href="#">Нанесение покрытий</a>
    
    <ul>
    <?php 
    foreach ($arResult['coating_menu'] as $key=>$val){
        ?>
        <li><a href="<?php echo $val['LINK'];?>"><?php echo $val['NAME'];?></a></li>
        <?php 
    }
    ?>
        
    </ul>
    
    
    </li>
    
    <li><a href="#">Изготовление крепежа большого размера</a>
    
    <ul>
    <?php 
    foreach ($arResult['utp_menu_big'] as $key=>$val){
        ?>
        <li><a href="<?php echo $val['LINK'];?>"><?php echo $val['NAME'];?></a></li>
        <?php 
    }
    ?>
        
    </ul>
    
    </li>
    
        <li><a href="#">Изготовление инструментов</a>
    
    <ul>
    <?php 
    foreach ($arResult['utp_menu_inst'] as $key=>$val){
        ?>
        <li><a href="<?php echo $val['LINK'];?>"><?php echo $val['NAME'];?></a></li>
        <?php 
    }
    ?>
        
    </ul>
    
    </li>
    
    
  </ul>
</nav>



<?php 
if ($arParams['URL'] == '/en/'){
    $nonemenu = "style='display:none;'";
}
?>
<div class="land_nav_link" <?php echo $nonemenu;?>>

	<div class="btn-group-blue">
		<a class="btn-land_nav_link toggle hc-nav-trigger hc-nav-1"><span>Навигация</span></a>
		
		<!-- <a class="toggle hc-nav-trigger hc-nav-1" href="#" role="button" aria-label="Open Menu" aria-controls="hc-nav-1">
            <span></span>
            Toggle Navigation
            <i>or swipe the screen from edge on mobile ;)</i>
          </a>-->
		
	</div>
</div>





<?php 
if ($arParams['TYPE_LABEL'] != 'provo'){
    if ($arParams['URL'] == '/en/'){
        ?>
        <section id="land-section">

<?php 
if (!empty($arResult['landing_main_img'])){
    $backfImage = 'style="background-image: url('.$arResult['landing_main_img'].');"';
}
?>
<div class="main-img-area" id="landing-main-image" <?php echo $backfImage;?>>
<div class="container">
<div class="row g-0 position-relative">

<div class="col-12 col-xl-8 col-lg-8 col-md-8 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
	<div class="land-title"><?php echo $arResult['utp_text'];?></div>
	<div class="land-sm-title pt-2 pt-xl-5 pt-lg-5 pt-md-5"><?php echo $arResult['utp_note'];?></div>
</div>

<div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 pt-5 text-left position-relative" style="padding-top:40px !important;">

    <?php
            $APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-land-en", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-land",
		"FORM_ID" => "FORM109",
		"FORM_NAME" => "Запрос лендинг",
		"WIDTH_FORM" => "auto",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "PHONE",
			1 => "",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,EMAIL",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_ASTERISK" => "N",
		"FORM_SUBMIT_VALUE" => "To get our experts consultation",
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"_CALLBACKS" => "",
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"ENABLE_SEND_MAIL" => "Y",
		"CREATE_SEND_MAIL" => "",
		"EVENT_MESSAGE_ID" => array(
		),
		"EMAIL_TO" => "info@traiv-komplekt.ru",
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Лендинг производство",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"USE_IBLOCK_WRITE" => "Y",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_PLACEHOLDER" => "Your name",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Obligatory field",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
		"CATEGORY_EMAIL_VALUE" => "",
		"CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
		"CATEGORY_PHONE_TITLE" => "Мобильный телефон",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_PLACEHOLDER" => "Your phone number",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Obligatory field",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "",
		"USE_CAPTCHA" => "Y",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "N",
		"USE_BOOTSRAP_CSS" => "Y",
		"USE_BOOTSRAP_JS" => "N",
		"CUSTOM_FORM" => "",
		"CAPTCHA_TITLE" => "",
		"CATEGORY_DOCS_TITLE" => "Вложение",
		"CATEGORY_DOCS_TYPE" => "file",
		"CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
		"CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
		"CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
		"USE_INPUTMASK_JS" => "Y",
		"CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
		"CATEGORY_______________________________________________TYPE" => "text",
		"CATEGORY_______________________________________________PLACEHOLDER" => "",
		"CATEGORY_______________________________________________VALUE" => "",
		"CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
		"CREATE_IBLOCK" => "",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "37",
		"ACTIVE_ELEMENT" => "N",
		"CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
		"CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
		"CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "By clicking the \"#BUTTON#\", button you consent to the processing of your personal data",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_ID" => $arResult["ID"],
		"FORMATED_NAME" => $formatedname,
		"CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
		"CATEGORY_HIDDEN_TYPE" => "hidden",
		"CATEGORY_HIDDEN_VALUE" => "",
		"CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
	),
	false
);
     
    ?>

</div>

</div>
</div>
</div>


<div class="land-pre-area" id="landing-pre-list">
    <div class="container">
        <div class="row position-relative">
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-5 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
        	<div class="land-title-pre">Reasons to choose us</div>
        </div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-center position-relative">
        			<div class="row position-relative g-0">
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
					
 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/Vector-5.png">
 </div>
						<h4 class="title"> Delivery time from the 1-st day</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/why/Vector.png">
</div>
						<h4 class="title">Minimum batch is 1 pcs</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/why/Vector-1.png">
</div>
						<h4 class="title">Minimum order – from 30 000 RUR</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/why/Vector-2.png">
</div>
						<h4 class="title">Compliance to GOST, DIN, ISO standards</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
					<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/Vector-2.png">

</div>
						<h4 class="title">Product diameter up to 140 mm</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/Vector-1.png">
</div>
						<h4 class="title">Durability class up to 12.9</h4>
					</div>
				</div>
			</div>
			</div>
        
        </div>
    </div>
</div>


<div class="land-text-area" id="landing-text">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black"><?php echo $arResult['utp_title'];?></div>
            </div>
		</div>
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left position-relative">
			 <?/*$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv-land",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "",
		"SITE_ID" => "zf",
		"START_FROM" => "0"
	)
);*/?>
</div>
</div>
		
		 <div class="row position-relative">
            <div class="col-10 col-xl-10 col-lg-10 col-md-10 text-left position-relative">
            	<div class="land-title-text">
            	<?php echo $arResult['utp_p'];?>
            	</div>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left d-none position-relative">
            	 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/Rectangle_55.jpg" class="img-responsive w-100"/>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left position-relative land-main-text">
            <?php 
            echo $arResult['main_text'];
            ?>
            </div>
            
		</div>
		
	</div>
</div>

<div class="land-eq-area" id="landing-eq">
    <div class="container">
          
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Our equipment</div>
            </div>
		</div>
          
          <!-- Filters -->
          <div class="row position-relative">
            <ul id="pfolio-filters" class="portfolio-filters">
              <li class="active"><a href="#" data-filter="*">All</a></li>
              
              						 <?php 
				$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(7)->fetch();
				
				$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
				$entity_data_class = $entity->getDataClass();
				
				$data = $entity_data_class::getList(array(
				    "select" => array("*"),
				    "order" => array("UF_PRO_NAME" => "ASC")
				));
				
				if (intval($data->getSelectedRowsCount()) > 0){
				    $prev_pro_name = "";
				    $i = 1;
				    while($arData = $data->Fetch()){
				        $s_item_name = $arData['UF_PRO_NAME'];
				        $s_item_name_en = $arData['UF_PRO_NAME_EN'];
				        if ($s_item_name != $prev_pro_name){
				            if ($s_item_name == 'Калибровка'){
				                $name_f = "kal";
				            } else if ($s_item_name == 'Накатка'){
				                $name_f = "nak";
				            } else if ($s_item_name == 'Резка'){
				                $name_f = "rez";
				            }else if ($s_item_name == 'Сверление'){
				                $name_f = "svr";
				            }else if ($s_item_name == 'Токарная обработка'){
				                $name_f = "tok";
				            }else if ($s_item_name == 'Фрезерная обработка'){
				                $name_f = "frez";
				            }
				            ?>
						<li><a href="#" data-filter=".prod-tab-<?php echo $name_f;?>"><?php echo $s_item_name_en;?></a></li>
						 <?php
				        $prev_pro_name = $s_item_name;
				        $i++;
				        }
				    }
				}
				?>

            </ul>
          </div>

          
            <div id="pfolio">
  
  <?php
  $data = $entity_data_class::getList(array(
      "select" => array("*"),
      "order" => array("UF_NAME_STANOK" => "DESC")
  ));
  if (intval($data->getSelectedRowsCount()) > 0){
      $prev_pro_name = "";
      $i = 1;
      while($arData = $data->Fetch()){
          /*echo "<pre>";
            print_r($arData['ID']);
          echo "</pre>";*/
          $s_item_name = $arData['UF_PRO_NAME'];
          $s_item_name_en = $arData['UF_PRO_NAME_EN'];
          $s_item_name_stanok = $arData['UF_NAME_STANOK'];
          $s_item_name_stanok_en = $arData['UF_NAME_STANOK_EN'];
          $s_item_note = $arData['UF_PRO_NOTE'];
          $s_item_img = CFile::GetPath($arData['UF_PRO_IMAGE']);
          
          if ($s_item_name_stanok != $prev_pro_name){
          //$picturl = CFile::ResizeImageGet($arData['UF_PRO_IMAGE'],array('width'=>200, 'height'=>auto), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true/*, $arWaterMark*/);
          
          if ($s_item_name == 'Калибровка'){
              $name_f = "kal";
          } else if ($s_item_name == 'Накатка'){
              $name_f = "nak";
          } else if ($s_item_name == 'Резка'){
              $name_f = "rez";
          }else if ($s_item_name == 'Сверление'){
              $name_f = "svr";
          }else if ($s_item_name == 'Токарная обработка'){
              $name_f = "tok";
          }else if ($s_item_name == 'Фрезерная обработка'){
              $name_f = "frez";
          }
          
          $hlblockIn = Bitrix\Highloadblock\HighloadBlockTable::getById(7)->fetch();
          
          $entityIn = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblockIn);
          $entity_data_classIn = $entityIn->getDataClass();
          
          $result = $entity_data_classIn::getList(array(
              "select" => array("*"),
              "order" => array("UF_PRO_NAME"=>"ASC"),
              "filter" => Array("!ID"=>$arData['ID'],"UF_NAME_STANOK"=>$s_item_name_stanok)
          ));
          $dop_str = "";
          while ($arRow = $result->Fetch()){
              
              if ($arRow['UF_PRO_NAME'] == 'Калибровка'){
                  $dop_str .= " prod-tab-kal";
              } else if ($arRow['UF_PRO_NAME'] == 'Накатка'){
                  $dop_str .= " prod-tab-nak";
              } else if ($arRow['UF_PRO_NAME'] == 'Резка'){
                  $dop_str .= " prod-tab-rez";
              }else if ($arRow['UF_PRO_NAME'] == 'Сверление'){
                  $dop_str .= " prod-tab-svr";
              }else if ($arRow['UF_PRO_NAME'] == 'Токарная обработка'){
                  $dop_str .= " prod-tab-tok";
              }else if ($arRow['UF_PRO_NAME'] == 'Фрезерная обработка'){
                  $dop_str .= " prod-tab-frez";
              }
          }
          ?>
          <div class="portfolio-item wp50 prod-tab-<?php echo $name_f; echo $dop_str;?>">
          <div class="eq-item position-relative">
          <div class="eq-item-img" alt="<?=$s_item_name_stanok;?>" style="background-image:url('<?=$s_item_img;?>');"></div>
          </div>
          <div class="eq-name"><strong><?=$s_item_name_stanok_en;?></strong></div>					
			</div>
						 <?php
				    }
				        $prev_pro_name = $s_item_name_stanok;
      }
				}
				?>

              
            </div><!-- / #pfolio -->
          </div><!-- / .row -->

</div>

<div class="land-case-area d-none" id="case-item">
	<div class="container">
	
	        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Production Cases</div>
            </div>
		</div>
	
        <div class="row position-relative">
<?php 
$db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 7, 'ID' => $arResult['case_item'], 'ACTIVE'=>'Y'], false);
$res_rows = intval($db_list_in->SelectedRowsCount());
?>
<div class="case-item-slick">
<?php 
while($ar_result_in = $db_list_in->GetNext()){
    ?>
    <div class="col-12 col-xl-3 col-lg-3 col-md-3 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
    	<div class="case-item position-relative">
    		<div class="case-item-title"><?php echo $ar_result_in['NAME'];?></div>
    		<div class="case-item-note"><?php echo $ar_result_in['PREVIEW_TEXT'];?></div>
    			<div class="case-item-link">
    			<div class="btn-group w-100"><a href="<?php echo $ar_result_in['DETAIL_PAGE_URL'];?>" class="btn-group-new btn-group-new-land w-100 text-left"><span>Смотреть кейс</span><i class="fa fa-long-arrow-right case-item-i"></i></a></div>
    			</div>
    	</div>
	</div>
    <?php
}

?>
</div>
    	</div>
    	
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pb-5 pt-xl-4 pt-lg-4 pt-md-4 text-center position-relative">
            	<div class="btn-group"><a href="/articles/" class="btn-group-new btn-group-new-land-white text-center"><span>Смотреть все кейсы</span></a></div>
            </div>
		</div>
    	
    </div>
</div>

<div class="land-particular-area" id="particular-text">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Production Features</div>
            </div>
		</div>
		
		
		<div class="row position-relative">
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">01</div>
            		<div class="particular-title">Products Manufacturing according to drawings</div>
            		<div class="particular-note">Products manufacturing according to sketches, drawings, samples from any type of steel and alloys.</div>	
            	</div>
            </div>
            
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">02</div>
            		<div class="particular-title">Quality Control</div>
            		<div class="particular-note">Quality control of finished products
<br>Testing in independent laboratories</div>	
            	</div>
            </div>
            
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">03</div>
            		<div class="particular-title">High Quality Materials</div>
            		<div class="particular-note">We accept orders for production of the bulk and small-wholesale bunches of the products according to the following standards: GOST, DIN, ISO.</div>	
            	</div>
            </div>
            
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">04</div>
            		<div class="particular-title">Any Coating under the Order</div>
            		<div class="particular-note">Galvanic and zinc-lamellar coating, hot zinc coating, thermal diffusion galvanizing, coating with black zinc, Teflon, nickel, cadmium, cooper platting, zinc-phosphate coating, coloring.</div>	
            	</div>
            </div>
            
		</div>
		
	</div>
</div>

<?php 
if (!empty($arResult['landing_second_img'])){
    $backsImage = 'style="background-image: url('.$arResult['landing_second_img'].');"';
}
?>

<div class="main-img-area mt-5" id="landing-second-image" <?php echo $backsImage;?>>
<div id="land-women-area"><img src="<?=SITE_TEMPLATE_PATH?>/landing-list/woman-holding-papers-standing-isolated-blue 1.png" id="land-women"></div>
<div class="container">

	        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pl-5 pb-0 pr-5 text-left position-relative">
        	<div class="land-title-form">Request for the Production</div>
        </div>
		</div>

    <div class="row g-0 position-relative">
    	<div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 pt-5 text-left position-relative">
        
         <?php
            $APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-land-en", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-land",
		"FORM_ID" => "FORM110",
		"FORM_NAME" => "Запрос лендинг",
		"WIDTH_FORM" => "auto",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "PHONE",
			1 => "",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,EMAIL",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_ASTERISK" => "N",
		"FORM_SUBMIT_VALUE" => "To get our experts consultation",
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"_CALLBACKS" => "",
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"ENABLE_SEND_MAIL" => "Y",
		"CREATE_SEND_MAIL" => "",
		"EVENT_MESSAGE_ID" => array(
		),
		"EMAIL_TO" => "info@traiv-komplekt.ru",
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Лендинг производство",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"USE_IBLOCK_WRITE" => "Y",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_PLACEHOLDER" => "Your name",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Obligatory field",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
		"CATEGORY_EMAIL_VALUE" => "",
		"CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
		"CATEGORY_PHONE_TITLE" => "Мобильный телефон",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_PLACEHOLDER" => "Your phone number",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Obligatory field",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "",
		"USE_CAPTCHA" => "Y",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "N",
		"USE_BOOTSRAP_CSS" => "Y",
		"USE_BOOTSRAP_JS" => "N",
		"CUSTOM_FORM" => "",
		"CAPTCHA_TITLE" => "",
		"CATEGORY_DOCS_TITLE" => "Вложение",
		"CATEGORY_DOCS_TYPE" => "file",
		"CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
		"CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
		"CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
		"USE_INPUTMASK_JS" => "Y",
		"CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
		"CATEGORY_______________________________________________TYPE" => "text",
		"CATEGORY_______________________________________________PLACEHOLDER" => "",
		"CATEGORY_______________________________________________VALUE" => "",
		"CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
		"CREATE_IBLOCK" => "",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "37",
		"ACTIVE_ELEMENT" => "N",
		"CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
		"CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
		"CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "By clicking the \"#BUTTON#\", button you consent to the processing of your personal data",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_ID" => $arResult["ID"],
		"FORMATED_NAME" => $formatedname,
		"CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
		"CATEGORY_HIDDEN_TYPE" => "hidden",
		"CATEGORY_HIDDEN_VALUE" => "",
		"CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
	),
	false
);
     
    ?>
        
        </div>        
    </div>
</div>
</div>


<div class="land-solutions-area" id="landing-solutions-list">
    <div class="container">
        <div class="row position-relative">
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
        	<div class="land-title-solutions">Developing Fastening Solutions</div>
        </div>
        
                    <div class="col-10 col-xl-10 col-lg-10 col-md-10 offset-md-2 offset-xl-2 offset-lg-2 pt-3 pb-3 text-left position-relative">
            	<div class="land-title-text" style="color:#ffffff;">
            	Accurate adherence to drawings and samples is an important but not the only part of what we provide. We look deep into the context — operating conditions, production features and industry standards. Together with the customer we create a fastening solution, not a simple product.
            	</div>
            </div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 p-xl-5 p-lg-5 p-md-5 text-center position-relative">
        			<div class="row position-relative g-0">
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector.png">
 </div>
						<h4 class="title">GOST, OST, TU and your standards</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector (Stroke).png">
</div>
						<h4 class="title">Durability class up to 12.9</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector (Stroke)-1.png">
</div>
						<h4 class="title">Custom Threads</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector-1.png">
</div>
						<h4 class="title">Rear Steel and Alloys</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector-2.png">
</div>
						<h4 class="title">Testing and Quality Control</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector-3.png">
</div>
						<h4 class="title">Any Type of Coating</h4>
					</div>
				</div>
			</div>
			</div>
        
        </div>
        		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pb-5 pt-xl-4 pt-lg-4 pt-md-4 pb-xl-5 pb-lg-5 pb-md-5 text-center position-relative">
            	<div class="btn-group"><a href="#w-form" class="btn-group-new btn-group-new-land-cons text-center"><span>Submit request</span></a></div>
            </div>
		</div>
        
    </div>
</div>

<div class="land-plus-area">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left text-lg-center position-relative">
            	<div class="land-title-black plus">Pluses and Pluses</div>
            </div>
		</div>
	</div>
	
	
	<div class="container">
        <div class="row position-relative">

        <div class="col-12 col-xl-4 col-lg-4 col-md-4 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 order-lg-2 text-center position-relative">
        	<div class="plus-shape1">
        		<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/end1.png">
        	</div>
        	
        	<div class="plus-shape2 mt-5">
        		<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/2b.jpg">
        	</div>
        </div>
        
        <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-5 p-lg-5 p-md-5 order-lg-1 text-left position-relative">
        	<div class="plus-title">Production Plant Quality</div>
        	
        	<ul class="plus-list">
        		<li>
        			<p>We start and finish with the quality control: checking raw materials, holding intermediate control tests for every 5-10 products, carry out final control tests.</p>
        		</li>
        		
        		<li>
        			<p>We are able to work with the complex standards, we carry out tests and quality control in accredited laboratories.</p>
        		</li>
        		
        		<li>
        			<p>All the end-products are supplied with the passports and warranty, and raw materials have origin certificates. Pedigree and the future of every detail is under control.</p>
        		</li>
        		
        	</ul>
        	
        </div>
        

        
        <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-5 p-lg-5 p-md-5 order-lg-3 text-left position-relative">
        	<div class="plus-title">Workshop Flexibility </div>
        	
        	        	<ul class="plus-list">
        		<li>
        			<p>We will manufacture the product according to your drawing and technical requirements or clone the sample provided. The equipment park allows us to produce details of the sizes from 10 mm up to 380 mm with the thread pitch from 0.75 up to 5 mm.</p>
        		</li>
        		
        		<li>
        			<p>We are ready to take on the execution of a small series or even one detail. Minimum time of manufacture – starting from 5 days.</p>
        		</li>
        		
        		<li>
        			<p>If needed, we will look beyond the terms of specification. We’ll delve into your production processes and work to improve them.</p>
        		</li>
        		
        		<li>
        			<p>The doors of our production site are always open to you.  You are highly welcomed to visit us with the audit and find out for yourself.</p>
        		</li>
        		
        	</ul>
        	
        </div>
        
        </div>
	</div>
	
</div>

<div class="land-map-area-mobil d-block d-lg-none d-md-none d-xl-none">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Работаем с регионами</div>
            </div>
		</div>
		
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left position-relative">
            	 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/car.png" class="img-responsive w-100"/>
            </div>
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	 <span class="bottom-map-text">Regional coverage</span>
            	 <div>
                	 <ul class="delivery-list-mobil">
                	 
                	 <?php 
                	 $arrDelivery = ["14-25<br> days"=>"Railway transportation","5-7<br> days"=>"Air Freight Express","7-10<br> days"=>"Automobile Delivery","35-45<br> days"=>"Maritime Transportation "];
            	foreach ($arrDelivery as $key=>$val){
            	?>
            		<li class="delivery-list-mobil-item">
            			<span class="delivery-item-key"><?php echo $key;?></span>
            			<span class="delivery-item-val"><?php echo $val;?></span>
            		</li>		
            		<?php 
            	}
            		?>
                	 
                	 	
                	 </ul>
            	 </div>
            </div>
            
		</div>
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-right position-relative">
            	<div class="land-title-white">We work throughout Russia</div>
            </div>
		</div>
		
		
	</div>
</div>

<!-- <div class="land-map-area d-none d-lg-block d-md-block d-xl-block">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Delivery in Russia and CIS</div>
            </div>
		</div>
		
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left position-relative d-none">
            	 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/map1.jpg" class="img-responsive w-100"/>
            </div>
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	 <span class="bottom-map-text">Average values ​​are given.<br>We work individually.</span>
            </div>
            
		</div>
		
	</div>
</div>-->


<div class="land-delivery-area d-none d-lg-block d-md-block d-xl-block">
    <div class="container">
        <div class="row d-flex align-items-center h-100 position-relative">
            <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-delivery">Regional coverage</div>
            </div>
            
            <div class="col-12 col-xl-8 col-lg-8 col-md-8 p-xl-5 p-lg-5 p-md-5 text-left h-100 position-relative">
            	<div class="row">
            	<?php 
            	$arrDelivery = ["Railway <br> transportation","Air Freight <br> Express","Automobile <br> Delivery","Maritime <br> Transportation "];
            	foreach ($arrDelivery as $key=>$val){
            	?>
            		<div class="col-12 col-xl-3 col-lg-3 col-md-3 text-left position-relative">
            			<span class="delivery-item-name"><?php echo $val;?></span>
            		</div>		
            		<?php 
            	}
            		?>
            	</div>
            </div>
            
		</div>
	</div>
</div>

</section>
        <?php 
    } else {
    ?>
<section id="land-section">

<?php 
if (!empty($arResult['landing_main_img'])){
    //$backfImage = 'style="background-image: url('.$arResult['landing_main_img'].');"';
    $backfImage = '';
}
?>
<div class="main-img-area" id="landing-main-image" <?php echo $backfImage;?>>

        <div class="fh-video">
        
        <div id="fs-video-one-bg" class="player" 
               data-property="{videoURL:'https://www.youtube.com/embed/qW58I63D1LY',containment:'.fh-video',autoPlay:true, mute:true, startAt:17, stopAt:300, opacity:1}">
          </div>
        	
        </div>

<div class="container position-relative" style="z-index:150;">
<div class="row g-0 position-relative">

<div class="col-12 col-xl-8 col-lg-8 col-md-8 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
	<div class="land-title"><?php echo $arResult['utp_text'];?></div>
	<div class="land-sm-title pt-2 pt-xl-5 pt-lg-5 pt-md-5"><?php echo $arResult['utp_note'];?></div>
</div>

<div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 pt-5 text-left position-relative" style="padding-top:40px !important;">

    <?php
            $APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-land", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-land",
		"FORM_ID" => "FORM109",
		"FORM_NAME" => "Запрос лендинг",
		"WIDTH_FORM" => "auto",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,EMAIL",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_ASTERISK" => "N",
		"FORM_SUBMIT_VALUE" => "Получить консультацию",
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"_CALLBACKS" => "",
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"ENABLE_SEND_MAIL" => "Y",
		"CREATE_SEND_MAIL" => "",
		"EVENT_MESSAGE_ID" => array(
		),
		"EMAIL_TO" => "info@traiv-komplekt.ru",
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Лендинг производство",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"USE_IBLOCK_WRITE" => "Y",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_PLACEHOLDER" => "Имя",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
		"CATEGORY_EMAIL_VALUE" => "",
		"CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
		"CATEGORY_PHONE_TITLE" => "Мобильный телефон",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_PLACEHOLDER" => "+7(999)999-99-99",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "Y",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"USE_CAPTCHA" => "N",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "N",
		"USE_BOOTSRAP_CSS" => "Y",
		"USE_BOOTSRAP_JS" => "N",
		"CUSTOM_FORM" => "",
		"CAPTCHA_TITLE" => "",
		"CATEGORY_DOCS_TITLE" => "Вложение",
		"CATEGORY_DOCS_TYPE" => "file",
		"CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
		"CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
		"CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
		"USE_INPUTMASK_JS" => "Y",
		"CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
		"CATEGORY_______________________________________________TYPE" => "text",
		"CATEGORY_______________________________________________PLACEHOLDER" => "",
		"CATEGORY_______________________________________________VALUE" => "",
		"CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
		"CREATE_IBLOCK" => "",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "37",
		"ACTIVE_ELEMENT" => "N",
		"CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
		"CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
		"CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" class=\"polslam\" href=\"/politika-konfidentsialnosti/\" >персональных данных</a>",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_ID" => $arResult["ID"],
		"FORMATED_NAME" => $formatedname,
		"CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
		"CATEGORY_HIDDEN_TYPE" => "hidden",
		"CATEGORY_HIDDEN_VALUE" => "",
		"CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
	),
	false
);
     
    ?>

</div>

</div>
</div>
</div>


<div class="land-pre-area" id="landing-pre-list">
    <div class="container">
        <div class="row position-relative">
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-5 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
        	<div class="land-title-pre">Почему выбирают нас</div>
        </div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-center position-relative">
        			<div class="row position-relative g-0">
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
					
 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/VectorNew1.png">
 </div>
 <div class="landing-list-title-new">Гарантия качества</div>
						<h4 class="title landing-list-title-new-note">Инженерный отдел по контролю качества</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/VectorNew2.png">
</div>
 <div class="landing-list-title-new">Соблюдение сроков</div>
						<h4 class="title landing-list-title-new-note">Эффективное производство с гарантированными сроками поставки</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">

<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/VectorNew6.png">
</div>
 <div class="landing-list-title-new">Индивидуальный подход</div>
						<h4 class="title landing-list-title-new-note">Изделия по вашим чертежам от микро крепежа до м 100</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
					<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/VectorNew3.png">

</div>
 <div class="landing-list-title-new">ТехПоддержка</div>
						<h4 class="title landing-list-title-new-note">Профессиональные консультация и помощь на каждом этапе</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">
					
					<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/VectorNew4.png">

</div>
 <div class="landing-list-title-new">Сертифицировано</div>
						<h4 class="title landing-list-title-new-note">Соответствие международным стандартам</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img">

<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/VectorNew5.png">
</div>
 <div class="landing-list-title-new">Региональные филиалы</div>
						<h4 class="title landing-list-title-new-note">Офисы в Москве, Санкт-Петербурге, Перми</h4>
					</div>
				</div>
			</div>
			</div>
        
        </div>
    </div>
</div>


<div class="land-text-area" id="landing-text">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black"><?php echo $arResult['utp_title'];?></div>
            </div>
		</div>
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left position-relative">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv-land",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "",
		"SITE_ID" => "zf",
		"START_FROM" => "0"
	)
);?>
</div>
</div>
		
		 <div class="row position-relative">
            <div class="col-10 col-xl-10 col-lg-10 col-md-10 text-left position-relative">
            	<div class="land-title-text">
            	<?php echo $arResult['utp_p'];?>
            	</div>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left d-none position-relative">
            	 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/Rectangle_55.jpg" class="img-responsive w-100"/>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left position-relative land-main-text">
            <?php 
            echo $arResult['main_text'];
            ?>
            </div>
            
		</div>
		
	</div>
</div>

<?php 

//        if (count($arResult['GALLERY']) > 0){
if(is_array($arResult['GALLERY']) && count($arResult['GALLERY'])>0){
        ?>
                    <div class="landinfo-elements-area mb-5 mb-xl-0 mb-lg-0 mb-md-0">
				<div class="container">
				
					        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Фотографии</div>
            </div>
		</div>
            		
            		<div class="row position-relative mt-5 i-item-slide-area">
		<?php
                            		    foreach ($arResult['GALLERY'] as $ikey=>$ival){
                            		        $imgEl = CFile::GetPath($ival);
                            		        ?>
                            		        <div class="col-12 col-xl-3 col-lg-3 col-md-3 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
                                            	<a href="<?php echo $imgEl;?>" class="i-item bordered position-relative fancy-img" data-fancybox="gallery">
                                            		<div class="i-img text-center" style="background-image:url(<?php echo $imgEl;?>);"></div>
                                            	</a>
                                            </div>
                            		    <?php
                            		    }
                            		?>
            
		</div>
            	</div>
            </div>
        <?php 
        }

?>


<div class="land-eq-area" id="landing-eq">
    <div class="container">
          
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Наше оборудование</div>
            </div>
		</div>
          
          <!-- Filters -->
          <div class="row position-relative">
            <ul id="pfolio-filters" class="portfolio-filters">
              <li class="active"><a href="#" data-filter="*">Все</a></li>
              
              						 <?php 
				$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(7)->fetch();
				
				$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
				$entity_data_class = $entity->getDataClass();
				
				$data = $entity_data_class::getList(array(
				    "select" => array("*"),
				    "order" => array("UF_PRO_NAME" => "ASC")
				));
				
				if (intval($data->getSelectedRowsCount()) > 0){
				    $prev_pro_name = "";
				    $i = 1;
				    while($arData = $data->Fetch()){
				        $s_item_name = $arData['UF_PRO_NAME'];
				        if ($s_item_name != $prev_pro_name){
				            if ($s_item_name == 'Калибровка'){
				                $name_f = "kal";
				            } else if ($s_item_name == 'Накатка'){
				                $name_f = "nak";
				            } else if ($s_item_name == 'Резка'){
				                $name_f = "rez";
				            }else if ($s_item_name == 'Сверление'){
				                $name_f = "svr";
				            }else if ($s_item_name == 'Токарная обработка'){
				                $name_f = "tok";
				            }else if ($s_item_name == 'Фрезерная обработка'){
				                $name_f = "frez";
				            }
				            ?>
						<li><a href="#" data-filter=".prod-tab-<?php echo $name_f;?>"><?php echo $s_item_name;?></a></li>
						 <?php
				        $prev_pro_name = $s_item_name;
				        $i++;
				        }
				    }
				}
				?>

            </ul>
          </div>

          
            <div id="pfolio">
  
  <?php
  $data = $entity_data_class::getList(array(
      "select" => array("*"),
      "order" => array("UF_NAME_STANOK" => "DESC")
  ));
  if (intval($data->getSelectedRowsCount()) > 0){
      $prev_pro_name = "";
      $i = 1;
      while($arData = $data->Fetch()){
          /*echo "<pre>";
            print_r($arData['ID']);
          echo "</pre>";*/
          $s_item_name = $arData['UF_PRO_NAME'];
          $s_item_name_stanok = $arData['UF_NAME_STANOK'];
          $s_item_note = $arData['UF_PRO_NOTE'];
          $s_item_img = CFile::GetPath($arData['UF_PRO_IMAGE']);
          
          if ($s_item_name_stanok != $prev_pro_name){
          //$picturl = CFile::ResizeImageGet($arData['UF_PRO_IMAGE'],array('width'=>200, 'height'=>auto), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true/*, $arWaterMark*/);
          
          if ($s_item_name == 'Калибровка'){
              $name_f = "kal";
          } else if ($s_item_name == 'Накатка'){
              $name_f = "nak";
          } else if ($s_item_name == 'Резка'){
              $name_f = "rez";
          }else if ($s_item_name == 'Сверление'){
              $name_f = "svr";
          }else if ($s_item_name == 'Токарная обработка'){
              $name_f = "tok";
          }else if ($s_item_name == 'Фрезерная обработка'){
              $name_f = "frez";
          }
          
          $hlblockIn = Bitrix\Highloadblock\HighloadBlockTable::getById(7)->fetch();
          
          $entityIn = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblockIn);
          $entity_data_classIn = $entityIn->getDataClass();
          
          $result = $entity_data_classIn::getList(array(
              "select" => array("*"),
              "order" => array("UF_PRO_NAME"=>"ASC"),
              "filter" => Array("!ID"=>$arData['ID'],"UF_NAME_STANOK"=>$s_item_name_stanok)
          ));
          $dop_str = "";
          while ($arRow = $result->Fetch()){
              
              if ($arRow['UF_PRO_NAME'] == 'Калибровка'){
                  $dop_str .= " prod-tab-kal";
              } else if ($arRow['UF_PRO_NAME'] == 'Накатка'){
                  $dop_str .= " prod-tab-nak";
              } else if ($arRow['UF_PRO_NAME'] == 'Резка'){
                  $dop_str .= " prod-tab-rez";
              }else if ($arRow['UF_PRO_NAME'] == 'Сверление'){
                  $dop_str .= " prod-tab-svr";
              }else if ($arRow['UF_PRO_NAME'] == 'Токарная обработка'){
                  $dop_str .= " prod-tab-tok";
              }else if ($arRow['UF_PRO_NAME'] == 'Фрезерная обработка'){
                  $dop_str .= " prod-tab-frez";
              }
          }
          ?>
          <div class="portfolio-item wp50 prod-tab-<?php echo $name_f; echo $dop_str;?>">
          <div class="eq-item position-relative">
          <div class="eq-item-img" alt="<?=$s_item_name_stanok;?>" style="background-image:url('<?=$s_item_img;?>');"></div>
          </div>
          <div class="eq-name"><strong><?=$s_item_name_stanok;?></strong></div>					
			</div>
						 <?php
				    }
				    $prev_pro_name = $s_item_name_stanok;
      }
				}
				?>

              
            </div><!-- / #pfolio -->
          </div><!-- / .row -->

</div>

<div class="land-case-area" id="case-item">
	<div class="container">
	
	        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Производственные кейсы</div>
            </div>
		</div>
	
        <div class="row position-relative">
<?php 
$db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 7, 'ID' => $arResult['case_item'], 'ACTIVE'=>'Y'], false);
$res_rows = intval($db_list_in->SelectedRowsCount());
?>
<div class="case-item-slick">
<?php 
while($ar_result_in = $db_list_in->GetNext()){
    ?>
    <div class="col-12 col-xl-3 col-lg-3 col-md-3 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
    	<div class="case-item position-relative">
    		<div class="case-item-title"><?php echo $ar_result_in['NAME'];?></div>
    		<div class="case-item-note"><?php echo $ar_result_in['PREVIEW_TEXT'];?></div>
    			<div class="case-item-link">
    			<div class="btn-group w-100"><a href="<?php echo $ar_result_in['DETAIL_PAGE_URL'];?>" class="btn-group-new btn-group-new-land w-100 text-left"><span>Смотреть кейс</span><i class="fa fa-long-arrow-right case-item-i"></i></a></div>
    			</div>
    	</div>
	</div>
    <?php
    /*echo $ar_result_in['NAME'];
    echo $ar_result_in['PREVIEW_TEXT'];
    echo $ar_result_in['DETAIL_PAGE_URL'];*/
}

?>
</div>
    	</div>
    	
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pb-5 pt-xl-4 pt-lg-4 pt-md-4 text-center position-relative">
            	<div class="btn-group"><a href="/articles/" class="btn-group-new btn-group-new-land-white text-center"><span>Смотреть все кейсы</span></a></div>
            </div>
		</div>
    	
    </div>
</div>

<div class="land-particular-area" id="particular-text">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Особенности производства</div>
            </div>
		</div>
		
		
		<div class="row position-relative">
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">01</div>
            		<div class="particular-title">Производство по чертежам</div>
            		<div class="particular-note">Производство изделий по эскизам, чертежам, образцам из любых видов сталей и сплавов.</div>	
            	</div>
            </div>
            
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">02</div>
            		<div class="particular-title">Контроль качества</div>
            		<div class="particular-note">Проверка готовых изделий ОТК<br>Тесты в независимых лабораториях.</div>	
            	</div>
            </div>
            
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">03</div>
            		<div class="particular-title">Высококачественные материалы</div>
            		<div class="particular-note">Мы принимаем заказы на изготовление оптовых и мелко-­ оптовых партий изделий по стандартам: ГОСТ, DIN, ISO, ГОСТ.</div>	
            	</div>
            </div>
            
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="particular-item position-relative">
            		<div class="particular-number">04</div>
            		<div class="particular-title">Любое покрытие под заказ</div>
            		<div class="particular-note">Гальваническое и цинк-ламельное покрытия, покрытие горячим цинком, термодиффузионное­ цинкование, покрытие черным цинком, тефлоном, никелем, кадмием, омеднение, цинк-фосфатирование, окраска.</div>	
            	</div>
            </div>
            
		</div>
		
	</div>
</div>

<?php 
if (!empty($arResult['landing_second_img'])){
    $backsImage = 'style="background-image: url('.$arResult['landing_second_img'].');"';
}
?>

<div class="main-img-area mt-5" id="landing-second-image" <?php echo $backsImage;?>>
<div id="land-women-area"><img src="<?=SITE_TEMPLATE_PATH?>/landing-list/woman-holding-papers-standing-isolated-blue 1.png" id="land-women"></div>
<div class="container">

	        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pl-5 pb-0 pr-5 text-left position-relative">
        	<div class="land-title-form">Заявка на производство</div>
        </div>
		</div>

    <div class="row g-0 position-relative">
    	<div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 pt-5 text-left position-relative">
        
         <?php
            $APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-land", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-land",
		"FORM_ID" => "FORM110",
		"FORM_NAME" => "Запрос лендинг",
		"WIDTH_FORM" => "auto",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,EMAIL",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_ASTERISK" => "N",
		"FORM_SUBMIT_VALUE" => "Получить консультацию",
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"_CALLBACKS" => "",
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"ENABLE_SEND_MAIL" => "Y",
		"CREATE_SEND_MAIL" => "",
		"EVENT_MESSAGE_ID" => array(
		),
		"EMAIL_TO" => "info@traiv-komplekt.ru",
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Лендинг производство",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"USE_IBLOCK_WRITE" => "Y",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_PLACEHOLDER" => "Имя",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
		"CATEGORY_EMAIL_VALUE" => "",
		"CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
		"CATEGORY_PHONE_TITLE" => "Мобильный телефон",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_PLACEHOLDER" => "+7(999)999-99-99",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "Y",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"USE_CAPTCHA" => "N",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "N",
		"USE_BOOTSRAP_CSS" => "Y",
		"USE_BOOTSRAP_JS" => "N",
		"CUSTOM_FORM" => "",
		"CAPTCHA_TITLE" => "",
		"CATEGORY_DOCS_TITLE" => "Вложение",
		"CATEGORY_DOCS_TYPE" => "file",
		"CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
		"CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
		"CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
		"USE_INPUTMASK_JS" => "Y",
		"CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
		"CATEGORY_______________________________________________TYPE" => "text",
		"CATEGORY_______________________________________________PLACEHOLDER" => "",
		"CATEGORY_______________________________________________VALUE" => "",
		"CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
		"CREATE_IBLOCK" => "",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "37",
		"ACTIVE_ELEMENT" => "N",
		"CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
		"CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
		"CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" class=\"polslam\" href=\"/politika-konfidentsialnosti/\" >персональных данных</a>",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_ID" => $arResult["ID"],
		"FORMATED_NAME" => $formatedname,
		"CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
		"CATEGORY_HIDDEN_TYPE" => "hidden",
		"CATEGORY_HIDDEN_VALUE" => "",
		"CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
	),
	false
);
     
    ?>
        
        </div>        
    </div>
</div>
</div>


<div class="land-solutions-area" id="landing-solutions-list">
    <div class="container">
        <div class="row position-relative">
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
        	<div class="land-title-solutions">Разрабатываем крепежные решения</div>
        </div>
        
                    <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 text-left position-relative">
            	<div class="land-title-text" style="color:#ffffff;">
            	Точное следование чертежам и образцам — важная, но не единственная часть работы. Мы смотрим на контекст — условия эксплуатации, особенности производства и стандарты отрасли. Вместе с вами создаем не изделие, а решение.
            	</div>
            </div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 p-xl-5 p-lg-5 p-md-5 text-center position-relative">
        			<div class="row position-relative g-0">
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector.png">
 </div>
						<h4 class="title">ГОСТ, ОСТ, ТУ и ваши стандарты</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector (Stroke).png">
</div>
						<h4 class="title">Изделия с классом прочности до 12.9</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector (Stroke)-1.png">
</div>
						<h4 class="title">Нестандартные резьбы</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector-1.png">
</div>
						<h4 class="title">Редкие стали и сплавы</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector-2.png">
</div>
						<h4 class="title">Испытания и контроль качества</h4>
					</div>
				</div>
				 <!--service item-->
				<div class="col-6 col-lg-2 col-sm-6 land-pre-about-area">
					<div class="land-pre-about-area-item">
					<div class="land-pre-about-area-item-img sol">
<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/solutions/Vector-3.png">
</div>
						<h4 class="title">Любые покрытия</h4>
					</div>
				</div>
			</div>
			</div>
        
        </div>
        
        		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pb-5 pt-xl-4 pt-lg-4 pt-md-4 pb-xl-5 pb-lg-5 pb-md-5 text-center position-relative">
            	<div class="btn-group"><a href="#w-form" class="btn-group-new btn-group-new-land-cons text-center"><span>Отправить заявку</span></a></div>
            </div>
		</div>
        
    </div>
</div>

<div class="land-plus-area">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left text-lg-center position-relative">
            	<div class="land-title-black plus">Плюсы и плюсы</div>
            </div>
		</div>
	</div>
	
	
	<div class="container">
        <div class="row position-relative">

        <div class="col-12 col-xl-4 col-lg-4 col-md-4 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 order-lg-2 text-center position-relative">
        	<div class="plus-shape1">
        		<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/end1.png">
        	</div>
        	
        	<div class="plus-shape2 mt-5">
        		<img src="<?=SITE_TEMPLATE_PATH?>/landing-list/2b.jpg">
        	</div>
        </div>
        
        <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-5 p-lg-5 p-md-5 order-lg-1 text-left position-relative">
        	<div class="plus-title">Качество завода</div>
        	
        	<ul class="plus-list">
        		<li>
        			<p>Начинаем и заканчиваем контролем качества: проверяем сырье, делаем промежуточный контроль каждые 5-10 изделий, проводим итоговый контроль.</p>
        		</li>
        		
        		<li>
        			<p>Умеем работать со сложными стандартами, проводим испытания и контроль качества в аккредитованных лабораториях.</p>
        		</li>
        		
        		<li>
        			<p>У всех изделий есть паспорта и гарантия, а у сырья — сертификаты. Родословная и будущее каждой детали под контролем.</p>
        		</li>
        		
        	</ul>
        	
        </div>
        

        
        <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-5 p-lg-5 p-md-5 order-lg-3 text-left position-relative">
        	<div class="plus-title">Гибкость мастерской</div>
        	
        	        	<ul class="plus-list">
        		<li>
        			<p>Выполним изделие по вашему чертежу, техзаданию или клонируем образец. Станочный парк позволяет нам выполнять детали от 10 мм до 380 мм, с шагом резьбы от 0,75 до 6.</p>
        		</li>
        		
        		<li>
        			<p>Готовы взять за выполнение мелкой серии или даже одной детали, минимальные сроки — от 5 дней.</p>
        		</li>
        		
        		<li>
        			<p>При необходимости смотрим шире условий техзадания, вникаем в ваши производственные процессы и работаем на их улучшение.</p>
        		</li>
        		
        		<li>
        			<p>У нас открытое производство — вы можете приехать в гости с аудитом и убедиться сами.</p>
        		</li>
        		
        	</ul>
        	
        </div>
        
        </div>
	</div>
	
</div>

<div class="land-map-area-mobil d-block d-lg-none d-md-none d-xl-none">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Работаем с регионами</div>
            </div>
		</div>
		
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left position-relative">
            	 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/car.png" class="img-responsive w-100"/>
            </div>
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	 <span class="bottom-map-text">Варианты доставки</span>
            	 <div>
                	 <ul class="delivery-list-mobil">
                	 
                	 <?php 
                	 $arrDelivery = ["14-25<br> дней"=>"Железнодорожная перевозка","5-7<br> дней"=>"Авиадоставка экпресс","7-10<br> дней"=>"Автомобильная перевозка","35-45<br> дней"=>"Морская перевозка"];
            	foreach ($arrDelivery as $key=>$val){
            	?>
            		<li class="delivery-list-mobil-item">
            			<span class="delivery-item-key"><?php echo $key;?></span>
            			<span class="delivery-item-val"><?php echo $val;?></span>
            		</li>		
            		<?php 
            	}
            		?>
                	 
                	 	
                	 </ul>
            	 </div>
            </div>
            
		</div>
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-right position-relative">
            	<div class="land-title-white">Работаем по всей России</div>
            </div>
		</div>
		
		
	</div>
</div>

<div class="land-map-area d-none d-lg-block d-md-block d-xl-block">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-black particular">Доставка по РФ и СНГ</div>
            </div>
		</div>
		
		
		<div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left position-relative">
            	 <img src="<?=SITE_TEMPLATE_PATH?>/landing-list/map1.jpg" class="img-responsive w-100"/>
            </div>
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	 <span class="bottom-map-text">Приведены средние значения.<br> Работаем индивидуально.</span>
            </div>
            
		</div>
		
	</div>
</div>


<div class="land-delivery-area d-none d-lg-block d-md-block d-xl-block">
    <div class="container">
        <div class="row d-flex align-items-center h-100 position-relative">
            <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="land-title-delivery">Работаем с регионами</div>
            </div>
            
            <div class="col-12 col-xl-8 col-lg-8 col-md-8 p-xl-5 p-lg-5 p-md-5 text-left h-100 position-relative">
            	<div class="row">
            	<?php 
            	$arrDelivery = ["Железнодорожная<br> перевозка","Авиадоставка<br> экпресс","Автомобильная<br> перевозка","Морская<br> перевозка"];
            	foreach ($arrDelivery as $key=>$val){
            	?>
            		<div class="col-12 col-xl-3 col-lg-3 col-md-3 text-left position-relative">
            			<span class="delivery-item-name"><?php echo $val;?></span>
            		</div>		
            		<?php 
            	}
            		?>
            	</div>
            </div>
            
		</div>
	</div>
</div>

</section>
<?
    }
}

$asset = Asset::getInstance();
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slick.css");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/landing-list.css");?>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<?php 

        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/hc-offcanvas-nav.css");

?>

<?php 
//$this->getComponent()->getPath();
?>
<?endif;?>

