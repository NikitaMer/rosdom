<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?> <section class="faq"> 
  <h1><?=$APPLICATION->ShowTitle();?></h1>
 
  <p>� ������ ������� �� ������ �������� �� �������� ��� �������. </p>
 
  <p>��� �������� ������ �������� ������� ������ ��������, ��� �������������� - �������������.</p>
 
  <p>������� �������� �������� ������� �� ���� ������: </p>
 
  <p> </p>
 
  <ol> 
    <li>�������� ��������. �� ���� ����� ����������� �������������� ����.</li>
   
    <li>��������. �� ���� ����� �� ������ ��������� ������� � ����� �� ��������� ���� ����, � ����� � �������� ������ ����� ������������ ��� �����. � ��������� ������ ����� ������������ ���� ��� � �������.</li>
   
    <li>���������. �������, ������� �� ���������������, ������ �������� ����������� ����� ���� ����� �������� �����������.</li>
   </ol>
 
  <p></p>
 
  <p>
    <br />
  </p>

  <p><?$APPLICATION->IncludeComponent("rosdom:iblock.element.add.list", "rosdom_my_element_list", array(
	"EDIT_URL" => "/personal/my/faq/edit.php",
	"NAV_ON_PAGE" => "30",
	"MAX_USER_ENTRIES" => "100000",
	"IBLOCK_TYPE" => "faq",
	"IBLOCK_ID" => "14",
	"GROUPS" => array(
		0 => "1",
		1 => "5",
	),
	"STATUS" => "ANY",
	"ELEMENT_ASSOC" => "CREATED_BY",
	"ALLOW_EDIT" => "Y",
	"ALLOW_DELETE" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/my/faq/"
	),
	false
);?></p>
 </section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>