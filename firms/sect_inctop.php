<?
   if(CModule::IncludeModule("iblock"))
   { 
   ?>

	<?
	if(isset($_REQUEST['SECTION_NAME'])){
	$res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 25, 'CODE' => $_REQUEST['SECTION_NAME'])); 
	$section = $res->Fetch(); 

	$section_id = $section['ID'];
	global $current_section_id;
	$current_section_id = $section_id;
	//echo $section_id.'<br />';
	global $menutree_parent;
	$res = CIBlockSection::GetByID($section_id);
	if($arResult = $res->GetNext()){
	  /*echo '<pre>';
	  print_r($arResult);
	  echo '</pre>';*/

	$dbSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "<=LEFT_BORDER" => $arResult["LEFT_MARGIN"], ">=RIGHT_BORDER" => $arResult["RIGHT_MARGIN"]), false);
	while ($arSect = $dbSect->GetNext()) {$menutree_parent[$arSect["DEPTH_LEVEL"]]["ID"] = $arSect["ID"];
	$menutree_parent[$arSect["DEPTH_LEVEL"]]["CODE"] = $arSect["CODE"];

	}

	$dbSect = CIBlockSection::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "SECTION_ID" => $menutree_parent[1]["ID"], "DEPTH_LEVEL" => 2), false, Array("UF_MENUTITLE"));
	?><div class="equipments-list">
	<?
	$ipc = ceil($dbSect->SelectedRowsCount() / 5);
//	echo $ipc;
	?>
	<?
	unset($menuitems);
	while ($arSect = $dbSect->GetNext()) {
		$menuitems[] = $arSect;
	}

	for ($i = 0; $i < 5; $i++)
	{
	echo '<ul>';
	for ($j = 0; $j < $ipc; $j++){
	$inumb = $i + $j*5;
	if (!empty($menuitems[$inumb])){
	$arSect = $menuitems[$inumb];
	echo '<li>';
	if ($arSect['CODE'] == $menutree_parent[2]["CODE"]) echo '<b>';
	if ($_REQUEST['SECTION_NAME'] != $arSect['CODE']) echo '<a href="/'.$menutree_parent[1]["CODE"].'/'.$arSect["CODE"].'/">';
	if (!empty($arSect["UF_MENUTITLE"])) echo $arSect["UF_MENUTITLE"];
	else echo $arSect["NAME"];
	//echo ' - '.$inumb;
	if ($_REQUEST['SECTION_NAME'] != $arSect['CODE']) echo '</a>';
	if ($arSect['CODE'] == $menutree_parent[2]["CODE"]) echo '</b>';
	echo '</li>';}
	}
	echo '</ul>';
	}
	}
	?>
	</div>
	<?
	}
	
	/*echo '<pre>';
	print_r($menutree_parent);
	echo '</pre>';*/


}
	
	?>

