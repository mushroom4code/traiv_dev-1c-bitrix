<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вес по din 7981: винт самонарезающий с полукруглой головкой");
?>	<div class="content">
		<div class="container">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            );
			// Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
        if (CSite::InDir('/poleznoe/ves-izdeliy-po-din/')){ ?>  <a class="calc_banner_one" href="/calculator/"><p style="text-align:center"><img src="/images/banners/bannet_calc_ves.png" alt="Калькулятор крепежа и метизов"></p></a>            <?}			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_din-7981",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

			?>




<div class="social_share_2020"><div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
</div>

		</div>
	</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>