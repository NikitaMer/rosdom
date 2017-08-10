<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?> <section class="faq"> 


  <?$APPLICATION->IncludeComponent("rosdom:iblock.element.add.form", "rosdom_my_firm_list", array(
	"IBLOCK_TYPE" => "firms",
	"IBLOCK_ID" => "10",
	"STATUS_NEW" => "ANY",
	"LIST_URL" => "/personal/my/firms/edit_step2.php",
	"USE_CAPTCHA" => "N",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "",
	"DEFAULT_INPUT_SIZE" => "50",
	"RESIZE_IMAGES" => "Y",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "PREVIEW_PICTURE",
		2 => "DETAIL_TEXT",
		3 => "54",
		4 => "55",
		5 => "56",
		6 => "57",
		7 => "117",
		8 => "60",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "NAME",
		1 => "54",
		2 => "57",
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
	"MAX_FILE_SIZE" => "500000",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/",
	"CUSTOM_TITLE_NAME" => "Название компании",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_IBLOCK_CONNECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "Логотип компании",
	"CUSTOM_TITLE_DETAIL_TEXT" => "",
	"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	),
	false
);?>
 
  <div></div>
 
  <div></div>
 </section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>