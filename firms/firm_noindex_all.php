<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>

<?
/*
$ar_db = CIBlockSection::GetList(
		array(), 
		array("IBLOCK_ID"=>"25")
);
while ( $ar_section = $ar_db->GetNext()) {

	$sect[$ar_section["CODE"]] = $ar_section;
}
*/
//echo "<pre>"; print_r($sect); echo "</pre>";


CModule::IncludeModule('iblock');

$elem = array();
$props = array();
$ar_db = CIBlockElement::GetList(
		array(), 
		array("IBLOCK_ID"=>"10"),
		false,
		false,
		array("IBLOCK_ID","ID", "NAME", "CODE", "PROPERTY_SITE_URL_NOINDEX")
		);
		

		
while ( $ar_element = $ar_db->GetNext()) {
	$res=CIBlockElement::SetPropertyValueCode($ar_element['ID'], "SITE_URL_NOINDEX" , array("VALUE"=>"54"));
	if ($res) echo "<br>Updated ".$ar_element['ID'];
	else echo "Error ".$ar_element['ID'];
//echo "<pre>"; print_r($ar_element); echo "</pre>";
//echo $ar_element['ID']." - ".$ar_element['SITE_URL_NOINDEX'];
}

echo "OK";
//echo "<pre>"; print_r($); echo "</pre>";

?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>