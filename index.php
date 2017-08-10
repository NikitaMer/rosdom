<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "������ ������� ������ ���� ��� ��������, �������� ������������ �����������, ��������� ��� ��������� ������������� �������� �� �������");
$APPLICATION->SetPageProperty("keywords", "������ ���������, ������� �����, ����, �������� �������, ������� ��������,");
$APPLICATION->SetPageProperty("title", "������� ������� �����, ������������� �������������� ���������, ���������� ������������ �������� ������������ ���������, ������ ������� � �������� �� Rosdom.ru");
$APPLICATION->SetTitle("������");
//$GLOBALS["arrFilterMainTheme"] = array("PROPERTY_MAIN_VALUE" => 1);
//$GLOBALS["arrFilterMain"] = array("PROPERTY_MAIN_VALUE" => 1);

?> <?if($USER->IsAdmin() || true):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"pop_proj", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "projects",
		"IBLOCK_ID" => "35",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "NAME",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "MAIN_LINK",
			1 => "HREFS",
			2 => "DESCRIPTION",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "�������",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "pop_proj"
	),
	false
);?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top", 
	"new_projects_main_page", 
	array(
		"COMPONENT_TEMPLATE" => "new_projects_main_page",
		"IBLOCK_TYPE" => "projects_catalog",
		"IBLOCK_ID" => "37",
		"FILTER_NAME" => "arrFilter",
		"CUSTOM_FILTER" => "",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"ELEMENT_SORT_FIELD" => "created",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "",
		"ELEMENT_SORT_ORDER2" => "",
		"ELEMENT_COUNT" => "3",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE_MOBILE" => "",
		"OFFERS_LIMIT" => "0",
		"VIEW_MODE" => "SECTION",
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"MESS_BTN_BUY" => "������",
		"MESS_BTN_ADD_TO_BASKET" => "� �������",
		"MESS_BTN_DETAIL" => "���������",
		"MESS_NOT_AVAILABLE" => "��� � �������",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"COMPATIBLE_MODE" => "Y",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "price_for_architectural",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"MESS_BTN_COMPARE" => "��������",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"USE_ENHANCED_ECOMMERCE" => "N"
	),
	false
);?> <?endif?> <? #debmes($APPLICATION->GetTitle(),'oO');?> <?/*$APPLICATION->IncludeComponent("bitrix:menu", "rosdom_main_menu", array(
    "ROOT_MENU_TYPE" => "top",
    "MENU_CACHE_TYPE" => "N",
    "MENU_CACHE_TIME" => "3600",
    "MENU_CACHE_USE_GROUPS" => "N",
    "MENU_CACHE_GET_VARS" => array(
    ),
    "MAX_LEVEL" => "4",
    "CHILD_MENU_TYPE" => "",
    "USE_EXT" => "Y",
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N"
    ),
    false,
    array(
    "ACTIVE_COMPONENT" => "Y"
    )
);*/?>
<br />

<br />

<br />

<br />

<br />
 <section class="last-posts w-tabs">
  <h2>����� ��������� �� �����:</h2>

  <div class="b-tabs a" id="index-tabs"> <nav>
      <ul>
        <li><a href="#" >������</a></li>

        <li><a href="#" >������� � ������</a></li>

        <li class="active"><a href="#" >����</a></li>

<!--        <li><a href="#" >�����</a></li>   -->

        <li><a href="#" >�����</a></li>

<!--li><a id="bxid_396859" href="#" >������</a></li-->

        <li><a href="#" >��������</a></li>
       </ul>
     </nav> </div>

  <div class="b-descriptions">
    <div class="description"> <?
//$ArticleFilter = array("PROPERTY_MAIN_VALUE"=>"1");
?> <?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "articles_index",
    Array(
        "IBLOCK_TYPE" => "articles",
        "IBLOCK_ID" => "9",
        "NEWS_COUNT" => "5",
        "SORT_BY1" => "TIMESTAMP_X",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "DESC",
        "FILTER_NAME" => "ArticleFilter",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "PROPERTY_CODE" => array(0=>"",1=>"",),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "�������",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
false,
Array(
    'ACTIVE_COMPONENT' => 'Y'
)
);?>
      <div class="b-photogalery">
        <br />
       <a href="/articles/" >��� ������</a> &gt; </div>
     </div>

    <div class="description"> <?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "faq_index1",
    Array(
        "IBLOCK_TYPE" => "faq",
        "IBLOCK_ID" => "14",
        "NEWS_COUNT" => "5",
        "SORT_BY1" => "TIMESTAMP_X",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "PROPERTY_CODE" => array(0=>"",1=>"AUTHOR",2=>"EMAIL",3=>"REFERENCE",4=>"72",5=>"73",6=>"74",7=>"",),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "/faq/detail.php?ELEMENT_ID=#ID#",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "����",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
false,
Array(
    'ACTIVE_COMPONENT' => 'Y'
)
);?>
      <div class="b-photogalery"> <a href="/faq/" >��� �������</a> &gt; </div>
     </div>

    <div class="description visible"> <?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "rosdom_photo_first_page",
    Array(
        "IBLOCK_TYPE" => "photos",
        "IBLOCK_ID" => "31",
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_CODE" => "",
        "COUNT_ELEMENTS" => "Y",
        "TOP_DEPTH" => "3",
        "SECTION_FIELDS" => array(0=>"",1=>"",),
        "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
        "SECTION_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y"
    )
);?>
      <div class="b-photogalery"> <a href="/photo/" >��� ����</a> &gt; </div>
     </div>



    <div class="description"><?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "documents-index",
    Array(
        "IBLOCK_TYPE" => "documents",
        "IBLOCK_ID" => "15",
        "NEWS_COUNT" => "5",
        "SORT_BY1" => "TIMESTAMP_X",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(0=>"DATE_CREATE",1=>"",),
        "PROPERTY_CODE" => array(0=>"",1=>"FILE",2=>"",),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "���������",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
false,
Array(
    'ACTIVE_COMPONENT' => 'Y'
)
);?>
      <div class="b-photogalery"> <a href="/documents/" >��� �����</a>�&gt; </div>
     </div>

<!--div class="description"> 6 </div-->

    <div class="description"> <?
    if ((isset($_COOKIE['selected-city'])) and ($_COOKIE['selected-city'] != 0)){
        global $companiesFilter;
        $companiesFilter = Array("PROPERTY_CITY"=>$_COOKIE['selected-city']);
        //$companiesFilter = array("PROPERTIES" => array("CITY" => Array("ID"=>$_COOKIE['selected-city'])));

    };
    ?>                 <?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "companies_tab",
    Array(
        "IBLOCK_TYPE" => "firms",
        "IBLOCK_ID" => "10",
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_CODE" => "",
        "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
        "ELEMENT_SORT_FIELD" => "timestamp_x",
        "ELEMENT_SORT_ORDER" => "desc",
        "FILTER_NAME" => "companiesFilter",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "PAGE_ELEMENT_COUNT" => "15",
        "LINE_ELEMENT_COUNT" => "3",
        "PROPERTY_CODE" => array(0=>"PHONE",1=>"",),
        "SECTION_URL" => "",
        "DETAIL_URL" => "/firms/firm#ID#/",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "N",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "ADD_SECTIONS_CHAIN" => "N",
        "DISPLAY_COMPARE" => "N",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "CACHE_FILTER" => "N",
        "PRICE_CODE" => array(),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_PROPERTIES" => array(),
        "USE_PRODUCT_QUANTITY" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "��������",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
false,
Array(
    'ACTIVE_COMPONENT' => 'Y'
)
);?>
      <div class="b-photogalery"> <a href="/firms/" >��� ��������</a> &gt; </div>
     </div>
   </div>
 </section>
<br />

<br />
 <?
//$APPLICATION->SetPageProperty("description", "������ ������� ������ ���� ��� ��������, �������� ������������ �����������, ��������� ��� ��������� ������������� �������� �� �������");
//$APPLICATION->SetPageProperty("keywords", "������ ���������, ������� �����, ����, �������� �������, ������� ��������,");
//$APPLICATION->SetPageProperty("title", "������� ������� �����, ������������� �������������� ���������, ���������� ������������ �������� ������������ ���������, ������ ������� � �������� �� Rosdom.ru");
//$APPLICATION->SetTitle("������");
?>
<div>
  <br />
 </div>

<div>
  <h1><font color="#0070c0"><span style="font-size: 21.3333px; line-height: 22.8267px;"><i>����������� ���� ��� ���!</i></span></font></h1>

  <p class="MsoNormal" style="margin-bottom: 10pt; line-height: 115%;"><span style="font-size: 12pt; line-height: 115%; font-family: Cambria, serif;">������ ������� ������� � ����, � ������� ���� �� �����, ����� � ������, ��� ����� ��������� �� ���������� �������� ������. ��� ������ ����� ������������ � ����������� ����. <o:p></o:p></span></p>

  <p class="MsoNormal"><span style="font-size: 12pt; line-height: 107%; font-family: Cambria, serif;">����� �� ��� �� ������������� �������? ��� ���������� �������� ����������, ���������� ���� �� ��������� � ���������?<o:p></o:p></span></p>

  <p class="MsoNormal"><span style="font-size: 12pt; line-height: 107%; font-family: Cambria, serif;">� ������ �������, ������� ����� �����������<i>,</i> ��������� �������������. ������ ��, �������� ������������ �� ����� �������� �������-������������� ������� �������� ����. ����� ������� ���������� ������������ ����� � ����������. ��� ���������� �������� �� ��������, ��������� ��������� ������ ����������� � ������, �������� �������������� ��������� ���������.<o:p></o:p></span></p>

  <p class="MsoNormal"><span style="font-size: 12pt; line-height: 107%; font-family: Cambria, serif;">
      <br />
     </span></p>

  <h3><font color="#0070c0"><span style="font-size: 21.3333px; line-height: 22.8267px;"><i>�� ������� ����� ������ ��������!</i></span></font></h3>

  <h2><span style="font-weight: normal;"><span style="font-family: Cambria, serif; font-size: 12pt; line-height: 107%;">������� �������������� ���� ��������������, ����� ���� ��������� � ��� ������������ ���������� � ���������� ������� ������. ���� �������� ��� ����� ���������������� � ������ �������.���� �����������, ������������ ������� </span><span style="font-family: Cambria, serif; font-size: 12pt; line-height: 107%;">�������</span></span><span style="font-family: Cambria, serif; font-size: 12pt; line-height: 107%;"><span style="font-weight: normal;"> �����, ��������� ����������� ��������������������� �����������. ��� ��������� ������� ����������� ��� �� ������ ��� ������������� � �������� ��� ����������, ������������� � ������� ������������ ������</span>�.�</span></h2>

  <p class="MsoNormal"><span style="font-size: 12pt; line-height: 107%; font-family: Cambria, serif;">��� ���� ������� ������� ������ ����������� (����������), ������������� ������������ ���������� � ��� ���������� � ������������� ����� ����������-�������� �����.<o:p></o:p></span></p>

  <p class="MsoNormal"><span style="font-size: 12pt; line-height: 107%; font-family: Cambria, serif;">
      <br />
     </span></p>

  <p class="MsoNormal"><b><i><span style="font-size: 16pt; line-height: 107%; color: rgb(0, 112, 192);">������������ ����� ��������</span></i></b><b><i><span style="font-size: 16pt; line-height: 107%; color: rgb(0, 112, 192);">�������� �����:</span></i></b></p>

  <p class="MsoListParagraphCxSpFirst" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ��������� �������� ������� ����������� ���� ��������� ���������������; <o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ������� ������ ����� �������� ����� �� ����� ��� ������, ��� ������ ��������� �����, ����������� ��� ���������� ��� ��������� �� ������� ���������; <o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ������ ���� ����� ������������ �������� �������������� �������;<o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ������������ ���������� ������ ��������� �������� �� �����, ������� ��� ���� ��������;<o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ������� ��������� ����������� ������������ ����������, ����������� ��� ����� ���������� �������; <o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ������ ���������� �� �������� ��������������, ��������� ������ ������� �� �������� ������������ �������;<o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ������ ��� ������� ��������� ���� ����������� ��������� (������������, ����������, ������������, ����������������� � �.�.);<o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ���������������� ����������� ������� ����������� ���� �������� ���������� ������������ ������������ ����;<o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpMiddle" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� ����� ������� �������� ������������ ������������� ������������ �������, ����������� ������ � �������� �������� ����������;<o:p></o:p></span></p>

  <p class="MsoListParagraphCxSpLast" style="margin-left: 18pt; text-indent: -18pt;"><span style="font-size: 12pt; line-height: 107%; font-family: Symbol;">� </span><span style="font-size: 12pt; line-height: 107%; font-family: Cambria, serif;">������� </span><span style="font-size: 12pt; line-height: 107%; font-family: Cambria, serif;">����� ���� ������� ������������ � ����� �������� ��� ���������� �������� ������. <o:p></o:p></span></p>

  <p class="MsoNormal" style="margin-bottom: 0.0001pt;"><span style="font-size: 12pt; font-family: Cambria, serif;">���������� �������� ���������� �� ����� �������� ���� ������ ������� ���� ������������. ���� ���� � �������������� �������� ������������� �����, ����� ���������� ����� ��������. ���� ��������, ������� �������� ���� �������� ���������� �����, � ������������� ������������ �������� � �������� �������������.<o:p></o:p></span></p>

  <p class="MsoNormal" style="margin-bottom: 0.0001pt;"> </p>

  <p class="MsoNormal" style="margin-bottom: 0.0001pt;"><span style="font-size: 12pt; font-family: Cambria, serif;">���������� ���� ����� ����� � ����.�</span></p>

  <p class="MsoNormal" style="margin-bottom: 0.0001pt;"><span style="font-size: 12pt; font-family: Cambria, serif;">�������� �������������!<o:p></o:p></span></p>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>