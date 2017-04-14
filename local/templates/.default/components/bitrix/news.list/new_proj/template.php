<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<section class="popular_projects">
	<h2>Новые проекты:</h2>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="block">
			<p style="text-align:left;"><a href="<?=$arItem["PREVIEW_TEXT"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" /></a></p>
			<p><a href="<?=$arItem["PREVIEW_TEXT"]?>"><?=$arItem["NAME"]?></a></p>
		</div>
	<?endforeach?>
</section>
<br>
<br>
<br>
