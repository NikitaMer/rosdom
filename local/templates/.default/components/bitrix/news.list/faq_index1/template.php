<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <section class="faq">
            <dl class="b-list-faq">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?//echo '<pre>'; print_r($arResult); echo '</pre>';?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	?>
	<dt>
	  <!--div class="path">������: <a href="#">����������</a> � <a href="#">����������� �����������</a></div-->

	  <?//echo '<pre>'; print_r($arItem["PROPERTIES"]["PUB_SECTION"]["VALUE"]["0"]); echo '</pre>';?>
	  <?
		//echo $arItem["IBLOCK_SECTION_ID"].' ';
		if ($arItem["IBLOCK_SECTION_ID"] > 0){
			unset($faqtree);
			$faqtree[] = $arItem["IBLOCK_SECTION_ID"];
			$isroot = 0;
			$parent = $arItem["IBLOCK_SECTION_ID"];
			while ($isroot == 0){
				$res = CIBlockSection::GetByID($parent);
				if($ar_res = $res->GetNext()){
					  if($ar_res["IBLOCK_SECTION_ID"] > 0){
						$parent = $ar_res["IBLOCK_SECTION_ID"];
						//echo $ar_res['NAME'].' ';
						$faqtree[] = $ar_res["IBLOCK_SECTION_ID"];
					  } else $isroot = 1;
				  }
						
			}
			
		}
		//echo '<pre>'; print_r($faqtree); echo '</pre>';
		?><div class="path">������:&nbsp;<?
		$path = '/faq/';
		for($i = count($faqtree) - 1; $i>=0; $i--){
			//echo $i.' = '.$faqtree[$i].' ';
			$db_list = CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>"14", "ID"=>$faqtree[$i]), false,Array("UF_*"));
			$red = $db_list->GetNext();
			//echo '<pre>'; print_r($red); echo '</pre>';
			$path .= $red['CODE'].'/';
			?><a href="<?=$path?>"><?=$red['UF_MENUTITLE']?></a><?
			if ($i>0) echo ' � ';
		}
		?></div>
		<a href="/faq/faq<?=$arItem['CODE']?>/" class="h3"><?echo $arItem['PREVIEW_TEXT']?></a>

   </dt>
   <dd>
	  <!--<p><?//echo $arItem['DETAIL_TEXT']?></p> -->
<?
	  
		$result = implode(array_slice(explode('<br>',wordwrap($arItem['DETAIL_TEXT'],265,'<br>',false)),0,1));
		echo $result;
		if($result!=$string)echo'...';
	  ?>
	  <!--</p> -->
	  <!-- <p class="more"><a href="/faq/faq<?=$arItem['ID']?>/">������ ���������</a></p> -->
	  <!--p class="more"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">������ ���������</a></p-->
   </dd>

<?endforeach;?>


            </dl>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
         </section>
 
 
 

               
