<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "װמעמדאכונוט");
$APPLICATION->SetTitle("װמעמדאכונוט");
?>

<section class="faq"> 
  <h1>װמעמדאכונוט</h1>
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"rosdom_photo_list", 
	array(
		"IBLOCK_TYPE" => "photos",
		"IBLOCK_ID" => "31",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"COMPONENT_TEMPLATE" => "rosdom_photo_list"
	),
	false
);?> </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>