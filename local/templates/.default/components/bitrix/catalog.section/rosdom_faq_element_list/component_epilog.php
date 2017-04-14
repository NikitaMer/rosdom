<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>14, "ID" => $arResult["ID"]), false, Array("ID", "UF_DESCRIPTION", "UF_KEYWORDS", "UF_METATITLE", "NAME", "DESCRIPTION"));
	if($ar_result = $db_list->GetNext()){ 
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]); 
		elseif(!empty($ar_result["DESCRIPTION"])){ 
			$APPLICATION->SetPageProperty("description", $ar_result['~DESCRIPTION']);
		}else{
            $APPLICATION->SetPageProperty("description", " ");
        }
        
        if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]); 
        else{
            $APPLICATION->SetPageProperty("keywords", " ");
        }
         
		if (!empty($ar_result["UF_METATITLE"])) {
			$APPLICATION->SetPageProperty("title", $ar_result["UF_METATITLE"]); 
			$APPLICATION->SetTitle($ar_result["UF_METATITLE"]);
			}
			else {
				$APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][0]["NAME"]); 
				$APPLICATION->SetTitle($arResult["SECTION"]["PATH"][0]["NAME"]); 
			}		
	}
?>