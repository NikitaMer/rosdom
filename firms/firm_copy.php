<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>

<?

$ar_db = CIBlockSection::GetList(
		array(), 
		array("IBLOCK_ID"=>"25")
);
while ( $ar_section = $ar_db->GetNext()) {

	$sect[$ar_section["CODE"]] = $ar_section;
}

//echo "<pre>"; print_r($sect); echo "</pre>";




$elem = array();
$props = array();
$ar_db = CIBlockElement::GetList(
		array(), 
		array("IBLOCK_ID"=>"10"),
		false,
		false,
		array("IBLOCK_ID","ID", "NAME", "CODE")
		);
		
		
$i=0;
while ( $ar_element = $ar_db->GetNext()) {
$props = array();
	$elem[$ar_element["CODE"]] = $ar_element;

	$ar_links = CIBlockElement::GetElementGroups($ar_element["ID"], "1");
	while ( $link = $ar_links->GetNext()) {
	
	echo $ar_element["CODE"]." - ".$link["CODE"]."<br>";
//		$elem[$ar_element["CODE"]]["LINK"][] = $link["ID"]." - ". $link["CODE"]." = ".$sect[$link["CODE"]]["ID"];
		$props[] = $sect[$link["CODE"]]["ID"];
	 
	}
//echo "<pre>"; print_r($ar_element); echo "</pre>";
//if ($i >= 1000 && $i< 1100 ) 
CIBlockElement::SetPropertyValueCode($ar_element["ID"],"PUB_SECTION", $props);
//	echo $ar_element["CODE"]."<br>";
//unset $props;
$i++;
}


//echo "<pre>"; print_r($elem); echo "</pre>";

?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>