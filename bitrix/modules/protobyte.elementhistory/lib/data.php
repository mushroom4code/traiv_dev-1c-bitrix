<?php

namespace Protobyte\ElementHistory;

use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;

class DataTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'protobyte_element_history';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\IntegerField('ELEMENT_ID'),
            new Entity\IntegerField('IBLOCK_ID'),
            new Entity\IntegerField('MODIFIED_BY'),
	        new Entity\DatetimeField('TIMESTAMP'),
	        new Entity\EnumField('TYPE', array(
		        'values' => array('IBLOCK_ELEMENT', 'IBLOCK_SECTION', 'HLBLOCK_ELEMENT')
	        )),
	        new Entity\BooleanField('DELETED', array(
		        'values' => array('N', 'Y')
	        )),
	        new Entity\StringField('NAME'),
            new Entity\TextField('DATA', array(
	            'save_data_modification' => function () {
		            return array(
			            function ($value) {
				            return serialize($value);
			            }
		            );
	            },
	            'fetch_data_modification' => function () {
		            return array(
			            function ($value) {
				            return unserialize($value);
			            }
		            );
	            }
            )),
        );
    }
}