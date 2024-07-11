<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
die;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        echo "<table border='1' aling='left'>";
        
        $row = 1;
        if (($handle = fopen("art_test.csv", "r")) !== FALSE) {
            $i = 1;
            
            if(isset($_GET['ftell'])){
                fseek($handle,$_GET['ftell']);
            }
            $j=0;
            if(isset($_GET['x'])){
                $x=$_GET['x'];
            } else {
                $x = 0;
            }
            
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                $row++;
                
                
                for ($c=0; $c < $num; $c++) {
                    if ($c == 0)
                    {
                        $code = $data[$c];
                        $code = iconv('windows-1251','utf-8',$code);
                    }
                    elseif ($c == 1)
                    {
                        $name = $data[$c];
                        $name = iconv('windows-1251','utf-8',$name);
                    }
                    elseif ($c == 2)
                    {
                        $art = $data[$c];
                    }
                }
                $i++;
                
                
                
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td style='text-align:left;'>".$code."</td>";
                echo "<td style='text-align:left;'>".$name."</td>";
                
                echo "<td>";
                
                // $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","Traits");
                
                $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, /*'NAME' => "DIN 3060 Трос мягкий 7X19 А4 14 мм",*/"PROPERTY_CML2_TRAITS" => $code, 'ACTIVE'=>'Y'], false, false);
                
                
                while($ar_result_in = $db_list_in->GetNext())
                {
                    /*echo "<pre>";
                     print_r($ar_result_in);
                     echo "</pre>";*/
                    
                    $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"CML2_ARTICLE"));
                    while ($ob = $res->GetNext()) {
                      //  CIBlockElement::SetPropertyValuesEx($ar_result_in['ID'], 18, array("CML2_ARTICLE" => $art));
                    }
                    
                }
                
                echo "</td>";
                echo "<td>".$art."</td>";
                echo "</tr>";
                
                unset($code);
                unset($name);
                unset($art);
                
                /*if(!strstr($j/5000,'.')){
                    print 'Importing record #: '.$x.'<br />';
                    flush();
                    ob_flush();
                }*/
                
                if($j==200){
                    print '<meta http-equiv="Refresh" content="0; url='.$_SERVER['PHP_SELF'].'?x='.$x.'&amp;ftell='.ftell($handle).'">';
                    exit;
                }
                $x++;
                $j++;
                
            }
            fclose($handle);
        }
        
        echo "</table>";
        
    }
}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

