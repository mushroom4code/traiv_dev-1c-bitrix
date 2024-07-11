<?
use \Bitrix\Main\Loader;
use \Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use Protobyte\ElementHistory\DataTable;

Loc::loadMessages(__FILE__);

// ���������� JS
CUtil::InitJSCore(array('window'));
Bitrix\Main\Page\Asset::getInstance()->addJs("/bitrix/js/protobyte.elementhistory/script.js");

// � ������ ������ ������ ��������� �������
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$filter_ext = array();
$isEditMode = false;
if (strpos($request->getRequestUri(), "iblock_element_edit.php")
    || strpos($request->getRequestUri(), "cat_product_edit.php")){
	$isEditMode = true;
	$filter_ext = [
		"=TYPE"=>"IBLOCK_ELEMENT",
		"=ELEMENT_ID"=>$request->getQuery('ID'),
		"=IBLOCK_ID"=>$request->getQuery('IBLOCK_ID'),
	];
}

/* ������ ��������� ������� */
$grid_id = $isEditMode ? "edit_".DataTable::getTableName() : "list_".DataTable::getTableName(); //����������� �������
$grid_options = new Bitrix\Main\Grid\Options($grid_id);
$nav_params = $grid_options->GetNavParams();

/* ���������� */
$sort = $grid_options->GetSorting(['sort' => ['TIMESTAMP' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']]);

/* ��������� */
$nav = new Bitrix\Main\UI\PageNavigation($grid_id);
$nav->allowAllRecords(true)
    ->setPageSize($nav_params['nPageSize'])
    ->initFromUri();

/* ���������� */
$filterOption = new Bitrix\Main\UI\Filter\Options($grid_id);
$filterData = $filterOption->getFilter([]);
$filter = $filter_ext;
foreach ($filterData as $k => $v) {
    if($k=='PRESET_ID' || $k == 'FILTER_ID' || $k == 'FILTER_APPLIED') continue;
    if($k=="FIND") $filter["NAME"] = "%{$v}%"; else  $filter[$k] = $v;
}

/* �������� ������ */

$dataResult = DataTable::getList(array(
    "select"=>array("ID", "NAME", "ELEMENT_ID", "IBLOCK_ID", "MODIFIED_BY", "TIMESTAMP", "DELETED", "USER_LOGIN"=>"USER.LOGIN"),
    "filter"=>$filter,
    "order"=>$sort["sort"],
    'offset'      => $nav->getOffset(),
    'limit'       => $nav->getLimit(),
    'runtime'     => array(
	    new Entity\ReferenceField(
		    'USER',
		    '\Bitrix\Main\UserTable',
		    array('=this.MODIFIED_BY' => 'ref.ID'),
	    )
    ),
    'count_total' => true,
));
$data = $dataResult->fetchAll();

// ��� ��������� ������ ����� ���������� ��������� (����� �� ����� �������� ���������)
$nav->setRecordCount($dataResult->getCount());

/* ��������� ������ ������� */
$rows = [];
if ($isEditMode && $nav->getCurrentPage()==1){
    $res = \CIBlockElement::GetByID($filter_ext["=ELEMENT_ID"]);
    if($arCurrentElement = $res->GetNext()){
	    $user = \Bitrix\Main\UserTable::getById($arCurrentElement["MODIFIED_BY"])->fetch();
        $rows[] = [
            "id"=>-1,
            "columns" => [
                "NAME" => ' <span class="sonet-ui-grid-request-cont"><span class="ui-label sonet-ui-grid-role --role-green">
				<span class="ui-label-inner">'.Loc::getMessage("PROTO_HISTORY_CURRENT").'</span></span></span>'
                          . $arCurrentElement["NAME"] ,
                "TIMESTAMP"=> $arCurrentElement["TIMESTAMP_X"],
                "MODIFIED_BY"=> $arCurrentElement["MODIFIED_BY"],
                "USER_LOGIN"=> "<a href='/bitrix/admin/user_edit.php?lang=".LANG."&ID={$user['ID']}'> {$user['LOGIN']}</a>"
            ],
        ];
    }
}
foreach ($data as $datum){
	if ($datum['DELETED']=="Y"){
		$datum['NAME'] = ' <span class="sonet-ui-grid-request-cont"><span class="ui-label sonet-ui-grid-role --role-green">
				<span class="ui-label-inner">'.Loc::getMessage("PROTO_HISTORY_FIELD_DELETED").'</span></span></span>'
		                 . $datum["NAME"];
	}

    $datum['ACTION'] = '
        <a class="ui-btn ui-btn-success ui-btn-sm" style="text-decoration: none; color: #ffffff;" 
        onclick="proto_history_restore('.$datum["ID"].');">'
        .Loc::getMessage("PROTO_HISTORY_ACTION_RESTORE").'</a>';

	$datum['USER_LOGIN'] = "<a href='/bitrix/admin/user_edit.php?lang=".LANG."&ID={$datum['MODIFIED_BY']}'> {$datum['USER_LOGIN']}</a>";

    $rows[] = [
        "id"=>$datum["ID"],
        "columns" => $datum,
        'actions' => [
            [
                'text'    => Loc::getMessage("PROTO_HISTORY_ACTION_RESTORE"),
                'onclick' => 'proto_history_restore('.$datum["ID"].');',
            ],
        ],
    ];

}

/* ������� */
$columns = [
    ['id' => 'TIMESTAMP', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_TIMESTAMP"), 'sort'=>!$isEditMode ? 'TIMESTAMP' : false, 'default'=>true],
    ['id' => 'NAME', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_NAME"), 'default'=>true],
    ['id' => 'ELEMENT_ID', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_ELEMENT_ID"), 'default'=>!$isEditMode],
    ['id' => 'IBLOCK_ID', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_IBLOCK_ID"), 'default'=>!$isEditMode],
    ['id' => 'MODIFIED_BY', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_MODIFIED_BY")],
    ['id' => 'USER_LOGIN', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_USER_LOGIN"), 'default'=>true],
    ['id' => 'DELETED', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_DELETED")],
    ['id' => 'ACTION', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_ACTION"), 'default' => true],
];


/* ����� ������� */
$APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', [
    'FILTER_ID' => $grid_id,
    'GRID_ID' => $grid_id,
    'FILTER' => [
        ['id' => 'NAME', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_NAME")],
        ['id' => 'ELEMENT_ID', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_ELEMENT_ID")],
        ['id' => 'IBLOCK_ID', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_IBLOCK_ID")],
        ['id' => 'MODIFIED_BY', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_MODIFIED_BY")],
        ['id' => 'USER_LOGIN', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_USER_LOGIN")],
        ['id' => 'DELETED', 'name' => Loc::getMessage("PROTO_HISTORY_FIELD_DELETED"), 'type' => 'list', 'items' => ['Y' => '��', 'N' => '���'], 'params' => ['multiple' => 'N']],
    ],
    'ENABLE_LIVE_SEARCH' => true,
    'ENABLE_LABEL' => true
]);

/* ����� ����� */
$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'GRID_ID' => $grid_id,
        'COLUMNS' => $columns,
        'ROWS' => $rows,
        'PAGE_SIZES' =>  [
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100'],
            ['NAME' => '250', 'VALUE' => '250'],
            ['NAME' => '500', 'VALUE' => '500']
        ],
        'NAV_OBJECT' => $nav,
        'CURRENT_PAGE' => $nav->getCurrentPage(),
        'AJAX_MODE' => $isEditMode ? 'N' : 'Y',
        'AJAX_ID' => \CAjax::GetComponentID('bitrix:main.ui.grid', '', ''),
        'AJAX_OPTION_JUMP' => 'N',
        'AJAX_OPTION_HISTORY' => 'N',
        "SHOW_CHECK_ALL_CHECKBOXES" => false,
        "SHOW_ROW_CHECKBOXES" => false,
        'SHOW_ROW_ACTIONS_MENU'     => true,
        'SHOW_GRID_SETTINGS_MENU'   => true,
        'SHOW_NAVIGATION_PANEL'     => true,
        'SHOW_PAGINATION'           => true,
        'SHOW_SELECTED_COUNTER'     => true,
        'SHOW_TOTAL_COUNTER'        => true,
        'SHOW_PAGESIZE'             => true,
        'SHOW_ACTION_PANEL'         => true,
        'ALLOW_COLUMNS_SORT'        => true,
        'ALLOW_COLUMNS_RESIZE'      => true,
        'ALLOW_HORIZONTAL_SCROLL'   => true,
        'ALLOW_SORT'                => true,
        'ALLOW_PIN_HEADER'          => true,
    ]
);
?>

<script>
    BX.message({
        'PROTO_HISTORY_RESTORE_MODAL_TITLE': '<?=GetMessageJS("PROTO_HISTORY_RESTORE_MODAL_TITLE")?>',
        'PROTO_HISTORY_RESTORE_MODAL_BODY_OK': '<?=GetMessageJS("PROTO_HISTORY_RESTORE_MODAL_BODY_OK")?>',
    });
</script>
