<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--<pre>
<? //print_r($arResult["SECTIONS"]);?>
</pre> -->

<section class="faq">
<?
global $APPLICATION;
$path = $APPLICATION->GetCurDir();
//echo $path;

if ($path == "/realty/") {

     foreach($arResult["SECTIONS"] as $arSection):
     if($arSection["DEPTH_LEVEL"] == 1): ?>
       <div class="b-subsection">
       <h2><a href="<?=$arSection["CODE"]."/"?>"><?if($arSection["UF_MENUTITLE"]) echo $arSection["UF_MENUTITLE"]; else echo $arSection["NAME"];?></a></h2>
        <figure>
    	  <figcaption>
    				 <p class="more"><a href="<?=$arSection["LINK"]?>">Перейти к разделу</a></p>
    	  </figcaption>   
        </figure>
	</div>
    <? endif;
    endforeach;
 } 
elseif (empty($_REQUEST["MAIN_SECTION_CODE"])) { 
    foreach($arResult["SECTIONS"] as $arSection):

         if($arSection["DEPTH_LEVEL"] == 2):?>
       <div class="b-subsection">
       <h2><a href="<?=$arSection["CODE"]."/"?>"><?if($arSection["UF_MENUTITLE"]) echo $arSection["UF_MENUTITLE"]; else echo $arSection["NAME"];?></a></h2>
    	    <!--figure>
    	        <figcaption>	
    				 <p class="more"><a href="<?=$arSection["CODE"]."/"?>">Перейти к разделу</a></p>
    		    </figcaption>   
    	    </figure-->
	</div>
       <?
       endif;
    endforeach;
} 
 
 ?>
</section>

