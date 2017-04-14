<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

?> 

 
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_press_list", array(
	"IBLOCK_TYPE" => "pressrelease",
	"IBLOCK_ID" => "34",
	"SECTION_ID" => "",
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
	"COUNT_ELEMENTS" => "N",
	"TOP_DEPTH" => "2",
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
	"CACHE_GROUPS" => "N",
	"ADD_SECTIONS_CHAIN" => "N"
	),
	false
);?> 
 

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>