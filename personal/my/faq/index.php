<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?> <section class="faq"> 
  <h1><?=$APPLICATION->ShowTitle();?></h1>
 
  <p>В данном разделе Вы можете отвечать на заданные Вам вопросы. </p>
 
  <p>Для создания нового элемента нажмите кнопку добавить, для редактирования - редактировать.</p>
 
  <p>Процесс создания элемента состоит из трех этапов: </p>
 
  <p> </p>
 
  <ol> 
    <li>Создание элемента. На этом этапе заполняются содержательные поля.</li>
   
    <li>Привязка. На этом этапе Вы можете привязать элемент к одной из созданных Вами фирм, и тогда в качестве Автора будет отображаться эта фирма. В противном случае будет отображаться Ваше имя и фамилия.</li>
   
    <li>Модерация. Элемент, который вы отредактировали, станут доступны посетителям сайта лишь после проверки модератором.</li>
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