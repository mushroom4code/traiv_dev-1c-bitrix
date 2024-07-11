<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Класс прочности DIN и ГОСТ"); ?>	<div class="content">
		<section id="content">
		<div class="container">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            );
 ?>
 
 <div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span>Класс прочности DIN и ГОСТ</span></h1>
</div>
</div>

			<div class="plashka_ff">
<?

			// Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_klass-prochnosti-din-i-gost",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
); ?>

                <div class="social_share_2020" style="margin-top: 2%"><div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
                </div>
		</div>
	</div>
	</div>
    	</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>