<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<h1>Шаг 2. Привязка к фирме.
</h1>
<br />
Укажите, к какой фирме должен быть привязан элемент.
<br />
<br />
<?
global $USER;
CModule::IncludeModule('main');
CModule::IncludeModule('iblock');
//	 echo "<pre>1"; print_r($_REQUEST); echo "!</pre>";
//	 echo "<pre>2"; print_r($_POST); echo "!</pre>";
//	 echo "<pre>3"; print_r($_GET); echo "!</pre>";

$err = array();

$edit = htmlspecialcharsbx($_REQUEST['edit']);
$my_firm = htmlspecialcharsbx($_REQUEST['my_firm']);
$elementID = htmlspecialcharsbx($_REQUEST['CODE']);
$result = htmlspecialcharsbx($_REQUEST['submit']);

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

//echo "<pre>!"; print_r($arFields); echo "!<pre>";
$firms=array();
$db = CIBlockElement::GetList(array("NAME"=>"ASC"), array("IBLOCK_ID"=>10, "CREATED_BY" => $userID));
while ( $block = $db->GetNext()) {
	$firms[$block['ID']]=array (
		"ID" => $block['ID'],
		"NAME" => $block['NAME'],
		);
}
?>

<form method="post" action="">
<input type="hidden" name="CODE" value=<?=$elementID?> /> 
<table>
<tr>
<td>
<select name="my_firm">
<?
foreach ($firms as $firm) {
	echo "<option value=".$firm["ID"].">".$firm["NAME"]."</option>";
}
?>
<option value="self">Оставить без привязки к фирме</option>
</select><br /> <br /> 
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
	if($my_firm == "self" ) $db = CIBlockElement::SetPropertyValueCode($elementID, "COMPANY", "");
	else
		$db = CIBlockElement::SetPropertyValueCode($elementID, "COMPANY", $my_firm);
	if ($db) echo "OK: ";
	$db = CIBlockElement::SetElementSection($elementID, array(2636));
	if ($db) echo "OK2: ";
LocalRedirect("/personal/my/press-release/");
// echo "<pre>"; print_r($_POST); echo "!<pre>";
 }

//echo $firm;
?>

        </div>

    <div class="clear"></div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


