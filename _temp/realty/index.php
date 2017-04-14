<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Жилая недвижимость, дачные участки и готовые коттеджные поселки.");
?>
<section class="faq">
<? //echo (defined("ERROR_404")."<br>";
// echo define(ERROR_404)."@@@@@";
?> 
<?
$APPLICATION->IncludeComponent("bitrix:catalog.section", "rosdom_realty_list", array(
	"IBLOCK_TYPE" => "realty",
	"IBLOCK_ID" => "19",
	"SECTION_ID" => "",
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
	"SECTION_USER_FIELDS" => array(
		0 => "UF_METATITLE",
		1 => "UF_DESCRIPTION",
		2 => "UF_KEYWORDS",
		3 => "UF_MENUTITLE",
		4 => "",
	),
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "",
	"INCLUDE_SUBSECTIONS" => "N",
	"SHOW_ALL_WO_SECTION" => "N",
	"PAGE_ELEMENT_COUNT" => "30",
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" => array(
		0 => "TELEPHONE",
		1 => "MKAD",
		2 => "",
	),
	"OFFERS_LIMIT" => "5",
	"SECTION_URL" => "",
	"DETAIL_URL" => "/realty/realty#ID#/",
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
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"CONVERT_CURRENCY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);

?><?
//$section_code = 0;
/*

unset($arFilter);
$arFilter['IBLOCK_ID'] = '19';
if(isset($_REQUEST['SECTION_CODE'])){
//echo '1';
$res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 19, 'CODE' => $_REQUEST['SECTION_CODE']), false, array("UF_*")); 


$section = $res->Fetch(); 
$section_id = $section['ID'];
$section_code = $section['CODE'];
$APPLICATION->AddChainItem($section['NAME'], '/realty/'.$section_code.'/');
$arFilter['SECTION_ID'] = $section_id;
} else $arFilter['SECTION_ID'] = 0;

//echo '<pre>'; print_r($arFilter); echo '</pre>';
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, false, Array('UF_*'));
?>

<h1><?if(!empty($_REQUEST['SECTION_CODE'])): echo $section['NAME']; else:?>Недвижимость жилая, дачные участки и коттеджные поселки<?endif;?></h1>
<?
while($ar_result = $db_list->GetNext())
  {
	//echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
	//echo '<pre>'; print_r($ar_result); echo '</pre>';
	?>
<div class="b-subsection">
   <h2><a id="bxid_951823" > 0): echo $section_code.'/'; endif;?><?echo $ar_result["CODE"]?>/"><?if(!empty($ar_result['UF_MENUTITLE'])): echo $ar_result["UF_MENUTITLE"]; else: echo $ar_result["NAME"]; endif;?></a></h2>
   <figure>
   <?if(!empty($ar_result["PICTURE"])):?>
   <?
   $rsFile = CFile::GetByID($ar_result["PICTURE"]);
   $arFile = $rsFile->Fetch();
   ?>
   <img id="bxid_202719" alt=""  />
   <?endif;?>
   
	  <figcaption>
		<?echo $ar_result['DESCRIPTION'];?>
		 <p class="more"><a id="bxid_502002" > 0): echo $section_code.'/'; endif;?><?echo $ar_result["CODE"]?>/">Перейте к разделу</a></p>

	  </figcaption>   
   </figure>
</div>
   <?
  };
  */
?> </section> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>