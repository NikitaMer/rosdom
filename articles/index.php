<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������ � �������, ������������, ������ �� ������� rosdom.ru ");
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_article_list", Array(
	"IBLOCK_TYPE" => "articles",	// ��� ����-�����
	"IBLOCK_ID" => "9",	// ����-����
	"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID �������
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],	// ��� �������
	"COUNT_ELEMENTS" => "N",	// ���������� ���������� ��������� � �������
	"TOP_DEPTH" => "1",	// ������������ ������������ ������� ��������
	"SECTION_FIELDS" => array(	// ���� ��������
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// �������� ��������
		0 => "UF_DESCRIPTION",
		1 => "UF_KEYWORDS",
		2 => "UF_METATITLE",
		3 => "UF_MENUTITLE",
		4 => "",
	),
	"SECTION_URL" => "",	// URL, ������� �� �������� � ���������� �������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>