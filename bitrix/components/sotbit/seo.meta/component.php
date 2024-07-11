<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock\Template;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;
use Sotbit\Seometa\SeometaUrlTable;
use Sotbit\Seometa\SeoMetaMorphy;
use Sotbit\Seometa\SeometaStatisticsTable;

if(!Loader::includeModule('sotbit.seometa') || !Loader::includeModule('iblock'))
{
    return false;
}

global $sotbitSeoMetaTitle; //Meta title
global $sotbitSeoMetaKeywords; //Meta keywords
global $sotbitSeoMetaDescription; //Meta description
global $sotbitFilterResult; //Filter result
global $sotbitSeoMetaH1; //for set h1
global $sotbitSeoMetaBottomDesc; //for set bottom description
global $sotbitSeoMetaTopDesc; //for set top description
global $sotbitSeoMetaAddDesc; //for set additional description
global $sotbitSeoMetaFile;
global $sotbitSeoMetaBreadcrumbLink;
global $sotbitSeoMetaBreadcrumbTitle;
global ${$arParams['FILTER_NAME']};
global $issetCondition;

global $SeoMetaWorkingConditions;
$SeoMetaWorkingConditions = array();

if((Option::get("sotbit.seometa", "NO_INDEX_" . SITE_ID, "N") != "N") && (!empty(${$arParams['FILTER_NAME']})))
{
    $APPLICATION->SetPageProperty("robots", 'noindex, nofollow');
}

$paginationText = "";
if($_REQUEST['PAGEN_1'])
{
    $pagOption = Option::get("sotbit.seometa", "PAGINATION_TEXT_" . SITE_ID);
    if($pagOption)
    {
        $paginationText = " " . str_replace('%N%', $_REQUEST['PAGEN_1'], $pagOption);
    }
}


if($arParams['KOMBOX_FILTER'] == 'Y' && CModule::IncludeModule('kombox.filter'))
{
    $str = CKomboxFilter::GetCurPageParam();
    $str = explode("?", $str);
    $str = $str[0];
}
else
{
    $str = $APPLICATION->GetCurPage();
}

preg_match_all('/[\p{Cyrillic} ]+/iu', $APPLICATION->GetCurPage(), $match);
foreach($match[0] as $i => $m)
{
    $str = str_replace($m, urlencode($m), $str);
}
$str = str_replace('+', '%20', $str);
$metaData = SeometaUrlTable::getByRealUrl($str);

if(!$metaData)
    $metaData = SeometaUrlTable::getByRealUrl(preg_replace('/index.php$/', '', $str));

if(!empty($metaData['NEW_URL']))
{
    $APPLICATION->SetCurPage($metaData['NEW_URL']);
}

CSeoMeta::SetFilterResult($sotbitFilterResult, $arParams['SECTION_ID']); //filter result for class
CSeoMeta::AddAdditionalFilterResults(${$arParams['FILTER_NAME']}, $arParams['KOMBOX_FILTER']);
CSeoMeta::FilterCheck();

if($this->StartResultCache(($arParams["CACHE_TIME"] ? $arParams["CACHE_TIME"] : false), ($arParams["CACHE_GROUPS"] ? $USER->GetGroups() : false)))
{
    $arResult = CSeoMeta::getRules($arParams); //list of conditions for current section
    $this->endResultCache();
}

$COND = array();
foreach($arResult as $key => $condition)
{
    //get conditions and metatags
//    $condition_id = $condition['ID'];
    $COND[$key]['RULES'] = unserialize($condition['RULE']);
    $COND[$key]['META'] = unserialize($condition['META']);
    $COND[$key]['ID'] = $condition['ID'];
    $COND[$key]['NO_INDEX'] = $condition['NO_INDEX'];
    $COND[$key]['STRONG'] = $condition['STRONG'];
}
$issetCondition = false;
$results = array();
foreach($COND as $rule) //get metatags if condition true
{
    $results[] = CSeoMeta::SetMetaCondition($rule, $arParams['SECTION_ID'], $condition['INFOBLOCK']);
}

if(is_array($results))
{
    $morphyObject = SeoMetaMorphy::morphyLibInit();
    foreach($results as $result) //set metatags
    {
        //INDEX
        if ($result['NO_INDEX'] == 'Y') {
            $APPLICATION->SetPageProperty("robots", 'noindex, nofollow');
        } else {
            if ($result['NO_INDEX'] == 'N') {
                $APPLICATION->SetPageProperty("robots", 'index, follow');
            }
        }

        $sku = new \Bitrix\Iblock\Template\Entity\Section($arParams['SECTION_ID']);

        if ($metaData['SEOMETA_DATA']['ELEMENT_TITLE_REPLACE'] == 'Y') {
            $result['TITLE'] = $metaData['SEOMETA_DATA']['ELEMENT_TITLE'];
        }
        if (!empty($result['TITLE'])) {
            if (class_exists('\Bitrix\Main\Text\Emoji')) {
                $result['TITLE'] = \Bitrix\Main\Text\Emoji::decode($result['TITLE']);
            }

            $sotbitSeoMetaTitle = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy($result['TITLE']));
            $sotbitSeoMetaTitle = SeoMetaMorphy::convertMorphy($sotbitSeoMetaTitle, $morphyObject);

            if ($paginationText) {
                $sotbitSeoMetaTitle .= $paginationText;
            }

            $APPLICATION->SetPageProperty("title", $sotbitSeoMetaTitle);
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_KEYWORDS_REPLACE'] == 'Y') {
            $result['KEYWORDS'] = $metaData['SEOMETA_DATA']['ELEMENT_KEYWORDS'];
        }
        if (!empty($result['KEYWORDS'])) {
            $sotbitSeoMetaKeywords = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy($result['KEYWORDS']));
            $sotbitSeoMetaKeywords = SeoMetaMorphy::convertMorphy($sotbitSeoMetaKeywords, $morphyObject);
            $APPLICATION->SetPageProperty("keywords", $sotbitSeoMetaKeywords);
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_DESCRIPTION_REPLACE'] == 'Y') {
            $result['DESCRIPTION'] = $metaData['SEOMETA_DATA']['ELEMENT_DESCRIPTION'];
        }
        if (!empty($result['DESCRIPTION'])) {
            $sotbitSeoMetaDescription = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy($result['DESCRIPTION']));
            $sotbitSeoMetaDescription = SeoMetaMorphy::convertMorphy($sotbitSeoMetaDescription, $morphyObject);
            if ($paginationText) {
                $sotbitSeoMetaDescription .= $paginationText;
            }

            $APPLICATION->SetPageProperty("description", $sotbitSeoMetaDescription);
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_PAGE_TITLE_REPLACE'] == 'Y') {
            $result['PAGE_TITLE'] = $metaData['SEOMETA_DATA']['ELEMENT_PAGE_TITLE'];
        }
        if (!empty($result['PAGE_TITLE'])) {
            $sotbitSeoMetaH1 = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy($result['PAGE_TITLE']));

            if (isset($sotbitSeoMetaH1) && !empty($sotbitSeoMetaH1)) {
                if ($paginationText) {
                    $sotbitSeoMetaH1 .= $paginationText;
                }
                $arResult['ELEMENT_H1'] = $sotbitSeoMetaH1;
            }
            $sotbitSeoMetaH1 = SeoMetaMorphy::convertMorphy($sotbitSeoMetaH1, $morphyObject);
            $APPLICATION->SetTitle($sotbitSeoMetaH1);
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_BREADCRUMB_TITLE_REPLACE'] == 'Y') {
            $result['BREADCRUMB_TITLE'] = $metaData['SEOMETA_DATA']['ELEMENT_BREADCRUMB_TITLE'];
        }
        if (!empty($result['BREADCRUMB_TITLE'])) {
            $url = @($_SERVER["HTTPS"] != 'on') ? 'http://' . $_SERVER["SERVER_NAME"] : 'https://' . $_SERVER["SERVER_NAME"];
            $url .= ($_SERVER["SERVER_PORT"] != 80) ? ":" . $_SERVER["SERVER_PORT"] : "";
            $url .= $_SERVER["REQUEST_URI"];
            $sotbitSeoMetaBreadcrumbLink = $url;
            $sotbitSeoMetaBreadcrumbTitle = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy($result['BREADCRUMB_TITLE']));
            $sotbitSeoMetaBreadcrumbTitle = SeoMetaMorphy::convertMorphy($sotbitSeoMetaBreadcrumbTitle, $morphyObject);
            if (isset($sotbitSeoMetaBreadcrumbLink) && !empty($sotbitSeoMetaBreadcrumbLink)) {
                $arResult['BREADCRUMB_TITLE'] = $sotbitSeoMetaBreadcrumbTitle;
                $arResult['BREADCRUMB_LINK'] = $url;
            }
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_TOP_DESC_REPLACE'] == 'Y') {
            $result['ELEMENT_TOP_DESC'] = $metaData['SEOMETA_DATA']['ELEMENT_TOP_DESC'];
        }
        if (!empty($result['ELEMENT_TOP_DESC'])) {
            $sotbitSeoMetaTopDesc = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy(html_entity_decode($result['ELEMENT_TOP_DESC'])));
            $sotbitSeoMetaTopDesc = SeoMetaMorphy::convertMorphy($sotbitSeoMetaTopDesc, $morphyObject);
            if (isset($sotbitSeoMetaTopDesc) && !empty($sotbitSeoMetaTopDesc)) {
                if ($result['ELEMENT_TOP_DESC_TYPE'] && $result['ELEMENT_TOP_DESC_TYPE'] == 'text') {
                    $sotbitSeoMetaTopDesc = htmlspecialchars($sotbitSeoMetaTopDesc);
                }
                $arResult['ELEMENT_TOP_DESC'] = $sotbitSeoMetaTopDesc;
            }
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_BOTTOM_DESC_REPLACE'] == 'Y') {
            $result['ELEMENT_BOTTOM_DESC'] = $metaData['SEOMETA_DATA']['ELEMENT_BOTTOM_DESC'];
        }
        if (!empty($result['ELEMENT_BOTTOM_DESC'])) {
            $sotbitSeoMetaBottomDesc = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy(html_entity_decode($result['ELEMENT_BOTTOM_DESC'])));
            $sotbitSeoMetaBottomDesc = SeoMetaMorphy::convertMorphy($sotbitSeoMetaBottomDesc, $morphyObject);
            if (isset($sotbitSeoMetaBottomDesc) && !empty($sotbitSeoMetaBottomDesc)) {
                if ($result['ELEMENT_BOTTOM_DESC_TYPE'] && $result['ELEMENT_BOTTOM_DESC_TYPE'] == 'text') {
                    $sotbitSeoMetaBottomDesc = htmlspecialchars($sotbitSeoMetaBottomDesc);
                }

                $arResult['ELEMENT_BOTTOM_DESC'] = $sotbitSeoMetaBottomDesc;
            }
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_ADD_DESC_REPLACE'] == 'Y') {
            $result['ELEMENT_ADD_DESC'] = $metaData['SEOMETA_DATA']['ELEMENT_ADD_DESC'];
        }
        if (!empty($result['ELEMENT_ADD_DESC'])) {
            $sotbitSeoMetaAddDesc = \Bitrix\Iblock\Template\Engine::process($sku,
                SeoMetaMorphy::prepareForMorphy(html_entity_decode($result['ELEMENT_ADD_DESC'])));
            $sotbitSeoMetaAddDesc = SeoMetaMorphy::convertMorphy($sotbitSeoMetaAddDesc, $morphyObject);
            if (isset($sotbitSeoMetaAddDesc) && !empty($sotbitSeoMetaAddDesc)) {
                if ($result['ELEMENT_ADD_DESC_TYPE'] && $result['ELEMENT_ADD_DESC_TYPE'] == 'text') {
                    $sotbitSeoMetaAddDesc = htmlspecialchars($sotbitSeoMetaAddDesc);
                }
                $arResult['ELEMENT_ADD_DESC'] = $sotbitSeoMetaAddDesc;
            }
            $issetCondition = true;
        }

        if ($metaData['SEOMETA_DATA']['ELEMENT_FILE_REPLACE'] == 'Y') {
            $result['ELEMENT_FILE'] = $metaData['SEOMETA_DATA']['ELEMENT_FILE'];
        }
        if (intval($result['ELEMENT_FILE']) > 0) {
            $fileArray = CFile::GetFileArray($result['ELEMENT_FILE']);
            $arResult['ELEMENT_FILE']['SRC'] = $fileArray['SRC'];
            $arResult['ELEMENT_FILE']['DESCRIPTION'] = $fileArray['DESCRIPTION'];
            $sotbitSeoMetaFile = '<img src="' . $arResult['ELEMENT_FILE']['SRC'] . '" alt="' . $arResult['ELEMENT_FILE']['DESCRIPTION'] . '">';
            $issetCondition = true;
        }

        //CANONICAL
        if ($issetCondition && Option::get("sotbit.seometa", "USE_CANONICAL_" . SITE_ID, "Y") != "N") {
            if ($arParams['KOMBOX_FILTER'] == 'Y' && CModule::IncludeModule('kombox.filter')) {
                $str = CKomboxFilter::GetCurPageParam();
                $str = explode("?", $str);
                $CurPage_temp = SeometaUrlTable::getByRealUrl($str[0]);
                if (isset($CurPage_temp['NEW_URL']) && !empty($CurPage_temp['NEW_URL'])) {
                    $CurPage = $CurPage_temp['NEW_URL'];
                } else {
                    $CurPage = $str[0];
                }
            } else {
                $CurPage = $APPLICATION->GetCurPage(false);
            }

            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            if ($_SERVER['REDIRECT_URL'] || $_SERVER['REQUEST_URI']) {
                $APPLICATION->SetPageProperty("canonical",
                    $protocol . $_SERVER["SERVER_NAME"] . ($_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI']));
            } else {
                $APPLICATION->SetPageProperty("canonical", $protocol . $_SERVER["SERVER_NAME"] . $CurPage);
            }
        }

        //tags
        if ($issetCondition && $result['ID'] > 0) {
            $SeoMetaWorkingConditions[] = $result['ID'];
        }
    }
}


$SeoMetaWorkingConditions = array_unique($SeoMetaWorkingConditions);

if($issetCondition)
{
    Asset::getInstance()->addJs("/bitrix/components/sotbit/seo.meta/js/stat.js");
}

$this->IncludeComponentTemplate();
?>
