<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$Params = $GLOBALS["APPLICATION"] -> GetCurPage(); 
if($this->StartResultCache($arParams['CACHE'],$Params)){
    if($_SESSION['SECTION_ID']){        
        $news_section = GetIBlockSectionList($_SESSION['IBLOCK_ID'],$_SESSION['SECTION_ID']); 
        while($dr = $news_section->GetNext()){ 
            $news_list = GetIBlockElementList($_SESSION['IBLOCK_ID'],$dr['ID'],Array("id"=>"rand"),$arParams['NEWS'],!$_SESSION['ELEMENT_ID']);
            while($drl = $news_list->GetNext()){ 
                $dbResult[] =  $drl;       
            }   
        }        
        $idResult = array_rand($dbResult, $arParams['NEWS']);
        foreach($idResult as $id){
            $arResult[] = $dbResult[$id]; 
        }                                       
    }elseif($_SESSION['SECTION_ELEMENT_ID']){
        $news_list = GetIBlockElementList($_SESSION['IBLOCK_ID'],$_SESSION['SECTION_ELEMENT_ID']);
        while($drl = $news_list->GetNext()){
            if($drl["ID"] != $_SESSION['ELEMENT_ID']){
                $dbResult[] =  $drl;   
            }                   
        }                                            
        $idResult = array_rand($dbResult, $arParams['NEWS']);
        foreach($idResult as $id){
            $arResult[] = $dbResult[$id]; 
        }                                      
    } 
    $this->IncludeComponentTemplate();
}
?>