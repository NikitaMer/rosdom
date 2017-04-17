<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$IB_ID = array(9,14);
$dbElement = CIBlockElement::GetList(false, array("IBLOCK_ID"=>$IB_ID), false, false, array('ID','CODE','NAME','XML_ID'));
while($arElement = $dbElement->Fetch()){ 
    $el = new CIBlockElement;
    //arshow($arElement);
    $el->Update($arElement["ID"],array('CODE' => $arElement['XML_ID']));    
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>