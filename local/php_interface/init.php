<?
    define('MENU_TEXT', 'Различные тексты');
    define('MENU_FILE', 'Файлы');
    define('IBLOCK_ID_PROJECT', 37);
    define("FAQ_IBLOCK_ID", 14); 
    define("ARTICLES_IBLOCK_ID", 9); 
    define("DOCUMENT_IBLOCK_ID", 15); 
    define("PROJECTS_IBLOCK_ID", 37); 
    define("FAVORITE_PROJECTS_HL_ID", 1); 

    CModule::IncludeModule('sale'); 
    CModule::IncludeModule('catalog');
    CModule::IncludeModule('iblock');
    CModule::IncludeModule('highloadblock');
    use Bitrix\Highloadblock as HL;
    use Bitrix\Main\Entity;

    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/.config.php')){
        include($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/.config.php');
    }
    
    function logger($data, $file) {
        file_put_contents(
            $file,
            var_export($data, 1)."\n",
            FILE_APPEND
        );
    }     
    
    //Перенос информации о избранных проектах из кук в хайлоад, в том случае если пользователь авторизовался
    AddEventHandler("main", "OnEpilog", "transfer_from_cookie_to_hl");   
    function transfer_from_cookie_to_hl(){   
        global $USER; 
        
        $user_id = $USER->GetID();
        
        $ar_favorite_projects = array();
             
        if ($user_id) {                       
        
            if(!empty($_COOKIE['favorite_projects'])) {    
                
                $ar_favorite_projects = json_decode($_COOKIE['favorite_projects'], true);
                
                $hl_block = HL\HighloadBlockTable::getById(FAVORITE_PROJECTS_HL_ID)->fetch();
                $entity = HL\HighloadBlockTable::compileEntity($hl_block);
                $entity_data_class = $entity->getDataClass();
                                                                   
                $basket_item_filter = array(                                                                       
                    'UF_USER_ID' => $user_id
                );                         
                                                            
                $result = $entity_data_class::getList(array(
                    "select" => array('*'),
                    "filter" => $basket_item_filter, 
                    "order"  => array(),
                    "limit"  => '1',
                ));  
                
                //Если у пользователя уже есть избранные помимо кук, дополним существующие, если нет - создаём
                if($favorite_project = $result->Fetch()) {                                             
                    if(!in_array($product_id, $ar_favorite_projects)){    
                        $data = array("UF_USER_ID" => $user_id, "UF_JSON_PROJECTS" => json_encode($ar_favorite_projects));
                        $result_hl = $entity_data_class::update($favorite_project['ID'], $data);
                        setcookie('favorite_projects', '', time() + 60*60*24*365*5, '/');
                    } else {
                        return false;
                    }       
                } else {                                    
                    $data = array("UF_USER_ID" => $user_id, "UF_JSON_PROJECTS" => json_encode($ar_favorite_projects));   
                    $result_hl = $entity_data_class::add($data);  
                    setcookie('favorite_projects', '', time() + 60*60*24*365*5, '/');
                    return true;
                }
            }
        }       
    }              
    
    //Удаление проекта из избранных                                
    function delete_from_favorites($product_id) {    
        if(CModule::IncludeModule('highloadblock')) {    
            if(!empty($product_id)) {
                
                global $USER; 
                
                $user_id = $USER->GetID();
                $ar_favorite_projects = array(); 
                
                //Проверим авторизован пользователь или нет, для авторизованного удаляем из хайлоад, для неавторизованного из кук
                if ($user_id) {
                    $hl_block = HL\HighloadBlockTable::getById(FAVORITE_PROJECTS_HL_ID)->fetch();
                    $entity = HL\HighloadBlockTable::compileEntity($hl_block);
                    $entity_data_class = $entity->getDataClass();
                                                                       
                    $basket_item_filter = array(                                                                       
                        'UF_USER_ID' => $user_id
                    );                         
                                                                
                    $result = $entity_data_class::getList(array(
                        "select" => array('*'),
                        "filter" => $basket_item_filter, 
                        "order"  => array(),
                        "limit"  => '1',
                    ));      
                                         
                    if($favorite_project = $result->Fetch()) { 
                        //Получим существующий список с избранным 
                        $ar_favorite_projects = json_decode($favorite_project['UF_JSON_PROJECTS'], true);
                        foreach($ar_favorite_projects as $element_id => $project_id) {
                            if($project_id == $product_id) {    
                                unset($ar_favorite_projects[$element_id]); 
                            };                                      
                        }    
                                
                        //Если после удаление элемента список пустой, удаляем, иначе обновляем
                        if(!empty($ar_favorite_projects)){            
                            $data = array("UF_USER_ID" => $user_id, "UF_JSON_PROJECTS" => json_encode($ar_favorite_projects));
                            $result_hl = $entity_data_class::update($favorite_project['ID'], $data); 
                            return true;     
                        } else {
                            $result_hl = $entity_data_class::delete($favorite_project['ID']);
                            return true;  
                        }       
                    } else {                                         
                        return false;
                    }     
                } else {
                    if(!empty($_COOKIE['favorite_projects'])) {
                        $ar_favorite_projects = json_decode($_COOKIE['favorite_projects'], true);
                                                   
                        foreach($ar_favorite_projects as $element_id => $project_id) {
                            if($project_id == $product_id) {  
                                unset($ar_favorite_projects[$element_id]);  
                            };                                      
                        } 
                        
                        //Тут не требуется проверка был ли раньше список или нет, в любом случае если элементов нет мы не удаляем куки а забиваем пустой строкой                                                                          
                        setcookie('favorite_projects', json_encode($ar_favorite_projects), time() + 60*60*24*365*5, '/');
                        return true;  
                    } else {                                                                                        
                        return false;   
                    }   
                } 
            } else {
                return false;
            } 
        } else {
            return false;  
        };  
    }
    
    //Добавление проекта в избранное
    function add_to_favorites($product_id){   
        if(CModule::IncludeModule('highloadblock')) {    
            if(!empty($product_id)) {
                
                global $USER; 
                
                $user_id = $USER->GetID();
                $ar_favorite_projects = array();     
                
                //Если пользователь авторизован, добавим элемент в хайлоад, если нет в куки 
                if ($user_id) {                
                
                    $hl_block = HL\HighloadBlockTable::getById(FAVORITE_PROJECTS_HL_ID)->fetch();
                    $entity = HL\HighloadBlockTable::compileEntity($hl_block);
                    $entity_data_class = $entity->getDataClass();
                                                                       
                    $basket_item_filter = array(                                                                       
                        'UF_USER_ID' => $user_id
                    );                         
                                                                
                    $result = $entity_data_class::getList(array(
                        "select" => array('*'),
                        "filter" => $basket_item_filter, 
                        "order"  => array(),
                        "limit"  => '1',
                    ));  
                    
                    //Если список уже существует, дополним существующий, в ином случае создадим новый элемент HL
                    if($favorite_project = $result->Fetch()) {    
                               
                        $ar_favorite_projects = json_decode($favorite_project['UF_JSON_PROJECTS'], true);  
                        if(!in_array($product_id, $ar_favorite_projects)){    
                         
                            $ar_favorite_projects[] = $product_id;   
                            $data = array("UF_USER_ID" => $user_id, "UF_JSON_PROJECTS" => json_encode($ar_favorite_projects));
                            $result_hl = $entity_data_class::update($favorite_project['ID'], $data);
                        } else {
                            return false;
                        }       
                    } else {              
                        $ar_favorite_projects[] = $product_id;  
                        $data = array("UF_USER_ID" => $user_id, "UF_JSON_PROJECTS" => json_encode($ar_favorite_projects));
                        $result_hl = $entity_data_class::add($data);  
                        return true;
                    }     
                } else {                    
                    //Дополним существующий список или создадим новый
                    if(!empty($_COOKIE['favorite_projects'])) {
                        $ar_favorite_projects = json_decode($_COOKIE['favorite_projects'], true);
                            
                        if(!in_array($product_id, $ar_favorite_projects)){         
                            $ar_favorite_projects[] = $product_id;                                      
                            setcookie('favorite_projects', json_encode($ar_favorite_projects), time() + 60*60*24*365*5, '/'); 
        
                            return true;   
                        } else {       
                            return false;
                        }
                    } else {                                                                         
                        $ar_favorite_projects[] = $product_id;                                      
                        setcookie('favorite_projects', json_encode($ar_favorite_projects), time() + 60*60*24*365*5, '/'); 
        
                        return true;   
                    }   
                } 
            } else {
                return false;
            } 
        } else {
            return false;  
        };    
    }
    
    //Получение списка избранных
    function get_favorites_list(){   
        if(CModule::IncludeModule('highloadblock')) { 
            
            global $USER; 
            
            $user_id = $USER->GetID();
            
            $ar_favorite_projects = array(); 
            
            //Для авторизованного пользователя собираем список из хайлоад блока, для неавторизованного из кук
            if($user_id) {  
                
                $hl_block = HL\HighloadBlockTable::getById(FAVORITE_PROJECTS_HL_ID)->fetch();
                $entity = HL\HighloadBlockTable::compileEntity($hl_block);
                $entity_data_class = $entity->getDataClass();
                                                                   
                $basket_item_filter = array(                                                                       
                    'UF_USER_ID' => $user_id
                );                         
                                                            
                $result = $entity_data_class::getList(array(
                    "select" => array('*'),
                    "filter" => $basket_item_filter, 
                    "order"  => array(),
                    "limit"  => '1',
                ));  
                
                if($favorite_project = $result->Fetch()) {   
                    $ar_favorite_projects = json_decode($favorite_project['UF_JSON_PROJECTS'], true);  
                    if(!empty($ar_favorite_projects)){ 
                        return $ar_favorite_projects;
                    } else {      
                        return false;       
                    }       
                } else {                                        
                    return false;
                }     
            } else {
                if(!empty($_COOKIE['favorite_projects'])) {
                    $ar_favorite_projects = json_decode($_COOKIE['favorite_projects'], true);
                    if(!empty($ar_favorite_projects)){   
                        return $ar_favorite_projects;
                    } else {
                        return false;
                    }
                } else {                                                                                         
                    return false;   
                }   
            } 
        } else {
            return false;  
        };    
    }
                                                  
    AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("MyClass", "OnBeforeIBlockElementAddHandler"));
    AddEventHandler("main", "OnEpilog", "fixCatalogDuplication");
    AddEventHandler("main", "OnProlog", "LowerCase");
    class MyClass                                
    {
        function OnBeforeIBlockElementAddHandler(&$arFields)
        {
            $name = $arFields["NAME"];
            $arParams = array("replace_space"=>"-","replace_other"=>"-");
            $trans = Cutil::translit($name,"ru",$arParams);
            $i = 0;
            do {
                $find = $trans.($i?$i:null);
                $db = CIBlockElement::GetList(array(),array("CODE"=> $find));
                if($res = $db->GetNext()) $i++;
            } while($res);
            $arFields["CODE"] = $find;

            if($arFields["IBLOCK_ID"] == FAQ_IBLOCK_ID) $arFields["PREVIEW_TEXT"]=$arFields["NAME"];

            include($_SERVER["DOCUMENT_ROOT"]."/sitemap/index_i.php");
        }
    }
    function debmes($message, $title = false, $ip = '195.239.55.30', $color = '#008B8B')
    {
        #$ip = false;

        $arIp = array(
            //'46.42.35.238',
            '87.239.29.86',
            //'95.55.158.169',
            '188.255.73.147',
            '195.239.55.30',
            '95.28.11.69'
            #$ip
        );
        if(in_array($_SERVER['REMOTE_ADDR'],$arIp))
        {
            echo '<table border="0" cellpadding="5" cellspacing="0" style="border:1px solid '.$color.';margin:2px;"><tr><td>';
            if (strlen($title)>0)
            {
                echo '<p style="color: '.$color.';font-size:11px;font-family:Verdana;">['.$title.']</p>';
            }

            if (is_array($message) || is_object($message))
            {
                echo '<pre style="color:'.$color.';font-size:11px;font-family:Verdana;">'; print_r($message); echo '</pre>';
            }
            else
            {
                echo '<p style="color:'.$color.';font-size:11px;font-family:Verdana;">'.$message.'</p>';
            }
        }


        echo '</td></tr></table>';
    }

    // Функция сортировки по алфавиту
    function cmp($a, $b){
        if(empty($a["UF_MENUTITLE"]) && empty($b["UF_MENUTITLE"])){
            return strcmp($a["TEXT"], $b["TEXT"]);
        }else{
            return strcmp($a["UF_MENUTITLE"], $b["UF_MENUTITLE"]);
        }
    }      

    function arshow($array, $adminCheck = false){
        global $USER;
        $USER = new Cuser;
        if ($adminCheck) {
            if (!$USER->IsAdmin()) {
                return false;
            }
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    //  Функция для удаления дублей
    function fixCatalogDuplication(){
        global $APPLICATION;
        $cod = array();
        $subdir = explode('/', $GLOBALS["APPLICATION"] -> GetCurPage());
        array_shift($subdir);
        array_pop($subdir);
        if($subdir[0] == 'faq'){
            if(strpos($subdir[1],'faq') === false){
                $cod[0] = '/faq/';
                $obCod = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>array(FAQ_IBLOCK_ID),'GLOBAL_ACTIVE'=>'Y'));
                while($arCod = $obCod->GetNext()){
                    $cod[] = $arCod['SECTION_PAGE_URL'];
                }
                if(!in_array($GLOBALS["APPLICATION"] -> GetCurPage(),$cod)){
                    $APPLICATION->RestartBuffer();
                    CHTTP::SetStatus("404 Not Found");
                    @define("ERROR_404","Y");        
                    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
                    require($_SERVER["DOCUMENT_ROOT"].'/404.php');
                    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
                    exit();
                }
            }
        } elseif ($subdir[0] == 'documents'){
            $obCod = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>array(DOCUMENT_IBLOCK_ID),'GLOBAL_ACTIVE'=>'Y'));
            while($arCod = $obCod->GetNext()){
                if ($arCod["DEPTH_LEVEL"] == 1){
                    $cod_dl_1[] = $arCod['CODE'];
                }
                if ($arCod["DEPTH_LEVEL"] == 2){
                    $cod_dl_2[] = $arCod['CODE'];
                }
                if ($arCod["DEPTH_LEVEL"] == 3){
                    $cod_dl_3[] = $arCod['CODE'];
                }
            }

            if(!in_array($subdir[1], $cod_dl_1) && isset($subdir[1])){
                $APPLICATION->RestartBuffer();
                CHTTP::SetStatus("404 Not Found");
                @define("ERROR_404","Y");
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
                require($_SERVER["DOCUMENT_ROOT"].'/404.php');
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
                exit();
            } elseif (!in_array($subdir[2], $cod_dl_2) && isset($subdir[2])){
                $APPLICATION->RestartBuffer();
                CHTTP::SetStatus("404 Not Found");
                @define("ERROR_404","Y");
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
                require($_SERVER["DOCUMENT_ROOT"].'/404.php');
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
                exit();
            } elseif (!in_array($subdir[3], $cod_dl_3) && isset($subdir[3])){
                $APPLICATION->RestartBuffer();
                CHTTP::SetStatus("404 Not Found");
                @define("ERROR_404","Y");
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
                require($_SERVER["DOCUMENT_ROOT"].'/404.php');
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
                exit();
            }

        } elseif ($subdir[0] == 'equipment' || $subdir[0] == 'material' || $subdir[0] == 'interior'|| $subdir[0] == 'machinery'|| $subdir[0] == 'service'){
            $obCod = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>array(10),'GLOBAL_ACTIVE'=>'Y'));
            $cod[0] = '/equipment/';
            $cod[1] = '/material/';
            $cod[2] = '/interior/';
            $cod[3] = '/machinery/';
            $cod[4] = '/service/';
            while($arCod = $obCod->GetNext()){
                $cod[] = $arCod['SECTION_PAGE_URL'];
            }
            if(!in_array($GLOBALS["APPLICATION"] -> GetCurPage(),$cod)){
                $APPLICATION->RestartBuffer();
                CHTTP::SetStatus("404 Not Found");
                @define("ERROR_404","Y");
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
                require($_SERVER["DOCUMENT_ROOT"].'/404.php');
                require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
                exit();
            }
        } elseif ($subdir[0] == 'articles') {
            if (strpos($subdir[1], 'article') === false){
                $cod[0] = '/articles/';
                $obCod = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=> array(ARTICLES_IBLOCK_ID), 'GLOBAL_ACTIVE'=>'Y'));
                while($arCod = $obCod->GetNext()){
                    $cod[] = $arCod['SECTION_PAGE_URL'];
                }

                if(!in_array($GLOBALS["APPLICATION"] -> GetCurPage(),$cod)){
                    $APPLICATION->RestartBuffer();
                    CHTTP::SetStatus("404 Not Found");
                    @define("ERROR_404","Y");
                    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
                    require($_SERVER["DOCUMENT_ROOT"].'/404.php');
                    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
                    exit();
                }
            } else {
                 //проверка кода элемента   
                 $item_code = str_replace("article", "", $subdir[1]);
                 $check_item = CIBlockElement::getList(array(), array("IBLOCK_ID" => ARTICLES_IBLOCK_ID, "CODE" => $item_code), false, false, array())->Fetch();
                 if (!$check_item["ID"]) {
                    $APPLICATION->RestartBuffer();
                    CHTTP::SetStatus("404 Not Found");
                    @define("ERROR_404","Y");
                    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
                    require($_SERVER["DOCUMENT_ROOT"].'/404.php');
                    require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
                    exit(); 
                }  
            }
        } 
    }
    // Редирект URL на нижний регистр
    function LowerCase() {
        if (strpos($_SERVER['REQUEST_URI'], '?')) {
            $url_without_req_min = strtolower(strstr($_SERVER['REQUEST_URI'], '?', true));
            $url_without_req = strstr($_SERVER['REQUEST_URI'], '?', true);
            $req = strstr($_SERVER['REQUEST_URI'], '?');
            $new_url = $url_without_req_min.$req;
        }else {
            $url_without_req_min = strtolower($_SERVER['REQUEST_URI']);
            $url_without_req = $_SERVER['REQUEST_URI'];
            $new_url = $url_without_req_min;
        }
        if ($url_without_req != $url_without_req_min) {
            LocalRedirect($new_url, true, "301 Moved permanently");
        }
    }



    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/function_parser.php')){
        include($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/include/function_parser.php');
    }


    //Подключение парсера в админке
    AddEventHandler("main", "OnBuildGlobalMenu", "AlexMenus");
    function AlexMenus(&$adminMenu, &$moduleMenu){
        $moduleMenu[] = array(
            "parent_menu" => "global_menu_services",
            "sort"        => 1000,
            "url"         => "/bitrix/admin/parser.php?lang=".LANG,
            "text"        => 'Запуск парсера',
            "title"       => 'Парсер каталога проектов',
            "icon"        => "form_menu_icon",
            "page_icon"   => "form_page_icon",
            "items_id"    => "menu",
            "items"       => array()
        );
    }  