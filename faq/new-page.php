<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?> 
<?
global $APPLICATION;
$dirs = array();
$dir = $APPLICATION->GetCurDir();
$dirs = explode( "/", $dir );
//print_r($dirs);
$CurSec=$dirs["2"];
//echo $CurSec;

if (CModule::IncludeModule("iblock") && !empty($CurSec)):
    $IBLOCK_TYPE = "generated";   // С‚РёРї РёРЅС„Рѕ-Р±Р»РѕРєР°
    $IBLOCK_ID = 25;            // ID РёРЅС„Рѕ-Р±Р»РѕРєР°
    $aMenuLinksNew = array();
    $aSection = array();

        $rsSections = CIBlockSection::GetList( 
        // GetIBlockSectionList(
            array("SORT" => "ASC", "ID" => "ASC"),
            array("ACTIVE"=>"Y",  "IBLOCK_ID" => "25"),
            false,
            array("UF_MENUTITLE")
            );
        
        
        while ($arSection = $rsSections->GetNext())
        {
            $aSections[] = $arSection;
            if ( $arSection["CODE"] == $CurSec)  $curSectionID = $arSection["ID"];
        }

    echo '<pre>';
    print_r($aSections);
//    echo "++".$curSectionID."++";
    echo '</pre>';

    foreach ($aSections as $aSection){
        if ( $aSection["IBLOCK_SECTION_ID"] == $curSectionID ) {
            $aMenuLinksNew[] = array(
            $aSection["UF_MENUTITLE"],
                SITE_DIR.$aSection["CODE"]."/"   );
                }
// print_r($aSection);
    };
// print_r($aMenuLinksNew);
  //  $aMenuLinks = array_merge($aMenuLinksNew, $aMenuLinks);

endif;



?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>