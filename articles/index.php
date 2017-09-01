<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статьи о ремонте, инструментах, мебели на портале rosdom.ru ");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"rosdom_article_list", 
	array(
		"IBLOCK_TYPE" => "articles",
		"IBLOCK_ID" => "9",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_DESCRIPTION",
			1 => "UF_KEYWORDS",
			2 => "UF_METATITLE",
			3 => "UF_MENUTITLE",
			4 => "",
		),
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"COMPONENT_TEMPLATE" => "rosdom_article_list"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>