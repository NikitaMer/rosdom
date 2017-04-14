<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детальный просмотр");
/*
$arSelect = Array("NAME", "PROPERTY_142", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID"=>'19', "ID"=>$_REQUEST['ELEMENT_CODE'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
$ob = $res->GetNextElement();
$arFields = $ob->GetFields();
//print_r($arFields);

$chain = array();
$section = $arFields['IBLOCK_SECTION_ID'];
while ($section != 0)
{
$res = CIBlockSection::GetByID($section);
if($ar_res = $res->GetNext()){
	$tchain['NAME'] = $ar_res['NAME'];
	$tchain['CODE'] = $ar_res['CODE'];
	$chain[] = $tchain;
	$section = $ar_res['IBLOCK_SECTION_ID'];
} else $section = 0;
}

$link = '/realty/';

for ($i = count($chain) - 1; $i >=0; $i--){
	$link .= $chain[$i]['CODE'].'/';
	$APPLICATION->AddChainItem($chain[$i]['NAME'], $link);
}

*/

?><?$APPLICATION->IncludeComponent("bitrix:news.detail", "realty_detail", array(
	"IBLOCK_TYPE" => "realty",
	"IBLOCK_ID" => "19",
	"ELEMENT_ID" => $_REQUEST["ELEMENT_CODE"],
	"ELEMENT_CODE" => "",
	"CHECK_DATES" => "Y",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "TELEPHONE",
		1 => "MKAD",
		2 => "COMMUNICATIONS",
		3 => "INFRASTRUCTURE",
		4 => "",
	),
	"IBLOCK_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"USE_PERMISSIONS" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Страница",
	"PAGER_TEMPLATE" => "",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"USE_SHARE" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
<?
//echo '123';

//$APPLICATION->AddChainItem($arFields['PROPERTY_142_VALUE'], '/realty/');


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>