<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

global $USER;

if ($USER->IsAuthorized()):
LocalRedirect('/personal/profile/');
else:
LocalRedirect('/personal/registration/');
endif;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>