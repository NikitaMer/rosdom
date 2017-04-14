<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Видео");
?>
<h1>Видео</h1>
 <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_video_sec_list", Array(
	"IBLOCK_TYPE" => "video",	// Тип инфо-блока
	"IBLOCK_ID" => "13",	// Инфо-блок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],	// Код раздела
	"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
	"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
	"SECTION_FIELDS" => array(	// Поля разделов
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// Свойства разделов
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "/video/#SECTION_CODE#/",	// URL, ведущий на страницу с содержимым раздела
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	),
	false
);?> 
		

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>