<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая главная");

$detect = new Mobile_Detect;
$is_mobile = $detect->isMobile();
?>

    <section id="content" style="display:none;">
        <div class="container">

            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "traiv",
                array(
                    "COMPONENT_TEMPLATE" => "traiv",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            ); ?>

        </div>
    </section>

    <section id="np-main-page-main">
        <div class="container mt-5">
            <div class="row">

                <?php if (!$is_mobile): ?>
                <div class="col-12 col-lg-6 col-md-6 text-md-left text-center h-100 d-none d-md-block">
                    <div class="row d-flex align-items-center h-100">

                        <div class="col-12 col-lg-12 col-md-12 text-md-left text-center mb-4">
                            <div class='np-main-item bordered slogan-area position-relative' style='height:250px;'>
                                <div class="np-slogan-shape"></div>
                                <div class="row d-flex align-items-center h-100 position-relative" style="z-index:25;">

                                    <div class="col-8 col-lg-8 col-md-8 offset-lg-1 text-md-left text-center">
                                        <div class='np-slogan-title pb-2'><span>Трайв</span></div>
                                        <div class='np-slogan-title'><span>Производство и комплексные услуги для промышленных предприятий</span>
                                        </div>
                                        <div class='np-slogan-title-bottom'><span>Будущее в деталях</span></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-12 col-md-12 text-md-left text-center">
                            <div class='np-main-item bordered b1 position-relative'
                                 style='background: url(/local/templates/traiv-new/images/np/np_edu_center_bann1.jpg) no-repeat center center;background-size:cover;height:250px;'>
                                <div class="np-edu-center-shape"></div>
                                <div class="row d-flex align-items-center h-100 position-relative" style="z-index:25;">

                                    <div class="col-7 col-lg-7 col-md-7 offset-lg-5 text-md-left text-center">
                                        <div class="d-flex align-items-center position-relative mb-2"><img
                                                    src="<?= SITE_TEMPLATE_PATH ?>/images/np/np-edu-book1.png"
                                                    style="width:75px;"/>
                                            <div class="np-edu-name">УЧЕБНЫЙ ЦЕНТР «ТРАЙВ»</div>
                                        </div>
                                        <div class='np-edu-htitle'><span>ОБУЧЕНИЕ И ТРУДОУСТРОЙСТВО</span></div>
                                        <div class='np-edu-htitle blue'><span>ОПЕРАТОР СТАНКОВ С ЧПУ</span></div>

                                        <div class="btn-group-blue mt-4">
                                            <a href="/about-company/" class="btn-blue-big">
                                                <span>Подробнее</span><i class="fa fa-long-arrow-right"
                                                                         style="padding-left:10px;"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-12 col-lg-6 col-md-6 text-md-left text-center">
                    <div class='np-main-item bordered b1'
                         style='background: url(/local/templates/traiv-new/images/np/back_main.jpg) no-repeat center center;background-size:cover;height:100%;'>

                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/np/np-main-page-main-figure11.png"
                             class="np-main-page-main-figure d-none d-lg-block"/>

                        <div class="row d-flex align-items-center h-100 np-main-leftarea">

                            <div class="col-12 col-lg-12 col-md-12 text-left ">
                                <div class="np-main-htitle-area">
                                    <div class="np-main-htitle-area-in">
                                        <div class='np-htitle white altered'><span>Импортозамещение</span></div>
                                        <div class='np-htitle-small white'><span>Интегрируем импортозамещение в ваше производство</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12 col-md-12 text-md-left text-center">
                                <ul class="import-title-cloud-item-area-main">
                                    <li><span class="import-title-cloud-item-main"><i class="fa fa-check-square-o"></i>Продукты металлообработки</span>
                                    </li>
                                    <li><span class="import-title-cloud-item-main"><i class="fa fa-check-square-o"></i>Метизные изделия</span>
                                    </li>
                                    <li><span class="import-title-cloud-item-main"><i class="fa fa-check-square-o"></i>Крепежные решения</span>
                                    </li>
                                    <li><span class="import-title-cloud-item-main"><i class="fa fa-check-square-o"></i>Изделия по чертежам</span>
                                    </li>
                                    <li><span class="import-title-cloud-item-main"><i class="fa fa-check-square-o"></i>Нанесение покрытий</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-12 col-lg-12 col-md-12 text-md-left text-center"
                                 style="padding-left: 30px;">
                                <div class="btn-group-blue mt-2"><a href="/about-company/" class="btn-blue-big"><span>Подробнее</span><i
                                                class="fa fa-long-arrow-right" style="padding-left:10px;"></i></a></div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
    </section>

    <section id="np-main-page-directions">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            array(
                "AREA_FILE_SHOW" => "file",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "/include/np_main_page_directions.php"
            )
        );
        ?>
    </section>

    <section id="np_main_page_services">

        <div class="row d-flex align-items-center">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center mb-4 mb-md-5">
                <div class='np-htitle text-left text-md-center ml-5 ml-md-0'><span>Услуги</span></div>
            </div>
        </div>


        <?
        if (!$is_mobile) {
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/np_main_page_services.php"
                )
            );
        } else {
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/np_main_page_services_mobile.php"
                )
            );
        }
        ?>
    </section>

    <?php if (!$is_mobile): ?>
    <section id="np_main_page_about" class="d-none d-md-block">
        <div class="container">
            <div class="row d-flex align-items-center h-100">
                <div class="col-12 col-lg-5 col-md-5 text-md-left text-center" id="logotype-area">
 				 <span class="np-logotype-new" alt="«Трайв» - поставки крепежа и метизов из Европы и Азии">
 				 	<img src="<?= SITE_TEMPLATE_PATH ?>/images/logo2023nh.png" class="logotype"/>
 				 </span>
                </div>

                <div class="col-12 col-lg-7 col-md-7 text-left pl-5">
                    <div class="np-htitle"><span>О компании</span></div>
                    <div class="np-text pt-3"><p>Инновационная технологическая сервисная компания с индивидуальным
                            подходом в производстве и разработке уникальных метизных решений.
                            Глубокая экспертиза и лабораторные испытания подтверждают высокое качество и прочность нашей
                            продукции, соответствующей всем стандартам и нормам. Мы предлагаем надежную техническую
                            документацию и IT-платформу для достижения лучших результатов наших клиентов. Трайв -
                            Будущее в деталях!</p></div>

                    <div class="btn-group-blue mt-4"><a href="/about-company/"
                                                        class="btn-blue-big"><span>Подробнее</span><i
                                    class="fa fa-long-arrow-right" style="padding-left:10px;"></i></a></div>

                </div>

            </div>


            <div class="row d-flex align-items-center h-100 mt-4">
                <div class="col-12 col-lg-5 col-md-5 text-md-left text-center">
                    <div class="btn-group-blue w-100">
                        <a href="/about-company/" class="btn-blue-big w-100">
                            <span style="text-transform: uppercase;">Календарь событий</span>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-5 col-md-4 text-left pl-5">
                    <a href="https://t.me/traivdirect" target="_blank" class="np-blink textup">Подписаться на Telegram
                        <i class="fa fa-telegram"></i></a>
                </div>

                <div class="col-12 col-lg-2 col-md-3 text-right pl-5">
                    <a href="/press/" class="np-blink textup">сми о нас <i class="fa fa-angle-right"></i></a>
                </div>

            </div>

        </div>
    </section>
    <?php endif; ?>

    <?php if (!$is_mobile): ?>
    <section id="main_page_category" class="d-none d-md-block">
        <div class="container">

            <div class="row d-flex align-items-center">
                <div class="col-12 col-xl-10 col-lg-10 col-md-10 mb-3">
                    <div class="np-htitle black"><span>Изделия и покрытия в деталях - наше эксклюзивное портфолио</span>
                    </div>
                </div>
                <div class="col-2 d-none d-xl-block text-right"><a href="/catalog/" class="np_link_dashed_gray">Больше
                        работ</a></div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-lg-7 col-md-7 text-md-left text-center">
                    <a href="#" class='np-main-item-portfolio bordered b1'
                       style='background: url(/local/templates/traiv-new/images/np/portfolio1.png) no-repeat center center;background-size:cover;height:100%;'>
                        <div class="np-main-item-portfolio-date"><span>01.10.23</span></div>
                        <div class="np-main-item-portfolio-name"><span>Изготовление откидных болтов ГОСТ 3033</span>
                        </div>

                        <div class="row d-flex align-items-center h-100 np-main-leftarea">

                            <div class="col-12 col-lg-12 col-md-12 text-md-left text-center">

                            </div>

                        </div>

                    </a>
                </div>

                <div class="col-12 col-lg-5 col-md-5 text-md-left text-center h-100">
                    <div class="row d-flex align-items-center h-100">
                        <div class="col-12 col-lg-12 col-md-12 text-md-left text-center mb-4">
                            <a href="#" class='np-main-item-portfolio bordered b1 position-relative'
                               style='background: url(/local/templates/traiv-new/images/np/portfolio2.png) no-repeat center center;background-size:cover;height:150px;'>
                                <div class="np-main-item-portfolio-date"><span>01.10.23</span></div>
                                <div class="np-main-item-portfolio-name"><span>Производство болтов HP1.1A.2 </span>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-lg-12 col-md-12 text-md-left text-center">
                            <a href="#" class='np-main-item-portfolio bordered'
                               style='background: url(/local/templates/traiv-new/images/np/portfolio3.png) no-repeat center center;background-size:cover;height:150px;'>
                                <div class="np-main-item-portfolio-date"><span>01.10.23</span></div>
                                <div class="np-main-item-portfolio-name"><span>Производство болтов М 42х100</span></div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

    </section>

    <section id="main_page_photogallery" class="d-none d-md-block">
        <div class="container">

            <div class="row d-flex align-items-center">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
                    <div class='np-htitle'><span>Каталог готовых решений</span></div>
                </div>
            </div>

            <div class="row np-serv-slider">

                <?php
                $arSelectRs = array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DATE_ACTIVE_FROM");
                $arSortRs = array("date_active_from" => "DESC");
                $arFilterRs = array('IBLOCK_ID' => "42", 'ACTIVE' => 'Y');

                $db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, array("nTopCount" => 10), $arSelectRs);

                $res_rows = intval($db_list_inRs->SelectedRowsCount());

                if ($res_rows > 0) {
                    while ($ar_result_inRs = $db_list_inRs->GetNext()) {

                        $imgEl = CFile::GetPath($ar_result_inRs['DETAIL_PICTURE']);
                        ?>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 p-xl-3 p-lg-3 p-md-3 position-relative np-serv-slider-item">
                            <a href="<?php echo '/services/proizvodstvo-metizov/works/' . $ar_result_inRs['CODE']; ?>"
                               class="np-serv-item bordered">

                                <time class="posts-i-date d-none" datetime="<?= $ar_result_inRs['DATE_ACTIVE_FROM'] ?>">
                                    <span><?= substr($ar_result_inRs['DATE_ACTIVE_FROM'], 0, 2) ?></span>
                                    <?php
                                    echo month2char(substr($ar_result_inRs['DATE_ACTIVE_FROM'], 3, 2));
                                    ?>
                                </time>

                                <div class="np-serv-slider-item-img"
                                     style="background-image:url(<?php echo $imgEl; ?>);"></div>
                                <div class="np-serv-slider-item-name"><?php echo $ar_result_inRs['NAME']; ?></div>
                                <div class="np-serv-slider-item-date d-none"><?php echo substr($ar_result_inRs['DATE_ACTIVE_FROM'], 0, 10); ?></div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>


            </div>
        </div>
    </section>
    <?php else: ?>
    <section id="main_page_category_photogallery_mobile" class="d-block d-md-none">
        <div class="container big-buttons-container">
            <a href="#" id="main_page_category_mobile" class="big-button d-flex justify-content-center align-items-center">
                <span>Изделия и покрытия в деталях</span>
            </a>
            <a href="/services/proizvodstvo-metizov/works/" id="main_page_photogallery_mobile" class="big-button d-flex justify-content-center align-items-center">
                <span>Каталог готовых решений</span>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!$is_mobile): ?>
    <section id="np_main_page_about" class="d-none d-md-block">
        <div class="container">
            <div class="row d-flex align-items-center h-100">
                <div class="col-12 col-lg-5 col-md-5 text-md-left text-center" id="logotype-area">
 				 <span class="np-edu-center-area" data-amwebp-skip>
 				 </span>
                </div>

                <div class="col-12 col-lg-7 col-md-7 text-left pl-5">
                    <div class="np-htitle"><span>Учебный центр</span></div>
                    <div class="np-text pt-3"><p>Наш учебный центр предлагает широкий спектр образовательных программ,
                            от курсов повышения квалификации до профессиональной переподготовки.
                            Мы работаем с опытными преподавателями, которые помогут вам освоить новые знания и навыки в
                            комфортной обстановке.</p></div>

                    <div class="btn-group-blue mt-4">
                        <a href="/about-company/" class="btn-blue-big">
                            <span>Подробнее</span><i class="fa fa-long-arrow-right" style="padding-left:10px;"></i>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section id="main_page_category" class="d-none d-md-block">
        <div class="container">

            <div class="row d-flex align-items-center">
                <div class="col-12 col-xl-10 col-lg-10 col-md-10 mb-3">
                    <div class="np-htitle black"><span>Производство и оптовые поставки крепежа</span></div>
                </div>
                <div class="col-2 d-none d-xl-block text-right"><a href="/catalog/" class="np_link_dashed_gray">Перейти
                        в каталог</a></div>
            </div>

            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/np_main_page_category.php"
                )
            );
            ?>

        </div>
    </section>
    <?php endif; ?>

    <section id="np_import" class="d-none">

        <div class="container">

            <div class="row g-0 position-relative" id="is-landing-row-image">
                <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-left">
                    <div class="import-title-back-black">
                        <div class="np-htitle black"><span>Импортозамещение</span></div>
                        <span class="np-htitle-small black">Интегрируем импортозамещение в ваше производство</span>


                        <div class="row mt-5">
                            <div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left text-lg-left text-md-left text-xl-left">
                                <div class="btn-group-blue mt-4">
                                    <a href="/about-company/" class="btn-blue-big">
                                        <span>Подробнее</span><i class="fa fa-long-arrow-right"
                                                                 style="padding-left:10px;"></i>
                                    </a>
                                </div>
                            </div>


                        </div>

                    </div>


                </div>

                <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-left">
                    <div class="row h-100">
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 position-relative">
                            <ul class="import-title-cloud-item-area">
                                <li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Продукты металлообработки</span>
                                </li>
                                <li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Метизные изделия</span>
                                </li>
                                <li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Крепежные решения</span>
                                </li>
                                <li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Изделия по чертежам</span>
                                </li>
                                <li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Нанесение покрытий</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>

    <section id="main_page_company_preim" class="d-none">
        <div class="container">

            <div class="row d-flex align-items-center">
                <div class="col-12 col-xl-10 col-lg-10 col-md-10 mb-3">
                    <div class="np-htitle black"><span>Карьера в Трайв</span></div>
                    <div class="np-hnote black"><span>У нас в компании ценятся инициатива, творческий подход и командный дух. Здесь каждый сотрудник
имеет возможность реализовать свой потенциал и достичь успеха в профессиональном росте. </span></div>
                </div>
                <div class="col-2 d-none d-xl-block text-right"><a href="/catalog/" class="np_link_dashed_gray"><img
                                src="<?= SITE_TEMPLATE_PATH ?>/images/np/hhru.jpg" style="width: 50px;position: absolute;
    left: -40px;
    top: -2px;"/>Вакансии на hh.ru</a></div>
            </div>

            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/np_main_page_company_preim.php"
                )
            );
            ?>

            <div class="row d-flex align-items-center">
                <div class="col-12 col-xl-10 col-lg-10 col-md-10 mb-3">
                    <div class="btn-group-blue mt-2"><a href="/about-company/"
                                                        class="btn-blue-big"><span>Подробнее</span><i
                                    class="fa fa-long-arrow-right" style="padding-left:10px;"></i></a></div>
                </div>
            </div>

        </div>


    </section>


    <section id="main_page_news_art" style="background-color:#ffffff;">

        <div class="container">
            <div class="row">
                <?php if (!$is_mobile): ?>
                <div class="col-12 col-xl-4 col-lg-4 col-md-4">
                    <div class="row">
                        <div class="col-12 col-xl-10 col-lg-12 col-md-12">
                            <div class="h1title mb-0"><a href="/news/"><span>Новости</span></a></div>
                        </div>

                        <div class="col-12 col-xl-12 col-lg-12 col-md-12">

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "main_page_news_2021",
                                array(
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "N",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array(0 => "", 1 => "",),
                                    "FILTER_NAME" => "",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "6",
                                    "IBLOCK_TYPE" => "content",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "1",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array(0 => "", 1 => "",),
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "SORT",
                                    "SORT_BY2" => "ACTIVE_FROM",
                                    "SORT_ORDER1" => "ASC",
                                    "SORT_ORDER2" => "DESC"
                                )
                            );
                            ?>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-xl-4 col-lg-4 col-md-4">

                    <div class="row">
                        <div class="col-12 col-xl-10 col-lg-12 col-md-12">
                            <div class="h1title mb-0"><a href="/articles/"><span>Статьи</span></a></div>
                        </div>
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12">

                            <?php
                            $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "main_page_articles_2021",
                                array(
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "N",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array(0 => "", 1 => "",),
                                    "FILTER_NAME" => "",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "7",
                                    "IBLOCK_TYPE" => "content",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "1",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array(0 => "", 1 => "",),
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "SORT",
                                    "SORT_BY2" => "ACTIVE_FROM",
                                    "SORT_ORDER1" => "ASC",
                                    "SORT_ORDER2" => "DESC"
                                )
                            );
                            ?>
                        </div>

                    </div>

                </div>
                <?php endif; ?>

                <div class="col-12 col-xl-4 col-lg-4 col-md-4">
                    <div class="row">
                        <div class="col-12 col-xl-10 col-lg-12 col-md-12">
                            <div class="<?= !$is_mobile ? 'h1title' : 'np-htitle mt-5'?> mb-0"><a href="/edu-center/"><span>Центр обучения</span></a></div>
                        </div>

                        <div class="col-12 col-xl-12 col-lg-12 col-md-12">

                            <div class="posts-wrap">
                                <div class="row posts-list">
                                    <div class="col-12 posts2-i" id="bx_3485106786_296174"><a class="posts-i-img"
                                                                                              href="/edu-center/"><span
                                                    style="background: url(<?= SITE_TEMPLATE_PATH ?>/images/uchcentre.jpeg)"></span></a>
                                        <div class="posts-i-ttl"><a href="/edu-center/"><span itemprop="headline">Курс Оператор станков с ЧПУ</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            /*
                            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "main_page_transit",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "COMPONENT_TEMPLATE" => "main_page_transit",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "48",
                    "IBLOCK_TYPE" => "content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "1",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "DATE_INSERT",
                        2 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "DESC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO"
                ),
                false
            );
                            */ ?>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </section>

    <section id="np_main_page_photogallery" class="d-none">

        <div class="container">

            <div class="row d-flex align-items-center">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
                    <div class='np-htitle'><span>Производственные мощности</span></div>
                </div>
            </div>

            <?php
            $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(7)->fetch();

            $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            $data = $entity_data_class::getList(array(
                "select" => array("*"),
                "filter" => array("LOGIC" => "OR", array("UF_PRO_NAME" => "Токарная обработка"), array("UF_PRO_NAME" => "Резка"))
            ));
            ?>
            <div class="row position-relative mt-5">
                <?php
                if (intval($data->getSelectedRowsCount()) > 0){
                while ($arData = $data->Fetch()) {
                    //echo $arData['UF_PHOTO'];


                    /*foreach ($arData['UF_PHOTO'] as $ikey=>$ival){*/
                    $imgEl = CFile::GetPath($arData['UF_PRO_IMAGE']);
                    //UF_NAME_STANOK
                    ?>
                    <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
                        <span href="#" class="np-mp-blink"><?php echo $arData['UF_NAME_STANOK']; ?></span>
                        <a href="<?php echo $imgEl; ?>" class="np-mp-photo-item bordered position-relative fancy-img"
                           data-fancybox="gallery">
                            <div class="np-mp-photo-img text-center"
                                 style="background-image:url(<?php echo $imgEl; ?>);"></div>
                        </a>
                    </div>
                    <?php
                    //}

                }
                ?>
            </div>
        <?php
        }
        ?>
        </div>

    </section>

    <section id="main_page_quicklinks">

        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-6 text-md-left text-center">
                    <div class="row h-100">
                        <div class="col-lg-12 col-md-12 text-md-left text-center">
                            <a href="/calculator/" class='np-quicklinks-item bordered'>
                                <div class='np-quicklinks-item-content'>
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/quicklinks1.jpg"
                                         class="np-quicklinks-item-content-img"/>
                                    <div class="np-quicklinks-item-title">Калькулятор крепежа и метизов</div>
                                    <p class="d-none d-md-block">Новейший калькулятор расчета массы крепежа.</p>
                                </div>
                                <!-- <div class="quicklinks-item-menu"><i class="fa fa-ellipsis-v"></i></div> -->
                            </a>
                        </div>

                        <div class="col-lg-6 col-md-12 text-md-left text-center d-none">
                            <a href="/price-list/" class='np-quicklinks-item bordered'>
                                <div class='np-quicklinks-item-content'>
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/quicklinks9.jpg"
                                         class="np-quicklinks-item-content-img"/>
                                    <div class="np-quicklinks-item-title">Каталог</div>
                                    <p class="d-none d-md-block">Наш ассортимент товаров.</p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="col-lg-7 col-md-6 col-sm-12 mb-30 text-md-left text-center mt-3 mt-md-0">
                    <div class="row h-100 np-quicklinks-conatiner-secondary">

                        <div class="col-lg-4 col-md-12 text-md-left text-center">
                            <a href="/gosti-na-krepezh/" class='np-quicklinks-item bordered'>
                                <div class='np-quicklinks-item-content d-flex d-md-block justify-content-center'>
                                    <!-- <img src="<?= SITE_TEMPLATE_PATH ?>/images/quicklinks4.jpg"/> -->
                                    <div class="np-quicklinks-item-title-big">ГОСТ</div>
                                    <div class="np-quicklinks-item-title">ГОСТ на крепеж</div>
                                    <p class="d-none d-md-block">Весь крепеж по стандарту ГОСТ.</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-12 text-md-left text-center">
                            <a href="/din-na-krepezh/" class='np-quicklinks-item bordered'>
                                <div class='np-quicklinks-item-content d-flex d-md-block justify-content-center'>
                                    <!-- <img src="<?= SITE_TEMPLATE_PATH ?>/images/quicklinks4.jpg"/> -->
                                    <div class="np-quicklinks-item-title-big">DIN</div>
                                    <div class="np-quicklinks-item-title">DIN на крепеж</div>
                                    <p class="d-none d-md-block">Весь крепеж по стандарту DIN.</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-12 text-md-left text-center">
                            <a href="/din-na-krepezh/" class='np-quicklinks-item bordered'>
                                <div class='np-quicklinks-item-content d-flex d-md-block justify-content-center'>
                                    <!-- <img src="<?= SITE_TEMPLATE_PATH ?>/images/quicklinks4.jpg"/> -->
                                    <div class="np-quicklinks-item-title-big">ОСТ</div>
                                    <div class="np-quicklinks-item-title">ОСТ на крепеж</div>
                                    <p class="d-none d-md-block">Весь крепеж по стандарту ОСТ.</p>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </section>

    <section id="np_main_page_callback">
        <?php if ($is_mobile): ?>
            <div class="row d-flex align-items-center d-md-none">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center mb-4 mb-md-5">
                    <div class="np-htitle text-left text-md-center ml-5 ml-md-0">
                        <span>Оставить заявку</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="np-callback-area">
            <div class="container fill">
                <div class="row d-flex align-items-center h-100 position-relative">
                    <?php if (!$is_mobile): ?>
                    <div class="col-lg-8 col-md-12 text-md-left text-center position-relative h-100 d-none d-md-block">
                        <div class="np-callback-area-in">
                            <div class='np-callback-area-title'><span>Контакты</span></div>
                            <div class='np-callback-area-note'><span>Отправьте заявку и мы свяжемся с вами.
Проконсультируем. Это бесплатно.</span></div>
                            <div class="btn-group-blue mt-5"><a href="/about-company/" class="btn-blue-big"><span>Подробнее</span><i
                                            class="fa fa-long-arrow-right" style="padding-left:10px;"></i></a></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-lg-4 col-md-12 text-md-left text-center position-relative h-100">
                        <?php
                        $APPLICATION->IncludeComponent(
                            "slam:easyform",
                            "traiv-land",
                            array(
                                "COMPONENT_TEMPLATE" => "traiv-land",
                                "FORM_ID" => "FORM109",
                                "FORM_NAME" => "Запрос лендинг",
                                "WIDTH_FORM" => "auto",
                                "DISPLAY_FIELDS" => array(
                                    0 => "TITLE",
                                    1 => "EMAIL",
                                    2 => "PHONE",
                                    3 => "",
                                ),
                                "REQUIRED_FIELDS" => array(
                                    0 => "PHONE",
                                    1 => "",
                                ),
                                "FIELDS_ORDER" => "TITLE,PHONE,EMAIL",
                                "FORM_AUTOCOMPLETE" => "Y",
                                "HIDE_FIELD_NAME" => "Y",
                                "HIDE_ASTERISK" => "N",
                                "FORM_SUBMIT_VALUE" => "Получить консультацию",
                                "SEND_AJAX" => "Y",
                                "SHOW_MODAL" => "N",
                                "_CALLBACKS" => "",
                                "TITLE_SHOW_MODAL" => "Спасибо!",
                                "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
                                "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
                                "ENABLE_SEND_MAIL" => "Y",
                                "CREATE_SEND_MAIL" => "",
                                "EVENT_MESSAGE_ID" => array(),
                                "EMAIL_TO" => "info@traiv-komplekt.ru",
                                "EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
                                "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Лендинг производство",
                                "EMAIL_FILE" => "Y",
                                "EMAIL_SEND_FROM" => "N",
                                "CREATE_SEND_MAIL_SENDER" => "",
                                "EVENT_MESSAGE_ID_SENDER" => array(
                                    0 => "121",
                                ),
                                "EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
                                "MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
                                "USE_IBLOCK_WRITE" => "Y",
                                "CATEGORY_TITLE_TITLE" => "Ваше имя",
                                "CATEGORY_TITLE_TYPE" => "text",
                                "CATEGORY_TITLE_PLACEHOLDER" => "Имя",
                                "CATEGORY_TITLE_VALUE" => "",
                                "CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
                                "CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
                                "CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
                                "CATEGORY_EMAIL_TYPE" => "email",
                                "CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
                                "CATEGORY_EMAIL_VALUE" => "",
                                "CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
                                "CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
                                "CATEGORY_PHONE_TITLE" => "Мобильный телефон",
                                "CATEGORY_PHONE_TYPE" => "tel",
                                "CATEGORY_PHONE_PLACEHOLDER" => "+7(999)999-99-99",
                                "CATEGORY_PHONE_VALUE" => "",
                                "CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
                                "CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
                                "CATEGORY_PHONE_INPUTMASK" => "Y",
                                "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
                                "USE_CAPTCHA" => "Y",
                                "USE_MODULE_VARNING" => "N",
                                "USE_FORMVALIDATION_JS" => "Y",
                                "HIDE_FORMVALIDATION_TEXT" => "N",
                                "INCLUDE_BOOTSRAP_JS" => "Y",
                                "USE_JQUERY" => "N",
                                "USE_BOOTSRAP_CSS" => "Y",
                                "USE_BOOTSRAP_JS" => "N",
                                "CUSTOM_FORM" => "",
                                "CAPTCHA_TITLE" => "",
                                "CATEGORY_DOCS_TITLE" => "Вложение",
                                "CATEGORY_DOCS_TYPE" => "file",
                                "CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
                                "CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
                                "CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
                                "USE_INPUTMASK_JS" => "Y",
                                "CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
                                "CATEGORY_______________________________________________TYPE" => "text",
                                "CATEGORY_______________________________________________PLACEHOLDER" => "",
                                "CATEGORY_______________________________________________VALUE" => "",
                                "CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
                                "CREATE_IBLOCK" => "",
                                "IBLOCK_TYPE" => "-",
                                "IBLOCK_ID" => "37",
                                "ACTIVE_ELEMENT" => "N",
                                "CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
                                "CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
                                "CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
                                "CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
                                "CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
                                "FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" class=\"polslam\" href=\"/politika-konfidentsialnosti/\" >персональных данных</a>",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                "ELEMENT_ID" => $arResult["ID"],
                                "FORMATED_NAME" => $formatedname,
                                "CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
                                "CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
                                "CATEGORY_HIDDEN_TYPE" => "hidden",
                                "CATEGORY_HIDDEN_VALUE" => "",
                                "CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
                            ),
                            false
                        );

                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php if (!$is_mobile): ?>
    <section id="main_page_map" class="d-none d-md-block">
        <div id="map_mp_np">

            <div class="map_office_area">

            </div>

        </div>
    </section>
    <?php endif; ?>

<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/new-main.css");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>