<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����");

$f = $_REQUEST['b'];
if ($f == 'sections') $f = 'firms';
switch($_REQUEST['b']){
	case 'articles': $name = '������'; break;
	case 'journals': $name = '�������'; break;
	case 'faq': $name = '������-�����'; break;
	case 'markets': $name = '�����'; break;
	case 'realty': $name = '������������'; break;
	case 'shops': $name = '��������'; break;
	case 'education': $name = '�����������'; break;
	case 'exhibitions': $name = '��������'; break;
	case 'documents': $name = '���������'; break;
	case 'firms': $name = '��������'; break;
	case 'sections': $name = '������ � ������'; break;
    case 'projects_catalog': $name = '������� �����'; break;
	
	default: $name = ''; break;
	
}
echo '<h1>���������� ������ &mdash; '.$name.'</h1>';
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
		"PAGER_TITLE" => "���������� ������",
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