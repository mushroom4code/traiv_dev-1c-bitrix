<?
$MESS ['MURL_NO_USL'] = "Не указано условие";
$MESS ['MURL_DUPL_CONDITION'] = "Запись с условием '#CONDITION#' уже существует";
$MESS ['MURL_EDIT'] = "Изменение правила";
$MESS ['MURL_ADD'] = "Добавление правила";
$MESS ['MURL_2_LIST'] = "Список правил";
$MESS ['MURL_2_LIST_ALT'] = "Перейти в список правил";
$MESS ['MURL_ACT_ADD'] = "Добавить";
$MESS ['MURL_ACT_ADD_ALT'] = "Добавить новое правило";
$MESS ['MURL_ACT_DEL'] = "Удалить";
$MESS ['MURL_ACT_DEL_CONF'] = "Вы уверены, что хотите удалить эту запись?";
$MESS ['MURL_TAB'] = "Параметры";
$MESS ['MURL_TAB_ALT'] = "Параметры записи";
$MESS ['MURL_USL'] = "Условие";
$MESS ['MURL_OLD_LINK'] = "Редирект откуда";
$MESS ['MURL_NEW_LINK'] = "куда";
$MESS ['MURL_RULE'] = "Активность";
$MESS ['MURL_COMMENT'] = "Комментарий";
$MESS ['MURL_STATUS'] = "Код HTTP статуса";
$MESS ['STATUS_301'] = "301: Перемещено навсегда";
$MESS ['STATUS_302'] = "302: Перемещено временно";
$MESS ['STATUS_303'] = "303: Смотреть другое";
$MESS ['STATUS_410'] = "410: Удалено";
$MESS ['SAE_ERROR'] = "Ошибка при сохранении правила";
$MESS ['SH_ERRORS'] = "Адрес, для которого вы хотите сгенерировать правило, уже есть. Генерация невозможна";
$MESS ['SH1_ERRORS'] = "Вы не ввели адрес в поле Адрес";
$MESS ['GEN_MESSG'] = "Сгенерированный редирект:";
$MESS ['ERROR_NO_URL'] = "Вы должны указать, откуда и куда будет произведен редирект";
$MESS ['ERROR_DUPLICATE_URL'] = "Вы пытаетесь создать цикличный редирект!";
$MESS ['ERROR_INVALID_URL'] = "URL задан неверно!";
$MESS ['ERROR_INVALID_URL_DESC'] = 'URL не прошел проверку на соответствие спецификации <a href="http://www.faqs.org/rfcs/rfc2396.html" target="_blank">RFC2396</a>.<br/>Вы можете отключить проверку в <a href="/bitrix/admin/settings.php?mid=step2use.redirects" target="_blank">настройках модуля</a>. Это может пригодится, к примеру, если вы используете кириллические URL';
$MESS ['ERROR_NOSLASH_URL'] = "URL должны начинаться со слеша";
$MESS ['ERROR_410'] = "Для этого типа редиректа нужно указывать только начальный URL";
$MESS ['ERROR_DEMO'] = "Вы используете демо-версию модуля 'Редирект мастер'!<br/>В демо-режиме возможно создать не больше 5 правил перенаправления.<br/>Для покупки полной версии модуля воспользуйтесь данной <a href='http://marketplace.1c-bitrix.ru/solutions/step2use.redirects/'>ссылкой</a>.";
$MESS ['S2U_INFORMATION_TITLE'] = 'Внимание!';
$MESS ['S2U_INFORMATION_DESC'] = "<i>Редирект мастер</i> вносит изменения в файл <i>.htaccess</i>! <br/>Перед применением модуля рекомендуется сделать резервную копию файла и <a href='http://httpd.apache.org/docs/2.4/mod/mod_alias.html#redirect' target='_blank'>ознакомиться с официальной документацией Apache</a>.";
$MESS ['S2U_ERROR_DUPLICATE_OLD_LINK'] = "С данного URL уже настроен редирект!";
$MESS ['S2U_WITH_INCLUDES'] = 'все вхождения';
$MESS ['S2U_WITH_INCLUDES_TIP'] = 'Данный признак означает, что редирект надо проводить со всех url, начинающихся с указанного.<br/><br/><i>Например, если задать url вида /prt  и указан признак &quot;все вхождения&quot;, то редирект будет производится и с /ptr12 и /prt13 и /prt/help/  и т.д.</i>';
$MESS ['S2U_USE_REGEXP'] = 'Использовать регулярные выражения';
$MESS ['S2U_USE_REGEXP_DESC'] = '<a href="https://atlant2010.ru/blog/slozhnye-pravila-redirektov-redirekt-master/" target="_blank">пример использования</a>'
?>
