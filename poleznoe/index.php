<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Полезные материалы и онлайн сервисы: Подбор аналогов DIN ГОСТ, калькулятор метизов и многое другое");
$APPLICATION->SetTitle("Полезная информация");
?>	<section id="content">
		<div class="container">
		
		
		
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Полезная информация</span></h1>
    </div>
</div>

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
		<div class="bp-area bp-area-100">
      		<div class="bp-area-content"><span><?php echo $bptext;?></span></div>	
      		<div class="bp-area-button">
      			<div class="btn-group-blue"><a href="<?php echo $tolink;?>" class="btn-cart-roundw-big font new-item-line-buy"><span>Заказать на производстве!</span></a></div>
      		</div>
      	</div>
<?php
             
        }
        ?>

<?
			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_poleznoe",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
?>


		</div>
	</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>