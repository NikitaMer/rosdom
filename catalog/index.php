<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить карточку фирмы");
?><h2>Добавить фирму</h2>
<?$APPLICATION->IncludeComponent("bitrix:infoportal.element.add.form", "company_add", array(
	"IBLOCK_TYPE" => "firms",
	"IBLOCK_ID" => "10",
	"STATUS_NEW" => "2",
	"LIST_URL" => "",
	"USE_CAPTCHA" => "N",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "",
	"DEFAULT_INPUT_SIZE" => "30",
	"RESIZE_IMAGES" => "N",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "IBLOCK_SECTION",
		2 => "PREVIEW_PICTURE",
		3 => "DETAIL_TEXT",
		4 => "54",
		5 => "55",
		6 => "56",
		7 => "57",
		8 => "117",
		9 => "60",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "NAME",
		1 => "54",
		2 => "57",
		3 => "60",
	),
	"GROUPS" => array(
	),
	"STATUS" => array(
		0 => "2",
	),
	"ELEMENT_ASSOC" => "CREATED_BY",
	"MAX_USER_ENTRIES" => "100000",
	"MAX_LEVELS" => "100000",
	"LEVEL_LAST" => "N",
	"MAX_FILE_SIZE" => "0",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/add/",
	"CUSTOM_TITLE_NAME" => "Название фирмы",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "",
	"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>