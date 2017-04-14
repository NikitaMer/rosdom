<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?><section class="faq"> 
 
<?$APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list.ex", 
	"rosdom_list_ex", 
	array(
		"IBLOCK_TYPE" => "photos",
		"IBLOCK_ID" => "31",
		"BEHAVIOUR" => "SIMPLE",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"ELEMENT_LAST_TYPE" => "none",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD1" => "",
		"ELEMENT_SORT_ORDER1" => "asc",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"USE_DESC_PAGE" => "N",
		"PAGE_ELEMENTS" => "50",
		"PAGE_NAVIGATION_TEMPLATE" => "",
		"DETAIL_URL" => "detail.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
		"DETAIL_SLIDE_SHOW_URL" => "slide_show.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
		"SEARCH_URL" => "search.php",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "Y",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array(
			0 => "1",
		),
		"DATE_TIME_FORMAT" => "d.m.Y",
		"SET_STATUS_404" => "Y",
		"PATH_TO_USER" => "/company/personal/user/#USER_ID#",
		"NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
		"SHOW_LOGIN" => "Y",
		"ADDITIONAL_SIGHTS" => array(
		),
		"PICTURES_SIGHT" => "",
		"THUMBNAIL_SIZE" => "150",
		"SHOW_PAGE_NAVIGATION" => "top",
		"SHOW_RATING" => "N",
		"SHOW_SHOWS" => "N",
		"SHOW_COMMENTS" => "N",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "4",
			4 => "5",
			5 => "",
		),
		"DISPLAY_AS_RATING" => "rating",
		"RATING_MAIN_TYPE" => "",
		"COMPONENT_TEMPLATE" => "rosdom_list_ex",
		"DRAG_SORT" => "Y",
		"USE_COMMENTS" => "N"
	),
	false
);?>
 
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_photo_list", array(
	"IBLOCK_TYPE" => "photos",
	"IBLOCK_ID" => "31",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"COUNT_ELEMENTS" => "N",
	"TOP_DEPTH" => "1",
	"SECTION_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"ADD_SECTIONS_CHAIN" => "N"
	),
	false
);?>
</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>