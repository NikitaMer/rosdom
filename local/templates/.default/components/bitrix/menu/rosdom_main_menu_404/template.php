<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div id="mainmenu">

<ul>
<? if ($APPLICATION->GetCurDir() == '/') 
	echo '<li class="root-item-selected"> <a href="/" class="root-item-selected">';
else 
	echo '<li class="root-item"> <a href="/" class="root-item">'; ?>
О проекте </a>
</li>
<? 
$sub=0;
$mem=0;
foreach($arResult as $arItem):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li>
				<a href="<?=$arItem["LINK"]?>" class="root-item">
					<?=$arItem["PARAMS"]["UF_MENUTITLE"]?></a>
			</li>
		<?endif?>
<?endforeach?>
</ul>
<?endif?>