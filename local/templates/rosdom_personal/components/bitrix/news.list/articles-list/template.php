<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
/*echo '<!--pre>';
print_r($arResult);
echo '</pre-->';*/

$res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 9, 'CODE' => $_REQUEST['SECTION_CODE'])); 
if($res->SelectedRowsCount()==0){
LocalRedirect("/404.php");
}
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>9, "ID" => $arResult["SECTION"]["PATH"]["0"]["ID"]), false, Array("UF_DESCRIPTION", "UF_KEYWORDS", "UF_METATITLE"));

	while($ar_result = $db_list->GetNext())  {
		//echo '<pre>'.print_r($ar_result).'</pre>';
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]); 
		if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]); 
		if (!empty($ar_result["UF_METATITLE"])) $APPLICATION->SetPageProperty("title", $ar_result["UF_METATITLE"]); 
			else $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][0]["NAME"]); 
		
	}
?>


<?
$description = '';
$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"9", "CODE"=>$_REQUEST["SECTION_CODE"]),false);
if($res=$ar_result->GetNext()){
	$description = $res['DESCRIPTION'];
}
?>
<section class="faq">
<h1><?=$arResult["SECTION"]["PATH"][0]["NAME"]?></h1>
<?/*if(!empty($description)): echo $description; endif;*/?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>

	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<div class="b-subsection">
		<h2><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h2>
	   <figure>
	   <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
		<?endif?>
	   
		  <figcaption>
			<?echo $arItem["PREVIEW_TEXT"];?>
			 <?/*<p class="more"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Подробнее</a></p>*/?>

		  </figcaption>   
	   </figure>
	</div>
	
	
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</section>
