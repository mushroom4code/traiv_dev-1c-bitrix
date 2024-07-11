<?
IncludeModuleLangFile(__FILE__);
Class newit_abandonedcarts extends CModule
{

    var $MODULE_ID = "newit.abandonedcarts";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "N";

    function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__) . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = GetMessage("newit.MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("newit.MODULE_DESC");
        $this->PARTNER_NAME = GetMessage("newit.PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("newit.PARTNER_URI");
    }

    function InstallDB($arParams = array())
    {
        CModule::IncludeModule("iblock");

        //создаем тип инфоблока
        global $DB, $APPLICATION, $step;
        $arFields = Array(
            'ID' => 'newit_abandonedcarts',
            'SECTIONS' => 'N',
            'IN_RSS' => 'N',
            'SORT' => 100,
            'LANG' => Array(
                'ru' => Array(
                    'NAME' => GetMessage("newit.IBLOCK_TYPE_NAME"),
                ),
            )
        );

        $obBlocktype = new CIBlockType;
        $DB->StartTransaction();
        $res = $obBlocktype->Add($arFields);
        if (!$res) {
            $DB->Rollback();
            echo 'Error: ' . $obBlocktype->LAST_ERROR . '<br>';
        } else
            $DB->Commit();

        //Создаем инфоблок
        $ib = new CIBlock;
        $arFields = Array(
            "ACTIVE" => "Y",
            "NAME" => GetMessage("newit.IBLOCK_NAME"),
            "CODE" => "newit_abandonedcarts",
            "IBLOCK_TYPE_ID" => "newit_abandonedcarts",
            "SITE_ID" => "s1",
            "GROUP_ID" => Array("2" => "R")
        );
        $ID = $ib->Add($arFields);

        $arFields = Array(
            "NAME" => GetMessage("newit.PROP1"),
            "ACTIVE" => "Y",
            "SORT" => "100",
            "CODE" => "DATA",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $ID
        );
        $ibp = new CIBlockProperty;
        $PropID = $ibp->Add($arFields);


        $arFields = Array(
            "NAME" => GetMessage("newit.PROP2"),
            "ACTIVE" => "Y",
            "SORT" => "100",
            "CODE" => "MAIL_COUNT",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $ID
        );
        $PropID = $ibp->Add($arFields);


        $arFields = Array(
            "ACTIVE" => "Y",
            "NAME" => GetMessage("newit.IBLOCK2_NAME"),
            "CODE" => "newit_abandonedcarts_statistics",
            "IBLOCK_TYPE_ID" => "newit_abandonedcarts",
            "SITE_ID" => "s1",
            "GROUP_ID" => Array("2" => "R")
        );
        $ID = $ib->Add($arFields);

        $arFields = Array(
            "NAME" => GetMessage("newit.PROP3"),
            "ACTIVE" => "Y",
            "SORT" => "100",
            "CODE" => "LINK_FOLLOW",
            "PROPERTY_TYPE" => "S",
            "IBLOCK_ID" => $ID
        );
        $ibp = new CIBlockProperty;
        $PropID = $ibp->Add($arFields);


        return true;
    }


    function UninstallDB($arParams = array())
    {
        CModule::IncludeModule("iblock");
        global $DB, $APPLICATION, $step;
        $DB->StartTransaction();
        if (!CIBlockType::Delete('newit_abandonedcarts')) {
            $DB->Rollback();
            echo 'Delete error!';
        }
        $DB->Commit();

        return true;
    }


    function InstallMailType()
    {
        function UET($EVENT_NAME, $NAME, $LID, $DESCRIPTION)
        {
            $et = new CEventType;
            $et->Add(array(
                "LID" => $LID,
                "EVENT_NAME" => $EVENT_NAME,
                "NAME" => $NAME,
                "DESCRIPTION" => $DESCRIPTION
            ));
        }

        UET(
            "NEWIT_ABANDONBASKET_ALERT", GetMessage("newit.MAIL_TYPE_NAME"), "ru",
            GetMessage("newit.MAIL_FILEDS")
        );


        $arr["ACTIVE"] = "Y";
        $arr["EVENT_NAME"] = "NEWIT_ABANDONBASKET_ALERT";
        $arr["LID"] = "s1";
        $arr["EMAIL_FROM"] = "#DEFAULT_EMAIL_FROM#";
        $arr["EMAIL_TO"] = "#EMAIL#";
        $arr["BCC"] = "#BCC#";
        $arr["SUBJECT"] = GetMessage("newit.MAIL_SUBJECT");
        $arr["BODY_TYPE"] = "html";
        $arr["MESSAGE"] = GetMessage("newit.MAIL_MESSAGE");

        $emess = new CEventMessage;
        $emess->Add($arr);
        $_SESSION["mail_alert"] = $emess->LAST_ERROR;
    }

    function  UnInstallMailType()
    {
        $et = new CEventType;
        $et->Delete("NEWIT_ABANDONBASKET_ALERT");
    }

    function InstallEvents()
    {
        RegisterModuleDependences("sale", "OnOrderSave", $this->MODULE_ID, "CAbandon", "deleteOrderedElem");
        RegisterModuleDependences("main", "OnBeforeProlog", $this->MODULE_ID, "CAbandon", "defineVariables");
        RegisterModuleDependences("main", "OnBeforeProlog", $this->MODULE_ID, "CAbandon", "catchLinkFollow");

        return true;
    }

    function UnInstallEvents()
    {
        UnRegisterModuleDependences("main", "OnBeforeProlog", $this->MODULE_ID, "CAbandon", "defineVariables");
        UnRegisterModuleDependences("main", "OnBeforeProlog", $this->MODULE_ID, "CAbandon", "catchLinkFollow");
        UnRegisterModuleDependences("sale", "OnOrderSave", $this->MODULE_ID, "CAbandon", "deleteOrderedElem");


        $ob = new CUserTypeEntity();


        $rsData = CUserTypeEntity::GetList(array(), array("FIELD_NAME" => "UF_NEWIT_ABANDON"));
        while ($arRes = $rsData->Fetch()) {
            $ob->Delete($arRes["ID"]);
        }


        return true;
    }


    function InstallFiles()
    {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/" . $this->MODULE_ID . "/install/js/",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/js/" . $this->MODULE_ID,
            true,
            true
        );
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/" . $this->MODULE_ID . "/install/services/",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/services/" . $this->MODULE_ID,
            true,
            true
        );

        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"] . "/bitrix/js/" . $this->MODULE_ID);
        DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"] . "/bitrix/services/" . $this->MODULE_ID);

        return true;
    }


    function DoInstall()
    {
        $this->InstallEvents();
        $this->InstallDB();
        $this->InstallFiles();
        $this->InstallMailType();
        RegisterModule($this->MODULE_ID);
    }

    function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        $this->UninstallDB();
        $this->UnInstallMailType();
        UnRegisterModule($this->MODULE_ID);
    }
}