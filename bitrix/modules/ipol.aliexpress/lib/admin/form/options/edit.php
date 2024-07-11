<?php
namespace Ipol\AliExpress\Admin\Form\Options;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Ipol\AliExpress\Api\Client;
use Ipol\AliExpress\DB\OrderTable;
use Ipol\AliExpress\DB\PalletTable;

OrderTable::loadLocMessages();
PalletTable::loadLocMessages();

class Edit extends Base
{
	/**
	 * Имя формы
	 * @var string
	 */
	protected $name = 'IPOL_ALI_OPTIONS';

	/**
	 * Отрисовывает форму
	 * 
	 * @param array|\ArrayAccess  $values массив значений формы
	 * @param \Bitrix\Main\Result $result результат проверки формы
	 * 
	 * @return string
	 */
	public function render($values = [], Result $result = null)
	{
		return ''
			. ($warning ? $this->getRenderer()->renderResultMessage($warning) : '')
			. parent::render($values, $result)
		;
	}

	/**
	 * Возвращает набор полей формы
	 * 
	 * @return array
	 */
	public function getFields()
	{
		return [
			[
				'DIV'      => $this->getModuleId() .'_OPTIONS_TAB_AUTH',
				'TAB'      => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_AUTH'),
				'ICON'     => 'support_settings',
				'TITLE'    => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_AUTH_TITLE'),
				'HELP'     => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_AUTH_HELP'),
				'OPTIONS'  => [],
				'CONTROLS' => $this->getAuthFields(),
			],

			[
				'DIV'      => $this->getModuleId() .'_OPTIONS_TAB_EXPORT',
				'TAB'      => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_EXPORT'),
				'ICON'     => 'support_settings',
				'TITLE'    => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_EXPORT_TITLE'),
				'HELP'     => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_EXPORT_HELP'),
				'OPTIONS'  => [],
				'CONTROLS' => [
					'ARTICUL' => [
						'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_EXPORT_ARTICUL_TITLE'),
						'TYPE'  => 'STRING',
						'HELP'  => Loc::getMessage($this->getModuleId() .'_OPTIONS_EXPORT_ARTICUL_TITLE_HELP'),
					],

					'EXPORT_HEADER' => [
						'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_EXPORT_HEADER_TITLE'),
						'TYPE'  => 'HEADER',
						'HELP'  => Loc::getMessage($this->getModuleId() .'_OPTIONS_EXPORT_HEADER_TITLE'),
					],

					'EXPORT_DESC' => [
						'TITLE'        => '',
						'SHOW_CAPTION' => 'N',
						'TYPE'         => function() {
							return Loc::getMessage($this->getModuleId() .'_OPTIONS_EXPORT_DESC');
						},
					],

					'EXPORT' => [
						'TITLE'        => '',
						'SHOW_CAPTION' => 'N',
						'HELP'         => '',
						'TYPE'         => [$this, 'showExportList'],
					],

					'EXPORT_DESC_B' => [
						'TITLE'        => '',
						'SHOW_CAPTION' => 'N',
						'TYPE'         => function() {
							return Loc::getMessage($this->getModuleId() .'_OPTIONS_EXPORT_DESC_B');
						},
					],

					'IMPORT_HEADER' => [
						'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_IMPORT_HEADER_TITLE'),
						'TYPE'  => 'HEADER',
						'HELP'  => Loc::getMessage($this->getModuleId() .'_OPTIONS_IMPORT_HEADER_TITLE'),
					],

					'IMPORT' => [
						'TITLE'        => '',
						'SHOW_CAPTION' => 'N',
						'HELP'         => '',
						'TYPE'         => function() {
							return Loc::getMessage($this->getModuleId() .'_OPTIONS_IMPORT_DESC');
						},
					]
				]
			],

			[
				'DIV'      => $this->getModuleId() .'_OPTIONS_TAB_ORDER',
				'TAB'      => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_ORDER'),
				'ICON'     => 'support_settings',
				'TITLE'    => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_ORDER_TITLE'),
				'HELP'     => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_ORDER_HELP'),
				'OPTIONS'  => [],
				'CONTROLS' => [$this, 'getSyncOrderFields'],
			],

			[
				'DIV'      => $this->getModuleId() .'_OPTIONS_TAB_STATUS',
				'TAB'      => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_STATUS'),
				'ICON'     => 'support_settings',
				'TITLE'    => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_STATUS_TITLE'),
				'HELP'     => Loc::getMessage($this->getModuleId() .'_OPTIONS_TAB_STATUS_HELP'),
				'OPTIONS'  => [],
				'CONTROLS' => [$this, 'getSyncStatusFields'],
			],

			[
				'DIV'      => 'IPOL_ALI_OPTIONS_TAB_DIMENSIONS',
				'TAB'      => Loc::getMessage("IPOL_ALI_OPTIONS_TAB_DIMENSIONS"),
				'ICON'     => '',
				'TITLE'    => Loc::getMessage("IPOL_ALI_OPTIONS_TAB_DIMENSIONS_TITLE"),
				'HELP'     => Loc::getMessage("IPOL_ALI_OPTIONS_TAB_DIMENSIONS_HELP"),
				'OPTIONS'  => [],
				'CONTROLS' => [

					'USE_MODE' => [
						'TYPE' => 'SELECT',
						'TITLE' => Loc::getMessage("IPOL_ALI_OPTIONS_USE_MODE"),
						'DEFAULT' => 'ORDER',
						'ITEMS' => [
							'ORDER' => Loc::getMessage("IPOL_ALI_OPTIONS_USE_MODE_ORDER"),
							'ITEM'  => Loc::getMessage("IPOL_ALI_OPTIONS_USE_MODE_ITEM"),
						]
					],
		
					'WEIGHT' => [
						'TYPE' => 'TEXT',
						'TITLE' => Loc::getMessage("IPOL_ALI_OPTIONS_WEIGHT"),
						'DEFAULT' =>  '1000',
						"VALIDATORS" => [
							"required" => Loc::getMessage("IPOL_ALI_OPTIONS_WEIGHT_REQUIRED"),
						],
					],
		
					'LENGTH' => [
						'TYPE' => 'TEXT',
						'TITLE' => Loc::getMessage("IPOL_ALI_OPTIONS_LENGTH"),
						'DEFAULT' =>  '200',
						"VALIDATORS" => [
							"required" => Loc::getMessage("IPOL_ALI_OPTIONS_LENGTH_REQUIRED"),
						],
					],
		
					'WIDTH' => [
						'TYPE' => 'TEXT',
						'TITLE' => Loc::getMessage("IPOL_ALI_OPTIONS_WIDTH"),
						'DEFAULT' =>  '100',
						"VALIDATORS" => [
							"required" => Loc::getMessage("IPOL_ALI_OPTIONS_WIDTH_REQUIRED"),
						],
					],
		
					'HEIGHT' => [
						'TYPE' => 'TEXT',
						'TITLE' => Loc::getMessage("IPOL_ALI_OPTIONS_HEIGHT"),
						'DEFAULT' =>  '200',
						"VALIDATORS" => [
							"required" => Loc::getMessage("IPOL_ALI_OPTIONS_HEIGHT_REQUIRED"),
						],
					],
				],
			],
		];	
	}

	public function getAuthFields()
	{
		$authType = $_REQUEST['IPOL_ALI_OPTIONS']['AUTH_TYPE'] ?? Option::get(IPOLH_ALI_MODULE, 'AUTH_TYPE', 'SIMPLE');
		$client   = $this->getClient();

		$ret = [
			'NEW_API_HEADER' => [
				'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_APP_NEW_API_HEADER'),
				'TYPE'  => 'HEADER',
			],

			'APP_ACCESS_TOKEN_NEW' => [
				'TITLE'      => Loc::getMessage($this->getModuleId() .'_OPTIONS_APP_ACCESS_TOKEN_NEW_TITLE'),
				'HELP'       => '',
				'COMMENT'    => Loc::getMessage($this->getModuleId() .'_OPTIONS_APP_ACCESS_TOKEN_NEW_HELP'),
				'TYPE'       => 'string',
				'MULTILINE'  => true,
				'VALIDATORS' => [
					'required' => Loc::getMessage($this->getModuleId() .'_OPTIONS_APP_ACCESS_TOKEN_ERROR_EMPTY')
				],
				'ATTRS'      => [
					'rows' => 5,
					'cols' => 50,
				]
			]
		];

		return $ret;
	}

	/**
	 * Отображает таблицу с профилями экспорта
	 *
	 * @param string $field
	 * @param array  $data
	 * 
	 * @return string
	 */
	public function showExportList($field, $data)
	{
		$exports = \CCatalogExport::GetList($order  = ['ID' => 'ASC'], $filter = [
			'FILE_NAME' => 'ipol_aliexpress',
			'NEED_EDIT' => 'N',
		]);

		$items = [];

		while($export = $exports->Fetch()) {
			$params = [];
			parse_str($export['SETUP_VARS'], $params);

			$url = ($params['USE_HTTPS'] ? 'https' : 'http') .'://'. $params['SETUP_SERVER_NAME'] . $params['SETUP_FILE_NAME'];
			$items[] = [
				'id'   => $export['ID'],
				'data' => [
					'ID'       => $export['ID'],
					'NAME'     => $export['NAME'],
					'FILE'     => '<a href="'. $url .'" target="_blank">'. $url .'</a>',
					'LAST_USE' => $export['LAST_USE_FORMAT'],
					'IN_AGENT' => $export['IN_AGENT'] == 'Y' ? 'Да' : 'Нет',
					'IN_CRON'  => $export['IN_CRON'] == 'Y' ? 'Да' : 'Нет',
				],

				'actions' => [
					[
						"ICONCLASS" => "edit",
						"TEXT"      => "Редактировать",
						"ONCLICK"   => 'document.location.href="/bitrix/admin/cat_export_setup.php?lang=ru&ACT_FILE=ipol_aliexpress&ACTION=EXPORT_EDIT&PROFILE_ID='. $export['ID'] .'&'. bitrix_sessid_get() .'"',
					],

					[
						"ICONCLASS" => "edit",
						"TEXT"      => "Экспортировать",
						"ONCLICK"   => 'document.location.href="/bitrix/admin/cat_export_setup.php?lang=ru&ACT_FILE=ipol_aliexpress&ACTION=EXPORT&PROFILE_ID='. $export['ID'] .'&'. bitrix_sessid_get() .'"',
					]
				]
			];
		}

		ob_start();

		print '<div class="adm-toolbar-panel-container">';
		print '	<div class="adm-toolbar-panel-flexible-space">';
		print '		<a href="/bitrix/admin/cat_export_setup.php?lang=ru&ACT_FILE=ipol_aliexpress&ACTION=EXPORT_SETUP&'. bitrix_sessid_get() .'" class="ui-btn-primary ui-btn-main">'. Loc::getMessage($this->getModuleId(). '_OPTIONS_EXPORT_ADD_PROFILE') .'</a>';
		print '	</div>';
		print '</div>';

		$GLOBALS['APPLICATION']->IncludeComponent('bitrix:main.ui.grid', '.default', [
			'GRID_ID'                   => $this->getModuleId() .'_export_profiles',
			'HEADERS'                   => [
				[
					'id'         => 'ID', 
					'name'       => 'ID',  
					'default'    => true, 
					'editable'   => false,
				],

				[
					'id'         => 'NAME', 
					'name'       => Loc::getMessage($this->getModuleId(). '_OPTIONS_EXPORT_NAME_PROFILE'),  
					'default'    => true, 
					'editable'   => false,
				],

				[
					'id'         => 'FILE', 
					'name'       => Loc::getMessage($this->getModuleId(). '_OPTIONS_EXPORT_FILE_PROFILE'),  
					'default'    => true, 
					'editable'   => false,
				],

				[
					'id'         => 'LAST_USE', 
					'name'       => Loc::getMessage($this->getModuleId(). '_OPTIONS_EXPORT_USED_PROFILE'),  
					'default'    => true, 
					'editable'   => false,
				],

				[
					'id'         => 'IN_CRON', 
					'name'       => 'Cron',  
					'default'    => true, 
					'editable'   => false,
				],
				
				[
					'id'         => 'IN_AGENT', 
					'name'       => Loc::getMessage($this->getModuleId(). '_OPTIONS_EXPORT_AGENT_PROFILE'),  
					'default'    => true, 
					'editable'   => false,
				],
			],
			'ROWS'                      => $items,
			'SHOW_ROW_CHECKBOXES'       => false,
			'SHOW_CHECK_ALL_CHECKBOXES' => false,
			'NAV_OBJECT'                => null,
			'AJAX_MODE'                 => false,
			'AJAX_ID'                   => '',
			'PAGE_SIZES'                => [],
			'SHOW_ROW_ACTIONS_MENU'     => true,
			'SHOW_GRID_SETTINGS_MENU'   => false,
			'SHOW_NAVIGATION_PANEL'     => false,
			'SHOW_PAGINATION'           => false,
			'SHOW_SELECTED_COUNTER'     => false,
			'SHOW_TOTAL_COUNTER'        => true,
			'SHOW_PAGESIZE'             => true,
			'SHOW_ACTION_PANEL'         => false,
			'ALLOW_SORT'                => false,
			'ALLOW_COLUMNS_SORT'        => false,
			'ALLOW_COLUMNS_RESIZE'      => true,
			'ALLOW_HORIZONTAL_SCROLL'   => true,
			'ALLOW_PIN_HEADER'          => true,
			'AJAX_OPTION_HISTORY'       => false,
			'EDITABLE'                  => false,
		]);

		return ob_get_clean();
	}

	public function getSyncOrderFields($values = false)
	{
		$sites = [];
		$personeTypes = [];

		$siteId = false;
		$personeTypeId = false;

		$items = \CSite::GetList($by = "active", $order = "desc", array("ACTIVE" => "Y"));
		while($item = $items->Fetch()) {
			$sites[] = $item;

			if ($item['ID'] == $values['ORDER_SITE_ID']) {
				$siteId = $item['ID'];
			}
		}

		if ($siteId) {
			$items  = \CSalePersonType::GetList(array("SORT" => "ASC"), array("LID" => $siteId, 'ACTIVE' => 'Y'));
			while($item = $items->fetch()) {
				$personeTypes[] = $item;

				if ($item['ID'] == $values['ORDER_PERSON_TYPE_ID']) {
					$personeTypeId = $item['ID'];
				}
			}
		}

		$paymentSystems = [];

		$items = \CSalePaySystemAction::GetList(
			$order  = [],
			$filter = []
		);

		while($item = $items->Fetch()) {
			$paymentSystems[] = $item;
		}

		$ret = [
			'ORDER_USER_ID' => [
				'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_USER_ID_TITLE'),
				'HELP'  => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_USER_ID_HELP'),
				'TYPE'  => 'INPUT',
			],

			'ORDER_SITE_ID' => [
				'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_SITE_ID_TITLE'),
				'HELP'  => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_SITE_ID_HELP'),
				'TYPE'  => 'SELECT',
				'NULL'  => '',
				'ITEMS' => $sites,
				'ATTRS' => [
					'onchange' => 'this.form.submit();'
				]
			],

			'ORDER_PERSON_TYPE_ID' => [
				'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_PERSON_TYPE_ID_TITLE'),
				'HELP'  => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_PERSON_TYPE_ID_HELP'),
				'TYPE'  => $siteId ? 'SELECT' : 'HIDDEN',
				'NULL'  => '',
				'ITEMS' => $personeTypes,
				'ATTRS' => [
					'onchange' => 'this.form.submit();'
				]
			],

			'ORDER_PAYMENT_SYSTEM_ID' => [
				'TITLE' => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_PAYMENT_SYSTEM_ID_TITLE'),
				'HELP'  => Loc::getMessage($this->getModuleId() .'_OPTIONS_ORDER_PAYMENT_SYSTEM_ID_HELP'),
				'TYPE'  => 'SELECT',
				'NULL'  => '',
				'ITEMS' => $paymentSystems,
				'ATTRS' => [
					// 'onchange' => 'this.form.submit();'
				]
			]
		];
		
		$orderProps = $personeTypeId ? \Ipol\AliExpress\Utils::GetOrderProps($personeTypeId) : [];
		$orderProps = array_reduce($orderProps, function($ret, $item) {
			$code       = $item['ID'];
			$ret[$code] = $item['NAME'];

			return $ret;
		}, []);

		$controlNames = [
			'ID'         => true,
			'LAST_NAME'  => true,
			'FIRST_NAME' => true, 
			'PHONE'      => true,
			'MOBILE'     => false,
			'PERSONE'    => false,
			'ZIP'        => true,
			// 'COUNTRY' => true,
			// 'REGION'  => true,
			'CITY'       => true,
			'ADDRESS1'   => true,
			'ADDRESS2'   => false,
            'MEASURE'    => true

		];

		foreach ($controlNames as $controlName => $isRequired) {
			$ret['ORDER_FIELD_'. $controlName] = array(
				'TITLE'      => Loc::getMessage($this->getModuleId() . '_OPTIONS_ORDER_FIELD_'. $controlName .'_TITLE'),
				'HELP'       => Loc::getMessage($this->getModuleId() . '_OPTIONS_ORDER_FIELD_'. $controlName .'_HELP'),
				'TYPE'       => $personeTypeId ? 'SELECT' : 'HIDDEN',
				'ITEMS'      => $orderProps,
				'NULL'       => '',
				// 'VALIDATORS' => $isRequired ? array(
				// 	'required' => Loc::getMessage('IPOL_ALI_OPTIONS_RECEIVER_'. $controlName .'_REQUIRED', ['#PERSONE_TYPE_NAME#' => $arPersoneType['NAME'], '#PERSON_TYPE_ID#' => $arPersoneType['ID']]),
				// ) : array(),
			);
		}

        $measureList = \CCatalogMeasure::GetList(array("IS_DEFAULT" => "DESC"), array(), false, false, array());
        while( $ob = $measureList->fetch())
        {
            $measure[$ob['CODE']]=$ob['MEASURE_TITLE'];
        }

        $ret['ORDER_FIELD_MEASURE']['ITEMS'] = $measure;

		return $ret;
	}

	public function getSyncStatusFields($values = false)
	{
		$items = \CSaleStatus::GetList(array('SORT' => 'ASC', 'ID' => 'ASC'), array('LID'  => LANGUAGE_ID, 'TYPE' => 'O'));
		$statuses = array();

		while($item = $items->Fetch()) {
			$item['NAME'] = $item['NAME'] .' ['. $item['ID'] .']';
			$statuses[ $item['ID'] ] = $item;
		}

		return [
			'STATUS_ORDER_PLACE_ORDER_SUCCESS' => [
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_PLACE_ORDER_SUCCESS_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_PLACE_ORDER_SUCCESS_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			],
			
			'STATUS_ORDER_IN_CANCEL' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_IN_CANCEL_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_IN_CANCEL_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),

			'STATUS_ORDER_WAIT_SELLER_SEND_GOODS' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_WAIT_SELLER_SEND_GOODS_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_WAIT_SELLER_SEND_GOODS_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),

			'STATUS_ORDER_SELLER_PART_SEND_GOODS' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_SELLER_PART_SEND_GOODS_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_SELLER_PART_SEND_GOODS_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),

			'STATUS_ORDER_WAIT_BUYER_ACCEPT_GOODS' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_WAIT_BUYER_ACCEPT_GOODS_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_WAIT_BUYER_ACCEPT_GOODS_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),

			'STATUS_ORDER_FUND_PROCESSING' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_FUND_PROCESSING_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_FUND_PROCESSING_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),

			'STATUS_ORDER_IN_ISSUE' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_IN_ISSUE_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_IN_ISSUE_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),

			'STATUS_ORDER_IN_FROZEN' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_IN_FROZEN_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_IN_FROZEN_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),

			'STATUS_ORDER_WAIT_SELLER_EXAMINE_MONEY' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_WAIT_SELLER_EXAMINE_MONEY_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_WAIT_SELLER_EXAMINE_MONEY_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),
			
			'STATUS_ORDER_RISK_CONTROL' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_RISK_CONTROL_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_RISK_CONTROL_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),
			
			'STATUS_ORDER_CANCELLED' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_CANCELLED_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_CANCELLED_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),
			
			'STATUS_ORDER_FINISH' => array(
				'TITLE' => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_FINISH_TITLE"),
				'HELP'  => Loc::getMessage($this->getModuleId() . "_STATUS_ORDER_FINISH_HELP"),
				'TYPE'  => 'SELECT',
				'ITEMS' => $statuses,
				'NULL'  => Loc::getMessage($this->getModuleId() ."_STATUS_ORDER_EMPTY"),
			),
		];
	}

	protected function getClient()
	{
		$authType = $_REQUEST['IPOL_ALI_OPTIONS']['AUTH_TYPE'] ?? Option::get(IPOLH_ALI_MODULE, 'AUTH_TYPE', 'SIMPLE');

		return Client::getInstance($authType);
	}
}