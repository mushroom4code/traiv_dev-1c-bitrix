<?php
namespace IX;

class Codamusicru {	
	public static function GetAuthParams()
	{
		return array(
			'login',
			'password',
		);
	}
	
	public static function GetDownloadPath(&$path, &$arParams, &$arHeaders, &$arCookies)
	{
		$authParams = $arParams['VARS'];
		if($authParams['login'] && $authParams['password'])
		{
			$ob = new \Bitrix\Main\Web\HttpClient(array('disableSslVerification'=>false, 'socketTimeout'=>20, 'streamTimeout'=>20));
			$res = $ob->get('https://codamusic.ru/Account/JwtPassword/'.$authParams['login'].'/'.$authParams['password']);
			if($ob->getStatus()==200)
			{
				$token = $res;
				$arHeaders['Authorization'] = 'Bearer '.$token;
			}
		}

		return true;
	}
}
?>