<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// дополнительный файл меню
if (CModule::IncludeModule("iblock")):

//    $IBLOCK_TYPE = "generated";   // тип инфо-блока
    $IBLOCK_ID = 30;            // ID инфо-блока
    $CACHE_TIME = 3600;         // кэшируем на 1 час

    $aMenuLinksNew = array();

    // создаем объект для кэширования меню
    $CACHE_ID = __FILE__.$IBLOCK_ID;
    $obMenuCache = new CPHPCache;
    // если массив закэширован то
    if($obMenuCache->InitCache($CACHE_TIME, $CACHE_ID, "/"))
    {
        // берем данные из кэша
        $arVars = $obMenuCache->GetVars();
        $aMenuLinksNew = $arVars["aMenuLinksNew"];
    }
    else
    {
        // иначе собираем разделы
       $rsSections = CIBlockSection::GetList( array("LEFT_MARGIN" => "ASC"), array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE"=>"Y" ,"DEPTH_LEVEL"<=2), false, array("ID", "NAME", "UF_LINK", "DEPTH_LEVEL") );
       while ($arSection = $rsSections->Fetch())
       {
             if($arSection["DEPTH_LEVEL"] == 1) $is_parent=1;
             else  $is_parent="";
//   echo "<pre>";print_r($arSection);echo "</pre>";
            $aMenuLinksNew[] = array(
                $arSection["NAME"], 
                $arSection["UF_LINK"], 
                $arrAddLinks,
                array("FROM_IBLOCK" => 30, "DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"], "IS_PARENT" => $is_parent)
         	);      
     
       }
    }
//echo "<pre>";print_r($arSection);echo "</pre>";
    // сохраняем данные в кэше
    if($obMenuCache->StartDataCache())
    {
        $obMenuCache->EndDataCache(Array("aMenuLinksNew" => $aMenuLinksNew));
    }


    $aMenuLinks = array_merge($aMenuLinksNew, $aMenuLinks);
//echo "<pre>"; print_r($aMenuLinks);echo "</pre>"; 
endif;

?> 