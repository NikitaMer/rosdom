<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить вопрос");
?><br />
 <?$APPLICATION->IncludeComponent(
	"bitrix:infoportal.element.add.form",
	"",
	Array(
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "faq",
		"IBLOCK_ID" => "14",
		"PROPERTY_CODES" => array("NAME","69","71","72","73","74","75","76"),
		"PROPERTY_CODES_REQUIRED" => array("NAME","69","71","72","73"),
		"GROUPS" => array("1"),
		"STATUS_NEW" => "2",
		"STATUS" => array("2"),
		"LIST_URL" => "",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "Вопрос сохранен!",
		"USER_MESSAGE_ADD" => "Вопрос добавлен!",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "N",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"CUSTOM_TITLE_NAME" => "Заголовок",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	)
);?> 
<br /><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>