<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-detail">
<? // echo "<pre>"; print_r($arResult); echo "</pre>";?>

<?
if (!empty($arResult["DISPLAY_PROPERTIES"]["DESCRIPTION"]["VALUE"])) $APPLICATION->SetPageProperty("description", $arResult["DISPLAY_PROPERTIES"]["DESCRIPTION"]["VALUE"]); 
if (!empty($arResult["DISPLAY_PROPERTIES"]["KEYWORDS"]["VALUE"])) $APPLICATION->SetPageProperty("keywords", $arResult["DISPLAY_PROPERTIES"]["KEYWORDS"]["VALUE"]); 
if (!empty($arResult["DISPLAY_PROPERTIES"]["METATITLE"]["VALUE"])) $APPLICATION->SetPageProperty("title", $arResult["DISPLAY_PROPERTIES"]["METATITLE"]["VALUE"]); 
?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h1><?=$arResult["NAME"]?></h1>
	<?endif;?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>

	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<!-- <div style="clear:both"></div> -->
	<br />

	<?// echo "<pre>"; print_r($arResult["FIELDS"]); echo "</pre>";?>
<?
if(strlen($arResult["FIELDS"]["TAGS"])>0) {
	$tags=array();
	$tags = explode ( ",", $arResult["FIELDS"]["TAGS"]);
	echo "Теги:&nbsp";
	foreach($tags as $tag){ ?>
		<a href="/search/index.php?tags=<?=$tag;?>"><?=$tag;?></a>,&nbsp
	<?
	}
}
?>
	<?// echo "<pre>"; print_r($tags); echo "</pre>";?>

<!--	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<a href="/search/index.php?q=<?=$value;?>"><?=$value;?></a>
			<br />
	<?endforeach;?> -->

	<?/*foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;*/?>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
<div style="float:right;">
<?
if ($arResult['PROPERTIES']['COMPANY']['VALUE']) {
	$db=CIBlockElement::GetByID($arResult['PROPERTIES']['COMPANY']['VALUE']);
	$auth = $db->GetNext();
//	echo "<pre>"; print_r($auth); echo "</pre>";
	echo "Автор: <a href='/firms/firm".$auth['ID']."/'>Компания \"".$auth['NAME']."\"</a>";
}
else { 
	$db=CIBlockElement::GetByID($arResult['ID']);
	$elem = $db->GetNext();
	$db=CUser::GetByID($elem['CREATED_BY']);
	$auth = $db->GetNext();
	$author = $auth['NAME'];
echo "Автор: ".$author;
	}

?>
</div>
</div>
