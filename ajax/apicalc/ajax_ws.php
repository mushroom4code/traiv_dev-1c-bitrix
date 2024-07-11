<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?php
if (!empty($_POST['action'])){
    
    if ( $USER->IsAuthorized() )
    {
        if ($USER->GetID() == '3092') {
            $headers = array(
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode("ttt@ttt.ru:11111111")
            );
        }
        else {
            $headers = array(
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode("ttt@ttt.ru:11111111")
            );
        }
    }
    else
    {
        $headers = array(
            'Content-Type:application/json',
            'Authorization: Basic '. base64_encode("ttt@ttt.ru:11111111")
        );
    }
    
    /*if($_POST['action'] == 'run'){
    
    $apiUrl = 'https://api.traiv-pro.com/v1/calc/metizlist';
    $postVars = array(
        'name' => $_POST['nomen']
    );
    
    $serve = curl_init();
    
    curl_setopt( $serve, CURLOPT_URL, $apiUrl);
    curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $serve, CURLOPT_POST, 1);
    curl_setopt($serve, CURLOPT_POSTFIELDS, json_encode($postVars));
    curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt( $serve, CURLOPT_HEADER, 1);
    curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($serve);
    $parseResponse = curl_exec( $serve );
    
    if (!curl_errno($serve)) {
        switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
            case 200:  echo $data = json_decode($parseResponse, TRUE);
                break;
            default:
                //echo 'Доступ запрещен: ', $http_code, "\n";
                echo '{"error": "Доступ запрещен"}';
        }
    }
    curl_close($serve);
    }*/
    
    /*standart*/
    
    if($_POST['action'] == 'run'){
        
        $apiUrl = 'https://api.traiv-pro.com/v1/calc/standartlist';
        /*$postVars = array(
            'metizId' => $_POST['metizId']
        );*/
        
        $serve = curl_init();
        
        curl_setopt( $serve, CURLOPT_URL, $apiUrl);
        curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $serve, CURLOPT_POST, 1);
        curl_setopt( $serve, CURLOPT_POSTFIELDS, json_encode($postVars));
        curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt( $serve, CURLOPT_HEADER, 1);
        curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($serve);
        $parseResponse = curl_exec( $serve );
        
        if (!curl_errno($serve)) {
            switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
                case 200:  echo $data = json_decode($parseResponse, TRUE);
                break;
                default:
                    //echo 'Доступ запрещен: ', $http_code, "\n";
                    echo '{"error": "Доступ запрещен1"}';
            }
        }
        curl_close($serve);
    }
    
    if($_POST['action'] == 'getDiametr'){
        
        $apiUrl = 'https://api.traiv-pro.com/v1/calc/diametrlist';
        $postVars = array(
            'standartId' => $_POST['standartId']
        );
        
        $serve = curl_init();
        
        curl_setopt( $serve, CURLOPT_URL, $apiUrl);
        curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $serve, CURLOPT_POST, 1);
        curl_setopt( $serve, CURLOPT_POSTFIELDS, json_encode($postVars));
        curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt( $serve, CURLOPT_HEADER, 1);
        curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($serve);
        $parseResponse = curl_exec( $serve );
        
        if (!curl_errno($serve)) {
            switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
                case 200:  echo $data = json_decode($parseResponse, TRUE);
                break;
                default:
                    //echo 'Доступ запрещен: ', $http_code, "\n";
                    echo '{"error": "Доступ запрещен1"}';
            }
        }
        curl_close($serve);
    }
    
    if($_POST['action'] == 'getDlina'){
        
        $apiUrl = 'https://api.traiv-pro.com/v1/calc/dlinalist';
        $postVars = array(
            'standartId' => $_POST['standartId'],
            'diametrId' => $_POST['diametrId']
        );
        
        $serve = curl_init();
        
        curl_setopt( $serve, CURLOPT_URL, $apiUrl);
        curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $serve, CURLOPT_POST, 1);
        curl_setopt( $serve, CURLOPT_POSTFIELDS, json_encode($postVars));
        curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt( $serve, CURLOPT_HEADER, 1);
        curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($serve);
        $parseResponse = curl_exec( $serve );
        
        if (!curl_errno($serve)) {
            switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
                case 200:  echo $data = json_decode($parseResponse, TRUE);
                break;
                default:
                    //echo 'Доступ запрещен: ', $http_code, "\n";
                    echo '{"error": "Доступ запрещен1"}';
            }
        }
        curl_close($serve);
    }
    
    if($_POST['action'] == 'getMaterial'){
        
        $apiUrl = 'https://api.traiv-pro.com/v1/calc/materiallist';
        $postVars = array(
            'metizId' => $_POST['metizId'],
            'standartId' => $_POST['standartId'],
            'diametrId' => $_POST['diametrId'],
            'dlinaId' => $_POST['dlinaId']
        );
        
        $serve = curl_init();
        
        curl_setopt( $serve, CURLOPT_URL, $apiUrl);
        curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $serve, CURLOPT_POST, 1);
        curl_setopt( $serve, CURLOPT_POSTFIELDS, json_encode($postVars));
        curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt( $serve, CURLOPT_HEADER, 1);
        curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($serve);
        $parseResponse = curl_exec( $serve );
        
        if (!curl_errno($serve)) {
            switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
                case 200:  echo $data = json_decode($parseResponse, TRUE);
                break;
                default:
                    //echo 'Доступ запрещен: ', $http_code, "\n";
                    echo '{"error": "Доступ запрещен1"}';
            }
        }
        curl_close($serve);
    }
    
    if($_POST['action'] == 'getValue'){
        
        $apiUrl = 'https://api.traiv-pro.com/v1/calc/resultvalue';
        $postVars = array(
            'metizId' => $_POST['metizId'],
            'standartId' => $_POST['standartId'],
            'diametrId' => $_POST['diametrId'],
            'dlinaId' => $_POST['dlinaId'],
            'materialId' => $_POST['materialId']
        );
        
        $serve = curl_init();
        
        curl_setopt( $serve, CURLOPT_URL, $apiUrl);
        curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $serve, CURLOPT_POST, 1);
        curl_setopt( $serve, CURLOPT_POSTFIELDS, json_encode($postVars));
        curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt( $serve, CURLOPT_HEADER, 1);
        curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($serve);
        $parseResponse = curl_exec( $serve );
        
        if (!curl_errno($serve)) {
            switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
                case 200:  echo $data = json_decode($parseResponse, TRUE);
                break;
                default:
                    //echo 'Доступ запрещен: ', $http_code, "\n";
                    echo '{"error": "Доступ запрещен1"}';
            }
        }
        curl_close($serve);
    }
    
}
?>