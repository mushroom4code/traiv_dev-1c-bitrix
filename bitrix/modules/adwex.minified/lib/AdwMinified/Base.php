<?php

namespace AdwMinified;

class Base {
    public static function getSiteId () {
		$siteID = SITE_ID;
		$bAdminSection = self::isAdminSection();
		if ($bAdminSection) {
	        require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/mainpage.php');
	        $siteID = (new \CMainPage)->GetSiteByHost();
	        if (!$siteID) {
	            $siteID = 's1';
            }
        }
        return $siteID;
    }
    
    public static function isPageSpeed () {
        return (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') !== false);
    }
    
    public static function isAdminSection () {
        return (defined('ADMIN_SECTION') && ADMIN_SECTION === true);
    }
    
    public static function isPublic () {
        return (defined('SITE_ID') && (!defined('SITE_TEMPLATE_ID') || SITE_TEMPLATE_ID !== 'landing24') && !self::isAdminSection());
    }
    
    public static function optimize (&$content) {
        if (self::isPublic() && self::needOptimize()) {
            $start = microtime(true);
            $replace = [
                'find' => [],
                'replace' => [],
				'add' => []
            ];
            $head = self::findHead($content);
            $isHtml = HTML::isHtml($head);
            if ($isHtml) {

				$originalHead = $head;
				$replace = Fonts::optimize($head, $replace);
                $replace = JS::optimize($head, $replace);
                $replace = HTML::optimizeHead($head, $replace);

                $head = str_replace($replace['find'], $replace['replace'], $originalHead).implode($replace['add']);
                $replace = [
                    'find' => [ $originalHead ],
                    'replace' => [ $head ],
					'add' => []
                ];

            }

            $replace = Image::optimize($content, $replace);
            if ($isHtml) {
                $replace = CSS::optimize($content, $replace);
                $replace = HTML::optimize($content, $replace);
            }

            $content = str_replace($replace['find'], $replace['replace'], $content).implode($replace['add']);
            if ($isHtml) {
                $content = HTML::endMinify($content);
                if ($_GET['am-debug'] === 'y') {
                    $content .= PHP_EOL . '<!--' . round(microtime(true) - $start, 4) . '-->';
                }
            }

        }
    }

    private static function needOptimize () {

        global $APPLICATION;

        $option = \COption::GetOptionString(Tools::moduleID, 'WORK_FOR_GROUP', 'ALL', SITE_ID);
        if ($option === 'NOONE') {
            return false;
        } elseif ($option === 'ADMIN') {
            global $USER;
            if (!$USER->IsAdmin()) {
                return false;
            }
        }

		$skipErr404 = \COption::GetOptionString(Tools::moduleID, 'SKIPERROR404', 'N', SITE_ID);
		if (defined('ERROR_404')) {
            if (ERROR_404 == 'Y' && $skipErr404 == 'Y') {
                return false;
            }
		}

        $curPage = $APPLICATION->GetCurPage();
        $skipMap = explode("\n",\COption::GetOptionString(Tools::moduleID, 'PAGES_SKIPMAP', '', SITE_ID));
        foreach($skipMap as $s) {

            $s = trim($s);
            if (empty($s))
                continue;

            if (strpos($curPage,$s) === 0)
                return false;

        }

        return true;

    }

    private static function findHead ($content) {
        $explodeContent = explode('</head>', $content);
        return $explodeContent[0];
    }
}