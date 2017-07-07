<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?  
    CModule::IncludeModule("iblock");
    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(37, 22212);
    $IPROPERTY = $ipropValues->getValues();
    arshow($IPROPERTY);    

?>