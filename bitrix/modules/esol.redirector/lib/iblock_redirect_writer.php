<?php
namespace Bitrix\EsolRedirector;

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class IblockRedirectWriter
{
	protected static $moduleId = 'esol.redirector';
	protected static $instance = null;
	protected static $iblockAutoRedirect = null;
	protected static $redirectFromOldSE = null;
	protected static $arExcludeUrls = null;
	private static $arElementUrls = array();
	private static $arSectionUrls = array();
	private static $arElementActive = array();
	private static $arSectionActive = array();
	private static $arIblockSites = array();
	
	function __construct(){}
	
	public static function getInstance()
	{
		if (!isset(static::$instance))
			static::$instance = new static();

		return static::$instance;
	}
	
	public static function GetIblockSites($IBLOCK_ID)
	{
		if(!class_exists('\Bitrix\Iblock\IblockSiteTable')) return array();
		if(!array_key_exists($IBLOCK_ID, static::$arIblockSites))
		{
			static::$arIblockSites[$IBLOCK_ID] = array();
			$dbRes = \Bitrix\Iblock\IblockSiteTable::GetList(array('filter'=>array('IBLOCK_ID'=>$IBLOCK_ID), 'select'=>array('SITE_ID')));
			while($arSite = $dbRes->Fetch())
			{
				static::$arIblockSites[$IBLOCK_ID][] = $arSite['SITE_ID'];
			}
		}
		return static::$arIblockSites[$IBLOCK_ID];
	}
	
	public static function GetElementUrl($ID)
	{
		if((int)$ID > 0 && ($arElement = \CIblockElement::GetList(array(), array('ID'=>$ID), false, false, array('ID', 'DETAIL_PAGE_URL'))->GetNext()))
		{
			return $arElement['DETAIL_PAGE_URL'];
		}
		return '';
	}
	
	public static function GetElementFields($ID)
	{
		if((int)$ID > 0 && ($arElement = \CIblockElement::GetList(array(), array('ID'=>$ID), false, false, array('ID', 'DETAIL_PAGE_URL', 'ACTIVE', 'IBLOCK_ID', 'IBLOCK_SECTION_ID'))->GetNext()))
		{
			if(isset($arElement['LANG_DIR']) && strlen($arElement['LANG_DIR']) > 1 && strpos($arElement['DETAIL_PAGE_URL'], $arElement['LANG_DIR'])===0 && ($arSites = static::GetIblockSites($arElement['IBLOCK_ID'])) && count($arSites) > 1)
			{
				$arElement['DETAIL_PAGE_URL'] = $arElement['~DETAIL_PAGE_URL'] = substr($arElement['DETAIL_PAGE_URL'], strlen(rtrim($arElement['LANG_DIR'], '/')));
			}
			return $arElement;
		}
		return array();
	}
	
	public static function GetSectionUrl($ID)
	{
		if((int)$ID > 0 && ($arSection = \CIblockSection::GetList(array(), array('ID'=>$ID), false, array('ID', 'SECTION_PAGE_URL'))->GetNext()))
		{
			return $arSection['SECTION_PAGE_URL'];
		}
		return '';
	}
	
	public static function GetSectionFields($ID)
	{
		if((int)$ID > 0 && ($arSection = \CIblockSection::GetList(array(), array('ID'=>$ID), false, array('ID', 'SECTION_PAGE_URL', 'ACTIVE'))->GetNext()))
		{
			return $arSection;
		}
		return array();
	}
	
	public static function SaveOldElementUrl($arFields)
	{
		$ID = (int)$arFields['ID'];
		if($ID < 1) return;
		$arElement = static::GetElementFields($ID);
		static::$arElementUrls[$ID] = $arElement['DETAIL_PAGE_URL'];
		static::$arElementActive[$ID] = $arElement['ACTIVE'];
	}
	
	public static function EnableNewAddress()
	{
		if(!isset(self::$iblockAutoRedirect))
		{
			self::$iblockAutoRedirect = (bool)(\Bitrix\Main\Config\Option::get(self::$moduleId, 'IBLOCK_AUTO_REDIRECT', 'N')=='Y');
		}
		return self::$iblockAutoRedirect;
	}
	
	public static function GetActionOnRemove()
	{
		if(!isset(self::$redirectFromOldSE))
		{
			$option = \Bitrix\Main\Config\Option::get(self::$moduleId, 'REDIRECT_FROM_OLD_SE');
			if(strlen($option)==0) $option = false;
			self::$redirectFromOldSE = $option;
		}
		return self::$redirectFromOldSE;
	}
	
	public static function IsExclude($uri)
	{
		if(!isset(self::$arExcludeUrls)) self::$arExcludeUrls = explode("\n", \Bitrix\Main\Config\Option::get(self::$moduleId, 'REDIRECT_AUTO_EXCLUDE', ''));
		foreach(self::$arExcludeUrls as $exc)
		{
			$exc = trim($exc);
			if(strlen($exc)==0) continue;
			if(preg_match('/^'.strtr(preg_quote($exc, '/'), array('\*'=>'.*')).'$/', $uri))
			{
				return true;
			}
		}
		return false;
	}
	
	public static function GetParamOnRemoveAction(&$newUrl, &$status, $action, $IBLOCK_SECTION_ID=0)
	{
		if($action=='PARENT') $newUrl = static::GetSectionUrl($IBLOCK_SECTION_ID);
		elseif($action=='MAIN') $newUrl = '/';
		elseif($action=='410') $status = 410;
	}
	
	public static function SaveNewElementUrl($arFields)
	{
		$ID = (int)$arFields['ID'];
		if($ID < 1) return;
		$arElement = static::GetElementFields($ID);
		if(!$arElement || empty($arElement)) return;
		
		$newUrl = $arElement['DETAIL_PAGE_URL'];
		$newActive = $arElement['ACTIVE'];
		$IBLOCK_ID = (int)$arElement['IBLOCK_ID'];
		$IBLOCK_SECTION_ID = (int)$arElement['IBLOCK_SECTION_ID'];
		
		if(self::AllowRedirectForIblock($IBLOCK_ID))
		{
			$arSites = static::GetIblockSites($IBLOCK_ID);
			if(static::EnableNewAddress())
			{
				if($newUrl!=static::$arElementUrls[$ID] && strpos($newUrl, static::$arElementUrls[$ID])!==0 && !self::IsExclude(static::$arElementUrls[$ID]))
				{
					RedirectTable::AddRedirect(static::$arElementUrls[$ID], $newUrl, $arSites, 301, 'E'.$ID, true);
				}
			}
			if(($action = static::GetActionOnRemove()) && strlen($newUrl) > 0)
			{
				if($newActive!=static::$arElementActive[$ID] || $newUrl!=static::$arElementUrls[$ID])
				{
					if($newActive=='N')
					{
						$newUrl2 = '';
						$status2 = 301;
						static::GetParamOnRemoveAction($newUrl2, $status2, $action, $IBLOCK_SECTION_ID);
						if((strlen($newUrl2) > 0 || $status2==410) && !self::IsExclude($newUrl))
						{
							RedirectTable::AddRedirect($newUrl, $newUrl2, $arSites, $status2, 'E'.$ID);
						}
					}
					else
					{
						RedirectTable::RemoveRedirectByOldUrl($newUrl, $arSites);
					}
				}
			}
		}
	}
	
	public static function RemoveNewElementUrl($arFields)
	{
		$ID = (int)$arFields['ID'];
		if($ID < 1) return;
		$arElement = \CIblockElement::GetList(array(), array('ID'=>$ID), false, false, array('ID', 'DETAIL_PAGE_URL', 'IBLOCK_ID'))->GetNext();
		if(!$arElement) return;
		
		$newUrl = $arElement['DETAIL_PAGE_URL'];
		$IBLOCK_ID = (int)$arElement['IBLOCK_ID'];
		
		if(strlen($newUrl) > 0)
		{
			$arSites = static::GetIblockSites($IBLOCK_ID);
			RedirectTable::RemoveRedirectByOldUrl($newUrl, $arSites);
		}
	}
	
	public static function RemoveElementUrl($ID)
	{
		$ID = (int)$ID;
		if($ID < 1) return;
		$arElement = \CIblockElement::GetList(array(), array('ID'=>$ID), false, false, array('ID', 'DETAIL_PAGE_URL', 'IBLOCK_ID', 'IBLOCK_SECTION_ID'))->GetNext();
		if(!$arElement) return;
		
		$url = $arElement['DETAIL_PAGE_URL'];
		$IBLOCK_ID = $arElement['IBLOCK_ID'];
		$IBLOCK_SECTION_ID = $arElement['IBLOCK_SECTION_ID'];
		
		if(self::AllowRedirectForIblock($IBLOCK_ID) && strlen($url) > 0)
		{
			$arSites = static::GetIblockSites($IBLOCK_ID);	
			if(static::EnableNewAddress())
			{
				RedirectTable::RemoveRedirect($url, $arSites);
			}
			if($action = static::GetActionOnRemove())
			{
				$newUrl2 = '';
				$status2 = 301;
				static::GetParamOnRemoveAction($newUrl2, $status2, $action, $IBLOCK_SECTION_ID);
				if((strlen($newUrl2) > 0 || $status2==410) && !self::IsExclude($url))
				{
					RedirectTable::AddRedirect($url, $newUrl2, $arSites, $status2);
				}
			}
		}
	}
	
	public static function SaveOldSectionUrl($arFields)
	{
		$ID = (int)$arFields['ID'];
		if($ID < 1) return;
		$arSection = static::GetSectionFields($ID);
		static::$arSectionUrls[$ID] = $arSection['SECTION_PAGE_URL'];
		static::$arSectionActive[$ID] = $arSection['ACTIVE'];
	}
	
	public static function SaveNewSectionUrl($arFields)
	{
		$ID = (int)$arFields['ID'];
		if($ID < 1) return;
		$arSection = \CIblockSection::GetList(array(), array('ID'=>$ID), false, array('ID', 'SECTION_PAGE_URL', 'ACTIVE', 'IBLOCK_ID', 'IBLOCK_SECTION_ID'))->GetNext();
		if(!$arSection) return;
		
		$newUrl = $arSection['SECTION_PAGE_URL'];
		$newActive = $arSection['ACTIVE'];
		$IBLOCK_ID = $arSection['IBLOCK_ID'];
		$IBLOCK_SECTION_ID = $arSection['IBLOCK_SECTION_ID'];
		
		if(self::AllowRedirectForIblock($IBLOCK_ID))
		{
			$arSites = static::GetIblockSites($IBLOCK_ID);
			if(static::EnableNewAddress())
			{
				if($newUrl!=static::$arSectionUrls[$ID] && strpos($newUrl, static::$arSectionUrls[$ID])!==0 && !self::IsExclude(static::$arSectionUrls[$ID]))
				{
					RedirectTable::AddRedirect(static::$arSectionUrls[$ID], $newUrl, $arSites, 301, 'S'.$ID, true);
				}
			}
			if(($action = static::GetActionOnRemove()) && strlen($newUrl) > 0)
			{
				if($newActive!=static::$arSectionActive[$ID] || $newUrl!=static::$arSectionUrls[$ID])
				{
					if($newActive=='N')
					{
						$newUrl2 = '';
						$status2 = 301;
						static::GetParamOnRemoveAction($newUrl2, $status2, $action, $IBLOCK_SECTION_ID);
						if((strlen($newUrl2) > 0 || $status2==410) && !self::IsExclude($newUrl))
						{
							RedirectTable::AddRedirect($newUrl, $newUrl2, $arSites, $status2, 'S'.$ID);
						}
					}
					else
					{
						RedirectTable::RemoveRedirectByOldUrl($newUrl, $arSites);
					}
				}
			}
		}
	}
	
	public static function RemoveNewSectionUrl($arFields)
	{
		$ID = (int)$arFields['ID'];
		if($ID < 1) return;
		$arSection = \CIblockSection::GetList(array(), array('ID'=>$ID), false, array('ID', 'SECTION_PAGE_URL', 'IBLOCK_ID'))->GetNext();
		if(!$arSection) return;
		
		$newUrl = $arSection['SECTION_PAGE_URL'];
		$IBLOCK_ID = (int)$arSection['IBLOCK_ID'];
		
		if(strlen($newUrl) > 0)
		{
			$arSites = static::GetIblockSites($IBLOCK_ID);
			RedirectTable::RemoveRedirectByOldUrl($newUrl, $arSites);
		}
	}
	
	public static function RemoveSectionUrl($ID)
	{
		$ID = (int)$ID;
		if($ID < 1) return;
		$arSection = \CIblockSection::GetList(array(), array('ID'=>$ID), false, array('ID', 'SECTION_PAGE_URL', 'IBLOCK_ID', 'IBLOCK_SECTION_ID'))->GetNext();
		if(!$arSection) return;
		
		$url = $arSection['SECTION_PAGE_URL'];
		$IBLOCK_ID = $arSection['IBLOCK_ID'];
		$IBLOCK_SECTION_ID = $arSection['IBLOCK_SECTION_ID'];
		
		if(self::AllowRedirectForIblock($IBLOCK_ID) && strlen($url) > 0)
		{
			$arSites = static::GetIblockSites($IBLOCK_ID);
			if(static::EnableNewAddress())
			{
				RedirectTable::RemoveRedirect($url, $arSites);
			}
			if($action = static::GetActionOnRemove())
			{
				$newUrl2 = '';
				$status2 = 301;
				static::GetParamOnRemoveAction($newUrl2, $status2, $action, $IBLOCK_SECTION_ID);
				if((strlen($newUrl2) > 0 || $status2==410) && !self::IsExclude($url))
				{
					RedirectTable::AddRedirect($url, $newUrl2, $arSites, $status2);
				}
			}
		}
	}
	
	public static function CheckeRedirectByEntity($arRedirect)
	{
		if(!\Bitrix\Main\Loader::includeModule('iblock')) return true;
		if(!$arRedirect['ID'] || !$arRedirect['ENTITY'] || !$arRedirect['OLD_URL']) return true;
		if(strpos($arRedirect['ENTITY'], 'E')===0 && ($ID = (int)substr($arRedirect['ENTITY'], 1)) && $ID > 0)
		{
			$arElement = static::GetElementFields($ID);
			if($arElement['ACTIVE']=='Y' && $arElement['DETAIL_PAGE_URL']==$arRedirect['OLD_URL'])
			{
				RedirectTable::delete($arRedirect['ID']);
				return false;
			}
		}
		elseif(strpos($arRedirect['ENTITY'], 'S')===0 && ($ID = (int)substr($arRedirect['ENTITY'], 1)) && $ID > 0)
		{
			$arSection = static::GetSectionFields($ID);
			if($arSection['ACTIVE']=='Y' && $arSection['SECTION_PAGE_URL']==$arRedirect['OLD_URL'])
			{
				RedirectTable::delete($arRedirect['ID']);
				return false;
			}
		}
		return true;
	}
	
	public static function AllowRedirectForIblock($IBLOCK_ID)
	{
		if(!\Bitrix\Main\Loader::includeModule('catalog')) return true;
		$arCatalogIblock = \Bitrix\Catalog\CatalogIblockTable::getList(array('filter'=>array('IBLOCK_ID'=>$IBLOCK_ID)))->Fetch();
		if($arCatalogIblock['PRODUCT_IBLOCK_ID'] > 0) return false;
		return true;
	}
}