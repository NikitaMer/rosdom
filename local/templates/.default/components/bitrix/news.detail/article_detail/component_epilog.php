<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<? 
global $APPLICATION;
CModule::IncludeModule('iblock');


if (!empty($arResult["DISPLAY_PROPERTIES"]["DESCRIPTION"]["VALUE"])) $APPLICATION->SetPageProperty("description", $arResult["DISPLAY_PROPERTIES"]["DESCRIPTION"]["VALUE"]); 
if (!empty($arResult["DISPLAY_PROPERTIES"]["KEYWORDS"]["VALUE"])) $APPLICATION->SetPageProperty("keywords", $arResult["DISPLAY_PROPERTIES"]["KEYWORDS"]["VALUE"]); 
if (!empty($arResult["DISPLAY_PROPERTIES"]["METATITLE"]["VALUE"])) $APPLICATION->SetPageProperty("title", $arResult["DISPLAY_PROPERTIES"]["METATITLE"]["VALUE"]);

// Для передачи IBLOCK_SECTION_ID в компанент, для отоброжения новостей только этого инфоблока
$_SESSION['SECTION_ID'] = $arResult['IBLOCK_SECTION_ID'];
$_SESSION['ELEMENT_ID'] = $arResult['ID']; 
?>
