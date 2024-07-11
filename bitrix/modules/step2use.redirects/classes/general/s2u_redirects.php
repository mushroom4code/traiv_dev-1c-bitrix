<?php

class S2uRedirects {

    const MODULE_ID = 'step2use.redirects';

    static public function addSlash($url) {
        $arrUrl = array();
        $arrUrl = parse_url($url);
        if(!empty($arrUrl["path"])) {
            $arrUrl["path"] = strtolower($arrUrl["path"]);
        }
        if (substr($arrUrl["path"], -4) != ".php" &&
                substr($arrUrl["path"], -5) != ".html" &&
                substr($arrUrl["path"], -4) != ".png" &&
                substr($arrUrl["path"], -4) != ".jpg" &&
                substr($arrUrl["path"], -5) != ".jpeg" &&
                substr($arrUrl["path"], -4) != ".gif" &&
                substr($arrUrl["path"], -5) != ".webp" &&
                substr($arrUrl["path"], -1) != "/")
            $arrUrl["path"] .= "/";
        if (array_key_exists("scheme", $arrUrl))
            $newUrl .= $arrUrl["scheme"] . "://";
        if (array_key_exists("host", $arrUrl))
            $newUrl .= $arrUrl["host"];
        if (array_key_exists("path", $arrUrl))
            $newUrl .= $arrUrl["path"];
        if (array_key_exists("query", $arrUrl))
            $newUrl .= "?" . $arrUrl["query"];
        return $newUrl;
    }
    
    public static function fixDoubleSlashes($url) {
        $urlParsed = parse_url($url);
        //var_dump($urlParsed);
        $newUrl = $url;
        if (isset($urlParsed['path'])) {
            //$newUrl = str_replace('//', '/', $urlParsed['path']);
            $newUrl = preg_replace('/(\/+)/', '/', $urlParsed['path']);
            if (isset($urlParsed['host'])) {
                $newUrl = $urlParsed['host'].$newUrl;
            }
            if (isset($urlParsed['scheme'])) {
                $newUrl = $urlParsed['scheme'].'://'.$newUrl;
            }
            if (isset($urlParsed['query'])) {
                $newUrl .= '?'.$urlParsed['query'];
            }
        }
        else {
            //$newUrl = str_replace('//', '/', $url);
            $newUrl = preg_replace('/(\/+)/', '/', $url);
        }
        
        return $newUrl;
    }

    static public function delIndex($url) {
        $arrUrl = array();
        $arrUrl = parse_url($url);
        if (substr($arrUrl["path"], -9) == "index.php")
            $arrUrl["path"] = substr($arrUrl["path"], 0, -9);
        if (substr($arrUrl["path"], -10) == "index.html")
            $arrUrl["path"] = substr($arrUrl["path"], 0, -10);

        if (array_key_exists("scheme", $arrUrl))
            $newUrl .= $arrUrl["scheme"] . "://";
        if (array_key_exists("host", $arrUrl))
            $newUrl .= $arrUrl["host"];
        if (array_key_exists("path", $arrUrl))
            $newUrl .= $arrUrl["path"];
        if (array_key_exists("query", $arrUrl))
            $newUrl .= "?" . $arrUrl["query"];
        return $newUrl;
    }

    static public function toLower($url) {
        $urlParsed = parse_url($url);
        foreach ($urlParsed as $key => $val) {
            // get-��������� � ������ �� ��������� � ������ �������
            if (in_array($key, array('query', 'fragment'))) {
                continue;
            }
            $urlParsed[$key] = ToLower($val);
        }
        return self::unparseUrl($urlParsed);
    }
    
    public static function unparseUrl($parsed_url) {
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }

    public static function protocolAndWwwFix($url) {
        $wwwRedirect = COption::GetOptionString(self::MODULE_ID, 'www_redirect_' . SITE_ID);
        $httpsRedirect = COption::GetOptionString(self::MODULE_ID, 'https_redirect_' . SITE_ID);
        
        if (!$wwwRedirect && !$httpsRedirect) {
            return $url;
        }
        
        $urlParsed = parse_url($url);
        
        if ($httpsRedirect && !empty($urlParsed['scheme']) && $urlParsed['scheme']!=$httpsRedirect) {
            $urlParsed['scheme'] = $httpsRedirect;
        }
        
        if ($wwwRedirect && !empty($urlParsed['host'])) {
            // ��������� WWW ������ ��� ������� 2�� ������
            // site.ru - ���������
            // asdasd.site.ru - �� ���������
            // www.site.ru - �� ���������
            if ($wwwRedirect=='www' && substr_count($urlParsed['host'], '.')==1) {
                $urlParsed['host'] = 'www.'.$urlParsed['host'];
            }
            if ($wwwRedirect=='no-www' && substr($urlParsed['host'], 0, 4)=='www.') {
                $explodedHost = explode(".", $urlParsed['host']);
                array_shift($explodedHost);
                $urlParsed['host'] = implode(".", $explodedHost);
            }
        }
        
        return self::unparseUrl($urlParsed);
    }

    static public function mainMirror($url, $main_mirror) {
        $arrUrl = array();
        $arrUrl = parse_url($url);
        
        $arrNewUrl = parse_url($main_mirror);
        if ($arrNewUrl["scheme"] != $arrUrl["scheme"] || $arrNewUrl["host"] != $arrUrl["host"]) {
            $url = $arrNewUrl["scheme"] . "://" . $arrNewUrl["host"] . $arrUrl["path"];
            if (array_key_exists("query", $arrUrl))
                $url .= "?" . $arrUrl["query"];
        }
        return $url;
    }

    static public function curPageURL() {
        global $APPLICATION;
        $CURRENT_PAGE = (CMain::IsHTTPS()) ? "https://" : "http://";
        $host = explode(":", $_SERVER["HTTP_HOST"]); // �� ������, ���� � Host ���������� ��� � ���� (����� ���� ���� � ������� ���-���������)
        $CURRENT_PAGE .= $host[0]; //$_SERVER["SERVER_NAME"];
        $CURRENT_PAGE .= self::getRequestUrl(); //$APPLICATION->GetCurUri();
        return $CURRENT_PAGE;
    }

    static public function handlerOnBeforeProlog() {

        $isAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || $_SERVER['HTTP_BX_AJAX'];
        if (!defined('ADMIN_SECTION') && PHP_SAPI != "cli" && PHP_SAPI != "cli-server" && !$isAjax && CModule::IncludeModuleEx(self::MODULE_ID) != MODULE_DEMO_EXPIRED) {
            global $APPLICATION;

            $redirectIsActive = COption::GetOptionString(self::MODULE_ID, 'REDIRECTS_IS_ACTIVE', 'Y');
            if (COption::GetOptionString(self::MODULE_ID, 'REDIRECTS_IS_ACTIVE_'.SITE_ID, 'Y')=='N') {
                $redirectIsActive = 'N';
            }
            
            $IncludeJQuery = COption::GetOptionString(self::MODULE_ID, 'INCLUDE_JQUERY', 'N');

            $compositeIsActive = COption::GetOptionString(self::MODULE_ID, 'COMPOSITE_ACTIVE', 'N');

            if ($IncludeJQuery == 'Y') {
                CJSCore::Init(array("jquery2"));
            }

            if (($compositeIsActive == 'Y') && ($redirectIsActive == 'Y')) {

                $APPLICATION->AddHeadScript("/bitrix/tools/step2use.redirects/js/comp_js.js");
            }
            if ($redirectIsActive == 'Y') {
                $redirect = S2uRedirectsRulesDB::FindRedirect(self::getRequestUrl(), SITE_ID, false);

                if (!$redirect) {
                    $redirect = S2uRedirectsRulesDB::FindRedirect(self::getRequestUrl(), SITE_ID, true);
                }
            }
            $_404IsActive = COption::GetOptionString(self::MODULE_ID, '404_IS_ACTIVE', 'Y');

            $main_mirror = COption::GetOptionString(self::MODULE_ID, 'main_mirror_' . SITE_ID);
            $slash_redirect = COption::GetOptionString(self::MODULE_ID, 'slash_add_' . SITE_ID);
            $delIndex = COption::GetOptionString(self::MODULE_ID, 'REDIR_WITHOUT_INDEX_' . SITE_ID);
            $toLower = COption::GetOptionString(self::MODULE_ID, 'REDIR_TO_LOWER_' . SITE_ID);
            $doubleSlashesFix = COption::GetOptionString(self::MODULE_ID, 'double_slashes_fix_' . SITE_ID);

            if ($redirect) {
                if ($redirect['STATUS'] == "410") {
                    header("HTTP/1.0 410 Gone");
                } else {
                    $newUrl = $redirect['NEW_LINK'];
                    $oldUrl = $redirect['OLD_LINK'];
                    // ���� �������� ��������� �� ������� URL, �� �� ��������� ��������� �������� �������, ���������� ����� � �.�. - ������ ���������� �� ��������� URL
                    if(substr($newUrl, 0, 7)!='http://' && substr($newUrl, 0, 8)!='https://') {
                        $newUrl = self::protocolAndWwwFix($newUrl);
                        
                        if ($main_mirror != "") {
                            $newUrl = self::mainMirror($newUrl, $main_mirror);
                        }
                        if ($delIndex == "Y") {
                            $newUrl = self::delIndex($newUrl);
                        }
                        if ($toLower == "Y") {
                            $newUrl = self::toLower($newUrl);
                        }
                        if ($slash_redirect == "Y") {
                            $newUrl = self::addSlash($newUrl);
                        }
                        if ($doubleSlashesFix == "Y") {
                            $newUrl = self::fixDoubleSlashes($newUrl);
                        }
                    }
                    if ($oldUrl != $newUrl) {
                        if (self::checkLoopRedirect($oldUrl, $newUrl)) {
                            LocalRedirect($newUrl, false, $redirect['STATUS']);
                        }
                    }
                }
                return true;
            } else {
                $url = $oldUrl = self::curPageURL();
                $arrUrl = array();
                $arrUrl = parse_url($url);

                if (substr($arrUrl["path"], 0, 8) != "/bitrix/") {
                    $url = self::protocolAndWwwFix($url);
                    if ($main_mirror != "") {
                        //var_dump("MIRROR");exit;
                        $url = self::mainMirror($url, $main_mirror);
                    }
                    if ($delIndex == "Y") {
                        //var_dump("SLASH");
                        $url = self::delIndex($url);
                        //echo '<pre>';print_r($arrUrl);echo '<pre>';
                        /* var_dump($url);
                          echo '<br />';
                          var_dump($oldUrl);exit; */
                    }
					if ($toLower == "Y") {
						$url = self::toLower($url);
					}					
                    if ($slash_redirect == "Y") {
                        //var_dump("SLASH");
                        $url = self::addSlash($url);
                        //var_dump($url);
                        //var_dump($oldUrl);exit;
                    }
                    if ($doubleSlashesFix == "Y") {
                        $url = self::fixDoubleSlashes($url);
                    }
                    if ($url != $oldUrl) {
                        if (self::checkLoopRedirect($oldUrl, $url)) {
                            LocalRedirect($url, false, "301 Moved permanently");
                        }
                    }
                }
                
                self::clearLoopRedirectHistory();
            }

            //self::safeRedirectToLevelUp();
        }
    }
    
    
    
    public static function checkLoopRedirect($oldUrl, $newUrl) {
        
        if (!isset($_SESSION['s2u-redirects-history'])) {
            $_SESSION['s2u-redirects-history'] = array();
        }
        
        if (in_array($newUrl, $_SESSION['s2u-redirects-history'])) {
            self::clearLoopRedirectHistory();
            return false;
        }
        
        $log = '['.date("d.m.Y H:i:s").'] '.$newUrl."\n";
        //file_put_contents(__DIR__ . '/loop.log', $log, FILE_APPEND);
        
        $_SESSION['s2u-redirects-history'][] = $oldUrl;
        $_SESSION['s2u-redirects-history'][] = $newUrl;
        $_SESSION['s2u-redirects-history'] = array_unique($_SESSION['s2u-redirects-history']);
        
        //file_put_contents(__DIR__ . '/loop1.log', var_export($_SESSION['s2u-redirects-history'], true)."\n", FILE_APPEND);
        
        return true;
    }
    
    
    public static function clearLoopRedirectHistory() {
        if (!empty($_SESSION['s2u-redirects-history'])) {
            $_SESSION['s2u-redirects-history'] = array();
        }
    }
    
    

    static public function handlerOnEpilog() {
        global $APPLICATION;

        $_404IsActive = COption::GetOptionString(self::MODULE_ID, '404_IS_ACTIVE', 'Y');
        $repair_conflicts = COption::GetOptionString(self::MODULE_ID, 'REPAIR_CONFLICTS', 'N');

        $isAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || $_SERVER['HTTP_BX_AJAX'];

        // 404 Not Found
        if ($_404IsActive == 'Y' && !$isAjax) {
            // remember if current url not in ignore list
            $isIgnore = S2uRedirects404IgnoreDB::GetList(array(
                        'SITE_ID' => SITE_ID,
                        'ACTIVE' => 'Y',
                        'OLD_LINK' => $APPLICATION->GetCurUri("", false)
            ));


            $isIgnore = (bool) count($isIgnore);
            if ((defined('ERROR_404') && ERROR_404 == 'Y') && !defined('ADMIN_SECTION') && !$isIgnore) {
                // try to get guest from statistic module
                $guestID = 0;
                if (CModule::IncludeModule('statistic')) {
                    $guestID = $_SESSION["SESS_GUEST_ID"];
                }

                if (function_exists('http_response_code')) {
                    $httpCode = http_response_code();
                } else {
                    $headers = get_headers($_SERVER["SCRIPT_URI"] . "?" . $_SERVER["QUERY_STRING"]);
                    $httpCode = substr($headers[0], 9, 3);
                }

                $arrDbFields = array(
                    'URL' => $APPLICATION->GetCurUri("", false),
                    'REFERER_URL' => $_SERVER['HTTP_REFERER'],
                    'REDIRECT_STATUS' => $httpCode,
                    'DATE_TIME_CREATE' => ConvertTimeStamp(time(), 'FULL'),
                    'SITE_ID' => SITE_ID,
                    'GUEST_ID' => $guestID,
                );

                /* if ($repair_conflicts) {
                  S2uRedirectsRulesDB::RepairConflicts($arrDbFields);
                  } else {
                  S2uRedirects404DB::Add($arrDbFields);
                  } */
                S2uRedirects404DB::Add($arrDbFields);

                /*$rowsLimit = COption::GetOptionInt(self::MODULE_ID, '404_LIMIT', 0);
                if ($rowsLimit) {
                    $rowsCnt = S2uRedirects404DB::GetCount();
                    if ($rowsCnt > $rowsLimit)
                        S2uRedirects404DB::DeleteOldest();
                }*/
            }
        }

        self::safeRedirectToLevelUp();
    }


    /**
     *
     * ������� ��������� ������� ��
     * ������ ��� �������� ��������������
     *
     */
    static public function handlerOnBeforeIBlockSectionUpdate($arFields) {
        
        $isSectionMoving = false;
        //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arFields, true), FILE_APPEND);
        global $DB;
        //echo "<pre>"; print_r($arFields); echo "</pre>";
        //die();
        // ������ ID ����������, ��� ������� �������� �������� �������������� ����������
        $iblocksAutoredirect = explode(",", COption::GetOptionString(self::MODULE_ID, "autoredirects_iblocks", ""));
        if ($arFields["ID"] && /*$arFields["CODE"] &&*/ in_array($arFields["IBLOCK_ID"], $iblocksAutoredirect) && COption::GetOptionString("step2use.redirects", 'autoredirects_change_section_url') == "Y") {

            

            $repair_conflicts = COption::GetOptionString(self::MODULE_ID, 'REPAIR_CONFLICTS', 'N');
            $arIblock = CIBlock::GetArrayByID($arFields["IBLOCK_ID"]);
            $rsSites = CIBlock::GetSite($arFields["IBLOCK_ID"]);
            while ($arSite = $rsSites->Fetch()) {

                $siteID = $arSite["LID"];

                $rsSections = CIBlockSection::GetList(array(), array("ID" => $arFields["ID"]), false, array("SECTION_PAGE_URL", "IBLOCK_SECTION_ID"));
                $rsSections->SetUrlTemplates($arIblock["SECTION_PAGE_URL"]);
                $arSection = $rsSections->GetNext();
                $arIblock["SECTION_PAGE_URL_OLD"] = $arIblock["SECTION_PAGE_URL"];
                
                //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', "\nSECTION::::\n", FILE_APPEND);
                //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arSection, true), FILE_APPEND);
                
                // ��� ���� �������� ������� � ������ ������ (CODE �� ���������� � ���� ������)
                if(!isset($arFields["CODE"])) {
                    $isSectionMoving = true;
                    $arFields["CODE"] = $arSection["CODE"];
                    
                }
                elseif($arFields["IBLOCK_SECTION_ID"]!=$arSection["IBLOCK_SECTION_ID"]) {
                    $isSectionMoving = true;
                }


                if (($arSection && isset($arFields["CODE"]) && isset($arSection["CODE"]) && $arSection["CODE"] && $arFields["CODE"] != $arSection["CODE"])
                    || ($isSectionMoving)
                    ) {

                    // ���������� ����� URL �������
                    $arFieldsForUrlNew = $arFields;
                    $arFieldsForUrlNew["LID"] = $siteID;
                    $arFieldsForUrlNew["SITE_DIR"] = $arSite["DIR"];
                    $arFieldsForUrlNew['IBLOCK_CODE'] = $arIblock['CODE'];
                    //$arFieldsForUrlNew['IBLOCK_SECTION_ID'] = $arFields['ID'];
                    
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arFields, true), FILE_APPEND);
                    
                    
                    // ��������� ����� #SECTION_CODE_PATH#
                    if(strpos($arIblock["SECTION_PAGE_URL"], "#SECTION_CODE_PATH#") !== false) {
                        $sectionCodePath = '';
                        // ��� ������� �������
                        if($isSectionMoving) {
                            // ��������� � ������ ���������
                            if($arFieldsForUrlNew['IBLOCK_SECTION_ID']) {
                                $res = CIBlockSection::GetNavChain(0, $arFieldsForUrlNew['IBLOCK_SECTION_ID'], array("ID", "CODE"));
                                while($a = $res->Fetch()) {
                                    /*if($a['ID']==$arFieldsForUrlNew["ID"]) {
                                        $a["CODE"] = $arFieldsForUrlNew["CODE"];
                                    }*/
                                    $sectionCodePath .= urlencode($a["CODE"])."/";
                                }
                                $sectionCodePath .= urlencode($arFieldsForUrlNew["CODE"])."/";
                                $sectionCodePath = rtrim($sectionCodePath, "/");
                                //var_dump($sectionCodePath);exit;
                                $arIblock["SECTION_PAGE_URL"] = str_replace('#SECTION_CODE_PATH#', $sectionCodePath, $arIblock["SECTION_PAGE_URL"]);
                                
                                
                            }
                            // ��������� � ������ ���������
                            else {
                                $arIblock["SECTION_PAGE_URL"] = str_replace("#SECTION_CODE_PATH#", urlencode($arFieldsForUrlNew["CODE"]), $arIblock["SECTION_PAGE_URL"]);
                            }
                            $sectionCodePath .= urlencode($a["CODE"])."/";
                        }
                        // ��� ������� ��������� �������
                        else {
                            $res = CIBlockSection::GetNavChain(0, $arFieldsForUrlNew["ID"], array("ID", "CODE"));
                            while($a = $res->Fetch()) {
                                if($a['ID']==$arFieldsForUrlNew["ID"]) {
                                    $a["CODE"] = $arFieldsForUrlNew["CODE"];
                                }
                                $sectionCodePath .= urlencode($a["CODE"])."/";
                            }
                            $sectionCodePath = rtrim($sectionCodePath, "/");
                            //var_dump($sectionCodePath);exit;
                            $arIblock["SECTION_PAGE_URL"] = str_replace('#SECTION_CODE_PATH#', $sectionCodePath, $arIblock["SECTION_PAGE_URL"]);
                        }
                    }
                    
                    //$tmpID = $arFieldsForUrlNew['ID'];
                    //$arFieldsForUrlNew['ID'] = $arFieldsForUrlNew['IBLOCK_SECTION_ID'];
                    //$tmpIBLOCK_SECTION_ID = $arFieldsForUrlNew['IBLOCK_SECTION_ID'];
                    //unset($arFieldsForUrlNew['IBLOCK_SECTION_ID']);
                    
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', "\narFieldsForUrlNew:::\n", FILE_APPEND);
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arFieldsForUrlNew, true), FILE_APPEND);
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arIblock["SECTION_PAGE_URL"], true), FILE_APPEND);
                    $urlNew = self::ReplaceSectionUrl($arIblock["SECTION_PAGE_URL"], $arFieldsForUrlNew, $_SERVER["SERVER_NAME"], "S");
                    //$arFieldsForUrlNew['ID'] = $tmpID;
                    //$arFieldsForUrlNew['IBLOCK_SECTION_ID'] = $tmpIBLOCK_SECTION_ID;

                    /*if (strpos($urlNew, $arSection['CODE']) !== false) {
                        $urlNew = str_replace($arSection['CODE'], $arFieldsForUrlNew['CODE'], $urlNew);
                    }*/

                    $arFieldsForUrlOld = $arSection;
                    $arFieldsForUrlOld["LID"] = $siteID;
                    $arFieldsForUrlOld["SITE_DIR"] = $arSite["DIR"];
                    //$arFieldsForUrlOld['IBLOCK_SECTION_ID'] = $arSection['ID'];
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arFieldsForUrlNew, true), FILE_APPEND);
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arFieldsForUrlOld, true), FILE_APPEND);
                    
                    
                    $urlOld = self::ReplaceSectionUrl($arIblock["SECTION_PAGE_URL_OLD"], $arFieldsForUrlOld, $_SERVER["SERVER_NAME"], "S");
                    
                    
                    //var_dump($urlOld);exit;
                    
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($urlOld, true), FILE_APPEND);
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($urlNew, true), FILE_APPEND);

                    //var_dump($urlOld);var_dump($urlNew);exit;
                    //$pos = strrpos($urlOld, $arSection["CODE"]);
                    if ($urlOld != $urlNew) {
                        // ���������� �������� ���� ��� ��������� ����������� � �������������
                        IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/' . self::MODULE_ID . '/classes/general/s2u_redirects.php');

                        // ���� �������� (����� url)
                        //$NEW_LINK = substr_replace($urlOld, $arFields["CODE"], $pos, strlen($arSection["CODE"]));
                        // ������ ��������
                        //$OLD_LINK = '^'.$urlOld;
                        $COMMENT = GetMessage("S2U_MAIN_AUTO_SECTION", Array("#ID#" => $arFields["ID"], "#IBLOCK_ID#" => $arFields["IBLOCK_ID"]));

                        if ($urlNew[0] != '/') {
                            $urlNew = '/' . $urlNew;
                        }

                        if ($urlNew != '/' && $urlNew != '') {

                            $arrDbFields = array(
                                'OLD_LINK' => '^' . $urlOld,
                                'NEW_LINK' => trim($urlNew),
                                'DATE_TIME_CREATE' => ConvertTimeStamp(time(), 'FULL'),
                                'STATUS' => "301",
                                'ACTIVE' => "Y",
                                'COMMENT' => $COMMENT,
                                'SITE_ID' => $siteID,
                                'WITH_INCLUDES' => "N",
                                'USE_REGEXP' => "Y",
                            );


                            if ($repair_conflicts) {
                                $Res__ = S2uRedirectsRulesDB::RepairConflicts($arrDbFields, false, false);
                            } else {
                                $Res__ = S2uRedirectsRulesDB::Add($arrDbFields, false, false);
                            }
                        }
                    }
                }
            }
        }
        // ��� ���� �������� ������� � ������ ������ (CODE �� ���������� � ���� ������)
        /*elseif(isset($arFields['IBLOCK_SECTION_ID']) && $arFields["ID"] && !$arFields["CODE"] && in_array($arFields["IBLOCK_ID"], $iblocksAutoredirect) && COption::GetOptionString("step2use.redirects", 'autoredirects_change_section_url') == "Y") {
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/_redirects.txt', var_export($arFields, true), FILE_APPEND);
        }*/
    }

    // ����� � updater �������� �������� ������� ������� � ���������� ������
    //    static public function handlerOnBeforeIBlockhandlerOnBeforeIBlockElementUpdateentUpdate(&$arFields) {
    //    static public function handlerOnIBlockElementUpdate($arFieldsNew, $arFieldsOld) {
    /**
     *
     * ������� ��������� �������� ��
     * ������ ��� �������� ��������������
     *
     */
    static public function handlerOnBeforeIBlockElementUpdate($arFieldsNew) {
        global $DB;
        global $module_id;

        //mail("dmitrii.kozlov@traiv.ru","Test","\r\nВерсия PHP \r\nТестовое письмо!");

        $res = CIBlockElement::GetByID($arFieldsNew["ID"]);
        $arFieldsOld = $res->GetNext();

        // ������ ID ����������, ��� ������� �������� �������� �������������� ����������
        $iblocksAutoredirect = explode(",", COption::GetOptionString(self::MODULE_ID, "autoredirects_iblocks", ""));

        // ���������, ����� �� ��������� ������������� ��� �������� ���������
        // � ����� ��, ������������ �� ����� ��������� �������������� (��� ��������� url ��������, ��� ����������� ��������)
        if (in_array($arFieldsNew["IBLOCK_ID"], $iblocksAutoredirect) && (COption::GetOptionString(self::MODULE_ID, "autoredirects_change_detail_url", "N") == "Y" || COption::GetOptionString(self::MODULE_ID, "autoredirects_element_deactivate", "N") == "Y")) {

            // ���������� �������� ���� ��� ��������� ����������� � �������������
            IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/' . self::MODULE_ID . '/classes/general/s2u_redirects.php');

            $arIblock = CIBlock::GetArrayByID($arFieldsNew["IBLOCK_ID"]);
            // �������� ������ ������, ������� ��������� � ���������
            $arIblockSites = array();
            $rsSites = CIBlock::GetSite($arFieldsNew["IBLOCK_ID"]);
            while ($arSite = $rsSites->Fetch()) {
                $arIblockSites[$arSite["SITE_ID"]] = $arSite;
            }

            // ���������� �� ������� �����, ������������ � ���������, � ��� ������� ����� ��������� � ���������� �������������
            foreach ($arIblockSites as $siteID=>$arSite) {

                // �������� ������ ��� ������������ ������� URL ��������
                $arFieldsForUrlOld = $arFieldsOld;
                $arFieldsForUrlOld["LID"] = $siteID;
                $arFieldsForUrlOld["EXTERNAL_ID"] = $arFieldsForUrlOld["XML_ID"];

                // ��������� ������ ��������, ����������� � ������� ��������. ������-�� � ������� ������� arFields �� ���������� ��� �������, � ������ ������
                $arFieldsForUrlOld["IBLOCK_SECTION"] = array();
                $db_old_groups = CIBlockElement::GetElementGroups($arFieldsForUrlOld["ID"], true);
                while ($ar_group = $db_old_groups->Fetch()) {
                    $arFieldsForUrlOld["IBLOCK_SECTION"][] = $ar_group["ID"];
                }

                // �������� ����� URL ��������
                $arFieldsForUrlNew = $arFieldsNew;
                $arFieldsForUrlNew["LID"] = $siteID;
                $arFieldsForUrlNew["EXTERNAL_ID"] = $arFieldsForUrlNew["XML_ID"];
                $arFieldsForUrlNew['IBLOCK_CODE'] = $arIblock['CODE'];
	            
                // ���� ������������ ��������� �� ������ ��������� ��, �� IBLOCK_SECTION �� ����� - ����� ��� �� ��
                if (!isset($arFieldsForUrlNew["IBLOCK_SECTION"]) && !isset($arFieldsForUrlNew["IBLOCK_SECTION_ID"])) {
                    $arFieldsForUrlNew["IBLOCK_SECTION"] = $arFieldsForUrlOld["IBLOCK_SECTION"];
                }
                // ���� ������������ ��������� �� ������ ��������� ��, �� CODE �� ����� - ����� ��� �� ��
                if (!isset($arFieldsForUrlNew["CODE"])) {
                    $arFieldsForUrlNew["CODE"] = $arFieldsForUrlOld["CODE"];
                }
	            
	            // ���� ������� ����� �� ����� ���������
                if (!empty($arFieldsForUrlNew["IBLOCK_SECTION"])) {
	                // ������� ��� ������� ������, �.�. ��� ������� ������� ����� ���� ���������� ������ �� �������
	                foreach ( $arFieldsForUrlNew["IBLOCK_SECTION"] as $sectionID ) {
		                // ������� ������ ����� �������� � ����� ������ ��������
		                if ( in_array( $sectionID, $arFieldsForUrlOld["IBLOCK_SECTION"] ) ) {
			                $arFieldsForUrlNew["IBLOCK_SECTION_ID"] = $sectionID;
			                $arFieldsForUrlNew["SITE_DIR"] = $arSite['DIR'];
			                $urlNew = self::ReplaceDetailUrl( $arIblock["DETAIL_PAGE_URL"], $arFieldsForUrlNew, $_SERVER["SERVER_NAME"], "E" );
			
			                //var_dump($urlNew);exit;
			
			                $arFieldsForUrlOld["IBLOCK_SECTION_ID"] = $sectionID;
			                $arFieldsForUrlOld["SITE_DIR"] = $arSite['DIR'];
			                $urlOld = self::ReplaceDetailUrl( $arIblock["DETAIL_PAGE_URL"], $arFieldsForUrlOld, $_SERVER["SERVER_NAME"], "E" );
			
			                // ���� URL ���������, �� ������� ��������
			                if ( $urlNew && $urlOld && $urlNew != $urlOld && COption::GetOptionString( self::MODULE_ID, "autoredirects_change_detail_url", "N" ) == "Y" ) {
				
				                // ����������� �� ��������� ����������� ���������� ����������
				                $repair_conflicts = COption::GetOptionString( self::MODULE_ID, 'REPAIR_CONFLICTS', 'N' );
				
				                // ����������� �������������
				                $COMMENT = GetMessage( "S2U_MAIN_AUTO_ELEMENT", Array( "#ID#" => $arFieldsForUrlNew["ID"], "#IBLOCK_ID#" => $arFieldsNew["IBLOCK_ID"] ) );
				
				                if ( $urlNew[0] != '/' ) {
					                $urlNew = '/' . $urlNew;
				                }
				
				                if ( $urlNew != '/' && $urlNew != '' ) {
					                // ��� ����� �������� ����� ������
					                $arrRedirectDbFields = array(
						                'OLD_LINK'         => $urlOld,
						                'NEW_LINK'         => $urlNew,
						                'DATE_TIME_CREATE' => ConvertTimeStamp( time(), 'FULL' ),
						                'STATUS'           => "301",
						                'ACTIVE'           => "Y",
						                'COMMENT'          => $COMMENT,
						                'SITE_ID'          => $siteID,
						                'WITH_INCLUDES'    => "N",
						                'USE_REGEXP'       => "N",
					                );
					
					                if ( $repair_conflicts ) {
						                $Res__ = S2uRedirectsRulesDB::RepairConflicts( $arrRedirectDbFields, false, false );
					                } else {
						                $Res__ = S2uRedirectsRulesDB::Add( $arrRedirectDbFields, false, false );
					                }
				                }
			                }
			
			                //���� ������� ��������������, �� ������� �������� �� ������
			                if ( $arFieldsNew["ACTIVE"] == "N" && $arFieldsOld["ACTIVE"] == "Y" && COption::GetOptionString( self::MODULE_ID, "autoredirects_element_deactivate", "N" ) == "Y" ) {
				
				                $res = CIBlockSection::GetByID( $sectionID );
				                $res->SetUrlTemplates( $arIblock["SECTION_PAGE_URL"] );
				                if ( $arSectionFields = $res->GetNext() ) {
					
					                // ��� URL �������
					                //$urlSection = $arSectionFields["SECTION_PAGE_URL"];
					                //$arFieldsForUrlNew["IBLOCK_SECTION_ID"] = $sectionID;
					                $arSectionFields["LID"] = $siteID;
					                $arSectionFields["SITE_DIR"] = $arSite['DIR'];
//var_dump($arIblock["SECTION_PAGE_URL"]);exit;
					                $urlSection = self::ReplaceDetailUrl( $arIblock["SECTION_PAGE_URL"], $arSectionFields, $_SERVER["SERVER_NAME"], "S" );
					
					                // ����������� �������������
					                $COMMENT = GetMessage( "S2U_MAIN_AUTO_ELEMENT_DEACTIVATE", Array( "#ID#" => $arFieldsForUrlNew["ID"], "#IBLOCK_ID#" => $arFieldsForUrlNew["IBLOCK_ID"] ) );
					
					                if ( $urlNew[0] != '/' ) {
						                $urlNew = '/' . $urlNew;
					                }
					
					                if ( $urlNew != '/' && $urlNew != '' ) {
						                // ��� ����� �������� ����� ������
						                $arrRedirectDbFields = array(
							                'OLD_LINK'         => $urlNew,
							                'NEW_LINK'         => $urlSection,
							                'DATE_TIME_CREATE' => ConvertTimeStamp( time(), 'FULL' ),
							                'STATUS'           => "301",
							                'ACTIVE'           => "Y",
							                'COMMENT'          => $COMMENT,
							                'SITE_ID'          => $siteID,
							                'WITH_INCLUDES'    => "N",
							                'USE_REGEXP'       => "N",
						                );
						
						                if ( $repair_conflicts ) {
							                $Res__ = S2uRedirectsRulesDB::RepairConflicts( $arrRedirectDbFields, false, false );
						                } else {
							                $Res__ = S2uRedirectsRulesDB::Add( $arrRedirectDbFields, false, false );
						                }
					                }
				                }
			                }
			
			                // ���� ������� ����� ������������, �� ���� ������ ��� ������������� ���� "�������� ��� ����������� ��������"
			                if ( $arFieldsNew["ACTIVE"] == "Y" && $arFieldsOld["ACTIVE"] == "N" && COption::GetOptionString( self::MODULE_ID, "autoredirects_element_deactivate", "N" ) == "Y" ) {
				                // ����������� �������������, ������� ����������� ����� ��� ��������� ���������
				                $COMMENT = GetMessage( "S2U_MAIN_AUTO_ELEMENT_DEACTIVATE", Array( "#ID#" => $arFieldsForUrlNew["ID"], "#IBLOCK_ID#" => $arFieldsForUrlNew["IBLOCK_ID"] ) );
				
				                // ���� � �� ��� ���������, ��������� ��� ������� ����������� ��������
				                $redirects = S2uRedirectsRulesDB::GetList( array(
					                "ACTIVE"  => "Y",
					                'SITE_ID' => $siteID,
					                "COMMENT" => $COMMENT
				                ) );
				
				                // ������� ��� ����� ��������� � ������������ ��
				                foreach ( $redirects as $redirect ) {
					                $redirect["ACTIVE"] = "N";
					                S2uRedirectsRulesDB::Update( $redirect["ID"], $redirect, false );
				                }
			                }
			
			                /*
							  var_dump($arFieldsForUrlOld);
							  var_dump($arFieldsForUrlNew);
							  var_dump($urlOld);
							  var_dump($urlNew);
							  var_dump("----------");
							  exit;
							 */
		                }
		                // ������������ ��������, ����� ����� ������ ����� 1
		                // ����� �� ���� ������ �������� ������ �������� �� �����
                        //elseif ( count( $arFieldsForUrlNew["IBLOCK_SECTION"] ) == 1 ) {
		                elseif(is_array($arResultList) && count($arFieldsForUrlNew["IBLOCK_SECTION"]) == 1){
			                foreach ( $arFieldsForUrlOld["IBLOCK_SECTION"] as $oldSectionID ) {
				                if ( $oldSectionID != $arFieldsForUrlNew["IBLOCK_SECTION"][0] ) {
					                // ����� URL - ��������� � ������������� �������
					                $arFieldsForUrlNew["IBLOCK_SECTION_ID"] = $arFieldsForUrlNew["IBLOCK_SECTION"][0];
					                $arFieldsForUrlNew["SITE_DIR"] = $arSite['DIR'];
					                $urlNew = self::ReplaceDetailUrl( $arIblock["DETAIL_PAGE_URL"], $arFieldsForUrlNew, $_SERVER["SERVER_NAME"], "E" );
					
					                $arFieldsForUrlOld["IBLOCK_SECTION_ID"] = $oldSectionID;
					                $arFieldsForUrlOld["SITE_DIR"] = $arSite['DIR'];
					                $urlOld = self::ReplaceDetailUrl( $arIblock["DETAIL_PAGE_URL"], $arFieldsForUrlOld, $_SERVER["SERVER_NAME"], "E" );
					
					                // ���� URL ���������, �� ������� ��������
					                if ( $urlNew && $urlOld && $urlNew != $urlOld && COption::GetOptionString( self::MODULE_ID, "autoredirects_change_detail_url", "N" ) == "Y" ) {
						
						                // ����������� �� ��������� ����������� ���������� ����������
						                $repair_conflicts = COption::GetOptionString( self::MODULE_ID, 'REPAIR_CONFLICTS', 'N' );
						
						                // ����������� �������������
						                $COMMENT = GetMessage( "S2U_MAIN_AUTO_ELEMENT", Array( "#ID#" => $arFieldsForUrlNew["ID"], "#IBLOCK_ID#" => $arFieldsNew["IBLOCK_ID"] ) );
						
						                if ( $urlNew[0] != '/' ) {
							                $urlNew = '/' . $urlNew;
						                }
						
						                if ( $urlNew != '/' && $urlNew != '' ) {
							                // ��� ����� �������� ����� ������
							                $arrRedirectDbFields = array(
								                'OLD_LINK'         => $urlOld,
								                'NEW_LINK'         => $urlNew,
								                'DATE_TIME_CREATE' => ConvertTimeStamp( time(), 'FULL' ),
								                'STATUS'           => "301",
								                'ACTIVE'           => "Y",
								                'COMMENT'          => $COMMENT,
								                'SITE_ID'          => $siteID,
								                'WITH_INCLUDES'    => "N",
								                'USE_REGEXP'       => "N",
							                );
							
							                if ( $repair_conflicts ) {
								                $Res__ = S2uRedirectsRulesDB::RepairConflicts( $arrRedirectDbFields, false, false );
							                } else {
								                $Res__ = S2uRedirectsRulesDB::Add( $arrRedirectDbFields, false, false );
							                }
						                }
					                }
				                }
			                }
		                }
	                }
                } else { // ���� ������� ����� � �����
	                $arFieldsForUrlNew["IBLOCK_SECTION_ID"] = null;
	                $arFieldsForUrlNew["SITE_DIR"] = $arSite['DIR'];
	                $urlNew = self::ReplaceDetailUrl( $arIblock["DETAIL_PAGE_URL"], $arFieldsForUrlNew, $_SERVER["SERVER_NAME"], "E" );
	                
	                $arFieldsForUrlOld["IBLOCK_SECTION_ID"] = null;
	                $arFieldsForUrlOld["SITE_DIR"] = $arSite['DIR'];
	                $urlOld = self::ReplaceDetailUrl( $arIblock["DETAIL_PAGE_URL"], $arFieldsForUrlOld, $_SERVER["SERVER_NAME"], "E" );
	                
	                if ( $urlNew && $urlOld && $urlNew != $urlOld && COption::GetOptionString( self::MODULE_ID, "autoredirects_change_detail_url", "N" ) == "Y" ) {
		                // ����������� �� ��������� ����������� ���������� ����������
		                $repair_conflicts = COption::GetOptionString( self::MODULE_ID, 'REPAIR_CONFLICTS', 'N' );
		
		                // ����������� �������������
		                $COMMENT = GetMessage( "S2U_MAIN_AUTO_ELEMENT", Array( "#ID#" => $arFieldsForUrlNew["ID"], "#IBLOCK_ID#" => $arFieldsNew["IBLOCK_ID"] ) );
		
		                if ( $urlNew[0] != '/' ) {
			                $urlNew = '/' . $urlNew;
		                }
		
		                if ( $urlNew != '/' && $urlNew != '' ) {
			                // ��� ����� �������� ����� ������
			                $arrRedirectDbFields = array(
				                'OLD_LINK'         => $urlOld,
				                'NEW_LINK'         => $urlNew,
				                'DATE_TIME_CREATE' => ConvertTimeStamp( time(), 'FULL' ),
				                'STATUS'           => "301",
				                'ACTIVE'           => "Y",
				                'COMMENT'          => $COMMENT,
				                'SITE_ID'          => $siteID,
				                'WITH_INCLUDES'    => "N",
				                'USE_REGEXP'       => "N",
			                );
			
			                if ( $repair_conflicts ) {
				                $Res__ = S2uRedirectsRulesDB::RepairConflicts( $arrRedirectDbFields, false, false );
			                } else {
				                $Res__ = S2uRedirectsRulesDB::Add( $arrRedirectDbFields, false, false );
			                }
		                }
                    }
                }
            }
        }
        //exit;
    }

    static public function OnBeforeIBlockElementDeleteHandler($ID) {
        global $DB;
        $refreshCache = false;
        $arrMethod = array();
        $repair_conflicts = COption::GetOptionString(self::MODULE_ID, 'REPAIR_CONFLICTS', 'N');
        
        if (COption::GetOptionString("step2use.redirects", 'autoredirects_element_delete') == "Y") {
        
        $res = CIBlockElement::GetByID($ID);
        if ($arFields = $res->GetNext())
            $arIblock = CIBlock::GetArrayByID($arFields["IBLOCK_ID"]);
        $rsSites = CIBlock::GetSite($arFields["IBLOCK_ID"]);
        while ($arSite = $rsSites->Fetch()) {
            $arrMethod[$arSite["LID"]][] = ('delete');
        }
        //if (count($arrMethod)) {
            if(is_array($arrMethod) && count($arrMethod)){
            $rsElements = CIBlockElement::GetList(array(), array("ID" => $arFields["ID"]), false, false, array("DETAIL_PAGE_URL", "ACTIVE"));
            $rsElements->SetUrlTemplates($arIblock["DETAIL_PAGE_URL"]);
            $OLD_LINK = array();
            $COMMENT = "";
            $NEW_LINK = "";
            foreach ($arrMethod as $site => $method) {
                if (in_array("delete", $method)) {
                    $rsElements = CIBlockElement::GetList(array(), array("ID" => $arFields["ID"]), false, false, array("DETAIL_PAGE_URL", "ACTIVE"));
                    $rsElements->SetUrlTemplates($arIblock["DETAIL_PAGE_URL"]);
                    if ($arElement = $rsElements->GetNext()) {

                        if (!isset($arFields["CODE"])) {
                            $arFields["CODE"] = $arElement["CODE"];
                        }

                        if (!$NEW_LINK) {
                            if ($arElement["ACTIVE"] == "Y" && $arFields["ACTIVE"] == "Y") {
                                if (!$arFields["IBLOCK_SECTION"]["0"]) {
                                    $res = CIBlockElement::GetByID($arFields["ID"]);
                                    if ($ar_res = $res->GetNext()) {
                                        $arFields["IBLOCK_SECTION"]["0"] = $ar_res["IBLOCK_SECTION_ID"];
                                    }
                                }

                                $res = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
                                $res->SetUrlTemplates($arIblock["SECTION_PAGE_URL"]);
                                if ($ar_res = $res->GetNext()) {
                                    $NEW_LINK = $ar_res["SECTION_PAGE_URL"];
                                    $COMMENT = GetMessage("S2U_MAIN_AUTO_ELEMENT_DELETE", Array("#ID#" => $arFields["ID"], "#IBLOCK_ID#" => $arFields["IBLOCK_ID"]));
                                }
                            }
                            // ���� ������� ���������� ����� ������� �����������, �� ���� ��������� ��������� ����� �������
                        } else {
                            $link = str_replace($arElement["CODE"] . "/", "", $NEW_LINK);
                            $link = str_replace($arElement["CODE"], "", $NEW_LINK);
                        }
                    }
                }
                if ($NEW_LINK) {
                    if ($NEW_LINK[0] != '/') {
                        $NEW_LINK = '/' . $NEW_LINK;
                    }
                    if ($NEW_LINK != '/' && $NEW_LINK != '') {
                        //if (count($OLD_LINK)) {
                        if(is_array($OLD_LINK) && count($OLD_LINK)>0){
                            foreach ($OLD_LINK as $oldlink) {
                                $arrDbFields = array(
                                    'OLD_LINK' => $oldlink,
                                    'NEW_LINK' => trim($NEW_LINK),
                                    'DATE_TIME_CREATE' => ConvertTimeStamp(time(), 'FULL'),
                                    'STATUS' => "301",
                                    'ACTIVE' => "Y",
                                    'COMMENT' => $COMMENT,
                                    'SITE_ID' => $site,
                                    'WITH_INCLUDES' => "N",
                                    'USE_REGEXP' => "N",
                                );
                                /*if() {
                                    $refreshCache = true;
                                }*/
                                if ($repair_conflicts) {
                                    $Res__ = S2uRedirectsRulesDB::RepairConflicts($arrDbFields, false, false);
                                } else {
                                    $Res__ = S2uRedirectsRulesDB::Add($arrDbFields, false, false);
                                }
                            }
                        } else {
                            $arrDbFields = array(
                                'OLD_LINK' => $arElement["DETAIL_PAGE_URL"],
                                'NEW_LINK' => trim($NEW_LINK),
                                'DATE_TIME_CREATE' => ConvertTimeStamp(time(), 'FULL'),
                                'STATUS' => "301",
                                'ACTIVE' => "Y",
                                'COMMENT' => $COMMENT,
                                'SITE_ID' => $site,
                                'WITH_INCLUDES' => "N",
                                'USE_REGEXP' => "N",
                            );
                            if ($repair_conflicts) {
                                $Res__ = S2uRedirectsRulesDB::RepairConflicts($arrDbFields, false, false);
                            } else {
                                $Res__ = S2uRedirectsRulesDB::Add($arrDbFields, false, false);
                            }
                        }
                    }
                }
            }
        }
        }
    }

    static public function OnAfterIBlockElementAddHandler(&$arFields) {
        
        // ������ ID ����������, ��� ������� �������� �������� �������������� ����������
        $iblocksAutoredirect = explode(",", COption::GetOptionString(self::MODULE_ID, "autoredirects_iblocks", ""));
        $sites = [];

        // ���������, ����� �� ����������� ������������� ��� �������� ���������
        if(in_array($arFields["IBLOCK_ID"], $iblocksAutoredirect)) {
            $res = CIBlockElement::GetByID($arFields['ID']);
            if ($arRes = $res->GetNext()) {
                $elemLink = $arRes['DETAIL_PAGE_URL'];
            }
            if($elemLink) {
                $rsSites = CIBlock::GetSite($arFields["IBLOCK_ID"]);
                while ($arSite = $rsSites->Fetch()) {
                    $COMMENT = GetMessage("S2U_MAIN_AUTO_ELEMENT_ADD", Array("#ID#" => $arFields["ID"], "#IBLOCK_ID#" => $arFields["IBLOCK_ID"]));
                    $redirectsList = S2uRedirectsRulesDB::GetList([
                        'SITE_ID' => $arSite['LID'],
                        'ACTIVE' => 'Y',
                        'OLD_LINK' => $elemLink,
                    ]);
                    //$arrParam = array("COMMENT" => "$COMMENT", "ACTIVE" => "N", "WITH_INCLUDES" => "N", "USE_REGEXP" => "N");
                    foreach ($redirectsList as $redirect) {
                        if ($redirect["OLD_LINK"] == $elemLink) {
                            $newFields = $redirect;
                            unset($newFields['ID']);
                            $newFields['ACTIVE'] = 'N';
                            $newFields['COMMENT'] = "\n".date('d.m.Y H:i:s').': '.$COMMENT;
                            
                            S2uRedirectsRulesDB::Update($redirect['ID'], $newFields, false);
                        }
                    }
                }
            }

            
        }
        
        
    }

    /**
     * ���������� ����������� �������� �������, ���� �������� �������� ����� (45 ����)
     */
    static public function getLicenseRenewalBanner() {
        if (COption::GetOptionString(self::MODULE_ID, 'BITRIX_EXTENTION') == 'Y') {
            return false;
        }
        IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/' . self::MODULE_ID . '/classes/general/s2u_redirects.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/update_client.php');
        $errors = null;
        $stableVersionsOnly = COption::GetOptionString('main', 'stable_versions_only', 'Y');
        $arUpdateList = CUpdateClient::GetUpdatesList($errors, LANG, $stableVersionsOnly);
        $expired_date = $arUpdateList['CLIENT']['0']['@']['DATE_TO'];

        $expired_timestamp = strtotime($expired_date);

        $result = "";

        if (CModule::IncludeModuleEx(self::MODULE_ID) == MODULE_DEMO_EXPIRED) {
            $result .= BeginNote();
            $result .= GetMessage('atl_module_expired');
            $result .= EndNote();
        }

        if (time() >= $expired_timestamp - 45 * 86400) {
            $result .= BeginNote();
            $result .= GetMessage('atl_license_expired', array("#DATE#" => $expired_date));
            $result .= EndNote();
        }

        return $result;
    }

    /**
     * ���������� �� ������� ����. � �������, /qqq/www/eee/ --> /qqq/www/
     */
    public static function safeRedirectToLevelUp() {
        global $APPLICATION;

        $isActive = COption::GetOptionString(self::MODULE_ID, 'LEVELUP_REDIRECT_IF_404');

        if ($isActive == 'Y' && defined('ERROR_404') && ERROR_404 == 'Y' && !defined('ADMIN_SECTION')) {
            $redirectTo = $APPLICATION->GetCurPage(); //$_SERVER["REQUEST_URI"];
            // �� ������ ������� ��������� ���� � url, ���� �� ����
            if (substr($redirectTo, -1) == '/') {
                $redirectTo = substr($redirectTo, 0, strlen($redirectTo) - 1);
            }
            // � ����� ������� /index.php (���� �� ����)
            elseif (substr($redirectTo, -10) == '/index.php') {
                $redirectTo = substr($redirectTo, 0, strlen($redirectTo) - 10);
            }

            // ������� ����� ������ ������� url - ���������� �� ������� ����. � �������, /qqq/www/eee/ --> /qqq/www/
            if (strrpos($redirectTo, "/") !== false) {
                $redirectTo = substr($redirectTo, 0, strrpos($redirectTo, "/") + 1);
            }

            //$redirectTo .= $_SERVER['QUERY_STRING'];

            if ($redirectTo && $redirectTo != $APPLICATION->GetCurPage() . $_SERVER['QUERY_STRING'] && $redirectTo != $APPLICATION->GetCurPage() && $redirectTo . 'index.php' != $APPLICATION->GetCurPage() . $_SERVER['QUERY_STRING']) {
                LocalRedirect($redirectTo, false, 301);
            }
        }
    }
    
    /**
     * ������� ��� CIBlock::ReplaceSectionUrl(), �������� ��� ���� �������, ��������� � �������� ����������� #SITE_DIR# ��� ������ � 1�
     */
    public static function ReplaceSectionUrl($url, $arr, $server_name = false, $arrType = false) {
        if(isset($arr['SITE_DIR'])) {
            $url = str_replace('#SITE_DIR#', $arr['SITE_DIR'], $url);
        }
        return CIBlock::ReplaceSectionUrl($url, $arr, $server_name, $arrType);
    }
    
    /**
     * ������� ��� CIBlock::ReplaceDetailUrl(), �������� ��� ���� �������, ��������� � �������� ����������� #SITE_DIR# ��� ������ � 1�
     */
    public static function ReplaceDetailUrl($url, $arr, $server_name = false, $arrType = false) {
        if(isset($arr['SITE_DIR'])) {
            $url = str_replace('#SITE_DIR#', $arr['SITE_DIR'], $url);
        }
        return CIBlock::ReplaceDetailUrl($url, $arr, $server_name, $arrType);
    }
    
    
    /**
     * �������� ���������� $_SERVER["REQUEST_URI"]
     */
    public static function getRequestUrl() {
        // ����� ����� �����, ��� ����� ���� $_SERVER["REDIRECT_URL"] � ��� ����� ������ URL. � �������, ��� ��� ������� � $_SERVER["REDIRECT_URL"] ����� �������� ���, � � $_SERVER["REQUEST_URI"] - ���������� ��� � get-����������� ���� &arrFilter['bla']=qqq
        if (!empty($_SERVER["REDIRECT_URL"])
            && !preg_match("#/urlrewrite.php$#", $_SERVER["REDIRECT_URL"])
        ) {
            $url = $_SERVER["REDIRECT_URL"];
            
            // ������� index.php � ����� - ���� �� ���� � REDIRECT_URL �� ��� ��� � REQUEST_URI
            if (preg_match("#/index.php$#", $url)
                && !empty($_SERVER["REQUEST_URI"]) 
                && !preg_match("#/index.php$#", $_SERVER["REQUEST_URI"])
               ) {
                $url = preg_replace("#/index.php$#", "/", $url);
            }
            
            if($_SERVER["REDIRECT_QUERY_STRING"]) { // ���� ������� � get-���������, �� ���������� �� ����
                $url .= "?".$_SERVER["REDIRECT_QUERY_STRING"];
            }
            return $url;
            
        }
        
        
        return $_SERVER["REQUEST_URI"];
    }


    public static function DeleteOldEntities() {
        global $DB;

        $DB = CDatabase::GetModuleConnection('step2use.redirects');

        $strSql = 'select count(*) AS COUNT from s2u_redirects_404';
        $arResult = $DB->Query($strSql)->Fetch();

        $SAVE_COUNT = COption::GetOptionString("step2use.redirects", "404_LIMIT");
        if($arResult['COUNT'] && $SAVE_COUNT) {
            $limit = $arResult['COUNT'] - $SAVE_COUNT;

            if($limit>0) { 
                $strSql = 'delete from s2u_redirects_404 ORDER BY DATE_TIME_CREATE ASC LIMIT '.$limit;
                $rs = $DB->Query($strSql);
            }
        }
        
        S2uRedirectsRulesDB::refreshCachedRegexpRules();


        return "S2uRedirects::DeleteOldEntities();";
    }
    
    public static function canAdminThisModule() {
        global $APPLICATION;
        $right = $APPLICATION->GetUserRight(self::MODULE_ID);
        $allowRights = array('W', 'F');
        return in_array($right, $allowRights);
    }
}