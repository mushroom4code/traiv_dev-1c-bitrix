<?php
$arUrlRewrite=array (
  56 => 
  array (
    'CONDITION' => '#^/industry-solutions/([^\\/]+)/($|\\?.*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/industry-solutions/detail.php',
    'SORT' => 20,
  ),
  64 => 
  array (
    'CONDITION' => '#^/services/coatings/([^\\/]+)/($|\\?.*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/services/coatings/detail.php',
    'SORT' => 20,
  ),
  61 => 
  array (
    'CONDITION' => '#^/transit/([^\\/]+)/($|\\?.*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/transit/detail.php',
    'SORT' => 20,
  ),
  98 => 
  array (
    'CONDITION' => '#^/press/([^\\/]+)/($|\\?.*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/press/detail.php',
    'SORT' => 20,
  ),
  59 => 
  array (
    'CONDITION' => '#^/industry-solutions/([a-zA-Z0-9-]{1,})/$#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/industry-solutions/index.php',
    'SORT' => 30,
  ),
  62 => 
  array (
    'CONDITION' => '#^/transit/([a-zA-Z0-9-]{1,})/$#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/transit/index.php',
    'SORT' => 30,
  ),
  99 => 
  array (
    'CONDITION' => '#^/press/([a-zA-Z0-9-]{1,})/$#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/press/index.php',
    'SORT' => 30,
  ),
  45 => 
  array (
    'CONDITION' => '#^/gosti-na-krepezh/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/doc-view/#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/gosti-na-krepezh/doc-view.php',
    'SORT' => 100,
  ),
  28 => 
  array (
    'CONDITION' => '#^/osti-na-krepezh/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/doc-view/#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/osti-na-krepezh/doc-view.php',
    'SORT' => 100,
  ),
  31 => 
  array (
    'CONDITION' => '#^/din-na-krepezh/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/doc-view/#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/din-na-krepezh/doc-view.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/gosti-na-krepezh/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/gosti-na-krepezh/element.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/osti-na-krepezh/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/osti-na-krepezh/element.php',
    'SORT' => 100,
  ),
  30 => 
  array (
    'CONDITION' => '#^/din-na-krepezh/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/din-na-krepezh/element.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/production/([^\\/]+)/([^\\/]+)/($|\\?.*)#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/production/detail.php',
    'SORT' => 100,
  ),
  49 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  92 => 
  array (
    'CONDITION' => '#^/personal/orderview/([^\\/]+)/($|\\?.*)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/personal/orderview/index.php',
    'SORT' => 100,
  ),
  106 => 
  array (
    'CONDITION' => '#^/services/proizvodstvo-metizov/works/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/proizvodstvo-metizov/works/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/gosti-na-krepezh/([0-9a-zA-Z-]+)/.*#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/gosti-na-krepezh/razdel.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/osti-na-krepezh/([0-9a-zA-Z-]+)/.*#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/osti-na-krepezh/razdel.php',
    'SORT' => 100,
  ),
  103 => 
  array (
    'CONDITION' => '#^/catalog/filter/(.+?)/apply/\\??(.*)#',
    'RULE' => 'SMART_FILTER_PATH=$1&$2',
    'ID' => 'bitrix:catalog.smart.filter',
    'PATH' => '/include/common-filter.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/din-na-krepezh/([0-9a-zA-Z-]+)/.*#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/din-na-krepezh/razdel.php',
    'SORT' => 100,
  ),
  94 => 
  array (
    'CONDITION' => '#^/services/proizvodstvo-metizov/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/services/proizvodstvo-metizov/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/production/([^\\/]+)/($|\\?.*)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/production/section.php',
    'SORT' => 100,
  ),
  50 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  108 => 
  array (
    'CONDITION' => '#^/techinfo/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/techinfo/index.php',
    'SORT' => 100,
  ),
  111 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal_new/index.php',
    'SORT' => 100,
  ),
  107 => 
  array (
    'CONDITION' => '#^production#',
    'RULE' => '',
    'ID' => 'bitrix:news.detail',
    'PATH' => '/production/detail.php',
    'SORT' => 100,
  ),
  129 => 
  array (
    'CONDITION' => '#^/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/articles/index.php',
    'SORT' => 100,
  ),
  116 => 
  array (
    'CONDITION' => '#^/cutting/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/cutting/index.php',
    'SORT' => 100,
  ),
  126 => 
  array (
    'CONDITION' => '#^/actions/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/actions/index.php',
    'SORT' => 100,
  ),
  130 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  110 => 
  array (
    'CONDITION' => '#^/testbx/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/testbx/index.php',
    'SORT' => 100,
  ),
  109 => 
  array (
    'CONDITION' => '#^/terms/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/terms/index.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  121 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
