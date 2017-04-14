<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*if (isset($_REQUEST['SECTION_NAME'])):*/?>


<section class="last-posts">
<div class="b-descriptions">
<div class="description visible">
<div class="w-figure">





<? 
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>11, "ID" => $_REQUEST['SECTION_ID']), false, Array("UF_*"));
if($db_list->SelectedRowsCount()!=1){
//echo '122';
LocalRedirect("/404.php");
}
	while($ar_result = $db_list->GetNext())  {
		//echo '<pre>'; print_r($ar_result); echo '</pre>';
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]); 
		if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]); 
		if (!empty($ar_result["UF_METATITLE"])) $APPLICATION->SetPageProperty("title", $ar_result["UF_METATITLE"]);
			else $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][0]["NAME"]);
		$h1title = $ar_result['NAME'];
	}
	
	
?>

<?/*<h1><?=$h1title?></h1>*/?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	 <figure>
		
		
		<a class="gallery" rel="group" href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
		<figcaption><!--a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"--><?echo $arItem["NAME"]?><!--/a--></figcaption>
	
	 </figure>
		
	
	
		
		
		
	
<?endforeach;?>
<script type="text/javascript">
$(document).ready(function() {
    $("a.gallery").fancybox();
});
</script>

</div></div></div></section>
<?/*endif;*/?>
