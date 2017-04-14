<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("װמעמדאכונוט");
?><section class="faq"> 
  <h1>װמעמדאכונוט</h1>

  <p><?$APPLICATION->IncludeComponent("bitrix:photogallery.section.list", ".default", array(
	"IBLOCK_TYPE" => "photos",
	"IBLOCK_ID" => "29",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"BEHAVIOUR" => "SIMPLE",
	"PHOTO_LIST_MODE" => "N",
	"SORT_BY" => "SORT",
	"SORT_ORD" => "ASC",
	"PAGE_ELEMENTS" => "0",
	"INDEX_URL" => "index.php",
	"SECTION_URL" => "section.php?SECTION_ID=#SECTION_ID#",
	"SECTION_EDIT_URL" => "section_edit.php?SECTION_ID=#SECTION_ID#",
	"SECTION_EDIT_ICON_URL" => "section_edit_icon.php?SECTION_ID=#SECTION_ID#",
	"UPLOAD_URL" => "upload.php?SECTION_ID=#SECTION_ID#",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"ALBUM_PHOTO_SIZE" => "200",
	"ALBUM_PHOTO_THUMBS_SIZE" => "120",
	"PAGE_NAVIGATION_TEMPLATE" => "",
	"DATE_TIME_FORMAT" => "d.m.Y",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "Y"
	),
	false
);?></p>
 
  <p></p>
 
  <div class="news-detail-share"></div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>