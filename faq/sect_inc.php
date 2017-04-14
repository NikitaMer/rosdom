<?
if (isset($_REQUEST['ELEMENT_CODE'])){
	$res = CIBlockElement::GetByID($_REQUEST['ELEMENT_CODE']);
	if($ar_res = $res->GetNext())
		if (!empty($ar_res['IBLOCK_SECTION_ID'])) $sec_id = $ar_res['IBLOCK_SECTION_ID'];
		//print_r($ar_res['IBLOCK_SECTION_ID']);
}
//if(isset($_REQUEST['SECTION_CODE'])) $sec_id = $_REQUEST['SECTION_CODE'];


if(isset($sec_id) or isset($_REQUEST['SECTION_CODE'])){
	//echo ':'.$sec_id.':<br>';
	$res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 14, 'CODE' => $_REQUEST['SECTION_CODE'], 'ID' => $sec_id)); 
	$section = $res->Fetch(); 
	unset($section_id);
	$section_id = $section['ID'];
	//echo ':'.$section_id.':<br />';
	
	
	$dbSect = CIBlockSection::GetList(Array("NAME" => "ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$section["IBLOCK_ID"], "<=LEFT_BORDER" => $section["LEFT_MARGIN"], ">=RIGHT_BORDER" => $section["RIGHT_MARGIN"], "DEPTH_LEVEL"=>"1"), false);
	if($res = $dbSect->GetNext()) $parent_id = $res["ID"];
	//if(count($ar_result) != 0) echo '!!!<Br>';
	//echo $parent_id;
	$subsections=CIBlockSection::GetList(Array("NAME" => "ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>"14", "DEPTH_LEVEL"=>"2", "SECTION_ID"=>$parent_id), false, Array('UF_MENUTITLE'));
};




//$dbSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "<=LEFT_BORDER" => $arResult["LEFT_MARGIN"], ">=RIGHT_BORDER" => $arResult["RIGHT_MARGIN"]), false);


$ar_result=CIBlockSection::GetList(Array("NAME" => "ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>"14", "DEPTH_LEVEL"=>"1"), false, Array("UF_MENUTITLE"));
?>
<div class="b-widget b-widget__submenu"> 
				<h2>Разделы:</h2> 
				<div class="description-submenu"> 
	 
	
<ul>
<?
while($res=$ar_result->GetNext()){

echo '<li>';
if ($res["ID"] == $parent_id) echo '<b>';
if (($res["ID"] != $section_id) OR (!empty($_REQUEST['ELEMENT_CODE']))) echo '<a href="/faq/'.$res['CODE'].'/">';
if (!empty($res['UF_MENUTITLE'])): echo $res['UF_MENUTITLE']; else: echo $res["NAME"]; endif;
if (($res["ID"] != $section_id) OR (!empty($_REQUEST['ELEMENT_CODE']))) echo '</a>';
if ($res["ID"] == $parent_id) echo '</b>';
if (($res["ID"] == $parent_id) && (($res['RIGHT_MARGIN'] - $res['LEFT_MARGIN']) > 1)) {
	
	echo '<ul>';
	while($res_sub=$subsections->GetNext()){
		echo '<li>';
		if (($res_sub["ID"] == $section_id) and (isset($_REQUEST['ELEMENT_CODE']))) echo '<b>';
		if (($res_sub["ID"] != $section_id) or (isset($_REQUEST['ELEMENT_CODE']))) echo '<a href="/faq/'.$res['CODE'].'/'.$res_sub['CODE'].'/">';
		if (!empty($res_sub['UF_MENUTITLE'])): echo $res_sub['UF_MENUTITLE']; else: echo $res_sub["NAME"]; endif;
		if (($res_sub["ID"] != $section_id) or (isset($_REQUEST['ELEMENT_CODE']))) echo '</a>';
		if (($res_sub["ID"] == $section_id) and (isset($_REQUEST['ELEMENT_CODE']))) echo '</b>';
		echo '</li>';
	};
	echo '</ul>';
};
echo '</li>';
} 
?>
</ul>
</div> 
	</div>