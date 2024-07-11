<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
die;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        
        function get_redirect($from_link,$to_link) {
            //print_r( $from_link );
            $from_link_array = explode(",", $from_link['0']);
           // print_r($from_link_array);
            $from_link_array_str = str_replace('"','',$from_link_array['2']);
            
            $pos = strpos($from_link_array_str, 'filter');
            $pos1 = strpos($from_link_array_str, 'basket');
          
            if ( $pos === false && $pos1 === false && !strpos(file_get_contents("redirect_search1.txt"), $from_link_array_str) ) {
                //return "rewrite ".$from_link_array_str."  https://traiv-komplekt.ru".$to_link." permanent;";
             //   return "https://traiv-komplekt.ru".$from_link_array_str;
            }
            
            
        }
        
        //die;
        echo "<table border='1' aling='left'>";
        
        $row = 1;
        if (($handle = fopen("redirect2_edit.csv", "r")) !== FALSE) {
            $i = 1;
            $pro = ",,,";
            $arr_pro = array();
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                $row++;
                
                if ($data[0] !== $pro){
                    $arr_pro[] = $data;
                }
                else {
                    $num_arr_pro = count($arr_pro);
                    $to_link = $arr_pro['1']['0'];
                    $to_link_array = explode(",", $to_link);
                    $to_link_array_str = str_replace('"','',$to_link_array['2']);
                    
                    for ($r=2; $r < $num_arr_pro; $r++) {
                        
                        
                        
                        echo get_redirect($arr_pro[$r],$to_link_array_str);
                        echo "<br>";
                    }
                    
                   /* echo "<pre>";
                    print_r($arr_pro);
                    echo "</pre>";*/
                    //echo "<br>";
                    
                    $arr_pro = array();
                }
                
                
                /*for ($c=0; $c < $num; $c++) {
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
                }*/
                $i++;
                
                
                
                /*echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td style='text-align:left;'>".$code."</td>";
                echo "<td style='text-align:left;'>".$name."</td>";
                echo "<td>";*/
            }
            fclose($handle);
        }
        
        echo "</table>";
        
    }
}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

