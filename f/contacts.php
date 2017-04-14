<?
	include("$common_functions_dir/page1.php");
	
	/*
	//Подстановка формы обратной связи
	$mes1 = "";
	if($HTTP_POST_VARS["action"] == "send"){
		$mes = "<h1>Cообщение с сайта ".host(0).".ru</h1>";
		$mes .= "<b>Ф.И.О.:</b> ".$HTTP_POST_VARS["fio"]."<br>";
		$mes .= "<b>E-Mail:</b> ".$HTTP_POST_VARS["email"]."<br>";
		$mes .= "<b>Телефон:</b> ".$HTTP_POST_VARS["phone"]."<br>";
		$mes .= "<b>Сообщение:</b> ".$HTTP_POST_VARS["message"];
		if(sendmail($info_email,"Cообщение с сайта ".host(0).".ru",$mes,0)){
			$HTTP_POST_VARS["fio"] = $HTTP_POST_VARS["email"] = $HTTP_POST_VARS["phone"] = $HTTP_POST_VARS["message"] = "";
			$mes1 = "<font style='color:green; font-weight:bold;'>Сообщение отправлено</font>";
		}
		else $mes1 = "<font style='color:red; font-weight:bold;'>Ошибка, сообщение НЕ отправлено</font>";
	}
	$os_form = "
		<form class=os_form action=$REQUEST_URI method=post onsubmit=\"if(fio.value != '' && message.value != ''){action.value='send'; return true;} else{alert('Вы заполнили не все обязательные поля. Обязательные поля моечены жирным.'); return false;}\">
			<input type=hidden name=action value=''>
			<table>
				<tr><td width=100><b>Ф.И.О.:</b></td><td><input class=text type=text name=fio value='".$HTTP_POST_VARS["fio"]."'></td></tr>
				<tr><td>E-Mail:</td><td><input class=text type=text name=email value='".$HTTP_POST_VARS["email"]."'></td></tr>
				<tr><td>Телефон:</td><td><input class=text type=text name=phone value='".$HTTP_POST_VARS["phone"]."'></td></tr>
				<tr><td><b>Сообщение:</b></td><td><textarea name=message>".$HTTP_POST_VARS["message"]."</textarea></td></tr>
				<tr><td></td><td><input type=submit value='Отправить'> $mes1</td></tr>
			</table>
		</form>";
	$content = str_replace("<!--os_form-->",$os_form,$content);
	*/
	
	//Подстановка списка диллерских контактов
	$dillers_list = "";
	//$res = query("select * from dillers where status=1 order by id");
	$res = query("select * from dillers where status=1 and id in('2','46') order by id");
	while($row = mysql_fetch_assoc($res)){
		$dillers_list .= "<p style='border-bottom:1px dotted #aaa; padding-bottom:10px;'>";
		$dillers_list .= "<b>№</b> ".$row["id"]."<br>";
		if($row["region"] != "")$dillers_list .= "<b>Регион:</b> ".$row["region"]."<br>";
		if($row["name"] != "")$dillers_list .= "<b>Организация:</b> ".$row["name"]."<br>";
		if($row["adress"] != "")$dillers_list .= "<b>Адрес:</b> ".$row["adress"]."<br>";
		if($row["phones"] != "")$dillers_list .= "<b>Телефон:</b> ".$row["phones"]."<br>";
		if($row["faxes"] != "")$dillers_list .= "<b>Факс:</b> ".$row["faxes"]."<br>";
		if($row["site"] != "")$dillers_list .= "<b>Сайт:</b> <noindex><a href=http://www.".$row["site"]." target=_blank>".$row["site"]."</a></noindex><br>";
		if($row["email"] != "")$dillers_list .= "<b>E-Mail:</b> <noindex><a href=mailto:".$row["email"].">".$row["email"]."</a></noindex></p>";
	}
	$content = str_replace("<!--dillers_list-->",$dillers_list,$content);
	
	if(!$nopage)include($t0);
	else header("HTTP/1.1 404 Not Found");
?>