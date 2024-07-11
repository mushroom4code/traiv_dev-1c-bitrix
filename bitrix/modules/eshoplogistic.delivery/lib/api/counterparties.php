<?
namespace Eshoplogistic\Delivery\Api;

use \Eshoplogistic\Delivery\Helpers\Client;


class Counterparties
{

    /**
     * @param string $service
     * @return Client
     */
    private static function getHttpClient()
    {
        $apiObject = 'service/counterparties';

        $httpClient = new Client($apiObject);
        return $httpClient;
    }


    public static function sendExport($data = '')
    {
        $httpMethod = 'POST';
        $requestData['service'] = $data;
        $httpClient = self::getHttpClient();
        $deliveryRequest = $httpClient->request($httpMethod, $requestData);
        return $deliveryRequest;
    }

}
?>