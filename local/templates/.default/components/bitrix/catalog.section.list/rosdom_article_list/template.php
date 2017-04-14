<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1><? if($arResult["SECTION"]["NAME"]) echo $arResult["SECTION"]["NAME"]; else echo "Статьи"; ?></h1>
<?
//echo "<pre>"; print_r($arResult); echo "</pre>";

foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="b-subsection">
	   <h2><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["UF_MENUTITLE"]?></a></h2>
	   <figure>
	   	   <figcaption>
			<?=$arSection["DESCRIPTION"]?>
			 <p class="more"><a href="<?=$arSection["SECTION_PAGE_URL"]?>">Перейти к разделу</a></p>
		  </figcaption>   
	   </figure>
</div>
<?endforeach?>

