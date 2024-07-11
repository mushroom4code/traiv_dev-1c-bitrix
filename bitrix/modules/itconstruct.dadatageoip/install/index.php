<?php

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\EventManager;

Loc::loadMessages(__FILE__);

class itconstruct_dadatageoip extends CModule
{
    public $MODULE_ID = 'itconstruct.dadatageoip';
    public $EXT_MODULE_ID = 'itconstruct.dadatageoip';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
	private $documentRoot;
	
    function __construct()
    {
        $arModuleVersion = [];
        include(dirname(__FILE__) . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = Loc::getMessage('ITC_DADATA_GEOIP_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('ITC_DADATA_GEOIP_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('ITC_DADATA_GEOIP_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = 'https://itconstruct.ru/';
		$this->documentRoot = Application::getDocumentRoot();
    }
	
    function DoInstall()
    {
        global $APPLICATION, $step;
        if ($this->checkDependencies() !== true) {
            $APPLICATION->IncludeAdminFile(
                Loc::getMessage('ITC_DADATA_GEOIP_INSTALL_ERROR_TITLE'),
                __DIR__ . '/error.php'
            );
            return;
        }
		RegisterModule($this->MODULE_ID);
		$eventManager = EventManager::getInstance();
		$eventManager->registerEventHandler(
			'main', 
			'OnPageStart', 
			$this->MODULE_ID
		);
		$eventManager->registerEventHandler(
			'main',
			'onMainGeoIpHandlersBuildList',
			$this->MODULE_ID,
			'Itconstruct\\DadataGeoIP\\Handlers\\DadataServiceHandler',
			'addHandler'
		);
    }
	
    function DoUninstall()
    {
		$eventManager = EventManager::getInstance();
        UnRegisterModule($this->MODULE_ID);
		$eventManager->unRegisterEventHandler(
			'main', 
			'onMainGeoIpHandlersBuildList', 
			$this->MODULE_ID,
			'Itconstruct\\DadataGeoIP\\Handlers\\DadataServiceHandler',
			'addHandler'
		);
		$eventManager->unRegisterEventHandler(
			'main', 
			'OnPageStart', 
			$this->MODULE_ID
		);
    }

    function checkDependencies()
    {
        if (
            phpversion() < '7.1'
            || version_compare(SM_VERSION, '17.0.0') < 0
        ) {
            $GLOBALS['ITC_DADATA_GEOIP_INSTALL_ERROR'][] = Loc::getMessage('ITC_DADATA_GEOIP_VERSION_INSTALL_ERROR');
            return false;
        }

        return true;
    }
}
