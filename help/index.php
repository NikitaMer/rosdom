<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Помощь");

?> 
<h1>Помощь</h1>
 
<div> 
  <br />
 </div>
 
<div> <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_help", Array(
	"IBLOCK_TYPE" => "generated",	// Тип инфоблока
	"IBLOCK_ID" => "33",	// Инфоблок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],	// Код раздела
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
	"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
	"SECTION_FIELDS" => "",	// Поля разделов
	"SECTION_USER_FIELDS" => "",	// Свойства разделов
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);?> </div>
 
<div> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>