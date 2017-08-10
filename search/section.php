<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");

$f = $_REQUEST['b'];
if ($f == 'sections') $f = 'firms';
switch($_REQUEST['b']){
	case 'articles': $name = 'Статьи'; break;
	case 'journals': $name = 'Журналы'; break;
	case 'faq': $name = 'Вопрос-ответ'; break;
	case 'markets': $name = 'Рынки'; break;
	case 'realty': $name = 'Недвижимость'; break;
	case 'shops': $name = 'Магазины'; break;
	case 'education': $name = 'Образование'; break;
	case 'exhibitions': $name = 'Выставки'; break;
	case 'documents': $name = 'Документы'; break;
	case 'firms': $name = 'Компании'; break;
	case 'sections': $name = 'Товары и услуги'; break;
    case 'projects_catalog': $name = 'Проекты домов'; break;
	
	default: $name = ''; break;
	
}
echo '<h1>Результаты поиска &mdash; '.$name.'</h1>';
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"section_search", 
	array(
		"RESTART" => "Y",
		"NO_WORD_LOGIC" => "N",
		"CHECK_DATES" => "N",
		"USE_TITLE_RANK" => "N",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "",
		"arrFILTER" => array(
			0 => "iblock_".$_REQUEST['b'],
		),
		"SHOW_WHERE" => "N",
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "20",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"USE_LANGUAGE_GUESS" => "Y",
		"USE_SUGGEST" => "N",
		"SHOW_ITEM_TAGS" => "Y",
		"TAGS_INHERIT" => "Y",
		"SHOW_ITEM_DATE_CHANGE" => "Y",
		"SHOW_ORDER_BY" => "Y",
		"SHOW_TAGS_CLOUD" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "section_search",
		"arrFILTER_iblock_articles" => array(
			0 => "all",
		),
		"arrFILTER_iblock_services" => array(
			0 => "all",
		),
		"arrFILTER_iblock_generated" => array(
			0 => "all",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>