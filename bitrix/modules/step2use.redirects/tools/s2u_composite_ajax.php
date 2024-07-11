<?php
header('Content-type: text/html; charset=windows-1251');
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$module_id="step2use.redirects";
CModule::IncludeModule($module_id);

$requestUri = strip_tags($_GET['requestUri']);

$redirect = S2uRedirectsRulesDB::FindRedirect($requestUri, SITE_ID);
$_404IsActive = COption::GetOptionString($module_id, '404_IS_ACTIVE', 'Y');

$main_mirror = COption::GetOptionString($module_id, 'main_mirror_' . SITE_ID);
$slash_redirect = COption::GetOptionString($module_id, 'slash_add_' . SITE_ID);
$delIndex = COption::GetOptionString($module_id, 'REDIR_WITHOUT_INDEX_' . SITE_ID);
$toLower = COption::GetOptionString($module_id, 'REDIR_TO_LOWER_' . SITE_ID);
$doubleSlashesFix = COption::GetOptionString($module_id, 'double_slashes_fix_' . SITE_ID);

$responseArray = array(
    'code' => 'OK'
);

if($redirect) {
    
    if($redirect['STATUS'] == "410"){
        $header = "HTTP/1.0 410 Gone";
    }else{
        $newUrl = $redirect['NEW_LINK'];
        $oldUrl = $redirect['OLD_LINK'];
        
        $newUrl = S2uRedirects::protocolAndWwwFix($newUrl);
        if($main_mirror != ""){
            $newUrl = S2uRedirects::mainMirror($newUrl, $main_mirror);
        }
        if ($delIndex == "Y") {
            $newUrl = S2uRedirects::delIndex($newUrl);
        }
        if ($toLower == "Y") {
            $newUrl = S2uRedirects::toLower($newUrl);
        }
        if ($slash_redirect == "Y") {
            $newUrl = S2uRedirects::addSlash($newUrl);
        }
        if ($doubleSlashesFix == "Y") {
            $newUrl = S2uRedirects::fixDoubleSlashes($newUrl);
        }
        
        if($oldUrl != $newUrl ){
            if (S2uRedirects::checkLoopRedirect($oldUrl, $newUrl)) {
                $responseArray['newUrl'] = $newUrl;
            }
        }
    }

} else {
    $url = $oldUrl = $_SERVER['HTTP_REFERER']; //S2uRedirects::curPageURL();

    $arrUrl = array();
    $arrUrl = parse_url($url);
    if(substr($arrUrl["path"], 0, 8) != "/bitrix/"){
        $url = S2uRedirects::protocolAndWwwFix($url);
        
        if($main_mirror != ""){
            //var_dump("MIRROR");exit;
            $url = S2uRedirects::mainMirror($url, $main_mirror);
        }
        if ($delIndex == "Y") {
            //var_dump("SLASH");
            $url = S2uRedirects::delIndex($url);
            //echo '<pre>';print_r($arrUrl);echo '<pre>';
            /* var_dump($url);
              echo '<br />';
              var_dump($oldUrl);exit; */
        }
        if ($toLower == "Y") {
            $url = S2uRedirects::toLower($url);
        }					
        if ($slash_redirect == "Y") {
            //var_dump("SLASH");
            $url = S2uRedirects::addSlash($url);
            //var_dump($url);
            //var_dump($oldUrl);exit;
        }
        if ($doubleSlashesFix == "Y") {
            $url = S2uRedirects::fixDoubleSlashes($url);
        }
        
        $responseArray['oldUrl'] = $oldUrl;
        if($url != $oldUrl){
            $responseArray['newUrl'] = $url;
        }
    }
}

echo json_encode($responseArray);