<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $description_visible;
$description_visible = false;?>
<?if (!empty($arResult)):?>

	<ul>
<?foreach($arResult as $arItem):?>
	<?
	echo '<!--';
	print_r($arItem);
	echo '-->';
	?>
	<?if ($arItem["PERMISSION"] > "D"):?>
		<!--li<?if ($arItem["SELECTED"]):?> class="active" id="current-tab"<?endif?>><a href="<?=$arItem["LINK"]?>"><nobr><?=$arItem["TEXT"]?></nobr></a></li-->
		<li<?if ((($arItem["LINK"] == '/') AND $arItem["SELECTED"] AND ($APPLICATION->sDocPath2 == '/index.php')) OR ($arItem["SELECTED"] AND ($arItem["LINK"] != '/'))):?> class="active" id="current-tab"<?$description_visible = true;?><?endif?>><a href="<?=$arItem["LINK"]?>"><nobr><?=$arItem["TEXT"]?></nobr></a></li>
	<?endif?>

<?endforeach?>
<?if($APPLICATION->sDocPath2 == '/index.php'):?>
<?endif;?>
	</ul>

<div class="menu-clear-left"></div>
<?endif?>
