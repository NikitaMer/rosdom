<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="b-descriptions">
    <div class="description visible">
	<div class="w-figure">


	<?foreach($arResult["SECTIONS"] as $res):?>

	 <figure>
		<a class="gallery" rel="group" href="<?=$res["LINK"]?>">
		<img class="preview_picture" border="0" src="<?if($res["DETAIL_PICTURE"]["SRC"]) echo $res["DETAIL_PICTURE"]["SRC"]; ?>" width="170" height="112" alt="<?=$res["NAME"]?>" title="<?=$res["NAME"]?>" style="float:left" /></a>
		<figcaption><?=$res["NAME"]?></figcaption>
	 </figure>


<?endforeach;?>
	</div>
    </div>
</div>

