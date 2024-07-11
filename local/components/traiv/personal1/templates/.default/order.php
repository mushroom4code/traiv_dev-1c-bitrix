<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<? include_once 'top.php'; 


if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        $APPLICATION->IncludeComponent("bitrix:sale.personal.order.list", "orders", Array(
            "ACTIVE_DATE_FORMAT" => "m/d/Y",	// Формат показа даты
            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
            "CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CUSTOM_SELECT_PROPS" => array(	// Дополнительные свойства инфоблока
                0 => "",
            ),
            "DETAIL_HIDE_USER_INFO" => array(	// Не показывать в информации о пользователе
                0 => "0",
            ),
            "HISTORIC_STATUSES" => array(	// Перенести в историю заказы в статусах
                0 => "F",
            ),
            "NAV_TEMPLATE" => "",	// Имя шаблона для постраничной навигации
            "ORDERS_PER_PAGE" => "20",	// Количество заказов на одной странице
            "ORDER_DEFAULT_SORT" => "STATUS",	// Сортировка заказов
            "PATH_TO_BASKET" => "/personal/cart",	// Страница с корзиной
            "PATH_TO_CATALOG" => "/catalog/",	// Путь к каталогу
            "PATH_TO_PAYMENT" => "/personal/order/payment/",	// Страница подключения платежной системы
            "PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
            "PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
            "REFRESH_PRICES" => "N",	// Пересчитывать заказ после смены платежной системы
            "RESTRICT_CHANGE_PAYSYSTEM" => array(	// Запретить смену платежной системы у заказов в статусах
                0 => "0",
            ),
            "SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
            "SEF_MODE" => "N",	// Включить поддержку ЧПУ
            "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
            "STATUS_COLOR_F" => "gray",	// Цвет статуса "Выполнен"
            "STATUS_COLOR_N" => "green",	// Цвет статуса "Принят, ожидается оплата"
            "STATUS_COLOR_P" => "yellow",	// Цвет статуса "Оплачен, формируется к отправке"
            "STATUS_COLOR_PSEUDO_CANCELLED" => "red",	// Цвет отменённых заказов
        ),
            $component
            );
    }
    else {
        $APPLICATION->IncludeComponent("bitrix:sale.personal.order", "", Array(
            "ACTIVE_DATE_FORMAT" => "m/d/Y",	// Формат показа даты
            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
            "CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CUSTOM_SELECT_PROPS" => array(	// Дополнительные свойства инфоблока
                0 => "",
            ),
            "DETAIL_HIDE_USER_INFO" => array(	// Не показывать в информации о пользователе
                0 => "0",
            ),
            "HISTORIC_STATUSES" => array(	// Перенести в историю заказы в статусах
                0 => "F",
            ),
            "NAV_TEMPLATE" => "",	// Имя шаблона для постраничной навигации
            "ORDERS_PER_PAGE" => "20",	// Количество заказов на одной странице
            "ORDER_DEFAULT_SORT" => "STATUS",	// Сортировка заказов
            "PATH_TO_BASKET" => "/personal/cart",	// Страница с корзиной
            "PATH_TO_CATALOG" => "/catalog/",	// Путь к каталогу
            "PATH_TO_PAYMENT" => "/personal/order/payment/",	// Страница подключения платежной системы
            "PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
            "PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
            "REFRESH_PRICES" => "N",	// Пересчитывать заказ после смены платежной системы
            "RESTRICT_CHANGE_PAYSYSTEM" => array(	// Запретить смену платежной системы у заказов в статусах
                0 => "0",
            ),
            "SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
            "SEF_MODE" => "N",	// Включить поддержку ЧПУ
            "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
            "STATUS_COLOR_F" => "gray",	// Цвет статуса "Выполнен"
            "STATUS_COLOR_N" => "green",	// Цвет статуса "Принят, ожидается оплата"
            "STATUS_COLOR_P" => "yellow",	// Цвет статуса "Оплачен, формируется к отправке"
            "STATUS_COLOR_PSEUDO_CANCELLED" => "red",	// Цвет отменённых заказов
        ),
            $component
            );
    }
}
else
{
    $APPLICATION->IncludeComponent("bitrix:sale.personal.order", "", Array(
        "ACTIVE_DATE_FORMAT" => "m/d/Y",	// Формат показа даты
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "CACHE_TIME" => "3600",	// Время кеширования (сек.)
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CUSTOM_SELECT_PROPS" => array(	// Дополнительные свойства инфоблока
            0 => "",
        ),
        "DETAIL_HIDE_USER_INFO" => array(	// Не показывать в информации о пользователе
            0 => "0",
        ),
        "HISTORIC_STATUSES" => array(	// Перенести в историю заказы в статусах
            0 => "F",
        ),
        "NAV_TEMPLATE" => "",	// Имя шаблона для постраничной навигации
        "ORDERS_PER_PAGE" => "20",	// Количество заказов на одной странице
        "ORDER_DEFAULT_SORT" => "STATUS",	// Сортировка заказов
        "PATH_TO_BASKET" => "/personal/cart",	// Страница с корзиной
        "PATH_TO_CATALOG" => "/catalog/",	// Путь к каталогу
        "PATH_TO_PAYMENT" => "/personal/order/payment/",	// Страница подключения платежной системы
        "PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
        "PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
        "REFRESH_PRICES" => "N",	// Пересчитывать заказ после смены платежной системы
        "RESTRICT_CHANGE_PAYSYSTEM" => array(	// Запретить смену платежной системы у заказов в статусах
            0 => "0",
        ),
        "SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
        "SEF_MODE" => "N",	// Включить поддержку ЧПУ
        "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
        "STATUS_COLOR_F" => "gray",	// Цвет статуса "Выполнен"
        "STATUS_COLOR_N" => "green",	// Цвет статуса "Принят, ожидается оплата"
        "STATUS_COLOR_P" => "yellow",	// Цвет статуса "Оплачен, формируется к отправке"
        "STATUS_COLOR_PSEUDO_CANCELLED" => "red",	// Цвет отменённых заказов
    ),
        $component
        );
}

?>

<? include_once 'bottom.php'; ?>
