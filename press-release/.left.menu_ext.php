 <? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("rosdom:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/press-release/",
	"SECTION_PAGE_URL" => "#CODE#/",
	"DETAIL_PAGE_URL" => "#CODE#/#ELEMENT_CODE#/",
	"IBLOCK_TYPE" => "press-release",
	"IBLOCK_ID" => "34",
	"DEPTH_LEVEL" => "1",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);

//	echo '<pre>';	print_r($aMenuLinksExt);	echo '</pre>';

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

?> 
