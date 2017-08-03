<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("РџСЂРѕРµРєС‚С‹ РґРѕРјРѕРІ");
use Bitrix\Iblock\InheritedProperty;
?>
<?
$E =  new CIBlockElement;
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID", "PROPERTY_MATERIAL", "PROPERTY_PLINTH", "PROPERTY_ATTIC", "PROPERTY_EXISTENS_GARAGE", "PROPERTY_OB_PL");
$arFilter = Array("IBLOCK_ID"=>37, "ACTIVE"=>"Y");
$el = CIBlockElement::GetList(Array("SORT"=>"ASC"),$arFilter, false, false, $arSelect);
$j =0;
while($elem=$el->GetNext()){
    $ipropValues =  new \Bitrix\Iblock\InheritedProperty\ElementValues($elem["IBLOCK_ID"], $elem["ID"]); 
    $elem_prop = $ipropValues->getValues();        
    $pos = mb_strstr($elem_prop["ELEMENT_META_TITLE"],'Купить проект');     
    if($elem_prop["ELEMENT_META_TITLE"] == $pos || $elem_prop["ELEMENT_META_TITLE"] == false){ 
        if($elem["IBLOCK_SECTION_ID"] == 2695){
            $type = "баня";                
        }elseif($elem["IBLOCK_SECTION_ID"] == 2696){
            $type = "особняк";                
        }elseif($elem["IBLOCK_SECTION_ID"] == 2698 || $elem["IBLOCK_SECTION_ID"] == 2710){
            $type = "гаража";                
        }elseif($elem["IBLOCK_SECTION_ID"] == 2700){
            $type = "бассеина";                
        }else{
            $type = "дома";
        }        
        $dop = array();
        if($elem["PROPERTY_PLINTH_VALUE"] == "есть"){
            array_push($dop, "с цоколем");    
        }
        if($elem["PROPERTY_ATTIC_VALUE"] == "есть"){
            array_push($dop, "с мансардой");    
        }
        if($elem["PROPERTY_EXISTENS_GARAGE_VALUE"]){
            array_push($dop, "с гаражом");    
        }     
        if($elem["PROPERTY_MATERIAL_VALUE"] == "Кирпич"){
            $mat = "кирпичного";    
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "Пенобетон"){
            $mat = "пенобетоного";  
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "Дерево"){
            $mat = "деревянного";  
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "Каркас"){
            $mat = "каркасного";  
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "Монолит"){
            $mat = "монолитного";  
        }                                                                     
        $arLoadProductArray[$elem["ID"]] = Array(             
        "IPROPERTY_TEMPLATES"   =>  array( 
           "ELEMENT_META_TITLE"          =>  "Купить проект ".$mat." ".$type." ".$dop[0]." ".$elem["NAME"]."  площадью ".$elem["PROPERTY_OB_PL_VALUE"]." м2  от Rosdom",  
           "ELEMENT_META_DESCRIPTION"       =>  "Задать вопросы по проекту ".$elem["NAME"]." и проконсультироваться по стоимости строительства ".$type." можете по телефону + 7 (495) 775-63-93. Хотите заказать типовой проект ".$elem["NAME"]." ".$mat." ".$type." площадью ".$elem["PROPERTY_OB_PL_VALUE"]." м2", 
           "ELEMENT_META_KEYWORDS"    =>  $elem["NAME"].", проект, ".$type, 
           "ELEMENT_PAGE_TITLE"          =>  "Проект ".$mat." ".$type.", ".$dop[0]." ".$elem["NAME"]."  площадью ".$elem["PROPERTY_OB_PL_VALUE"]."  м2", 
        )
        );    
        //$res = $E->Update($elem["ID"],$arLoadProductArray);                  
    } 
         
}
foreach ($arLoadProductArray as $key=>$item){
    $res = $E->Update($key,$item); 
    $j++;    
} 
arshow($j);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>