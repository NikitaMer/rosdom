<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form action="<?=$arResult["FORM_ACTION"]?>">
	<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 10,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
	);?><?else:?><input type="text" name="q" id="s" value="<?if (isset($_REQUEST['q'])){echo $_REQUEST['q'];}?>" maxlength="50" /><?endif;?>&nbsp;<input class="search_button" name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" />
<!--a href="/search/" class="link-advanced-search">Расширенный поиск</a-->
</form>
