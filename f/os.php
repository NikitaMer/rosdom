<?
	include("$common_functions_dir/page1.php");

	$os_theme = $_GET["os_theme"]; 
	$os_id = $_GET["os_id"];

	//Распаковка POST переменных
	$avp = array_keys($_POST);//список POST переменных
	for($ind=0;$ind<count($_POST);$ind++){
		$varname = $avp[$ind];
		$$varname = $_POST[$varname];
	}

	if($os_theme == 1){$os_sendemail= "support@postroi.ru,".$info_email; $os_sendtheme="Предложения и вопросы по работе сайта ".host(0).".ru";}
	if($os_theme == 2){$os_sendemail = $manager_email; $os_sendtheme="Вопрос c ".host(0).".ru по проекту <a href=http://post2/projects/".strtolower($os_id)."/ target=_blank>".strtoupper($os_id)."</a>";}
	if($os_theme == 3){$os_sendemail= "director@postroi.ru"; $os_sendtheme="Предложение или жалоба руководителю каталога проектов с сайта ".host(0).".ru";}
	
	if(isset($os_action) && $os_action == "send"){
		$os_sendmessage = "<h2>$os_sendtheme</h2><b>Email:</b> $os_email<br><b>Имя:</b> $os_name<br><b>Телефон:</b> $os_phone<br>";
		if($os_theme == 2)$os_sendmessage.="<b>Номер проекта:</b> ".$os_id."<br>";
		$os_sendmessage .= "<b>Сообщение:</b> $os_text";
		
		//Письмо нам
		sendmail($os_sendemail,strip_tags($os_sendtheme),$os_sendmessage,0,"from: <".$os_email.">\nX-Sender: <".$os_email.">\nContent-Type: text/html; charset=windows-1251");
		
		if($os_theme == 2){
			//Письмо им, если оно по проекту
			$content = "<p><b>Спасибо, что обратились в нашу компанию.</b><br>Возможно Ваш запрос потребует уточнения информации.<br>Мы постараемся ответить Вам в ближайшее время.</p>";
			sendmail($os_email,"Вы задали вопрос по проекту № ".strtoupper($os_id)." на сайте ".host(0).".ru","
				Вы задали вопрос по проекту № ".strtoupper($os_id)." на сайте ".host(0).".ru<br>
				Возможно Ваш запрос потребует уточнения информации.<br>
				Мы постараемся ответить Вам в ближайшее время.<br>
				Это письмо было отослано Вам автоматически, отвечать на него не нужно.<br>
				Спасибо, что обратились в нашу компанию.",1);
		}
		else $content = "<p><b>Ваше сообщение отправлено.</b><br>Спасибо.</p>";
	}
	else{			
		$result = query("SELECT * from projects where ((sflag is null) or (sflag<'2')) and site like('".regular()."') order by id");
		$selected="";
		$disabled="disabled";
		if($os_theme == 2){$selected="selected";$disabled="";}
		
		if(!empty($_SESSION['session_id']) && !empty($_SESSION['session_login'])){	
			$reg_res = query("select * from users where id='".$_SESSION['session_id']."' and site='".host(1)."'");
			$reg_row = mysql_fetch_assoc($reg_res);
		}
		
		if($os_theme != 2)$content .= "<div id=jalob></div>";
		
		$content .= "
			<form id=os_form name=os_form action=".$REQUEST_URI." method=post onsubmit=\"javascript:
				if(os_theme.value==0||os_email.value==''|| ".(($os_theme == 2)?"(os_id.value==0&&os_theme.value==2)||":"")."os_text.value==''){
					alert('Вы заполнили не все обязательные поля (помеченные жирным шрифтом).'); 
					return false;
				}
				else{
					os_action.value='send'; 
					return true;
				}
			\">
			
				<input type=hidden name=os_action>
				<table>
					<tr>
						<td class='b lftd'>Тема:</td>
						<td class='rftd'>
							<select".(($os_theme == 2)?" disabled":"")." name=os_theme onchange=\"javascript:
								if(os_theme.value==3)document.getElementById('jalob').innerHTML='<h3>Уважаемые клиенты!</h3><p>Если Вы считаете, что мы можем работать более эффективно, Вы можете обратиться напрямую к руководству каталога проектов. Мы обязательно учтем Ваши жалобы, пожелания и предложения.</p>';
								else document.getElementById('jalob').innerHTML='';
							\">
								<option value=0>---</option>";
								if($os_theme != 2)$content .= "<option value=1>Предложения и вопросы по работе сайта</option>";
								if($os_theme == 2)$content .= "<option value=2 $selected>Вопрос по проекту</option>";
								if($os_theme != 2)$content .= "<option value=3>Предложение или жалоба руководителю каталога проектов</option>";
								$content .= "
							</select>
						</td>
					</tr>
					<tr><td class=b>Ваш email:</td><td><input class=t type=text name=os_email".((isset($reg_row["email"]) && $reg_row["email"] != "")?" value='".$reg_row["email"]."'":"")."></td></tr>
					<tr><td>Ваше имя:</td><td><input type=text class=t name=os_name".((isset($reg_row["name"]) && $reg_row["name"] != "")?" value='".$reg_row["family"]." ".$reg_row["name"]." ".$reg_row["patronymic"]."'":"")."></td></tr>
					<tr><td>Телефон:</td><td>
						<input type='text' maxlength='17' name='os_phone' id='os_phone'class='t' />
						<script type='text/javascript'>
							$('input[name=os_phone]').mask('+7 (999) 999-99-99');
						</script>
					</td></tr>";
					if($os_theme == 2){$content .= "
						<tr>
							<td calss=b>Номер проекта:</td>
							<td>
								<select".(($os_theme == 2)?" disabled":"")." name=os_id $disabled>
									<option value=0>---</option>";
									while($row=mysql_fetch_assoc($result))$content.=selected(strtoupper($os_id),strtoupper($row["id"]),strtoupper($row["id"]));
									$content.="
								</select>
							</td>
						</tr>";
					}
					$content .= "
					<tr><td class=b>Ваше сообщение:</td><td><textarea name=os_text height:150px; margin-left:5px; font-family:tahoma; font-size:12px;'></textarea></td></tr>";
					if(host(0) == "postroi") 
						$content .= "<tr><td></td><td><a onclick=$('#os_form').submit() class='show_all w'><b class='show_all_left fl'></b><b class='show_all_center fl'>Отправить</b><b class='show_all_right fl'></b></a></td></tr>";
					else $content .= "<tr><td></td><td><input type=image src=/i2/send.jpg></td></tr>";
					
					$content .= "
				</table>
			</form>";
	}

	include("t/t0.php");
?>
