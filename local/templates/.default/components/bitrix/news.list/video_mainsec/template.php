<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo '<pre>'; print_r($arResult); echo '</pre>';?>
<?
if (count($arResult["ITEMS"]) > 0) {
?>
<script>
$(function (){
	$('#tabs-video').show();
});
</script>
<?};?>
<h1><?=$arResult["SECTION"]["PATH"][0]["NAME"]?></h1>
<section class="last-posts">
<div class="b-descriptions">
<div class="description visible" style="border-top: none;">
<div class="w-figure">


<?$i=0;?>
<table cellpadding=10 width=90%>
<tr>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

<td style="padding-right:10px; width: 15%;">	
	 <?
		$string = explode('.', $arItem['DISPLAY_PROPERTIES']['VIDEO']['VALUE']);
/*		if (in_array("youtube", $string))
				$string2 = explode('"', $arItem['DISPLAY_PROPERTIES']['VIDEO']['VALUE']);
				$string3 = explode('"', $string2['1']);
				$pic_id = $string3['0'];
				echo '<pre>';	print_r($string2);echo '</pre>';*/


		$str = '#^(.*)http://([a-zA-Z0-9_\-.]+)/([a-zA-Z0-9_\-.]+)/([a-zA-Z0-9_\-.]+).*$#';
		preg_match($str, $arItem['DISPLAY_PROPERTIES']['VIDEO']['VALUE'], $m);
		$video_id = $m[4];
		
		

//echo '<pre>';	print_r($arItem['DISPLAY_PROPERTIES']['VIDEO']);echo '</pre>';
		$url = $arItem['DISPLAY_PROPERTIES']['VIDEO']['VALUE'];
//		echo $url.'<br>';
		if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $m)) {
			$video_id = $m[4];
//			echo 'id='.$video_id;
		}
		?>

		<a class="videogallery"  href="<?=$arItem[DETAIL_PAGE_URL]?>"><img class="preview_picture" border="0" src="http://img.youtube.com/vi/<?=$video_id?>/0.jpg" width="227" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a> 
</td> 
<td width=30%;>
		<h2><?echo $arItem["NAME"]?></h2>
		<div> <?echo $arItem["PREVIEW_TEXT"]?></div>
</td>
<?if($i>0 && $i%2) echo "</tr><tr>";

$i++;
?>

			
<?endforeach;?>
<?if($i==1) echo '<td style="width: 50%;"></td>';?>
</tr>
</table>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
</div>
</div>
</section>
