<?php

namespace AdwMinified;

class LazyLoad {
	const className = 'ami-lazy';
	const imgName = '1px.png';
	const jsName = 'lazyload.js';
	const jsDir = '/bitrix/js/adwex.minified/';

    public static function neadOptimize () {

		global $APPLICATION;
		$curPage = $APPLICATION->GetCurPage();

		if (\COption::GetOptionString(Tools::moduleID, 'USE_LAZYLOAD', 'N', SITE_ID) !== 'Y') 
			return false;

		$skipMap = explode("\n",\COption::GetOptionString(Tools::moduleID, 'LAZYLOAD_SKIPMAP', '', SITE_ID));
		foreach($skipMap as $s) {

			$s = trim($s);
			if (empty($s))
				continue;

			if (strpos($curPage,$s) === 0)
				return false;

		}

		return true;

    }    

    public static function optimize ($imageUrls) {

		$applyLL2Bg = \COption::GetOptionString(Tools::moduleID, 'USE_LAZYLOAD_BG', 'N', SITE_ID) === 'Y';
		$cntApplied = 0;
        foreach ($imageUrls as $tag => $data) {

			if (preg_match("/data-(?:amlazy-skip|src)/i",$tag) == 1) {
                continue;
            }

            if (self::isImgTag($data['tag'])) {
				$imageUrls[$tag]['tag'] = self::addClass2ImgTag($data['tag']);
				$cntApplied++;
			}
			else if ($applyLL2Bg && self::isHTMLTagWithBGImg($data['tag'])) {
				$imageUrls[$tag]['tag'] = self::addClass2HTMLTag($data['tag'],$data['link']);
				$cntApplied++;
			}

        }

		if ($cntApplied > 0)
        	$imageUrls = self::addFiles($imageUrls);

        return $imageUrls;

    }

    private static function isImgTag($tag) {
        return (strpos($tag, '<img ') !== false);
    }

    private static function addClass2ImgTag($tag) {
        $find = [];
        $replace = [];
        if (strpos($tag, 'class="') !== false || strpos($tag, 'class=\'') !== false) {
            $find[] = 'class="';
            $find[] = 'class=\'';
            $replace[] = 'class="' . self::className . ' ';
            $replace[] = 'class=\'' . self::className . ' ';
        } else {
            $find[] = '<img ';
            $replace[] = '<img class="' . self::className . '" ';
        }
        $find[] = ' src="';
        $find[] = ' src=\'';
        $replace[] = ' src="' . self::jsDir . self::imgName . '" data-src="';
        $replace[] = ' src=\'' . self::jsDir . self::imgName . '\'  data-src=\'';
        $tag = str_replace($find, $replace, $tag);
        return $tag;
    }


    private static function isHTMLTagWithBGImg($tag) {
		return preg_match("/^<[a-z]+\s.*style\s*=\s*[\"'][^\"']*background(?:-image)?\s*:.*>$/i",$tag) == 1;
    }


    private static function addClass2HTMLTag($tag,$link) {

		preg_match("/^(<[a-z]+\s).+>$/i",$tag, $matches);
		$tagHeader = $matches[1];

        $find = array($link);
        $replace = array(self::jsDir.self::imgName);
        if (strpos($tag, 'class="') !== false) {
            $find[] = 'class="';
            $replace[] = 'data-src="'.$link.'" class="' . self::className . ' ';
		}
		else if (strpos($tag, 'class=\'') !== false){
            $find[] = 'class=\'';
            $replace[] = 'data-src="'.$link.'" class=\'' . self::className . ' ';
        } 
		else {
            $find[] = $tagHeader;
            $replace[] = $tagHeader.'data-src="'.$link.'" class="' . self::className . '" ';
        }

        $tag = str_replace($find, $replace, $tag);
        return $tag;

	}


    private static function addFiles ($imageUrls) {

		$docRoot = $_SERVER['DOCUMENT_ROOT'];
		if (!file_exists($docRoot . self::jsDir . self::imgName)) {            
			\CheckDirPath($docRoot . self::jsDir);
			copy($docRoot . '/bitrix/modules/adwex.minified/js/' . self::imgName, $docRoot . self::jsDir . self::imgName);
			copy($docRoot . '/bitrix/modules/adwex.minified/js/' . self::jsName, $docRoot . self::jsDir . self::jsName);
		}

		$imageUrls['</head>'] = ['tag' => '<script async data-skip-moving="true" src="' . self::jsDir . self::jsName . '"></script></head>'];
        return $imageUrls;

    }
}