<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

?>

<style>
a.regLink
{
	color:#f16600;
	font-size:16px;
	text-decoration:underline;
}
input.text
{
	width:300px;
	margin-bottom:6px;
}
input.submit_but
{
	background: none repeat scroll 0 0 transparent;
    border: 0 none;
    color: #F16600;
    cursor: pointer;
    height: 17px;
    padding-left: 0;
    text-decoration: underline;
}
</style>

<?
global $USER;
if ($USER->IsAuthorized()):
LocalRedirect('/personal/profile/');
else:
?>
	<div style="width:100%; height:auto;">

	<? if($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_REQUEST["email"])>0){
		$res = CUser::SendPassword(false,$_REQUEST["email"]);
		echo '<h1>�������������� ������</h1>';
		ShowMessage($res); ?>
		<br /><br /><br />
		<a href="/">������� �� �������</a><br /><br /><br />
  	<?}
	else { ?>
	    <div style="width:620px; margin:25px 0; height:auto;">
	    	<h1>�������������� ������</h1>
        
	        <? if ($_GET['err']):?>
    			<span style="color:#F00; font-weight:bold;"><?=htmlspecialcharsbx($_GET['err'])?></span><br/>
	        <? else:?>
	    		<p>�������, ����������, ����� ����������� �����, ��������� ���� ��� ����������� �� ����� �����, � �� ������ �� ���� ����� ������.</p>
    		<? endif;?>
	        <br/>
    		<form action="" method="post">
	    		<input type="hidden" name="pass" value="forgot">
    			<input class="text" type="hidden" name="backUrl" value="<?=$_SERVER['REQUEST_URI']?>">
	        	<table cellpadding="0" cellspacing="0" width="100%" border="0">
    	        	    <tr><td width="255">E-mail<span style="color:#FF0000">*</span></td><td><input class="text" type="text" value="" name="email"/></td></tr>
        	    	<tr><td><input class="submit_but" type="button"  name="back" value="<- ���������" onclick="window.location='/'"/></td><td><input class="submit_but" type="submit" name="submit" value="��������� ->"></td></tr>
	        	</table>
	    </form>
	    </div>
	    <div class="clear"></div>
	</div>
	<?
	}
endif;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>