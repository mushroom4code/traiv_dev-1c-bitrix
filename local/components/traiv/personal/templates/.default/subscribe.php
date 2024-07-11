<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<? include_once 'top.php'; ?>

<div class="row lk_right_menu h-100 g-0">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
		<div class="row row d-flex align-items-center lk-item-block g-0">

<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit",
	"",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALLOW_ANONYMOUS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SET_TITLE" => "Y",
		"SHOW_AUTH_LINKS" => "Y",
		"SHOW_HIDDEN" => "N"
	),
        $component
);?>
		</div>
	</div>
</div>
<? include_once 'bottom.php'; ?>
