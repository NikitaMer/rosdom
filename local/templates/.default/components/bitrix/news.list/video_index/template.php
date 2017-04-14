<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<pre>'; print_r($videoFilter); echo '</pre>';?>

<div class="w-figure">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?if (count($arResult["ITEMS"]) > 0) {?>
<script>
$(function (){	$('#tabs-video').show();});
</script><?};?>

<table width=93%>

<?
foreach($arResult["ITEMS"] as $arItem):
$video_id = "";

?>
	 <tr>

	<?
		$string = explode('/', $arItem['PROPERTIES']['VIDEO']['VALUE']);
		if(in_array("www.youtube.com", $string) || in_array("youtube.com", $string)){
			$str = '#^(.*)http://([a-zA-Z0-9_\-.]+)/([a-zA-Z0-9_\-.]+)/([a-zA-Z0-9_\-.]+).*$#';
			preg_match($str, $arItem['PROPERTIES']['VIDEO']['VALUE'], $m);
			$video_id = $m[4];
			//echo "!".$video_id;
		}
	?>
		<td>
		<a class="videogallery"  href="<?=$arItem["DETAIL_PAGE_URL"];?>">
		<? if(strlen($video_id)>0) { ?>
			<img class="preview_picture" border="0" src="http://img.youtube.com/vi/<?=$video_id?>/0.jpg" width="227" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" />
		<?}
		else{ ?>
			<img class="preview_picture" border="0" src="/i/television.png" width="227" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" />
		<? }?>
</a> 
		</td>

		<td>
		<h2><a class="videogallery"  href="<?=$arItem["DETAIL_PAGE_URL"];?>"><?=$arItem["NAME"]?></a></h2>
		<?=$arItem["PREVIEW_TEXT"]?>
		</td>
	 </tr>

	
<?endforeach;?>
</table>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
