<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<pre>'; print_r($_REQUEST["SECTION_CODE"]);print "</pre>";?>

<? 

global $APPLICATION;
CModule::IncludeModule('iblock');


if (!empty($arResult["DISPLAY_PROPERTIES"]["DESCRIPTION"]["VALUE"])) $APPLICATION->SetPageProperty("description", $arResult["DISPLAY_PROPERTIES"]["DESCRIPTION"]["VALUE"]); 
if (!empty($arResult["DISPLAY_PROPERTIES"]["KEYWORDS"]["VALUE"])) $APPLICATION->SetPageProperty("keywords", $arResult["DISPLAY_PROPERTIES"]["KEYWORDS"]["VALUE"]); 
if (!empty($arResult["DISPLAY_PROPERTIES"]["METATITLE"]["VALUE"])) $APPLICATION->SetPageProperty("title", $arResult["DISPLAY_PROPERTIES"]["METATITLE"]["VALUE"]); 
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>