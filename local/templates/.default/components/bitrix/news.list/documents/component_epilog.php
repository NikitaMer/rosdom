<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<? 
//echo '<pre>'; print_r($arResult); echo '</pre>';

global $APPLICATION;
CModule::IncludeModule('iblock');

$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>15, "CODE" =>$_REQUEST["SECTION_CODE"]), false, Array("UF_DESCRIPTION", "UF_KEYWORDS", "UF_METATITLE"));

	while($ar_result = $db_list->GetNext())  {
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]); 
		if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]); 
		if (!empty($ar_result["UF_METATITLE"])) $APPLICATION->SetPageProperty("title", $ar_result["UF_METATITLE"]); 
					else $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][0]["NAME"]); 
	}
?>
