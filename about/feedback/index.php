<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�������� ����� | ������� �������� ����� - Rosdom.ru");
?> 
<h1> �������� ����� </h1>
 �� ������ ���� � ���� ���������� � �������� ���� ������ � ����� �������.
<div>���������, ����������, ��� ���� ����� � �� ����������� ������������� �� ���� ��������� ����������� ����������. 
  <div> 
    <br />
   </div>
 
  <div><?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	".default", 
	array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "�������, ���� ��������� �������.",
		"EMAIL_TO" => "registratsiya@rosdom.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?></div>
 </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>