<?

    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/parser_config.php')){
        include($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/parser_config.php');
    }

    function UpdatePicture($image_url) {

        if (empty($image_url)) {
            return false;
        }

        //��������� ���� � �������� ��� ���� �� �������
        $piture = explode('/', $image_url);
        $picture_last = array();
        $picture_penult = array();

        $picture_last = array_pop($piture);
        $picture_penult = array_pop($piture);
        if (exif_imagetype($image_url)) {

            if ($picture_penult && $picture_last){
                $newfile = $_SERVER["DOCUMENT_ROOT"] . '/upload/iblock/photo/' . $picture_penult . $picture_last;
            }

            if (file_exists($newfile)) {
                unlink($newfile);
            }

            file_put_contents($newfile, file_get_contents($image_url));    

        } else {
            $newfile = false;
        }

        return $newfile;
    }

    function my_log($string) {  // ���������� ���� � ����
        $log_file_name = $_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/parser_files/log/";
        $now = date("Y-m-d H:i:s");
        file_put_contents($log_file_name . date("Y-m-d").'.log', $now . " " . $string . "\r\n", FILE_APPEND);
    }

    function delete_hash() {  // ���������� ���� � ����
        $ar_element = CIBlockElement::GetList(Array("TIMESTAMP_X" => "ASC"), Array("IBLOCK_ID" => IBLOCK_ID_PROJECT), false, false, array("ID", "PROPERTY_IMG_HASH"));
        while ($element_wrap = $ar_element->GetNext()) {
            /*$PROPERTY_CODE = "IMG_HASH";  // ��� ��������
            $PROPERTY_VALUE = "";  // �������� ��������
            // ��������� ����� �������� ��� ������� �������� ������� ��������
            CIBlockElement::SetPropertyValuesEx($element_wrap["ID"], false, array($PROPERTY_CODE => $PROPERTY_VALUE)); */
        }
    }

    /**
    * put your comment there...
    *
    * @param boolean $manually - ���� ������� �������. �� ��������� - false.
    * @return mixed
    */
    function ParceCatalog($manually = false) {            

        $file_path = "http://www.catalog-domov.ru/xml/rosdom.xml";
        //$file_path = $_SERVER["DOCUMENT_ROOT"]."/catalog_tmp.xml";

        $data = file_get_contents($file_path);   

        if (empty($data)) {
            my_log("�� ������� �������� ���������� ����� ��� ���� �� ������!");
            return false;     
        }

        //���������� ���������� ����, ����� ����� ���� ����� �� ���� ��������� ������������ ������
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/parser_files/catalog/" . date("Y-m-d H:i:s") . ".xml", $data);

        $simple = new SimpleXMLElement($data);

        $vars = array();
        $i = 0;
        foreach ($simple->project as $name => $value) {
            $vars[] = get_object_vars($value);   // ����������� ������ � ������
            $i++;
        }

        if (empty($vars) || count($vars) <= 0) {
            my_log("� ����� �� ������� �� ������ �������!");    
            return false; 
        }

        CModule::IncludeModule('iblock');

        $arSelect = Array(
            "ID",
            "IBLOCK_ID",
            "PROPERTY_UNLOADED_THROUGH_PARSER",
            "NAME",
            "PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE",
            "PROPERTY_MATERIALS",
            "PROPERTY_V_GAB",
            "PROPERTY_H_GAB",
            "PROPERTY_OB_PL",
            "PROPERTY_JIL_PL",
            "PROPERTY_NUMBER_OF_BEDROOMS",
            "PROPERTY_NUMBER_OF_LIVING",
            "PROPERTY_NUMBER_OF_BATH",
            "PROPERTY_PRESENCE",
            "PROPERTY_POOL",
            "PROPERTY_BILLIARD",
            "PROPERTY_COMPLEX",
            "PROPERTY_PRESENCE_WINTER",
            "PROPERTY_EXISTENS_GARAGE",
            "PROPERTY_NUMBER_CARS",
            "PROPERTY_NUMBER_CARS",
            "PROPERTY_IMG_HASH",
            "PROPERTY_BLOG_POST_ID",
            "PROPERTY_BLOG_COMMENTS_CNT",
            "PROPERTY_MATERIAL",
            "PROPERTY_FLOORS",
            "PROPERTY_PLINTH",
            "PROPERTY_ATTIC",
            "IBLOCK_SECTION_ID"
        );
        $arFilter = Array("IBLOCK_ID" => IBLOCK_ID_PROJECT);

        //�������� ������� ������� �� ��������
        $ar_item_name = array();
        $ar_element = CIBlockElement::GetList(Array("TIMESTAMP_X" => "ASC"), $arFilter, false, false, $arSelect);
        while ($element_wrap = $ar_element->GetNext()) {
            if ($element_wrap["PROPERTY_UNLOADED_THROUGH_PARSER_VALUE"] == 'Y'){
                $ar_item_name[$element_wrap["NAME"]]["ID"] = $element_wrap["ID"];
                $ar_item_name[$element_wrap["NAME"]]["IMG_HASH"] = $element_wrap["PROPERTY_IMG_HASH_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["TMP_UNAVAILABLE"] = $element_wrap["PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["MATERIALS"] = $element_wrap["PROPERTY_MATERIALS_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["V_GAB"] = $element_wrap["PROPERTY_V_GAB_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["H_GAB"] = $element_wrap["PROPERTY_H_GAB_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["OB_PL"] = $element_wrap["PROPERTY_OB_PL_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["JIL_PL"] = $element_wrap["PROPERTY_JIL_PL_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["NUMBER_OF_BEDROOMS"] = $element_wrap["PROPERTY_NUMBER_OF_BEDROOMS_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["NUMBER_OF_LIVING"] = $element_wrap["PROPERTY_NUMBER_OF_LIVING_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["NUMBER_OF_BATH"] = $element_wrap["PROPERTY_NUMBER_OF_BATH_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["PRESENCE"] = $element_wrap["PROPERTY_PRESENCE_ENUM_ID"];
                $ar_item_name[$element_wrap["NAME"]]["POOL"] = $element_wrap["PROPERTY_POOL_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["COMPLEX"] = $element_wrap["PROPERTY_COMPLEX_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["PRESENCE_WINTER"] = $element_wrap["PROPERTY_PRESENCE_WINTER_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["EXISTENS_GARAGE"] = $element_wrap["PROPERTY_EXISTENS_GARAGE_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["NUMBER_CARS"] = $element_wrap["PROPERTY_NUMBER_CARS_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["UNLOADED_THROUGH_PARSER"] = $element_wrap["PROPERTY_UNLOADED_THROUGH_PARSER_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["BLOG_POST_ID"] = $element_wrap["PROPERTY_BLOG_POST_ID_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["BLOG_COMMENTS_CNT"] = $element_wrap["PROPERTY_BLOG_COMMENTS_CNT_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["MATERIAL"] = $element_wrap["PROPERTY_MATERIAL_ENUM_ID"];
                $ar_item_name[$element_wrap["NAME"]]["FLOORS"] = $element_wrap["PROPERTY_FLOORS_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["PLINTH"] = $element_wrap["PROPERTY_PLINTH_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["ATTIC"] = $element_wrap["PROPERTY_ATTIC_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["IBLOCK_SECTION_ID"] = $element_wrap["IBLOCK_SECTION_ID"];
            }
        }

        foreach($vars as $key => $item_parser){
            //���� ������� ��� � �������� �� �����, �� ��������� ���
            if (!$ar_item_name[$item_parser["prj_name"]]) {

                $PROP = array();
                $section_heading = substr($item_parser["prj_name"], -1);

                $newfile_perspectiva_big = UpdatePicture($item_parser["perspectiva_big"]);
                $newfile_perspectiva_small = UpdatePicture($item_parser["perspectiva_small"]);

                $newfile_perspectiva_plan_0 = UpdatePicture($item_parser["plan_0"]);
                $newfile_perspectiva_plan_1 = UpdatePicture($item_parser["plan_1"]);
                $newfile_perspectiva_plan_2 = UpdatePicture($item_parser["plan_2"]);
                $newfile_perspectiva_plan_3 = UpdatePicture($item_parser["plan_3"]);
                $newfile_perspectiva_plan_4 = UpdatePicture($item_parser["plan_4"]);
                $newfile_perspectiva_plan_m = UpdatePicture($item_parser["plan_m"]);

                $newfile_perspectiva_fasad_front = UpdatePicture($item_parser["fasad_front"]);
                $newfile_perspectiva_fasad_left = UpdatePicture($item_parser["fasad_left"]);
                $newfile_perspectiva_fasad_right = UpdatePicture($item_parser["fasad_right"]);
                $newfile_perspectiva_fasad_behind = UpdatePicture($item_parser["fasad_behind"]);

                $element_room = str_split($item_parser["rooms"], 1);  // ��������� �������� �� �������� ��� ����������� ������������

                $PROP["NUMBER_OF_BEDROOMS"] = $element_room[0];  //  ����� ������
                $PROP["NUMBER_OF_LIVING"] = $element_room[1];   // ����� ����� ������, ��������������� ��� �������, ����� ��������
                $PROP["NUMBER_OF_BATH"] = $element_room[2];    // ����� �/�, ����
                $PROP["PRESENCE"] = ($element_room[3] == 1) ? Array("VALUE" => PRESENCE_ID): ''; // ������� �����
                $PROP["POOL"] = ($element_room[4] == 1) ? Array("VALUE" => POOL_ID): '';  // ������� ��������
                $PROP["BILLIARD"] = ($element_room[5] == 1) ? Array("VALUE" => BILLIARD_ID): ''; // ������� ���������
                $PROP["COMPLEX"] = ($element_room[6] == 1) ? Array("VALUE" => COMPLEX_ID): '';   // ������� ��������������
                $PROP["PRESENCE_WINTER"] = ($element_room[7] == 1) ? Array("VALUE" => PRESENCE_WINTER_ID): '';   // ������� ������� ����
                
                $seo_extra = array();
                if ($item_parser["plan_0"]) {   // ������� ���������� �����
                    $PROP["PLINTH"] =  Array("VALUE" => PLINTH);
                    array_push($seo_extra, "� �������");   // ��� ��� ������
                }
                if ($item_parser["plan_m"]) {   // ������� ��������
                    $PROP["ATTIC"] =  Array("VALUE" => ATTIC);
                    array_push($seo_extra, "� ���������"); // ��� ��� ������ 
                }                
                if ($element_room[8] == 2) {          // ������� � ��� ������
                    $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
                    array_push($seo_extra, "� �������");   // ��� ��� ������
                } else if ($element_room[8] == 1) {
                    $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
                    array_push($seo_extra, "� �������");   // ��� ��� ������
                }

                
                // ���������� ���������� ������
                $floor = 0;
                if ($item_parser["plan_0"]) $floor++;
                if ($item_parser["plan_1"]) $floor++;
                if ($item_parser["plan_2"]) $floor++;
                if ($item_parser["plan_3"]) $floor++;
                if ($item_parser["plan_4"]) $floor++;
                if ($item_parser["plan_m"]) $floor++;

                if ($floor == 1){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_1); // ���������
                }
                if ($floor == 2){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_2); // ���������
                }
                if ($floor == 3){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_3); // ���������
                }
                if ($floor == 4){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_4); // ���������
                }

                if ($section_heading == 'K' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_1); // ��� ���������
                    $seo_material = "����������";  // ��� ��� ������
                } else if ($section_heading == 'P' ) { // ������ ���������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_2); // ��� ���������
                    $seo_material = "�������������";// ��� ��� ������
                } else if ($section_heading == 'D' ) { // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_3); // ��� ���������
                    $seo_material = "�����������"; // ��� ��� ������
                } else if ($section_heading == 'S' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_4); // ��� ���������
                    $seo_material = "����������";  // ��� ��� ������
                } else if ($section_heading == 'M' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_5); // ��� ���������
                    $seo_material = "�����������"; // ��� ��� ������
                }


                $PROP["NUMBER_CARS"] = $element_room[9];  // ���������� ����� � ������
                $PROP["IMG_HASH"] = $item_parser["img_hash"];   // ����������� ����� �� ��������� �������
                $key_word = 0;
                $materials = array();
                $temp_material = utf8win1251($item_parser["materials"]);
                $word_materials = str_split($temp_material);
                foreach ($word_materials as $key=>$word){
                    $materials[$key_word] = $materials[$key_word].$word;
                    // � $item_parser["materials"] �� ������������ ��� <br/>
                    // ��������� ������ �� ���������, ��� � XML �����, � ������� ���� ������� ������.
                    if ((ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) >= 224 && ord($word_materials[$key]) <= 255) || (ord($word_materials[$key]) == 34 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || ord($word_materials[$key]) == 10 || (ord($word_materials[$key]) == 32 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || (ord($word_materials[$key]) == 41 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || (ord($word_materials[$key]) == 46 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || (ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) >= 97 && ord($word_materials[$key]) <= 122)){
                        if ((ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) == 34 && ord($word_materials[$key-1]) == 32) || (ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) == 32 && ord($word_materials[$key-1]) >= 224 && ord($word_materials[$key-1]) <= 255)|| (ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && (ord($word_materials[$key-1]) == 150 || ord($word_materials[$key-1]) == 45 || ord($word_materials[$key-1]) == 151))) {

                        } else {
                            $key_word++;
                        }
                    }
                }

                foreach($materials as $key=>$material){
                    $PROP["MATERIALS"][$key] =  $material;  // �������� "������������ ���������"
                }

                $PROP["V_GAB"] = $item_parser["v_gab"];  // �������� "������� ���� 1"
                $PROP["H_GAB"] = $item_parser["h_gab"];        // �������� "������� ���� 2"
                $PROP["OB_PL"] = $item_parser["ob_pl"];        // �������� "����� �������"
                $PROP["JIL_PL"] = $item_parser["jil_pl"];        // �������� "����� �������"
                $PROP["UNLOADED_THROUGH_PARSER"] = 'Y';        // �������� "����� �������� ����� ������"


                if ($newfile_perspectiva_plan_0) {
                    $PROP["PLAN_0"] = CFile::MakeFileArray($newfile_perspectiva_plan_0);
                }
                if ($newfile_perspectiva_plan_1) {
                    $PROP["PLAN_1"] = CFile::MakeFileArray($newfile_perspectiva_plan_1);
                }
                if ($newfile_perspectiva_plan_2) {
                    $PROP["PLAN_2"] = CFile::MakeFileArray($newfile_perspectiva_plan_2);
                }
                if ($newfile_perspectiva_plan_3) {
                    $PROP["PLAN_3"] = CFile::MakeFileArray($newfile_perspectiva_plan_3);
                }
                if ($newfile_perspectiva_plan_4) {
                    $PROP["PLAN_4"] = CFile::MakeFileArray($newfile_perspectiva_plan_4);
                }
                if ($newfile_perspectiva_plan_m) {
                    $PROP["PLAN_M"] = CFile::MakeFileArray($newfile_perspectiva_plan_m);
                }
                if ($newfile_perspectiva_fasad_front) {
                    $PROP["FASAD_FRONT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_front);
                }
                if ($newfile_perspectiva_fasad_left) {
                    $PROP["FASAD_LEFT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_left);
                }
                if ($newfile_perspectiva_fasad_right) {
                    $PROP["FASAD_RIGHT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_right);
                }
                if ($newfile_perspectiva_fasad_behind) {
                    $PROP["FASAD_BEHIND"] = CFile::MakeFileArray($newfile_perspectiva_fasad_behind);
                }

                // ���� ��������� ��� � �� �������� ���������� ���
                $arParams = array(
                    "max_len" => "100", // �������� ���������� ��� �� 100 ��������
                    "change_case" => "L", // �������� � ������� ��������
                    "replace_space" => "-", // ������ ������� �� ����
                    "replace_other" => "-", // ������ ������ ������� �� ����
                    "delete_repeat_replace" => "true", // ������� ������������� ����
                    "use_google" => "false", // ��������� ������������� google
                );

                // ���������� ���������� ��� ������
                //$xml_name = Cutil::translit($item_parser["prj_name"], "ru", $arParams);
                $xml_name = strtolower($item_parser["prj_name"]);

                $section_id = array(); // ������������� ������� �� ��������
                if ($section_heading == 'P' ) { // ������ ���������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // ������� ����� �� ���������� � ���������� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // ������� ����� �� ���������� � ���������� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // ������� ����� �� ���������� � ���������� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // ������� ����� �� ���������� � ���������� 400 ���������� ������
                    }
                } else if ($section_heading == 'D' ) { // ������ ������  
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){ // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150_250;   // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_250_400;    // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_400;   // ������� ��������� ����� 400 ���������� ������
                    }                                                    
                } else if ($section_heading == 'K' ) {  // ������ ������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150;  // ������� ���������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150_250;  // ������� ���������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_250_400;  // ������� ���������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_400;    // ������� ���������� ����� 400 ���������� ������
                    }
                } else if ($section_heading == 'S' ) {  // ������ ������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                } else if ($section_heading == 'M' ) {  // ������ ������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                }

                if ($floor == 1){
                    $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // ������� ����������� �����
                }
                if ($floor == 2){
                    $section_id[] = DRAFT_TWO_STOREY;  // ������� ����������� �����
                }
                if ($floor == 3){
                    $section_id[] = PROJECTS_STOREY; // ������� ����������� �����
                }
                if ($floor == 4){
                    $section_id[] = DRAFT_FOUR_STOREY;   // ������� �������������� �����
                }
                if ($item_parser["plan_0"]){
                    $section_id[] = PROJECTS_OF_HOUSES_WITH; // ������� ����� � ��������� ������
                }
                if ($item_parser["plan_m"]){
                    $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // ������� ����� � ���������
                }
                if ($item_parser["labels"] == '[61]'){
                    $section_id[] = PROJECTS_TOWNHOUSES;   // ������� ���������� � ������������� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[62]'){
                    $section_id[] = HOUSES_TWO_FAMILIES;  // ������� ����� �� ��� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[63]'){
                    $section_id[] = PROJECTS_NARROW;  // ������� ����� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[60]'){
                    $section_id[] = BATHS_PROJECTS;   // ������� ����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[142]'){
                    $section_id[] = MANSIONS_PROJECTS; // ������� ���������
                    $seo_type = "��������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[644]'){
                    $section_id[] = GARAGE_PROJECTS;   // ������� �������
                    $seo_type = "������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[143]') {
                    $section_id[] = GARAGE_POROUS_STONE;   // ������� ����� �� ������������� ����� (RAUF, KNAUF)
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[140]'){
                    $section_id[] = SWIMMING_POOLS_DESIGNS;  // ������� ���������
                    $seo_type = "��������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[645]'){
                    $section_id[] = DESIGNS_GAZEBOS; // ������� �������, ������������� �������
                    $seo_type = "��������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[124]'){
                    $section_id[] = HOUSES_TURNKEY; // ���� ��� ����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[735]'){
                    $section_id[] = PROJECTS_CANADIAN_HOMES; // ������� ��������� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[736]'){
                    $section_id[] = PROJECTS_ENGLISH_HOUSES; // ������� ���������� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[737]'){
                    $section_id[] = PROJECTS_MODERN_HOUSES; // ������� ����������� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[738]'){
                    $section_id[] = CLASSIC_HOUSE_PROJECTS; // ������������ ������� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[739]'){
                    $section_id[] = EUROPEAN_PROJECTS_HOUSES; // ����������� ������� �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[161]'){
                    $section_id[] = BLOCKED_HOME_4_FLOORS; // ������������� ���� �� 4-� ������
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[162]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[168]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                    $seo_type = "����"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[169]'){
                    $section_id[] = HOTELS; // ���������
                    $seo_type = "���������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[170]'){
                    $section_id[] = GARAGES_MULTISTORY; // ������ ������������
                    $seo_type = "������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[171]'){
                    $section_id[] = SPORT_CENTRES; // ���������� ������
                    $seo_type = "����������� ������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[172]'){
                    $section_id[] = CLINICS; // �����������
                    $seo_type = "�����������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[173]'){
                    $section_id[] = SHOPPING_CENTERS; // �������-��������������� ������
                    $seo_type = "�������-���������������� ������";  // ��� ��� ������
                }
                if ($item_parser["labels"] == '[174]'){
                    $section_id[] = OFFICE_BUILDINGS; // ������� ������
                    $seo_type = "�������� ������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[175]'){
                    $section_id[] = WORSHIP_RELIGIOUS_BUILDINGS; // ����������� � ��������� ������
                    $seo_type = "������������ � ���������� ������"; // ��� ��� ������
                }
                if ($item_parser["labels"] == '[177]'){
                    $section_id[] = OTHER_BUILDINGS; // ������ ������
                    $seo_type = "";  // ��� ��� ������
                }

                $el_add = new CIBlockElement;

                $project_section = false;

                if (!empty($section_id)){
                    $project_section = $section_id;
                }

                $arLoadProductArray = Array(
                    "IBLOCK_SECTION" => $project_section,
                    "CODE"           => $xml_name,
                    "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
                    "NAME"           => $item_parser["prj_name"],
                    "ACTIVE"         => "Y",
                    "PROPERTY_VALUES"=> $PROP,
                    "TAGS"           => "������ ".$seo_material." ".$seo_type.", ".$seo_extra[0]." ".$item_parser["prj_name"]."  �������� ".$item_parser["ob_pl"]."  �2",
                    "IPROPERTY_TEMPLATES" => array(
                        "ELEMENT_META_TITLE" => "������ ������ ".$seo_material." ".$seo_type." ".$seo_extra[0]." ".$item_parser["prj_name"]."  �������� ".$item_parser["ob_pl"]." �2  �� Rosdom",
                        "ELEMENT_META_DESCRIPTION" => "������ ������� �� ������� ".$item_parser["prj_name"]." � �������������������� �� ��������� ������������� ".$seo_type." ������ �� �������� + 7 (495) 775-63-93. ������ �������� ������� ������ ".$item_parser["prj_name"]." ".$seo_material." ".$seo_type." �������� ".$item_parser["ob_pl"]." �2",
                        "ELEMENT_META_KEYWORDS" => $item_parser["prj_name"].", ������, ".$seo_type,
                        "ELEMENT_PAGE_TITLE" => "������ ".$seo_material." ".$seo_type.", ".$seo_extra[0]." ".$item_parser["prj_name"]."  �������� ".$item_parser["ob_pl"]."  �2",
                    ),

                );

                if ($newfile_perspectiva_big) {
                    $arLoadProductArray["DETAIL_PICTURE"] = CFile::MakeFileArray($newfile_perspectiva_big); // ��������� url ��������
                }
                if ($newfile_perspectiva_small) {
                    $arLoadProductArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($newfile_perspectiva_small); // ��������� url ��������
                }

                $PRODUCT_ID = $el_add->Add($arLoadProductArray);

                if ($PRODUCT_ID) {        // ������ � ����
                    my_log("������ ����� ������ ".$item_parser["prj_name"]." c ID �".$PRODUCT_ID);

                    $ar_item_name[$item_parser["prj_name"]] = $PRODUCT_ID;

                    //��������� ��������� ������
                    $arCatFields = array(
                        "ID" => $PRODUCT_ID,
                        "QUANTITY" => 1,
                    );

                    $product_cat = CCatalogProduct::Add($arCatFields);

                    $p = array();
                    if($item_parser["price0"] != 0){
                        array_push($p, $item_parser["price0"]);   
                    }
                    if($item_parser["price1"] != 0){
                        array_push($p, $item_parser["price1"]);        
                    }
                    if($item_parser["price2"] != 0){
                        array_push($p, $item_parser["price2"]);        
                    }
                    $min_price = min($p);
                    //��������� ����
                    $ar_price_type = array(); // ������ ����� ��� � ����� ���
                    $ar_price_type = array(
                        PRICE_MAIN => $min_price,
                        PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                        PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                        PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                        PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                        PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
                        PRICE_OF_ARCHITECT_SOLUTIONS  => $item_parser["pricedop29"],
                    );

                    foreach($ar_price_type as $key_type => $price) {

                        $ar_fields_offer_price = array(
                            "PRODUCT_ID" => $PRODUCT_ID,
                            "CATALOG_GROUP_ID" => $key_type,
                            "PRICE" => $price,
                            "CURRENCY" => "RUB",
                        );

                        CPrice::Add($ar_fields_offer_price);
                    }

                } else {
                    my_log("������: ".$el_add->LAST_ERROR);
                }



            } else if ($ar_item_name[$item_parser["prj_name"]]) {// ��� ������� ������ � ��������� ��������� ���     


                // update
                $arLoadProductArray = array();
                $PROP = array();
                $section_heading = substr($item_parser["prj_name"], -1);

                $newfile_perspectiva_big = false;
                $newfile_perspectiva_small = false;
                $newfile_perspectiva_plan_0 = false;
                //���� ��� �������� �� ����� �� ������������� ���� �������� � ���������, �� ����� ��������� ����� ��������
                if ($ar_item_name[$item_parser["prj_name"]]["IMG_HASH"] != $item_parser["img_hash"]) {

                    $PROP["IMG_HASH"] = $item_parser["img_hash"];

                    $newfile_perspectiva_big = UpdatePicture($item_parser["perspectiva_big"]);
                    $newfile_perspectiva_small = UpdatePicture($item_parser["perspectiva_small"]);

                    $newfile_perspectiva_plan_0 = UpdatePicture($item_parser["plan_0"]);
                    $newfile_perspectiva_plan_1 = UpdatePicture($item_parser["plan_1"]);
                    $newfile_perspectiva_plan_2 = UpdatePicture($item_parser["plan_2"]);
                    $newfile_perspectiva_plan_3 = UpdatePicture($item_parser["plan_3"]);
                    $newfile_perspectiva_plan_4 = UpdatePicture($item_parser["plan_4"]);
                    $newfile_perspectiva_plan_m = UpdatePicture($item_parser["plan_m"]);

                    $newfile_perspectiva_fasad_front = UpdatePicture($item_parser["fasad_front"]);
                    $newfile_perspectiva_fasad_left = UpdatePicture($item_parser["fasad_left"]);
                    $newfile_perspectiva_fasad_right = UpdatePicture($item_parser["fasad_right"]);
                    $newfile_perspectiva_fasad_behind = UpdatePicture($item_parser["fasad_behind"]);

                    if ($newfile_perspectiva_plan_0) {
                        $PROP["PLAN_0"] = CFile::MakeFileArray($newfile_perspectiva_plan_0);
                    }
                    if ($newfile_perspectiva_plan_1) {
                        $PROP["PLAN_1"] = CFile::MakeFileArray($newfile_perspectiva_plan_1);
                    }
                    if ($newfile_perspectiva_plan_2) {
                        $PROP["PLAN_2"] = CFile::MakeFileArray($newfile_perspectiva_plan_2);
                    }
                    if ($newfile_perspectiva_plan_3) {
                        $PROP["PLAN_3"] = CFile::MakeFileArray($newfile_perspectiva_plan_3);
                    }
                    if ($newfile_perspectiva_plan_4) {
                        $PROP["PLAN_4"] = CFile::MakeFileArray($newfile_perspectiva_plan_4);
                    }
                    if ($newfile_perspectiva_plan_m) {
                        $PROP["PLAN_M"] = CFile::MakeFileArray($newfile_perspectiva_plan_m);
                    }
                    if ($newfile_perspectiva_fasad_front) {
                        $PROP["FASAD_FRONT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_front);
                    }
                    if ($newfile_perspectiva_fasad_left) {
                        $PROP["FASAD_LEFT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_left);
                    }
                    if ($newfile_perspectiva_fasad_right) {
                        $PROP["FASAD_RIGHT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_right);
                    }
                    if ($newfile_perspectiva_fasad_behind) {
                        $PROP["FASAD_BEHIND"] = CFile::MakeFileArray($newfile_perspectiva_fasad_behind);
                    }
                }

                $el_uodate = new CIBlockElement;

                $element_room = str_split($item_parser["rooms"], 1);  // ��������� �������� �� �������� ��� ����������� ������������

                if($ar_item_name[$item_parser["prj_name"]]["NUMBER_OF_BEDROOMS"] != $element_room[0]){
                    $PROP["NUMBER_OF_BEDROOMS"] = $element_room[0];  //  ����� ������
                }
                if($ar_item_name[$item_parser["prj_name"]]["NUMBER_OF_LIVING"] != $element_room[1]){
                    $PROP["NUMBER_OF_LIVING"] = $element_room[1];   // ����� ����� ������, ��������������� ��� �������, ����� ��������
                }
                if($ar_item_name[$item_parser["prj_name"]]["NUMBER_OF_BATH"] != $element_room[2]){
                    $PROP["NUMBER_OF_BATH"] = $element_room[2];    // ����� �/�, ����
                }
                if($ar_item_name[$item_parser["prj_name"]]["PRESENCE"] != PRESENCE_ID){
                    $PROP["PRESENCE"] = ($element_room[3] == 1)? Array("VALUE" => PRESENCE_ID): ''; // ������� �����
                }
                if($ar_item_name[$item_parser["prj_name"]]["POOL"] != POOL_ID && $element_room[4] > 0){
                    $PROP["POOL"] = ($element_room[4] == 1)? Array("VALUE" => POOL_ID): '';  // ������� ��������
                }
                if($ar_item_name[$item_parser["prj_name"]]["BILLIARD"] != BILLIARD_ID && $element_room[5] > 0){
                    $PROP["BILLIARD"] = ($element_room[5] == 1)? Array("VALUE" => BILLIARD_ID): ''; // ������� ���������
                }
                if($ar_item_name[$item_parser["prj_name"]]["COMPLEX"] != COMPLEX_ID && $element_room[6] > 0){
                    $PROP["COMPLEX"] = ($element_room[6] == 1)? Array("VALUE" => COMPLEX_ID): '';   // ������� ��������������
                }
                if($ar_item_name[$item_parser["prj_name"]]["PRESENCE_WINTER"] != PRESENCE_WINTER_ID && $element_room[7] > 0){
                    $PROP["PRESENCE_WINTER"] = ($element_room[7] == 1)? Array("VALUE" => PRESENCE_WINTER_ID): '';   // ������� ������� ����
                }
                if ($element_room[8] == 2) {          // ������� � ��� ������
                    if($ar_item_name[$item_parser["prj_name"]]["EXISTENS_GARAGE"] != EXISTENS_GARAGE_ID_ONE){
                        $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
                    }
                } else if ($element_room[8] == 1) {
                    if($ar_item_name[$item_parser["prj_name"]]["EXISTENS_GARAGE"] != EXISTENS_GARAGE_ID_TWO){
                        $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
                    }
                }
                if($ar_item_name[$item_parser["prj_name"]]["PLINTH"] != PLINTH && $item_parser["plan_0"]){
                    $PROP["PLINTH"] = ($item_parser["plan_0"])? Array("VALUE" => PLINTH): ''; // ������� ���������� �����
                }
                if($ar_item_name[$item_parser["prj_name"]]["ATTIC"] != ATTIC && $item_parser["plan_m"]){
                    $PROP["ATTIC"] = ($item_parser["plan_m"])? Array("VALUE" => ATTIC): ''; // ������� ��������
                }

                // ���������� ���������� ������
                $floor = 0;
                if ($item_parser["plan_0"]) $floor++;
                if ($item_parser["plan_1"]) $floor++;
                if ($item_parser["plan_2"]) $floor++;
                if ($item_parser["plan_3"]) $floor++;
                if ($item_parser["plan_4"]) $floor++;
                if ($item_parser["plan_m"]) $floor++;

                $ar_floors = array(
                    1 => FLOORS_1,
                    2 => FLOORS_2,
                    3 => FLOORS_3,
                    4 => FLOORS_4
                );            

                //$PROP["FLOORS"] = $ar_floors[$floor];

                if ($floor == 1){
                    if($ar_item_name[$item_parser["prj_name"]]["FLOORS"] != $floor){
                        $PROP["FLOORS"] = Array("VALUE" => FLOORS_1); // ���������
                    }
                }
                if ($floor == 2){
                    if($ar_item_name[$item_parser["prj_name"]]["FLOORS"] != $floor){
                        $PROP["FLOORS"] = Array("VALUE" => FLOORS_2); // ���������
                    }
                }
                if ($floor == 3){
                    if($ar_item_name[$item_parser["prj_name"]]["FLOORS"] != $floor){
                        $PROP["FLOORS"] = Array("VALUE" => FLOORS_3); // ���������
                    }
                }
                if ($floor == 4){
                    if($ar_item_name[$item_parser["prj_name"]]["FLOORS"] != $floor){
                        $PROP["FLOORS"] = Array("VALUE" => FLOORS_4); // ���������
                    }
                }

                if ($section_heading == 'K' ) {  // ������ ������
                    if($ar_item_name[$item_parser["prj_name"]]["MATERIAL"] != MATERIAL_1){
                        $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_1); // ��� ���������
                    }
                } else if ($section_heading == 'P' ) { // ������ ���������
                    if($ar_item_name[$item_parser["prj_name"]]["MATERIAL"] != MATERIAL_2){
                        $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_2); // ��� ���������
                    }
                } else if ($section_heading == 'D' ) { // ������ ������
                    if($ar_item_name[$item_parser["prj_name"]]["MATERIAL"] != MATERIAL_3){
                        $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_3); // ��� ���������
                    }
                } else if ($section_heading == 'S' ) {  // ������ ������
                    if($ar_item_name[$item_parser["prj_name"]]["MATERIAL"] != MATERIAL_4){
                        $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_4); // ��� ���������
                    }
                } else if ($section_heading == 'M' ) {  // ������ ������
                    if($ar_item_name[$item_parser["prj_name"]]["MATERIAL"] != MATERIAL_5){
                        $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_5); // ��� ���������
                    }
                }

                if($ar_item_name[$item_parser["prj_name"]]["NUMBER_CARS"] != $element_room[9]){
                    $PROP["NUMBER_CARS"] = $element_room[9];  // ���������� ����� � ������
                } 


                $key_word = 0;
                $materials = array();
                $temp_material = utf8win1251($item_parser["materials"]);
                $word_materials = str_split($temp_material);
                foreach ($word_materials as $key=>$word){
                    $materials[$key_word] = $materials[$key_word].$word;
                    // � $item_parser["materials"] �� ������������ ��� <br/>
                    // ��������� ������ �� ���������, ��� � XML �����, � ������� ���� ������� ������.
                    if ((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=224 && ord($word_materials[$key])<=255) || (ord($word_materials[$key])==34 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || ord($word_materials[$key])==10 || (ord($word_materials[$key])==32 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==41 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==46 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=97 && ord($word_materials[$key])<=122)){
                        if ((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==34 && ord($word_materials[$key-1])==32) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==32 && ord($word_materials[$key-1])>=224 && ord($word_materials[$key-1])<=255)|| (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && (ord($word_materials[$key-1])==150 || ord($word_materials[$key-1])==45 || ord($word_materials[$key-1])==151))){} else{
                            $key_word++;
                        }
                    }
                }
                foreach($materials as $key=>$material){
                    if($ar_item_name[$item_parser["prj_name"]]["MATERIALS"] != $material){
                        $PROP["MATERIALS"][$key] =  $material;  // �������� "������������ ���������"
                    }
                }
                if($ar_item_name[$item_parser["prj_name"]]["V_GAB"] != $item_parser["v_gab"]){
                    $PROP["V_GAB"] = $item_parser["v_gab"];  // �������� "������� ���� 1"
                }
                if($ar_item_name[$item_parser["prj_name"]]["H_GAB"] != $item_parser["h_gab"]){
                    $PROP["H_GAB"] = $item_parser["h_gab"];        // �������� "������� ���� 2"
                }
                if($ar_item_name[$item_parser["prj_name"]]["OB_PL"] != $item_parser["ob_pl"]){
                    $PROP["OB_PL"] = $item_parser["ob_pl"];        // �������� "����� �������"
                }
                if($ar_item_name[$item_parser["prj_name"]]["JIL_PL"] != $item_parser["jil_pl"]){
                    $PROP["JIL_PL"] = $item_parser["jil_pl"];        // �������� "����� �������"
                }
                if($ar_item_name[$item_parser["prj_name"]]["UNLOADED_THROUGH_PARSER"] != 'Y'){
                    $PROP["UNLOADED_THROUGH_PARSER"] = 'Y';        // �������� "����� �������� ����� ������"
                }


                // ���������� ���������� ��� ������
                $xml_name = Cutil::translit($item_parser["prj_name"], "ru", $arParams);

                $section_id = array(); // ������������� ������� �� ��������
                if ($section_heading == 'P' ) { // ������ ���������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // ������� ����� �� ���������� � ���������� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // ������� ����� �� ���������� � ���������� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // ������� ����� �� ���������� � ���������� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // ������� ����� �� ���������� � ���������� 400 ���������� ������
                    }
                } else if ($section_heading == 'D' ) { // ������ ������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){ // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150_250;   // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_250_400;    // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_400;   // ������� ��������� ����� 400 ���������� ������
                    }     
                } else if ($section_heading == 'K' ) {  // ������ ������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150;  // ������� ���������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150_250;  // ������� ���������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_250_400;  // ������� ���������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_400;    // ������� ���������� ����� 400 ���������� ������
                    }
                } else if ($section_heading == 'S' ) {  // ������ ������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                } else if ($section_heading == 'M' ) {  // ������ ������
                    if ($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if ($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    } else if ($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                }
                if ($floor == 1){
                    $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // ������� ����������� �����
                }
                if ($floor == 2){
                    $section_id[] = DRAFT_TWO_STOREY;  // ������� ����������� �����
                }
                if ($floor == 3){
                    $section_id[] = PROJECTS_STOREY; // ������� ����������� �����
                }
                if ($floor == 4){
                    $section_id[] = DRAFT_FOUR_STOREY;   // ������� �������������� �����
                }
                if ($item_parser["plan_0"]){
                    $section_id[] = PROJECTS_OF_HOUSES_WITH; // ������� ����� � ��������� ������
                }
                if ($item_parser["plan_m"]){
                    $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // ������� ����� � ���������
                }
                if ($item_parser["labels"] == '[61]'){
                    $section_id[] = PROJECTS_TOWNHOUSES;   // ������� ���������� � ������������� �����
                }
                if ($item_parser["labels"] == '[62]'){
                    $section_id[] = HOUSES_TWO_FAMILIES;  // ������� ����� �� ��� �����
                }
                if ($item_parser["labels"] == '[63]'){
                    $section_id[] = PROJECTS_NARROW;  // ������� ����� �����
                }
                if ($item_parser["labels"] == '[60]'){
                    $section_id[] = BATHS_PROJECTS;   // ������� ����
                }
                if ($item_parser["labels"] == '[142]'){
                    $section_id[] = MANSIONS_PROJECTS; // ������� ���������
                }
                if ($item_parser["labels"] == '[644]'){
                    $section_id[] = GARAGE_PROJECTS;   // ������� �������
                }
                if ($item_parser["labels"] == '[143]') {
                    $section_id[] = GARAGE_POROUS_STONE;   // ������� ����� �� ������������� ����� (RAUF, KNAUF)
                }
                if ($item_parser["labels"] == '[140]'){
                    $section_id[] = SWIMMING_POOLS_DESIGNS;  // ������� ���������
                }
                if ($item_parser["labels"] == '[645]'){
                    $section_id[] = DESIGNS_GAZEBOS; // ������� �������, ������������� �������
                }
                if ($item_parser["labels"] == '[124]'){
                    $section_id[] = HOUSES_TURNKEY; // ���� ��� ����
                }
                if ($item_parser["labels"] == '[735]'){
                    $section_id[] = PROJECTS_CANADIAN_HOMES; // ������� ��������� �����
                }
                if ($item_parser["labels"] == '[736]'){
                    $section_id[] = PROJECTS_ENGLISH_HOUSES; // ������� ���������� �����
                }
                if ($item_parser["labels"] == '[737]'){
                    $section_id[] = PROJECTS_MODERN_HOUSES; // ������� ����������� �����
                }
                if ($item_parser["labels"] == '[738]'){
                    $section_id[] = CLASSIC_HOUSE_PROJECTS; // ������������ ������� �����
                }
                if ($item_parser["labels"] == '[739]'){
                    $section_id[] = EUROPEAN_PROJECTS_HOUSES; // ����������� ������� �����
                }
                if ($item_parser["labels"] == '[161]'){
                    $section_id[] = BLOCKED_HOME_4_FLOORS; // ������������� ���� �� 4-� ������
                }
                if ($item_parser["labels"] == '[162]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                }
                if ($item_parser["labels"] == '[168]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                }
                if ($item_parser["labels"] == '[169]'){
                    $section_id[] = HOTELS; // ���������
                }
                if ($item_parser["labels"] == '[170]'){
                    $section_id[] = GARAGES_MULTISTORY; // ������ ������������
                }
                if ($item_parser["labels"] == '[171]'){
                    $section_id[] = SPORT_CENTRES; // ���������� ������
                }
                if ($item_parser["labels"] == '[172]'){
                    $section_id[] = CLINICS; // �����������
                }
                if ($item_parser["labels"] == '[173]'){
                    $section_id[] = SHOPPING_CENTERS; // �������-��������������� ������
                }
                if ($item_parser["labels"] == '[174]'){
                    $section_id[] = OFFICE_BUILDINGS; // ������� ������
                }
                if ($item_parser["labels"] == '[175]'){
                    $section_id[] = WORSHIP_RELIGIOUS_BUILDINGS; // ����������� � ��������� ������
                }
                if ($item_parser["labels"] == '[177]'){
                    $section_id[] = OTHER_BUILDINGS; // ������ ������
                }

                if(!in_array($ar_item_name[$item_parser["prj_name"]]["IBLOCK_SECTION_ID"], $section_id)){
                    $arLoadProductArray = Array(
                        "IBLOCK_SECTION" => $section_id,          // ������� ����� � ����� �������
                    );
                }

                $file_item = '';
                if ($newfile_perspectiva_big) {
                    $file_item = CFile::MakeFileArray($newfile_perspectiva_big);
                    if($file_item["size"] > 0){
                        $arLoadProductArray["DETAIL_PICTURE"] = $file_item; // ��������� url ��������
                    }
                }

                if ($newfile_perspectiva_small) {
                    $file_item = CFile::MakeFileArray($newfile_perspectiva_small);
                    if($file_item["size"] > 0){
                        $arLoadProductArray["PREVIEW_PICTURE"] = $file_item; // ��������� url ��������
                    }
                }

                $update_id = false;

                if(!empty($arLoadProductArray)){     
                    $el_uodate->Update($ar_item_name[$item_parser["prj_name"]]["ID"], $arLoadProductArray);
                    $update_id = true;
                }

                if($ar_item_name[$item_parser["prj_name"]]["TMP_UNAVAILABLE"] == "Y"){
                    $PROP["PROJECT_TEMPORARILY_UNAVAILABLE"] = " ";
                }  

                foreach($PROP as $code_prop => $value_prop){
                    if ($value_prop) {   
                        $update_id = true;
                        $update_id = $el_uodate->SetPropertyValuesEx($ar_item_name[$item_parser["prj_name"]]["ID"], IBLOCK_ID_PROJECT, array($code_prop => $value_prop)); // ��������� ��������
                    } else {   
                        $update_id = true;
                        $update_id = $el_uodate->SetPropertyValuesEx($ar_item_name[$item_parser["prj_name"]]["ID"], IBLOCK_ID_PROJECT, array($code_prop => Array ("VALUE" => array("del" => "Y")))); // ��������� ��������
                    }
                }
                $ar_item_name[$item_parser["prj_name"]]["UPDATED"] = "Y";

                if (!$update_id) {        // ������ � ����
                    my_log("� ������� ��������� �� ���� ".$item_parser["prj_name"]." � ID �".$ar_item_name[$item_parser["prj_name"]]["ID"].": ".$el_uodate->LAST_ERROR);
                } else {
                    my_log("������� ������� ".$item_parser["prj_name"]." � ID �".$ar_item_name[$item_parser["prj_name"]]["ID"]);
                }

                $arCatFields = array(
                    "ID" => $ar_item_name[$item_parser["prj_name"]]["ID"],
                    "VAT_INCLUDED" => "Y", //��� ������ � ���������
                    "QUANTITY" => 1,
                    "WEIGHT" => 100,
                );
                $product_cat = CCatalogProduct::Add($arCatFields);

                $p = array();
                if($item_parser["price0"] != 0){
                    array_push($p, $item_parser["price0"]);   
                }
                if($item_parser["price1"] != 0){
                    array_push($p, $item_parser["price1"]);        
                }
                if($item_parser["price2"] != 0){
                    array_push($p, $item_parser["price2"]);        
                }
                $min_price = min($p);
                //��������� ����
                $ar_price_type = array(); // ������ ����� ��� � ����� ���
                $ar_price_type = array(
                    PRICE_MAIN => $min_price,
                    PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                    PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                    PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                    PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                    PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
                    PRICE_OF_ARCHITECT_SOLUTIONS  => $item_parser["pricedop29"],
                );
                foreach($ar_price_type as $key_type => $preice) {
                    $ar_fields_offer_price = array(
                        "PRODUCT_ID"=> $ar_item_name[$item_parser["prj_name"]]["ID"],
                        "CATALOG_GROUP_ID" => $key_type,
                        "PRICE"=> $preice,
                        "CURRENCY"=> "RUB",
                    );
                    $ar_offer_price = CPrice::GetList(array(), array("PRODUCT_ID"  => $ar_item_name[$item_parser["prj_name"]]["ID"], "CATALOG_GROUP_ID" => $key_type));
                    if ( $price_offer = $ar_offer_price->Fetch() ) {
                        CPrice::Update( $price_offer["ID"], $ar_fields_offer_price );
                    } else {
                        CPrice::Add($ar_fields_offer_price);
                    }
                }
            } else {

            }
        }

        foreach($ar_item_name as $key => $item){
            if(!$item["UPDATED"]){
                $PROPERTY_CODE = "PROJECT_TEMPORARILY_UNAVAILABLE";  // ��� ��������
                $PROPERTY_VALUE = "Y";  // �������� ��������
                // ������  � ����
                my_log("������ ��� ������������� ".$key." � ID �".$item["ID"]);

                // ��������� ����� �������� ��� ������� �������� ������� ��������
                CIBlockElement::SetPropertyValuesEx($item["ID"], false, array($PROPERTY_CODE => $PROPERTY_VALUE));
            }
        }
        //���� ������ ����������� �� ������� (����� �����), �� ���������� ���� �������
        if (!$manually) {
            return "ParceCatalog();";
        } else {
            //��� ������ ������� ������� ��������� � ����������
            echo "�������� �������� ���������";
        }
        my_log("�������� � �������� ���������: ".date("H:i:s"));
    }
?>