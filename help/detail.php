<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_help_detail", array(
	"IBLOCK_TYPE" => "generated",
	"IBLOCK_ID" => "33",
	"SECTION_ID" => "",
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
	"COUNT_ELEMENTS" => "N",
	"TOP_DEPTH" => "3",
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
	"ADD_SECTIONS_CHAIN" => "Y"
	),
	false
);?>
 
  <div></div>
 </section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>