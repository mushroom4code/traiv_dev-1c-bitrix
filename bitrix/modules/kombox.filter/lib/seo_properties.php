<?
namespace Kombox\Filter;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class SeoPropertiesTable extends Entity\DataManager
{
	public static function getFilePath()
	{
		return __FILE__;
	}
	
	public static function getTableName()
	{
		return 'b_kombox_filter_seo_props';
	}

	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
			),
			'RULE_ID' => array(
				'data_type' => 'integer',
				'required' => true
			),
			'PROPERTY_ID' => array(
				'data_type' => 'integer',
				'required' => true
			),
			'VALUE' => array(
				'data_type' => 'string'
			),
			'NUM_FROM' => array(
				'data_type' => 'float'
			),
			'NUM_TO' => array(
				'data_type' => 'float'
			)
		);
	}
	
	public function deleteAll($RULE_ID){
		$rsProperties = self::getList(array(
			'filter' => array('RULE_ID' => $RULE_ID)
		));
		
		while($arProperty = $rsProperties->Fetch()){
			self::delete($arProperty['ID']);
		}
	}
}
?>