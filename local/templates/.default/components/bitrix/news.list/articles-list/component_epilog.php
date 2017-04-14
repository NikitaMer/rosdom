
<?


$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>9, "ID" => $arResult["SECTION"]["PATH"]["0"]["ID"]), false, Array("UF_DESCRIPTION", "UF_KEYWORDS", "UF_METATITLE"));

	while($ar_result = $db_list->GetNext())  {
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]);
		if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]);
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