<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Товары");
define("NEED_AUTH", true);
?>
<div class="content">
	<div class="container">
		<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
			"COMPONENT_TEMPLATE" => ".default",
			"START_FROM" => "0",
			"PATH" => "",
			"SITE_ID" => "zf",
		),
			false
		);?>

		<aside class="aside">
			<?/*$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"catalog-sections",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"COMPONENT_TEMPLATE" => "catalog-sections"
				),
				false
			);*/?>
			<div class="u-none--m">
				<?if(SHOW_VK_WIDGET):?>
					<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
					<div id="vk_groups"></div>
					<script type="text/javascript">
						VK.Widgets.Group("vk_groups", {redesign: 1, mode: 4, width: "auto", height: "400", color1: 'FFFFFF', color2: '000000', color3: '5E81A8'}, 47382243);
					</script>
				<?endif?>

			</div>
		</aside>

		<main class="spaced-left">
		<section class="section">
			<div class="dashboard">
				<?include $_SERVER["DOCUMENT_ROOT"]."/include/personal-products.php";?>

				<div class="island">
					<?
                    $dbBasketItems = (new CSaleBasket)->GetList(
                        array(
                            "DATE_INSERT" => "DESC"
                        ),
                        array(
                            "LOGIC" => "AND",    
                            "USER_ID" => $USER->GetID(),
                            "!ORDER_ID" => "NULL"
                        ),
                        false,
                        false,
                        array("ID", "CALLBACK_FUNC", "MODULE",
                            "PRODUCT_ID", "QUANTITY", "DELAY",
                            "CAN_BUY", "PRICE", "WEIGHT",
                            "PRODUCT_ID", "DETAIL_PAGE_URL", "NAME")
                    );
                    while ($arItems = $dbBasketItems->Fetch())
                    {
//                        if (strlen($arItems["CALLBACK_FUNC"]) > 0)
//                        {
//                            CSaleBasket::UpdatePrice($arItems["ID"],
//                                $arItems["CALLBACK_FUNC"],
//                                $arItems["MODULE"],
//                                $arItems["PRODUCT_ID"],
//                                $arItems["QUANTITY"]);
//                            $arItems = CSaleBasket::GetByID($arItems["ID"]);
//                        }
//
//                        $arBasketItems[] = $arItems;



                        $pr = (new CIBlockElement)->GetByID($arItems["PRODUCT_ID"]);
                        if($pr = $pr->GetNext())
                            echo '<a href="'.(!empty($pr["DETAIL_PAGE_URL"]) ? $pr["DETAIL_PAGE_URL"] : '#').'">'.$arItems["NAME"].'</a><br>';
                    }
                    ?>
				</div>
			</div>
		</section>
		</main>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
