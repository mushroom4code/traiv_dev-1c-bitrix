<?php
/**
 * Copyright (c) 2017. Sergey Danilkin.
 */

/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10/26/2017
 * Time: 1:50 PM
 */

namespace Sotbit\Cabinet\Personal;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

class Buyers extends \SotbitCabinet
{
	protected static $isB2B = null;
	public function __construct()
	{
		if(is_null(self::$isB2B))
		{
			if(Loader::includeModule('sotbit.b2bshop'))
			{
				self::$isB2B = true;
			}
			else
			{
				self::$isB2B = false;
			}
		}
	}
	public function findBuyersForUser($idUser = 0)
	{
		$listBuyers = array();
		if(!\SotbitCabinet::getInstance()->isDemo() && $idUser > 0)
		{
			$filter = array("USER_ID" => $idUser);
			if(self::$isB2B)
			{
				$personTypes = unserialize(Option::get('sotbit.b2bshop','BUYER_PERSONAL_TYPE',''));
				if(!is_array($personTypes))
				{
					$personTypes = array();
				}
				$filter['PERSON_TYPE_ID'] = $personTypes;
			}
			$rsBuyers = \CSaleOrderUserProps::GetList(
					array(),
					$filter
					);
			while ($buyer = $rsBuyers->fetch())
			{
				$listBuyers[$buyer['ID']] = new Buyer($buyer);
			}
			if(self::$isB2B && count($listBuyers) > 0)
			{
				$db_propVals = \CSaleOrderUserPropsValue::GetList(
						array("ID" => "ASC"),
						array(
								"USER_PROPS_ID"=>array_keys($listBuyers),
								'CODE' => 'COMPANY'
						)
						);
				while ($arPropVals = $db_propVals->Fetch())
				{
					if($arPropVals['VALUE'])
					{
						$listBuyers[$arPropVals['USER_PROPS_ID']]->setOrg($arPropVals['VALUE']);
					}
				}
			}
		}
		return $listBuyers;
	}
}