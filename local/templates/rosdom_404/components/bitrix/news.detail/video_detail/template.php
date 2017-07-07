<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="video_detail;">
	
		<h1><?=$arResult["NAME"]?></h1>
	<table cellpadding=10>
<tr>
<td style="padding-right:15px;">	
	 <?
/*		echo '<pre>';print_r($arResult['DISPLAY_PROPERTIES']['VIDEO']);	echo '</pre>';
		$url = $arResult['DISPLAY_PROPERTIES']['VIDEO']['VALUE'];
		
		if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $m)) {
			$video_id = $m[0];
//			echo 'id='.$video_id;
		}
*/
		?>

	<!-- <iframe width="425" height="350" src="http://www.youtube.com/embed/<?=$video_id?>" frameborder="0" allowfullscreen></iframe>
	<a class="videogallery"  href="<?=$arResult['DISPLAY_PROPERTIES']['VIDEO']['VALUE']?>"><img class="preview_picture" border="0" src="http://img.youtube.com/vi/<?=$video_id?>/0.jpg" width="370" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" style="float:left" /></a> -->

<?=$arResult['DISPLAY_PROPERTIES']['VIDEO']['~VALUE'];?>
</td> <td>

		<p> <?echo $arResult["DETAIL_TEXT"]?></p>
</td>
</tr>
</table>
<?
if(strlen($arResult["FIELDS"]["TAGS"])>0) {
	$tags=array();
	$tags = explode ( ",", $arResult["FIELDS"]["TAGS"]);
	echo "Теги:&nbsp";
	foreach($tags as $tag){ ?>
		<a href="/search/index.php?tags=<?=$tag;?>"><?=$tag;?></a>,&nbsp
	<?
	}
}
?>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "N")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>

<div style="float:right;">
<?
if ($arResult['PROPERTIES']['COMPANY']['VALUE']) {
	$db=CIBlockElement::GetByID($arResult['PROPERTIES']['COMPANY']['VALUE']);
	$auth = $db->GetNext();
//	echo "<pre>"; print_r($auth); echo "</pre>";
	echo "Автор: <a href='/firms/firm".$auth['ID']."/'> Компания \"".$auth['NAME']."\"</a>";
}
else { 
	$db=CIBlockElement::GetByID($arResult['ID']);
	$elem = $db->GetNext();
	$db=CUser::GetByID($elem['CREATED_BY']);
	$auth = $db->GetNext();
	$author = $auth['NAME'];
echo "Автор: ".$author;
	}

?>
</div>


</div>
