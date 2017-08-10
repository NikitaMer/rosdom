<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="list-docs">

<dl class="b-list-docs">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>

	
<?	$rsFile = CFile::GetByID($arItem["PROPERTIES"]["FILE"]["VALUE"]);
	$arFile = $rsFile->Fetch();
	
	?>
	 
               <dt class="<?if($arFile["CONTENT_TYPE"] == 'application/pdf'):?>pdf<?else:?>doc<?endif;?>">
			   <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
				<?
			/*	$date = explode(' ', $arItem["DATE_CREATE"]);*/
				?>
			   <a href="/upload/<?echo $arFile["SUBDIR"]?>/<?echo $arFile["FILE_NAME"]?>"><?echo $arItem["NAME"]?></a> <span class="size"><?echo ceil($arFile["FILE_SIZE"] / 1024);?> ��</span> <span class="date"><?/*echo $date[0];*/?></span></dt>
               <dd>
                  <?echo $arItem["PREVIEW_TEXT"];?>
                  <!--p class="meta">

                     <strong>�����</strong>: ������-�����&nbsp;&nbsp;|&nbsp;&nbsp;<strong>�������</strong>: <a href="#">������</a>, <a href="#">�����</a>, <a href="#">�������� ���������</a><br>
                     <span class="tags"><strong>����</strong>: <a href="#">������� �������</a>, <a href="#">�����������</a>, <a href="#">�����������</a></span>

                  </p-->
               </dd>
               
            
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</dl>
</section>

           
