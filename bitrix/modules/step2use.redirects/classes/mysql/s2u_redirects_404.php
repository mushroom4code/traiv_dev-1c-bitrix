<?
class S2uRedirects404DB {
    
    const MODULE_ID = 'step2use.redirects';
    
//======================================================================================
	/**
	 * The member function prepares an array of $ arResult, which is actually the contents of the file site_root / S2U_REDIRECT.php
	 * Training includes sorting.
	 * @ Param $ arFilter = array ('old_link', 'new_link'=>, 'date_time_create' =>, 'active' =>, 'comment' =>)
	 * @ Param $ arOrder = array ('ADRESS' => 'ASC' | 'DESC') - passed one of the keys OLD_LINK, NEW_LINK, DATE_TIME_CREATE, STATUS, ACTIVE
	 */
    public static function GetList($arFilter = array(), $arOrder = array(), $joinRules = false) {
		global $APPLICATION;
        
        $DB = CDatabase::GetModuleConnection('step2use.redirects');
        
        $strSql = "
            SELECT 
                r404.*";
        if($joinRules) $strSql .= ", if(rr.OLD_LINK IS NOT NULL, 'Y', 'N') as IS_REDIRECTED";
        $strSql .= "
            FROM
                s2u_redirects_404 as r404";
        if($joinRules) $strSql .= " LEFT JOIN s2u_redirects_rules as rr ON rr.OLD_LINK=r404.URL AND rr.SITE_ID=r404.SITE_ID AND rr.ACTIVE='Y'";

        $where = array();
        foreach($arFilter as $field=>$val) {
            if(substr($field, 0, 2)=='>='){
                $where[] = 'r404.' . substr($field, 2)." >= '".$DB->ForSql($val)."'";
            }
            elseif(substr($field, 0, 2)=='<=')
                $where[] = 'r404.' . substr($field, 2)." <= '".$DB->ForSql($val)."'";
            elseif($field=='IS_REDIRECTED') {
                if($val=='Y') $where[] = 'rr.OLD_LINK IS NOT NULL';
                elseif($val=='N') $where[] = 'rr.OLD_LINK IS NULL';
            }
			elseif($field=='SITE_ID') {
				$where[] = 'r404.'.$field." = '".$DB->ForSql($val)."'";
			}
            else{
				$where[] = GetFilterQuery($field, $val,"N");
			}
        }

        if(is_array($where) && count($where)>0){
            $where = ' WHERE '.GetFilterSqlSearch($where);
        } else {
            $where = '';
        }
	    /*if(count($where)) $where = ' WHERE '.GetFilterSqlSearch($where);
        else $where = '';*/
        
            $arOrderKeys = array_keys($arOrder);
			$orderBy = $arOrderKeys[0];
			$orderDir = $arOrder[$orderBy];        
        
        switch ($orderBy) {
            case 'URL':
                $strSqlOrder = 'ORDER BY URL';
                break;
            case 'SITE_ID':
                $strSqlOrder = 'ORDER BY r404.SITE_ID';
                break;
            case 'IS_REDIRECTED':
                $strSqlOrder = ($joinRules)? 'ORDER BY IS_REDIRECTED': 'ORDER BY DATE_TIME_CREATE';
                break;
            default:
                $strSqlOrder = "ORDER BY DATE_TIME_CREATE";
                break;
        }

        if ($orderDir!="asc") {
            $strSqlOrder .= " desc ";
            $orderDir="desc";
        }
        else {
            $strSqlOrder .= " asc ";
        }
        $rs = $DB->Query($strSql.' '.$where.' '.$strSqlOrder, false, $err_mess.__LINE__);
        $arResult = array();
        while($data = $rs->Fetch()) {
            $arResult[] = $data;
        }
        
        return $arResult;
	}

	/**
	 * Adds a new URL redirect
	 * @param  $arFields = array('ID', 'OLD_LINK','NEW_LINK'=>,'DATE_TIME_CREATE'=>'30.09.2010 12:23', 'ACTIVE'=>, 'COMMENT'=>)
	 */
	public static function Add($arFields) {

        $DB = $moduleDB = CDatabase::GetModuleConnection('step2use.redirects');
        
		if (!array_key_exists("SITE_ID", $arFields))
			$arFields["SITE_ID"] = SITE_ID;

		$docRoot = CSite::GetSiteDocRoot($arFields["SITE_ID"]);

        $DB->PrepareFields("s2u_redirects");
		$arFields = array(
            "DATE_TIME_CREATE"             => $DB->GetNowFunction(),
            "SITE_ID"                    => "'".$DB->ForSql($arFields["SITE_ID"], 2)."'",
            "URL"                 => "'".$DB->ForSql(trim($arFields["URL"]))."'",
            "REFERER_URL"                  => "'".$DB->ForSql(trim($arFields["REFERER_URL"]))."'",
            "REDIRECT_STATUS"           => "'".$DB->ForSql(trim($arFields["REDIRECT_STATUS"]))."'",
            "GUEST_ID"                    => "'".$DB->ForSql($arFields["GUEST_ID"])."'",
        );
        
        $ID = $DB->Insert("s2u_redirects_404", $arFields, $err_mess.__LINE__);
        
        return ($ID)? true: false;
	}


	/**
	 * Updates the specified reduction in your rate.
	 * The member function finds the reduction and change its value.
	 * @ Param $ arFilter = array ('OLD_LINK','NEW_LINK'=>,' DATE_TIME_CREATE' => '30 .09.2010 12:23 ',' ACTIVE '=>,' COMMENT '=>)
	 */
	public static function Update($ID, $arFields) {
		$DB = $moduleDB = CDatabase::GetModuleConnection('step2use.redirects');
        
		if (!array_key_exists("SITE_ID", $arFields))
			$arFields["SITE_ID"] = SITE_ID;

		$docRoot = CSite::GetSiteDocRoot($arFields["SITE_ID"]);

        $DB->PrepareFields("s2u_redirects_404");
        $arFields = array(
            "DATE_TIME_CREATE"             => $DB->GetNowFunction(),
            "SITE_ID"                    => "'".$DB->ForSql($arFields["SITE_ID"], 2)."'",
            "URL"                 => "'".$DB->ForSql(trim($arFields["URL"]))."'",
            "REFERER_URL"                  => "'".$DB->ForSql(trim($arFields["REFERER_URL"]))."'",
            "REDIRECT_STATUS"           => "'".$DB->ForSql(trim($arFields["REDIRECT_STATUS"]))."'",
            );
        
        $updated = $DB->Update("s2u_redirects", $arFields, "WHERE ID='".$ID."'", $err_mess.__LINE__);
        
        return ($updated)? true: false;
	}


	/**
	 * Removes the redirect rule
	 * @param int $ID
	 */
	public static function Delete($ID) {
		global $APPLICATION, $DB;

        $ID = (int) $ID;
        if(!$ID) return false;
        
		$res = $DB->Query("DELETE FROM s2u_redirects_404 WHERE ID='$ID'");
        
        return $res;
	}
    
	public static function GetReport($arFilter = array(), $arOrder = array(), $joinRules = false) {
		global $APPLICATION;
        
        $DB = CDatabase::GetModuleConnection('step2use.redirects');
        
        $strSql = "
            SELECT 
                r404.*";
        if($joinRules) $strSql .= ", if(rr.OLD_LINK IS NOT NULL, 'Y', 'N') as IS_REDIRECTED, COUNT(r404.ID) AS CNT";
        $strSql .= "
            FROM
                s2u_redirects_404 as r404";
        if($joinRules) $strSql .= " LEFT JOIN s2u_redirects_rules as rr ON rr.OLD_LINK=r404.URL AND rr.SITE_ID=r404.SITE_ID AND rr.ACTIVE='Y'";
        
        $where = array();
        foreach($arFilter as $field=>$val) {
            if($val){
                if($field=='IS_REDIRECTED') {
                    if($val=='Y') $where[] = 'rr.OLD_LINK IS NOT NULL';
                    elseif($val=='N') $where[] = 'rr.OLD_LINK IS NULL';
                } elseif($field=='SITE_ID') {
                    $where[] = 'r404.'.$field." = '".$DB->ForSql($val)."'";
                }
                else{
                    $where[] = GetFilterQuery($field, $val,"N");
                }
            }

        }
      
        if(is_array($where) && count($where)>0){
            $where = ' WHERE '.GetFilterSqlSearch($where);
        } else {
            $where = '';
        }
	    /*if(count($where)) $where = ' WHERE '.GetFilterSqlSearch($where);
        else $where = '';*/
        
            $arOrderKeys = array_keys($arOrder);
			$orderBy = $arOrderKeys[0];
			$orderDir = $arOrder[$orderBy];        
        
        switch ($orderBy) {
            case 'URL':
                $strSqlOrder = 'ORDER BY URL';
                break;
            case 'SITE_ID':
                $strSqlOrder = 'ORDER BY SITE_ID';
                break;
            case 'IS_REDIRECTED':
                $strSqlOrder = ($joinRules)? 'ORDER BY IS_REDIRECTED': 'ORDER BY DATE_TIME_CREATE';
                break;
            default:
                $strSqlOrder = "ORDER BY CNT";
                break;
        }

        if ($orderDir!="asc") {
            $strSqlOrder .= " desc ";
            $orderDir="desc";
        }
        else {
            $strSqlOrder .= " asc ";
        }
        
        $strSqlGroup = " GROUP BY SITE_ID, URL";
        
        $rs = $DB->Query($strSql.' '.$where.' '.$strSqlGroup.' '.$strSqlOrder, false, $err_mess.__LINE__);
        $arResult = array();
        while($data = $rs->Fetch()) {
            $arResult[] = $data;
        }
        
        return $arResult;
	}
    
    
	public static function GetCount() {
        $DB = CDatabase::GetModuleConnection('step2use.redirects');
        
        $rs = $DB->Query("SELECT COUNT(*) as CNT FROM s2u_redirects_404", false, $err_mess.__LINE__);
        $data = $rs->Fetch();
        
        return $data['CNT'];
    }
    
    
    public static function DeleteOldest() {
        $DB = CDatabase::GetModuleConnection('step2use.redirects');
        
        $rs = $DB->Query("DELETE FROM s2u_redirects_404 ORDER BY ID ASC LIMIT 50", false, $err_mess.__LINE__);
        $data = $rs->Fetch();
        
        return $data['CNT'];
    }
	
}

?>