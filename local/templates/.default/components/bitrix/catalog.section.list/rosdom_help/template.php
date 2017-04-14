<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section-list">
	<?//$PREV_DEPTH = 1;

	foreach($arResult["SECTIONS"] as $arSection):
//		echo "<pre>";print_r($arSection);echo "</pre>";
		if($PREV_DEPTH > $arSection["DEPTH_LEVEL"]) echo "</div></div>";
		if($PREV_DEPTH == $arSection["DEPTH_LEVEL"]) echo "</div>";
		if($arSection["DEPTH_LEVEL"] == 1): ?>
			<div class="section">
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
			<?$link = $arSection["SECTION_PAGE_URL"];?>
		<?elseif($arSection["DEPTH_LEVEL"] == 2): ?> 
			<div class="element">
			<a href="<?=$link?>"><?=$arSection["NAME"]?></a>	
		<?endif;?>

		<?//echo $PREV_DEPTH." - ".$arSection["DEPTH_LEVEL"] ;
		//if($arSection["DEPTH_LEVEL"] == 1) echo "</div>";
		//if($arSection["DEPTH_LEVEL"] == 2) echo "</div>";
	$PREV_DEPTH = $arSection["DEPTH_LEVEL"];
	endforeach;?>
</div>



