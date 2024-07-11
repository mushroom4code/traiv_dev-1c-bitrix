<?php
namespace Ipol\AliExpress\Api;

use Bitrix\Main\Config\Option;
use Bitrix\Main\SystemException;
use Bitrix\Main\Data\Cache;

class Client
{
    const APP_KEY    = '28808676';
    const APP_SECRET = '492a3f3f25991d2c79b5879f9eccd7a0';

    // const BASE_URL = 'https://stg.ae-rus.ru/logistic-platform-api-isv';
    const BASE_URL = 'https://api-dev.ae-rus.ru/logistic-platform/logistic-platform-api-isv/';
    /**
     * @var self
     */
    protected static $Instance;

    /**
     * @var array
     */
    protected static $ClassMap = [
        'order'     => Service\Order::class,
        'order-old' => Service\OrderOld::class,
        'logistic'  => Service\Logistic::class,
        'address'   => Service\Address::class,
        'solutions' => Service\Solutions::class,
        'logisticresources' => Service\LogisticResources::class,
    ];

    

    /**
     * @var string
     */
    protected $sessionKey = '';

    public static function getInstance($authType = false)
    {
        $authType = $authType ?: Option::get(IPOLH_ALI_MODULE, 'AUTH_TYPE', 'SIMPLE');

        $appKey    = static::APP_KEY;
        $appSecret = static::APP_SECRET;
        $appToken  = Option::get(IPOLH_ALI_MODULE, 'APP_ACCESS_TOKEN', '');

        if ($authType == 'CUSTOM') {
            $appKey    = Option::get(IPOLH_ALI_MODULE, 'APP_KEY', '');
            $appSecret = Option::get(IPOLH_ALI_MODULE, 'APP_SECRET_KEY', '');
            $appToken  = json_encode([
                'access_token' => Option::get(IPOLH_ALI_MODULE, 'APP_SESSION_KEY', ''),
                'expire_time'  => (time() + (365 * 86400)) * 1000,
            ]);
        }

        return static::$Instance[$authType] ?? static::$Instance[$authType] = new static(
            $appKey,
            $appSecret,
            $appToken,
            Option::get(IPOLH_ALI_MODULE, 'APP_ACCESS_TOKEN_NEW', '')
        );
    }

    /**
     * Конструктор класса
     *
     * @param string           $appKey
     * @param string           $secretKey
     * @param jsonString|array $accessToken
     */
    public function __construct($appKey, $secretKey, $accessToken, $localApiAccessToken)
    {
        $this->setLocalAccessToken($localApiAccessToken);
    }

    /**
     * Возвращает конкретную службу по работе с API
     *
     * @param string $service
     * 
     * @return Service\*
     */
    public function getService($service)
    {
        static $services = [];

        if (array_key_exists($service, $services)) {
            return $services[$service];
        }

        if (array_key_exists($service, static::$ClassMap)) {
            return $services[$service] = new static::$ClassMap[$service]($this);
        }

        throw new SystemException('Service "'. $service .'" not found');
    }

    /**
     * Возвращает ключ приложения
     *
     * @return string
     */
    // public function getAppKey()
    // {
    //     return $this->client->appkey;
    // }

    /**
     * Устанавливает ключ приложения
     *
     * @param string $appKey
     * 
     * @return self
     */
    // public function setAppKey($appKey)
    // {
    //     $this->client->appkey = $appKey;

    //     return $this;
    // }

    /**
     * Возвращает ключ приложения
     *
     * @return string
     */
    // public function getSecretKey()
    // {
    //     return $this->client->secretKey;
    // }

    /**
     * Устанавливает ключ приложения
     *
     * @param string $secretKey
     * 
     * @return self
     */
    // public function setSecretKey($secretKey)
    // {
    //     $this->client->secretKey = $secretKey;

    //     return $this;
    // }

    /**
     * Возвращает ключ доступа
     *
     * @return string
     */
    // public function getAccessToken()
    // {
    //     return $this->accessToken;   
    // }

    // /**
    //  * Устанавливает ключ сессии
    //  *
    //  * @param jsonString|array $accessToken
    //  * 
    //  * @return self
    //  */
    // public function setAccessToken($accessToken)
    // {
    //     $this->accessToken = is_string($accessToken) ? json_decode($accessToken, true) : $accessToken;

    //     return $this;
    // }

    public function setLocalAccessToken($accessToken)
    {
        $this->localAccessToken = $accessToken;
    }

    public function getLocalAccessToken()
    {
        return $this->localAccessToken;
    }

    /**
     * Возвращает сессионный ключ
     *
     * @return null|string
     */
    // public function getSessionKey()
    // {
    //     if (!$this->isAuthorized()) {
    //         return null;
    //     }

    //     $data = $this->getAccessToken();

    //     return $data['access_token'];
    // }

    /**
     * Возвращает время окончания авторизации
     *
     * @return void
     */
    // public function getExpireTimeAuthorize()
    // {
    //     $data = $this->getAccessToken();

    //     if (empty($data)) {
    //         return null;
    //     }

    //     return round($data['expire_time'] / 1000);
    // }

    /**
     * Возвращает ссылку на начало авторизации
     *
     * @return string
     */
    // public function getAuthorizeLink($local = false)
    // {
    //     if ($local) {
    //         return 'https://ipol.ru/webService/aliexpress/oauth.php';
    //     }

    //     return 'https://oauth.aliexpress.com/authorize?'. http_build_query([
    //         'response_type' => 'code',
    //         'client_id'     => $this->getAppKey(),
    //         'redirect_uri'  => $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'] .'/bitrix/js/ipol.aliexpress/oauth.php',
    //         'state'         => '1212',
    //         'view'          => 'web',
    //         'sp'            => 'ae',
    //     ]);
    // }

    // public function getLogoutLink()
    // {
    //     return '/bitrix/js/ipol.aliexpress/oauth.php?'. http_build_query([
    //         'action' => 'logout',
    //     ]);
    // }

    /**
     * Получает access token после авторизации
     *
     * @param string $code
     * 
     * @return jsonString
     */
    // public function obtainAccessToken($code)
    // {
    //     $url  = 'https://oauth.aliexpress.com/token';
    //     $data = http_build_query([
    //         'client_id'     => $this->getAppKey(),
    //         'client_secret' => $this->getSecretKey(),
    //         'code'          => $code,
    //         'grant_type'    => 'authorization_code',
    //         'sp'            => 'ae',
    //         'redirect_uri'  => 'http://www.oauth.net/2/', 
    //     ]);

    //     $context = stream_context_create(array(
    //         'http' => array(
    //             'method' => 'POST',
    //             'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
    //             'content' => $data,
    //         ),
    //     ));

    //     return file_get_contents($url, $use_include_path = false, $context);
    // }

    /**
     * Проверяет была ли выполнена авторизация OAuth
     *
     * @return boolean
     */
    public function isAuthorized($checkTokenLifeTime = true)
    {
        return !!$this->getLocalAccessToken();
        
        // $data = $this->getAccessToken();

        // if (empty($data)) {
        //     return false;
        // }

        // if (!is_array($data)
        //     || empty($data['access_token'])
        //     || empty($data['expire_time'])
        //     || ($checkTokenLifeTime && $this->getExpireTimeAuthorize() < time())
        // ) {
        //     return false;
        // }

        // return true;
    }

    public function isDeveloperMode()
    {
        return false;

        // return $this->getAppKey() != self::APP_KEY;
    }

    /**
     * @deprecated version
     *
     * @return mixed
     */
    public function doRequest(array $params, $cacheTTL = 0)
    {
        return json_encode($this->executeJson($params, $cacheTTL));
    }


    /**
     * Выполняет запрос к новому API
     *
     * @param array $params
     * @param integer $cacheTTL
     * @return mixed
     */
    public function executeJson(array $params, $cacheTTL = 0)
    {
        if ($cacheTTL != 0) {
            $cacheId   = md5(serialize($params));
            $cachePath = '/' . IPOLH_ALI_MODULE . '/api/';

            if ($this->cache()->initCache($cacheTTL, $cacheId, $cachePath)) {
                return json_decode($this->cache()->GetVars(), true);
            }
        }

        // $settings = $this->getAccessToken();
        $headers = array(
            'Content-Type: application/json',
            // 'App-Key: '.static::APP_KEY,
            // 'App-Secret: '.static::APP_SECRET,
            // 'Auth-Session: '. $settings['access_token'],
            'X-Auth-Token: '. $this->getLocalAccessToken()
        );

        $ch  = curl_init();
        $url = ($params['url'] ?: static::BASE_URL) . $params['method'];

        if ($params['type'] == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array_merge($params['query'], [
                'locale' => 'ru_RU'
            ])));
        } else {
            $url .= '?'. http_build_query($params['query']);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
            $error = 'Failed to request service';
            $data  = json_decode($response, true);

            if (isset($data['error']) && is_string($data['error'])) {
                $error = $data['error'];
            }

            throw new SystemException($error);
        }

        curl_close($ch);

        if ($this->cache()->startDataCache() && $cacheTTL != 0) {
            $this->cache()->endDataCache($response);
        }

        return json_decode($response, true);
    }

    /**
     * Выполняет запрос к API
     *
     * @param mixed $request
     * 
     * @return mixed
     */
    // public function execute($request, $cacheTTL = 0)
    // {
    //     if (!$this->isAuthorized()) {
    //         throw new SystemException('You need authorize in AliExpress Service. Go to module settings for execute authorize.');
    //     }

    //     $cacheId   = serialize($request);
    //     $cachePath = '/'. IPOLH_ALI_MODULE .'/api/';

    //     if ($this->cache()->initCache($cacheTTL, $cacheId, $cachePath)) {
    //         return $this->cache()->GetVars();
    //     }

    //     $ret = $this->client->execute($request, $this->getSessionKey());

    //     if ($this->cache()->startDataCache()) {
    //         $this->cache()->endDataCache($ret);
    //     }

    //     return $ret;
    // }

    /**
	 * Возвращает инстанс кэша
	 * 
	 * @return \Bitrix\Main\Data\Cache
	 */
	protected function cache()
	{
		return $this->cache ?: $this->cache = Cache::createInstance();
	}
}