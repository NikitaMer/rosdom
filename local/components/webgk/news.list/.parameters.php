<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("iblock");
$arElementList = array();
$rsElement = CIBlock::GetList(
   Array(), 
   Array(             
      'SITE_ID'=>SITE_ID,  
   ), true
);
while($arRes = $rsElement->Fetch()){
    $arElementList[] = $arRes['ID'].' '.$arRes['NAME'];    
}
$arComponentParameters = Array(
"PARAMETERS" => Array(
   "NEWS" => Array(
        "NAME" => GetMessage("NEWS"),
        "TYPE" => "INT",
        "DEFAULT" => "4",     
   ),
   "CACHE" => Array(
        "NAME" => GetMessage("CACHE"),
        "TYPE" => "INT",
        "DEFAULT" => "360000",     
   ),
)
);