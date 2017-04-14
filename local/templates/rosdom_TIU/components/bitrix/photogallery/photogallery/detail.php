<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="photo-page-detail">
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail",
	"",
	Array(
 		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
 		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
 		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
 		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
 		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"BEHAVIOUR" => "SIMPLE",
		"USER_ALIAS" => "",
		"PERMISSION" => "",

		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD1" => $arParams["ELEMENT_SORT_FIELD1"],
		"ELEMENT_SORT_ORDER1" => $arParams["ELEMENT_SORT_ORDER1"],
		"ELEMENT_SELECT_FIELDS" => array(),
		"PROPERTY_CODE" => array(),

		"GALLERY_URL" => $arResult["URL_TEMPLATES"]["gallery"],
		"DETAIL_URL" => $arResult["URL_TEMPLATES"]["detail"],
		"DETAIL_EDIT_URL" => $arResult["URL_TEMPLATES"]["detail_edit"],
		"DETAIL_SLIDE_SHOW_URL"	=>	$arResult["URL_TEMPLATES"]["detail_slide_show"],
		"SEARCH_URL" => $arResult["URL_TEMPLATES"]["search"],
		"SECTION_URL" => $arResult["URL_TEMPLATES"]["section"],
		"UPLOAD_URL" => $arResult["URL_TEMPLATES"]["upload"],

		"COMMENTS_TYPE" => $arParams["COMMENTS_TYPE"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],

 		"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT_DETAIL"],
		"SHOW_TAGS" => $arParams["SHOW_TAGS"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],

		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
 		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
 		"SET_TITLE" => $arParams["SET_TITLE"],
		"ADD_CHAIN_ITEM" => $arParams["ADD_CHAIN_ITEM"],

		"THUMBS_SIZE"	=>	$arParams["PREVIEW_SIZE"]
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
if ($ElementID <= 0):
	return false;
endif;

if($arParams["USE_RATING"]=="Y"):
?><div id="photo_vote_source" style="display:none;">
<?
$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"ajax",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $ElementID,
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"]
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
?></div>
<script>
function to_show_vote()
{
	if (document.getElementById('photo_vote') && document.getElementById('vote_<?=$ElementID?>'))
	{
		var _div = document.getElementById('vote_<?=$ElementID?>');
		var div = document.getElementById('vote_<?=$ElementID?>').cloneNode(true);
		_div.id = 'temp';
		document.getElementById('photo_vote').appendChild(div);
	}
	else
	{
		document.getElementById('photo_vote_source').style.display = '';
	}

}
setTimeout(to_show_vote, 100);
</script><?
endif;
// SLIDER
$APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list",
	"slider",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
 		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
 		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"ELEMENT_ID" => ($_REQUEST["current"] ? $_REQUEST["current"]["id"] : $ElementID),
 		"SELECT_SURROUNDING" => ($_REQUEST["current"] ? "N" : "Y"),
		"BEHAVIOUR" => "SIMPLE",
		"USER_ALIAS" => "",
		"PERMISSION" => "",

		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD1" => $arParams["ELEMENT_SORT_FIELD1"],
		"ELEMENT_SORT_ORDER1" => $arParams["ELEMENT_SORT_ORDER1"],
		"ELEMENT_SELECT_FIELDS" => array(),
		"PROPERTY_CODE" => array(),

 		"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT_DETAIL"],
		"COMMENTS_TYPE" => $arParams["COMMENTS_TYPE"],

		"DETAIL_URL"	=>	$arResult["URL_TEMPLATES"]["detail"],
		"SEARCH_URL"	=>	$arResult["URL_TEMPLATES"]["search"],

		"PICTURES_SIGHT" => "standart",
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"PAGE_NAVIGATION_TEMPLATE" => $arParams["PAGE_NAVIGATION_TEMPLATE"],

		"THUMBS_SIZE"	=>	$arParams["THUMBS_SIZE"],
		"PREVIEW_SIZE"	=>	$arParams["PREVIEW_SIZE"],

		"PAGE_ELEMENTS"	=> ($arParams["SLIDER_COUNT_CELL"] * 3),
		"SHOW_PAGE_NAVIGATION"	=>	"none",
		"SHOW_CONTROLS"	=>	"Y",
		"SET_STATUS_404" => "N",

		"USE_RATING" => $arParams["USE_RATING"],
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
		"USE_COMMENTS" => $arParams["USE_COMMENTS"],
		"INCLUDE_SLIDER" => "Y",

		"SET_TITLE" => "N",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],

		"SLIDER_COUNT_CELL" => $arParams["SLIDER_COUNT_CELL"],
		"INCLUDE_SLIDER" => "Y"
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
?><div class="clear-empty"></div><?
// COMMENTS
if ($arParams["USE_COMMENTS"] == "Y" && $arParams["COMMENTS_TYPE"] != "none"):
	?><br class="empty-clear before-comment" /><?
	$arCommentsParams = Array(
 		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
 		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
 		"ELEMENT_ID" => $ElementID,
 		"COMMENTS_TYPE" => $arParams["COMMENTS_TYPE"],

		"DETAIL_URL" => $arResult["URL_TEMPLATES"]["detail"],

 		"COMMENTS_COUNT" => $arParams["COMMENTS_COUNT"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],

		"CACHE_TYPE" => "N",
		"CACHE_TIME" => 0);

	$arCommentsParams["COMMENTS_TYPE"] = (strToLower($arParams["COMMENTS_TYPE"]) == "forum" ? "forum" : "blog");

	if ($arCommentsParams["COMMENTS_TYPE"] != "forum")
	{
		$arCommentsParams["COMMENTS_TYPE"] = "blog";
		$arCommentsParams["BLOG_URL"] = $arParams["BLOG_URL"];
		$arCommentsParams["PATH_TO_USER"] = $arParams["PATH_TO_USER"];
		$arCommentsParams["PATH_TO_BLOG"] = $arParams["PATH_TO_BLOG"];
	}
	else
	{
		$arCommentsParams["FORUM_ID"] = $arParams["FORUM_ID"];
		$arCommentsParams["USE_CAPTCHA"] = $arParams["USE_CAPTCHA"];
		$arCommentsParams["URL_TEMPLATES_READ"] = $arParams["URL_TEMPLATES_READ"];
		$arCommentsParams["URL_TEMPLATES_PROFILE_VIEW"] = $arParams["URL_TEMPLATES_PROFILE_VIEW"];
		$arCommentsParams["POST_FIRST_MESSAGE"] = $arParams["POST_FIRST_MESSAGE"];
		$arCommentsParams["PREORDER"] = ($arParams["PREORDER"] != "N" ? "Y" : "N");
		$arCommentsParams["SHOW_LINK_TO_FORUM"] = ($arParams["SHOW_LINK_TO_FORUM"] != "N" ? "Y" : "N");
	}

	$APPLICATION->IncludeComponent(
		"bitrix:photogallery.detail.comment",
		"",
		$arCommentsParams,
		$component);
endif;
?>
</div>