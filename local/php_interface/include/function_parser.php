<?   

    if(file_exists('local/php_interface/include/parser_config.php')){
        include('local/php_interface/include/parser_config.php');
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
        if(exif_imagetype($image_url) != false) {

            if($picture_penult && $picture_last){
                $newfile = $_SERVER["DOCUMENT_ROOT"] . '/upload/iblock/photo/' . $picture_penult . $picture_last;
            }

            if(!CFile::MakeFileArray($newfile)) {
                $file_get = file_put_contents($newfile, file_get_contents($image_url));
            }

        } else {
            $newfile = false;
        }

        return $newfile;
    }

    function my_log($string) {  // ���������� ���� � ����
        $log_file_name = $_SERVER['DOCUMENT_ROOT']."/log_parser/my_log";
        $now = date("Y-m-d H:i:s");
        file_put_contents($log_file_name.'_'.date("d-m-Y").'.log', $now . " " . $string . "\r\n", FILE_APPEND);
    }


    /**
    * put your comment there...
    * 
    * @param boolean $manually - ���� ������� �������. �� ��������� - false.
    * @return mixed
    */
    function AddingParceAdd($manually = false) {    
    
        arshow(date("H:i:s"));           

        $file_path = "http://www.catalog-domov.ru/xml/rosdom.xml";
        //$file_path = $_SERVER["DOCUMENT_ROOT"]."/catalog_tmp.xml";

        $simple  = simplexml_load_file($file_path);
        $vars = array();
        $i = 0;
        foreach ($simple->project as $name => $value) {
            $vars[] = get_object_vars($value);   // ����������� ������ � ������
            $i++;
        }
        
        arshow(count($vars));           
       
        CModule::IncludeModule('iblock');
        
        $arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_UNLOADED_THROUGH_PARSER", "NAME", "PROPERTY_IMG_HASH", "PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE");
        $arFilter = Array("IBLOCK_ID" => IBLOCK_ID_PROJECT);

        //�������� ������� ������� �� ��������
        $ar_item_name = array();
        $ar_element = CIBlockElement::GetList(Array("TIMESTAMP_X" => "ASC"), $arFilter, false, Array(), $arSelect);
        while ($element_wrap = $ar_element->GetNext()) {
            if($element_wrap["PROPERTY_UNLOADED_THROUGH_PARSER_VALUE"] == 'Y'){
                $ar_item_name[$element_wrap["NAME"]]["ID"] = $element_wrap["ID"];
                $ar_item_name[$element_wrap["NAME"]]["IMG_HASH"] = $element_wrap["PROPERTY_IMG_HASH_VALUE"];
                $ar_item_name[$element_wrap["NAME"]]["TMP_UNAVAILABLE"] = $element_wrap["PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE_VALUE"];
            }
        }    
        

        foreach($vars as $key => $item_parser){

            //���� ������� ��� � �������� �� �����, �� ��������� ���
            if(!$ar_item_name[$item_parser["prj_name"]]) {
                
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
                $PROP["PRESENCE"] = ($element_room[3] = 1) ? Array("VALUE" => PRESENCE_ID): ''; // ������� �����
                $PROP["POOL"] = ($element_room[4] = 1) ? Array("VALUE" => POOL_ID): '';  // ������� ��������
                $PROP["BILLIARD"] = ($element_room[5] = 1) ? Array("VALUE" => BILLIARD_ID): ''; // ������� ���������
                $PROP["COMPLEX"] = ($element_room[6] = 1) ? Array("VALUE" => COMPLEX_ID): '';   // ������� ��������������                         
                $PROP["PRESENCE_WINTER"] = ($element_room[7] = 1) ? Array("VALUE" => PRESENCE_WINTER_ID): '';   // ������� ������� ����

                if ($element_room[8] == 2) {          // ������� � ��� ������
                    $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
                } else if ($element_room[8] == 1) {
                    $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
                }

                $PROP["PLINTH"] = ($item_parser["plan_0"])? Array("VALUE" => PLINTH): ''; // ������� ���������� �����
                $PROP["ATTIC"] = ($item_parser["plan_m"])? Array("VALUE" => ATTIC): ''; // ������� ��������
                // ���������� ���������� ������
                $floor = 0;
                if ($item_parser["plan_0"]) $floor++;
                if ($item_parser["plan_1"]) $floor++;
                if ($item_parser["plan_2"]) $floor++;
                if ($item_parser["plan_3"]) $floor++;
                if ($item_parser["plan_4"]) $floor++;
                if ($item_parser["plan_m"]) $floor++;

                if($floor == 1){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_1); // ���������
                }
                if($floor == 2){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_2); // ���������
                }
                if($floor == 3){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_3); // ���������
                }
                if($floor == 4){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_4); // ���������
                }   

                if($section_heading == 'K' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_1); // ��� ���������
                } else if($section_heading == 'P' ) { // ������ ���������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_2); // ��� ���������
                } else if($section_heading == 'D' ) { // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_3); // ��� ���������
                } else if($section_heading == 'S' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_4); // ��� ���������
                } else if($section_heading == 'M' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_5); // ��� ���������
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
                    if((ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) >= 224 && ord($word_materials[$key]) <= 255) || (ord($word_materials[$key]) == 34 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || ord($word_materials[$key]) == 10 || (ord($word_materials[$key]) == 32 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || (ord($word_materials[$key]) == 41 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || (ord($word_materials[$key]) == 46 && ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223) || (ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) >= 97 && ord($word_materials[$key]) <= 122)){
                        if((ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) == 34 && ord($word_materials[$key-1]) == 32) || (ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && ord($word_materials[$key]) == 32 && ord($word_materials[$key-1]) >= 224 && ord($word_materials[$key-1]) <= 255)|| (ord($word_materials[$key+1]) >= 192 && ord($word_materials[$key+1]) <= 223 && (ord($word_materials[$key-1]) == 150 || ord($word_materials[$key-1]) == 45 || ord($word_materials[$key-1]) == 151))){}else{
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
                if($section_heading == 'P' ) { // ������ ���������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // ������� ����� �� ���������� � ���������� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // ������� ����� �� ���������� � ���������� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // ������� ����� �� ���������� � ���������� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // ������� ����� �� ���������� � ���������� 400 ���������� ������
                    }
                } else if($section_heading == 'D' ) { // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150;  // ������� ���������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150_250;  // ������� ���������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_250_400;  // ������� ���������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_400;    // ������� ���������� ����� 400 ���������� ������
                    }
                } else if($section_heading == 'K' ) {  // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){ // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150_250;   // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_250_400;    // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                } else if($section_heading == 'S' ) {  // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                } else if($section_heading == 'M' ) {  // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                }
                
                if($floor == 1){
                    $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // ������� ����������� �����
                }
                if($floor == 2){
                    $section_id[] = DRAFT_TWO_STOREY;  // ������� ����������� �����
                }
                if($floor == 3){
                    $section_id[] = PROJECTS_STOREY; // ������� ����������� �����
                }
                if($floor == 4){
                    $section_id[] = DRAFT_FOUR_STOREY;   // ������� �������������� �����
                }
                if($item_parser["plan_0"]){
                    $section_id[] = PROJECTS_OF_HOUSES_WITH; // ������� ����� � ��������� ������
                }
                if($item_parser["plan_m"]){
                    $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // ������� ����� � ���������
                }
                if($item_parser["labels"] == '[61]'){
                    $section_id[] = PROJECTS_TOWNHOUSES;   // ������� ���������� � ������������� �����
                }
                if($item_parser["labels"] == '[62]'){
                    $section_id[] = HOUSES_TWO_FAMILIES;  // ������� ����� �� ��� �����
                }
                if($item_parser["labels"] == '[63]'){
                    $section_id[] = PROJECTS_NARROW;  // ������� ����� �����
                }
                if($item_parser["labels"] == '[60]'){
                    $section_id[] = BATHS_PROJECTS;   // ������� ����
                }
                if($item_parser["labels"] == '[142]'){
                    $section_id[] = MANSIONS_PROJECTS; // ������� ���������
                }
                if($item_parser["labels"] == '[644]'){
                    $section_id[] = GARAGE_PROJECTS;   // ������� �������
                }
                if($item_parser["labels"] == '[143]') {
                    $section_id[] = GARAGE_POROUS_STONE;   // ������� ����� �� ������������� ����� (RAUF, KNAUF)
                }
                if($item_parser["labels"] == '[140]'){
                    $section_id[] = SWIMMING_POOLS_DESIGNS;  // ������� ���������
                }
                if($item_parser["labels"] == '[645]'){
                    $section_id[] = DESIGNS_GAZEBOS; // ������� �������, ������������� �������
                }
                if($item_parser["labels"] == '[124]'){
                    $section_id[] = HOUSES_TURNKEY; // ���� ��� ����
                }
                if($item_parser["labels"] == '[735]'){
                    $section_id[] = PROJECTS_CANADIAN_HOMES; // ������� ��������� �����
                }
                if($item_parser["labels"] == '[736]'){
                    $section_id[] = PROJECTS_ENGLISH_HOUSES; // ������� ���������� �����
                }
                if($item_parser["labels"] == '[737]'){
                    $section_id[] = PROJECTS_MODERN_HOUSES; // ������� ����������� �����
                }
                if($item_parser["labels"] == '[738]'){
                    $section_id[] = CLASSIC_HOUSE_PROJECTS; // ������������ ������� �����
                }
                if($item_parser["labels"] == '[739]'){
                    $section_id[] = EUROPEAN_PROJECTS_HOUSES; // ����������� ������� �����
                }
                if($item_parser["labels"] == '[161]'){
                    $section_id[] = BLOCKED_HOME_4_FLOORS; // ������������� ���� �� 4-� ������
                }
                if($item_parser["labels"] == '[162]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                }
                if($item_parser["labels"] == '[168]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                }
                if($item_parser["labels"] == '[169]'){
                    $section_id[] = HOTELS; // ���������
                }
                if($item_parser["labels"] == '[170]'){
                    $section_id[] = GARAGES_MULTISTORY; // ������ ������������
                }
                if($item_parser["labels"] == '[171]'){
                    $section_id[] = SPORT_CENTRES; // ���������� ������
                }
                if($item_parser["labels"] == '[172]'){
                    $section_id[] = CLINICS; // �����������
                }
                if($item_parser["labels"] == '[173]'){
                    $section_id[] = SHOPPING_CENTERS; // �������-��������������� ������
                }
                if($item_parser["labels"] == '[174]'){
                    $section_id[] = OFFICE_BUILDINGS; // ������� ������
                }
                if($item_parser["labels"] == '[175]'){
                    $section_id[] = WORSHIP_RELIGIOUS_BUILDINGS; // ����������� � ��������� ������
                }
                if($item_parser["labels"] == '[177]'){
                    $section_id[] = OTHER_BUILDINGS; // ������ ������
                }
                
                $el_add = new CIBlockElement;

                $project_section = false;
                
                if(!empty($section_id)){ 
                    $project_section = $section_id;    
                }      
                
                $arLoadProductArray = Array(
                    "IBLOCK_SECTION" => $project_section, 
                    "CODE"           => $xml_name,
                    "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
                    "NAME"           => $item_parser["prj_name"],   
                    "ACTIVE"         => "Y",
                    "PROPERTY_VALUES"=> $PROP, 

                );           

                if ($newfile_perspectiva_big) {
                    $arLoadProductArray["DETAIL_PICTURE"] = CFile::MakeFileArray($newfile_perspectiva_big); // ��������� url ��������
                }
                if ($newfile_perspectiva_small) {
                    $arLoadProductArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($newfile_perspectiva_small); // ��������� url ��������
                }

                $PRODUCT_ID = $el_add->Add($arLoadProductArray);
                
                if($PRODUCT_ID) {        // ������ � ����
                    my_log("������ ����� ����� ".$item_parser["prj_name"]." c ID �".$PRODUCT_ID);         

                    $ar_item_name[$item_parser["prj_name"]] = $PRODUCT_ID;

                    //��������� ��������� ������
                    $arCatFields = array(
                        "ID" => $PRODUCT_ID,
                        "QUANTITY" => 1,
                    );

                    $product_cat = CCatalogProduct::Add($arCatFields);

                    //��������� ����
                    $ar_price_type = array(); // ������ ����� ��� � ����� ���
                    $ar_price_type = array(
                        PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                        PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                        PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                        PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                        PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
                    );     

                    foreach($ar_price_type as $key_type => $price) {

                        $ar_fields_offer_price = array(
                            "PRODUCT_ID"=> $PRODUCT_ID,
                            "CATALOG_GROUP_ID" => $key_type,
                            "PRICE"=> $price,
                            "CURRENCY"=> "RUB",
                        );  

                        CPrice::Add($ar_fields_offer_price);         
                    }

                } else {
                    my_log("������: ".$el_add->LAST_ERROR);
                }



            } else if ($ar_item_name[$item_parser["prj_name"]]) {// ��� ������� ������ � ��������� ��������� ���
                                                       
                // update
                $PROP = array();
                $section_heading = substr($item_parser["prj_name"], -1);

                //���� ��� �������� �� ����� �� ������������� ���� �������� � ���������, �� ����� ��������� ����� ��������
                if($ar_item_name[$item_parser["prj_name"]]["IMG_HASH"] != $item_parser["img_hash"]) {

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

                } 

                $el_uodate = new CIBlockElement;

                $element_room = str_split($item_parser["rooms"], 1);  // ��������� �������� �� �������� ��� ����������� ������������

                $PROP["NUMBER_OF_BEDROOMS"] = $element_room[0];  //  ����� ������
                $PROP["NUMBER_OF_LIVING"] = $element_room[1];   // ����� ����� ������, ��������������� ��� �������, ����� ��������
                $PROP["NUMBER_OF_BATH"] = $element_room[2];    // ����� �/�, ����
                $PROP["PRESENCE"] = ($element_room[3] = 1)? Array("VALUE" => PRESENCE_ID): ''; // ������� �����
                $PROP["POOL"] = ($element_room[4] = 1)? Array("VALUE" => POOL_ID): '';  // ������� ��������
                $PROP["BILLIARD"] = ($element_room[5] = 1)? Array("VALUE" => BILLIARD_ID): ''; // ������� ���������
                $PROP["COMPLEX"] = ($element_room[6] = 1)? Array("VALUE" => COMPLEX_ID): '';   // ������� ��������������
                $PROP["PRESENCE_WINTER"] = ($element_room[7] = 1)? Array("VALUE" => PRESENCE_WINTER_ID): '';   // ������� ������� ����
                if($element_room[8] = 2) {          // ������� � ��� ������
                    $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
                } else if($element_room[8] = 1) {
                    $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
                }

                $PROP["PLINTH"] = ($item_parser["plan_0"])? Array("VALUE" => PLINTH): ''; // ������� ���������� �����
                $PROP["ATTIC"] = ($item_parser["plan_m"])? Array("VALUE" => ATTIC): ''; // ������� ��������
                // ���������� ���������� ������
                $floor = 0;
                if($item_parser["plan_0"]) $floor++;
                if($item_parser["plan_1"]) $floor++;
                if($item_parser["plan_2"]) $floor++;
                if($item_parser["plan_3"]) $floor++;
                if($item_parser["plan_4"]) $floor++;
                if($item_parser["plan_m"]) $floor++;

                $ar_floors = array(
                    1 => FLOORS_1,
                    2 => FLOORS_2,
                    3 => FLOORS_3,
                    4 => FLOORS_4
                );


                $PROP["FLOORS"] = $ar_floors[$floor];


                if($floor == 1){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_1); // ���������
                }

                if($floor == 2){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_2); // ���������
                }

                if($floor == 3){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_3); // ���������
                }

                if($floor == 4){
                    $PROP["FLOORS"] = Array("VALUE" => FLOORS_4); // ���������
                }

                if ($section_heading == 'K' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_1); // ��� ���������
                } else if($section_heading == 'P' ) { // ������ ���������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_2); // ��� ���������
                } else if($section_heading == 'D' ) { // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_3); // ��� ���������
                } else if($section_heading == 'S' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_4); // ��� ���������
                } else if($section_heading == 'M' ) {  // ������ ������
                    $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_5); // ��� ���������
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
                    if((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=224 && ord($word_materials[$key])<=255) || (ord($word_materials[$key])==34 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || ord($word_materials[$key])==10 || (ord($word_materials[$key])==32 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==41 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==46 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=97 && ord($word_materials[$key])<=122)){
                        if((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==34 && ord($word_materials[$key-1])==32) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==32 && ord($word_materials[$key-1])>=224 && ord($word_materials[$key-1])<=255)|| (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && (ord($word_materials[$key-1])==150 || ord($word_materials[$key-1])==45 || ord($word_materials[$key-1])==151))){}else{
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
                // ���������� ���������� ��� ������
                $xml_name = Cutil::translit($item_parser["prj_name"], "ru", $arParams);

                $section_id = array(); // ������������� ������� �� ��������
                if($section_heading == 'P' ) { // ������ ���������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // ������� ����� �� ���������� � ���������� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // ������� ����� �� ���������� � ���������� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // ������� ����� �� ���������� � ���������� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // ������� ����� �� ���������� � ���������� 400 ���������� ������
                    }
                } else if($section_heading == 'D' ) { // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150;  // ������� ���������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_BRICK_150_250;  // ������� ���������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_250_400;  // ������� ���������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_BRICK_400;    // ������� ���������� ����� 400 ���������� ������
                    }
                } else if($section_heading == 'K' ) {  // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){ // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_150_250;   // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_250_400;    // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_WOODEN_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                } else if($section_heading == 'S' ) {  // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_FRAME_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_FRAME_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                } else if($section_heading == 'M' ) {  // ������ ������
                    if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150;  // ������� ��������� ����� 150 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
                    } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
                    }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                        $section_id[] = PROJECTS_MONOLITHIS_400;   // ������� ��������� ����� 400 ���������� ������
                    }
                }
                if($floor == 1){
                    $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // ������� ����������� �����
                }
                if($floor == 2){
                    $section_id[] = DRAFT_TWO_STOREY;  // ������� ����������� �����
                }
                if($floor == 3){
                    $section_id[] = PROJECTS_STOREY; // ������� ����������� �����
                }
                if($floor == 4){
                    $section_id[] = DRAFT_FOUR_STOREY;   // ������� �������������� �����
                }
                if($item_parser["plan_0"]){
                    $section_id[] = PROJECTS_OF_HOUSES_WITH; // ������� ����� � ��������� ������
                }
                if($item_parser["plan_m"]){
                    $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // ������� ����� � ���������
                }
                if($item_parser["labels"] == '[61]'){
                    $section_id[] = PROJECTS_TOWNHOUSES;   // ������� ���������� � ������������� �����
                }
                if($item_parser["labels"] == '[62]'){
                    $section_id[] = HOUSES_TWO_FAMILIES;  // ������� ����� �� ��� �����
                }
                if($item_parser["labels"] == '[63]'){
                    $section_id[] = PROJECTS_NARROW;  // ������� ����� �����
                }
                if($item_parser["labels"] == '[60]'){
                    $section_id[] = BATHS_PROJECTS;   // ������� ����
                }
                if($item_parser["labels"] == '[142]'){
                    $section_id[] = MANSIONS_PROJECTS; // ������� ���������
                }
                if($item_parser["labels"] == '[644]'){
                    $section_id[] = GARAGE_PROJECTS;   // ������� �������
                }
                if($item_parser["labels"] == '[143]') {
                    $section_id[] = GARAGE_POROUS_STONE;   // ������� ����� �� ������������� ����� (RAUF, KNAUF)
                }
                if($item_parser["labels"] == '[140]'){
                    $section_id[] = SWIMMING_POOLS_DESIGNS;  // ������� ���������
                }
                if($item_parser["labels"] == '[645]'){
                    $section_id[] = DESIGNS_GAZEBOS; // ������� �������, ������������� �������
                }
                if($item_parser["labels"] == '[124]'){
                    $section_id[] = HOUSES_TURNKEY; // ���� ��� ����
                }
                if($item_parser["labels"] == '[735]'){
                    $section_id[] = PROJECTS_CANADIAN_HOMES; // ������� ��������� �����
                }
                if($item_parser["labels"] == '[736]'){
                    $section_id[] = PROJECTS_ENGLISH_HOUSES; // ������� ���������� �����
                }
                if($item_parser["labels"] == '[737]'){
                    $section_id[] = PROJECTS_MODERN_HOUSES; // ������� ����������� �����
                }
                if($item_parser["labels"] == '[738]'){
                    $section_id[] = CLASSIC_HOUSE_PROJECTS; // ������������ ������� �����
                }
                if($item_parser["labels"] == '[739]'){
                    $section_id[] = EUROPEAN_PROJECTS_HOUSES; // ����������� ������� �����
                }
                if($item_parser["labels"] == '[161]'){
                    $section_id[] = BLOCKED_HOME_4_FLOORS; // ������������� ���� �� 4-� ������
                }
                if($item_parser["labels"] == '[162]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                }
                if($item_parser["labels"] == '[168]'){
                    $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // ������� ����� ������������ �����
                }
                if($item_parser["labels"] == '[169]'){
                    $section_id[] = HOTELS; // ���������
                }
                if($item_parser["labels"] == '[170]'){
                    $section_id[] = GARAGES_MULTISTORY; // ������ ������������
                }
                if($item_parser["labels"] == '[171]'){
                    $section_id[] = SPORT_CENTRES; // ���������� ������
                }
                if($item_parser["labels"] == '[172]'){
                    $section_id[] = CLINICS; // �����������
                }
                if($item_parser["labels"] == '[173]'){
                    $section_id[] = SHOPPING_CENTERS; // �������-��������������� ������
                }
                if($item_parser["labels"] == '[174]'){
                    $section_id[] = OFFICE_BUILDINGS; // ������� ������
                }
                if($item_parser["labels"] == '[175]'){
                    $section_id[] = WORSHIP_RELIGIOUS_BUILDINGS; // ����������� � ��������� ������
                }
                if($item_parser["labels"] == '[177]'){
                    $section_id[] = OTHER_BUILDINGS; // ������ ������
                }

                $arLoadProductArray = Array(
                    "IBLOCK_SECTION" => $section_id,          // ������� ����� � ����� �������
                );

                if ($newfile_perspectiva_big) {
                    $arLoadProductArray["DETAIL_PICTURE"] = CFile::MakeFileArray($newfile_perspectiva_big); // ��������� url ��������
                }

                if ($newfile_perspectiva_small) {
                    $arLoadProductArray["PREVIEW_PICTURE"] = CFile::MakeFileArray($newfile_perspectiva_small); // ��������� url ��������
                }                     
               
                arshow($PROP);
               
                $update_id = $el_uodate->Update($ar_item_name[$item_parser["prj_name"]]["ID"], $arLoadProductArray);

                foreach($PROP as $code_prop=>$value_prop){
                    if ($value_prop) {
                        $el_uodate->SetPropertyValuesEx($ar_item_name[$item_parser["prj_name"]]["ID"],IBLOCK_ID_PROJECT,array($code_prop => $value_prop)); // ��������� ��������
                    } else {
                        $el_uodate->SetPropertyValuesEx($ar_item_name[$item_parser["prj_name"]]["ID"],IBLOCK_ID_PROJECT,array($code_prop => Array ("VALUE" => array("del" => "Y")))); // ��������� ��������
                    }
                }

                if(!$update_id) {        // ������ � ����
                    my_log("������ ��� ���������� � ������� ".$item_parser["prj_name"]." � ID �".$ar_item_name[$item_parser["prj_name"]]["ID"].": ".$el_uodate->LAST_ERROR);
                } else {
                    my_log("������� ������ ".$item_parser["prj_name"]." � ID �".$ar_item_name[$item_parser["prj_name"]]["ID"]);
                }
                $arCatFields = array(
                    "ID" => $ar_item_name[$item_parser["prj_name"]]["ID"],
                    "VAT_INCLUDED" => "Y", //��� ������ � ���������
                    "QUANTITY" => 1,
                    "WEIGHT" => 100,
                );
                $product_cat = CCatalogProduct::Add($arCatFields);

                $ar_price_type = array(); // ������ ����� ��� � ����� ���
                $ar_price_type = array(
                    PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                    PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                    PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                    PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                    PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
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

                $ELEMENT_ID = $ar_item_name[$item_parser["prj_name"]]["ID"];
                $PROPERTY_CODE = "PROJECT_TEMPORARILY_UNAVAILABLE";  // ��� ��������
                $PROPERTY_VALUE = "Y";  // �������� ��������
                // ������  � ����
                my_log("������ ��� ������������� ".$item_parser["prj_name"]." � ID �".$ar_item_name[$item_parser["prj_name"]]["ID"]);

                // ��������� ����� �������� ��� ������� �������� ������� ��������
                CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
            }
        }
        
        arshow(date("H:i:s"));

        //���� ������ ����������� �� ������� (����� �����), �� ���������� ���� �������
        if (!$manually) {
            return "AddingParceAdd();";
        } else {
            //��� ������ ������� ������� ��������� � ����������
            echo "�������� �������� ���������";
        }
    }
?>