<?php

namespace Protobyte\ElementHistory;
use Bitrix\Main\Localization\Loc;

IncludeModuleLangFile(__FILE__);

class TabIBlockElement {
	protected static $_instance = null;

	/**
	 *
	 * @return TabIBlockElement
	 */
	public static function getInstance() {

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public static function onInit($params) {
		return array(
			"TABSET" => "PROTOBYTE_HISTORY",
			"GetTabs" => array(self::getInstance(), "tabs"),
			"ShowTab" => array(self::getInstance(), "showtab"),
			"Action" => array(self::getInstance(), "action"),
			"Check" => array(self::getInstance(), "check"),
		);
	}

	public function action($params) {
		return true;
	}

	public function check($params) {
		return true;
	}

	public function tabs($arArgs) {

		return array(
			array(
				"DIV" => "protobyte_history",
				"TAB" => Loc::getMessage( 'PROTO_TAB_HISTORY_NAME' ),
				"ICON" => "sale",
				"TITLE" => Loc::getMessage( 'PROTO_TAB_HISTORY_NAME' ),
				"SORT" => 999
			)
		);
	}

	public function showtab($divName, $params, $bVarsFromForm) {
        global $APPLICATION;

		if ($divName == "protobyte_history") {
			?>
			<tr>
				<td>
                    <? include($_SERVER['DOCUMENT_ROOT'].getLocalPath('modules/protobyte.elementhistory/table.php'));?>
				</td>
			</tr>
			<?
		}
	}
}