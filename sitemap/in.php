<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<meta http-equiv="cache-control" content="no-cache">
<?

$root_url = 'http://www.rosdom.ru';
$linkz = array();

function getSections($iblock_id, $root_link, $section_id = 0) {
    global $linkz;
    global $root_url;
    //echo '1';
    unset($arFilter);
    $arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id);


    $db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false/*, Array("UF_DATE")*/);

    while($ar_result = $db_list->GetNext()){
        $linkz[] = $root_link.'/'.$ar_result["CODE"].'/';
        if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
            getSections($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
        };

    };

};


function getArticlesSections($iblock_id, $root_link, $section_id = 0) {
    global $linkz;
    global $root_url;
    //echo '1';
    unset($arFilter);
    $arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id, "ACTIVE" => "Y");


    $db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false/*, Array("UF_DATE")*/);

    while($ar_result = $db_list->GetNext()){
        $linkz[] = $root_link.'/'.$ar_result["CODE"].'/';
        getArticles($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
        if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){

            getArticlesSections($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
        };

    };

};

function getArticles($iblock_id, $root_link, $section_id = 0){
    global $linkz;

    $arSelect = Array("ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y", "SECTION_ID" => $section_id);
    $res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
      $arFields = $ob->GetFields();
      $linkz[] = '/articles/article'.$arFields['CODE'].'/';
    }
}

function getFaqSections($iblock_id, $root_link, $section_id = 0) {
    global $linkz;
    global $root_url;
    //echo '1';
    unset($arFilter);
    $arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id, "ACTIVE" => "Y");


    $db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false);

    while($ar_result = $db_list->GetNext()){
        $code = ($ar_result["CODE"])? $ar_result["CODE"].'/':'';
        $linkz[] = $root_link.'/'.$code;

        getFaq($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
        if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
            getFaqSections($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
        };

    };

};

/*function getFirms($iblock_id, $root_link, $section_id = 0){
    unset($arFilter);
    $arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id, "ACTIVE" => "Y");

    $db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false);

    while($ar_result = $db_list->GetNext()){
         $linkz[] = $root_link.'/'.$ar_result["CODE"].'/';
        getFaq($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
        if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
            getFaqSections($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
        };
    };

};  */

function getFaq($iblock_id, $root_link, $section_id = 0){
    global $linkz;

    $arSelect = Array("ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y", "SECTION_ID" => $section_id);
    $res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
      $arFields = $ob->GetFields();
      $linkz[] = '/faq/faq'.$arFields['CODE'].'/';
    }
}

/*function getMagazines(){
    global $linkz;
    global $root_url;

    $arSelect = Array("ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
      $arFields = $ob->GetFields();
      $linkz[] = '/magazines/'.$arFields['CODE'].'/';
    }

};   */

function getCPUSections($iblock_id, $root_link, $section_id = 0) {
    global $linkz;
    global $root_url;
    //echo '1';
    unset($arFilter);
    $arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id, "ACTIVE" => "Y");


    $db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false/*, Array("UF_DATE")*/);

    while($ar_result = $db_list->GetNext()){
        $linkz[] = $ar_result["SECTION_PAGE_URL"];
        getCPUElements($iblock_id, $ar_result["SECTION_PAGE_URL"], $ar_result["ID"]);
        if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
            getCPUSections($iblock_id, $ar_result["SECTION_PAGE_URL"], $ar_result["ID"]);
        };

    };
};

function getCPUElements($iblock_id, $root_link, $section_id = 0){
    global $linkz;

    $arSelect = Array("ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y", "SECTION_ID" => $section_id);
    $res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
      $arFields = $ob->GetFields();
      $linkz[] = $root_link.'/'.$arFields['CODE'].'/';
    }
}

/*function getExhibitions(){
    global $linkz;
    global $root_url;

    $arSelect = Array("ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>23, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
      $arFields = $ob->GetFields();
      $linkz[] = '/exhibitions/'.$arFields['CODE'].'/';
    }

};       */

$linkz[] = '/';

// товары и услуги
$blocks = Array (
    Array ("iblock_id" => 10, "root_link" =>'/interior', "section_id" =>93),
    Array ("iblock_id" => 10, "root_link" =>'/material', "section_id" =>92),
    Array ("iblock_id" => 10, "root_link" =>'/equipment', "section_id" =>91),
    Array ("iblock_id" => 10, "root_link" =>'/machinery', "section_id" =>94),
    Array ("iblock_id" => 10, "root_link" =>'/service', "section_id" =>95)/*,
    Array ("iblock_id" => 9, "root_link" =>'/articles', "section_id" =>0),
    Array ("iblock_id" => 14, "root_link" =>'/faq', "section_id" =>0)*/
);

foreach ($blocks as $val){
    $linkz[] = $val["root_link"].'/';
    getSections($val["iblock_id"], $val["root_link"], $val["section_id"]);
};

//статьи
$linkz[] = '/articles';
getArticlesSections(9, '/articles', 0);

//faq
//$linkz[] = '/faq';
//getFaqSections(14, '/faq', 0);

//Проекты
//$linkz[] = '/projects';
//getCPUSections(IBLOCK_ID_PROJECT, '/projects', 0);

$ar_xml = 0;
$data = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach ($linkz as $link) {
    $priority = explode('/', $link);
    if(count($priority) <= 3){
        $t_l = $root_url.preg_replace("#/$#", "", $link);
     $data .=
        '<url>
            <loc>'.$root_url.preg_replace("#/$#", "", $link).'/</loc>
            <priority>0.5</priority>
        </url>';
        $ar_xml += 1;
    } else if($priority[1] == ''){
        $t_l = $root_url.$link;
        $data .=
        '<url>
            <loc>'.$root_url.$link.'</loc>
            <priority>1.0</priority>
        </url>';
        $ar_xml += 1;
    } else if(count($priority) > 3 && $priority[1] == 'projects'){
        array_pop($priority);
        $mass = array_pop($priority);
        if(!in_array($mass, $ar_items)){
            if(mb_strlen($mass) > 9){
                $t_l = $root_url.$link;
                $data .=
                '<url>
                    <loc>'.$root_url.$link.'</loc>
                    <priority>0.9</priority>
                </url>';
            } else {
                $t_l = $root_url.'/'.$priority[1].'/'.$mass.'/';
                $data .=
                '<url>
                    <loc>'.$root_url.'/'.$priority[1].'/'.$mass.'/'.'</loc>
                    <priority>0.8</priority>
                </url>';
            }
            $ar_xml += 1;
        }

        $ar_items[] = $mass;
    } else {
        $t_l = $root_url.$link;
        $data .=
        '<url>
            <loc>'.$root_url.$link.'</loc>
            <priority>0.5</priority>
        </url>';
        $ar_xml += 1;
    }
    $check_url = get_headers($t_l);
    if (strpos($check_url[0],'200')) {}
    else echo $t_l." - "."false";
    
}
$data .= '</urlset>';
echo '<br>total links: '.$ar_xml.'<br>';
$fp = fopen("../sitemap.xml", "w"); // Открываем файл в режиме записи
$test = fwrite($fp, $data); // Запись в файл
if ($test) echo 'Данные в файл успешно занесены.';
else echo 'Ошибка при записи в файл.';


fclose($fp); //Закрытие файла
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>