<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";

	

if ((preg_match("/firms/i", $arResult[1]["LINK"])) AND ($arResult[1]["LINK"] != '/firms/')) {
    //echo "¬хождение найдено.";
	unset($cpu_link);
	$cpu_link = '/';
	for ($i = 1, $itemSize = count($arResult); $i < $itemSize; $i++){
		$tmp_link = str_replace('/firms/', '', $arResult[$i]["LINK"]);
		
		$cpu_link .= $tmp_link;
		$arResult[$i]["LINK"] = $cpu_link;
		
	}
}

	
$strReturn = '<ul class="breadcrumb-navigation" style="margin-bottom: 15px;">';

if (count($arResult) > 1) for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index > 0)
		$strReturn .= '<li><span>&nbsp;/&nbsp;</span></li>';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if(($arResult[$index]["LINK"] <> "") AND (($itemSize - $index) > 1))
		$strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
	else
		$strReturn .= '<li>'.$title.'</li>';
}

$strReturn .= '</ul>';
return $strReturn;
?>
