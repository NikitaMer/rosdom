<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?> 
<h1>Регистрация</h1>
 <?$APPLICATION->IncludeComponent(
	"rosdom:main.register",
	"rosdom_register",
	Array(
		"USER_PROPERTY_NAME" => "",
		"SHOW_FIELDS" => array("NAME", "LAST_NAME", "PERSONAL_GENDER", "PERSONAL_BIRTHDAY", "PERSONAL_PHONE"),
		"REQUIRED_FIELDS" => array("NAME", "LAST_NAME"),
		"AUTH" => "N",
		"USE_BACKURL" => "N",
		"SUCCESS_PAGE" => "/personal/registration/done.php",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array()
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>