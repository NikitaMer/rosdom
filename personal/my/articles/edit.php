<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Р РµРіРёСЃС‚СЂР°С†РёСЏ.");
?><?$APPLICATION->IncludeComponent("rosdom:iblock.element.add.form", "rosdom_my_articles_list", array(
	"IBLOCK_TYPE" => "articles",
	"IBLOCK_ID" => "9",
	"STATUS_NEW" => "ANY",
	"LIST_URL" => "/personal/my/articles/edit_step2.php",
	"USE_CAPTCHA" => "N",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "",
	"DEFAULT_INPUT_SIZE" => "50",
	"RESIZE_IMAGES" => "Y",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "TAGS",
		2 => "PREVIEW_TEXT",
		3 => "DETAIL_TEXT",
		4 => "DETAIL_PICTURE",
		5 => "123",
		6 => "121",
		7 => "120",
		8 => "177",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "NAME",
		1 => "PREVIEW_TEXT",
		2 => "DETAIL_TEXT",
	),
	"GROUPS" => array(
		0 => "1",
		1 => "5",
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
	"SEF_FOLDER" => "/personal/my/articles/",
	"CUSTOM_TITLE_NAME" => "Название статьи",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_IBLOCK_CONNECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "Анонс (будет выводиться в списке)",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "Текст статьи",
	"CUSTOM_TITLE_DETAIL_PICTURE" => "Картинка (будет вставлена в левый верхний угол в статье)"
	),
	false
);?>
<div class="clear"></div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>