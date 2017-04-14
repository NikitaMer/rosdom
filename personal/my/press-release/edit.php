<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Р РµРіРёСЃС‚СЂР°С†РёСЏ.");
?><?$APPLICATION->IncludeComponent("rosdom:iblock.element.add.form", "rosdom_my_articles_list", array(
	"IBLOCK_TYPE" => "pressrelease",
	"IBLOCK_ID" => "34",
	"STATUS_NEW" => "ANY",
	"LIST_URL" => "/personal/my/press-release/edit_step2.php",
	"USE_CAPTCHA" => "N",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "",
	"DEFAULT_INPUT_SIZE" => "50",
	"RESIZE_IMAGES" => "Y",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "TAGS",
		2 => "DATE_ACTIVE_FROM",
		3 => "DETAIL_TEXT",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "NAME",
		1 => "DATE_ACTIVE_FROM",
		2 => "DETAIL_TEXT",
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
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/my/faq/",
	"CUSTOM_TITLE_NAME" => "Заголовок",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "Дата пресс-релиза",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_IBLOCK_CONNECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "Текст пресс-релиза",
	"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	),
	false
);?> 
<div class="clear"></div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>