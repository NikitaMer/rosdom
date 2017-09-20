<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->                   
<html lang="<?=LANGUAGE_ID?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />


    <meta name="google-site-verification" content="bjjl6ds0M0xsC7WgUMyMDNWzraV-8RAXD4X8h7Q1DDg" />
    <meta name='yandex-verification' content='625c24d2c596b38e' />
    <meta name="cmsmagazine" content="4c547883b1fca0f4fb69c5ffab088159" />
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>


    <script src="<?=SITE_TEMPLATE_PATH?>/js/modernizr-1.6.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/js.js"></script>
    <script type="text/javascript" src="/js/gray.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/fancybox/jquery.fancybox-1.3.4.js"></script>
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />



    <script src="<?=SITE_TEMPLATE_PATH?>/js/button_1plus.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/google-analitics.js"></script>


    <!--[if lt IE 7 ]>
    <script src="js/dd_belatedpng.js"></script>
    <script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
    <![endif]-->

</head>
<body>
<?   CModule::IncludeModule("iblock"); ?>

<div id="grayBG" style="position:absolute; left:0; top:0; display:none; z-index:8;"></div>
<div id="grayBGMessage" style="position:absolute; left:0; top:0; display:none; z-index:12;"></div>

<?$APPLICATION->ShowPanel();?>
<div class="gl-wrapper">
<header>
    <span class="logo"><a href="/"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.gif" alt="Rosdom" /></a></span>
    <div class="top-links">

        <nav>
            <ul>
                <li><a href="/map/">Карта сайта</a></li>
                <!--<li><a href="#">RSS</a></li>
                <li><a href="#">Atom</a></li>
                <li><a href="#">E-mail рассылка</a></li>-->
            </ul>
        </nav>
    </div>

    <div class="authorization" style="z-index: 11">
        <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"auth", 
	array(
		"REGISTER_URL" => "/personal/registration/",
		"FORGOT_PASSWORD_URL" => "/personal/registration/forgot_pass.php",
		"PROFILE_URL" => "/personal/profile/",
		"SHOW_ERRORS" => "N",
		"COMPONENT_TEMPLATE" => "auth"
	),
	false
);?>

    </div>

    <div class=topsubmenu>

    </div>

    <div class="search">
        <?$APPLICATION->IncludeComponent("bitrix:search.form", "search_form", array(
                "PAGE" => "#SITE_DIR#search/index.php",
                "USE_SUGGEST" => "N"
                ),
                false
            );?>
    </div>

    <div class="infomenu">
        <?
            $APPLICATION->IncludeComponent("bitrix:menu", "rosdom_infomenu", array(
                "ROOT_MENU_TYPE" => "infomenu",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => "",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N"
                ),
                false,
                array(
                    "ACTIVE_COMPONENT" => "Y"
                )
            );

        ?>

    </div>
    <section class="b-tabs-descriptions w-tabs">
        <div class="b-tabs">
            <nav>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "rosdom_sub_menu", array(
                        "ROOT_MENU_TYPE" => "top",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "4",
                        "CHILD_MENU_TYPE" => "",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N"
                        ),
                        false,
                        array(
                            "ACTIVE_COMPONENT" => "Y"
                        )
                    );?>
                <div class="clear_both"></div>
            </nav>
        </div>
        <div class="b-descriptions">

            <!--            <div id="ask_form" class="description">
            <?/*  $APPLICATION->IncludeComponent("bitrix:form", "faq_form", Array(
                "START_PAGE" => "new",    // Начальная страница
                "SHOW_LIST_PAGE" => "N",    // Показывать страницу со списком результатов
                "SHOW_EDIT_PAGE" => "N",    // Показывать страницу редактирования результата
                "SHOW_VIEW_PAGE" => "N",    // Показывать страницу просмотра результата
                "SUCCESS_URL" => "/faq/success.php",    // Страница с сообщением об успешной отправке
                "WEB_FORM_ID" => "2",    // ID веб-формы
                "RESULT_ID" => $_REQUEST[RESULT_ID],    // ID результата
                "SHOW_ANSWER_VALUE" => "N",    // Показать значение параметра ANSWER_VALUE
                "SHOW_ADDITIONAL" => "N",    // Показать дополнительные поля веб-формы
                "SHOW_STATUS" => "Y",    // Показать текущий статус результата
                "EDIT_ADDITIONAL" => "N",    // Выводить на редактирование дополнительные поля
                "EDIT_STATUS" => "Y",    // Выводить форму смены статуса
                "NOT_SHOW_FILTER" => array(    // Коды полей, которые нельзя показывать в фильтре
                0 => "",
                1 => "",
                ),
                "NOT_SHOW_TABLE" => array(    // Коды полей, которые нельзя показывать в таблице
                0 => "",
                1 => "",
                ),
                "IGNORE_CUSTOM_TEMPLATE" => "N",    // Игнорировать свой шаблон
                "USE_EXTENDED_ERRORS" => "Y",    // Использовать расширенный вывод сообщений об ошибках
                "SEF_MODE" => "N",    // Включить поддержку ЧПУ
                "SEF_FOLDER" => "/test/",    // Каталог ЧПУ (относительно корня сайта)
                "AJAX_MODE" => "Y",    // Включить режим AJAX
                "AJAX_OPTION_SHADOW" => "N",    // Включить затенение
                "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N",    // Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                "CACHE_TYPE" => "A",    // Тип кеширования
                "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                "CHAIN_ITEM_TEXT" => "",    // Название дополнительного пункта в навигационной цепочке
                "CHAIN_ITEM_LINK" => "",    // Ссылка на дополнительном пункте в навигационной цепочке
                "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                "VARIABLE_ALIASES" => array(
                "action" => "action",
                )
                ),
                false
            ); */?>
            </div>-->
            <?global $description_visible;?>
            <div class="description<?if($description_visible):?> visible<?endif?>" id="main_plank">

                <?/*$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                    "AREA_FILE_SHOW" => "page",
                    "AREA_FILE_SUFFIX" => "inctoppage",
                    "EDIT_TEMPLATE" => ""
                    ),
                    false
                );*/?>
                <?/*$APPLICATION->IncludeComponent("bitrix:main.include", "firms_top_submenu", Array(
                    "AREA_FILE_SHOW" => "sect",    // Показывать включаемую область
                    "AREA_FILE_SUFFIX" => "inctop",    // Суффикс имени файла включаемой области
                    "AREA_FILE_RECURSIVE" => "Y",    // Рекурсивное подключение включаемых областей разделов
                    "EDIT_TEMPLATE" => "",    // Шаблон области по умолчанию
                    ),
                    false
                );*/?>
            </div>

        </div>
    </section>
</header>
<aside>

    <?if($APPLICATION->GetCurDir()=='/'):?>
        <?//require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include/catalog_menu.php");?>
        <?endif?>
    <?$APPLICATION->ShowViewContent('filter'); // вывод фильтра каталога?>
    <?
        /*
        $APPLICATION->IncludeComponent(    // вывод меню разделов проектов
        "bitrix:catalog.section.list",
        "section_left_menu",
        array(
        "VIEW_MODE" => "TEXT",
        "SHOW_PARENT_NAME" => "Y",
        "IBLOCK_TYPE" => "projects_catalog",
        "IBLOCK_ID" => "37",
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_CODE" => "",
        "SECTION_URL" => "/project/#SECTION_CODE#/",
        "COUNT_ELEMENTS" => "N",
        "TOP_DEPTH" => "1",
        "SECTION_FIELDS" => array(
        0 => "",
        1 => "",
        ),
        "SECTION_USER_FIELDS" => array(
        0 => "UF_SHOW_MENU",
        1 => "UF_SORT_MENU",
        2 => "",
        ),
        "ADD_SECTIONS_CHAIN" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "Y",
        "COMPONENT_TEMPLATE" => "section_left_menu"
        ),
        false
        );?>

        <?$APPLICATION->ShowViewContent('filter'); // вывод фильтра каталога
        */
    ?>

    <? $sect = explode("/", $_SERVER['REQUEST_URI']); ?>
    <?if($sect["1"] !== "firms"){ ?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left_menu",
            array(
                "ROOT_MENU_TYPE" => "left",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MAX_LEVEL" => "4",
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "Y",
                "DELAY" => "Y",
                "ALLOW_MULTI_SELECT" => "N",
                "COMPONENT_TEMPLATE" => "left_menu"
            ),
            false,
            array(
                "ACTIVE_COMPONENT" => "Y"
            )
        )?>
        <? } ?>

    <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "firms_top_submenu",
            array(
                "AREA_FILE_SUFFIX" => "inc",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php",
                "COMPONENT_TEMPLATE" => "firms_top_submenu",
                "AREA_FILE_SHOW" => "page"
            ),
            false,
            array(
                "ACTIVE_COMPONENT" => "Y"
            )
        );?>


    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
        "AREA_FILE_SHOW" => "sect",
        "AREA_FILE_SUFFIX" => "inc",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php"
        ),
        false,
        array(
        "ACTIVE_COMPONENT" => "N"
        )
    );*/?>
    <script type="text/javascript"><!--
        google_ad_client = "ca-pub-5601470063074614";
        /* Главная (левая) */
        google_ad_slot = "8635621308";
        google_ad_width = 250;
        google_ad_height = 250;
        //-->
    </script>
    <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
    <div style="padding-bottom:20px;"> </div>

    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => "/about/error_on_site.php",
            "EDIT_TEMPLATE" => "standard.php"
            ),
            false,
            array(
                "ACTIVE_COMPONENT" => "N"
            )
        );?>
    <div style="margin:25px 0">
        <a href=/projects/><img src=/i2/2000.jpg alt="Каталог проектов домов, коттеджей" title="Каталог проектов домов, коттеджей" /></a>
    </div>
</aside>
<article>

<?if($APPLICATION->sDocPath2 != '/index.php'):?>

    <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb", 
            "rosdom", 
            array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1",
                "COMPONENT_TEMPLATE" => "rosdom"
            ),
            false
        );?>
    <?endif;?>


