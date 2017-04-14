 <? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("rosdom:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "",
	"SECTION_PAGE_URL" => "#SECTION_CODE#/",
	"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_ID#",
	"IBLOCK_TYPE" => "generated",
	"IBLOCK_ID" => "25",
	"DEPTH_LEVEL" => "3",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);

//		echo "<pre>";
//		print_r($aMenuLinksExt);
//		echo "</pre>";

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

?> 