<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if ( !Loader::includeModule('protobyte.elementhistory')) return;

return [
	"parent_menu" => "global_menu_services",
	"sort"        => 5100,                    // ��� ������ ����
    "url"         => "/bitrix/admin/protobyte.elementhistory_history_list.php?lang=".LANGUAGE_ID,
	"text"        => GetMessage("PROTOBYTE_ELEMENT_HISTORY"),
	"title"       => "", // ����� ����������� ���������
	"icon"        => "elementhistory_menu_icon", // ����� ������
	"page_icon"   => "", // ������� ������
	"items_id"    => "menu_protobyte_elementhistory",  // ������������� �����
];