<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '1788') {
        
        $connection = Application::getConnection();
        $request = Application::getInstance()->getContext()->getRequest();
        
        $sqlStart = $connection->query("SELECT DISTINCT(NAME) FROM b_easyform WHERE DATE_CREATE > '2024-06-12 10:00:00'");
        ?>
        <ul style="list-style:none;padding:5px;margin:5px;">
        <?php 
        while ($row = $sqlStart->Fetch()){
            ?>
            <li style="float:left;padding:5px 10px;"><a href="/test_photo.php?typez=<?php echo $row['NAME'];?>"><?php echo $row['NAME'];?></a></li>
            <?php 
            
        }
        ?>
        </ul>
        <?php 
        if (!empty($_GET['typez'])){
            $sql = $connection->query("SELECT * FROM b_easyform WHERE DATE_CREATE > '2024-06-12 10:00:00' AND NAME = '".$_GET['typez']."'");
        
        echo "<table cellpadding='2' cellspacing='2' border='1'>";
        
        while ($row = $sql->Fetch()){
            echo "<tr>";
            echo "<td>".$row['NAME']."</td>";
            $fc = mb_strpos($row['FIELDS'],'{');
            $sc = mb_strpos($row['FIELDS'],'}');
            
            $str = mb_substr($row['FIELDS'],$fc+1,$sc);
            
            $arr = explode(";", $str);
            
            foreach ($arr as $item){
                echo "<td>";
                echo str_replace('"','',mb_substr($item,mb_strpos($item,'"'),mb_strpos($item,'"',-1)));
                echo "</td>";
            }
            
            echo "</tr>";
        }
        echo "</table>";
        }
            
        /*echo "<pre>";
            print_r($result);
        echo "</pre>";*/
        
        
        /*
        echo "<table cellpadding='3' cellspacing='3' border:1px green solid;>";
            
             $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'ACTIVE'=>'Y',  array(
                 "LOGIC" => "AND",
                 ">CATALOG_QUANTITY" => 0, ">CATALOG_PRICE_2" => 0 ), 'CATALOG_GROUP_ID' => 2], false);
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                
                echo "<tr>";
                echo "<td align='left'>";
                echo "<div>".$i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME']." // ".$ar_result_in['CATALOG_PRICE_2']." // ".$ar_result_in['CATALOG_QUANTITY']."</div>";
                echo "</td>";
                echo "</tr>";
                if ($i > 4828){
                $upd = CIBlockElement::SetPropertyValuesEx(
                    $ar_result_in['ID'],
                    18,
                    array('STORAGE' => $ar_result_in['CATALOG_QUANTITY'])
                    );
                }
                $i++;
            }
        echo "</table>";*/
    }
}
	?>

