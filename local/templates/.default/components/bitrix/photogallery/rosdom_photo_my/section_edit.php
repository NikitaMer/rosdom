<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?> 
<h1>Редактирование галереи</h1>
 <?$APPLICATION->IncludeComponent("rosdom:photogallery.section.edit", "rosdom_section_edit", array(
	"IBLOCK_TYPE" => "photos",
	"IBLOCK_ID" => "29",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
	"USER_ALIAS" => "",
	"BEHAVIOUR" => "",
	"ACTION" => $_REQUEST["ACTION"],
	"INDEX_URL" => "index.php",
	"SECTION_URL" => "index.php",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"DATE_TIME_FORMAT" => "d.m.Y",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "Y"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>