<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������");

?> 
<h1>������</h1>
 
<div> 
  <br />
 </div>
 
<div> <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_help", Array(
	"IBLOCK_TYPE" => "generated",	// ��� ���������
	"IBLOCK_ID" => "33",	// ��������
	"SECTION_ID" => "",	// ID �������
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],	// ��� �������
	"SECTION_URL" => "",	// URL, ������� �� �������� � ���������� �������
	"COUNT_ELEMENTS" => "N",	// ���������� ���������� ��������� � �������
	"TOP_DEPTH" => "2",	// ������������ ������������ ������� ��������
	"SECTION_FIELDS" => "",	// ���� ��������
	"SECTION_USER_FIELDS" => "",	// �������� ��������
	"ADD_SECTIONS_CHAIN" => "Y",	// �������� ������ � ������� ���������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	),
	false
);?> </div>
 
<div> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>