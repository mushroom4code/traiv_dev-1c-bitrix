<?php
namespace IX;

class Internetpartnerrusklimatcom {
	static $arProperties = null;
	
	public static function GetAuthParams()
	{
		return array(
			'partnerId',
			//'token',
			'login',
			'password',
		);
	}
	
	public static function GetDownloadPath(&$path, &$arParams, &$arHeaders, &$arCookies)
	{
		$authParams = $arParams['VARS'];
		//$arHeaders['Authorization'] = 'Braer '.$authParams['token'];
		$path = \Bitrix\EsolImportxml\Utils::PathReplaceApiPages($path);
		if(function_exists('json_decode'))
		{
			$ob = new \Bitrix\Main\Web\HttpClient(array('disableSslVerification'=>false, 'socketTimeout'=>20, 'streamTimeout'=>20));
			$ob->setHeader('User-Agent', 'catalog-ip');
			$ob->setHeader('Content-type', 'applicataion/json');
			$res = $ob->post('https://b2b.rusklimat.com/api/v1/auth/jwt/', '{"login":"'.$authParams['login'].'","password":"'.$authParams['password'].'"}');
			$arRes = json_decode($res, true);
			if(isset($arRes['data']['jwtToken']))
			{
				$authParams['token'] = $arRes['data']['jwtToken'];
				$arHeaders['Authorization'] = 'Braer '.$authParams['token'];
			}
			
			$path = str_replace('{requestKey}', 'requestKey', $path);
			$path = str_replace('{partnerId}', 'partnerId', $path);
			$path = str_replace('partnerId', $authParams['partnerId'], $path);
			if(strpos($path, 'requestKey')!==false && $authParams['token'] && $authParams['partnerId'])
			{
				$ob = new \Bitrix\Main\Web\HttpClient(array('disableSslVerification'=>false, 'socketTimeout'=>20, 'streamTimeout'=>20));
				$ob->setHeader('Authorization', $arHeaders['Authorization']);
				$res = $ob->get('https://internet-partner.rusklimat.com/api/v1/InternetPartner/'.$authParams['partnerId'].'/requestKey');
				$arRes = json_decode($res, true);
				$path = str_replace('requestKey', $arRes['requestKey'], $path);
			}
		}

		return true;
	}
	
	public static function GetDownloadFile($arParams, $maxTime=20)
	{
		if(strpos($arParams['FILELINK'], '/products/')!==false)
		{
			if($maxTime <= 1) $maxTime = 20;
			if(!isset(self::$arProperties))
			{
				self::$arProperties = array();
				if(function_exists('json_decode'))
				{
					$arHeaders = $arCookies = array();
					$path = 'https://internet-partner.rusklimat.com/api/v1/InternetPartner/properties/{requestKey}';
					self::GetDownloadPath($path, $arParams, $arHeaders, $arCookies);
					$ob = new \Bitrix\Main\Web\HttpClient(array('disableSslVerification'=>false, 'socketTimeout'=>$maxTime, 'streamTimeout'=>$maxTime));
					if($arHeaders['Authorization']) $ob->setHeader('Authorization', $arHeaders['Authorization']);
					$ob->setHeader('Content-type', 'application/json');
					$res = $ob->get($path);
					$arRes = json_decode($res, true);
					if(isset($arRes['data']) && is_array($arRes['data']))
					{
						foreach($arRes['data'] as $prop)
						{
							if(isset($prop['id']) && isset($prop['name']))
							{
								//self::$arProperties[$prop['id']] = str_replace('"', '', $prop['name']);
								$pid = $prop['id'];
								if(preg_match('/^[\d\-]/', $pid)) $pid = 'd'.$pid;
								self::$arProperties['<'.$pid.'>'] = '<property name="'.str_replace('"', '', $prop['name']).'">';
								self::$arProperties['</'.$pid.'>'] = '</property>';
							}
						}
					}
				}
			}
			
			$arHeaders = $arCookies = array();
			$path = $arParams['FILELINK'];
			self::GetDownloadPath($path, $arParams, $arHeaders, $arCookies);
		
			$ob = new \Bitrix\Main\Web\HttpClient(array('disableSslVerification'=>false, 'socketTimeout'=>$maxTime, 'streamTimeout'=>$maxTime));
			if($arHeaders['Authorization']) $ob->setHeader('Authorization', $arHeaders['Authorization']);
			$ob->setHeader('Content-type', 'application/json');
			$fContent = $ob->post($path, '{}');
			
			/*foreach(self::$arProperties as $pid=>$pname)
			{
				$fContent = preg_replace('/"'.preg_quote($pid, '/').'"\s*:\s*(".*(?<!\\\\)")/Us', '{"property":{"name":"'.$pname.'","value":$1}}', $fContent);
			}*/
			
			$tmpPath = \CFile::GetTempName('', 'products.json');
			$dir = \Bitrix\Main\IO\Path::getDirectory($tmpPath);
			\Bitrix\Main\IO\Directory::createDirectory($dir);
			file_put_contents($tmpPath, $fContent);
			$arFile = \CFile::MakeFileArray($tmpPath);
			\Bitrix\EsolImportxml\Utils::CheckJsonFile($arFile);
			if(isset($arFile['tmp_name']) && file_exists($arFile['tmp_name']))
			{
				file_put_contents($arFile['tmp_name'], strtr(file_get_contents($arFile['tmp_name']), self::$arProperties));
				$arFile['size'] = filesize($arFile['tmp_name']);
			}
			return $arFile;
		}
		
		return false;
	}
}
?>