<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");

?><?
function getSections($iblock_id, $root_link, $section_id = 0) {

unset($arFilter);
$arFilter = Array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $section_id, "ACTIVE"=> "Y");


$db_list = CIBlockSection::GetList(Array("LEFT_MARGIN"=>"ASC"), $arFilter, false/*, Array("UF_DATE")*/);
echo '<ul>';
while($ar_result = $db_list->GetNext()){

	echo '<li>';
	echo '<a href="'.$root_link.'/'.$ar_result["CODE"].'/">'.$ar_result["NAME"].'</a>';
	if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1){
		getSections($iblock_id, $root_link.'/'.$ar_result["CODE"], $ar_result["ID"]);
	};
	echo '</li>';
};
echo '</ul>';
};
echo '<h2>Карта сайта</h2>';
$blocks = Array (
Array ("iblock_id" => 25, "root_link" =>'/interior', "root_name" =>'Интерьер помещений', "section_id" =>2084),
Array ("iblock_id" => 25, "root_link" =>'/material', "root_name" =>'Материалы', "section_id" =>2179),
Array ("iblock_id" => 25, "root_link" =>'/equipment', "root_name" =>'Оборудование', "section_id" =>2365),
Array ("iblock_id" => 25, "root_link" =>'/machinery', "root_name" =>'Техника', "section_id" =>2479),
Array ("iblock_id" => 25, "root_link" =>'/service', "root_name" =>'Услуги', "section_id" =>2503),
Array ("iblock_id" => 37, "root_link" =>'/projects', "root_name" =>'Проекты', "section_id" =>0),
Array ("iblock_id" => 9, "root_link" =>'/articles', "root_name" =>'Статьи', "section_id" =>0),
Array ("iblock_id" => 14, "root_link" =>'/faq', "root_name" =>'Вопрос-ответ', "section_id" =>0)
);
foreach ($blocks as $val){
echo '<b><a href="'.$val["root_link"].'/">'.$val["root_name"].'</a></b>';
getSections($val["iblock_id"], $val["root_link"], $val["section_id"]);
};
//getSections(10, '/firms', 0);
include($_SERVER["DOCUMENT_ROOT"]."/sitemap/index_i.php");
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>