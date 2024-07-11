<?php

namespace Itconstruct\DadataGeoIP\Services\Dadata;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Error;
use Bitrix\Main\Service\GeoIp\Base;
use Bitrix\Main\Service\GeoIp\Data;
use Bitrix\Main\Service\GeoIp\Result;
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Service\GeoIp\ProvidingData;

class GeoIpService extends Base
{
	const BASE_URL = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/";
	
	private $cacheAbort = false;
	
    public function getTitle()
    {
        return Loc::getMessage('ITC_DADATA_GEOIP_SERVICE_TITLE');
    }

    public function getDescription()
    {
        return Loc::getMessage('ITC_DADATA_GEOIP_SERVICE_DESCRIPTION');
    }

    public function getSupportedLanguages()
    {
        return ['ru'];
    }
	
	public function createConfigField(array $postFields)
	{
		return [
			'DADATA_TOKEN' => isset($postFields['DADATA_TOKEN']) ? $postFields['DADATA_TOKEN'] : ''
		];
	}
	
	public function getConfigForAdmin()
    {
        return [
			[
				'NAME' => 'DADATA_TOKEN',
				'TITLE' => Loc::getMessage('ITC_DADATA_GEOIP_SERVICE_DADATA_TOKEN'),
				'TYPE' => 'TEXT',
				'VALUE' => htmlspecialcharsbx($this->config['DADATA_TOKEN'])
			]
		];
    }
	
	private function setCacheAbort()
	{
		$this->cacheAbort = true;
	}
	
    public function getDataResult($ip, $lang = '')
    {
        if ($this->isBot()) {
            return $this->getBotResult($ip, $lang);
        }
        $cache = Cache::createInstance();
        if (
			$cache->initCache(
				360000000,
				md5($ip),
				'/itconstruct/dadata/geoip/'
			)
        ) {
            $result = $cache->getVars();
        } elseif ($cache->startDataCache()) {
            $result = $this->sendRequest($ip, $lang);
			if ($this->cacheAbort) {
				$cache->abortDataCache();
			}
            $cache->endDataCache(
                $result
            );
        }
        return $result;
    }

    private function isBot()
    {
        $request = Application::getInstance()->getContext()->getRequest();
        return preg_match(
            '~(Google|Yahoo|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl)~i',
            $request->getUserAgent()
        );
    }

    private function getBotResult($ip, $lang = '')
    {
        $result = new Result;
        $geoData = new Data();
        $geoData->ip = $ip;
        $geoData->lang = $lang = strlen($lang) > 0 ? $lang : 'en';
        $result->setGeoData($geoData);
        return $result;
    }
	
	private function getHttpClient()
	{
		return new HttpClient(
			[
				'version' => '1.1',
				'socketTimeout' => 5,
				'streamTimeout' => 5,
				'redirect' => true,
				'redirectMax' => 5,
			]
		);
	}
	
	public function getProvidingData()
	{
		$result = new ProvidingData();
		$result->countryName = true;
		$result->countryCode = true;
		$result->regionName = true;
		$result->regionCode = true;
		$result->cityName = true;
		$result->latitude = true;
		$result->longitude = true;
		$result->timezone = true;
		return $result;
	}
	
    private function sendRequest($ip, $lang = '')
    {
		$result = new Result;
        $client = $this->getHttpClient();
		$client->setHeader('Accept', 'application/json');
		$client->setHeader('Authorization', 'Token ' . $this->config['DADATA_TOKEN']);
		$httpRes = $client->get(
			self::BASE_URL . 'iplocate/address?ip=' . $ip
		);
		$status = $client->getStatus();
		if ($status != 200) {
			$this->setCacheAbort();
			$result->addError(new Error('Dadata service http status: ' . $status));
			return $result;
		}
		$response = json_decode($httpRes, true);
		if ($response['reason'] == 'Forbidden') {
			$this->setCacheAbort();
			$result->addError(new Error('Dadata service forbidden - check token'));
			return $result;
		}
		$errors = $client->getError();
		if (!$httpRes && !empty($errors)) {
			$strError = '';
			foreach($errors as $errorCode => $errMes) {
				$strError .= $errorCode.': '.$errMes;
			}
			$result->addError(new Error($strError));
			return $result;
		}
        $geoData = new Data();
        $geoData->ip = $ip;
        $geoData->lang = $lang = strlen($lang) > 0 ? $lang : 'en';
		$data = $response['location']['data'];
		$geoData->countryName = $data['country'];
		$geoData->countryCode = $data['country_iso_code'];
		$geoData->regionName = $data['region_with_type'];
		$geoData->regionCode = $data['region_iso_code'];
		$geoData->cityName = $data['city'];
		$geoData->latitude = $data['geo_lat'];
		$geoData->longitude = $data['geo_lon'];
		$geoData->timezone = $data['timezone'];
		$result->setGeoData($geoData);
        return $result;
    }
}