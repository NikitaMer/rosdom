<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?
global $sub_link;
global $sub_name;

?>
<?//echo "<pre>"; print_r($arResult); echo "</pre>";?>
<? global $APPLICATION;
$dir = $APPLICATION->GetCurDir();
$dirs = explode ("/", $dir);
?>
<div class="b-widget b-widget__submenu">
            <h2>Подразделы:</h2>
            <div class="description-submenu">


<ul id="leftmenu">

<?
foreach($arResult as $arItem):
$path = "/".$dirs["1"]."/".$dirs["2"].$arItem["LINK"];
//$path = substr($dir,0,-1).$arItem["LINK"];

//echo $path." = ".$dir."<br>";
?>
	<?if($arItem["PARAMS"]["SELECTED"] || $dir == $path):?>
		<li class="item-selected"><a href="<?=$path?>"><?=$arItem["TEXT"]?></a></li>
		<?$APPLICATION->AddChainItem($sub_name, $sub_link);?>
	<?else:?>
		<li><a href="<?=$path?>"><?=$arItem["TEXT"]?></a></li>
	<?
	endif;

	?>
	
<?endforeach?>

</ul>
</div>
</div>

<?endif?>