<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<? 
global $APPLICATION;
CModule::IncludeModule('iblock');
?>

<?$APPLICATION->SetTitle($arResult["SECTION"]["NAME"]);?>
<?$APPLICATION->SetPageProperty("title", $arResult["SECTION"]["NAME"]);?>