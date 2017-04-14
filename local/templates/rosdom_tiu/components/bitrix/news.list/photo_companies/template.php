<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (isset($_REQUEST['SECTION_NAME'])):?>
<div class="w-figure">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?
if (count($arResult["ITEMS"]) > 0) {
?>
<script>
$(function (){
	$('#tabs-photo').show();
});
</script>
<?
};

if (($_COOKIE['sections-tabs'] == 'tabs-photo') AND (count($arResult["ITEMS"]) == 0)) {
?>
<script>
	$('.secdes').removeClass('visible');
	$('#tabs-about').addClass('active');
	$('#tabs-about-container').addClass('visible');
</script>
<?
};
?>

<?/*echo '<pre>'; print_r($arResult); echo '</pre>';*/?>
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
<script>



$(document).ready(function() {
$("a.gallery").fancybox();


});
</script>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<?endif;?>
