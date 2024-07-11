<?
namespace Kombox\Filter;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class SeoTable extends Entity\DataManager
{
	public static function getFilePath()
	{
		return __FILE__;
	}
	
	public static function getTableName()
	{
		return 'b_kombox_filter_seo';
	}

	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
			),
			'IBLOCK_ID' => array(
				'data_type' => 'integer',
				'required' => true
			),
			'SECTION_ID' => array(
				'data_type' => 'integer'
			),
			'INCLUDE_SUBSECTIONS' => array(
				'data_type' => 'boolean',
				'values' => array('N','Y')
			),
			'ACTIVE' => array(
				'data_type' => 'boolean',
				'values' => array('N','Y')
			),
			'H1' => array(
				'data_type' => 'string'
			),
			'TITLE' => array(
				'data_type' => 'string'
			),
			'DESCRIPTION' => array(
				'data_type' => 'text'
			),
			'KEYWORDS' => array(
				'data_type' => 'text'
			),
			'TEXT' => array(
				'data_type' => 'text'
			),
			'TEXT_TYPE' => array(
				'data_type' => 'string'
			)
		);
	}
}
?>