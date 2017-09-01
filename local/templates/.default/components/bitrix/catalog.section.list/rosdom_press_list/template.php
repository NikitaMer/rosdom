<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(($arResult["SECTIONS"])): ?>
<h1><? if($arResult["SECTION"]["NAME"]) echo $arResult["SECTION"]["NAME"]; else echo "Пресс-релизы"; ?></h1>
<?
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="b-subsection">
	   <h2><a href="<?=$arSection["CODE"]?>/"><?if($arSection["UF_MENUTITLE"]) echo $arSection["UF_MENUTITLE"]; else echo $arSection["NAME"];?></a></h2>
	   <!--figure>
	   	   <figcaption>
			<?=$arSection["DESCRIPTION"]?><br />
			 <p class="more"><a href="<?=$arSection[SECTION_PAGE_URL]?>">Перейти к разделу</a></p>
		  </figcaption>   
	   </figure-->
</div>
<?endforeach?>
<?endif;?>
