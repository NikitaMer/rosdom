<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<section class="popular_projects">
	<h2>Популярные разделы проектов:</h2>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="block">
			<p class="title"><a href="<?=$arItem["PROPERTY_196"]?>"><?=$arItem["NAME"]?></a></p>
			<p style="text-align:left;"><a href="<?=$arItem["PROPERTY_196"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" /></a></p>
			<p class="hrefs">
				<?foreach($arItem["PROPERTY_195"] as $key=>$name):?>
					<a href="<?=$arItem["DESCRIPTION_195"][$key]?>"><?=$name?></a>&nbsp;&nbsp;
				<?endforeach?>
			</p>
		</div>
	<?endforeach?>
</section>
<br>
<br>
<br>
