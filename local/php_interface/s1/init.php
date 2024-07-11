<?php
/**
 * Created by PhpStorm.
 * User: Евгений Семашко
 * Date: 26.09.2016
 * Time: 16:55
 */

use Bitrix\Main\EventManager;

/*
AddEventHandler("main", "OnBeforeUserLogin", Array("CUserEx", "OnBeforeUserLogin"));
AddEventHandler("main", "OnBeforeUserRegister", Array("CUserEx", "OnBeforeUserRegister"));
AddEventHandler("main", "OnBeforeUserUpdate", Array("CUserEx", "OnBeforeUserRegister"));

$handler=EventManager::getInstance()->addEventHandler("main", "OnAfterUserLogin", array("CUserEx", "OnAfterUserLogin",));


$handler=EventManager::getInstance()->addEventHandler("main", "OnBeforeUserLogout", array("CUserEx", "OnBeforeUserLogout",));

class CUserEx
{

	function OnAfterUserLogin(&$arFields)
	{
		$GLOBALS["just_auth"]=true;
	}

	function OnBeforeUserLogout(&$arFields)
	{
		$GLOBALS["just_auth"]=false;
	}


	function OnBeforeUserLogin(&$arFields)
	{
		/*$filter = Array("=LOGIN" => $arFields["LOGIN"]);
		$rsUsers = CUser::GetList(($by = "LAST_NAME"), ($order = ""), $filter);
		if ($user = $rsUsers->GetNext()) {
			$arFields["LOGIN"] = $user["LOGIN"];
		}*/
		/*else $arFields["LOGIN"] = "";*/

/*
	}

	function OnBeforeUserRegister(&$arFields)
	{
		$arFields["EMAIL"]=$arFields["LOGIN"];
		global $APPLICATION;

		if (isset($_REQUEST["antibot"]) && !empty($_REQUEST["antibot"])){
			$APPLICATION->ThrowException('Ошибка регистрации.');
        }
	}
}
*/