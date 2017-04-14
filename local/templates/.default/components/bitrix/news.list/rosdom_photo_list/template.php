<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">

<table width=100%>
<tr>

<?
$i=0;
foreach($arResult["ITEMS"] as $arItem):?>
<? if($i%3 == 0 && $i>0) echo   "</tr><tr>"; ?>
<td style="padding:20px; width:33%">	
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
</td>
<!-- <td>
<h2><?echo $arResult["SECTION_NAME"]?></h2><br />
		<?echo $arItem["PREVIEW_TEXT"];?>
</td>-->
<?
$i++;
endforeach;?>
</tr>
</table>


</div>
