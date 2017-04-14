<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["SECTIONS"])) {?>
<h1> <?=$arResult["SECTION"]["NAME"]?> </h1>
<?$APPLICATION->SetTitle($arResult["SECTION"]["NAME"]);?>
<?$APPLICATION->SetPageProperty("title", $arResult["SECTION"]["NAME"]);?>
<?}?>



<div class="photo-items-list">
<?
foreach($arResult["SECTIONS"] as $arSection):?>

<? //echo "<pre>"; print_r($arSection); echo "</pre>";?>

<div class="photo-items-el">	
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arSection["PICTURE"]["SRC"]?>" width="<?=$arSection["PICTURE"]["WIDTH"]?>" height="<?=$arSection["PICTURE"]["HEIGHT"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>"></a>

<p style="text-transform: uppercase; font-size:11px;"><?echo $arSection["NAME"]?></p>
</div>

<?

endforeach;
?>

</div>

