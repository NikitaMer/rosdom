<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (count($arResult["ITEMS"]) > 0) {
?>
<script>
$(function (){
	$('#files-tab').show();
});
</script>
<?
}
?>
<section class="list-docs">
<dl class="b-list-docs">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>

	<?
	/*echo '<pre>';
	print_r($arItem);
	echo '</pre>';*/
	?>

	
<?	$rsFile = CFile::GetByID($arItem["PROPERTIES"]["FILE"]["VALUE"]);
	$arFile = $rsFile->Fetch();
	
	?>
	 
               <dt class="<?if($arFile["CONTENT_TYPE"] == 'application/pdf'):?>pdf<?else:?>doc<?endif;?>">
			   <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
			   <a href="/upload/<?echo $arFile["SUBDIR"]?>/<?echo $arFile["FILE_NAME"]?>"><?echo $arItem["NAME"]?></a> <span class="size"><?echo ceil($arFile["FILE_SIZE"] / 1024);?> Кб</span> <span class="date"><?echo $arItem["DATE_CREATE"];?></span></dt>
               <dd>
                  <?echo $arItem["PREVIEW_TEXT"];?>
                  <!--p class="meta">

                     <strong>Автор</strong>: «Диана-Строй»&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Рубрика</strong>: <a href="#">кровля</a>, <a href="#">фасад</a>, <a href="#">сельское хозяйство</a><br>
                     <span class="tags"><strong>Теги</strong>: <a href="#">правила монтажа</a>, <a href="#">канализация</a>, <a href="#">конструкции</a></span>

                  </p-->
               </dd>
               
            
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</dl>
</section>

           
