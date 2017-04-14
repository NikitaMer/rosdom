<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="last-posts">
<div class="b-descriptions">
<div class="description visible" style="border-top: none;">
<div class="w-figure">
<h1>Видео</h1>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?
if (count($arResult["ITEMS"]) > 0) {
?>
<script>
$(function (){
	$('#tabs-video').show();
});
</script>
<?
};

if (($_COOKIE['sections-tabs'] == 'tabs-video') AND (count($arResult["ITEMS"]) == 0)) {
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
	
	 <?
		/*echo '<pre>';
		print_r($arItem['DISPLAY_PROPERTIES']['VIDEO']);
		echo '</pre>';*/
		$url = $arItem['DISPLAY_PROPERTIES']['VIDEO']['VALUE'];
		//echo $url.'<br>';
		if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $m)) {
			$video_id = $m[0];
//			echo 'id='.$video_id;
		}
		?>
		<a class="videogallery"  href="<?=$arItem['DISPLAY_PROPERTIES']['VIDEO']['VALUE'];?>"><img class="preview_picture" border="0" src="http://img.youtube.com/vi/<?=$video_id?>/0.jpg" width="170" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
		<figcaption><?echo $arItem["NAME"]?></figcaption>

	<?/*	
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="200" height="150">
<param name="movie" value="<?=str_replace('watch?v=','v/', $arItem['DISPLAY_PROPERTIES']['VIDEO']['DISPLAY_VALUE'])?>">
<param name="wmode" value="transparent">
<param name="allowfullscreen" value="true">
<embed src="<?=str_replace('watch?v=','v/', $arItem['DISPLAY_PROPERTIES']['VIDEO']['DISPLAY_VALUE'])?>" type="application/x-shockwave-flash" width="200" height="150" wmode="transparent" allowfullscreen="true">
</object>
*/?>
	
	 </figure>
		
	
	
		
		
		
	
<?endforeach;?>
<script type="text/javascript">
$(document).ready(function() {
    

$("a.videogallery").click(function() {
	$.fancybox({
			'padding'		: 0,
			'titleShow' : false,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'width'		: 680,
			'height'		: 495,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			   	 'wmode'		: 'transparent',
				'allowfullscreen'	: 'true'
			}
		});

	return false;
});
});
</script>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
</div>
</div>
</section>
