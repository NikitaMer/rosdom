
<?
global $APPLICATION;
$dirs = array();
$dir = $APPLICATION->GetCurDir();
$dirs = explode( "/", $dir );

$CurSec=$dirs["2"];


if (CModule::IncludeModule("iblock") && !empty($CurSec)):
    $IBLOCK_TYPE = "projects_catalog";   // тип инфо-блока
    $IBLOCK_ID = 37;            // ID инфо-блока

    $aMenuLinksNew = array();
    $aSection = array();

        $rsSections = CIBlockSection::GetList(
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

    foreach ($aSections as $aSection){
        if ( $aSection["IBLOCK_SECTION_ID"] == $curSectionID ) {
            $aMenuLinksNew[] = array(
            $aSection["UF_MENUTITLE"],
                SITE_DIR.$aSection["CODE"]."/"   );
                }
    };
    $aMenuLinks = array_merge($aMenuLinksNew, $aMenuLinks);

endif;



?>
