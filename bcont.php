<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("bcont");
die;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        //die;
        echo "<table border='1' aling='left'>";
        
        $row = 1;
        if (($handle = fopen("bcont.csv", "r")) !== FALSE) {
            $i = 1;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                $row++;
                
               for ($c=0; $c < $num; $c++) {
                  // echo  iconv('windows-1251','utf-8',$data[$c]);
                   
                   $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
                   preg_match_all($pattern, iconv('windows-1251','utf-8',$data[$c]), $matches);
                   
                   
                   if (count($matches[0]) > 0) {
                   /*echo "<pre>";
                   print_r($matches[0]);
                   echo "</pre>";*/
                       
                       foreach($matches[0] as $key=>$val) {
                           echo $val;
                           echo "<br>";
                       }
                       
                   }
                   
                   /*if (count($matches[0]) > 0) {
                       foreach($matches[0] as $key=>$val) {
                           $mail = $val;
                           //echo "<br>";
                       }
                   }*/
                  // echo "<br>";
               /*
                    /*if ($c == 0)
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
                    }*/
                }
                $i++;
                
                
               /* if (!empty($val)){
                echo "<tr>";
                echo "<td style='text-align:left;'>".$val."</td>";
                echo "<td style='width:100%;'></td>";
                echo "</tr>";
                }*/
                //die;
                
                //unset($val);
                //die;
            }
            fclose($handle);
        }
        
        echo "</table>";
        
    }
}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

