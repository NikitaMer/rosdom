<?
	if(!preg_match("/^[a-z]\-[0-9]{3,4}\-[0-9][a-z]$/", $_GET['nproj']))
	{
		header("HTTP/1.0 404 Not Found");
		exit;
	}


	if(!(isset($diler_script) && $diler_script == 1))
	{
		include("$common_functions_dir/page1.php");
		$form_action = "/$a/?final&nproj=" . (isset($_GET['nproj']) ? $_GET['nproj'] : '');
	}
	else
	{
		$stroy = $_GET['stroy'];
		$form_action = $_SERVER['REQUEST_URI'];

		if(!($stroy > 0 && is_numeric($stroy)))
		{
			print 'Не правильная ссылка';
			exit;
		}
	}

	$final = '';

	//*** Начальные данные ******************************************************************************
	
	$nproj = htmlspecialchars(strtolower($_GET["nproj"]));
	$project = mysql_array("select * from projects where id='".$nproj."'");
	$actions_set = actions($project[0]["name"],$project[0]["dt"]); 
	/*if(host(0) == "catalogdomov")$prefix = "_cd";	
	else */$prefix = "";
	
	if(host(1) != "4")$contUrl = "/contacts/";
	else $contUrl = "/contact/";
	
	$buyManualUrl1 = "/buy1/"; 
	$buyManualUrl2 = "/buy2/";
	$buyManualUrl3 = "/buy3/";
	
	$k = 1; 
	for($i=0;$i<count($actions_set);$i++){
		if($actions_set[$i]["k"] < $k)
			$k = $actions_set[$i]["k"];
	}
	if(host(0) == "catalogdomov")$k = 1;
	
	$p_bonus_action = 0;
	for($i = 0; $i < count($actions_set); $i++)
	{
		$bonus_action_array = mysql_array("SELECT * FROM actions WHERE (var1<>'' OR var2<>'' OR var3<>'' OR var4<>'' OR var5<>'') AND id='" . $actions_set[$i]["id"] . "'");
		if(count($bonus_action_array) > 0)
			$p_bonus_action = 1;
	}

	$nameHint = array();
	$prt = mysql_array("select * from projects_service where type='1' and buy='1'");
	for($i=0;$i<count($prt);$i++){
		if($prt[$i]["id"] == "58")$nameHint[0] = $prt[$i]["name"]; // Комплект Застройщика
		if($prt[$i]["id"] == "54")$nameHint[1] = $prt[$i]["name"]; // Полный комплект чертежей
		if($prt[$i]["id"] == "55")$nameHint[2] = $prt[$i]["name"]; // Архитектурно-строительные чертежи
		if($prt[$i]["id"] == "56")$nameHint[3] = $prt[$i]["name"]; // Доп. комплект чертежей без лицензии
		if($prt[$i]["id"] == "57")$nameHint[4] = $prt[$i]["name"]; // Паспорт проекта
		if($prt[$i]["id"] == "79")$nameHint[5] = $prt[$i]["name"]; // Полный комплект + интерьер
	}

	$complect_array = array(
		array($nameHint[0],"radio","complect","physical.c3.disabled=physical.c4.disabled=legal.c3.disabled=legal.c4.disabled=individual.c3.disabled=individual.c4.disabled=true;",58),
		array($nameHint[1],"radio","complect","physical.c3.disabled=physical.c4.disabled=legal.c3.disabled=legal.c4.disabled=individual.c3.disabled=individual.c4.disabled=false;",54),
		array($nameHint[2],"radio","complect","physical.c3.disabled=physical.c4.disabled=legal.c3.disabled=legal.c4.disabled=individual.c3.disabled=individual.c4.disabled=false;",55),
		array($nameHint[3],"checkbox","complect_dop","",56),
		array($nameHint[4],"checkbox","complect_pasp","",57),
		array($nameHint[5],"radio","complect","physical.c3.disabled=physical.c4.disabled=legal.c3.disabled=legal.c4.disabled=individual.c3.disabled=individual.c4.disabled=false;",79),
	);
	
	$pz_array = mysql_array("select * from projects_var where name='".$nproj."'");
	$p_pz = 0;
	for($i=0;$i<count($pz_array);$i++){
		if(strpos($pz_array[$i]["var"],"(") > 0)$p_pz = 1;
	}
	
	if(!empty($_SESSION['session_id']) && !empty($_SESSION['session_login']))
		$reg = mysql_array("select * from users where id='".$_SESSION['session_id']."' and site='".host(1)."'");
	
	$services = mysql_array("select projects_sp.*, projects_service.name,projects_service.id as sid
		from projects_sp inner join projects_service on projects_sp.service = projects_service.id 
		where projects_sp.prj='".$nproj."' and projects_service.buy=1
		order by projects_service.name");
	
	
	//*** Обработчик форм *******************************************************************************
	if(isset($_POST["action"]) && $_POST["action"] != ""){
		
		$query_array = array();

		$query_array["stroy"] = setnull(
			query1("
				select users1.name from users
				inner join users1 on users.users1 = users1.id
				where users.id=".$_POST["stroy"]
			)
		);

		//Интересует строительство
		if($_POST['stroy_interes'] == 'on')
			$query_array["stroy_interes"] = 1;
		else
			$query_array["stroy_interes"] = 0;

		$query_array["interior_interes"] = setnull($_POST["interior_interes"]);
		
		if($_POST["action"] == "physical"){
			$query_array["type"] = "'0'";
			/*
			$query_array["seria"] 			= setnull(str_replace(" ","",$_POST["seria"]));
			$query_array["nomer"] 			= setnull(str_replace(" ","",$_POST["nomer"]));
			$query_array["kem_vidan"] 	= setnull($_POST["kem_vidan"]);
			$query_array["data_vidachy"]= setnull(mysql_date_back($_POST["data_vidachy"]));
			*/
		}
		
		if($_POST["action"] == "legal"){
			$query_array["type"] = "'1'";
			
			$query_array["doljnost"]	= setnull($_POST["doljnost"]);
			$query_array["osnovanie"]	= setnull($_POST["osnovanie"]);
		}
		
		if($_POST["action"] == "individual"){
			$query_array["type"] = "'2'";
			
			$query_array["svidetelstvo"]	= setnull($_POST["svidetelstvo"]);
		}
		
		if($_POST["action"] == "legal" || $_POST["action"] == "individual"){
			$query_array["bank"] 			= setnull($_POST["bank"]);
			$query_array["bank_town"] = setnull($_POST["bank_town"]);
			$query_array["bic"] 			= setnull($_POST["bic"]);
			$query_array["rs"] 				= setnull($_POST["rs"]);
			$query_array["ks"] 				= setnull($_POST["ks"]);
			
			$query_array["fax"]				= setnull($_POST["fax"]);
			$query_array["cont_face"]	= setnull($_POST["cont_face"]);
			
			$query_array["org_name"]	= setnull($_POST["org_name"]);
			$query_array["inn"]				= setnull($_POST["inn"]);
			$query_array["kpp"]				= setnull($_POST["kpp"]);
		}
		
		if($_POST["action"] != "physical")
			$query_array["yur_adr"]		= setnull($_POST["yur_adr"]);
		
		//Прямой/Зеркальный
		if($p_pz == 1){
			if($_POST["pz"] == "Прямой")$pz_value = 0;
			else $pz_value = 1;
		}
		else $pz_value = 0;
		
		//Запись в tablicazakazov
		$query_array["proekt"]				=	setnull($nproj);
		if($p_pz == 1)$query_array["pz"] = "'".$_POST["pz"]."'";
		if($p_bonus_action == 1)
			$query_array["bonus_action"] = "'" . $bonus_action_array[0]['id'] . ":" . $_POST["bonus_action"] . "'";
		
		$query_array["adr_dost"] 			= setnull($_POST["adr_dost"]);
		/*
		$_POST["tel_mob"] = "8 (".preg_replace("/[^0-9]/i","",$_POST["tel_mob1"]).") ";
		$mob2 = preg_replace("/[^0-9\-]/i","",$_POST["tel_mob2"]);
		if(strpos($mob2,"-") == 0){
			$len = strlen($mob2);
			if($len > 3)$mob2 = substr($mob2,0,3)."-".substr($mob2,3,$len-3);
			if($len > 5)$mob2 = substr($mob2,0,6)."-".substr($mob2,6,$len-5);
		}
		$_POST["tel_mob"] .= $mob2;
		*/
		$query_array["tel_mob"] 			= setnull($_POST["tel_mob"]);
		$query_array["tel_gor"] 			= setnull($_POST["tel_gor"]);
		$query_array["form_email"] 		= setnull($_POST["form_email"]);
		$query_array["kakuznali"] 		= setnull($_POST["kakuznali"]);
		
		$dop_info = $_POST["dop_info"];
		if(host(0) == 'deltaplans') {
			if(!empty($_SESSION['session_id']) && !empty($_SESSION['session_login'])) {
				$dop_info .= " { Доп.скидка 5% }";
			}
		}
		$query_array["dop_info"] 		= setnull($dop_info);

		$query_array["family"]			=	setnull($_POST["family"]);
		$query_array["name"]			=	setnull($_POST["name"]);
		$query_array["patronymic"]		=	setnull($_POST["patronymic"]);
		
		$query_array["lastedit"]		=	"now()";
		$query_array["site"]					=	11;
		$query_array["mode"]			=	"'0'";
		
		$days = $project[0]["srok"];
		if($days == "") $days = "10";
		if(strpos($days, "-") > -1) $days = substr($days, strpos($days, "-")+1);
		$days = (int)$days;

		if($days <= 10) $days = 10;
		if($days > 10) $days += 5;
		
		$query_array["days"]			=	"'".$days."'";
		
		$query_array["firstdate"]		=	"now()";
		
		$query_array["diller_id"]		=	setnull($_POST["diller_id"]);
		$query_array["diller_nomdog"]	=	setnull($_POST["diller_nomdog"]);
		$query_array["diller_data"]		=	setnull($_POST["diller_data"]);
		
		$query = "insert into tablicazakazov (";
		foreach($query_array as $key => $value)
			$query .= $key.",";
		$query = substr($query,0,strlen($query)-1).") values (";
		foreach($query_array as $key => $value)
			$query .= $value.",";
		$query = substr($query,0,strlen($query)-1).")";
		query($query);
		//Запись в tablicazakazov_zakaz_tovar
		$last_id = mysql_insert_id();
		
		//Основные позиции
		$summa = 0;	
		for($i=0;$i<count($complect_array);$i++){
			if($_POST[$complect_array[$i][2]] == $complect_array[$i][4]){
				$summa += $project[0]["pr".$i.$prefix];
				$query = "insert into tablicazakazov_zakaz_tovar (tovar,zakaz,col,summa,summabezskid) values (
					'".$complect_array[$i][4]."',
					'$last_id',
					'1',
					".setnull(sprintf("%.0f",$project[0]["pr".$i.$prefix]*$k)).",
					".setnull($project[0]["pr".$i.$prefix])."
				)";
				//sprintf("%.0f",$project[0]["pr".$i.$prefix]*$k)
				query($query);
			}
		}
		
		$summa_ssk = $summa*$k;
		
		//Доп услуги
		for($i=0;$i<count($services);$i++){
			if($_POST["service".$i] == $services[$i]["sid"]){
				$summa += $services[$i]["price"];
				$summa_ssk += $services[$i]["price"];
				$query = "insert into tablicazakazov_zakaz_tovar (tovar,zakaz,col,summa,summabezskid) values (
					'".$services[$i]["sid"]."',
					'$last_id',
					'1',
					".setnull($services[$i]["price"]).",
					".setnull($services[$i]["price"])."
				)";
				query($query);
			}
		}
	
		//query("update tablicazakazov set summabezskid='$summa', summa='$summa_ssk' where id='$last_id'");
		
		//Формаирование финально сообщения
		$message = "<p>
			<b>Ваш заказ:</b>
			<table cellspacing=0 cellpadding=0 border=0 class='prices orderfin'>
				<tr class=head><td><b>Наимнование:</b></td><td><b>Значение:</b></td></tr>
				<tr><td>Номер проекта:</td><td>".strtoupper($nproj)."</td></tr>";
				if($p_pz == 1)$message .= "<tr><td>Прямой/зеркальный:</td><td>".(($_POST["pz"] == 0)?"Прямой":"Зеркальный")."</td></tr>";
				$message .= "
				<tr>
					<td>Комплектация:</td><td>".((isset($_POST["complect"]) && $_POST["complect"] != "") ? query1("select name from projects_service where id='" . (isset($_POST["complect"]) ? $_POST["complect"] : '') . "'") . ", " : "");
						if(isset($_POST["complect_dop"]) && $_POST["complect_dop"] != "")
							$message .= query1("select name from projects_service where id='" . (isset($_POST["complect_dop"]) ? $_POST["complect_dop"] : '') . "'") . ", ";
						if($_POST["complect_pasp"] != "")$message .= query1("select name from projects_service where id='".$_POST["complect_pasp"]."'").", ";
						for($i=0;$i<count($services);$i++){
							if($_POST["service".$i] != "")
								$message .= query1("select name from projects_service where id='".$_POST["service".$i]."'").", ";
						}
						$message = substr($message,0,strlen($message)-2);
						$message .= "
					</td>
				</tr>";
				if($p_bonus_action == 1){
					$message .= "<tr><td>Акция:</td><td>";
					/*
					for($i=0;$i<count($bonus_action_array);$i++){
						if($_POST["bonus_action"] == $i)$message .= $bonus_action_array[$i];
					}
					*/
					$message .= $bonus_action_array[0]['var'.$_POST["bonus_action"]];
					$message .= "</td></tr>";
				}
				if($_POST["action"] == "legal")$message .= "<tr><td>Название организации:</td><td>".$_POST["org_name"]."</td></tr>";
				if($_POST["action"] == "individual")$message .= "<tr><td>Название:</td><td>".$_POST["org_name"]."</td></tr>";
				if($_POST["action"] == "legal" || $_POST["action"] == "individual")$message .= "
					<tr><td>ИНН:</td><td>".$_POST["inn"]."</td></tr>
					<tr><td>КПП:</td><td>".$_POST["kpp"]."</td></tr>";
				$message .= "
					<tr><td>Фамилия".(($_POST["action"] == "legal")?" руководителя":"").":</td><td>".$_POST["family"]."</td></tr>
					<tr><td>Имя:</td><td>".$_POST["name"]."</td></tr>
					<tr><td>Отчество:</td><td>".$_POST["patronymic"]."</td></tr>";
				/*
				if($_POST["action"] == "physical")$message .= "
					<tr><td>Паспорт (серия):</td><td>".$_POST["seria"]."</td></tr>
					<tr><td>Паспорт (номер):</td><td>".$_POST["nomer"]."</td></tr>
					<tr><td>Кем выдан:</td><td>".$_POST["kem_vidan"]."</td></tr>
					<tr><td>Дата выдачи:</td><td>".$_POST["data_vidachy"]."</td></tr>
					<tr><td>Адрес прописки:</td><td>".$_POST["yur_adr"]."</td></tr>";
				*/
				if($_POST["action"] == "legal")$message .= "
					<tr><td>Должность руководителя:</td><td>".$_POST["doljnost"]."</td></tr>
					<tr><td>На основании чего действует:</td><td>".$_POST["osnovanie"]."</td></tr>";
				if($_POST["action"] == "individual")$message .= "
					<tr><td>Свидетельство о регистрации №:</td><td>".$_POST["svidetelstvo"]."</td></tr>";
				if($_POST["action"] == "legal" || $_POST["action"] == "individual")$message .= "
					<tr><td>Юридический адрес:</td><td>".$_POST["yur_adr"]."</td></tr>
					<tr><td>Банк:</td><td>".$_POST["bank"]."</td></tr>	
					<tr><td>Место нахождения банка (город):</td><td>".$_POST["bank_town"]."</td></tr>	
					<tr><td>БИК:</td><td>".$_POST["bic"]."</td></tr>	
					<tr><td>Расч/счет:</td><td>".$_POST["rs"]."</td></tr>	
					<tr><td>Кор/счет:</td><td>".$_POST["ks"]."</td></tr>";
				$message .= "
					<tr><td>Адрес доставки проекта:</td><td>".$_POST["adr_dost"]."</td></tr>
					<tr><td>Контактный телефон (моб.):</td><td>".$_POST["tel_mob"]."</td></tr>	
					<tr><td>Контактный телефон (гор.):</td><td>".$_POST["tel_gor"]."</td></tr>";
				if($_POST["action"] == "legal" || $_POST["action"] == "individual")$message .= "<tr><td>Факс:</td><td>".$_POST["fax"]."</td></tr>";
				$message .= "<tr><td>E-mail:</td><td>".$_POST["form_email"]."</td></tr>";
				if($_POST["action"] == "legal" || $_POST["action"] == "individual")$message .= "<tr><td>Контактное лицо:</td><td>".$_POST["cont_face"]."</td></tr>";
				$message .= "	
					<tr><td>Как Вы о нас узнали:</td><td>".$_POST["kakuznali"]."</td></tr>	
					<tr><td>Дополнительная информация:</td><td>".$_POST["dop_info"]."</td></tr>
		</table><br><img src=http://www.".host(0).".ru/$projects_dir/".strtolower($nproj)."/p-sm.jpg class='orderfin'></p>";

		//Письмо нам
		$mailforus = "postroiru@yandex.ru,merk@list.ru";
		if(host(0) == 'masterov')
			$mailforus .= ",6434365@mail.ru";
		sendmail($mailforus,"Заказ проекта № ".strtoupper($nproj)." с сайта ".host(0).".ru", $message, 1);

		//Письмо Пензину
		if($_POST['stroy_interes']=='on')
			sendmail("merk@list.ru","Интересует строительство по № ".strtoupper($nproj)." с сайта ".host(0).".ru", $message, 1);
		
		//Письмо строителю
		if($_POST['stroy'] > 0)
		{
			$stroyemail = query1("select email from users where id=".$_POST['stroy']);
			sendmail($stroyemail,"С ваешго сайта заказали проект № ".strtoupper($nproj),$message,1);
		}

		if(!$is_local){
			$mes = "
				<p><b>Спасибо за заказ</b>, ваша заявка отправлена на обработку. В ближайшее время наши <b>менеджеры свяжутся с Вами</b></p>
				$message";
			
			$designFile = file_get_contents("$common_functions_dir/design.php");
			$designFile = str_replace("<!--theme-->", "Вы заказали проект № ".strtoupper($nproj)." на сайте ".host(0).".ru", $designFile);
			$designFile = str_replace("<!--mes-->", $mes, $designFile);
			$designFile = str_replace("<!--site-->", host(0) . ".ru", $designFile);
			$designFile = str_replace("<!--mail-->", $info_email, $designFile);
				
			$mes = $designFile;

			sendmail($_POST["form_email"],"Вы заказали проект № ".strtoupper($nproj)." на сайте ".host(0).".ru",$mes,1);
		}
		
		//Загрузка на сервер прикрепленных файлов
		for($fi=1;$fi<=5;$fi++){
			if(is_uploaded_file($_FILES["file".$fi]["tmp_name"]) && !empty($_SESSION['session_id']) && !empty($_SESSION['session_login']) && $reg[0]["status"] == 3 && host(1) == 2){
				
				$pvh = strrpos($_FILES["file".$fi]["type"],"/")+1;
				$ext = substr($_FILES["file".$fi]["type"],$pvh,strlen($_FILES["file".$fi]["type"])-$pvh);
				
				if($ext == "jpeg" || $ext == "gif" || $ext == "png" || $ext == "tiff" || $ext == "pdf")
					copy($_FILES["file".$fi]["tmp_name"], "scan/".$last_id."_".$fi.".".$ext);
			}
		}
	 
	}
	

	//*** Функции формирования формы ********************************************************************
	
	function pricesTable($type){
		global $_POST,$project,$services,$complect_array,$k,$prefix;
		
		$c = "
			<table cellspacing=0 cellpadding=0 border=0 class=prices>
				<tr class=head><td></td><td>Наименование</td><td>Цена</td></tr>";
				$ir = 0; $p0 = false;
				for($i=0;$i<count($complect_array);$i++){
					if(getprice($project[0]["pr".$i.$prefix]) != "------"){
						if($complect_array[$i][0] == "Комплект Застройщика")$p0 = true;
						$c .= "
							<tr>
								<td>
									<input 
										type=".$complect_array[$i][1]." 
										id='c$i' 
										name=".$complect_array[$i][2]." 
										value='".$complect_array[$i][4]."'".
										(((isset($_POST[$complect_array[$i][2]]) && $_POST[$complect_array[$i][2]] == $complect_array[$i][0]) || $ir == 0)?" checked":"").
										(($i < 3)?" onclick='".$complect_array[$i][3].radio_transfer($type,"complect",$ir++)."'":" onclick='physical.c$i.checked=legal.c$i.checked=individual.c$i.checked=this.checked;'").
										((($i == 3 || $i == 4) && $p0)?" disabled":"").">
								</td>
								<td>".$complect_array[$i][0]."</td>
								<td nowrap align=right><b>".priceformat(getprice($project[0]["pr".$i.$prefix])*$k)." р</b></td>
							</tr>"; 
					}
				}
				
				for($i=0;$i<count($services);$i++){
					$c .= "
						<tr>
							<td><input type=checkbox name='service".$i."' value='".$services[$i]["sid"]."'".(($_POST["service".$i] == $services[$i]["name"])?" checked":"")."></td>
							<td>".$services[$i]["name"]."</td>
							<td nowrap align=right><b>".priceformat(getprice($services[$i]["price"]))." р</b></td>
						</tr>";
				}
				
				$c .= "
			</table>";
		
		//Скидка для зарегистрированных пользователей Dp 5%
		if(host(0) == 'deltaplans') {
			if(!empty($_SESSION['session_id']) && !empty($_SESSION['session_login'])) {
				$c .= "<p style='color:green;font-size:12px;font-weight:bold;'>Дополнительно - скидка для зрегистрированных пользователей 
					DeltaPlans.ru 5% с указанных выше сумм.</p>";
			}
		}

		return $c;
	}
	
	function radio_transfer($type,$name,$i){
		if($type == "physical")return "legal.".$name."[".$i."].checked = true; individual.".$name."[".$i."].checked = true;";
		if($type == "legal")return "physical.".$name."[".$i."].checked = true; individual.".$name."[".$i."].checked = true;";
		if($type == "individual")return "physical.".$name."[".$i."].checked = true; legal.".$name."[".$i."].checked = true;";
	}
	
	function project($type){
		global $_POST,$p_bonus_action,$bonus_action_array,$nproj,$projects_dir,$p_pz,$project,$services,$geo_param;
		$c = "
			<fieldset>
				<legend>Проект</legend>
				<table>
					<tr><td width=25% class=b>Номер проекта:</td><td><a href=/$projects_dir/$nproj/><img src=/$projects_dir/$nproj/".$project[0]["prev"]." width=50 border=0></a> <b><a href=/$projects_dir/$nproj/>".strtoupper($nproj)."</a></b></td></tr>";
					if($p_pz == 1){
						$c .= "
							<tr>
								<td class=b>Прямой/зеркальный:</td>
								<td>
									<input type=radio name=pz value='0'".((empty($_POST["pz"]) || $_POST["pz"] == 0 || $_POST["pz"] == "")?" checked":"")." onclick='".radio_transfer($type,"pz",0)."'> Прямой
									<input type=radio name=pz value='1'".((isset($_POST["pz"]) && $_POST["pz"] == 1)?" checked":"")." onclick='".radio_transfer($type,"pz",1)."'> Зеркальный
								</td>
							</tr>";
					}
					$c .= "
					<tr><td class=b>Комплектация:</td><td>".pricesTable($type)."<div id=complect_div_$type class=er></div></td></tr>";
					if($p_bonus_action == 1){
						$c .= "
							<tr>
								<td class=b>Акция:<br><span class=subtext>с этим проектом идут акции, выбирайте</span></td>
								<td>";
									
									$c .= "<input type=radio name=bonus_action value='0'" . ($_POST["bonus_action"] == 0 || $_POST["bonus_action"] == "" ? " checked" : "") . "> Нет<br>";
									for($i = 1; $i < 5; $i++)
									{
										if(trim($bonus_action_array[0]['var'.$i]) != '')
											$c .= "<input type=radio name=bonus_action value='$i'" . 
												($_POST["bonus_action"] == $i ? " checked" : "") . "> " . $bonus_action_array[0]['var'.$i] . "<br>";
									}
									
									$c .= "
								</td>
							</tr>";
					}
					
					if($geo_param['country_id'] == 193 && $geo_param['district_id'] == 10 && 
						($geo_param['region_id'] == 42 || $geo_param['region_id'] == 43))
						$c .= "<tr><td width=25% class=b>Строительство:</td><td>
							<input type='checkbox' name='stroy_interes'".($_POST['stroy_interes']=='on' ? " checked":"")." /> Меня интересует строительство
							</td></tr>";

					$theLast = strtolower(substr($project[0]['id'], strlen($project[0]['id']) - 1, 1));
					if(($theLast == 'k' || $theLast == 'p' || $theLast == 's') && $project[0]['o_pl'] >= 90)
						$c .= "<tr><td width=25% class=b>Дизайн интерьера:</td><td>
							<select name='interior_interes'>
								<option value=''>Не интересует</option>
								<option".($_POST['interior_interes>']=='1' ? " selected":"")." value='1'>Эскизный дизайн проект интерьера (5000р)</option>
								<option".($_POST['interior_interes>']=='2' ? " selected":"")." value='2'>Дизайн проект интерьера коттеджа (от 500р за кв.м)</option>
							</select>
							</td></tr>";
					

					$c .= "
				</table>
			</fieldset>";
		return $c;
	}
	
	function bank($type){
		global $_POST;
		return "
			<fieldset>
				<legend>Банк</legend>
				<table>							
					<tr><td width=25% class=b>Банк:</td><td><input type=text name=bank class=t value='" . (isset($_POST["bank"]) ? $_POST["bank"] : '') . "'><div id=bank_div_$type class=er></div></td></tr>
					<tr><td class=b>Место нахождения банка (город):</td><td><input type=text name=bank_town class=t value='" . (isset($_POST["bank_town"]) ? $_POST["bank_town"] : '') . "'><div id=bank_town_div_$type class=er></div></td></tr>
					<tr><td class=b>БИК:</td><td><input type=text name=bic class=t value='" . (isset($_POST["bic"]) ? $_POST["bic"] : '') . "'><div id=bic_div_$type class=er></div></td></tr>
					<tr><td class=b>Расч/счет:</td><td><input type=text name=rs class=t value='" . (isset($_POST["rs"]) ? $_POST["rs"] : '') . "'><div id=rs_div_$type class=er></div></td></tr>
					<tr><td class=b>Кор/счет:</td><td><input type=text name=ks class=t value='" . (isset($_POST["ks"]) ? $_POST["ks"] : '') . "'><div id=ks_div_$type class=er></div></td></tr>
				</table>
			</fieldset>";
	}
	
	function contacts($type){
		global $_POST,$reg;
		$c = "
			<fieldset>
				<legend>Контакты</legend>
					<table>							
						<tr><td width=25%>Адрес доставки проекта:<br><span class=subtext>с учетом того, что курьер приходит в рабочее время и на некоторые проекты доставка платная</span></td><td><textarea name=adr_dost class=ta>" . (isset($_POST["adr_dost"]) ? $_POST["adr_dost"] : '') . "</textarea></td></tr>	
						<tr>
							<td class=b>Контактный телефон (моб.):</td>
							<td>
								<input type='text' maxlength='17' name='tel_mob' id='tel_mob' class='t' value='". (isset($_POST["tel_mob"]) ? $_POST["tel_mob"] : '') . "' />
								<script type='text/javascript'>
									$('input[name=tel_mob]').mask('+7 (999) 999-99-99');
								</script>
								<div id=tel_mob_div_$type class=er></div>
							</td>
						</tr>	
						<tr>
							<td>Контактный телефон (гор.):</td>
							<td>
								<input type='text' maxlength='17' name='tel_gor' id='tel_gor' class='t' value='". (isset($_POST["tel_gor"]) ? $_POST["tel_gor"] : '') . "' />
								<script type='text/javascript'>
									$('input[name=tel_gor]').mask('+7 (999) 999-99-99');
								</script>
							</td>
						</tr>";	
						if($type != "physical")$c .= "<tr><td>Факс:</td><td><input type=text name=fax class=t value='" . (isset($_POST["fax"]) ? $_POST["fax"] : '') . "'></td></tr>";	
						$c .= "<tr><td class=b>E-mail:</td><td><input type=text name=form_email class=t value='" . ((isset($reg[0]["email"]) && $reg[0]["email"] != "") ? $reg[0]["email"] : (isset($_POST["form_email"]) ? $_POST["form_email"] : '')) . "'><div id=form_email_div_$type class=er></div></td></tr>";	
						if($type != "physical")$c .= "<tr><td class=b>Контактное лицо:</td><td><input type=text name=cont_face class=t value='" . (isset($_POST["cont_face"]) ? $_POST["cont_face"] : '') . "'><div id=cont_face_div_$type class=er></div></td></tr>";	
						$c .= "<tr><td>Как Вы о нас узнали:</td><td><input type=text name=kakuznali class=t value='" . (isset($_POST["kakuznali"]) ? $_POST["kakuznali"] : '') . "'></td></tr>	
						<tr><td>Дополнительная информация:</td><td><textarea name=dop_info>" . (isset($_POST["dop_info"]) ? $_POST["dop_info"] : '') . "</textarea></td></tr>	
					</table>
				</fieldset>";
		return $c;
	}
	
	function forDillers($type){
		global $_SESSION,$_POST,$reg;
		$c = "";
		if(!empty($_SESSION['session_id']) && !empty($_SESSION['session_login']) && $reg[0]["status"] == 3 && (host(1) == 2 || host(1) == 12))
			$c = "
				<input type=hidden name=diller_id value='".$_SESSION['session_id']."'>
				<fieldset>
					<legend>Для дилеров</legend>
						<table>							
							<tr><td width=25%>Номер договора:<br><span class=subtext>с закзчиком</span></td><td><input type=text name=diller_nomdog class=t value='".$_POST["diller_nomdog"]."'></td></tr>	
							<tr><td width=25%>Дата договора:<br><span class=subtext>с закзчиком</span></td><td><input type=text name=diller_data class='t postform_datepicker' value='".$_POST["diller_data"]."'></td></tr>	
							<tr><td width=25%>Прикрепить файл 1:<br><span class=subtext>tiff, jpg, gif, png, pdf (не более 2Мб)</span></td><td><input type=file name=file1 class=t value='".$_POST["file1"]."'><div id=file1_div_$type class=er></div></td></tr>	
							<tr><td width=25%>Прикрепить файл 2:<br><span class=subtext>tiff, jpg, gif, png, pdf (не более 2Мб)</span></td><td><input type=file name=file2 class=t value='".$_POST["file2"]."'><div id=file2_div_$type class=er></div></td></tr>	
							<tr><td width=25%>Прикрепить файл 3:<br><span class=subtext>tiff, jpg, gif, png, pdf (не более 2Мб)</span></td><td><input type=file name=file3 class=t value='".$_POST["file3"]."'><div id=file3_div_$type class=er></div></td></tr>	
							<tr><td width=25%>Прикрепить файл 4:<br><span class=subtext>tiff, jpg, gif, png, pdf (не более 2Мб)</span></td><td><input type=file name=file4 class=t value='".$_POST["file4"]."'><div id=file4_div_$type class=er></div></td></tr>	
							<tr><td width=25%>Прикрепить файл 5:<br><span class=subtext>tiff, jpg, gif, png, pdf (не более 2Мб)</span></td><td><input type=file name=file5 class=t value='".$_POST["file5"]."'><div id=file5_div_$type class=er></div></td></tr>	
						</table>
					</fieldset>";
		return $c;
	}
	
	function quote_cuter($s){
		$s = preg_replace("/\\\'/","'",$s);
		$s = preg_replace('/\\\"/','"',$s);
		return $s;
	}
	
	//*** Стили и скрипты *******************************************************************************
	
	$content = "
		
		<style>
			#tabs{font:13px arial}
			#tabs ul li{list-style-image: none; margin:0 2px;}
			fieldset{border:1px solid #aaa; margin-bottom:5px; padding-bottom:5px;}
			legend{margin:10px;}
			.subtext{color:#777; font:13px times}
			.er{color:red; font:12px arial;}
		</style>
		
		<script> 

			$(function() {
				$('#dialog:ui-dialog').dialog('destroy');
			
				$('#dialog-message').dialog({
					modal: true,
					autoOpen: false,
					buttons: {
						Ok: function() {
							$(this).dialog('close');
						}
					}
				});
			});
			
			function showDialod(){
				$('#dialog-message').dialog('open');
			}
			
			function writeMessage(el,message,prefix){
				var elname = el.name;
				er_div = document.getElementById(elname+'_div_'+prefix);
				er_div.innerHTML = message;
			}
			
			function checkForm(f){
				prefix = f.action.value;
				ret = true;
				
        for(i=0;i<f.length;i++){
					if(f[i].name != undefined){
						
						message = '';
						
						if(f[i].name == 'family' || f[i].name == 'name' || f[i].name == 'patronymic' || f[i].name == 'cont_face'){
							if(/[^а-яА-ЯёЁ\-\s]/.test(f[i].value) || f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только русские символы';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'seria'){
							if(f[i].value.length == 0){
								ret = false;
								message = '<b>ошибка</b>: поле не заполнено';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'nomer'){
							if(f[i].value.length == 0){
								ret = false;
								message = '<b>ошибка</b>: поле не заполнено';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'data_vidachy'){
							if(!(/[0-9]{2}\.[0-9]{2}\.[0-9]{4}/.test(f[i].value))){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'kem_vidan' || f[i].name == 'yur_adr'){
							if(/*/[^а-яА-Я0-9\.,\"\'\s]/.test(f[i].value) || */f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'tel_mob'){
							if(/[^0-9\-\s\+\(\)]/.test(f[i].value) || f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только цифры и дефис';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'form_email'){
							if(/[^a-zA-Z@\.\-_0-9]/.test(f[i].value) || f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только цифры, символы дефиса и скобок';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						//*** Организация ******************************************************************
						
						if(f[i].name == 'org_name'){
							if(f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'svidetelstvo'){
							if(/[^0-9а-яА-Я\.\s]/.test(f[i].value) || f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только цифры, русские символы, точку и пробел';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'doljnost'){
							if(/[^а-яА-Я\.\-\s]/.test(f[i].value) || f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте русские символы, дефис, точку и пробел';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'osnovanie'){
							if(f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'inn'){
							if(/[^0-9]/.test(f[i].value) || (f[i].value.length < 10 || f[i].value.length > 12)){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только цифры';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'kpp'){
							if(/[^0-9]/.test(f[i].value) || f[i].value.length != 9){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только цифры';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						//*** Банк *************************************************************************
						
						if(f[i].name == 'bank'){
							if(f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'bank_town'){
							if(/[^а-яА-Я\-\s]/.test(f[i].value) || f[i].value.length < 2){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только русские символы, дефис и пробел';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'bic'){
							if(/[^0-9]/.test(f[i].value) || f[i].value.length != 9){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только цифры';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'rs' || f[i].name == 'ks'){
							if(/[^0-9]/.test(f[i].value) || f[i].value.length != 20){
								ret = false;
								message = '<b>ошибка</b>: поле заполнено не верно или не заполнено, используйте только цифры';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
						}
						
						if(f[i].name == 'file1' || f[i].name == 'file2' || f[i].name == 'file3' || 
							f[i].name == 'file4' || f[i].name == 'file5'){
							var ext = f[i].value.substring(f[i].value.lastIndexOf('.')+1,f[i].value.length).toLowerCase();
							if(!(ext == 'tif' || ext == 'tiff' || ext == 'jpg' || ext == 'jpeg' || 
								ext == 'gif' || ext == 'png' || ext == 'pdf') && f[i].value != ''){
								
								ret = false;
								message = '<b>ошибка</b>: недопустимый формат файла, используйте только tiff, jpg, gif, png, pdf';
							}
							else message = '';
							writeMessage(f[i],message,prefix);
							
						}
						
					}
        }
				return ret;
			}

		</script>";
	
	//*** Диалог ****************************************************************************************
	
	$content .= "
		<div id='dialog-message' title='Ошибки при заполнении формы'> 
			<p> 
				<span class='ui-icon ui-icon-circle-check' style='float:left; margin:0 7px 50px 0;'></span> 
				Вы допустили ошибки при заполнении формы.
			</p> 
		</div>";
		
	//*** Вывод формы ***********************************************************************************
	
	if(empty($_POST["action"]) || $_POST["action"] == "") { $content .= "	
		<div id=postform>
			<div id='tabs'> 
				<div class='item_header first'>Для физических лиц</div> 
				<div class='item_header'>Для юридических лиц</div> 
				<div class='item_header'>Для индивидуальных предпринимателей</div> 
				 
				<div id='physical' class='item_content'> 
					<div class='postformtext1'>";
					if(isset($postFormText[0]) && $postFormText[0] != "")$content .= $postFormText[0];
					else $content .= "	
					<p>
						<img src=/i/i.jpg align=absmiddle> Ознакомтесь с <a href=$buyManualUrl1 target=_blank>порядком покупки проекта для физ.лиц</a>.
						Если у Вас возникли проблемы c заполнением формы пожалуйста свяжитесь с нами по <a href=$contUrl target=_blank>телефону</a>.
					</p>";
					$content .= "
					</div>
					<form enctype=multipart/form-data name=physical action='".$form_action."' method=post onsubmit=\"action.value='physical'; if(checkForm(this))return true; else{showDialod(); return false;}\">
						<input type=hidden name=action value=''>
						<input type=hidden name=stroy value='".$stroy."'>
							
						".project("physical")."
						
						<fieldset>
							<legend>ФИО</legend>
							<table>								
								<tr><td width=25% class=b>Фамилия:</td><td><input type=text name=family class=t value='" . ((isset($reg[0]["family"]) && $reg[0]["family"] != "") ? $reg[0]["family"] : (isset($_POST["family"]) ? $_POST["family"] : '')) . "'><div id=family_div_physical class=er></div></td></tr>
								<tr><td class=b>Имя:</td><td><input type=text name=name class=t value='" . ((isset($reg[0]["name"]) && $reg[0]["name"] != "") ? $reg[0]["name"] : (isset($_POST["name"]) ? $_POST["name"] : '')) . "'><div id=name_div_physical class=er></div></td></tr>
								<tr><td class=b>Отчество:</td><td><input type=text name=patronymic class=t value='" . ((isset($reg[0]["patronymic"]) && $reg[0]["patronymic"] != "") ? $reg[0]["patronymic"] : (isset($_POST["patronymic"]) ? $_POST["patronymic"] : '')) . "'><div id=patronymic_div_physical class=er></div></td></tr>
								"./*
								<tr><td class=b>Паспорт (серия):<br><span class=subtext>например: 1234</span></td><td><input type=text name=seria class=t value='" . (isset($_POST["seria"]) ? $_POST["seria"] : '') . "'><div id=seria_div_physical class=er></div></td></tr>	 
								<tr><td class=b>Паспорт (номер):<br><span class=subtext>например: 123456</span></td><td><input type=text name=nomer class=t value='" . (isset($_POST["nomer"]) ? $_POST["nomer"] : '') . "'><div id=nomer_div_physical class=er></div></td></tr>
								<tr><td class=b>Кем выдан:</td><td><textarea name=kem_vidan>" . (isset($_POST["kem_vidan"]) ? quote_cuter($_POST["kem_vidan"]) : '') . "</textarea><div id=kem_vidan_div_physical class=er></div></td></tr>	
								<tr><td class=b>Дата выдачи:</td><td><input type=text name=data_vidachy class='t postform_datepicker' value='" . (isset($_POST["data_vidachy"]) ? $_POST["data_vidachy"] : '') . "'><div id=data_vidachy_div_physical class=er></td></tr>	
								<tr><td class=b>Адрес прописки:</td><td><textarea name=yur_adr>" . (isset($_POST["yur_adr"]) ? quote_cuter($_POST["yur_adr"]) : '') . "</textarea><div id=yur_adr_div_physical class=er></td></tr>	
								*/"
							</table>
						</fieldset>
						
						".contacts("physical")."
						".forDillers("physical")."
						" . ((host(0) == "postroi" || host(0) == "deltaplans")?
								"<div align='center'>
									<a class='show_all w' onclick=$(document.forms[".first_form(1)."]).submit()><b class='show_all_left fl'></b><b class='show_all_center fl'>Заказать</b><b class='show_all_right fl'></b></a>
								</div>":
								"<table><tr><td width=25% ></td><td><input type=image src=/i/send.jpg></td></tr></table>") . "
					</form>
				</div> 
				
				<div id='legal' class='item_content'> 
					<div class=postformtext2>";
					if(isset($postFormText[1]) && $postFormText[1] != "")$content .= $postFormText[1];
					else $content .= "	
					<p>
						<img src=/i/i.jpg align=absmiddle> Ознакомтесь с <a href=$buyManualUrl2 target=_blank>порядком покупки проекта для юр.лиц</a>.
						Если у Вас возникли проблемы c заполнением формы пожалуйста свяжитесь с нами по <a href=$contUrl target=_blank>телефону</a>.
					</p>";
					$content .= "
					</div>
					<form enctype=multipart/form-data name=legal action='".$form_action."' method=post onsubmit=\"action.value='legal'; if(checkForm(this))return true; else{showDialod(); return false;}\">
						<input type=hidden name=action value=''>
						<input type=hidden name=stroy value='".$stroy."'>

						".project("legal")."
						
						<fieldset>
							<legend>Организация</legend>
							<table>
								<tr><td width=25% class=b>Название организации:<br><span class=subtext>например: ООО «Маяк»</span></td><td><input type=text name=org_name class=t value='" . (isset($_POST["org_name"]) ? $_POST["org_name"] : '') . "'><div id=org_name_div_legal class=er></div></td></tr>
								<tr><td class=b>ИНН:</td><td><input type=text name=inn class=t value='" . (isset($_POST["inn"]) ? $_POST["inn"] : '') . "'><div id=inn_div_legal class=er></div></td></tr>
								<tr><td class=b>КПП:</td><td><input type=text name=kpp class=t value='" . (isset($_POST["kpp"]) ? $_POST["kpp"] : '') . "'><div id=kpp_div_legal class=er></div></td></tr>
								<tr><td class=b>Фамилия руководителя:</td><td><input type=text name=family class=t value='".((isset($reg[0]["family"]) && $reg[0]["family"] != "") ? $reg[0]["family"] : (isset($_POST["family"]) ? $_POST["family"] : '')) . "'><div id=family_div_legal class=er></div></td></tr>
								<tr><td class=b>Имя:</td><td><input type=text name=name class=t value='".((isset($reg[0]["name"]) && $reg[0]["name"] != "") ? $reg[0]["name"] : (isset($_POST["name"]) ? $_POST["name"] : '')) . "'><div id=name_div_legal class=er></div></td></tr>
								<tr><td class=b>Отчество:</td><td><input type=text name=patronymic class=t value='".((isset($reg[0]["patronymic"]) && $reg[0]["patronymic"] != "") ? $reg[0]["patronymic"] : (isset($_POST["patronymic"]) ? $_POST["patronymic"] : '')) . "'><div id=patronymic_div_legal class=er></div></td></tr>
								<tr><td class=b>Должность руководителя<br>(в род.падеже):<br><span class=subtext>Генерального директора</span></td><td><input type=text name=doljnost id=doljnost class=t value='" . (isset($_POST["doljnost"]) ? $_POST["doljnost"] : '') . "'><div id=doljnost_div_legal class=er></div></td></tr>
								<tr><td class=b>На основании чего действует<br>(в род.падеже):<br><span class=subtext>Доверенности от 10.10.2011/Устава/Иное</span></td><td><input type=text name=osnovanie id=osnovanie class=t value='" . (isset($_POST["osnovanie"]) ? $_POST["osnovanie"] : '') . "'><div id=osnovanie_div_legal class=er></div></td></tr>
								<tr><td class=b>Юридический адрес:</td><td><textarea name=yur_adr>" . (isset($_POST["yur_adr"]) ? $_POST["yur_adr"] : '') . "</textarea><div id=yur_adr_div_legal class=er></div></td></tr>
								</table>
						</fieldset>
						
						".bank("legal")."
						".contacts("legal")."
						".forDillers("legal")."
						" . ((host(0) == "postroi" || host(0) == "deltaplans")?
								"<div align='center'>
									<a class='show_all w' onclick=$(document.forms[".first_form(2)."]).submit()><b class='show_all_left fl'></b><b class='show_all_center fl'>Заказать</b><b class='show_all_right fl'></b></a>
								</div>":
								"<table><tr><td width=25% ></td><td><input type=image src=/i/send.jpg></td></tr></table>") . "
					</form>
				</div> 
				
				<div id='individual' class='item_content'>
					<div class=postformtext3>";
					if(isset($postFormText[2]) && $postFormText[2] != "")$content .= $postFormText[2];
					else $content .= "
					<p>
						<img src=/i/i.jpg align=absmiddle> Ознакомтесь с <a href=$buyManualUrl3 target=_blank>порядком покупки проекта для и.п.</a>.
						Если у Вас возникли проблемы c заполнением формы пожалуйста свяжитесь с нами по <a href=$contUrl target=_blank>телефону</a>.
					</p>";
					$content .= "
					</div>
					
					<form enctype=multipart/form-data name=individual id=individual action='".$form_action."' method=post onsubmit=\"action.value='individual'; if(checkForm(this))return true; else{showDialod(); return false;}\">
						<input type=hidden name=action value=''>
						<input type=hidden name=stroy value='".$stroy."'>
						
						".project("individual")."
						
						<fieldset>
							<legend>Предприниматель</legend>
							<table>
								<tr><td width=25% class=b>Название:<br><span class=subtext>например: ИП Иванов Иван Иванович</span></td><td><input type=text name=org_name class=t value='" . (isset($_POST["ip_name"]) ? $_POST["ip_name"] : '') . "'><div id=org_name_div_individual class=er></div></td></tr>	
								<tr><td class=b>Фамилия:</td><td><input type=text name=family class=t value='" . ((isset($reg[0]["family"]) && $reg[0]["family"] != "") ? $reg[0]["family"] : (isset($_POST["family"]) ? $_POST["family"] : '')) . "'><div id=family_div_individual class=er></div></td></tr>
								<tr><td class=b>Имя:</td><td><input type=text name=name class=t value='" . ((isset($reg[0]["name"]) && $reg[0]["name"] != "") ? $reg[0]["name"] : (isset($_POST["name"]) ? $_POST["name"] : '')) . "'><div id=name_div_individual class=er></div></td></tr>
								<tr><td class=b>Отчество:</td><td><input type=text name=patronymic class=t value='" . ((isset($reg[0]["patronymic"]) && $reg[0]["patronymic"] != "") ? $reg[0]["patronymic"] : (isset($_POST["patronymic"]) ? $_POST["patronymic"] : '')) . "'><div id=patronymic_div_individual class=er></div></td></tr>
								<tr><td class=b>Свидетельство о регистрации №:</td><td><input type=text name=svidetelstvo class=t value='" . (isset($_POST["svidetelstvo"]) ? $_POST["svidetelstvo"] : '') . "'><div id=svidetelstvo_div_individual class=er></div></td></tr>	
								<tr><td class=b>Кем выдано:</td><td><textarea name=kem_vidan>" . (isset($_POST["kem_vidan"]) ? quote_cuter($_POST["kem_vidan"]) : '') . "</textarea><div id=kem_vidan_div_individual class=er></div></td></tr>	
								<tr><td class=b>Дата выдачи:</td><td><input type=text name=data_vidachy class='t postform_datepicker' value='" . (isset($_POST["data_vidachy"]) ? $_POST["data_vidachy"] : '') . "'><div id=data_vidachy_div_individual class=er></td></tr>	
								<tr><td class=b>ИНН:</td><td><input type=text name=inn class=t value='" . (isset($_POST["inn"]) ? $_POST["inn"] : '') . "'><div id=inn_div_individual class=er></div></td></tr>	
								"./*<tr><td class=b>КПП:</td><td><input type=text name=kpp class=t value='" . (isset($_POST["kpp"]) ? $_POST["kpp"] : '') . "'><div id=kpp_div_individual class=er></div></td></tr>*/"	
								<tr><td class=b>Юридический адрес:</td><td><textarea name=yur_adr>" . (isset($_POST["yur_adr"]) ? $_POST["yur_adr"] : '') . "</textarea><div id=yur_adr_div_individual class=er></div></td></tr>	
							</table>	
						</fieldset>
						
						".bank("individual")."
						".contacts("individual")."
						".forDillers("individual")."
						
						" . ((host(0) == "postroi" || host(0) == "deltaplans")?
								"<div align='center'>
									<a class='show_all w' onclick=$(document.forms[".first_form(3)."]).submit()><b class='show_all_left fl'></b><b class='show_all_center fl'>Заказать</b><b class='show_all_right fl'></b></a>
								</div>":
								"<table><tr><td width=25% ></td><td><input type=image src=/i/send.jpg></td></tr></table>") . "

					</form>
				</div>
			</div> 
		</div>";
	
	}	else $content = "
		<p>
			<b>Спасибо за заказ</b>, ваша заявка отправлена на обработку. В ближайшее время наши <b>менеджеры свяжутся с Вами</b>.<br>
			На указанный Вами email было <b>выслано письмо с подтверждением</b>.
		</p>
		$message
	";
	//***************************************************************************************************
	
	if(!(isset($diler_script) && $diler_script == 1))
		include("t/t0.php");
	else
		echo $content;
?>