<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

?> <section class="faq"> 
  <h1><?=$APPLICATION->ShowTitle();?></h1>
 
  <div>В данном разделе Вы можете создать фирму, от имени которой будут публиковаться Ваши материалы.</div>

  <div>
    <br />
  </div>


  <div> 
    <br />
   </div>
 
  <div><?$APPLICATION->IncludeComponent("rosdom:iblock.element.add.list", "rosdom_my_firm_list", array(
	"EDIT_URL" => "/personal/my/firms/edit.php",
	"NAV_ON_PAGE" => "10",
	"MAX_USER_ENTRIES" => "100000",
	"IBLOCK_TYPE" => "firms",
	"IBLOCK_ID" => "10",
	"GROUPS" => array(
	),
	"STATUS" => "ANY",
	"ELEMENT_ASSOC" => "CREATED_BY",
	"ALLOW_EDIT" => "Y",
	"ALLOW_DELETE" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/my/firms/"
	),
	false
);?></div>
 
  <div></div>
 </section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>