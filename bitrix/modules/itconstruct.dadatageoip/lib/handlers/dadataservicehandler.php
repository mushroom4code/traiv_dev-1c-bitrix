<?php

namespace Itconstruct\DadataGeoIP\Handlers;

use Bitrix\Main\Application;
use Bitrix\Main\EventResult;
use Itconstruct\DadataGeoIP\Services\Dadata\GeoIpService;

class DadataServiceHandler
{
   public static function addHandler()
    {
        $application = Application::getInstance();
		$delimeter = '/bitrix/modules/itconstruct.dadatageoip';
		$split = explode(
			$delimeter, 
			(new \ReflectionClass(GeoIpService::class))->getFileName()
		);
        return new EventResult(
            EventResult::SUCCESS,
            [
                GeoIpService::class => implode(
					'', 
					[
						$delimeter, 
						$split[1]
					]
				)
            ]
        );
    }
}