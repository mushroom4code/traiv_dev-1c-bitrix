<?php
namespace Intervolga\Tips\Orm;

use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class TipsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> ACTIVE string(1) mandatory
 * <li> SITE string(2) mandatory
 * <li> URL string(1022) mandatory
 * <li> URL_LIKE string(1024) mandatory
 * <li> URL_EQUAL string(1) mandatory
 * <li> TEXT string(1024) mandatory
 * <li> TOOLTIP string optional
 * <li> CREATED_BY int optional
 * <li> CREATE_DATE datetime mandatory
 * <li> MODIFIED_BY int optional
 * <li> MODIFIED_DATE datetime mandatory
 * </ul>
 *
 * @package Bitrix\Tips
 **/

class TipsTable extends Entity\DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'intervolga_tips';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_ID_FIELD'),
			),
			'ACTIVE' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateActive'),
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_ACTIVE_FIELD'),
			),
			'SITE' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateSite'),
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_SITE_FIELD'),
			),
			'URL' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateUrl'),
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_URL_FIELD'),
			),
			'URL_LIKE' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateUrlLike'),
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_URL_LIKE_FIELD'),
				'hidden' => true,
			),
			'URL_EQUAL' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateUrlEqual'),
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_URL_EQUAL_FIELD'),
			),
			'TEXT' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateText'),
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_TEXT_FIELD'),
			),
			'TOOLTIP' => array(
				'data_type' => 'string',
				'validation' => array(__CLASS__, 'validateTooltip'),
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_TOOLTIP_FIELD'),
			),
			'CREATED_BY' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_CREATED_BY_FIELD'),
			),
			'CREATE_DATE' => array(
				'data_type' => 'datetime',
				'required' => true,
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_CREATE_DATE_FIELD'),
			),
			'MODIFIED_BY' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_MODIFIED_BY_FIELD'),
			),
			'MODIFIED_DATE' => array(
				'data_type' => 'datetime',
				'required' => true,
				'title' => Loc::getMessage('intervolga.tips.TIPS_ENTITY_MODIFIED_DATE_FIELD'),
			),
		);
	}
	/**
	 * Returns validators for ACTIVE field.
	 *
	 * @return array
	 */
	public static function validateActive()
	{
		return array(
			new Entity\Validator\Length(null, 1),
		);
	}
	/**
	 * Returns validators for SITE field.
	 *
	 * @return array
	 */
	public static function validateSite()
	{
		return array(
			new Entity\Validator\Length(null, 2),
		);
	}
	/**
	 * Returns validators for URL field.
	 *
	 * @return array
	 */
	public static function validateUrl()
	{
		return array(
			new Entity\Validator\Length(null, 1022),
		);
	}
	/**
	 * Returns validators for URL_LIKE field.
	 *
	 * @return array
	 */
	public static function validateUrlLike()
	{
		return array(
			new Entity\Validator\Length(null, 1024),
		);
	}
	/**
	 * Returns validators for URL_EQUAL field.
	 *
	 * @return array
	 */
	public static function validateUrlEqual()
	{
		return array(
			new Entity\Validator\Length(null, 1),
		);
	}
	/**
	 * Returns validators for TEXT field.
	 *
	 * @return array
	 */
	public static function validateText()
	{
		return array(
			new Entity\Validator\Length(null, 1024),
		);
	}
	/**
	 * Returns validators for TOOLTIP field.
	 *
	 * @return array
	 */
	public static function validateTooltip()
	{
		return array(
			new Entity\Validator\Length(null, 5000),
		);
	}

	/**
	 * Clears tips tag cache.
	 */
	protected static function clearTagCache()
	{
		if (defined('BX_COMP_MANAGED_CACHE') && is_object($GLOBALS['CACHE_MANAGER']))
		{
			$GLOBALS['CACHE_MANAGER']->ClearByTag('intervolga_tips');
		}
	}

	public static function update($primary, array $arData)
	{
		static::onBeforeSave($arData);
		$result = parent::update($primary, $arData);
		static::clearTagCache();
		return $result;
	}

	public static function add(array $arData)
	{
		global $USER;
		if ($USER && is_object($USER))
		{
			$arData["CREATED_BY"] = intval($USER->GetID());
		}
		$arData["CREATE_DATE"] = new DateTime();
		static::onBeforeSave($arData);
		$result = parent::add($arData);
		static::clearTagCache();
		return $result;
	}

	public static function delete($primary)
	{
		$result = parent::delete($primary);
		static::clearTagCache();
		return $result;
	}

	/**
	 * Fills auto fields and calculable fields before saving to DB.
	 *
	 * @param array $arData
	 */
	protected static function onBeforeSave(&$arData)
	{
		global $USER;
		if ($USER && is_object($USER))
		{
			$arData["MODIFIED_BY"] = intval($USER->GetID());
		}
		else
		{
			$arData["MODIFIED_BY"] = FALSE;
		}

		$arData["MODIFIED_DATE"] = new DateTime();
		$arData["TEXT"] = trim($arData["TEXT"]);
		$arData["URL_LIKE"] = "%" . $arData["URL"] . "%";
	}

	/**
	 * Retrieves active tips for page.
	 *
	 * @param string $sPage page relative url
	 * @param string $sSite site id
	 *
	 * @return array
	 */
	public static function getPageList($sPage, $sSite)
	{
		global $DB;

		$arResult = array();

		$sTableName = TipsTable::getTableName();
		$sSql = "
			SELECT
				ID, TEXT, TOOLTIP
			FROM
				$sTableName
			WHERE
				ACTIVE = 'Y'
			AND
				SITE = '$sSite'
			AND
			(
				(URL = '$sPage' AND URL_EQUAL = 'Y')
				OR
				('$sPage'LIKE URL_LIKE AND URL_EQUAL != 'Y')
			)
			ORDER BY ID";

		$dbResult = $DB->Query($sSql);
		while ($arTip = $dbResult->Fetch())
		{
			$arResult[$arTip["ID"]] = $arTip;
		}
		return $arResult;
	}
}