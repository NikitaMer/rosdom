<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult["SECTION"]["NAME"])) $title = $arResult["SECTION"]["NAME"]; else $title = "Вопросы и ответы";    
?>
<h1><?=$title?></h1>
<?foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="b-subsection">
	   <h2><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["UF_MENUTITLE"]?></a></h2>
	   <figure>
	   	   <figcaption>
			<?=$arSection["DESCRIPTION"]?>
		  </figcaption>   
	   </figure>
</div>
<?endforeach?>