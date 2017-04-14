<?
global $APPLICATION;
$dirs = array();
$dir = $APPLICATION->GetCurDir();
$dirs = explode( "/", $dir );
//print_r($dirs);
$Sec=$dirs["1"];
//echo $CurSec;

if (CModule::IncludeModule("iblock") ):
    $IBLOCK_TYPE = "faq";   // тип инфо-блока
    $IBLOCK_ID = 14;            // ID инфо-блока

//echo '!!!!!!!!'.$SECTION;
    $aMenuLinksNew = array();
    $aSection = array();

//        $rsSections = GetIBlockSectionList(
        $rsSections = CIBlockSection::GetList( 
            array(),
            array("ACTIVE"=>"Y", "IBLOCK_ID" => $IBLOCK_ID ),
            "1",
            array("UF_MENUTITLE")
        );
$i=0;
        while ($arSection = $rsSections->GetNext())
        
        {
            $aSections[] = $arSection;
            if ( $arSection["CODE"] == $CurSec)  $curSectionID = $arSection["ID"];
//echo ($i++).$arSection["CODE"]."<br>";
        }
	echo '<pre>';
//	print_r($aSections);
//	echo "++".$curSectionID."++";
	echo '</pre>';

	foreach ($aSections as $aSection){
//		if ( $aSection["IBLOCK_SECTION_ID"] == $curSectionID ) {
			$aMenuLinksNew[] = array(
    		$aSection["UF_MENUTITLE"],
                $aSection["CODE"]."/"   );
//                }
// print_r($aSection);
	};

    $aMenuLinks = array_merge($aMenuLinksNew, $aMenuLinks);

endif;

// print_r($aMenuLinksNew);

?>
