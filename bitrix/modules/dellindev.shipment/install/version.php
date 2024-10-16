<?php
$arModuleVersion = array(
    "VERSION" => "1.0.4",
    "VERSION_DATE" => "2022-02-14 18:30:00"
);

/**
 * История изменений:
 * 
 *  - 1.0.0 - 10.10.2021
 *      * релиз версия модуля с новой архитектурой. 
 * 
 *  - 1.0.1 - 30.10.2021
 *      * добавлен механизм создания свойств заказа для всех типов плательщиков ( решает проблему с многосайтовостью)
 *      * фикс поведения свойств заказа в чекауте
 * 
 *  - 1.0.2 - 14.11.2021
 *      * Измененна модель сущности Cargo для работы с негабаритом 
 * 
 *  - 1.0.3 - 26.01.2022
 *      * изменён механизм погруза свойств со статического на динамический (люди отключают стандартные поля и падает чекаут. частично проблема решена)
 *      * добавлена проверка состояния при подгрузке события 
 * 
 *  - 1.0.4 - 14.02.2022
 *      * изменён подход к кешированию сетевых ответов от API. 
 *      * изменён подход инициализации объектов (промежуточное обновление)
 *      * изменён механизм отображения терминалов в чекауте.
 *      * добавлена динамическая подгрузка свойств при создании заказа (фикс падения страницы  на этапе оформления заявки)
 * 
 *  
 * 
 */