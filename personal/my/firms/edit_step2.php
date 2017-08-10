<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<h1>Шаг 2. Привязка к фирме.
</h1>
<br /> Выберите, в каких разделах Вы хотели бы видеть свою фирму. 
<br /> Чтобы выбрать, отметьте не более 5 разделов, удерживая кнопку CTRL.
<br />
<br />
<?
global $USER;
CModule::IncludeModule('main');
CModule::IncludeModule('iblock');
//	 echo "<pre>1"; print_r($_REQUEST); echo "!</pre>";
// echo "<pre>2"; print_r($_POST); echo "!</pre>";
//	 echo "<pre>3"; print_r($_GET); echo "!</pre>";

$err = array();

$edit =  htmlspecialcharsbx($_REQUEST['edit']);
$my_firm =  htmlspecialcharsbx($_REQUEST['my_firm']);
$elementID =  htmlspecialcharsbx($_REQUEST['CODE']);
$result =  htmlspecialcharsbx($_REQUEST['submit']);
$in_sections =  $_REQUEST['sections'];

 echo "<pre>2"; print_r($in_sections); echo "!</pre>";

$userID = $USER->GetID();
$db = CUser::GetByID($userID);
$User = $db->GetNext();
$Group = CUser::GetUserGroup($userID);

if ($elementID){
	$db = CIBlockElement::GetByID($elementID);
	$res = $db->GetNextElement();
	$arProps = $res->GetProperties();
	$arFields = $res->GetFields();
}
else { echo "No element CODE received."; exit();}

if ((!$USER->IsAuthorized() || $arFields["CREATED_BY"] != $User["ID"]) && !in_array("1", $Group )) LocalRedirect('/personal/my/');

if(!empty($in_sections)) $sections =$in_sections; else $sections = $arProps["PUB_SECTION"]["VALUE"];


//echo "<pre>"; print_r($sections); echo "<pre>";


$db = CIBlockSection::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>25));

/*$firms=array();
$db = CIBlockElement::GetList(array("NAME"=>"ASC"), array("IBLOCK_ID"=>10, "CREATED_BY" => $userID));
while ( $block = $db->GetNext()) {
	$firms[$block['ID']]=array (
		"ID" => $block['ID'],
		"NAME" => $block['NAME'],
		);

}*/

?>

<form method="post" action="">
<input type="hidden" name="CODE" value=<?=$elementID?> /> 
<table>
<tr>
<td>
<select size="25" multiple="multiple" name="sections[]">
<?
$db = CIBlockSection::GetList(array("LEFT_MARGIN"=>"ASC"), array("IBLOCK_ID"=>25));
while ($sect = $db->GetNext()) {?>
<option value="<?=$sect['ID']?>"<?if(in_array($sect["ID"], $sections )) echo "selected='selected'";?>><?for($i=1; $i<$sect["DEPTH_LEVEL"]; $i++) { echo "&nbsp;.&nbsp;";}  ?><?=$sect["NAME"]?></option>
<? } ?>
</select>
<br /> <br /> <br />
</td>
<td></td>
</tr>
<tr>
<td><a href="javascript:history.go(-1)">Вернуться к редактированию</a></td>
<td><input type="submit" name="submit" value="Сохранить элемент" style="border:0; background:white; text-decoration:underline; color:#0479bd; cursor:pointer;" />
</td>
</tr>
</table>
</form>


<?

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
		?>
		<script>
			alert(<?=count($in_sections)?>);
		</script>	
		<?
	if( count($in_sections)>0 && count($in_sections)<6) {
		$db = CIBlockElement::SetPropertyValueCode($elementID, "PUB_SECTION", $in_sections);
		if ($db) print_r($in_sections);
		$db = CIBlockElement::SetElementSection($elementID, array(2604));
		if ($db) echo "OK2: ".$elementID;
		LocalRedirect("/personal/my/firms/");
	}
	else {	?>
		<script>
			alert("Вам следует выбрать от 1 до 5 разделов, к которым будет привязана Ваша компания.");
		</script>		
<?
	}
 }

//echo $firm;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


