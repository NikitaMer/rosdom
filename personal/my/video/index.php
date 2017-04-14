<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?> <section class="faq"> 
  <h1><?=$APPLICATION->ShowTitle();?></h1>
 
  <p>В данном разделе Вы можете добавить ссылки на видео-ролики, размещенные на различных видео-хостингах.</p>
 
  <p>Для создания нового элемента нажмите кнопку добавить, для редактирования - редактировать. В поле &quot;Код видео&quot; вставьте скопированный с видеохостинга код видео-ролика. Он должен начинаться и заканчиваться либо тегами &lt;iframe&gt; ... &lt;/iframe&gt;, либо &lt;object&gt; ... &lt;/object&gt;. </p>
 
  <p><?$APPLICATION->IncludeComponent(
	"rosdom:iblock.element.add.list",
	"rosdom_my_element_list",
	Array(
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "video",
		"IBLOCK_ID" => "13",
		"GROUPS" => array("1","5"),
		"STATUS" => "ANY",
		"EDIT_URL" => "/personal/my/video/edit.php",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"ALLOW_EDIT" => "Y",
		"ALLOW_DELETE" => "Y",
		"NAV_ON_PAGE" => "30",
		"MAX_USER_ENTRIES" => "100000"
	)
);?></p>
 </section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>