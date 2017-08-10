<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/(equipment|material|interior|machinery|service)/([a-zA-Z0-9_\\-]+)/([a-zA-Z0-9_\\-]+)/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_NAME=\$4",
		"ID" => "",
		"PATH" => "/firms/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/(equipment|material|interior|machinery|service)/([a-zA-Z0-9_\\-]+)/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_NAME=\$3",
		"ID" => "",
		"PATH" => "/firms/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/(equipment|material|interior|machinery|service)/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_NAME=\$2",
		"ID" => "",
		"PATH" => "/firms/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/documents/([a-zA-Z0-9_\\-]+)/([a-zA-Z0-9_\\-]+)/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$3",
		"ID" => "",
		"PATH" => "/documents/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/realty/([a-zA-Z_\\-]+)/([a-zA-Z_\\-]+)/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$2&ELEMENT_CODE=\$3",
		"ID" => "",
		"PATH" => "/realty/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/(equipment|material|interior|machinery|service)/(\\?+.*|\$)#",
		"RULE" => "SECTION_NAME=\$1",
		"ID" => "",
		"PATH" => "/firms/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/documents/([a-zA-Z0-9_\\-]+)/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$2",
		"ID" => "",
		"PATH" => "/documents/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/articles/([a-zA-Z_\\-]+)/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$2",
		"ID" => "",
		"PATH" => "/articles/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/information/links/([a-zA-Z0-9_]+)/\\?{0,1}(.*)\$#",
		"RULE" => "/information/links/index.php?SECTION_CODE=\\1&\\2",
		"ID" => "",
		"PATH" => "",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/realty/([a-zA-Z_\\-]+)/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "MAIN_SECTION_CODE=\$1&SECTION_CODE=\$2",
		"ID" => "",
		"PATH" => "/realty/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/information/links/([a-zA-Z0-9_]+)/\\?{0,1}(.*)\$#",
		"RULE" => "/information/links/index.php?SECTION_CODE=\\1&\\2",
		"ID" => "",
		"PATH" => "/articles/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/press-release/press-release([0-9]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/press-release/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/faq/([a-zA-Z_\\-]+)/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$2",
		"ID" => "",
		"PATH" => "/faq/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/markets/markets([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/markets/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/exhibitions/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/exhibitions/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/shops/shops([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/exhibitions/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/press-release/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/press-release/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/shops/shops([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/shops/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/shops/shops([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/press-release/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/documents/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/magazines/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/magazines/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "CODE=\$1",
		"ID" => "",
		"PATH" => "/magazines/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/documents/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/documents/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/documents/([a-zA-Z0-9_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/documents/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#",
		"RULE" => "alias=\$1",
		"ID" => "bitrix:im.router",
		"PATH" => "/desktop_app/router.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/education/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/articles/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/education/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/education/section.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/articles/article([0-9]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/articles/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/firms/([a-zA-Z_\\-]+)/\\?{0,1}(.*)\$#",
		"RULE" => "/firms/detail.php?ELEMENT_CODE=\\1&\\2",
		"ID" => "",
		"PATH" => "",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/articles/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/articles/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/articles/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/articles/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/articles/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/projects/([a-z0-9_-]+)/(\\?+.*|\$)#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/project/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/markets/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/markets/section.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/firms/firm([0-9]+)/\\?{0,1}(.*)\$#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/firms/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/realty/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/video/([a-zA-Z_\\-)]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/video/list.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/shops/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/shops/section.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/shops/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/realty/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/video/video([0-9]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/video/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/help/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/help/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/help/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/help/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/faq/([a-zA-Z_\\-]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/faq/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/faq/faq([0-9]+)/(\\?+.*|\$)#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/faq/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/photo/([0-9]+)/(\\?+.*|\$)#",
		"RULE" => "SECTION_CODE=\$1&SECTION_ID=\$1",
		"ID" => "",
		"PATH" => "/photo/section.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/faq/detail.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/online/(/?)([^/]*)#",
		"RULE" => "",
		"ID" => "bitrix:im.router",
		"PATH" => "/desktop_app/router.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/stssync/calendar/#",
		"RULE" => "",
		"ID" => "bitrix:stssync.server",
		"PATH" => "/bitrix/services/stssync/calendar/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/projects/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/projects/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/projects/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/project/index.php",
		"SORT" => "100",
	),
);
?>