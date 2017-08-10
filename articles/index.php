<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статьи о ремонте, инструментах, мебели на портале rosdom.ru ");
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_article_list", Array(
	"IBLOCK_TYPE" => "articles",	// Тип инфо-блока
	"IBLOCK_ID" => "9",	// Инфо-блок
	"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],	// Код раздела
	"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
	"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
	"SECTION_FIELDS" => array(	// Поля разделов
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// Свойства разделов
		0 => "UF_DESCRIPTION",
		1 => "UF_KEYWORDS",
		2 => "UF_METATITLE",
		3 => "UF_MENUTITLE",
		4 => "",
	),
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>