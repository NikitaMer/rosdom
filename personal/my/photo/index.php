<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?> 
<h1>Фотоальбомы</h1>
 
<div><?$APPLICATION->IncludeComponent("bitrix:photogallery", "rosdom_photo_my", array(
	"USE_LIGHT_VIEW" => "Y",
	"IBLOCK_TYPE" => "photos",
	"IBLOCK_ID" => "29",
	"PATH_TO_USER" => "",
	"DRAG_SORT" => "Y",
	"USE_COMMENTS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/my/photo/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"SET_TITLE" => "Y",
	"ALBUM_PHOTO_SIZE" => "150",
	"THUMBNAIL_SIZE" => "150",
	"ORIGINAL_SIZE" => "1024",
	"PHOTO_LIST_MODE" => "N",
	"SHOWN_ITEMS_COUNT" => "6",
	"USE_RATING" => "N",
	"SHOW_TAGS" => "N",
	"UPLOADER_TYPE" => "flash",
	"UPLOAD_MAX_FILE_SIZE" => "3",
	"USE_WATERMARK" => "N",
	"SHOW_LINK_ON_MAIN_PAGE" => array(
	),
	"SECTION_SORT_BY" => "UF_DATE",
	"SECTION_SORT_ORD" => "DESC",
	"ELEMENT_SORT_FIELD" => "id",
	"ELEMENT_SORT_ORDER" => "desc",
	"DATE_TIME_FORMAT_DETAIL" => "d.m.Y",
	"DATE_TIME_FORMAT_SECTION" => "d.m.Y",
	"SECTION_PAGE_ELEMENTS" => "15",
	"ELEMENTS_PAGE_ELEMENTS" => "50",
	"PAGE_NAVIGATION_TEMPLATE" => "",
	"JPEG_QUALITY1" => "100",
	"JPEG_QUALITY" => "100",
	"ADDITIONAL_SIGHTS" => array(
	),
	"SHOW_NAVIGATION" => "Y",
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
		"PAGE_NAME" => "PAGE_NAME",
		"ACTION" => "ACTION",
	)
	),
	false
);?> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>