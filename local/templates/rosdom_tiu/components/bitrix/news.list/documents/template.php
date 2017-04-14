<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="list-docs">
<?
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>15, "ID" => $arResult["SECTION"]["PATH"]["0"]["ID"]), false, Array("UF_DESCRIPTION", "UF_KEYWORDS", "UF_METATITLE"));
if($db_list->SelectedRowsCount()!=1){
LocalRedirect("/404.php");
}
	while($ar_result = $db_list->GetNext())  {
		//echo '<pre>'.print_r($ar_result).'</pre>';
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]); 
		if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]); 
		if (!empty($ar_result["UF_METATITLE"])) $APPLICATION->SetPageProperty("title", $ar_result["UF_METATITLE"]); 
					else $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][0]["NAME"]); 
	}
?>
<h1><?=$arResult['SECTION']['PATH'][count($arResult['SECTION']['PATH'])- 1]['NAME']?></h1>
<dl class="b-list-docs">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>

	<?
	/*echo '<!--';
	print_r($arItem);
	echo '-->';*/
	?>

	
<?	$rsFile = CFile::GetByID($arItem["PROPERTIES"]["FILE"]["VALUE"]);
	$arFile = $rsFile->Fetch();
	
	?>
	 
               <dt class="<?if($arFile["CONTENT_TYPE"] == 'application/pdf'):?>pdf<?else:?>doc<?endif;?>">
			   <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
				<?
				$date = explode(' ', $arItem["DATE_CREATE"]);
				?>
			   <a href="/upload/<?echo $arFile["SUBDIR"]?>/<?echo $arFile["FILE_NAME"]?>"><?echo $arItem["NAME"]?></a> <span class="size"><?echo ceil($arFile["FILE_SIZE"] / 1024);?> Кб</span> <span class="date"><?echo $date[0];?></span></dt>
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

           
