<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Таблица соответствия DIN ГОСТ ISO со схемами");
$APPLICATION->SetPageProperty("title", "Соответствие DIN ГОСТ ISO со схемами");
$APPLICATION->SetTitle("Соответствие DIN ГОСТ ISO со схемами");
?>

    <section id="content">

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
<h1><span>Соответствие DIN-ГОСТ-ISO со схемами</span></h1>
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
		"AREA_FILE_SUFFIX" => "__din-gost-iso-so-skhemami",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

			?>

    <span class="social_share_2020" style="margin-top: 2%">
        <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
    </span>
		
	</div>
</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>