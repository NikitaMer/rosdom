<?   /*
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
CModule::IncludeModule("iblock");
$root_url = 'http://www.rosdom.ru';
$linkz = array();

function getSectionss($iblock_id, $root_link, $section_id = 0) {
	global $linkz;
	global $root_url;
	//echo '1';
	unset($arFilter);
	$arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id);


	$db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false);

	while($ar_result = $db_list->GetNext()){
		$linkz[] = $root_link.'/'.$ar_result["CODE"].'/';
		if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
			getSectionss($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
		};

	};

};

function getFirms(){
	global $linkz;
	global $root_url;

	$arSelect = Array("ID");
	$arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	  $arFields = $ob->GetFields();
	  $linkz[] = '/firms/firm'.$arFields['ID'].'/';
	}

};

function getArticlesSections($iblock_id, $root_link, $section_id = 0) {
	global $linkz;
	global $root_url;
	//echo '1';
	unset($arFilter);
	$arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id, "ACTIVE" => "Y");


	$db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false);

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

	$arSelect = Array("ID");
	$arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y", "SECTION_ID" => $section_id);
	$res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	  $arFields = $ob->GetFields();
	  $linkz[] = '/articles/article'.$arFields['ID'].'/';
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
		$linkz[] = $root_link.'/'.$ar_result["CODE"].'/';
		getFaq($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
		if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
			getFaqSections($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
		};

	};

};

function getFaq($iblock_id, $root_link, $section_id = 0){
	global $linkz;

	$arSelect = Array("ID");
	$arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y", "SECTION_ID" => $section_id);
	$res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	  $arFields = $ob->GetFields();
	  $linkz[] = '/faq/faq'.$arFields['ID'].'/';
	}
}

function getMagazines(){
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

};

function getCPUSections($iblock_id, $root_link, $section_id = 0, $inc = 0) {
	global $linkz;
	global $root_url;
	global $root;
	//echo '1';
	unset($arFilter);
	$arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id, "ACTIVE" => "Y");

	if (!$inc) $root = $root_link;
	$db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false);

	while($ar_result = $db_list->GetNext()){
		$linkz[] = $root_link.'/'.$ar_result["CODE"].'/';
		getCPUElements($iblock_id, $root, $ar_result["ID"], $root_link);
		if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
			getCPUSections($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"], 1);
		};
	};

};

function getCPUElements($iblock_id, $root_link, $section_id = 0){
	global $linkz;
	// echo $root_link."<br>";
	$arSelect = Array("ID", "CODE");
	$arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y", "SECTION_ID" => $section_id);
	$res = CIBlockElement::GetList(Array('ID' => 'ASC'), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	  $arFields = $ob->GetFields();
	  $linkz[] = $root_link.'/'.substr($root_link, 1).$arFields['ID'].'/';
	}
}

function getExhibitions(){
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

};

$linkz[] = '/';

// товары и услуги
$blocks = Array (
	Array ("iblock_id" => 10, "root_link" =>'/interior', "section_id" =>93),
	Array ("iblock_id" => 10, "root_link" =>'/material', "section_id" =>92),
	Array ("iblock_id" => 10, "root_link" =>'/equipment', "section_id" =>91),
	Array ("iblock_id" => 10, "root_link" =>'/machinery', "section_id" =>94),
	Array ("iblock_id" => 10, "root_link" =>'/service', "section_id" =>95)
);

foreach ($blocks as $val){
	$linkz[] = $val["root_link"].'/';
	getSectionss($val["iblock_id"], $val["root_link"], $val["section_id"]);
};

//фирмы
$linkz[] = '/firms/';
getFirms();

//статьи
$linkz[] = '/articles/';
getArticlesSections(9, '/articles', 0);

//документы
$linkz[] = '/documents/';
getSectionss(15, '/documents', 0);

//faq
$linkz[] = '/faq/';
getFaqSections(14, '/faq', 0);

//журналы
//$linkz[] = '/magazines/';
//getMagazines();

//образование
//$linkz[] = '/education/';
//getCPUSections(17, '/education', 0);

//рынки
//$linkz[] = '/markets/';
//getCPUSections(20, '/markets', 0);

//магазины
//$linkz[] = '/shops/';
//getCPUSections(22, '/shops', 0);

//выставки
//$linkz[] = '/exhibitions/';
//getExhibitions();

//недвижимость
//$linkz[] = '/realty/';
//getCPUSections(19, '/realty', 0);

//echo '<br>total links: '.count($linkz).'<br>';
$data = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach ($linkz as $link) {
	$data .= '<url><loc>'.$root_url.$link.'</loc></url>';
	//echo $link.'<br>';
}
$data .= '</urlset>';

$fp = fopen("../sitemap.xml", "w"); // Открываем файл в режиме записи
$test = fwrite($fp, $data); // Запись в файл
//if ($test) echo 'Данные в файл успешно занесены.';
//else echo 'Ошибка при записи в файл.';
//echo "..";

fclose($fp); //Закрытие файла
*/
?>



<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>