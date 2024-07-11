<?
$MESS["ipol.aliexpress_OPTIONS_TAB_AUTH"]               = "Авторизация";
$MESS["ipol.aliexpress_OPTIONS_TAB_AUTH_HELP"]          = "Для регистрация магазина на Aliexpress перейдите <a href='https://seller.aliexpress.ru/#/registration?utm_medium=banner&utm_source=cms&utm_campaign=1c'>по ссылке</a>";
$MESS["ipol.aliexpress_OPTIONS_TAB_COMMON_TITLE"]       = "Основные настройки авторизации AliExpress";
$MESS["ipol.aliexpress_OPTIONS_TAB_COMMON_"]            = "";
$MESS["ipol.aliexpress_OPTIONS_AUTH_TITLE"]             = "Токен авторизации";
$MESS["ipol.aliexpress_OPTIONS_IS_TEST"]                = "Тестовый режим";
$MESS["ipol.aliexpress_OPTIONS_IS_TEST_HELP"]           = "При установленном флаге все обращения будут направляться на тестовый сервер. В связи с этим полученные значения при расчетах будут отличаться от реальных данных.";
$MESS['ipol.aliexpress_OPTIONS_APP_KEY_TITLE']          = 'Ключ приложения';
$MESS['ipol.aliexpress_OPTIONS_APP_KEY_HELP']           = '';
$MESS['ipol.aliexpress_OPTIONS_APP_KEY_ERROR_EMPTY']    = 'Укажите ключ приложения';
$MESS['ipol.aliexpress_OPTIONS_APP_SECRET_TITLE']       = 'Секретный ключ';
$MESS['ipol.aliexpress_OPTIONS_APP_SECRET_HELP']        = '';
$MESS['ipol.aliexpress_OPTIONS_APP_SECRET_ERROR_EMPTY'] = 'Укажите секретный ключ';

$MESS["ipol.aliexpress_OPTIONS_TAB_EXPORT"]       = "Экспорт товаров";
$MESS["ipol.aliexpress_OPTIONS_TAB_EXPORT_TITLE"] = "Загрузка каталога товаров на AliExpress";
$MESS["ipol.aliexpress_OPTIONS_TAB_EXPORT_HELP"]  = "";

$MESS["ipol.aliexpress_OPTIONS_EXPORT_HEADER_TITLE"]  = "Профиль выгрузки";
$MESS["ipol.aliexpress_OPTIONS_EXPORT_HEADER_HELP"]   = "";
$MESS["ipol.aliexpress_OPTIONS_EXPORT_DESC"]          = '
    Перед тем, как настроить экспорт товаров, вам необходимо выполнить следующие настройки в личном кабинете Aliexpress:<br>
    (При необходимости, вы можете посмотреть обучающее видео, расположенное внизу страницы)

    <ol>
        <li style="padding: 5px 0;">
            Настроить шаблон доставки<br>
            <a href="https://gsp.aliexpress.com/apps/shipping/add?spm=5261.shipping_template_list.btnCreateTemplate.1.6e3b3e5fabEVa0&freightTemplateId=" target="_blank">Начать настройку</a>
        </li>

        <li style="padding: 5px 0;">
            Подать запрос на бренды, товары которых вы планируете загрузить<br>
            <a href="https://sellerjoin.aliexpress.com/oversea/getBrandList.htm" target="_blank">Подать запрос</a>
        
        </li>
    </ol>

    Теперь вы можете настроить файл и загрузить его на платформу:
    
    <ol>
        <li style="padding: 5px 0;">
            Создать профиль для XML файла<br>
            <a href="/bitrix/admin/cat_export_setup.php?lang=ru&ACT_FILE=ipol_aliexpress&ACTION=EXPORT_SETUP&sessid=50cef500dd20f785f22c2bbdcdf0b7ab">Перейти к созданию профиля выгрузки</a>
        </li>

        <li style="padding: 5px 0;">
            Загрузить файл на платформу<br>
            <a href="https://seller.aliexpress.ru/operations/yml" target="_blank">Начать загрузку</a>
        </li>

        <li style="padding: 5px 0;">
            <a href="https://ipol.ru/development/modul-integratsii-1s-bitriks-dlya-aliexpress/" target="_blank">Подробная инструкция по настройке модуля и FAQ</a>
        </li>
    </ol>
';

$MESS["ipol.aliexpress_OPTIONS_EXPORT_DESC_B"] = '
    Чтобы сгенерировать XML файл, необходимо создать профиль экспорта данных. Для
    создания профиля, перейдите в раздел Экспорт данных, выберите вариант профиля
    Профиль <b>ipol_aliexpress</b><br><br><br>
';

$MESS["ipol.aliexpress_OPTIONS_EXPORT_ADD_PROFILE"] = 'Добавить профиль';
$MESS["ipol.aliexpress_OPTIONS_EXPORT_NAME_PROFILE"] = 'Наименование профиля';
$MESS["ipol.aliexpress_OPTIONS_EXPORT_FILE_PROFILE"] = 'Файл';
$MESS["ipol.aliexpress_OPTIONS_EXPORT_USED_PROFILE"] = 'Использован';
$MESS["ipol.aliexpress_OPTIONS_EXPORT_AGENT_PROFILE"] = 'Агент';

$MESS["ipol.aliexpress_OPTIONS_IMPORT_HEADER_TITLE"]  = "Обучающие видео";
$MESS["ipol.aliexpress_OPTIONS_IMPORT_HEADER_HELP"]   = "";
$MESS["ipol.aliexpress_OPTIONS_IMPORT_DESC"]          = '
    <iframe allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" style="width: 100%; max-width: 600px; height: 300px" class="video_iframe" frameborder="0" src="https://www.youtube.com/embed/zvziWbepDZk"></iframe>
    
    <br><br>

    <ul class="text">
        <li><a href="https://sell.aliexpress.com/Shipping_Template.htm" target="_blank">Как настроить шаблон доставки</a></li>
        
        <li><a href="https://sell.aliexpress.com/HELPTmall_add_brand_category_new.htm" target="_blank">Как работать с брендами?</a></li>
        
        <li><a href="https://sell.aliexpress.com/ru/__pc/YML_AE_Assistant.htm?spm=5261.ams_91602.SellerCenter.9.46e234132lOJdA" target="_blank">Как загрузить товары через YML</a></li>
    </ul>
';

$MESS['ipol.aliexpress_OPTIONS_TAB_ORDER'] = 'Импорт заказов';
$MESS['ipol.aliexpress_OPTIONS_TAB_ORDER_TITLE'] = 'Импорт заказов';
$MESS['ipol.aliexpress_OPTIONS_TAB_ORDER_HELP']  = '
    Для импорта заказов с AliExpress необходимо указать сайт, от имени которого будут создаваться заказы, а так же
    сопоставить свойства заказов Вашего ИМ к свойствам заказов AliExpress.
';

$MESS['ipol.aliexpress_OPTIONS_ORDER_USER_ID_TITLE'] = 'ID пользователя';
$MESS['ipol.aliexpress_OPTIONS_ORDER_USER_ID_HELP']  = 'Укажите пользователя от имени которого будут создаваться заказы в системе';

$MESS['ipol.aliexpress_OPTIONS_ORDER_SITE_ID_TITLE']                = 'Сайт';
$MESS['ipol.aliexpress_OPTIONS_ORDER_SITE_ID_HELP']                 = 'Выберите сайт для которого будут создаваться новые заказы';
$MESS['ipol.aliexpress_OPTIONS_ORDER_PERSON_TYPE_ID_TITLE']         = 'Тип плательщика';
$MESS['ipol.aliexpress_OPTIONS_ORDER_PERSON_TYPE_ID_HELP']          = 'Выберите тип плательщика от которого будут создаваться новые заказы';
$MESS['ipol.aliexpress_OPTIONS_ORDER_PAYMENT_SYSTEM_ID_TITLE'] = 'Платежная система';
$MESS['ipol.aliexpress_OPTIONS_ORDER_PAYMENT_SYSTEM_ID_HELP']  = 'Выберите платежную систему с которой будут создаваться новые заказы';

$MESS['ipol.aliexpress_OPTIONS_TAB_STATUS']  = 'Статус';
$MESS['ipol.aliexpress_OPTIONS_TAB_STATUS_TITLE']  = 'Статус'; 
$MESS['ipol.aliexpress_STATUS_ORDER_PLACE_ORDER_SUCCESS_TITLE'] = 'Ожидают оплаты'; 
$MESS['ipol.aliexpress_STATUS_ORDER_PLACE_ORDER_SUCCESS_HELP'] = 'заказы, созданные покупателями и находящиеся в процессе оплаты'; 
$MESS['ipol.aliexpress_STATUS_ORDER_IN_CANCEL_TITLE'] = 'Ожидают отмены'; 
$MESS['ipol.aliexpress_STATUS_ORDER_IN_CANCEL_HELP'] = 'покупатель просит отменить заказ и вернуть деньги'; 
$MESS['ipol.aliexpress_STATUS_ORDER_WAIT_SELLER_SEND_GOODS_TITLE'] = 'Ожидают отправки'; 
$MESS['ipol.aliexpress_STATUS_ORDER_WAIT_SELLER_SEND_GOODS_HELP'] = 'покупатель ожидает отправки заказа магазином'; 
$MESS['ipol.aliexpress_STATUS_ORDER_SELLER_PART_SEND_GOODS_TITLE'] = 'Частичная отправка'; 
$MESS['ipol.aliexpress_STATUS_ORDER_SELLER_PART_SEND_GOODS_HELP'] = 'заказы, по которым выполнена частичная отправка заказа'; 
$MESS['ipol.aliexpress_STATUS_ORDER_WAIT_BUYER_ACCEPT_GOODS_TITLE'] = 'Ожидают получения'; 
$MESS['ipol.aliexpress_STATUS_ORDER_WAIT_BUYER_ACCEPT_GOODS_HELP'] = 'заказы которые ожидают подтверждения получения покупателем'; 
$MESS['ipol.aliexpress_STATUS_ORDER_FUND_PROCESSING_TITLE'] = 'Ожидается перевод средств'; 
$MESS['ipol.aliexpress_STATUS_ORDER_FUND_PROCESSING_HELP'] = 'покупатель принял заказ, выполняется перевод стредств магазину'; 
$MESS['ipol.aliexpress_STATUS_ORDER_IN_ISSUE_TITLE'] = 'В состоянии спора'; 
$MESS['ipol.aliexpress_STATUS_ORDER_IN_ISSUE_HELP'] = 'заказы, по которым покупатель открыл спор';
$MESS['ipol.aliexpress_STATUS_ORDER_IN_FROZEN_TITLE'] = 'Заморожен'; 
$MESS['ipol.aliexpress_STATUS_ORDER_IN_FROZEN_HELP'] = ''; 
$MESS['ipol.aliexpress_STATUS_ORDER_WAIT_SELLER_EXAMINE_MONEY_TITLE'] = 'Ожидает подтверждения суммы'; 
$MESS['ipol.aliexpress_STATUS_ORDER_WAIT_SELLER_EXAMINE_MONEY_HELP'] = 'заказы, ожидающие подтвреждение суммы'; 
$MESS['ipol.aliexpress_STATUS_ORDER_RISK_CONTROL_TITLE'] = 'Контроль риска'; 
$MESS['ipol.aliexpress_STATUS_ORDER_RISK_CONTROL_HELP'] = 'Заказы находятся в течение 24 часов на контроле рисков после оплаты покупателем.'; 
$MESS['ipol.aliexpress_STATUS_ORDER_FINISH_TITLE'] = 'Завершен'; 
$MESS['ipol.aliexpress_STATUS_ORDER_FINISH_HELP'] = 'Заказ завершён и подтверждён покупателем'; 
$MESS['ipol.aliexpress_STATUS_ORDER_CANCELLED_TITLE'] = 'Отменен';
$MESS['ipol.aliexpress_STATUS_ORDER_CANCELLED_HELP'] = 'Заказ отменён покупателем или продавцом';
$MESS['ipol.aliexpress_STATUS_ORDER_EMPTY'] = ''; 

$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_ID_TITLE']         = 'ID заказа AliExpress';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_LAST_NAME_TITLE']  = 'Фамилия';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_FIRST_NAME_TITLE'] = 'Имя';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_PHONE_TITLE']      = 'Телефон';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_MOBILE_TITLE']     = 'Мобильный';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_PERSONE_TITLE']    = 'Контактное лицо';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_ZIP_TITLE']        = 'Индекс';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_CITY_TITLE']       = 'Город';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_ADDRESS1_TITLE']   = 'Адрес доставки';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_ADDRESS2_TITLE']   = 'Адрес доставки 2';
$MESS['ipol.aliexpress_OPTIONS_ORDER_FIELD_MEASURE_TITLE']    = 'Ед. измерения';

$MESS['ipol.aliexpress_OPTIONS_TAB_TRACK'] = 'Отправка';
$MESS['ipol.aliexpress_OPTIONS_TAB_TRACK_TITLE'] = 'Отправка';
$MESS['ipol.aliexpress_OPTIONS_TAB_TRACK_HELP'] = '';

$MESS['ipol.aliexpress_NOT_AUTH']                             = '
    <input type="BUTTON" onclick="#CLICK#" class="adm-btn-save ali-btn-auth" value="Авторизоваться"><br><br>
    <!--Для работы модуля требуется выполнить авторизацию в сервисе AliExpress<br>-->
    <!--Для регистрация магазина на Aliexpress перейдите по <a href="https://seller.aliexpress.ru/#/registration?utm_medium=banner&utm_source=cms&utm_campaign=1c">ссылке</a>-->
';

$MESS['ipol.aliexpress_AUTH_DIALOG_TITLE'] = 'Авторизация';
$MESS['ipol.aliexpress_AUTH_DIALOG_HEAD'] = 'Сейчас Вы будете перенаправлены на страницу авторизации AliExpress';

$MESS['ipol.aliexpress_AUTH_OK']                              = '
    Модуль успешно авторизован в сервисе AliExpress.<br>
    Авторизация действительна до #DATE#.
    <br><br>
    <a href="#LOGOUT_LINK#" class="adm-btn-save" style="display: inline-block">выйти</a>
';

$MESS['IPOL_ALI_FORM_SAVE_OK'] = 'Данные сохранены';

$MESS['ipol.aliexpress_DELIVERY_PICKPOINT_RU_PROVINCE_RUB_NAME']    = 'PickPoint';
$MESS['ipol.aliexpress_DELIVERY_PICKPOINT_RU_PROVINCE_RUB_HELP']    = '';
$MESS['ipol.aliexpress_DELIVERY_RUPOST_FIRST_PROVINCE_RUB_NAME']    = 'Почта России 1 класс';
$MESS['ipol.aliexpress_DELIVERY_RUPOST_FIRST_PROVINCE_RUB_HELP']    = '';
$MESS['ipol.aliexpress_DELIVERY_RUSSIAN_POST_RU_PROVINCE_RUB_NAME'] = 'Почта России Посылка Нестандартная';
$MESS['ipol.aliexpress_DELIVERY_RUSSIAN_POST_RU_PROVINCE_RUB_HELP'] = '';
$MESS['ipol.aliexpress_DELIVERY_RUPOST_ONLINE_RUB_NAME']            = 'Почта России Посылка Онлайн';
$MESS['ipol.aliexpress_DELIVERY_RUPOST_ONLINE_RUB_HELP']            = '';
$MESS['ipol.aliexpress_DELIVERY_DPD_RU_PROVINCE_RUB_NAME']          = 'DPD';
$MESS['ipol.aliexpress_DELIVERY_DPD_RU_PROVINCE_RUB_HELP']          = '';
$MESS['ipol.aliexpress_DELIVERY_OTHER_RU_PROVINCE_RUB_NAME']        = 'Доставка продавца';
$MESS['ipol.aliexpress_DELIVERY_OTHER_RU_PROVINCE_RUB_HELP']        = '';
$MESS['ipol.aliexpress_DELIVERY_CSE_RU_PROVINCE_RUB_NAME']          = 'KCE';
$MESS['ipol.aliexpress_DELIVERY_CSE_RU_PROVINCE_RUB_HELP']          = '';
$MESS['ipol.aliexpress_DELIVERY_CDEK_RU_PROVINCE_RUB_NAME']         = 'СДЭК';
$MESS['ipol.aliexpress_DELIVERY_CDEK_RU_PROVINCE_RUB_HELP']         = '';
$MESS['ipol.aliexpress_DELIVERY_RUPOST_COURIER_RUB_NAME']           = 'Почта России Курьер Онлайн';
$MESS['ipol.aliexpress_DELIVERY_RUPOST_COURIER_RUB_HELP']           = '';
$MESS['ipol.aliexpress_DELIVERY_AE_RU_MP_COURIER_PH3_REGION_NAME']  = 'AliExpress DropShip';
$MESS['ipol.aliexpress_DELIVERY_AE_RU_MP_COURIER_PH3_REGION_HELP']  = '';
$MESS['ipol.aliexpress_DELIVERY_AE_RU_MP_WHCOURIER_PH3_Prov_NAME']  = 'AliExpess Fulfilment';
$MESS['ipol.aliexpress_DELIVERY_AE_RU_MP_WHCOURIER_PH3_Prov_HELP']  = '';
$MESS['ipol.aliexpress_DELIVERY_MYMALL_PUDO_CITY_NAME']  = 'AliExpress «Почта России»';
$MESS['ipol.aliexpress_DELIVERY_MYMALL_PUDO_CITY_HELP']  = '';
$MESS['ipol.aliexpress_DELIVERY_OTHER_NAME']  = 'Другие';
$MESS['ipol.aliexpress_DELIVERY_OTHER_HELP']  = 'Указывается служба доставки которая будет использована, если ни одно из соответствий выше не подойдет';

/* Tab DIMENSIONS */
$MESS["IPOL_ALI_OPTIONS_TAB_DIMENSIONS"] = "Габариты";
$MESS["IPOL_ALI_OPTIONS_TAB_DIMENSIONS_TITLE"] = "Задайте значения по умолчанию";
$MESS["IPOL_ALI_OPTIONS_TAB_DIMENSIONS_HELP"] = "
Данная группа настроек предназначена для определения габаритов тех заказов, где присутствуют товары без заполненных размеров и/или веса. 
Здесь можно задать те значения, что будут браться по умолчанию для заказа или товара.
<br><br>
<b>Применять для всего заказа</b><br>
Будет произведен суммарный расчет габаритов всего заказа, проверяется общий размер и вес заказа и берется то значение - рассчитанное или же заданное по умолчанию - которое больше.<br><br>
<b>Применять для товаров в заказе</b>
В этом случае при расчете габаритов, если у товара не задано значение одного или нескольких габаритов, оно будет браться из значений по умолчанию.
<br><br>
<b style=\"color:red\">Внимание!</b> Все габариты берутся из настроек торгового каталога.";
$MESS["IPOL_ALI_OPTIONS_WEIGHT"] = "Вес заказа по умолчанию, г";
$MESS["IPOL_ALI_OPTIONS_LENGTH"] = "Длина заказа по умолчанию, мм";
$MESS["IPOL_ALI_OPTIONS_WIDTH"] = "Ширина заказа по умолчанию, мм";
$MESS["IPOL_ALI_OPTIONS_HEIGHT"] = "Высота заказа по умолчанию, мм";

$MESS["IPOL_ALI_OPTIONS_USE_MODE"] = "Применять для";
$MESS["IPOL_ALI_OPTIONS_USE_MODE_ORDER"] = "Для всего заказа";
$MESS["IPOL_ALI_OPTIONS_USE_MODE_ITEM"] = "Для товаров в заказе";
$MESS["ipol.aliexpress_DELIVERY_INFO"] = 'Информация о доставке';
$MESS["IPOL_ALI_FORM_SAVE_OK"] = "Данные успешно сохранены";

$MESS["IPOL_ALI_OPTIONS_REGISTER_MODE"] = "Выберите вид авторизации в модуле";
$MESS["IPOL_ALI_OPTIONS_REGISTER_MODE_SIMPLE"] = "Простой";
$MESS["IPOL_ALI_OPTIONS_REGISTER_MODE_CUSTOM"] = "Самостоятельная регистрация в качестве разработчика";
$MESS["IPOL_ALI_OPTIONS_REGISTER_MODE_COMMENT"] = '
<br>
    <div>
        <b>Простой</b> - в этом случае, для авторизации в API AliExpress Вам достаточно будет указать свой логин и пароль, 
        после чего модуль запросит токен-доступа к API у сервиса AliExpress.<br>
        Однако, в дальнейшем потребуется выполнить авторизацию снова, 
        т.к срок действия выдаваемого AliExpress токена-авторизации ограничен 1 месяцем.<br>
    </div>

    <div>&nbsp;</div>

    <div>
        <b>Регистрация в качестве разработчика</b> - в этом случае для получения данных для авторизации 
        в API необходима регистрация в качестве разработчика на Aliexpress. <a href="https://business.aliexpress.ru/docs/register" target="_blank">Инструкция по регистрации</a><br>
        Преимущество данного вида авторизации в том, что получаемый токен-доступа к API AliExpress не ограничен по времени и будет действителен, пока Вы его не отзовете самостоятельно.
    </div>
';

$MESS["ipol.aliexpress_OPTIONS_APP_OLD_API_HEADER"] = "Доступ к глобальному API aliexpress";
$MESS["IPOL_ALI_OPTIONS_APP_KEY"] = "Ключ приложения";
$MESS["IPOL_ALI_OPTIONS_APP_SECRET_KEY"] = "Секретный ключ";
$MESS["IPOL_ALI_OPTIONS_APP_SESSION_KEY"] = "Ключ сессии";


$MESS['ipol.aliexpress_OPTIONS_APP_NEW_API_HEADER'] = 'Доступ к локальному API aliexpress';
$MESS['ipol.aliexpress_OPTIONS_APP_ACCESS_TOKEN_NEW_TITLE'] = 'API-токен';
$MESS['ipol.aliexpress_OPTIONS_APP_ACCESS_TOKEN_NEW_HELP'] = 'Выпустить токен авторизации Вы можете на <a href="https://seller.aliexpress.ru/token-management/active" target="_blank">странице</a>';

$MESS['ipol.aliexpress_OPTIONS_EXPORT_ARTICUL_TITLE'] = 'Укажите код свойства, в котором хранится артикул товаров';
$MESS['ipol.aliexpress_OPTIONS_EXPORT_ARTICUL_TITLE_HELP'] = 'Указывается единый код свойства, который будет использован во всех выгрузках';