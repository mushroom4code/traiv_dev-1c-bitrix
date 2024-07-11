<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
die;
?>

<?
/*установка галки Выгружать на yandex маркет*/

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {

        function getCorrectedString(string $inputText): string {
            $resultText = $inputText;
            $curlContent = getUrlContent(
                'http://speller.yandex.net/services/spellservice.json/checkTexts',
                [
                    'text' => $inputText,
                    'lang' => 'ru'
                ],
                [
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_CONNECTTIMEOUT => 10
                ]
                );
            
            if (
                isset($curlContent['result'])
                && !empty($curlContent['result'])
                ) {
                   
                    
                    
                    $spellResult = current(
                        json_decode($curlContent['result'])
                        );
                    
                    $correctionMap = [];
                    foreach ($spellResult as $correction) {
                        $correctionMap[$correction->word] = current($correction->s);
                    }
                    
                    foreach($spellResult as $repl){
                        if (current($repl->s) != false) {
                        $resultText = str_replace($repl->word, "<span style='background-color:yellow;padding:2px 5px;'>".$repl->word." (".current($repl->s).")</span>", $resultText);
                        }
                    }                    
                }
                return $resultText;
        }
        
        function mb_substr_replace($original, $replacement, $position, $length)
        {
            $startString = mb_substr($original, 0, $position, "UTF-8");
            $endString = mb_substr($original, $position + $length, mb_strlen($original), "UTF-8");
            
            $out = $startString . $replacement . $endString;
            
            return $out;
        }

        function getUrlContent(
            string $url, array $postData = [], array $optionsList = []
            ) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, $url);
                if (!empty($postData)) {
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
                }
                if (!empty($optionsList)) {
                    foreach ($optionsList as $optionKey => $optionValue) {
                        curl_setopt($curl, $optionKey, $optionValue);
                    }
                }
                $result = [
                    'result' => curl_exec($curl),
                    'errno' => curl_errno($curl),
                    'error' => curl_error($curl),
                    'http_code' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
                ];
                curl_close($curl);
                return $result;
        }
        

        $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL","DETAIL_PAGE_URL","DETAIL_TEXT");
        $arSort = array('NAME'=>'ASC');
        $arFilter = array('IBLOCK_ID'=>"7","ID"=>"239461");
        
        $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
        
        if ( $res->SelectedRowsCount() > 0 ){
            while($arrob = $res->GetNext()) {
            
                $responseText = getCorrectedString($arrob['DETAIL_TEXT']);
                echo $responseText;
            }
        }
        
        
    }
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
	?>

