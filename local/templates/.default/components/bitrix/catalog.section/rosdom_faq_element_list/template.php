<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?
foreach($arResult["ITEMS"] as $arElement):
?>
<div class="b-subsection">
	   <h2><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></h2>
	   <figure>
	   	   <figcaption>
			<?
			$result = implode(array_slice(explode('<br>',wordwrap($arElement['DETAIL_TEXT'],265,'<br>',false)),0,1));
			echo $result;
			?>
		  </figcaption>   
	   </figure>
</div>
<?endforeach?>


