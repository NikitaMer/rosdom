<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="catalog-section-list">

<? 
$albums = array();
$albums  = $GLOBALS['photoFilter'];

//echo "<pre>";	print_r($photoFilter);	echo "</pre>";
//echo "<pre>";	print_r($GLOBALS['photoFilter']);	echo "</pre>";


if (!empty($albums) ) {?>
<script>
$(function (){	$('#tabs-photo').show(); });
</script>
<? };?>

<table width=100%>
<tr>

<?
$i=0;
foreach($arResult["SECTIONS"] as $arSection):
  if(in_array($arSection["ID"],$albums)):
     if($i%3 == 0 && $i>0) echo   "</tr><tr>"; ?>
<td style="padding:20px; width:33%">	
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arSection["PICTURE"]["SRC"]?>" width="<?=$arSection["PICTURE"]["WIDTH"]?>" height="<?=$arSection["PICTURE"]["HEIGHT"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" /></a>

<p style="text-transform: uppercase; font-size:11px;"><?echo $arSection["NAME"]?></h4><br />
</td>
<?
$i++;
  endif;
endforeach;
if($i<3) echo "<td style='padding:20px; width:33%'></td>";
?>

</tr>
</table>

</div>

<!--
<ul>
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
$strTitle = "";
foreach($arResult["SECTIONS"] as $arSection):

	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];

	$count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";

	if ($_REQUEST['SECTION_ID']==$arSection['ID'])
	{
		$link = '<b>'.$arSection["NAME"].$count.'</b>';
		$strTitle = $arSection["NAME"];
	}
	else
		$link = '<a href="'.$arSection["SECTION_PAGE_URL"].'">'.$arSection["NAME"].$count.'</a>';
?>
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><?=$link?></li>
<?endforeach?>
</ul>
</div>
<?=($strTitle?'<br/><h2>'.$strTitle.'</h2>':'')?>
-->