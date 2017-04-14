<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$pathcount = count($arResult["SECTION"]["PATH"]) - 1;

if (!empty($_REQUEST['SECTION_CODE'])){
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>17, "ID" => $arResult["SECTION"]["PATH"][$pathcount]["ID"]), false, Array("UF_DESCRIPTION", "UF_KEYWORDS", "UF_METATITLE"));
	if (!empty($arResult["SECTION"])) while($ar_result = $db_list->GetNext())  {
		//echo '<pre>'.print_r($ar_result).'</pre>';
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]); 
		if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]); 
		if (!empty($ar_result["UF_METATITLE"])) $APPLICATION->SetPageProperty("title", $ar_result["UF_METATITLE"]); 
			else $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][$pathcount]["NAME"]); 
	}
}?>

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<h1><?=$arResult['SECTION']['PATH'][count($arResult['SECTION']['PATH'])- 1]['NAME']?></h1>
<section class="about-section">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

<div class="b-subsection">
<h2>
<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
</h2>
<figure>
<?/*<img src="/upload/iblock/055/0555e08810a684ff10331d6d3d9e80fc.gif" alt="">*/?>
<figcaption>
<p><b>Телефон</b>: <?echo $arItem["PROPERTIES"]['TELEPHONE']['VALUE'];?></p>
<p class="more">
<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
</p>
</figcaption>
</figure>
</div>
	
<?endforeach;?>
</section>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
