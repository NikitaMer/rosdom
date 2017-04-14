<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?
    if(CModule::IncludeModule("iblock"))
    { 
        if (!empty($_GET['SECTION_NAME'])){


            $db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>25, "CODE" => $_GET['SECTION_NAME']), false, Array("ID", "NAME", "UF_METATITLE","DESCRIPTION","UF_DESCRIPTION", "UF_KEYWORDS"));
            if($arSection = $db_list->GetNext())  { 
                if (!empty($arSection["UF_METATITLE"])) $APPLICATION->SetPageProperty("title", $arSection["UF_METATITLE"]); 
            }

        }

        //Устанавливаем параметры страницы
        if (!empty($arSection["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $arSection["UF_DESCRIPTION"]); 
        if (!empty($arSection["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $arSection["UF_KEYWORDS"]); 


        // Выясняем ID текущего раздела
        $db_section = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>"25", "CODE"=>$_REQUEST["SECTION_NAME"]));
        if  ($ar_result = $db_section->GetNext())  {
            $SectID = $ar_result['ID'];
        }

        // Описываем фильтр для фирм
        global $arFilter; 
        $arFilter['ID'] = array();
        $arFilter['ID']['0'] = 0; // нужно, чтобы при пустом массиве работал пустой фильтр
        $db_list = CIBlockElement::GetList(Array("NAME"=>"ASC"), Array("PROPERTY_PUB_SECTION"=>$SectID, "IBLOCK_ID"=>"10"), false, false , Array("ID", "IBLOCK_CODE", "PROPERTY_PUB_SECTION"));
        $i=0;
        while ($ar_result = $db_list->GetNext())  {
            $arFilter['ID'][$i++] = ($ar_result["ID"]);
        }

        // Описываем фильтр для статей
        global $articleFilter; 
        $articleFilter['ID'] = array();
        $articleFilter['ID']['0'] = 0; // нужно, чтобы при пустом массиве работал пустой фильтр
        $db_list = CIBlockElement::GetList(Array("NAME"=>"ASC"), Array("PROPERTY_PUB_SECTION"=>$SectID, "IBLOCK_ID"=>"9" ), false, false, Array("ID", "IBLOCK_CODE", "PROPERTY_PUB_SECTION"));
        $i=0;
        while ($ar_result = $db_list->GetNext())  {
            $articleFilter['ID'][$i++] = ($ar_result["ID"]);
        }

        // Описываем фильтр для Вопросов-ответов
        global $faqFilter; 
        $faqFilter['ID'] = array();
        $faqFilter['ID']['0'] = 0; // нужно, чтобы при пустом массиве работал пустой фильтр
        $db_list = CIBlockElement::GetList(Array("NAME"=>"ASC"), Array("PROPERTY_PUB_SECTION"=>$SectID, "IBLOCK_ID"=>"14" ), false, false, Array("ID", "IBLOCK_CODE", "PROPERTY_PUB_SECTION"));
        $i=0;
        while ($ar_result = $db_list->GetNext())  {
            if($ar_result["ID"]>0) $faqFilter['ID'][$i++] = ($ar_result["ID"]);
        }

        // Описываем фильтр для Вопросов-ответов
        global $filesFilter; 
        $filesFilter['ID'] = array();
        $filesFilter['ID']['0'] = 0; // нужно, чтобы при пустом массиве работал пустой фильтр
        $db_list = CIBlockElement::GetList(Array("NAME"=>"ASC"), Array("PROPERTY_PUB_SECTION"=>$SectID, "IBLOCK_ID"=>"15" ), false, false, Array("ID", "IBLOCK_CODE", "PROPERTY_PUB_SECTION"));
        $i=0;
        while ($ar_result = $db_list->GetNext())  {
            if($ar_result["ID"]>0) $filesFilter['ID'][$i++] = ($ar_result["ID"]);
        }

        // Описываем фильтр для Фото
        global $photoFilter;
        $photoFilter = array();
        //$photoFilter['ID']['0'] = 0; // нужно, чтобы при пустом массиве работал пустой фильтр
        $db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("UF_PUB_SECTION"=>$SectID, "IBLOCK_ID"=>"31" ));
        $i=0;
        while ($ar_result = $db_list->GetNext())  {
            if($ar_result["ID"]>0) $photoFilter[$i++] = ($ar_result["ID"]);
        }
        //	echo "<pre>";	print_r($photoFilter);	echo "</pre>";

        // Описываем фильтр для Видео
        $videoFilter['ID'] = array();
        $videoFilter['ID']['0'] = 0; // нужно, чтобы при пустом массиве работал пустой фильтр
        $db_list = CIBlockElement::GetList(Array("NAME"=>"ASC"), Array("PROPERTY_PUB_SECTION"=>$SectID, "IBLOCK_ID"=>"13" ), false, false, Array("ID", "IBLOCK_CODE", "PROPERTY_PUB_SECTION"));
        $i=0;
        while ($ar_result = $db_list->GetNext())  {
            if($ar_result["ID"]>0) $videoFilter['ID'][$i++] = ($ar_result["ID"]);
        }

        // PressReleaseFilter
        global $PressReleaseFilter; 
        $PressReleaseFilter['ID'] = array();
        $PressReleaseFilter['ID']['0'] = 0; // нужно, чтобы при пустом массиве работал пустой фильтр
        $db_list = CIBlockElement::GetList(Array("NAME"=>"ASC"), Array("PROPERTY_PUB_SECTION"=>$SectID, "IBLOCK_ID"=>"34" ), false, false, Array("ID", "IBLOCK_CODE", "PROPERTY_PUB_SECTION"));
        $i=0;
        while ($ar_result = $db_list->GetNext())  {
            $PressReleaseFilter['ID'][$i++] = ($ar_result["ID"]);
        }


    ?>


    <h1><?echo $arSection["NAME"]?></h1>
    <section class="last-posts w-tabs equipments-tabs"> 
        <div id="section-tabs" class="b-tabs"> <nav> 
            <ul> 
                <li id="tabs-about"<?if (!isset($_REQUEST['SECTION_NAME'])):?> style="display: none;"<?else:?> class="active"<?endif;?>><a href="#" >� �������</a></li>
                <li style="display: none;" id="tabs-companies"><a href="#" >��������</a></li>
                <li style="display: none;" id="tabs-articles"><a href="#" >������</a></li>
                <li style="display: none;" id="tabs-press-release"><a href="#" >�����-������</a></li>
                <li style="display: none;" id="tabs-faq"><a href="#" >������� � ������</a></li>
                <li style="display: none;" id="tabs-files"><a href="#" >�����</a></li>
                <li style="display: none;" id="tabs-photo"><a href="#" >����</a></li>
                <li style="display: none;" id="tabs-video"><a href="#" >�����</a></li>
            </ul>
        </nav> </div>

        <div class="b-descriptions"> 
            <div id="tabs-about-container" class="secdes description visible"> 
                <div id="about-section-description">
                    <?=$arSection["DESCRIPTION"]?>
                </div>
            </div>

            <div class="secdes description"> 
                <!--	<form action="#" class="form-choise-city"> 
                <a class="add-company" href="/add/" >�������� ��������</a> </form> 
                -->	

                <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "rosdom_firm_list", array(
                        "IBLOCK_TYPE" => "firms",
                        "IBLOCK_ID" => "10",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "arFilter",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "PHONE",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "/firms/firm#ID#",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "�������",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => ""
                        ),
                        false,
                        array(
                            "ACTIVE_COMPONENT" => "Y"
                        )
                    );?>


                <?if($notmain):?><div class="b-photogalery"> <a href="/firms/" >������� � ����� ������</a> &gt; </div><?endif;?>
            </div>

            <div class="secdes description "> 

                <?$APPLICATION->IncludeComponent("bitrix:news.list", "articles_index", array(
                    "IBLOCK_TYPE" => "articles",
                    "IBLOCK_ID" => "9",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "articleFilter",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "�������",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => ""
                    ),
                    false,
                    array(
                        "ACTIVE_COMPONENT" => "Y"
                    )
                );?> </div>


            <div class="secdes description ">  
                <?
                    /* PressReleaseFilter */

                    $APPLICATION->IncludeComponent("bitrix:news.list", "press-release_index", array(
                        "IBLOCK_TYPE" => "pressrelease",
                        "IBLOCK_ID" => "34",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "PressReleaseFilter",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "�������",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => ""
                        ),
                        false,
                        array(
                            "ACTIVE_COMPONENT" => "Y"
                        )
                );?> </div>   

            <div class="secdes description "> 
                <?$APPLICATION->IncludeComponent("bitrix:news.list", "faq_index1", array(
                    "IBLOCK_TYPE" => "faq",
                    "IBLOCK_ID" => "14",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "faqFilter",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "�������",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => ""
                    ),
                    false,
                    array(
                        "ACTIVE_COMPONENT" => "Y"
                    )
                );?> </div>


            <div class="secdes description "> 
                <?$APPLICATION->IncludeComponent("bitrix:news.list", "documents-index", array(
                    "IBLOCK_TYPE" => "documents",
                    "IBLOCK_ID" => "15",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "filesFilter",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "�������",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => ""
                    ),
                    false,
                    array(
                        "ACTIVE_COMPONENT" => "Y"
                    )
                );?> </div>

            <div class="secdes description"> 
                <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_photo_tui", array(
                        "IBLOCK_TYPE" => "photos",
                        "IBLOCK_ID" => "31",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "COUNT_ELEMENTS" => "Y",
                        "TOP_DEPTH" => "2",
                        "SECTION_FIELDS" => array(
                            0 => "",
                            1 => "ID",
                            2 => "CODE",
                            3 => "XML_ID",
                            4 => "NAME",
                            5 => "SORT",
                            6 => "DESCRIPTION",
                            7 => "PICTURE",
                            8 => "DETAIL_PICTURE",
                            9 => "IBLOCK_TYPE_ID",
                            10 => "IBLOCK_ID",
                            11 => "IBLOCK_CODE",
                            12 => "IBLOCK_EXTERNAL_ID",
                            13 => "DATE_CREATE",
                            14 => "CREATED_BY",
                            15 => "TIMESTAMP_X",
                            16 => "MODIFIED_BY",
                            17 => "",
                        ),
                        "SECTION_USER_FIELDS" => array(
                            0 => "UF_PUB_SECTION",
                            1 => "UF_COMPANY",
                            2 => "",
                        ),
                        "SECTION_URL" => "",
                        "CACHE_TYPE" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "Y",
                        "ADD_SECTIONS_CHAIN" => "Y"
                        ),
                        false
                    );?>

                <? $APPLICATION->IncludeComponent("bitrix:news.list", "photo_index3", array(
                        "IBLOCK_TYPE" => "photos",
                        "IBLOCK_ID" => "31",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "photoFilter",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "�������",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => ""
                        ),
                        false,
                        array(
                            "ACTIVE_COMPONENT" => "N"
                        )
                    ); 
                ?>
            </div>


            <div class="secdes description"> 
                <?$APPLICATION->IncludeComponent("bitrix:news.list", "video_index", array(
                        "IBLOCK_TYPE" => "video",
                        "IBLOCK_ID" => "13",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "videoFilter",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "VIDEO",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "�������",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => ""
                        ),
                        false,
                        array(
                            "ACTIVE_COMPONENT" => "Y"
                        )
                    );?>
            </div>

        </div>
    </section>


    <?if(isset($_REQUEST['SECTION_NAME'])):?>
        <section class="about-section">
            <?

                //echo "<pre>";
                //print_r($arSection);
                //echo "</pre>";
                $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), Array("IBLOCK_ID"=>"25", "SECTION_ID"=>$arSection["ID"]), false, Array("UF_DESCSHORT"));
                while($ar_result = $db_list->GetNext())
                {
                    //		echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['CODE'].'<br>';
                ?>
                <div class="b-subsection">

                    <h2><a href="<?echo $cpu_link.$ar_result["CODE"].'/'?>"><?echo $ar_result["NAME"]?></a></h2>
                    <figure>
                        <?if(!empty($ar_result["PICTURE"])):?>
                            <?
                                $rsFile = CFile::GetByID($ar_result["PICTURE"]);
                                $arFile = $rsFile->Fetch();
                            ?>
                            <a href="<?echo $cpu_link.$ar_result["CODE"].'/'?>"><img src="/upload/<?echo $arFile["SUBDIR"];?>/<?echo $arFile["FILE_NAME"]?>" alt="<?echo $ar_result["NAME"]?>" title="<?echo $ar_result["NAME"]?>" /></a>
                            <?endif;?>

                        <figcaption>
                            <?
                                if (!empty($ar_result['UF_DESCSHORT'])) echo '<p>'.$ar_result['UF_DESCSHORT'].'</p>';
                                else echo $ar_result['DESCRIPTION'];?>
                            <p class="more"><a href="<?echo $cpu_link.$ar_result["CODE"].'/'?>">������� � �������</a></p>

                        </figcaption>   
                    </figure>
                </div>
                <?
                }


                /*

                global $menutree_parent;
                //				echo '<pre>';
                //				print_r($menutree_parent);
                //				echo '</pre>';
                $cpu_link = '/';
                for ($i = 1; $i <= count($menutree_parent); $i++) {if ($i < 4) $cpu_link .= $menutree_parent[$i]['CODE'].'/';}
                //echo $cpu_link;


                $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), Array("IBLOCK_ID"=>"10", "SECTION_ID"=>$current_section_id), false, Array("UF_DESCSHORT"));
                while($ar_result = $db_list->GetNext())
                {
                //echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['CODE'].'<br>';

                ?>
                <div class="b-subsection">

                <h2><a href="<?echo $cpu_link.$ar_result["CODE"].'/'?>"><?echo $ar_result["NAME"]?></a></h2>
                <figure>
                <?if(!empty($ar_result["PICTURE"])):?>
                <?
                $rsFile = CFile::GetByID($ar_result["PICTURE"]);
                $arFile = $rsFile->Fetch();
                ?>
                <a href="<?echo $cpu_link.$ar_result["CODE"].'/'?>"><img src="/upload/<?echo $arFile["SUBDIR"];?>/<?echo $arFile["FILE_NAME"]?>" alt="<?echo $ar_result["NAME"]?>" title="<?echo $ar_result["NAME"]?>" /></a>
                <?endif;?>

                <figcaption>
                <?
                if (!empty($ar_result['UF_DESCSHORT'])) echo '<p>'.$ar_result['UF_DESCSHORT'].'</p>';
                else echo $ar_result['DESCRIPTION'];?>
                <p class="more"><a href="<?echo $cpu_link.$ar_result["CODE"].'/'?>">������� � �������</a></p>

                </figcaption>   
                </figure>
                </div>
                <?
                };  */
            ?>





            <br />
            <br />      
        </section>
        <?endif;
    }
?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>