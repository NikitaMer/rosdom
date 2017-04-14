<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Ð ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ.");
?><?$APPLICATION->IncludeComponent("rosdom:iblock.element.add.form", "rosdom_my_articles_list", array(
	"IBLOCK_TYPE" => "faq",
	"IBLOCK_ID" => "14",
	"STATUS_NEW" => "ANY",
	"LIST_URL" => "/personal/my/faq/edit_step2.php",
	"USE_CAPTCHA" => "N",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "",
	"DEFAULT_INPUT_SIZE" => "50",
	"RESIZE_IMAGES" => "Y",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "TAGS",
		2 => "DETAIL_TEXT",
		3 => "146",
		4 => "145",
		5 => "147",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "NAME",
		1 => "DETAIL_TEXT",
	),
	"GROUPS" => array(
		0 => "5",
	),
	"STATUS" => "ANY",
	"ELEMENT_ASSOC" => "CREATED_BY",
	"MAX_USER_ENTRIES" => "100000",
	"MAX_LEVELS" => "100000",
	"LEVEL_LAST" => "N",
	"MAX_FILE_SIZE" => "1000000",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/my/faq/",
	"CUSTOM_TITLE_NAME" => "Âîïðîñ",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_IBLOCK_CONNECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "Îòâåò",
	"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	),
	false
);?> 
<div class="clear"></div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>