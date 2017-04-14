<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $APPLICATION;
CModule::IncludeModule('iblock');
    
    $res = GetIBlockElement($arResult['ID']); 

	if (!empty($arResult['PROPERTIES']['DESCRIPTION']['VALUE'])) $APPLICATION->SetPageProperty("description", $arResult['PROPERTIES']['DESCRIPTION']['VALUE']);
	else {
		$result = implode(array_slice(explode('<br>',wordwrap($res['~DETAIL_TEXT'],265,'<br>',false)),0,1));
		$APPLICATION->SetPageProperty("description",  $result);
	}

	if (!empty($arResult['PROPERTIES']['KEYWORDS']['VALUE'])) $APPLICATION->SetPageProperty("keywords", $arResult['PROPERTIES']['KEYWORDS']['VALUE']);
    else {
        $APPLICATION->SetPageProperty("keywords", ' ');    
    }
	if (!empty($arResult['PROPERTIES']['METATITLE']['VALUE'])) {
		$APPLICATION->SetPageProperty("title", $arResult['PROPERTIES']['METATITLE']['VALUE']);
		$APPLICATION->SetTitle($arResult['PROPERTIES']['METATITLE']['VALUE']);
	}
	else{
		$APPLICATION->SetPageProperty("title", $arResult["NAME"]);
		$APPLICATION->SetTitle($arResult["NAME"]);
	}


// Для передачи IBLOCK_SECTION_ID в компанент webgk:news.list, для отоброжения новостей только этого инфоблока
$catolog = CIBlockElement::GetElementGroups($arResult['ID'])->GetNextElement()->GetFields();
$_SESSION['SECTION_ID'] = $catolog['IBLOCK_SECTION_ID'];
$_SESSION['SECTION_ELEMENT_ID'] = $arResult['IBLOCK_SECTION_ID'];
$_SESSION['IBLOCK_ID'] = $arResult['IBLOCK_ID'];
$_SESSION['ELEMENT_ID'] = $arResult['ID'];                                                                                                          
?>