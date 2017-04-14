<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="catalog-section-list">

<table >
<tr>

<?
$i=0;
foreach($arResult["SECTIONS"] as $arSection):?>

<? //echo "<pre>"; print_r($arSection); echo "</pre>";?>

<? if($i%3 == 0 && $i>0) echo   "</tr><tr>"; ?>
<td style="padding:17px;" >	
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arSection["PICTURE"]["SRC"]?>" width="<?=$arSection["PICTURE"]["WIDTH"]?>" height="<?=$arSection["PICTURE"]["HEIGHT"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>"></a>

<p style="text-transform: uppercase; font-size:11px;"><?echo $arSection["NAME"]?></p><br />
</td>
<?
$i++;
if($i == 9) break;
endforeach;
if($i<3) echo "<td style='padding:17px; width:33%'></td>";
?>

</tr>
</table>

</div>

