<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>

		<h1><?=$arResult["NAME"]?></h1>
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
	<br />
<br />

<?// ТЕГИ
if(strlen($arResult["FIELDS"]["TAGS"])>0) {
	$tags=array();
	$tags = explode ( ",", $arResult["FIELDS"]["TAGS"]);
	echo "Теги:&nbsp";
	foreach($tags as $tag){ ?>
		<a href="/search/index.php?tags=<?=$tag;?>"><?=$tag;?></a>,&nbsp
	<?
	}
}
// КОНЕЦ ТЕГОВ?>
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

