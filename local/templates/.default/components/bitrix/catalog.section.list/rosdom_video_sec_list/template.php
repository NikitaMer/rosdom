<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? //echo "<pre>"; print_r($arResult); echo "</pre>";?>
<?foreach($arResult["SECTIONS"] as $arSection):?>
<div class="b-subsection">
   <h2><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></h2>
   <figure>
      
	  <figcaption>
		<?=$arSection["DESCRIPTION"]?>		 <p class="more"><a href="<?=$arSection["SECTION_PAGE_URL"]?>">Перейти к разделу</a></p>

	  </figcaption>   
   </figure>
</div>
<?endforeach?>


