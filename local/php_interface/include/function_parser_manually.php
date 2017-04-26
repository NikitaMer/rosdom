<?
function AddingParceAddManually() {

    $simple  = simplexml_load_file("http://www.catalog-domov.ru/xml/rosdom.xml");
    $vars = array();
    $i = 0;

    foreach ($simple->project as $name => $value) {
        $vars[$i++] = get_object_vars($value);   // преобразуем объект в массив
    }

    global $USER;
    CModule::IncludeModule('iblock');
    $arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_UNLOADED_THROUGH_PARSER", "NAME", "PROPERTY_IMG_HASH", "PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE");
    $arFilter = Array("IBLOCK_ID" => IBLOCK_ID_PROJECT);

    $ar_item_name = array();
    $ar_element = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($element_wrap = $ar_element->GetNext()) {
        if($element_wrap["PROPERTY_UNLOADED_THROUGH_PARSER_VALUE"] == 'Y'){
            $ar_item_name[$element_wrap["NAME"]][] = $element_wrap["ID"];
            $ar_item_name[$element_wrap["NAME"]][] = $element_wrap["PROPERTY_IMG_HASH_VALUE"];
            $ar_item_name[$element_wrap["NAME"]][] = $element_wrap["PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE_VALUE"];
        }
    }

   foreach($vars as $key => $item_parser) {

      // перекодируем свойства через функцию utf8win1251
      if(!$ar_item_name[$item_parser["prj_name"]]) {

        $PROP = array();
        $section_heading = substr($item_parser["prj_name"], -1);

        $newfile_perspectiva_big = AddPicture($item_parser["perspectiva_big"]);
        $newfile_perspectiva_small = AddPicture($item_parser["perspectiva_small"]);

        $newfile_perspectiva_plan_0 = AddPicture($item_parser["plan_0"]);
        $newfile_perspectiva_plan_1 = AddPicture($item_parser["plan_1"]);
        $newfile_perspectiva_plan_2 = AddPicture($item_parser["plan_2"]);
        $newfile_perspectiva_plan_3 = AddPicture($item_parser["plan_3"]);
        $newfile_perspectiva_plan_4 = AddPicture($item_parser["plan_4"]);
        $newfile_perspectiva_plan_m = AddPicture($item_parser["plan_m"]);

        $newfile_perspectiva_fasad_front = AddPicture($item_parser["fasad_front"]);
        $newfile_perspectiva_fasad_left = AddPicture($item_parser["fasad_left"]);
        $newfile_perspectiva_fasad_right = AddPicture($item_parser["fasad_right"]);
        $newfile_perspectiva_fasad_behind = AddPicture($item_parser["fasad_behind"]);

        $element_room = str_split($item_parser["rooms"], 1);  // разбиваем свойство по символам для дальнейшего распредениея

        $PROP["NUMBER_OF_BEDROOMS"] = $element_room[0];  //  Число спален
        $PROP["NUMBER_OF_LIVING"] = $element_room[1];   // Число жилых комнат, переоборудуемых под спальни, кроме гостиных
        $PROP["NUMBER_OF_BATH"] = $element_room[2];    // Число с/у, ванн
        $PROP["PRESENCE"] = ($element_room[3] = 1)? Array("VALUE" => PRESENCE_ID): ''; // Наличие сауны
        $PROP["POOL"] = ($element_room[4] = 1)? Array("VALUE" => POOL_ID): '';  // Наличие бассейна
        $PROP["BILLIARD"] = ($element_room[5] = 1)? Array("VALUE" => BILLIARD_ID): ''; // Наличие биллиарда
        $PROP["COMPLEX"] = ($element_room[6] = 1)? Array("VALUE" => COMPLEX_ID): '';   // Наличие спорткомплекса
        $PROP["PRESENCE_WINTER"] = ($element_room[7] = 1)? Array("VALUE" => PRESENCE_WINTER_ID): '';   // Наличие зимнего сада
        if($element_room[8] = 2) {          // Наличие и тип гаража
            $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
        } else if($element_room[8] = 1) {
            $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
        }

        $PROP["PLINTH"] = ($newfile_perspectiva_plan_0)? Array("VALUE" => PLINTH): ''; // Наличие цокольного этажа
        $PROP["ATTIC"] = ($newfile_perspectiva_plan_m)? Array("VALUE" => ATTIC): ''; // Наличие мансарды
        if($item_parser["plan_1"] && !$item_parser["plan_2"] && !$item_parser["plan_3"] && !$item_parser["plan_4"]){
            $PROP["FLOORS"] = Array("VALUE" => FLOORS_1); // этажность
        }
        if($item_parser["plan_2"] && $item_parser["plan_1"] && !$item_parser["plan_3"] && !$item_parser["plan_4"]){
            $PROP["FLOORS"] = Array("VALUE" => FLOORS_2); // этажность
        }
        if($item_parser["plan_3"] && $item_parser["plan_2"] && $item_parser["plan_1"] && !$item_parser["plan_4"]){
            $PROP["FLOORS"] = Array("VALUE" => FLOORS_3); // этажность
        }
        if($item_parser["plan_4"]){
            $PROP["FLOORS"] = Array("VALUE" => FLOORS_4); // этажность
        } 
       if($section_heading == 'K' ) {  // раздел кирпич
            $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_1); // тип материала
       } else if($section_heading == 'P' ) { // раздел пенобетон
            $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_2); // тип материала
       } else if($section_heading == 'D' ) { // раздел дерево
            $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_3); // тип материала
       } else if($section_heading == 'S' ) {  // раздел каркас
            $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_4); // тип материала
       } else if($section_heading == 'M' ) {  // раздел каркас
            $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_5); // тип материала
       }
        $PROP["NUMBER_CARS"] = $element_room[9];  // Количество машин в гараже
        $PROP["IMG_HASH"] = $item_parser["img_hash"];   // контрольная сумма по картинкам проекта
        $key_word = 0;
        $materials = array();
        $temp_material = utf8win1251($item_parser["materials"]);        
        $word_materials = str_split($temp_material);    
        foreach ($word_materials as $key=>$word){  
            $materials[$key_word] = $materials[$key_word].$word;
            // В $item_parser["materials"] не отображается тег <br/>
            // Разбиение строки на подстроки, как в XML файле, с помощью кода символа Юникод.                 
            if((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=224 && ord($word_materials[$key])<=255) || (ord($word_materials[$key])==34 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || ord($word_materials[$key])==10 || (ord($word_materials[$key])==32 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==41 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==46 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=97 && ord($word_materials[$key])<=122)){                    
                if((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==34 && ord($word_materials[$key-1])==32) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==32 && ord($word_materials[$key-1])>=224 && ord($word_materials[$key-1])<=255)|| (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && (ord($word_materials[$key-1])==150 || ord($word_materials[$key-1])==45 || ord($word_materials[$key-1])==151))){}else{    
                $key_word++;
                }                         
            }         
        }                                                                                          
        foreach($materials as $key=>$material){
            $PROP["MATERIALS"][$key] =  $material;  // свойство "строительные материалы"    
        }
        $PROP["V_GAB"] = $item_parser["v_gab"];  // свойство "габарит дома 1"
        $PROP["H_GAB"] = $item_parser["h_gab"];        // свойство "габарит дома 2"
        $PROP["OB_PL"] = $item_parser["ob_pl"];        // свойство "общая площадь"
        $PROP["JIL_PL"] = $item_parser["jil_pl"];        // свойство "жилая площадь"
        $PROP["UNLOADED_THROUGH_PARSER"] = 'Y';        // свойство "Товар выгружен через парсер"
        $PROP["PLAN_0"] = CFile::MakeFileArray($newfile_perspectiva_plan_0);
        $PROP["PLAN_1"] = CFile::MakeFileArray($newfile_perspectiva_plan_1);
        $PROP["PLAN_2"] = CFile::MakeFileArray($newfile_perspectiva_plan_2);
        $PROP["PLAN_3"] = CFile::MakeFileArray($newfile_perspectiva_plan_3);
        $PROP["PLAN_4"] = CFile::MakeFileArray($newfile_perspectiva_plan_4);
        $PROP["PLAN_M"] = CFile::MakeFileArray($newfile_perspectiva_plan_m);
        $PROP["FASAD_FRONT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_front);
        $PROP["FASAD_LEFT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_left);
        $PROP["FASAD_RIGHT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_right);
        $PROP["FASAD_BEHIND"] = CFile::MakeFileArray($newfile_perspectiva_fasad_behind);


        // Если заполнено имя и не заполнен символьный код
        $arParams = array(
          "max_len" => "100", // обрезаем символьный код до 100 символов
          "change_case" => "L", // приводим к нижнему регистру
          "replace_space" => "-", // меняем пробелы на тире
          "replace_other" => "-", // меняем плохие символы на тире
          "delete_repeat_replace" => "true", // удаляем повторяющиеся тире
          "use_google" => "false", // отключаем использование google
        );
       // генерируем символьный код товара
       $xml_name = Cutil::translit($item_parser["prj_name"], "ru", $arParams);

           $section_id = array(); // распределение товаров по разделам
           if($section_heading == 'P' ) { // раздел пенобетон
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // Проекты домов из пеноблоков и пенобетона 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // Проекты домов из пеноблоков и пенобетона от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // Проекты домов из пеноблоков и пенобетона от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // Проекты домов из пеноблоков и пенобетона 400 квадратных метров
               }
           } else if($section_heading == 'D' ) { // раздел дерево
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_BRICK_150;  // Проекты деревянных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_BRICK_150_250;  // Проекты деревянных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_BRICK_250_400;  // Проекты деревянных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_BRICK_400;    // Проекты деревянных домов 400 квадратных метров
               }
           } else if($section_heading == 'K' ) {  // раздел кирпич
               if($item_parser["ob_pl"] < TOTAL_AREA_1){ // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_150;  // Проекты кирпичных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_150_250;   // Проекты кирпичных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_250_400;    // Проекты кирпичных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_400;   // Проекты кирпичных домов 400 квадратных метров
               }
           } else if($section_heading == 'S' ) {  // раздел каркас
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_FRAME_150;  // Проекты каркасных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_FRAME_150_250;  // Проекты каркасных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_FRAME_250_400;   // Проекты каркасных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_FRAME_400;   // Проекты каркасных домов 400 квадратных метров
               }
           } else if($section_heading == 'M' ) {  // раздел каркас
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_150;  // Проекты каркасных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_150_250;  // Проекты каркасных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_250_400;   // Проекты каркасных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_400;   // Проекты каркасных домов 400 квадратных метров
               }
           }
           if($item_parser["plan_1"] && !$item_parser["plan_2"] && !$item_parser["plan_3"] && !$item_parser["plan_4"]){
                $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // Проекты одноэтажных домов
           }
           if($item_parser["plan_2"] && $item_parser["plan_1"] && !$item_parser["plan_3"] && !$item_parser["plan_4"]){
                $section_id[] = DRAFT_TWO_STOREY;  // Проекты двухэтажных домов
           }
           if($item_parser["plan_3"] && $item_parser["plan_2"] && $item_parser["plan_1"] && !$item_parser["plan_4"]){
                $section_id[] = PROJECTS_STOREY; // Проекты трехэтажных домов
           }
           if($item_parser["plan_4"]){
                $section_id[] = DRAFT_FOUR_STOREY;   // Проекты четырехэтажных домов
           }
           if($item_parser["plan_0"]){
                $section_id[] = PROJECTS_OF_HOUSES_WITH; // Проекты домов с цокольным этажом
           }
           if($item_parser["plan_m"]){
                $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // Проекты домов с мансардой
           }
           if($item_parser["labels"] == '[61]'){
                $section_id[] = PROJECTS_TOWNHOUSES;   // проекты таунхаусов и блокированных домов
           }
           if($item_parser["labels"] == '[62]'){
                $section_id[] = HOUSES_TWO_FAMILIES;  // проекты домов на две семьи
           }
           if($item_parser["labels"] == '[63]'){
                $section_id[] = PROJECTS_NARROW;  // проекты узких домов
           }
           if($item_parser["labels"] == '[60]'){
                $section_id[] = BATHS_PROJECTS;   // проекты бань
           }
           if($item_parser["labels"] == '[142]'){
                $section_id[] = MANSIONS_PROJECTS; // проекты особняков
           }
           if($item_parser["labels"] == '[644]'){
                $section_id[] = GARAGE_PROJECTS;   // проекты гаражей
           }
           if($item_parser["labels"] == '[143]') {
                $section_id[] = GARAGE_POROUS_STONE;   // проекты домов из поризованного камня (RAUF, KNAUF)
           }
           if($item_parser["labels"] == '[140]'){
                $section_id[] = SWIMMING_POOLS_DESIGNS;  // проекты бассейнов
           }
           if($item_parser["labels"] == '[645]'){
                $section_id[] = DESIGNS_GAZEBOS; // Проекты беседок, строительство беседок
           }
           if($item_parser["labels"] == '[124]'){
                $section_id[] = HOUSES_TURNKEY; // Дома под ключ
           }
           if($item_parser["labels"] == '[735]'){
                $section_id[] = PROJECTS_CANADIAN_HOMES; // Проекты канадских домов
           }
           if($item_parser["labels"] == '[736]'){
                $section_id[] = PROJECTS_ENGLISH_HOUSES; // Проекты английских домов
           }
           if($item_parser["labels"] == '[737]'){
                $section_id[] = PROJECTS_MODERN_HOUSES; // Проекты современных домов
           }
           if($item_parser["labels"] == '[738]'){
                $section_id[] = CLASSIC_HOUSE_PROJECTS; // Классические проекты домов
           }
           if($item_parser["labels"] == '[739]'){
                $section_id[] = EUROPEAN_PROJECTS_HOUSES; // Европейские проекты домов
           }
           if($item_parser["labels"] == '[161]'){
                $section_id[] = BLOCKED_HOME_4_FLOORS; // Блокированные дома до 4-х этажей
           }
           if($item_parser["labels"] == '[162]'){
                $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // Проекты жилых многоэтажных домов
           }
           if($item_parser["labels"] == '[168]'){
                $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // Проекты жилых многоэтажных домов
           }
           if($item_parser["labels"] == '[169]'){
                $section_id[] = HOTELS; // Гостиницы
           }
           if($item_parser["labels"] == '[170]'){
                $section_id[] = GARAGES_MULTISTORY; // Гаражи многоэтажные
           }
           if($item_parser["labels"] == '[171]'){
                $section_id[] = SPORT_CENTRES; // Спортивные центры
           }
           if($item_parser["labels"] == '[172]'){
                $section_id[] = CLINICS; // Поликлиники
           }
           if($item_parser["labels"] == '[173]'){
                $section_id[] = SHOPPING_CENTERS; // Торгово-развлекательные центры
           }
           if($item_parser["labels"] == '[174]'){
                $section_id[] = OFFICE_BUILDINGS; // Офисные здания
           }
           if($item_parser["labels"] == '[175]'){
                $section_id[] = WORSHIP_RELIGIOUS_BUILDINGS; // Религиозные и культовые здания
           }
           if($item_parser["labels"] == '[177]'){
                $section_id[] = OTHER_BUILDINGS; // Прочие здания
           }
       $el_add = new CIBlockElement;
       $arLoadProductArray = array();

       if(!empty($section_id)){
            $arLoadProductArray = Array(
              "IBLOCK_SECTION" => $section_id,          // элемент лежит в корне раздела
              "CODE"           => $xml_name,
              "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
              "NAME"           => $item_parser["prj_name"],   // название свойства
              "ACTIVE"         => "Y",
              "PROPERTY_VALUES"=> $PROP,          // активен
              "DETAIL_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_big), // добавляем url картинки
              "PREVIEW_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_small), // добавляем url картинки
              );
       } else {
            $arLoadProductArray = Array(
              "IBLOCK_SECTION" => false,          // элемент лежит в корне раздела
              "CODE"           => $xml_name,
              "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
              "NAME"           => $item_parser["prj_name"],   // название свойства
              "ACTIVE"         => "Y",
              "PROPERTY_VALUES"=> $PROP,          // активен
              "DETAIL_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_big), // добавляем url картинки
              "PREVIEW_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_small), // добавляем url картинки
              );
       }
            $PRODUCT_ID = $el_add->Add($arLoadProductArray);
            if($PRODUCT_ID) {        // запись в логи
              my_log("Создан новый товар ".$item_parser["prj_name"]." c ID №".$PRODUCT_ID);
            } else {
              my_log("Ошибка: ".$el_add->LAST_ERROR);
            }

            $ar_item_name[$item_parser["prj_name"]] = $PRODUCT_ID;

            $arCatFields = array(
              "ID" => $PRODUCT_ID,
              "VAT_INCLUDED" => "Y", //НДС входит в стоимость
              "QUANTITY" => 1,
              "WEIGHT" => 100,
              );
            $product_cat = CCatalogProduct::Add($arCatFields);

            $ar_price_type = array(); // массив типов цен и самих цен
            $ar_price_type = array(
                PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
            );
            foreach($ar_price_type as $key_type => $preice) {

                $ar_fields_offer_price = array(
                    "PRODUCT_ID"=> $PRODUCT_ID,
                    "CATALOG_GROUP_ID" => $key_type,
                    "PRICE"=> $preice,
                    "CURRENCY"=> "RUB",
                );
                $ar_offer_price = CPrice::GetList(array(), array("PRODUCT_ID"  => $PRODUCT_ID, "CATALOG_GROUP_ID" => $key_type));
                if ( $price_offer = $ar_offer_price->Fetch() ) {
                    CPrice::Update( $price_offer["ID"], $ar_fields_offer_price );
                } else {
                    CPrice::Add($ar_fields_offer_price);
                }
            }
        $parser_load[] = $PRODUCT_ID;


      } else if($ar_item_name[$item_parser["prj_name"]]){  // при наличие товара в инфоблоке обновляем кго свойства

          // update
          $PROP = array();
          $section_heading = substr($item_parser["prj_name"], -1);

            if($ar_item_name[$item_parser["prj_name"]][1] != $item_parser["img_hash"]) {

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

            } else {
                $newfile_perspectiva_big = AddPicture($item_parser["perspectiva_big"]);
                $newfile_perspectiva_small = AddPicture($item_parser["perspectiva_small"]);

                $newfile_perspectiva_plan_0 = AddPicture($item_parser["plan_0"]);
                $newfile_perspectiva_plan_1 = AddPicture($item_parser["plan_1"]);
                $newfile_perspectiva_plan_2 = AddPicture($item_parser["plan_2"]);
                $newfile_perspectiva_plan_3 = AddPicture($item_parser["plan_3"]);
                $newfile_perspectiva_plan_4 = AddPicture($item_parser["plan_4"]);
                $newfile_perspectiva_plan_m = AddPicture($item_parser["plan_m"]);

                $newfile_perspectiva_fasad_front = AddPicture($item_parser["fasad_front"]);
                $newfile_perspectiva_fasad_left = AddPicture($item_parser["fasad_left"]);
                $newfile_perspectiva_fasad_right = AddPicture($item_parser["fasad_right"]);
                $newfile_perspectiva_fasad_behind = AddPicture($item_parser["fasad_behind"]);
            }
            $el_uodate = new CIBlockElement;

            $element_room = str_split($item_parser["rooms"], 1);  // разбиваем свойство по символам для дальнейшего распредениея

            $PROP["NUMBER_OF_BEDROOMS"] = $element_room[0];  //  Число спален
            $PROP["NUMBER_OF_LIVING"] = $element_room[1];   // Число жилых комнат, переоборудуемых под спальни, кроме гостиных
            $PROP["NUMBER_OF_BATH"] = $element_room[2];    // Число с/у, ванн
            $PROP["PRESENCE"] = ($element_room[3] = 1)? Array("VALUE" => PRESENCE_ID): ''; // Наличие сауны
            $PROP["POOL"] = ($element_room[4] = 1)? Array("VALUE" => POOL_ID): '';  // Наличие бассейна
            $PROP["BILLIARD"] = ($element_room[5] = 1)? Array("VALUE" => BILLIARD_ID): ''; // Наличие биллиарда
            $PROP["COMPLEX"] = ($element_room[6] = 1)? Array("VALUE" => COMPLEX_ID): '';   // Наличие спорткомплекса
            $PROP["PRESENCE_WINTER"] = ($element_room[7] = 1)? Array("VALUE" => PRESENCE_WINTER_ID): '';   // Наличие зимнего сада
            if($element_room[8] = 2) {          // Наличие и тип гаража
                $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
            } else if($element_room[8] = 1) {
                $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
            }

            $PROP["PLINTH"] = ($item_parser["plan_0"])? Array("VALUE" => PLINTH): ''; // Наличие цокольного этажа
            $PROP["ATTIC"] = ($item_parser["plan_m"])? Array("VALUE" => ATTIC): ''; // Наличие мансарды
            // Определяем количество этажей
            $floor = 0;
            if($item_parser["plan_0"]) $floor++;
            if($item_parser["plan_1"]) $floor++;
            if($item_parser["plan_2"]) $floor++;
            if($item_parser["plan_3"]) $floor++;
            if($item_parser["plan_4"]) $floor++;
            if($item_parser["plan_m"]) $floor++;
            if($floor == 1){
            $PROP["FLOORS"] = Array("VALUE" => FLOORS_1); // этажность
            }
            if($floor == 2){
                $PROP["FLOORS"] = Array("VALUE" => FLOORS_2); // этажность
            }
            if($floor == 3){
                $PROP["FLOORS"] = Array("VALUE" => FLOORS_3); // этажность
            }
            if($floor == 4){
                $PROP["FLOORS"] = Array("VALUE" => FLOORS_4); // этажность
            }
           if($section_heading == 'K' ) {  // раздел кирпич
                $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_1); // тип материала
           } else if($section_heading == 'P' ) { // раздел пенобетон
                $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_2); // тип материала
           } else if($section_heading == 'D' ) { // раздел дерево
                $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_3); // тип материала
           } else if($section_heading == 'S' ) {  // раздел каркас
                $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_4); // тип материала
           } else if($section_heading == 'M' ) {  // раздел каркас
                $PROP["MATERIAL"] = Array("VALUE" => MATERIAL_5); // тип материала
           }
            $PROP["NUMBER_CARS"] = $element_room[9];  // Количество машин в гараже
            $PROP["IMG_HASH"] = $item_parser["img_hash"];   // контрольная сумма по картинкам проекта
            $key_word = 0;
            $materials = array();
            $temp_material = utf8win1251($item_parser["materials"]);
            $word_materials = str_split($temp_material);
            foreach ($word_materials as $key=>$word){
                $materials[$key_word] = $materials[$key_word].$word;
                // В $item_parser["materials"] не отображается тег <br/>
                // Разбиение строки на подстроки, как в XML файле, с помощью кода символа Юникод.
                if((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=224 && ord($word_materials[$key])<=255) || (ord($word_materials[$key])==34 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || ord($word_materials[$key])==10 || (ord($word_materials[$key])==32 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==41 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key])==46 && ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])>=97 && ord($word_materials[$key])<=122)){
                    if((ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==34 && ord($word_materials[$key-1])==32) || (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && ord($word_materials[$key])==32 && ord($word_materials[$key-1])>=224 && ord($word_materials[$key-1])<=255)|| (ord($word_materials[$key+1])>=192 && ord($word_materials[$key+1])<=223 && (ord($word_materials[$key-1])==150 || ord($word_materials[$key-1])==45 || ord($word_materials[$key-1])==151))){}else{
                    $key_word++;
                    }
                }
            }
            foreach($materials as $key=>$material){
                $PROP["MATERIALS"][$key] =  $material;  // свойство "строительные материалы"
            }
            $PROP["V_GAB"] = $item_parser["v_gab"];  // свойство "габарит дома 1"
            $PROP["H_GAB"] = $item_parser["h_gab"];        // свойство "габарит дома 2"
            $PROP["OB_PL"] = $item_parser["ob_pl"];        // свойство "общая площадь"
            $PROP["JIL_PL"] = $item_parser["jil_pl"];        // свойство "жилая площадь"
            $PROP["UNLOADED_THROUGH_PARSER"] = 'Y';        // свойство "Товар выгружен через парсер"
            $PROP["PLAN_0"] = CFile::MakeFileArray($newfile_perspectiva_plan_0);
            $PROP["PLAN_1"] = CFile::MakeFileArray($newfile_perspectiva_plan_1);
            $PROP["PLAN_2"] = CFile::MakeFileArray($newfile_perspectiva_plan_2);
            $PROP["PLAN_3"] = CFile::MakeFileArray($newfile_perspectiva_plan_3);
            $PROP["PLAN_4"] = CFile::MakeFileArray($newfile_perspectiva_plan_4);
            $PROP["PLAN_M"] = CFile::MakeFileArray($newfile_perspectiva_plan_m);
            $PROP["FASAD_FRONT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_front);
            $PROP["FASAD_LEFT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_left);
            $PROP["FASAD_RIGHT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_right);
            $PROP["FASAD_BEHIND"] = CFile::MakeFileArray($newfile_perspectiva_fasad_behind);

           // генерируем символьный код товара
           $xml_name = Cutil::translit($item_parser["prj_name"], "ru", $arParams);

           $section_id = array(); // распределение товаров по разделам
           if($section_heading == 'P' ) { // раздел пенобетон
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // Проекты домов из пеноблоков и пенобетона 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // Проекты домов из пеноблоков и пенобетона от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // Проекты домов из пеноблоков и пенобетона от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // Проекты домов из пеноблоков и пенобетона 400 квадратных метров
               }
           } else if($section_heading == 'D' ) { // раздел дерево
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_BRICK_150;  // Проекты деревянных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_BRICK_150_250;  // Проекты деревянных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_BRICK_250_400;  // Проекты деревянных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_BRICK_400;    // Проекты деревянных домов 400 квадратных метров
               }
           } else if($section_heading == 'K' ) {  // раздел кирпич
               if($item_parser["ob_pl"] < TOTAL_AREA_1){ // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_150;  // Проекты кирпичных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_150_250;   // Проекты кирпичных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_250_400;    // Проекты кирпичных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_WOODEN_400;   // Проекты кирпичных домов 400 квадратных метров
               }
           } else if($section_heading == 'S' ) {  // раздел каркас
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_FRAME_150;  // Проекты каркасных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_FRAME_150_250;  // Проекты каркасных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_FRAME_250_400;   // Проекты каркасных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_FRAME_400;   // Проекты каркасных домов 400 квадратных метров
               }
           } else if($section_heading == 'M' ) {  // раздел каркас
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // площадь дома 150 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_150;  // Проекты каркасных домов 150 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // площадь дома 250 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_150_250;  // Проекты каркасных домов от 150 до 250 квадратных метров
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_250_400;   // Проекты каркасных домов от 250 до 400 квадратных метров
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // площадь дома 400 квадратных метров
                  $section_id[] = PROJECTS_MONOLITHIS_400;   // Проекты каркасных домов 400 квадратных метров
               }
           }
           if($floor == 1){
                $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // Проекты одноэтажных домов
           }
           if($floor == 2){
                $section_id[] = DRAFT_TWO_STOREY;  // Проекты двухэтажных домов
           }
           if($floor == 3){
                $section_id[] = PROJECTS_STOREY; // Проекты трехэтажных домов
           }
           if($floor == 4){
                $section_id[] = DRAFT_FOUR_STOREY;   // Проекты четырехэтажных домов
           }
           if($item_parser["plan_0"]){
                $section_id[] = PROJECTS_OF_HOUSES_WITH; // Проекты домов с цокольным этажом
           }
           if($item_parser["plan_m"]){
                $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // Проекты домов с мансардой
           }
           if($item_parser["labels"] == '[61]'){
                $section_id[] = PROJECTS_TOWNHOUSES;   // проекты таунхаусов и блокированных домов
           }
           if($item_parser["labels"] == '[62]'){
                $section_id[] = HOUSES_TWO_FAMILIES;  // проекты домов на две семьи
           }
           if($item_parser["labels"] == '[63]'){
                $section_id[] = PROJECTS_NARROW;  // проекты узких домов
           }
           if($item_parser["labels"] == '[60]'){
                $section_id[] = BATHS_PROJECTS;   // проекты бань
           }
           if($item_parser["labels"] == '[142]'){
                $section_id[] = MANSIONS_PROJECTS; // проекты особняков
           }
           if($item_parser["labels"] == '[644]'){
                $section_id[] = GARAGE_PROJECTS;   // проекты гаражей
           }
           if($item_parser["labels"] == '[143]') {
                $section_id[] = GARAGE_POROUS_STONE;   // проекты домов из поризованного камня (RAUF, KNAUF)
           }
           if($item_parser["labels"] == '[140]'){
                $section_id[] = SWIMMING_POOLS_DESIGNS;  // проекты бассейнов
           }
           if($item_parser["labels"] == '[645]'){
                $section_id[] = DESIGNS_GAZEBOS; // Проекты беседок, строительство беседок
           }
           if($item_parser["labels"] == '[124]'){
                $section_id[] = HOUSES_TURNKEY; // Дома под ключ
           }
           if($item_parser["labels"] == '[735]'){
                $section_id[] = PROJECTS_CANADIAN_HOMES; // Проекты канадских домов
           }
           if($item_parser["labels"] == '[736]'){
                $section_id[] = PROJECTS_ENGLISH_HOUSES; // Проекты английских домов
           }
           if($item_parser["labels"] == '[737]'){
                $section_id[] = PROJECTS_MODERN_HOUSES; // Проекты современных домов
           }
           if($item_parser["labels"] == '[738]'){
                $section_id[] = CLASSIC_HOUSE_PROJECTS; // Классические проекты домов
           }
           if($item_parser["labels"] == '[739]'){
                $section_id[] = EUROPEAN_PROJECTS_HOUSES; // Европейские проекты домов
           }
           if($item_parser["labels"] == '[161]'){
                $section_id[] = BLOCKED_HOME_4_FLOORS; // Блокированные дома до 4-х этажей
           }
           if($item_parser["labels"] == '[162]'){
                $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // Проекты жилых многоэтажных домов
           }
           if($item_parser["labels"] == '[168]'){
                $section_id[] = PROJECTS_RESIDENTIAL_BUILDINGS; // Проекты жилых многоэтажных домов
           }
           if($item_parser["labels"] == '[169]'){
                $section_id[] = HOTELS; // Гостиницы
           }
           if($item_parser["labels"] == '[170]'){
                $section_id[] = GARAGES_MULTISTORY; // Гаражи многоэтажные
           }
           if($item_parser["labels"] == '[171]'){
                $section_id[] = SPORT_CENTRES; // Спортивные центры
           }
           if($item_parser["labels"] == '[172]'){
                $section_id[] = CLINICS; // Поликлиники
           }
           if($item_parser["labels"] == '[173]'){
                $section_id[] = SHOPPING_CENTERS; // Торгово-развлекательные центры
           }
           if($item_parser["labels"] == '[174]'){
                $section_id[] = OFFICE_BUILDINGS; // Офисные здания
           }
           if($item_parser["labels"] == '[175]'){
                $section_id[] = WORSHIP_RELIGIOUS_BUILDINGS; // Религиозные и культовые здания
           }
           if($item_parser["labels"] == '[177]'){
                $section_id[] = OTHER_BUILDINGS; // Прочие здания
           }
           $arLoadProductArray = array();

            $arLoadProductArray = Array(
              "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
              "IBLOCK_SECTION" => $section_id,          // элемент лежит в корне раздела
              "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
              "ACTIVE"         => "Y",            // активен
              "DETAIL_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_big), // добавляем url картинки
              "PREVIEW_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_small), // добавляем url картинки
              );

            $update_id = $el_uodate->Update($ar_item_name[$item_parser["prj_name"]][0], $arLoadProductArray);

            foreach($PROP as $code_prop=>$value_prop){
                if($value_prop){
                    $el_uodate->SetPropertyValuesEx($ar_item_name[$item_parser["prj_name"]][0],IBLOCK_ID_PROJECT,array($code_prop => $value_prop)); // обновляем свойства
                }else{
                    $el_uodate->SetPropertyValuesEx($ar_item_name[$item_parser["prj_name"]][0],IBLOCK_ID_PROJECT,array($code_prop => Array ("VALUE" => array("del" => "Y")))); // обновляем свойства
                }
            }

            if(!$update_id) {        // запись в логи
              my_log("Ошибка при измененеии в проекте ".$item_parser["prj_name"]." с ID №".$ar_item_name[$item_parser["prj_name"]][0].": ".$el_uodate->LAST_ERROR);
            } else {
              my_log("Изменен прпект ".$item_parser["prj_name"]." с ID №".$ar_item_name[$item_parser["prj_name"]][0]);
            }
            $arCatFields = array(
              "ID" => $ar_item_name[$item_parser["prj_name"]][0],
              "VAT_INCLUDED" => "Y", //НДС входит в стоимость
              "QUANTITY" => 1,
              "WEIGHT" => 100,
              );
            $product_cat = CCatalogProduct::Add($arCatFields);

            $ar_price_type = array(); // массив типов цен и самих цен
            $ar_price_type = array(
                PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
            );
            foreach($ar_price_type as $key_type => $preice) {
                $ar_fields_offer_price = array(
                    "PRODUCT_ID"=> $ar_item_name[$item_parser["prj_name"]][0],
                    "CATALOG_GROUP_ID" => $key_type,
                    "PRICE"=> $preice,
                    "CURRENCY"=> "RUB",
                );
                $ar_offer_price = CPrice::GetList(array(), array("PRODUCT_ID"  => $ar_item_name[$item_parser["prj_name"]][0], "CATALOG_GROUP_ID" => $key_type));
                if ( $price_offer = $ar_offer_price->Fetch() ) {
                    CPrice::Update( $price_offer["ID"], $ar_fields_offer_price );
                } else {
                    CPrice::Add($ar_fields_offer_price);
                }
            }      
      } else {

            $ELEMENT_ID = $ar_item_name[$item_parser["prj_name"]][0];
            $PROPERTY_CODE = "PROJECT_TEMPORARILY_UNAVAILABLE";  // код свойства
            $PROPERTY_VALUE = "Y";  // значение свойства
            // запись  в логи
            my_log("Проект был деактивирован ".$item_parser["prj_name"]." с ID №".$ar_item_name[$item_parser["prj_name"]][0]);

            // Установим новое значение для данного свойства данного элемента
            CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
            $parser_load[] = $ELEMENT_ID;
      }
    }
    if(count($parser_load) > 50){
        echo 'Выгрузка прошла успешно';
    }
}
?>