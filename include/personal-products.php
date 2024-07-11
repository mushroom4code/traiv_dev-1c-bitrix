<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent("bitrix:menu", "personal", Array(
    "COMPONENT_TEMPLATE" => "left_menu",
    "ROOT_MENU_TYPE" => "personal",	// Тип меню для первого уровня
    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
    "MAX_LEVEL" => "1",	// Уровень вложенности меню
    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
    "DELAY" => "N",	// Откладывать выполнение шаблона меню
    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
),
    false
);?>

<p class="dashboard__prompt">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW" => "file",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/personal-text-products.php"
        ),
        false
    );
    ?>
</p>
