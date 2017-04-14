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
		    <? if ($arItem["SELECTED"]){ ?>

			<li class="root-item-selected">
				<a href="<?=$arItem["LINK"]?>" id="root-item-selected"><span class="root-item-selected">
					<?=$arItem["PARAMS"]["UF_MENUTITLE"]?></span></a>
			</li>
			<? $mem=$arItem["LINK"];
			$root_link=$arItem["LINK"];
			$root_name = $arItem["PARAMS"]["UF_MENUTITLE"]; ?>
			<?//$APPLICATION->AddChainItem($arItem["PARAMS"]["UF_MENUTITLE"], $arItem["LINK"]);?>
		    <? }
		    else{ ?>
			<li>
				<a href="<?=$arItem["LINK"]?>" class="root-item">
					<?=$arItem["PARAMS"]["UF_MENUTITLE"]?></a>
			</li>
			<? $mem=0; ?>
			<? } ?>
		<?elseif ($arItem["DEPTH_LEVEL"] == 2) :?> 
			<? //echo "!".$mem."!";
			if ($mem) $sub++;
			$temp=array();
//			$temp = $arItem;
//			$temp["LINK"]=substr($mem,0,-1).$arItem["LINK"];
//			$curDir = $APPLICATION -> GetCurPage();
//			if(substr($mem,0,-1).$arItem["LINK"] == $curDir) $temp["SELECTED"]=1; 

//			$SubMenu[]=$temp; 
//			}
			?> 
		<?endif?>
<?endforeach?>
</ul>


</div>

<?endif?>