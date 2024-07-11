<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if ( !Loader::includeModule('protobyte.elementhistory')) return;

return [
	"parent_menu" => "global_menu_services",
	"sort"        => 5100,                    // вес пункта меню
    "url"         => "/bitrix/admin/protobyte.elementhistory_history_list.php?lang=".LANGUAGE_ID,
	"text"        => GetMessage("PROTOBYTE_ELEMENT_HISTORY"),
	"title"       => "", // текст всплывающей подсказки
	"icon"        => "elementhistory_menu_icon", // малая иконка
	"page_icon"   => "", // большая иконка
	"items_id"    => "menu_protobyte_elementhistory",  // идентификатор ветви
];