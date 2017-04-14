<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");?> 
<? ///search?>
<?$APPLICATION->IncludeComponent("bitrix:search.page", "", array(
	"RESTART" => "Y",
	"NO_WORD_LOGIC" => "N",
	"CHECK_DATES" => "Y",
	"USE_TITLE_RANK" => "Y",
	"DEFAULT_SORT" => "rank",
	"FILTER_NAME" => "",
	"arrFILTER" => array(
		0 => "iblock_generated",
		1 => "iblock_firms",
		2 => "iblock_articles",
		3 => "iblock_faq",
		4 => "iblock_video",
		5 => "iblock_documents",
		6 => "iblock_services",
		7 => "iblock_photos",
		8 => "iblock_realty",
	),
	"arrFILTER_iblock_generated" => array(
		0 => "all",
	),
	"arrFILTER_iblock_firms" => array(
		0 => "all",
	),
	"arrFILTER_iblock_articles" => array(
		0 => "all",
	),
	"arrFILTER_iblock_faq" => array(
		0 => "all",
	),
	"arrFILTER_iblock_documents" => array(
		0 => "all",
	),
	"arrFILTER_iblock_services" => array(
		0 => "all",
	),
	"arrFILTER_iblock_photos" => array(
		0 => "all",
	),
	"arrFILTER_iblock_video" => array(
		0 => "all",
	),
	"arrFILTER_iblock_realty" => array(
		0 => "all",
	),
	"SHOW_WHERE" => "N",
	"SHOW_WHEN" => "Y",
	"PAGE_RESULT_COUNT" => "10000",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Результаты поиска",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"USE_LANGUAGE_GUESS" => "N",
	"USE_SUGGEST" => "N",
	"SHOW_ITEM_TAGS" => "Y",
	"TAGS_INHERIT" => "Y",
	"SHOW_ITEM_DATE_CHANGE" => "Y",
	"SHOW_ORDER_BY" => "Y",
	"SHOW_TAGS_CLOUD" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>