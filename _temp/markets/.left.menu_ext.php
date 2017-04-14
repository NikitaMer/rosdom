 <? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("rosdom:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/markets/",
	"SECTION_PAGE_URL" => "#CODE#/",
	"DETAIL_PAGE_URL" => "#CODE#/#ELEMENT_CODE#/",
	"IBLOCK_TYPE" => "markets",
	"IBLOCK_ID" => "20",
	"DEPTH_LEVEL" => "3",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"ALT_LINK" => "N",
	"USE_ID" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);
//	echo '<pre>';
//	print_r($aMenuLinksExt);
//	echo '</pre>';

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

?> 
