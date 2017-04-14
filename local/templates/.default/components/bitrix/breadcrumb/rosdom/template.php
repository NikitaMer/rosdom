<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//	echo "<pre>";	print_r($arResult);	echo "</pre>";

//delayed function must return a string
if(empty($arResult))
	return "";

global $APPLICATION;
$dir = $APPLICATION->GetCurDir();
$url = explode('/', $dir);
$i = 0;

foreach($arResult as $key => $val) {

	if($val['TITLE'] != MENU_TEXT && $url[1] != "documents") {
        $arResult[$i++] = $val;
	} else if($url[1] == "documents" && $val['TITLE'] == MENU_TEXT){
        $arResult[$key]["TITLE"] = MENU_FILE;
        $arResult[$key]["LINK"] = "/documents/";
    } else {
        $text = 'Y';
    }

}
if($text == 'Y' && $url[1] != "documents"){
    unset($arResult[count($arResult)-1]);
}

$strReturn = '<ul class="breadcrumb-navigation">';


for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    if($arResult[$index]["LINK"] <> "" &&  $index+1 < $itemSize || $index == 0){
        if($index > 0 && !empty($index))    $strReturn .= '<li><span>&nbsp;/&nbsp;</span></li>';
        $strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
    }
//echo $index."_".$itemSize."<br>";

if($url[1] == "documents"){
    if($index-1 == $itemSize && $arResult[$index]["LINK"] != $dir && $arResult[$index]["LINK"] && $index != 0){
        if($index > 0)    $strReturn .= '<li><span>&nbsp;/&nbsp;</span></li>';
        $strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
    }
} else {
    if($index+1 == $itemSize && $arResult[$index]["LINK"] != $dir && $arResult[$index]["LINK"] && $index != 0){
        if($index > 0)    $strReturn .= '<li><span>&nbsp;/&nbsp;</span></li>';
        $strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
    }
}

}

$strReturn .= '</ul>';
return $strReturn;
?>
