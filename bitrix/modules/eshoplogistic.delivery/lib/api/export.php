<?
namespace Eshoplogistic\Delivery\Api;

use \Eshoplogistic\Delivery\Helpers\Client;


class Export
{

    /**
     * @param string $service
     * @return Client
     */
    private static function getHttpClient()
    {
        $apiObject = 'delivery/order';

        $httpClient = new Client($apiObject);
        return $httpClient;
    }


    public static function sendExport($data)
    {
        $httpMethod = 'POST';
        $requestData = $data;
        $httpClient = self::getHttpClient();
        $deliveryRequest = $httpClient->request($httpMethod, $requestData);
        return $deliveryRequest;
    }

}
?>