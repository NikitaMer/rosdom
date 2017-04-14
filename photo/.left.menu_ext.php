 <? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/photo/",
	"SECTION_PAGE_URL" => "#SECTION_ID#/",
	"DETAIL_PAGE_URL" => "#CODE#/#ELEMENT_ID#/",
	"IBLOCK_TYPE" => "photos",
	"IBLOCK_ID" => "31",
	"DEPTH_LEVEL" => "4",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);


$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

?> 
