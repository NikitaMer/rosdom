<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (CModule::IncludeModule("iblock")):

$id = $_REQUEST["ELEMENT_CODE"];

$ci = CIBlockElement::GetByID($id);
if ($el = $ci->GetNext()) {
	$secs = CIBlockSection::GetByID($el["IBLOCK_SECTION_ID"]);
	if ($sec = $secs->GetNext()) $add = $sec["CODE"];

	$i=0;
	foreach ($arResult as $arItem) {
	    $prev_l = $arItem['DEPTH_LEVEL'];
	    if ($arItem['DEPTH_LEVEL'] == 1) $lev1 = $i;

	    if ($arItem["TEXT"] == $sec["NAME"]){
		$arItem["SELECTED"] = 1;
		$mark = $lev1;
	     }
	    $i++;
	    if ($arItem['DEPTH_LEVEL']<$prev_l) $lev1 = -1;
	    $temp[] = $arItem;
	}

	if ($mark >= 0) $temp[$mark]["SELECTED"] = 1;
	//$temp[$mark]["QQQ"] = $mark;

	$arResult=$temp;
}; 

endif;
?>
