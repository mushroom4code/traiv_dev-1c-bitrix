<?php

$MESS['MENU_NAME'] = 'Оптимизация изображений - Adwex';
$MESS['MENU_NAME_IMAGE'] = 'Сжатие файлов JPEG и PNG на сервере';
$MESS['MENU_NAME_CONVERT'] = 'Пробная конвертация в WEBP';
$MESS['COMMONS_OPTIONS'] = 'Общие настройки модуля';
$MESS['ACTIVITY_OPTIONS'] = 'Режим работы модуля';
$MESS['LAZYLOAD_OPTIONS'] = 'Настройки LazyLoad';
$MESS['WEBP_OPTIONS'] = 'Настройки WebP';
$MESS['OTHER_OPTIONS'] = 'Шрифты, стили и другие настройки ускорения';
$MESS['PRECONNECT_OPTIONS'] = 'Преконнект внешних источников кода/контента';
$MESS['USE_PARSER'] = 'Для поиска картинок использовать XPath (быстрее, для работы нужены библиотеки DOM и libxml)';
$MESS['USE_LAZYLOAD'] = 'Использовать LazyLoad';
$MESS['USE_LAZYLOAD_BG'] = 'Применять LazyLoad к фоновым изображениям (для всех тегов кроме &lt;img&gt;)';
$MESS['LAZYLOAD_SKIPMAP'] = 'Исключить LazyLoad для следующих страниц или разделов сайта (пути от корня сайта в отдельных строках)';
$MESS['CREATE_WEBP'] = 'Использовать WebP';
$MESS['WEBP_EXTRAREGEXPS'] = 'Регулярные выражения (regexp) для дополнительного поиска и конвертации изображений в WebP';
$MESS['INLINE_CSS'] = 'Встраивать CSS файлы в HTML';
$MESS['INLINE_CSS_SMALL_ONLY'] = 'Встраивать только небольшие (<42 KB) CSS файлы';
$MESS['INLINE_CSS_CASHOUTSIDE'] = 'Кэшировать встроенные CSS на стороне браузера';
$MESS['INLINE_CSS_TO_BOTTOM'] = 'Переносить встраиваемые CSS в конец HTML';
$MESS['MINIFIED_CSS'] = 'Сжимать CSS файлы';
$MESS['MINIFIED_JS'] = 'Сжимать JS файлы';
$MESS['MINIFIED_HTML'] = 'Сжимать HTML';

$MESS['WORK_FOR_GROUP'] = 'Модуль работает';
$MESS['WORK_FOR_GROUP_NOONE'] = 'Выключен';
$MESS['WORK_FOR_GROUP_ADMIN'] = 'Для администраторов';
$MESS['WORK_FOR_GROUP_ALL'] = 'Для всех пользователей';
$MESS['PAGES_SKIPMAP'] = 'За исключением следующих страниц или разделов сайта (пути от корня сайта в отдельных строках)';
$MESS['SKIPERROR404'] = 'Не обрабатывать страницу "Ошибка 404"';

$MESS['SEARCH_ALL_IMAGES'] = 'Искать все ссылки на изображения на странице';

$MESS['DELETE_BITRIX_OPENSANS'] = 'Удалять подключаемый битриксом шрифт OpenSans';
$MESS['OPTIMIZE_GFONTS'] = 'Оптимизировать подключение шрифтов с Fonts.Google';
$MESS['OPTIMIZE_GFONTS_INLINE'] = 'После оптимизации встраивать шрифты в тело страницы';
$MESS['FONTS_PRELOAD_LIST'] = 'Список шрифтов для предзагрузки. Путь к каждому файлу шрифта указывайте одной отдельной строкой. Вносите в этот список те шрифты, которые Google PageSpeed Insights для вашего сайта указывает в разделе "Настройте предварительную загрузку ключевых запросов"';

$MESS['HINT_PRECONNECT'] = 'Преконнект помогает браузеру заранее подключиться к другим доменам, это помогает получить контент с других сайтов быстрее. Включите преконнект для тех внешних сервисов, которые действительно используются на сайте. Если в списке нет нужной опции - напишите на <a href="mailto:support@adwex.ru">support@adwex.ru</a> и она появится в следующем обновлении.';
$MESS['ADD_PRECONNECT_ANALITICS'] = 'Преконнект к Google Analytics';
$MESS['ADD_PRECONNECT_TAG_MANGER'] = 'Преконнект к Google Tag Manager';
$MESS['ADD_PRECONNECT_METRICA'] = 'Преконнект к Яндекс.Метрика';
$MESS['ADD_PRECONNECT_FACEBOOK'] = 'Преконнект к FaceBook';
$MESS['ADD_PRECONNECT_JIVOSITE'] = 'Преконнект к JivoSite';

$MESS['HELP_BLOCK_TITLE'] = 'Важная информация по настройкам';
$MESS['HINT'] = '
<p>
<!--<span class="required"><sup>beta</sup></span> Опции с такой пометкой находятся на стадии тестирования, проверьте работу сайта после её включения, если будут ошибки напишите нам.<br>-->
<span class="required"><sup>1</sup></span> Чтобы изображение было без ленивой загрузке, добавьте атрибут «data-amlazy-skip». Для исключения из ленивой загрузки целиком страницы или раздела сайта укажите в списке исключений в отдельной строке путь соответствующей страницы/раздела относительно корня сайта. Например: <i>/projects/samples/unchecked/</i><br>
<span class="required"><sup>2</sup></span> Чтобы пропустить конвертацию изображения добавьте элементу атрибут «data-amwebp-skip»<br>
<span class="required"><sup>3</sup></span> По умолчанию, поиск идет только в элементах img и значению background-image<br>
<span class="required"><sup>4</sup></span> Каждое регулярное выражение должно быть записано одной строкой без открывющих/закрывающих слэшей и флагов. Первая возвращаемая группа (Capturing Group, задается в круглых скобках) в каждом регулярном выражении должна "вынимать" путь файла изображения. Пример рег. выражения для "вытаскивания" изображений, которые заданы с использованием нестандартного атрибута bigimg в тегах div: <i>&lt;div\s[^&gt;]*bigimg="(.*?)"</i><br>
<span class="required"><sup>5</sup></span> Инлайнинг - встраивает код стилевого файла в страницу, это позволяет сократить кол-во запросов к серверу<br>
<span class="required"><sup>6</sup></span> Для работы модуля, в настройках главного модуля необходимо включить опции: «Объединять CSS файлы», «Объединять JS файлы». При установке модуля эти опции включились автоматически<br>
<span class="required"><sup>7</sup></span> Оптимизация HTML может приводить к генерации большого количества кешированных версий страниц на сайтах с часто
изменяемым контентом и большим кол-вом страниц, например, интернет-магазинах. Для контроля размера кеша используйте настройку "Время жизни HTML кеша в днях"<br>
<span class="required"><sup>8</sup></span> В последних версиях Битрикс подключает шрифт OpenSans. Если шрифт не нужен, то его можно удалить<br>
<span class="required"><sup>9</sup></span> Включите опцию если на сайте используются шрифты с сервиса fonts.google.com<br>
<p>Если остались вопросы, на странице модуля в маркетплейсе, подробнее описана работа модуля. Если нужна помощь в настройке, то напишите на <a href="mailto:support@adwex.ru">support@adwex.ru</a>.</p>
';

$MESS['OPTIONS_OTHER'] = 'Остальные настройки';
$MESS['OPTIONS_TEST_PNG_WEBP_EXAMPLE'] = 'Примеры конвертации на вашем сервере';
$MESS['OPTIONS_TEST_PNG_WEBP'] = '<table><thead><tr>
<th>Оригинальное изображение<br>#ORG_SIZE#</th>
<th>WebP с прозрачностью<br>#WI_SIZE#</th>
<th>WebP без прозрачности<br>#WC_SIZE#</th></tr></thead>
<tbody>
<tr>
<td><a href="/upload/adwex.minified/test/img.png" target="_blank"><img src="/upload/adwex.minified/test/img.png" alt="" style="width: 200px;"></a></td>
<td><a href="/upload/adwex.minified/test/img.png.i.webp" target="_blank"><img src="/upload/adwex.minified/test/img.png.i.webp" alt="" style="width: 200px;"></a></td>
<td><a href="/upload/adwex.minified/test/img.png.c.webp" target="_blank"><img src="/upload/adwex.minified/test/img.png.c.webp" alt="" style="width: 200px;"></a></td></tr>
</tbody></table>';
$MESS['OPTIONS_WEBP'] = 'Настройки WebP';
$MESS['CONVERT_PNG_TYPE'] = 'Конвертировать PNG в WebP';
$MESS['CONVERT_PNG_TYPE_INSTANT'] = 'С сохранением прозрачности (на некоторых серверах возможны ошибки)';
$MESS['CONVERT_PNG_TYPE_TO_JPG'] = 'Без прозрачности';
$MESS['CONVERT_PNG_TYPE_SKIP'] = 'Не конвертировать';
$MESS['QUALITY_WEBP'] = 'Качество WebP';
$MESS['QUALITY_JPG'] = 'Качество JPG';
$MESS['QUALITY_PNG'] = 'Качество PNG';
$MESS['MINIFY_JS_TOOLS'] = 'Библиотека для сжатия JS';
$MESS['MINIFY_JS_TOOLS_PATCHWORK'] = 'Patchwork';
$MESS['MINIFY_JS_TOOLS_PHPWEE'] = 'PHPWee';
$MESS['MINIFY_JS_TOOLS_JSMIN'] = 'JSMin';
$MESS['MINIFY_JS_TOOLS_MINIFY'] = 'MatthiasMullie';
$MESS['MINIFY_CSS_TOOLS'] = 'Библиотека для сжатия CSS';
$MESS['MINIFY_CSS_TOOLS_PHPWEE'] = 'PHPWee';
$MESS['MINIFY_CSS_TOOLS_MINIFY'] = 'MatthiasMullie';
$MESS['MINIFY_HTML_TOOLS'] = 'Библиотека для сжатия HTML';
$MESS['MINIFY_HTML_TOOLS_PHPWEE'] = 'PHPWee';
$MESS['MINIFY_HTML_TOOLS_TINYHTML'] = 'TinyHtml';
$MESS['MINIFY_HTML_TOOLS_SHAUN'] = 'Shaun';
$MESS['MINIFY_WITH_BX'] = 'Применять встроенные функции сжатия CSS и JS Битриска';
$MESS['CHANGE_FONT_WHILE_LOAD'] = 'Подменять подгружаемые шрифты на время загрузки страницы для ускорения отображения текстов';
$MESS['MINIFY_LOADELEMNT'] = 'Сжимать изображения элементов инфоблоков при создании';
$MESS['MINIFY_LOADELEMNT_UPDATE'] = 'Сжимать изображения элементов инфоблоков при обновлении';
$MESS['MINIFY_LOADSECTION'] = 'Сжимать изображения секций инфоблоков';
$MESS['MINIFY_ADDINFILETABLE'] = 'Сжимать изображения сторонних модулей';
$MESS['MINIFY_RESIZE'] = 'Сжимать изображения при изменении размера';
$MESS['EXCEPT_FOLDER'] = 'Кроме папок (через запятую)';
$MESS['MINIFY_HINT'] = '<div style="text-align: left;"><p><b>FAQ:</b><br></p>
<p>Рекомендуемые библиотеки: для JS - JSMin, CSS - MatthiasMullie.<br>
Если при сжатии HTML или JS на сайте появляются ошибки, выберите другую библиотеку сжатия</p>
<p>Оптимальное качество JPG - 85<br>
Оптимальное качество PNG - 75</p>
<p>Чтобы оптимизировать уже загруженные фотографии, перейдите в раздел «Сервисы» > «<a href="/bitrix/admin/adwex_minify_image.php">Оптимизация изображений - Adwex</a>».</p></div>';
$MESS['LIFE_TIME_CACHE'] = 'Время жизни HTML кеша в днях';