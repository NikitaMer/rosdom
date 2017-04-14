<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="w-column">
<div class="b-column">
<ul>
			

<?
if (count($arResult["ITEMS"]) > 0) {
?>
<script>
$(function (){
	$('#tabs-companies').show();
});
</script>
<?
};

if (($_COOKIE['sections-tabs'] == 'tabs-articles') AND (count($arResult["ITEMS"]) == 0)) {
?>
<script>
	$('.secdes').removeClass('visible');
	$('#tabs-about').addClass('active');
	$('#tabs-about-container').addClass('visible');
</script>
<?
};
?>
			
<!--	<?//echo count($arResult["ELEMENTS"]);?>
		<pre>
	<? //print_r($arResult);?>
	</pre>
-->
<? $count=ceil((count($arResult["ELEMENTS"])/3));
$i=1;								
foreach($arResult["ITEMS"] as $arItem):?>
<!--<pre>
<?// print_r($arItem);?>
</pre>-->
			<li><strong><a href="<?=$arItem["DETAIL_PAGE_URL"]."/"?> "><?=$arItem["NAME"]?></a></strong><br />
				<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?><br /></li>
<?// echo $count."_".$i;?>
<? if ( $i%$count == 0) echo '</ul></div><div class="b-column"><ul>';?>
<? $i++;?>
<?endforeach;?>

</ul>

</div>
</div>


