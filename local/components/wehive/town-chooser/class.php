<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }

    use Bitrix\Main\Localization\Loc as Loc;

    class CCityChooser extends CBitrixComponent
    {
        /**
         * кешируемые ключи arResult
         * @var array()
         */
        protected $cacheKeys = array();

        /**
         * дополнительные параметры, от которых должен зависеть кеш
         * @var array
         */
        protected $cacheAddon = array();

        /**
         * парамтеры постраничной навигации
         * @var array
         */
        protected $navParams = array();

        /**
         * подключает языковые файлы
         */
        public function onIncludeComponentLang() {
            $this->includeComponentLang(basename(__FILE__));
            Loc::loadMessages(__FILE__);
        }

        /**
         * подготавливает входные параметры
         * @param array $arParams
         * @return array
         */
        public function onPrepareComponentParams($params) {
            $result = array(
                'CACHE_TIME' => intval($params['CACHE_TIME']) > 0 ? intval($params['CACHE_TIME']) : 3600
            );

            return $result;
        }

        /**
         * определяет читать данные из кеша или нет
         * @return bool
         */
        protected function readDataFromCache() {
            if ($this->arParams['CACHE_TYPE'] == 'N') {
                return false;
            }

            return !($this->StartResultCache(false, $this->cacheAddon));
        }

        /**
         * кеширует ключи массива arResult
         */
        protected function putDataToCache() {
            if (is_array($this->cacheKeys) && sizeof($this->cacheKeys) > 0) {
                $this->SetResultCacheKeys($this->cacheKeys);
            }
        }

        /**
         * прерывает кеширование
         */
        protected function abortDataCache() {
            $this->AbortResultCache();
        }

        /**
         * проверяет подключение необходиимых модулей
         * @throws LoaderException
         */
        protected function checkModules() {

        }

        /**
         * проверяет заполнение обязательных параметров
         * @throws SystemException
         */
        protected function checkParams() {

        }

        /**
         * выполяет действия перед кешированием
         */
        protected function executeProlog() {

        }

        /**
         * получение результатов
         */
        protected function getResult() {

            $cityObj = new CCity();
            $this->arResult = $cityObj->GetFullInfo();

        }

        /**
         * выполняет действия после выполения компонента, например установка заголовков из кеша
         */
        protected function executeEpilog() {

        }

        /**
         * выполняет логику работы компонента
         */
        public function executeComponent() {
            try {
                $this->checkModules();
                $this->checkParams();
                $this->executeProlog();
                if (!$this->readDataFromCache()) {
                    $this->getResult();
                    $this->putDataToCache();
                    $this->includeComponentTemplate();
                }
                $this->executeEpilog();
            } catch (Exception $e) {
                $this->abortDataCache();
                ShowError($e->getMessage());
            }
        }
    }