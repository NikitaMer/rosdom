<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="search-page">


<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
	<p><?=GetMessage("SEARCH_ERROR")?></p>
	<?ShowError($arResult["ERROR_TEXT"]);?>
	<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
	<br /><br />
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
<?elseif(count($arResult["SEARCH"])>0):?>
	<section class="faq">
	<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
	
	<?$k = $_REQUEST['b'];?>
	<?foreach($arResult["SEARCH"] as $arItem):?>
	<?
	//link calculation
	
	if ($k == 'sections'){
		//echo '<pre>'; print_r($arItem); echo '</pre>';
		$id = intval(str_replace('S', '', $arItem['ITEM_ID']));
		//echo $id.' - ';
		$res = CIBlockSection::GetByID($id);
		if($ar_res = $res->GetNext()){
			//echo $ar_res['IBLOCK_SECTION_ID'].' - '.$ar_res['CODE'];
			unset($tree);
			$tree[] = $ar_res['CODE'];
			if ($ar_res["IBLOCK_SECTION_ID"] > 0){
				$isroot = 0;
				$parent = $ar_res["IBLOCK_SECTION_ID"];
				while ($isroot == 0){
					$res = CIBlockSection::GetByID($parent);
					if($ar_res = $res->GetNext()){
						  if($ar_res["IBLOCK_SECTION_ID"] > 0){
							$parent = $ar_res["IBLOCK_SECTION_ID"];
							//echo $ar_res['NAME'].' ';
							$tree[] = $ar_res["CODE"];
						  } else {$isroot = 1; $tree[] = $ar_res["CODE"];}
					  }
							
				}
				
			}
			//echo '<pre>'; print_r($tree); echo '</pre>';
			$link = '/';
			for ($i = (count($tree) - 1); $i>=0; $i--) $link .= $tree[$i].'/';
			$arItem['URL_WO_PARAMS'] = $link;
		}
	}
	if ($k == 'firms'){
		//echo '<pre>'; print_r($arItem); echo '</pre>';
		$id = intval($arItem['ITEM_ID']);
		//echo $id.' - ';
		$res = CIBlockElement::GetByID($id);
		if($ar_res = $res->GetNext()){
			//echo $ar_res['IBLOCK_SECTION_ID'].' - '.$ar_res['CODE'];
			$link = '/firms/'.$ar_res['CODE'].'/';
			$arItem['URL_WO_PARAMS'] = $link;
		}
	}
	if ($k == 'documents'){
		//echo '<pre>'; print_r($arItem); echo '</pre>';
		$link = '/';
		$id = intval($arItem['ITEM_ID']);
		$db_props = CIBlockElement::GetProperty(15, $id, Array("sort"=>"asc"), Array("CODE"=>"FILE"));
		if($ar_props = $db_props->Fetch()){
			
			$file = $ar_props['VALUE'];
			$rsFile = CFile::GetByID($file);
			$arFile = $rsFile->Fetch();
			//echo '<pre>'; print_r($arFile); echo '</pre>';
			$link = '/upload/'.$arFile['SUBDIR'].'/'.$arFile['FILE_NAME'];
		}
		//echo $id.' - ';
		$arItem['URL_WO_PARAMS'] = $link;
	}
	if ($k == 'faq'){
		//echo '<pre>'; print_r($arItem); echo '</pre>';
		$id = intval($arItem['ITEM_ID']);
		//echo $id.' - ';
		$res = CIBlockElement::GetByID($id);
		if($ar_res = $res->GetNext()){
			//echo $ar_res['IBLOCK_SECTION_ID'].' - '.$ar_res['CODE'];
			unset($tree);
			$tree[] = '#'.$ar_res['ID'];
			if ($ar_res["IBLOCK_SECTION_ID"] > 0){
				$isroot = 0;
				$parent = $ar_res["IBLOCK_SECTION_ID"];
				while ($isroot == 0){
					$res = CIBlockSection::GetByID($parent);
					if($ar_res = $res->GetNext()){
						  if($ar_res["IBLOCK_SECTION_ID"] > 0){
							$parent = $ar_res["IBLOCK_SECTION_ID"];
							//echo $ar_res['NAME'].' ';
							$tree[] = $ar_res["CODE"];
						  } else {$isroot = 1; $tree[] = $ar_res["CODE"];}
					  }
							
				}
				
			}
			//echo '<pre>'; print_r($tree); echo '</pre>';
			$link = '/faq';
			
			for ($i = (count($tree) - 1); $i>=0; $i--) $link .= '/'.$tree[$i];
			//echo $link;
			$arItem['URL_WO_PARAMS'] = $link;
		}
	}
	if ($k == 'realty'){
		$id = intval(str_replace('S', '', $arItem['ITEM_ID']));
		if(strpos($arItem['ITEM_ID'], 'S') === 0) $res = CIBlockSection::GetByID($id);
			else $res = CIBlockElement::GetByID($id);
		if($ar_res = $res->GetNext()){
			//echo $ar_res['IBLOCK_SECTION_ID'].' - '.$ar_res['CODE'];
			unset($tree);
			$tree[] = $ar_res['CODE'];
			if ($ar_res["IBLOCK_SECTION_ID"] > 0){
				$isroot = 0;
				$parent = $ar_res["IBLOCK_SECTION_ID"];
				while ($isroot == 0){
					$res = CIBlockSection::GetByID($parent);
					if($ar_res = $res->GetNext()){
						  if($ar_res["IBLOCK_SECTION_ID"] > 0){
							$parent = $ar_res["IBLOCK_SECTION_ID"];
							//echo $ar_res['NAME'].' ';
							$tree[] = $ar_res["CODE"];
						  } else {$isroot = 1; $tree[] = $ar_res["CODE"];}
					  }
							
				}
				
			}
			//echo '<pre>'; print_r($tree); echo '</pre>';
			$link = '/realty/';
			
			for ($i = (count($tree) - 1); $i>=0; $i--) $link .= $tree[$i].'/';
			//echo $link;
			$arItem['URL_WO_PARAMS'] = $link;
		}
	}
	
	//end of link calculation
	?>
	<div class="b-subsection">
		<h2><a href="<?echo $arItem["URL_WO_PARAMS"]?>"><?echo $arItem["TITLE_FORMATED"]?></a></h2>
		<p><?echo $arItem["BODY_FORMATED"]?></p>
	</div>
		
		
	<?endforeach;?>
	
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
	</section>
	<?/*<br />
	<p>
	<?if($arResult["REQUEST"]["HOW"]=="d"):?>
		<a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
	<?else:?>
		<b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
	<?endif;?>
	</p>*/?>
<?else:?>
	<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
<?endif;?>
</div>