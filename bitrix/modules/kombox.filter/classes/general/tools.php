<?php
namespace Kombox\Filter;

class Tools{
	public function getFormatValue($arProperty, $value){
		static $cacheL = array();
		static $cacheE = array();
		static $cacheG = array();
		static $cacheU = array();

		$key = $value;
		$PROPERTY_TYPE = $arProperty['PROPERTY_TYPE'];
		$PROPERTY_USER_TYPE = $arProperty['USER_TYPE'];
		$PROPERTY_ID = $arProperty['ID'];

		if($PROPERTY_TYPE == 'F')
		{
			return null;
		}
		elseif($PROPERTY_TYPE == 'N')
		{
			return $key;
		}
		elseif($PROPERTY_TYPE == 'E' && $key <= 0)
		{
			return null;
		}
		elseif($PROPERTY_TYPE == 'G' && $key <= 0)
		{
			return null;
		}
		elseif(strlen($key) <= 0)
		{
			return null;
		}
		
		$arUserType = array();
		if($PROPERTY_USER_TYPE != '')
		{
			$arUserType = \CIBlockProperty::GetUserType($PROPERTY_USER_TYPE);
			if(array_key_exists('GetPublicViewHTML', $arUserType))
				$PROPERTY_TYPE = 'U';
		}
		
		switch($PROPERTY_TYPE)
		{
		case 'L':
			if(!isset($cacheL[$PROPERTY_ID]))
			{
				$cacheL[$PROPERTY_ID] = array();
				$rsEnum = \CIBlockPropertyEnum::GetList(array('SORT'=>'ASC', 'VALUE'=>'ASC'), array('PROPERTY_ID' => $PROPERTY_ID));
				while ($enum = $rsEnum->Fetch())
					$cacheL[$PROPERTY_ID][$enum['ID']] = $enum;
			}

			if (!array_key_exists($key,  $cacheL[$PROPERTY_ID]))
				return null;

			return $cacheL[$PROPERTY_ID][$key]['VALUE'];
			break;
		case 'E':
			if(!isset($cacheE[$key]))
			{
				$arLinkFilter = array (
					'ID' => $key,
					'ACTIVE' => 'Y',
					'ACTIVE_DATE' => 'Y',
					'CHECK_PERMISSIONS' => 'Y',
				);
				$rsLink = \CIBlockElement::GetList(array(), $arLinkFilter, false, false, array('ID','IBLOCK_ID','NAME','SORT'));
				$cacheE[$key] = $rsLink->Fetch();
			}
				
			return $cacheE[$key]['NAME'];
			break;
		case 'G':
			if(!isset($cacheG[$key]))
			{
				$arLinkFilter = array (
					'ID' => $key,
					'GLOBAL_ACTIVE' => 'Y',
					'CHECK_PERMISSIONS' => 'Y',
				);
				$rsLink = \CIBlockSection::GetList(array(), $arLinkFilter, false, array('ID','IBLOCK_ID','NAME','LEFT_MARGIN','DEPTH_LEVEL'));
				$cacheG[$key] = $rsLink->Fetch();
			}
				
			return $cacheG[$key]['NAME'];
			break;
		case 'U':
			if(!isset($cacheU[$PROPERTY_ID]))
				$cacheU[$PROPERTY_ID] = array();

			if(!isset($cacheU[$PROPERTY_ID][$key]))
			{
				$cacheU[$PROPERTY_ID][$key] = call_user_func_array(
					$arUserType['GetPublicViewHTML'],
					array(
						$arProperty,
						array('VALUE' => $key),
						array('MODE' => 'SIMPLE_TEXT'),
					)
				);
			}

			return $cacheU[$PROPERTY_ID][$key];
			break;
		case 'N':
			return $key;
			break;
		default:
			return $key;
			break;
		}
	}
}
?>