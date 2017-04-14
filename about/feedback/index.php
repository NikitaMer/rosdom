<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь | Каталог проектов домов - Rosdom.ru");
?> 
<h1> Обратная связь </h1>
 Мы всегда рады с Вами пообщаться и получить Ваше мнение о нашем проекте.
<div>Заполните, пожалуйста, все поля формы и мы постараемся отреагировать на Ваше сообщение максимально оперативно. 
  <div> 
    <br />
   </div>
 
  <div><?$APPLICATION->IncludeComponent("bitrix:main.feedback", ".default", array(
	"USE_CAPTCHA" => "Y",
	"OK_TEXT" => "Спасибо, ваше сообщение принято.",
	"EMAIL_TO" => "registratsiya@rosdom.ru",
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "EMAIL",
		2 => "MESSAGE",
	),
	"EVENT_MESSAGE_ID" => array(
		0 => "7",
	)
	),
	false
);?></div>
 </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>