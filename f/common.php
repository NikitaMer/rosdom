<?php
	define('SITE_TEMPLATE_PATH','/bitrix/templates/rosdom');
	function debmes($message, $title = false, $ip = '195.239.55.30', $color = '#008B8B')
	{
		#$ip = false;
		
		$arIp = array(
			//'46.42.35.238',
			'87.239.29.86',
			//'95.55.158.169',
			'188.255.73.147',
			'195.239.55.30'
			#$ip
		);
		if(in_array($_SERVER['REMOTE_ADDR'],$arIp))
		{
			echo '<table border="0" cellpadding="5" cellspacing="0" style="border:1px solid '.$color.';margin:2px;"><tr><td>';
			if (strlen($title)>0)
			{
				echo '<p style="color: '.$color.';font-size:11px;font-family:Verdana;">['.$title.']</p>';
			}
		
			if (is_array($message) || is_object($message))
			{
				echo '<pre style="color:'.$color.';font-size:11px;font-family:Verdana;">'; print_r($message); echo '</pre>';
			}
			else
			{
				echo '<p style="color:'.$color.';font-size:11px;font-family:Verdana;">'.$message.'</p>';
			}
		}

	
		echo '</td></tr></table>';
	}
	function makeGeoParam($cookie_spliter) {
		
		global $_SERVER, $is_local;

		$geo_param = array();

		if(!$is_local) {
			if($_SERVER['REMOTE_ADDR'] != '') {
				preg_match_all("/([^\.]*)\.([^\.]*)\.([^\.]*)\.([0-9]*)/", $_SERVER['REMOTE_ADDR'], $ip_matches, PREG_SET_ORDER);
				$blocked_ip = $ip_matches[0][1] * 256 * 256 * 256 + $ip_matches[0][2] * 256 * 256 + $ip_matches[0][3] * 256 + $ip_matches[0][4];
				$geo_q = "SELECT 
					
					geo_cidr_optim.id as id,

					geo_countrys.id as country_id, 
					geo_countrys.alpha2 as alpha2, 
					geo_countrys.name as country, 
					
					geo_districts.id as district_id,
					geo_districts.name as district, 
					
					geo_regions.id as region_id,
					geo_regions.name as region, 
					
					geo_towns.id as town_id,
					geo_towns.name as town

					FROM geo_cidr_optim 

					LEFT JOIN geo_cities 	ON geo_cidr_optim.cities_id = geo_cities.id
					LEFT JOIN geo_countrys 	ON geo_cidr_optim.country_id = geo_countrys.id
					LEFT JOIN geo_districts ON geo_cities.district_id = geo_districts.id
					LEFT JOIN geo_regions 	ON geo_cities.region_id = geo_regions.id
					LEFT JOIN geo_towns 	ON geo_cities.town_id = geo_towns.id
					
					WHERE CAST(geo_cidr_optim.block1 AS UNSIGNED)<=" . $blocked_ip . " and CAST(geo_cidr_optim.block2 AS UNSIGNED)>=" . $blocked_ip;

				$geo_res = query($geo_q); 

				if($geo_row = mysql_fetch_assoc($geo_res)) {
					$geo_param = array(
						'id' 			=> $geo_row['id'], 

						'country_id'	=> $geo_row['country_id'], 
						'alpha2' 		=> $geo_row['alpha2'], 
						'country' 		=> $geo_row['country'], 
						
						'district_id'	=> $geo_row['district_id'], 
						'district' 		=> $geo_row['district'], 
						
						'region_id'		=> $geo_row['region_id'], 
						'region' 		=> $geo_row['region'],
						
						'town_id' 		=> $geo_row['town_id'],
						'town' 			=> $geo_row['town'],
					);

					setcookie('geo_param_' . host(0), 
						$geo_param['id'] . $cookie_spliter . 
						
						$geo_param['country_id'] . $cookie_spliter . 
						$geo_param['alpha2'] . $cookie_spliter . 
						$geo_param['country'] . $cookie_spliter . 

						$geo_param['district_id'] . $cookie_spliter . 
						$geo_param['district'] . $cookie_spliter . 

						$geo_param['region_id'] . $cookie_spliter . 
						$geo_param['region'] . $cookie_spliter . 
						
						$geo_param['town_id'] . $cookie_spliter . 
						$geo_param['town'],

						time()+3600*24*365, '/');
				}
			}
		}

		return $geo_param;
	}


	function pointer($f) {
		$t = mb_strstr($f, '_', true);
		return $t . '.' . substr($f,strlen($t) + 1);
	}
	
	function substrq($q){
		return substr($q, 0, strlen($q) - 2);
	}
	
	function rounder($x, $r = 1) {
		return round($x/$r)*$r;
	}

	function generatePassword($length = 8){
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$numChars = strlen($chars);
		$string = '';
		for ($i = 0; $i < $length; $i++) {
			$string .= substr($chars, rand(1, $numChars) - 1, 1);
		}
		return $string;
	}

	function get_otl1($field) {
		global $_COOKIE, $_SESSION;
		
		//Выбираем что есть в куках
		if(isset($_COOKIE[$field])) $v = $_COOKIE[$field];
		else $v = "";
		
		//Выбираем что есть в базе
		if(empty($_SESSION['session_id']) || empty($_SESSION['session_login']))
			$v1 = "";
		else
			$v1 = query1("select " . $field . " from users where
					id='" . $_SESSION['session_id'] . "' and
					email='" . $_SESSION['session_login'] . "' and
					status > 0 and
					site='" . host(1) . "'");
		
		//Микшируем
		if($v1 != "" && $v != "") $v = $v1 . "," . $v;
		if($v1 != "" && $v == "") $v = $v1;
		
		//Уникализируем
		if(strpos($v, ",") > -1) {
			$a = preg_split("/,/", $v);
			$a = array_unique($a);
			$v = implode(",", $a);
		}
		else {
			if($v != "")$a[0] = $v;
			else $a = array();
		}
		return $a;
	}

	
	function get_otl2($field, $a) {
		global $_GET;
		
		$v = implode(',', $a);
		
		//Действия
		if(isset($_GET["m"]) && isset($_GET["p"])) {
		
			$p = strtolower(substr($_GET["p"], 4, strlen($_GET["p"])-4));
		
			if(preg_match("/^[a-z]\-[0-9]{3,4}\-[0-9][a-z]$/", $p)) {
					
				if($_GET["m"] == "add"){
					if($v == "") $v = $p;
					else $v = $p . "," . $v;
				}
					
				if($_GET["m"] == "del") {
					if($v != "") {
						$v = str_replace($p, "", $v);
						while(strpos($v, " ") > -1)$v = str_replace(" ", "", $v);
						while(strpos($v, ",,") > -1)$v = str_replace(",,", ",", $v);
						if(substr($v,0,1) == ",")$v = substr($v,1,strlen($v)-1);
						if(substr($v,strlen($v)-1,1) == ",")$v = substr($v,0,strlen($v)-1);
					}
				}
					
				if(strpos($v, ",") > -1) {
					$a = preg_split("/,/", $v);
					$a = array_unique($a);
					$v = implode(",", $a);
				}
				else {
					$a = array();
					if($v != "")$a[0] = $v;
				}
			}
		}
		
		return $a;
	}

	function h1block($h1, $row) {
		global $REQUEST_URI, $projects_dir;
		$a1 = get_otl1('selected_projects');
		$a2 = get_otl1('sravn_projects');
		$row0 = count($row) ? $row[0] : '';
		return "
			<div class='w mb5'>
				<div class='fl pt5' id='h1_block'>" . (($REQUEST_URI != '/')?breadcrumbs($row0):"") . "<h1>" . $h1 . "</h1></div>
				<div class='fl w' id='otl_block'>
					<img id='home_top' class='fr' src='/i2/otl.png' />
					<span class='fr' id='otl_dks_span'>
						<a href='/" . $projects_dir . "/otl/' id='otl_top'>Отложенные (" . count($a1) . ")</a><br />
						<a href='/" . $projects_dir . "/sravn/' id='sravn_top'>Сравнение (" . count($a2) . ")</a>
					</span>
				</div>
			</div>
		";
	}

	function what_forms() {
		return "<script>var cont=''; for(var f=0; f<document.forms.length; f++)cont = cont + document.forms[f].name + ': ' + f + '\\r'; alert(cont);</script>";
	}
	
	function first_form($n) {
		global $_SESSION;
		if(!empty($_SESSION['session_id']) && !empty($_SESSION['session_login'])){
			$first_form = 1;
		}
		else 
			$first_form = 2;
		
		return $first_form + ($n - 1);
	}
	
	function captcha_form() {
		
		$c = "
			<form class='captcha_form'>
				<fieldset>
					<legend></legend>
					<table>
						<tr>
							<td class='b lftd'>Введите код на картинке:</td>
							<td class='rftd'>
								<iframe frameborder='0' id='captcha' name='captcha' src='/captcha.php' align='absmiddle' style='width:120px; height:60px;'></iframe>
								<img src='/i2/reload.gif' align='absmiddle' onclick=\"document.getElementById('captcha').src='/captcha.php'\" style='cursor:pointer;margin-right:10px;'>
								<input type='text' id='captcha_code_common' name='captcha_code_common' style='width:10%'>
								<div class='er'>".$_POST["captcha_code_error_message"]."</div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<a class='show_all w' onclick=\"
									var n = 2;
									if(document.forms.length > 3)
										n = parseInt($('#tabs').data('activeTab')) + ".first_form(1).";
									var f = document.forms[n];
									var el = document.getElementById('captcha_code_common');
									f.captcha_code.value = el.value;
									$(f).submit();
									\" style='cursor:pointer;'><b class='show_all_left fl'></b><b class='show_all_center fl'>Регистрация</b><b class='show_all_right fl'></b></a>
							</td>
						</tr>
					</table>
				</fieldset>
			</form>";
		return $c/* . what_forms()*/;
	}


	function yesno($b) {
		if($b == 1 || $b == true) return 'Есть';
		else return 'Нет';
	}

	function breadcrumbs($project = '') {
		global $projects_dir, $v, $pl, $h1; 
		
		$c = "<span class='breadcrumbs'><a style='margin-left:0' href='/'>Главная</a>";
		
		if($v[0] == "projects")	{
			
			if(count($v) == 1)$c .= "/<b>Каталог проектов</b>";
			else {
				$c .= "/<a href='/" . $projects_dir . "/'>Каталог проектов</a>";
				
				if($project != '') $l = strtolower(substr($project['id'], strlen($project['id']) - 1, 1));
				else $l = $v[1];
				
				if(count($v) == 2 && ($v[1] == "p" || $v[1] == "k" || $v[1] == "d" || $v[1] == "s" || $v[1] == "m")) 
					$c .= "/<b>" . strip_tags(main_categorys($l)) . "</b>";
				else{	
					if($v[1] == 'otl' || $v[1] == 'sravn' || $v[1] == 'num')$c .=  "/<b>" . $h1 . "</b>";
					else {
						$c .= "/" . main_categorys($l);
						
						if(count($v) == 3) {
							for($i = 0; $i < count($pl); $i++){
								if($v[2] == $pl[$i][1])
									$c .= "/<b>" . $pl[$i][0] . "</b>";
							}
						}
						
						if(strlen($v[1]) > 1) {
							$c .= "/<a href='/" . $projects_dir . "/" . strtolower(substr($project['id'], strlen($project['id']) - 1, 1)) . "/";
							if($project['o_pl'] < 150)
								$c .= $pl[0][1] . "/'>" .	$pl[0][0] . "</a>";
							else if($project['o_pl'] >= 150 and $project['o_pl'] < 250)
								$c .= $pl[1][1] . "/'>" .	$pl[1][0] . "</a>";
							else if($project['o_pl'] >= 250 and $project['o_pl'] < 400)
								$c .= $pl[2][1] . "/'>" .	$pl[2][0] . "</a>";
							else
								$c .= $pl[3][1] . "/'>" .	$pl[3][0] . "</a>";
							$c .= "/<b>" . strtoupper($project['id']) . "</b>";
						}
						
					}
					
				}
			}
		}
		else {
			if($v[0] == "staty") {
				if(count($v) == 1)$c .= "/<b>Статьи</b>";
				else
					$c .= "/<a href='/staty/'>Статьи</a>/<b>" . $h1 . "</b>";
			}
			elseif($v[0] == "obzores") {
				if(count($v) == 1)$c .= "/<b>Обзоры проектов</b>";
				else
					$c .= "/<a href='/obzores/'>Обзоры проектов</a>/<b>" . $h1 . "</b>";
			}
			else
				$c .= "/<b>" . $h1 . "</b>";

		}
		
		
		
		$c .= "</span>";
		return $c;
	}

	function through($p){
		$res = query("select * from b_through where date='".date("Y-m-d")."' and site='2'");
		if($row = mysql_fetch_assoc($res))query("update b_through set ".$p."='".($row[$p]+1)."' where id='".$row["id"]."'");
		else{
			$p_line1 = $p_line2 = "";
			for($i=1;$i<=5;$i++){
				$pi = "p".$i;
				if($p == $pi)$$pi = 1;
				else $$pi = 0;
				$p_line1 .= ",p".$i;
				$p_line2 .= ",'".$$pi."'";
			}
			query("insert into b_through (date,site".$p_line1.") values (now(),'2'".$p_line2.")");
		}
		return;
	}
	
	/*
	function clicker($p){
		$clickId = 0;
		$res = query("select * from b_click where date='".date("Y-m-d")."' and site='2'");
		if($row = mysql_fetch_assoc($res))
		{
			query("update b_click set ".$p."='".($row[$p]+1)."' where id='".$row["id"]."'");
			$clickId = $row["id"];
		}
		else{
			$p_line1 = $p_line2 = "";
			for($i=1;$i<=15;$i++){
				$pi = "p".$i;
				if($p == $pi)$$pi = 1;
				else $$pi = 0;
				$p_line1 .= ",p".$i;
				$p_line2 .= ",'".$$pi."'";
			}
			query("insert into b_click (date,site".$p_line1.") values (now(),'2'".$p_line2.")");
			$clickId = mysql_insert_id();
		}
		query("insert into b_users (click,ip,refer,p) values ($clickId,'".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_REFERER']."','$p')");
		return;
	}
	*/
	
	function get_clicker_url($site, $banner, $user_id = '', $geo_id = '', $slash = '/') { 
		$ret = "/b.php?url=http://" . $site . $slash . "&p=" . $banner;  
		if($user_id != '') $ret .= "&u=" . $user_id;
		if($geo_id != '') $ret .= "&g=" . $geo_id;
		return $ret;
	}

	function clicker($p, $uid = '', $geo_id = '') {
		global $_COOKIE;
		
		//Клики считаются только для включенных куки
		if($_COOKIE['cookie'] == 'ok') {
			
			//Если кука уже есть и время менее 30 сек, то клик не считаем
			if(isset($_COOKIE[$p]) && !empty($_COOKIE[$p]))
				if((time() - $_COOKIE[$p]) < 30) 
					return;
			
			//Иначе считаем, если в реферере есть адрес нашего сайта
			if(strpos($_SERVER['HTTP_REFERER'], host(0) . '.ru') > 0) {
				query("insert into b_stat (ip, refer, banner, data, site, geo_id, user_id) values ('" . 
					$_SERVER['REMOTE_ADDR'] . "','" . 
					$_SERVER['HTTP_REFERER'] . "','$p','" . 
					date("Y-m-d") . "','" . 
					host(1) . "'," . 
					setnull($geo_id) . "," .
					setnull($uid) . ")");
				setcookie($p, time(), time()+3600*24*365, '/');
				return;
			}
			
		}
	}

	function mysqlLog($mysql_error) {
		$filename = 'admin/mysqlerror.log';
		$file = fopen($filename, "a");
		if($file)
			fputs($file, date("Y-m-d G:i:s") . ';' . $_SERVER["REMOTE_ADDR"] . ';' .	$_SERVER["REQUEST_URI"] . ';' . $mysql_error . "\n\r");
		fclose($file);
		return $mysql_error;
	}

	function mysql_connections($mode) {
		global $is_local;

		$hostname = "mysql.baze.rosdom.ru:63431"; 
		$username = "root"; 
		$dbname = "jazzman9";
		$password = "y5zmikoANY";

		$mysql_link = MYSQL_PCONNECT($hostname,$username,$password) OR DIE(mysqlLog("Не могу создать соединение (" . mysql_error() . ")"));
		@mysql_select_db("$dbname") or die(mysqlLog("Не могу выбрать базу данных "));
		query("set names 'cp1251'");
		return $mysql_link;
	}


	function print2me($c){
		if($_SERVER['REMOTE_ADDR'] == "85.93.152.6" || $_SERVER['REMOTE_ADDR'] == "89.111.182.73" || $_SERVER['REMOTE_ADDR'] == "127.0.0.1")
			print "<p>".$c."</p>";
	}
	
	function addlogo($imgfile,$logofile,$resfile,$quality,$align){
		$logofile_size = getimagesize($logofile);
		$imgfile_size = getimagesize($imgfile);
		$logo = imagecreatefrompng($logofile);
		
		if($align == "righttop"){$x = $logofile_size[0]-$imgfile_size[0]; $y = 0;} //righttop
		else {$x = 0; $y = 0;} //lefttop
		
		if($quality != ""){
			$img = imagecreatefromjpeg($imgfile);
			imagecopy($img,$logo,0,0,$x,$y,$imgfile_size[0],$imgfile_size[1]);
			imagejpeg($img,$resfile,$quality);
		}
		else{
			$img = imagecreatetruecolor($imgfile_size[0],$imgfile_size[1]);
			$img_gif = imagecreatefromgif($imgfile);
			imagecopy($img,$img_gif,0,0,0,0,$imgfile_size[0],$imgfile_size[1]);
			imagecopy($img,$logo,0,0,$x,$y,$imgfile_size[0],$imgfile_size[1]);
			imagetruecolortopalette($img,false,128);
			imagegif($img,$resfile);
			imagedestroy($img_gif);
		}
		
		imagedestroy($img);
		imagedestroy($logo);
	}
	
	function img_resize($type,$src_file,$des_file,$des_width1,$des_width2){
		//Открываем картинку
		if($type == "gif")$src = imagecreatefromgif($src_file);
		else $src = imagecreatefromjpeg($src_file);
		
		//Узнаем размер
		$w_src = imagesx($src); 
		$h_src = imagesy($src);
		
		//если больше 200
		if($w_src > $des_width1){
			$ratio = $w_src/$des_width1; 
			$w_dest = round($w_src/$ratio); 
			$h_dest = round($h_src/$ratio);
			
			$dest = imagecreatetruecolor($w_dest,$h_dest); 
			imagecopyresized($dest,$src,0,0,0,0,$w_dest,$h_dest,$w_src,$h_src); 
			
			if($type == "gif")imagegif($dest,$des_file); 
			else imagejpeg($dest,$des_file,75); 
			imagedestroy($dest);
		
			if($w_src > $des_width2){
				$ratio = $w_src/$des_width2; 
				$w_dest = round($w_src/$ratio); 
				$h_dest = round($h_src/$ratio);
				
				$dest2 = imagecreatetruecolor($w_dest,$h_dest); 
				imagecopyresized($dest2,$src,0,0,0,0,$w_dest,$h_dest,$w_src,$h_src); 
				
				if($type == "gif")imagegif($dest2,$src_file); 
				else imagejpeg($dest2,$src_file,75);
				imagedestroy($dest2);
			}
			 
			imagedestroy($src);
			return 1;
		}
		imagedestroy($src);
		return 0;
	}

	function main_categorys($l){
		global $projects_dir;
		if($l == "k") $c = "<a href='/" . $projects_dir . "/" . $l . "/'>Проекты кирпичных домов</a>";
		if($l == "s") $c = "<a href='/" . $projects_dir . "/" . $l . "/'>Проекты каркасных домов</a>";
		if($l == "p") $c = "<a href='/" . $projects_dir . "/" . $l . "/'>Проекты пенобетонных домов</a>";
		if($l == "d") $c = "<a href='/" . $projects_dir . "/" . $l . "/'>Проекты деревянных домов</a>";
		if($l == "m") $c = "<a href='/" . $projects_dir . "/" . $l . "/'>Проекты монолитных домов</a>";
		return $c;
	}
	
	function tags($id,$name){
		global $projects_dir,$projects_dir,$v;
		if(count($v) != 0){
			$content = "<i>Теги:</i> <a href=/>проекты домов</a>, <a href=/>проекты коттеджей</a>, <a href=/>проекты загородных домов</a>";
			if($v[0] == $projects_dir && count($v) > 1){
				$content .= ", <a href=/projects/>каталог проектов домов</a>";

				$l = strtolower(substr($id, strlen($id)-1, 1));
				$content .= ", " . strtolower(main_categorys($l));

				if(strpos(" ".$name, "61")>0)$content .= ", <a href=/town/>проекты таунхаусов и блокированных домов</a>";
				if(strpos(" ".$name, "62")>0)$content .= ", <a href=/2s/>проекты домов на две семьи</a>";
				if(strpos(" ".$name, "63")>0)$content .= ", <a href=/uzk/>проекты узких домов</a>";
				if(strpos(" ".$name,"105")>0)$content .= ", <a href=/one/>проекты одноэтажных домов</a>";
				if(strpos(" ".$name, "60")>0)$content .= ", <a href=/bany/>проекты бань</a>";
				if(strpos(" ".$name, "142")>0)$content .= ", <a href=/mansions/>проекты особняков</a>";
				if(strpos(" ".$name, "143")>0)$content .= ", <a href=/poriz/>проекты домов из теплой керамики</a>";
				if(strpos(" ".$name, "124")>0)$content .= ", <a href=/doma_pod_kljuch/>проекты домов под ключ</a>";
			}
			
			if($v[0] == "staty" && count($v) > 1)$content .= ", <a href=/staty/>cтатьи по строительству и проектам домов</a>";
			
			if($v[0] == "design" && count($v) > 1)$content .= ", <a href=/design/>дизайн интерьера коттеджа, отделка фасадов</a>";

			$content .= "<br>";
			return($content);
		}
		else return;
	}
	
	function project_cat($row) {
		//Материал
		$l = strtolower(substr($row['id'], strlen($row['id'])-1, 1));
		$c = strtolower(main_categorys($l)) . ", ";
		
		//Этажей
		if($row['flores'] != ''){
			$f = substr($row['flores'], 0, 1);
			if($f == 1) $c .= "<a href='/one/'>проекты одноэтажных домов</a>, ";
			if($f == 2) $c .= "<a href='/two/'>проекты двухэтажных домов</a>, ";
			if($f == 3) $c .= "<a href='/three/'>проекты трехэтажных домов</a>, ";
			if($f == 4) $c .= "<a href='/four/'>проекты четырехэтажных домов</a>, ";
			
			//Цоколь, мансарда
			if(substr($row['flores'], 1, 1) == 1) $c .= "<a href='/cokol/'>проекты домов с цокольным этажом</a>, ";
			if(substr($row['flores'], 2, 1) == 1) $c .= "<a href='/mansarda/'>проекты домов с мансардой</a>, ";
		}
		
		if(strpos($row['name'], '61') > -1) 
			$c .= "<a href='/town/'>проекты таунхаусов и блокированных домов</a>, ";
		if(strpos($row['name'], '62') > -1)
			$c .= "<a href='/2s/'>проекты домов на две семьи</a>, ";
		if(strpos($row['name'], '63') > -1)
			$c .= "<a href='/uzk/'>проекты узких домов</a>, ";
		if(strpos($row['name'], '60') > -1)
			$c .= "<a href='/bany/'>проекты бань</a>, ";
		if(strpos($row['name'], '142') > -1)
			$c .= "<a href='/mansions/'>проекты особняков</a>, ";
		if(strpos($row['name'], '143') > -1)
			$c .= "<a href='/poriz/'>проекты домов из поризованного камня (RAUF, KNAUF)</a>, ";
		if(strpos($row['name'], '644') > -1)
			$c .= "<a href='/garages/'>проекты гаражей</a>, ";
		if(strpos($row['name'], '645') > -1)
			$c .= "<a href='/arbors/'>проекты беседок</a>, ";
		if(strpos($row['name'], '140') > -1)
			$c .= "<a href='/pools/'>проекты бассейнов</a>, ";
		if(strpos($row['name'], '124') > -1)
			$c .= "<a href='/doma_pod_kljuch/'>проекты домов под ключ</a>, ";
		
		return substr($c, 0, strlen($c)-2);
	}
	
	function deldubl($txt1,$txt2){
		$deld = preg_replace("/".$txt2.$txt2."/",$txt2,$txt1);
		if(strlen($deld) < strlen($txt1))$deld = deldubl($deld,$txt2);
		return $deld;
	}
	
	function replsimb1($txt2){
		$replsimb = $txt2;
		$replsimb = preg_replace ("/,/",".",$replsimb);
		$replsimb = preg_replace ("/;/",".",$replsimb);
		$replsimb = preg_replace ("/:/",".",$replsimb);
		return $replsimb;
	}

	function delfirst($txt){
		$retval = "+".$txt;
		$i1 = strpos($retval,"<BR>");
		if($i1 == 1){
			$retval = substr($retval,5,strlen($retval)-5);
		}
		else $retval = $txt; 
		$retval = "+".$retval;
		$i1 = strpos($retval," ");
		if($i1 == 1)$retval = substr($retval,1,strlen($retval)-1);
		else $retval = substr($retval,1,strlen($retval)-1);
		if(strlen($retval) < strlen($txt))$retval = delfirst($retval);
		return $retval;
	}

	function getfirst1($txt,$n,$st="<br>"){
		$ret_val = "";
		if($txt == "")return $ret_val;
		
		$txt=preg_replace("/\r\n/","<br>",$txt);
		
		$txt = strip_tags($txt,"<BR>");
		$txt = strip_tags($txt,"<br>");
		
		$txt = deldubl($txt,"<BR>");
		$txt = deldubl($txt,"<br>");
		
		$txt = delfirst($txt);
		
		$txt1 = $txt;

		if(strlen($txt1) > $n){
			$oldlen = strlen($txt1);
			$txt2 = replsimb1(substr($txt1,0,$n));
			$i1 = strrpos($txt2,".");

			if(($i1 < 25 || $i1 == 25) && $oldlen>25){
				$txt2 = replsimb1($txt1);
				$i1 = strpos($txt2,".",25);
			}

			if($i1 > 0){
				$ret_val = substr($txt1,0,$i1);
				if($oldlen>$n && $txt1[$i1]!=".")$ret_val .= "...";
				else $ret_val .= ".";
			}
			else{
				$txt2 = ereg_replace(" ",".",ereg_replace(chr(13)," ",ereg_replace(chr(10)," ",$txt1)));
				$i1 = strrpos($txt2,".");
				if($i1 > 0){
					$ret_val = substr($txt1,0,$i1);
					if($oldlen>$n)$ret_val .= "...";
					else $ret_val .= ".";
				}
			}
			return $ret_val;
		}
		else return $txt1;
	}

	function regular(){
		if(host(1) == 1)return "1_______";
		if(host(1) == 2)return "_1______";
		if(host(1) == 3)return "__1_____";
		if(host(1) == 4)return "___1____";
		if(host(1) == 5)return "____1___";
		if(host(1) == 6)return "_____1__";
		if(host(1) == 7)return "______1_";
		if(host(1) == 8)return "_______1";
	}

	function setnull($t, $null = 'NULL'){
		$t = trim($t);
		if($t == "")return $null;
		else return "'$t'";
	}

	function project_p($project){
		global $projects_dir, $zerk, $request, $date2;
		
		//if(host(0) == "catalog-domov")$prj = strtolower($project[0]["dillername"]);
		//else 
			$prj = strtolower($project[0]["id"]);
		
		if($date2 <= $project[0]['dt'] && (host(0) == 'postroi' || host(0) == 'masterov'))
			$viz = "<div style='position:relative'><img src='/i2/new.gif' style='position:absolute; left:0; top:0;' />";
		else
			$viz = "";

		if($zerk == 1)
			$viz .= "<img id=viz class=p src=/mirror.php?imgurl=" .
				$projects_dir . "/" . $prj . "/" . substr($project[0]["prev"],0,strlen($project[0]["prev"])-7).".jpg " . alt_title($project[0]) . " />";
		else 
			$viz .= "<img id=viz class=p src=/" .
				$projects_dir . "/" . $prj ."/" . substr($project[0]["prev"],0,strlen($project[0]["prev"])-7).".jpg " . alt_title($project[0]) . " />";
		
		if($date2 <= $project[0]['dt'] && (host(0) == 'postroi' || host(0) == 'masterov'))
			$viz .= "</div>";


		if(host(0) == "catalogdomov" || host(0) == "postroi")$ret = $viz;
		else{
		
			$counter = 0;
			for($i=0;$i<5;$i++){
				if($i == 0)$i = "";
				if(file_exists("$projects_dir/$prj/".substr($project[0]["prev"],0,strlen($project[0]["prev"])-4).$i.".jpg"))$counter++;
			}

			if($counter < 2)$ret = $viz;
			else{
				$ret = "
				<table cellpadding=0 cellspacing=0 border=0>
					<tr valign=top>
						<td>$viz</td>
						<td width=120>
							<div style='padding:3px 3px 80px 0px; background:url(/i2/rightzoom.jpg) center bottom no-repeat #e0e4ec;'>";
								for($i=0;$i<5;$i++){
									if($i == 0)$i = "";
									if(file_exists("$projects_dir/$prj/".substr($project[0]["prev"],0,strlen($project[0]["prev"])-4).$i.".jpg")){
										$ret .= "
											<img src='/$projects_dir/$prj/".substr($project[0]["prev"],0,strlen($project[0]["prev"])-4).$i.".jpg"."'
												onclick=\"document.getElementById('viz').src='/$projects_dir/$prj/".substr($project[0]["prev"],0,strlen($project[0]["prev"])-7).$i.".jpg'\"
												style='width:100px; margin:0 2px 2px 2px; cursor:pointer;'
												onmouseover=\"this.style.width='110px'\"
												onmouseout=\"this.style.width='100px'\"
											><br>";
									}
								}
								$ret .= "
							</div>
						</td>
					</tr>
				</table>";
			}
		}
		return $ret;
	}
	
	function project_des($des,$project){
		global $project_h2_des;
		if($des != "" && $project[0][$des] != ""){
			return "<h2>".$project_h2_des."</h2>
			<p id='des' style='height:55px;overflow:hidden;zoom:1;'>".$project[0][$des]."</p>
			<p><u style='cursor:pointer;color:#0082c4;' onclick=\"
				if($('#des').css('height') == '55px'){
					$('#des').css('height','auto');
					$(this).html('Свернуть');
				}
				else{
					$('#des').css('height','55px');
					$(this).html('Читать далее');
				}
				\">Читать далее</u></p>";
		}
		else return "";
	}

	function project_mater($project,$rashod){
		global $project_h2_mater1,$project_h2_mater2, $geo_param;
		$m = mater($project[0]["mater"]);
		$c = "
			<table class=mater cellpadding=0 cellspacing=0>
				<tr valign=top>
					<td class=matertd>
						<h2>".$project_h2_mater1.":</h2>

						<p class='material'>".$m;
					
						//--- Ай-Гуру ---
						
						if(dater(date('d.m.Y')) >= dater('01.09.2013') && dater(date('d.m.Y')) <= dater('30.11.2013')) {
							$prjtype = strtolower(substr($project[0]["id"],strlen($project[0]["id"])-1,1));
							if(host(0) == "postroi"){
								$m = str_replace("\r","",$m);
								$m = str_replace("\n","",$m);
								while(strpos($m,"  ") > -1)$m = str_replace("  "," ",$m);
								if(substr($m,strlen($m)-4,4) != "<br>")$c .= "<br>";
								$c .= "<a href='" . get_clicker_url('www.velux.ru/private/products/velux_roof_windows?WT.mc_id=Project-Link-postroi_materials-RW-2013', 'b_velux', '', (isset($geo_param['id']) ? $geo_param['id'] : ''), '') . "' target=_blank>
									<b>Освещение подкровельного пространства –</b> мансардные окна VELUX</a>";
							}
						}
						
						//---------------
					
						$c .= "</p>
					</td>
					<td class=matertd>";
						if(count($rashod) > 0 && (host(0) == "postroi" || host(0) == "masterov" || host(0) == "catalogdomov" || host(0) == "stroybur"  || host(1) == "8")){
							$c .= "<h2 class=rash_material>".$project_h2_mater2.":</h2>
								<table class=prices cellpadding=0 cellspacing=0>
									<tr class=head><td><b>Материал:</b></td><td><b>Кол-во:</b></td><td><b>Ед.изм.:</b></td><td><b>Комментарий:</b></td></tr>";
									for($i=0;$i<count($rashod);$i++)$c .= "<tr><td>".$rashod[$i]["name"]."</td><td>".$rashod[$i]["kol"]."</td><td>".ed($rashod[$i]["ed"])."</td><td>".(($rashod[$i]["comment"] != "")?$rashod[$i]["comment"]:"&nbsp;")."</td></tr>";
									$c .= "
								</table>";
						}
						$c .= "
					</td>
				</tr>
			</table>";
		return $c;
	}

	function project_actions($actions_set){
		global $project_h2_actions;
		if(count($actions_set)>0){
			$tr = "";
			for($i=0;$i<count($actions_set);$i++){
				if($actions_set[$i]["file"] != "" && $actions_set[$i]["showinfo"] == 1)$tr .= "
					<tr>
						<td><img src=/i2/actions/".$actions_set[$i]["file"]."></td>
						<td><b>".$actions_set[$i]["name"]."</b><br><p>".$actions_set[$i]["k_opis"]."</p></td>
					</tr>";
			}
			if($tr != "")return "<a name=actions class=anchor><h2>".$project_h2_actions." (актуально на ".date("d.m.Y")."):</h2></a><table id=actions>".$tr."</table>";
		}
	}
	
	function project_pln_fsd($project,$pln,$fsd){
		global $projects_dir, $project_h2_pln, $project_h2_fsd, $zerk, $request;
		
		//if(host(0) == "catalog-domov")$prj = strtolower($project[0]["dillername"]);
		//else 
			$prj = strtolower($project[0]["id"]);
		
		$c = "
			<table id=pln_fsd cellpadding=0 cellspacing=0>
      	<tr valign=top>
					<td style='padding-right:15px;'>";
						if(count($pln) > 0)$c .= "<h2>".$project_h2_pln."</h2>";
						for($i=0;$i<count($pln);$i++){
							if(host(0) != "catalog-zdaniy"){
								$c .= "<b>".$pln[$i]["name"]."</b>";
								if($pln[$i]["h"] > 0)$c .= " <b class=pln_h><b>высота: ".$pln[$i]["h"]." м</b></b>";
								if($zerk == 1)$c .= "<br><img class=pln src=/mirror.php?imgurl=$projects_dir/$prj/" . $pln[$i]["img"] . " " . alt_title($project[0], " - " . $pln[$i]["name"]) . " /><br>"; 
								else $c .= "<br><img class=pln src=/$projects_dir/$prj/".$pln[$i]["img"]." " . alt_title($project[0], " - " . $pln[$i]["name"]) . "><br>"; 
							}
							else{
								$ext = substr($pln[$i]["img"],strlen($pln[$i]["img"])-3,3);
								$c .= "<br><a href=/$projects_dir/$prj/".substr($pln[$i]["img"],0,strlen($pln[$i]["img"])-4)."-big.".$ext." target=_blank><img class=pln src=/$projects_dir/".strtolower($project[0]["id"])."/".$pln[$i]["img"]."></a><br>"; 
							}
						}
						$c .= "
					</td>
					<td>";
						if(count($fsd) > 0)$c .= "<h2>".$project_h2_fsd."</h2>";
						for($i=0;$i<count($fsd);$i++){
							$ext = substr($fsd[$i]["img"],strlen($fsd[$i]["img"])-3,3);
							if(host(0) != "catalog-zdaniy")$c .= "<b>".$fsd[$i]["name"]."</b>";
							if($zerk == 1)$c .= "<br><img class=fsd src=/mirror.php?imgurl=$projects_dir/$prj/".substr($fsd[$i]["img"],0,strlen($fsd[$i]["img"])-4)."-sm.".$ext." ". alt_title($project[0], " - " . $fsd[$i]["name"]) . " /><br>"; 
							else $c .= "<br><img class=fsd src=/$projects_dir/$prj/".substr($fsd[$i]["img"],0,strlen($fsd[$i]["img"])-4)."-sm.".$ext." " . alt_title($project[0], " - " . $fsd[$i]["name"]) . " /><br>"; 
						}
						$c .= "
					</td>
				</tr>
			</table>";
		return $c;
	}
	
	function project_variants($variants){
		global $projects_dir,$project_h2_vars,$REQUEST_URI,$zerk;
		
		if(count($variants) == 0 && host(0) == 'postroi') {
			$c = "<h2>".$project_h2_vars."</h2>
				<p>У этого проекта пока нет вариантов</p>";
		}
		
		if(count($variants) > 0){
			$c = "<h2>".$project_h2_vars."</h2><div id=variants>";
			
			for($i=0;$i<count($variants);$i++){
				
				if(strpos($variants[$i]["var"],"(") > 0)$zerkVar = true;
				else $zerkVar = false;
				
				$varName = $variants[$i]["var"];
				$varName = preg_replace("/\(.\)/i","",$varName);
				$varName = preg_replace("/\s/","",$varName);
				
				$varName1 = $varName;
				
				if(host(0) == "catalog-domov"){
					//$varName = query1("select dillername from projects where id like '%".$varName."%'");
					$varName1 = query1("select dillername from projects where id like '%".$varName."%'");
				}
				
				if($zerkVar){
					$v_img = "/i2/zerk.jpg";
					if($zerk == 1)$v_url = substr($REQUEST_URI,0,strlen($REQUEST_URI)-2);
					else $v_url = '';
				}
				else{
					$v_img = "/".$projects_dir."/".strtolower($varName)."/".strtolower($variants[$i]["prev"]);
					$v_url = "/".$projects_dir."/".strtolower($varName1)."/";
				}
				$c .= "
					<div class=var style='height:270px'>";
						if(!empty($v_url))$c .= "<a href=".$v_url." target=_blank>";
						$c .= "<img src=".$v_img." class=varimg alt='".str_replace(",","",strip_tags($variants[$i]["rosdom_h1"]))."' title='".str_replace(",","",strip_tags($variants[$i]["rosdom_h1"]))."'>";
						if(!empty($v_url))$c .= "</a>";
						$c .= "<br>";
						if(!empty($v_url))$c .= "<a href=".$v_url." target=_blank>";
						$c .= $variants[$i]["rosdom_h1"];
							
						/*if($zerkVar){
							if($zerk == 1)$c .= $varName1;
							else $c .= $varName1." (S)";
						}
						else*/ //$c .= $varName1;
							
						if(!empty($v_url))$c .= "</a>";
						$c .= "<br>".$variants[$i]["des"]."
					</div>"; 
			}
			
			$c .= "</div>";
		}
		return $c;
	}
	
	function project_prices($row,$actions_set,$return_mode=0){
		#debmes($return_mode);
		global $v;
		$k = 1; $action_name = ""; 
		for($i=0;$i<count($actions_set);$i++){
			if($actions_set[$i]["k"] < $k && $actions_set[$i]["k"] != "" && $actions_set[$i]["k"] != 0){
				$k = $actions_set[$i]["k"];
				$action_name = $actions_set[$i]["name"];
				$show_info = $actions_set[$i]["showinfo"];
			}
		}
		if(host(0) == "catalogdomov")$k = 1;
		
		if($return_mode == 0){
			global $printer;
			global $common_functions_dir,$project_h2_prices,$project_h2_prices_table1,$project_h2_prices_hintword,$project_h2_prices_table2;
			//include("$common_functions_dir/hints.php");
			
			$nameHint = array();
			$prt = mysql_array("select * from projects_service where type='1' and buy='1'");
			for($i=0;$i<count($prt);$i++){
				if($prt[$i]["id"] == "58"){$nameHint[0][0] = $prt[$i]["name"]; $nameHint[1][0] = $prt[$i]["hint"];} // Комплект Застройщика
				if($prt[$i]["id"] == "54"){$nameHint[0][1] = $prt[$i]["name"]; $nameHint[1][1] = $prt[$i]["hint"];} // Полный комплект чертежей
				if($prt[$i]["id"] == "55"){$nameHint[0][2] = $prt[$i]["name"]; $nameHint[1][2] = $prt[$i]["hint"];} // Архитектурно-строительные чертежи
				if($prt[$i]["id"] == "56"){$nameHint[0][3] = $prt[$i]["name"]; $nameHint[1][3] = $prt[$i]["hint"];} // Доп. комплект чертежей без лицензии
				if($prt[$i]["id"] == "57"){$nameHint[0][4] = $prt[$i]["name"]; $nameHint[1][4] = $prt[$i]["hint"];} // Паспорт проекта
			}
			
			if(host(0) == "catalogdomov"){
				$pr = array(
					array(getprice($row["pr2_cd"]),$nameHint[0][2],$nameHint[1][2]),
					array(getprice($row["pr1_cd"]),$nameHint[0][1],$nameHint[1][1]),
					array(getprice($row["pr0_cd"]),$nameHint[0][0],$nameHint[1][0]),
					array(getprice($row["pr3_cd"]),$nameHint[0][3]." <b style='color:red'>**</b>",$nameHint[1][3]),
					array(getprice($row["pr4_cd"]),$nameHint[0][4]." <b style='color:red'>**</b>",$nameHint[1][4]),
				);
			}
			elseif(host(0) == "catalog-domov"){
				$pr = array(
					array(((getprice($row["pr2_arch"]) != "------")?getprice($row["pr2_arch"]):getprice($row["pr2"])),$nameHint[0][2],$nameHint[1][2]),
					array(((getprice($row["pr1_arch"]) != "------")?getprice($row["pr1_arch"]):getprice($row["pr1"])),$nameHint[0][1],$nameHint[1][1]),
					array(((getprice($row["pr0_arch"]) != "------")?getprice($row["pr0_arch"]):getprice($row["pr0"])),$nameHint[0][0],$nameHint[1][0]),
					array(((getprice($row["pr3_arch"]) != "------")?getprice($row["pr3_arch"]):getprice($row["pr3"])),$nameHint[0][3]." <b style='color:red'>**</b>",$nameHint[1][3]),
					array(((getprice($row["pr4_arch"]) != "------")?getprice($row["pr4_arch"]):getprice($row["pr4"])),$nameHint[0][4]." <b style='color:red'>**</b>",$nameHint[1][4]),
				);
			}
			else{
				$pr = array(
					array(getprice($row["pr2"]),$nameHint[0][2],$nameHint[1][2]),
					array(getprice($row["pr1"]),$nameHint[0][1],$nameHint[1][1]),
					array(getprice($row["pr0"]),$nameHint[0][0],$nameHint[1][0]),
					array(getprice($row["pr3"]),$nameHint[0][3]." <b style='color:red'>**</b>",$nameHint[1][3]),
					array(getprice($row["pr4"]),$nameHint[0][4]." <b style='color:red'>**</b>",$nameHint[1][4]),
				);
			}
			#debmes($pr);
			$no = ""; for($i=0;$i<count($pr);$i++)$no .= $pr[$i][0];
			if(preg_match("/[0-9]/i",$no))$no = 0; else $no = 1;

			$prices = "<noindex><script>function showHint(id,s){var sdiv=document.getElementById(id); if(s){sdiv.style.display='block';} else {sdiv.style.display='none';}}</script></noindex>";
			
			if($v[1] != 'sravn') {
				if(host(0) == "postroi")$prices .= "<h2><a name='prices'>" . $project_h2_prices . "</a></h2>";
				else $prices .= "<h2>" . $project_h2_prices . "</h2>";
			
				if(host(0) == "postroi")$prices .= "<p class=prices><b>Цены</b> на ".(($printer)?"":"<a href=/>")."проекты домов, коттеджей".(($printer)?"":"</a>").", услуги и все прочие товары приведенные ниже актуальны на <b>".date("d.m.Y")."</b>.<br>
					Не следует забывать, что с течением времени цены <b>могут меняться</b>.</p>";
			}
			/*
			if($row['rosdom_description'] !== "")
				$prices .= "<p style='font-weight:bold;margin-bottom:10px;'>" . $row['rosdom_description'] . "</p>";
			*/
			$prices .= "<table class=prices cellpadding=0 cellspacing=0>";
			
			if(!$no){
				$prices .= "<tr class=head><td>$project_h2_prices_table1:</td><td>Цена (руб):</td>";
				if($k != 1 && $show_info == 1)$prices .= "<td>Цена с учетом<br>".((1-$k)*100)."% * скидки (руб.):</td>";
				$prices .= "</tr>";
				
				for($i=0;$i<count($pr);$i++){
					if($pr[$i][0] != "------"){
					
						$currentHint = " <noindex>[<span class=hint onMouseOver=showHint('hint".$i."',1) onMouseOut=showHint('hint".$i."',0)> ".$project_h2_prices_hintword." </span>
							<span class=hint1 id=hint".$i.">".$pr[$i][2]."</span>]</noindex>";
						
						$prices .= "<tr class=mainprices><td>".$pr[$i][1].(($printer || $v[1] == 'sravn')?"":$currentHint)."</td>";
							

							if($k != 1){
								if($show_info == 1){
									$prices .= "<td><s>&nbsp;".priceformat($pr[$i][0])."&nbsp;</s></td><td class=b>".priceformat($pr[$i][0]*$k)."</td>";
									if($pr[$i][1] == "Только архитектурно-строительные чертежи")$as = $pr[$i][0]*$k;
									if($pr[$i][1] == "Полный комплект чертежей")$pk = $pr[$i][0]*$k;
								}
								else{
									$prices .= "<td class=b>".priceformat($pr[$i][0]*$k)."</td>";
									if($pr[$i][1] == "Только архитектурно-строительные чертежи")$as = $pr[$i][0]*$k;
									if($pr[$i][1] == "Полный комплект чертежей")$pk = $pr[$i][0]*$k;
								}
							}
							else{
								$prices .= "<td class=b>".priceformat($pr[$i][0])."</td>";
								if($pr[$i][1] == "Только архитектурно-строительные чертежи")$as = $pr[$i][0];
								if($pr[$i][1] == "Полный комплект чертежей")$pk = $pr[$i][0];
							}
							
						
						$prices .= "</tr>";
					}
				}
			}
		
			$services = mysql_array("select 
				projects_sp.service, projects_sp.prj, projects_sp.price, projects_sp.id, projects_sp.comments,
				projects_service.id as idps,projects_service.name, projects_service.hint 
				from projects_sp 
				inner join projects_service on projects_sp.service = projects_service.id 
				where projects_sp.prj='".$row["id"]."' and projects_sp.service<>68 and projects_sp.service<>75
				order by projects_service.name");
			if(count($services) > 0){
				$prices .= "<tr class=head><td>$project_h2_prices_table2:</td><td>Цена (руб):</td>";
				if($k != 1 && $show_info == 1)$prices .= "<td></td>";
				$prices .= "</tr>";
				for($i=0;$i<count($services);$i++){
					$prices .= "<tr><td>".$services[$i]["name"]." <i>".$services[$i]["comments"]."</i>";
					if($services[$i]["hint"] != "" && !$printer && $v[1] != 'sravn')
						$prices .= "<noindex>[ <span class=hint onMouseOver=showHint('hint".$services[$i]["idps"]."',1) onMouseOut=showHint('hint".$services[$i]["idps"]."',0)>$project_h2_prices_hintword</span><span class=hint1 id=hint".$services[$i]["idps"].">".$services[$i]["hint"]."</span> ]</noindex>";
					$prices .= "</td><td class=b>".priceformat($services[$i]["price"])."</td>";
					if($k != 1 && $show_info == 1)$prices .= "<td></td>";
					$prices .= "</tr>";
				}
			}
		
			$prices .= "</table>";
			
			$prices .= "<p class=prices>";
			if($k != 1 && $show_info == 1)$prices .= "(<b style='color:red;'>*</b>) Указанная в таблице скидка относится к акции: <b>\"$action_name\"</b>. ".(($printer)?"":"Для получения скидки ознакомьтесь с <a href=#actions>условиями этой акции</a>.");
			$prices .= "<p style='color:#777'>(<b style='color:red'>**</b>) <i>Паспорт проекта</i> и <i>Доп. комплект чертежей без лицензии (копия для строителей)</i> отдельно
				от основного комплекта не продаются.";
			$prices .= "</p>";
			
			return $prices;
		}
			
		else{
			//foreach($row as $k => $v)print $k ."<br>";
			$pr_name = "";
			if(host(0) == "catalogdomov")$pr_name = "_cd";
			
			#debmes(strtolower(substr($row['id'],0,1)),host(0));
			if(strtolower(substr($row['id'],0,1)) == 'q') { 
				$qrpr = query1("select price from projects_sp where service='29' and	prj='" . strtolower($row['id']) . "'");
				if(host(0) == 'postroi') return array('Р', $qrpr);
				else return $qrpr;
			}
			
			$s = $row["pr2".$pr_name];
			#debmes($s,$k);
			if($s > 0) {
				if(host(0) == 'postroi') return array('АС', $s * $k, $s);
				else return $s * $k;
			}
			
			$s = $row["pr1".$pr_name];
			if($s > 0) {
				if(host(0) == 'postroi') return array('ПК', $s * $k, $s);
				else return $s * $k;
			}
			
		}
	}
	
	function getprice($p){
		if($p == 0)return "------";
		else return preg_replace("/\./i",",",sprintf("%.0f",$p));
	}
	
	function priceformat($p){
		$p = sprintf("%.0f",$p);
		$p = strrev($p);
		$p = preg_replace("/[0-9]{3}/i","\\0 ",$p);
		$p = strrev($p);
		return $p;
	}
	
	function sendmail($mail, $theme, $mes, $mode, $from=""){
		//0 - отправляем то что есть
		//1 - добавляем подпись
		global $root,$info_email,$manager_email,$request_email,$is_local;
		if($from == "")
			$from = "from: ".host(0).".ru <".$info_email.">\nX-Sender: <".$info_email.">\nContent-Type: text/html; charset=windows-1251";
		
		if(!$is_local){
			if($mode > 0){
				$mes .= "<br><hr>С уважением, администрация сайта <a href=$root>".host(0).".ru</a><br>";
				if(count($phones) > 0)$mes .= "Телефон: ".implode(",",$phones)."<br>";
				if(count($faxes) > 0)$mes .= "Факс: ".implode(",",$faxes)."<br>";
				$mes .= "Email: <a href='mailto:$info_email'>$info_email</a>";
			}
			return mail($mail,$theme,$mes,$from);
		}
	}

	function selected($name, $value, $label){
		$rv="<option value='$value'";
		if (($name)==($value) &&
		(is_numeric($name)&& is_numeric($value) ||
		is_string($name)&& is_string($value))
		) { $rv.=" selected"; } 
		$rv.=">$label</option>";
		return $rv;
	}
	
	function printintag($t,$tag){
		print "<" . $tag . ">" . $t . "</" . $tag . ">";
	}
	
	function mysql_array($q, $print = false){
		if($print) print '<p>' . $q . '</p>';
		$res = query($q); 
		if(!$res) echo mysqlLog(mysql_error());
		$i = 0;
		$a = array();
		while($row = mysql_fetch_assoc($res))
			$a[$i++] = $row;
		return $a;
	}
	
	function mysql_date($d, $months = false, $longmonth = false){
		$m = substr($d,5,2);
		if($months) {
			if($longmonth) {
				if($m == 1) $m = ' января ';
				if($m == 2) $m = ' февраля ';
				if($m == 3) $m = ' марта ';
				if($m == 4) $m = ' апреля ';
				if($m == 5) $m = ' мая ';
				if($m == 6) $m = ' июня ';
				if($m == 7) $m = ' июля ';
				if($m == 8) $m = ' августа ';
				if($m == 9) $m = ' сентября ';
				if($m == 10) $m = ' октября ';
				if($m == 11) $m = ' ноября ';
				if($m == 12) $m = ' декабря ';
			}
			else {
				if($m == 1) $m = ' янв ';
				if($m == 2) $m = ' фев ';
				if($m == 3) $m = ' март ';
				if($m == 4) $m = ' апр ';
				if($m == 5) $m = ' май ';
				if($m == 6) $m = ' июн ';
				if($m == 7) $m = ' июл ';
				if($m == 8) $m = ' авг ';
				if($m == 9) $m = ' сен ';
				if($m == 10) $m = ' окт ';
				if($m == 11) $m = ' ноя ';
				if($m == 12) $m = ' дек ';
			}
		}
		else
			$m = '.' . $m . '.';
	
		return substr($d,8,2) . $m . substr($d,0,4);
	}
	
	function score($score){
		if($score > 0) {
			if($score > 5)$score = 5;
			return "<b class='stars'><b style='width:" . (round($score*10-1)+1) . "px'></b></b>";
		}
		else return "";
	}
	
	function mysql_date_back($d){
		return substr($d,6,4)."-".substr($d,3,2)."-".substr($d,0,2);
	}
	
	function actions($name, $dt) {
		global $date2, $actions, $action_s10;
		
		$not_field = "";
		
		for($i = 0; $i < count($actions); $i++)
			if(strpos($name, "(" . $actions[$i]["id"] . ")") > -1 || $actions[$i]["type"] == "all")
				$not_field .= $actions[$i]["not_field"] . ",";
		
		$not_field = preg_split("/,/", substr($not_field, 0, strlen($not_field)-1));
		
		$i1 = 0; $actions_set = array();
		for($i = 0; $i < count($actions); $i++) {
			if(!in_array($actions[$i]["id"], $not_field)) {
				if($actions[$i]["type"] == "all") $actions_set[$i1++] = $actions[$i];
				if($actions[$i]["type"] == "time" && $dt > $date2) { $actions_set[$i1++] = $actions[$i]; $actions_set[$i1++] = $action_s10[0]; }
				if($actions[$i]["type"] == "selective" && strpos($name,"(".$actions[$i]["id"].")")>-1) $actions_set[$i1++] = $actions[$i];
			}
		} 
		return $actions_set;
	}

	function breif($row,$mode,$param = 0){
		global $REQUEST_URI,$projects_dir,$actions,$request,$project_h2_vars,$breif_var,$des,$newprojects_dir,$v,$last_comments,$date2;
		$id = strtolower($row["id"]);
		$dillername = strtolower($row["dillername"]);
		$actions_set = actions($row["name"],$row["dt"]);
		$actions_line = "";
		for($i=0;$i<count($actions_set);$i++){
			if($actions_set[$i]["file_zn"] != "" && $actions_set[$i]["showinfo"] == 1)
				$actions_line .= "<img src=/i2/actions/".$actions_set[$i]["file_zn"]."> ";
		}
		
		if(host(1) != 8)$prev = strtolower($row["prev"]);
		else $prev = "p.jpg";

		$c = "<div class='prj'>";
			
			if($date2 <= $row['dt'] && host(0) == 'masterov') 
				$c .= "<div style='position:relative'><img src='/i2/new2.gif' style='position:absolute; right:-1px; bottom:1px; border:0;' />";

			$c .= "
			<a href=/$projects_dir/".((host(0) != "catalog-domov")?$id:$dillername)."/><img src=/$projects_dir/"./*((host(0) != "catalog-domov")?*/$id/*:$dillername)*/."/".$prev." class=psm alt='".str_replace(",","",strip_tags($row["rosdom_h1"]))."' title='".str_replace(",","",strip_tags($row["rosdom_h1"]))."'></a>
			<br>
			<a href=/$projects_dir/".((host(0) != "catalog-domov")?$id:$dillername)."/>";

			if($date2 <= $row['dt'] && host(0) == 'masterov') $c .= "</div>";
			
		$hometype = "дома";
		if($row["o_pl"] <= 100.0)$hometype = "коттеджа";
		if($row["o_pl"] <= 60.0)$hometype = "";
		if($REQUEST_URI == "/")$hometype = "дома";
		
		if(substr($REQUEST_URI,0,14) == "/projects/num/")
			$headtext = prjname($id,$row[$request],$row["konkurents"],$row["name"],$mode,$row["dillername"],$row["archname"]);
		else 
			$headtext = "Проект $hometype ".strtoupper($row["id"]);
		
		/*  	
		if(host(0) == "postroi")$c .= $headtext;
		else{
			$c .= prjname($id,$row[$request],$row["konkurents"],$row["name"],$mode,$row["dillername"],$row["archname"]);
			if(host(0) == "catalogdomov")$c .= " (".$row["archname"].")";
		}
		*/
		$c .= $row['rosdom_h1'];

		$c .= "</a><br>";

		if($param == 0){	
  		
			if(host(0) == "postroi")$c .= "<p class=breif_des>".getfirst1($row[$des],100)."</p>";
			if(($v[0] == $newprojects_dir || $REQUEST_URI =="/") and host(0) == "postroi")$c .= "<span class=dt>[".mysql_date($row["dt"])."]</span>";
			
			if(host(0) != "catalog-zdaniy"){
				$c .= "<p class=info>
				<noindex>Общая площадь: <b>".$row["o_pl"]." м<sup>2</sup></b><br>
				Габариты: <b>".$row["h"]." x ".$row["v"]."</b><br>
				Материал: </noindex><b>".mats4breif($id)."</b><br>";

				if(host(0) == "postroi" || host(0) == "rosdom"){
					$out_pr = project_prices($row,$actions_set,1);
					if($out_pr > 0)$c .= "Цена: <b style='color:red'>".priceformat($out_pr)." руб.</b>
						<noindex>
						<a href=http://www.rosdom.ru/postform/?nproj=" . $id . " style=' padding:3px 5px; text-decoration:none; background:#aaa; color:white;'>КУПИТЬ</a>
						</noindex>";
				}
					
				$c .= "</p>";
			}
			
			$lcname = ''; $cc = '';
			if(host(0) == "postroi") { 
				$lcname = 'lastcomment'; 
				if($row['comments_count'] > 0)
					$cc = "<noindex><a href=/$projects_dir/$id/#comments style='font:10px arial; margin-left:5px; color: #777;'>всего комментариев: " . $row['comments_count'] . "</a></noindex>";
			}
			if(host(0) == "masterov") { $lcname = 'mas_lastcomment'; }
			if(host(0) == "catalogdomov") { $lcname = 'cd_lastcomment'; }
			
			if($lcname != "" && $row[$lcname] != "")
				$c .= "<table cellpadding=0 cellspacing=0 border=0 class=blnt>
					<thead><tr><td></td><td class=blnt0></td><td></td></tr></thead>
					<tbody><tr><td class=blnt1></td><td class=bg></td><td class=blnt2></td></tr>
					<tr><td class=bg></td><td class=bg>".$row[$lcname]."</td><td class=bg></td></tr>
					<tr><td class=blnt4></td><td class=bg></td><td class=blnt3></td></tr></tbody></table>" . $cc;
			
			//if($row["varkol"] > 0 && $project_h2_vars != "")$c .= "<br><div class=breif_var>".$breif_var.": <b>".$row["varkol"]."шт</b></div>";
		}

		$c .= $actions_line;
		
		$c .= "</div>";
		return $c;
	}
	
	function breif1($row, $mode, $isinhead = false){
		global $projects_dir, $request, $des;
		$id = strtolower($row["id"]);
		$actions_set = actions($row["name"],$row["dt"]);
		$actions_line = "";
		for($i=0;$i<count($actions_set);$i++){
			if($actions_set[$i]["file_zn"] != "" && $actions_set[$i]["showinfo"] == 1)
				$actions_line .= "<img src=/i2/actions/".((host(1) == 2)?str_replace('gif','png',$actions_set[$i]["file_zn"]):$actions_set[$i]["file_zn"])." alt='".$actions_set[$i]["name"]."' title='".$actions_set[$i]["name"]."'>";
		}
		$pname = prjname($id, $row[$request], $row["konkurents"], $row["name"], $mode, $row["dillername"], $row["archname"]);
		return "<div class='prj'>
			" . ((!$isinhead)?"<a href='/$projects_dir/$id/'>
				<img src='/$projects_dir/$id/p.jpg' alt='$pname' /></a><br />":"") . "
			<a class='pname' href='/$projects_dir/$id/'>$pname</a><br />
			<p>" . (($isinhead)?getFirstSimbolsBySpaces(strip_tags($row[$des]), 200) . "...<br />":"") . "
				<noindex>
					<b>Площадь:</b> ".$row["o_pl"]." м<sup>2</sup><br />
					" . (($row["varkol"] > 0)?"<b>Разновидности проекта:</b> " . $row["varkol"] . " шт<br />":"") . "
					<b>" . substr($row["flores"],0,1) . " этажа</b>, " . $row["h"] . " х " . $row["v"]." мм<br />
				</noindex>
				<b>Материал:</b> " . mats4breif($id) . "
			</p>
			<noindex><i class='act_line'>$actions_line</i></noindex>
			<div>
				<noindex>
					<a id='otl_$id' class='r5 otl mr5'>ОТЛОЖИТЬ</a>
					<a href='/postform/?nproj=$id' class='r5 buy mr5'>КУПИТЬ</a>
				</noindex>
				<span>".priceformat(project_prices($row, $actions_set, 1))."</span> руб
			</div>
		</div>";
	}
	
	function flores_word($flores) {
		if($flores == 1)$flores_word = 'этаж';
		if($flores >= 2 && $flores <= 4)$flores_word = 'этажа';
		if($flores >= 5)$flores_word = 'этажей';
		return $flores_word;
	}
	
	function mm2m($r,$n = 0) {
		return sprintf("%." . $n . "f", $r/1000);
	}
	
	function breif2($row, $mode, $isinhead = false, $class = -1){
		global $projects_dir, $request, $des, $v, $_COOKIE, $v, $hitprojects_dir, $date2, $_SERVER;

		$id = strtolower($row["id"]);
		$flores = substr($row["flores"],0,1);
		$actions_set = actions($row["name"],$row["dt"]);
		$actions_line = "";
		
		$p_recommend = false;
		

		for($i=0;$i<count($actions_set);$i++){
			if($actions_set[$i]["id"] == 23) $p_recommend = true;
			if($actions_set[$i]["file_zn"] != "" && $actions_set[$i]["showinfo"] == 1)
				$actions_line .= "<img src=/i2/actions/" . $actions_set[$i]["file_zn"] . " alt='".$actions_set[$i]["name"]."' title='".$actions_set[$i]["name"]."' class='zn'>";
		}
		$score = preg_split('/;/', $row['score']);
		
		if($v[0] == $hitprojects_dir || !count($v)) $p_recommend = false;

		$hometype = "дома";
		if($row["o_pl"] <= 100.0) $hometype = "коттеджа";
		if($row["o_pl"] <= 60.0) $hometype = "";
		if($_SERVER['REQUEST_URI'] == "/") $hometype = "дома";
		
		if(substr($_SERVER['REQUEST_URI'], 0, 14) == "/projects/num/")
			$pname = prjname($id, $row[$request], $row["konkurents"], $row["name"], $mode, $row["dillername"], $row["archname"]);
		else $pname = "Проект $hometype ".strtoupper($row["id"]);
		
		$pr_array = project_prices($row, $actions_set, 1);
		
		//$pname = prjname($id, $row[$request], $row["konkurents"], $row["name"], $mode, $row["dillername"], $row["archname"]);
			
		$ret = "<div class='item" . (($isinhead)?"_header":"") . (($class != -1)?" $class":"") . "'" .($p_recommend ? " style='background:#fff9e3'" : "") . ">";
		
		if($v[0] == $projects_dir && $v[1] == "otl" && count($v) <= 3)
			$ret .= "<div class='tar'><img src='/i2/del.png' id='del_" . $id . "' class='delotl' onclick=\"$('#otl_dks_span').load('/ajaxotloj.php','m=del&p=otl_" . $id . "');\" /></div>";
		
		$ret .= "
			<div class='item_inner'>";
		
				if(!$isinhead) { 
					$ret .= "
						<div class='w'><noindex><a class='prjcc' href='/$projects_dir/$id/#comments'>" . $row["comments_count"] . "</a></noindex>" . 
							(($score[0] > 0)?score($score[0]):"") . "</div>
						
						<a href='/$projects_dir/$id/' class='prjpica'";
							if($date2 <= $row['dt']) 
								$ret .= " ><img src='/i2/new.gif' style='position:absolute; left:7%; top:30px;' />";
							else  
								$ret .= ">";

							$ret .= "<img src='/$projects_dir/$id/p.jpg' class='prjpic' " . alt_title($row) . " />
						</a><br />";
				}
					
					$ret .= "
					<a class='pname' href='/$projects_dir/$id/'>$pname</a><br />
					
					<p>" . (($isinhead)?getFirstSimbolsBySpaces(strip_tags($row[$des]), 200) . "...<br />":"") . "
						<noindex>
							<i>" . $flores . " " . flores_word($flores) . ", габариты: " . mm2m($row["h"], 1) . " х " . mm2m($row["v"], 1) . " м </i><br />
							<b class='fftnr fs16 mr19'>Площадь:</b> ".$row["o_pl"]." м<sup>2</sup><br />
							" . ((isset($row["varkol"]) && $row["varkol"] > 0)?"<b class='fftnr fs16 mr10'>Варианты:</b> " . $row["varkol"] . " шт<br />":"") . "
						</noindex>
						<b class='fftnr fs16 mr10'>Материал:</b> " . mats4breif($id) . "
					</p>
					
					<noindex><i class='act_line'>$actions_line</i></noindex>
					
					" . ((!$isinhead)?"<p class='breif_des'>" . preg_replace('/<br>/i', ' ', getfirst1($row[$des],100)) . "</p>":"") . "
						
					<div class='mb10'>";
						if(isset($_COOKIE['selected_projects']) && stripos($_COOKIE['selected_projects'], $id) > -1) 
							$ret .= "<span id='otl_" . $id . "' class='otl dsbl'>
								<label><input type='checkbox' checked disabled />Отложить</label>
								</span>";
						else	
							$ret .= "<span id='otl_" . $id . "' class='otl'>
								<label style='text-decoration:underline;cursor:pointer;'><input type='checkbox' />Отложить</label>
								</span>";
						
						if(isset($_COOKIE['sravn_projects']) && stripos($_COOKIE['sravn_projects'], $id) > -1) 
							$ret .= "<span id='dks_" . $id . "' class='dks dsbl'>
								<label><input type='checkbox' checked disabled />Сравнить</label></span>";
						else
							$ret .= "<span id='dks_" . $id . "' class='dks'>
								<label style='text-decoration:underline;cursor:pointer;'><input type='checkbox' />Сравнить</label>
								</span>";
							
							$ret .= "
					</div>
					
					<div class='prjbutons w'>
						<a href='/postform/?nproj=$id' class='br5 buy fl'>КУПИТЬ</a>";
						if($pr_array[1] > 0) $ret .= "<span class='fl'><b>".priceformat($pr_array[1])."</b> руб</span>";
						$ret .= " 
					</div>
				
					
					<div class='prjdop'>";
					if($row['lastcomment'] != "" && !$isinhead)
						$ret .= "<table cellpadding=0 cellspacing=0 border=0 class=blnt>
						<thead><tr><td></td><td class=blnt0></td><td></td></tr></thead>
						<tbody><tr><td class=blnt1></td><td class=bg></td><td class=blnt2></td></tr>
						<tr><td class=bg></td><td class=bg>".$row['lastcomment']."</td><td class=bg></td></tr>
						<tr><td class=blnt4></td><td class=bg></td><td class=blnt3></td></tr></tbody></table>";
					$ret .= "
					</div>
					
					". (($isinhead)?"<img src='/i2/recomendations.png' class='recomendations' />":"") . "
					
			</div>
		</div>";
				
		return $ret;		
	}
		
	function mats4breif($id) {
		global $projects_dir;
		$l = substr($id,strlen($id)-1,1);
		if($l == "p")$c = "<a href='/" . $projects_dir . "/p/'>пенобетон</a>";
		if($l == "k")$c = "<a href='/" . $projects_dir . "/k/'>кирпич</a>";
		if($l == "d")$c = "<a href='/" . $projects_dir . "/d/'>дерево</a>";
		if($l == "s")$c = "<a href='/" . $projects_dir . "/s/'>каркас</a>";
		if($l == "m")$c = "<a href='/" . $projects_dir . "/m/'>монолит</a>";
		return $c;
	}
	
	function update_lastcomment($id){
		global $projects_dir;
		if(host(1) >= 2 && host(1) <= 4){
			$ar = mysql_array("select comments.*,users.name from comments inner join users on comments.user_id=users.id
				where comments.prj='".$id."' and comments.site='".host(1)."' order by comments.date desc,comments.id desc limit 1");
			$lcname = "";
			$cc = '';
			if(host(0) == "postroi") { 
				$lcname = "lastcomment"; 
				$cc = 'comments_count=' . query1("select count(id) from comments where prj='".$id."' and site='" . host(1) . "'") . ', '; 
			}
			if(host(0) == "masterov") { $lcname = "mas_lastcomment"; }
			if(host(0) == "catalogdomov") { $lcname = "cd_lastcomment"; }
			
			if(count($ar) > 0)
				query("update projects set " . $cc . $lcname . "='<a href=/" . $projects_dir . "/" . $id . "/#cmnt" . $ar[0]["id"] . " class=a_nicname><b class=nicname>" . strtoupper(substr($ar[0]["name"],0,1)) . substr($ar[0]["name"],1,strlen($ar[0]["name"])-1) . " [".mysql_date($ar[0]["date"])."]</b>: " . htmlspecialchars(getFirstSimbolsBySpaces(strip_tags($ar[0]["mes"]),50)) . "...</a>' where id='" . $id . "'");
			else
				query("update projects set " . $cc . $lcname . "='' where id='" . $id . "'");
		}
	}
	
	function galery_breif($row){
		global $REQUEST_URI;
		return "
			<div class=prj_photo>
				<a href=/galery/".$row["id"]."/><img src=/i2/galery/".$row["id"]."-sm.jpg></a><br>
				<a href=galery/".$row["id"]."/>".$row["comment"]."</a>
			</div>";
	}
	
	function alt_title($p, $dop = '') {
		global $request;
		//$s = prjname($p['id'], $p[$request], $p['konkurents'], $p['name'], 1, $p['dillername']);
		$s = strip_tags($p['rosdom_title']);
		return "alt='" . $s  . $dop . "' title='" . $s  . $dop . "'";
	}

	function prjname($id, $request, $konkurents, $name, $mode=0, $dillername="", $archname=""){
		$l = strtolower(substr($id,strlen($id)-1,1));
		if($request == ""){
			$prjname = "Проект ";
			if($l == "k")$prjname .= "кирпично";
			if($l == "p")$prjname .= "пенобетонно";
			if($l == "d")$prjname .= "деревянно";
			if($l == "s")$prjname .= "каркасно";
			
			if(strpos(" ".$name, "61") > 0)$prjname .= "го таунхауса ";
			else if(strpos(" ".$name, "62")>0)$prjname .= "го дома на две семьи ";
			else if(strpos(" ".$name, "63")>0)$prjname .= "го узкого дома ";
			else if(strpos(" ".$name,"105")>0)$prjname .= "го одноэтажного дома ";
			else if(strpos(" ".$name, "60")>0)$prjname .= "й бани ";
			else if(strpos(" ".$name, "142")>0)$prjname .= "го особняка ";
			else if(strpos(" ".$name, "143")>0)$prjname .= "го дома из теплой керамики ";
			else if(strpos(" ".$name, "124")>0)$prjname .= "го дома под ключ ";
			else $prjname .= "го дома ";
		}
		else $prjname = strtoupper(substr($request,0,1)).strtolower(substr($request,1,strlen($request)))." ";
		
		if(host(0) == "proekty-kvadrat"){
			$prjname .= "№ ".strtoupper($archname) . " [" . strtoupper($id) . "]";
		}
		else{
			if(host(0) == "catalog-domov" && $dillername != "")$prjname .= "№ ".strtoupper($dillername);
			else{ 
				$prjname .= "№ ".strtoupper($id);
				if($konkurents != "" && $mode)$prjname .= " [".$konkurents."]";
			}
		}
		
		return $prjname;
	}
	
	function mater($mats){
		$mats = str_replace("<BR>","<br>",$mats);
		$mats = str_replace("-","–",$mats);
		while(substr($mats,0,4) == "<br>")$mats=substr($mats,4,strlen($mats)-4);
		while(substr($mats,strlen($mats)-4,4) == "<br>")$mats=substr($mats,0,strlen($mats)-4);
		if(host(0) == "postroi")$mats = preg_replace("/(Фундаменты? . [^<]*)(.*)/i","<a href=/staty/fundamenty/ target=_blank class=default>\\1</a>\\2",$mats);
		$mats = preg_replace("/([А-Я][а-я ]* [–-])/i","<b>\\1</b>",$mats);
		
		if($mats != "")return $mats;
		else return "Материалы не указаны.";
	}
	
	function ed($ed){
		if($ed == 0)$ed = "м<sup>2</sup>";
		else if($ed == 1)$ed = "м<sup>3</sup>";
		else if($ed == 2)$ed = "шт";
		else if($ed == 3)$ed = "м.п.";
		else $ed = "тонн";
		return $ed;
	}
	
	function inarray($x,$a){
		$p = 0;
		for($i=0;$i<count($a);$i++){
			if($a[$i][1] == $x)$p = 1;
		}
		return $p;
	}
	
	function query($q, $debug=false){
		if($debug)
			print "$q<BR>";
		$res = mysql_query($q);
		if(!$res) { 
			echo mysqlLog(mysql_error());
			//echo '<br />' . $q . '<br />';
		}
		return $res;
	}
	
	function query1($q){
		return @mysql_result(mysql_query($q),0);
	}
	
	function host($p=0){
		//0 - имя хоста
		//1 - id хоста (1/post2, 2/postroi, 3/masteov, 4/catalogdomov, 5/catalog-domov)
		global $is_local, $site;
		
		//Новая укороченная версия с переменной site в admin.php
		if(isset($site)){
			if($p == 0)return $site[0];
			else return $site[1];
		}
		
		//Старая версия
		if($is_local){
			if(@fopen("postroi","r")){if($p == 0)return "postroi"; else return 2;}
			if(@fopen("masterov","r")){if($p == 0)return "masterov"; else return 3;}
			if(@fopen("catalogdomov","r")){if($p == 0)return "catalogdomov"; else return 4;}
			if(@fopen("catalog-domov","r")){if($p == 0)return "catalog-domov"; else return 5;}
			if(@fopen("stroybur","r")){if($p == 0)return "stroybur"; else return 6;}
			if(@fopen("catalog-zdaniy","r")){if($p == 0)return "catalog-zdaniy"; else return 7;}
			if(@fopen("proekty-kvadrat","r")){if($p == 0)return "proekty-kvadrat"; else return 8;}
			if(@fopen("trening-new","r")){if($p == 0)return "trening-new"; else return 9;}
			if(@fopen("praktika-new","r")){if($p == 0)return "praktika-new"; else return 10;}
		}
		else{
			if(strpos($_SERVER['HTTP_HOST'],"post2")>-1)$host = "post2";
			else $host = substr($_SERVER['HTTP_HOST'],0,strlen($_SERVER['HTTP_HOST'])-3);
			$host = eregi_replace("www.","",$host);
			if($p == 0)return $host;
			else{
				$row = mysql_fetch_assoc(query("select id from sites where name='$host'"));
				return $row["id"];
			}
		}
	}
	
	function getfirst($t,$n){
		$n1 = preg_match_all("/[^\.]*\./U",$t,$a,PREG_SET_ORDER);
		if($n < $n1)$min = $n;
		else $min = $n1;
		$c = "";
		for($i=0;$i<$min;$i++)$c .= $a[$i][0];
		return strip_tags($c);
	}
	
	function getFirstSimbolsBySpaces($t, $n, $end = '') {
		if(strlen($t) > $n) {
			$t = substr($t, 0, $n);
			$last = strrpos($t, " ");
			if($last > 0)
				$t = substr($t, 0, $last);
			return $t . $end;
		}
		return $t;
	}
	
	function get_page($page,$total,$in_page){
		if($page < 0)return 0;
		else if($total > 0){
			$max = $total/$in_page;
    	if(intval($max) == $max)$max = intval($max)-1;
    	else $max = intval($max);
    	if($page > $max)return $max;
    	else return $page;
    }
  	else return 0;
  }
	
	function draw_bar($page, $total, $in_page, $url, $type = 1) {
		$page = get_page($page, $total, $in_page);
		
		if($total > 0 && intval($total / $in_page) > 0) {
			$start = $page - 10; $end = $page + 10;
    		if($start < 0) {
      			$start = 0;
      			$end = $start + 20;
      		}
    		$end1 = intval(($total - 1) / $in_page);
    		if($end > $end1 && $start > $end - $end1) {
      			$end = $end1;
      			$start = $end - 20;
      		}
    		else if($end > $end1) {
      			$end = $end1;
      			$start = 0;
      		}
			if($start > 0) {
     			if($type == 1) $nav_panel[] = "<a href='" . $url . "0'>&lt;&lt;</a>";
	 			else $nav_panel[] = "<a href='" . $url . "'>&lt;&lt;</a>";
			}
    		if($page > $start) {
      			if($type == 1) $nav_panel[] = "<a href='$url" . ($page - 1) . "'>&lt;</a>";
	  			else {
					if($page < 2) $str = ""; 
					else $str = $page . "/";
					$nav_panel[] = "<a href='$url" . $str . "'>&lt;</a>";
				}
			}
    		for($a = $start; $a <= $end; $a++) {
      			if($a == $page) {
        			if($start != $end)
        				$nav_panel[] = "<a class=selected>" . ($a + 1) . "</a>";
				}
      			else {
        			if($type == 1)
        				$nav_panel[] = "<a href='$url$a'>" . ($a + 1) . "</a>";
					else {
						if($a == 0) $str = ""; 
						else $str = ($a + 1) . "/";
						$nav_panel[] = "<a href='$url" . $str . "'>" . ($a + 1) . "</a>";
					}
	  			}
      		}
    		if($page < $end) {
      			if($type == 1)
      				$nav_panel[] = "<a href='$url" . ($page + 1) . "'>&gt;</a>";
	  			else $nav_panel[] = "<a href='$url" . ($page + 2) . "/'>&gt;</a>";
			}
    		if($nav_panel != "")
    			return implode("", $nav_panel);
		}
	}
	
	function get_limit($page,$total,$in_page){
		$page = get_page($page,$total,$in_page);
  	if($total > 0){
    	if(intval($total/$in_page)==0)return "";
    	else if($page > 0)return " limit ".($page*$in_page).",$in_page";
   		else return " limit $in_page";
   	}
 		else return "";
	}
	
	function coder($id,$login){
		$a = array("d","p","l","i","0","q","s","b","7","w","6","y","3","@","_","5","z","v","g","c","a","f","2","n","t","k","e","9","h","-","o","4","j","m","u","8",".","1","x","r");
		$code = "";
		for($i=0;$i<strlen($login);$i++){
			for($i1=0;$i1<count($a);$i1++){
				if($login[$i] == $a[$i1])$code .= strlen($i1*$id).$i1*$id;
			}
		}
		return strlen($id*count($a)).$id*count($a).$code;
	}
	
	function decoder($exp,$m){
		$a = array("d","p","l","i","0","q","s","b","7","w","6","y","3","@","_","5","z","v","g","c","a","f","2","n","t","k","e","9","h","-","o","4","j","m","u","8",".","1","x","r");
		$id_len = substr($exp,0,1);
		$id = substr($exp,1,$id_len)/count($a);
		$login = "";
		for($i=$id_len+1;$i<strlen($exp);){
			$l1 = substr($exp,$i+1,substr($exp,$i,1));
			$l2 = $l1/$id;
			for($i1=0;$i1<count($a);$i1++){
				if($l2 == $i1)$login .= $a[$l2];
			}
			$i= $i+strlen($l1)+1;
		}
		if($m == 0)return $id;
		else return $login;
	}
	
	function getpagespathurls($parent_id,$cur_name,$cur_urls){
		global $pages;
		if($cur_urls!="/"){
			if($cur_urls!="")$cur_urls="/$cur_urls/";
			else $cur_urls="/";
		}
		$tmp="<a href=$cur_urls title=\"$cur_name\">$cur_name</a>";
		if($parent_id>0){
			$tmp="&nbsp;/&nbsp;$tmp";
			$res = query("select * from $pages where id='$parent_id' and site='".host(1)."'");
			if($row = mysql_fetch_assoc($res)){
				mysql_free_result($res);
				return getpagespathurls($row["parent"],$row["menu"],$row["dir"]) . $tmp ;
			}
			else return $tmp;
		}
		else return "$tmp (Главная)";
	}

	function getcatalogpath($catalog_page_id){
		global $pages;
		$res = query("select * from $pages where id='$catalog_page_id' and site='".host(1)."'");
		if($row = mysql_fetch_assoc($res)){
			mysql_free_result($res);
			return getpagespathurls($row["parent"],$row["menu"],$row["dir"]);
		}
		else return "Ошибка в функции getcatalogpath!";
	}
	
	//Тренинги//////////////////////////////////////////////////////////////////////
	
	function praktikasendform($os_theme="",$title=""){
		global $h1,$v,$REQUEST_URI,$info_email;
		
		//Распаковка POST переменных
		$avp = array_keys($_POST);//список POST переменных
		for($ind=0;$ind<count($_POST);$ind++){
			$varname = $avp[$ind];
			$$varname = $_POST[$varname];
		}
		
		if($v[0] == "trenings")$os_sendtheme="Заявка на участие в тренинге с сайта ".host(0).".ru";
		else $os_sendtheme="Вопрос / отзыв с сайта ".host(0).".ru";
	

		if($os_action == "send"){
			$os_sendmessage = "
			<h2>$os_sendtheme</h2>
			<b>Фамилия:</b> $os_family<br>
			<b>Имя:</b> $os_name<br>
			<b>Отчество:</b> $os_patronymic<br>";
			if($v[0] == "trenings")$os_sendmessage .= "
				<b>Организация:</b> $os_organization<br>
				<b>Должность:</b> $os_doljnost<br>";
			$os_sendmessage .= "
			<b>Телефон:</b> $os_phone<br>
			<b>Email:</b> $os_email<br>";
			if($os_trening != "")$os_sendmessage .= "<b>Тренинг:</b> $os_trening<br>";
			$os_sendmessage .= "<b>Доп. инфо:</b> $os_text";
			
			//Письмо нам
			sendmail($info_email,$os_sendtheme,$os_sendmessage,0,"from: ".$os_name." <".$os_email.">\nX-Sender: <".$os_email.">\nContent-Type: text/html; charset=windows-1251");
			
			//Письмо им, если оно по проекту
			$ret = "<br><br><b style='color:red'>Спасибо, что обратились в нашу компанию.<br>Ваше сообщение отправлено.</b>";
			
			if($v[0] == "trenings")sendmail($os_email,"Вы отправили заявку на учатие в тренинге с сайта ".host(0).".ru","
					Вы отправили заявку на учатие в тренинге <b>".$os_trening."</b> на сайте ".host(0).".ru<br>
					Мы постараемся ответить Вам в ближайшее время.<br>
					Это письмо было отослано Вам автоматически, отвечать на него не нужно.<br>
					Спасибо, что обратились в нашу компанию.",1);
			
		}
		else{
			$ret = "
				<div class=\"form_block\">
					<div class=\"title_form\"><b class=\"red_text\">$title</b></div>
					<div class=\"form_content\">
						<form id=os_form name=os_form action=$REQUEST_URI method=post onsubmit=\"javascript:if(os_email.value=='' && os_phone.value==''){alert('Необходимо указать телефон или email.'); return false;} else {os_action.value='send'; return true;}\">
							<input type=hidden name=os_action>
							<input type=hidden name=os_theme value=\"$os_theme\">
							<table cellpadding=0 cellspacing=0 border=0>
								<tr><td class=name_pole>Фамилия:</td><td><input type=text class=t name=os_family></td></tr>
								<tr><td class=name_pole>Имя:</td><td><input type=text class=t name=os_name></td></tr>
								<tr><td class=name_pole>Отчество:</td><td><input type=text class=t name=os_patronymic></td></tr>";
								if($v[0] == "trenings")$ret .= "
									<tr><td class=name_pole>Организация:</td><td><input type=text class=t name=os_organization></td></tr>
									<tr><td class=name_pole>Должность:</td><td><input type=text class=t name=os_doljnost></td></tr>";
								$ret .= "
								<tr><td class=name_pole>Телефон:</td><td><input type=text class=t name=os_phone></td></tr>
								<tr><td class=name_pole>Email:</td><td><input class=t type=text name=os_email></td></tr>
								<tr><td class=name_pole>Тренинг:</td><td>
									<select name=os_trening>
										<option value=''>---</option>";
										$trenings_list = mysql_array("select * from praktika_trenings where aktiv");
										for($i=0;$i<count($trenings_list);$i++)$ret .= selected($h1,$trenings_list[$i]["name"],$trenings_list[$i]["name"]);
										$ret .= "
									</select>
								</td></tr>";
								if($v[0] == "trenings")$ret .= "<tr><td class=name_pole>Дополнительная<br>информация:</td><td><textarea name=os_text></textarea></td></tr>";
								else $ret .= "<tr><td class=name_pole>Ваш вопрос,<br>пожелание или<br>отзыв:</td><td><textarea name=os_text></textarea></td></tr>";
								$ret .= "
								<tr><td></td><td><input type=submit class=submit></td></tr>
							</table>
						</form>
					</div>
				</div>
			</div>";
		}
		return $ret;
	}
	
	/**
	 * Возвращает сумму прописью
	 * @author runcore
	 * @uses morph(...)
	 */
	function num2str($num) {
		$nul='ноль';
		$ten=array(
			array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
			array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
		);
		$a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
		$tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
		$hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
		$unit=array( // Units
			array('копейка' ,'копейки' ,'копеек',	 1),
			array('рубль'   ,'рубля'   ,'рублей'    ,0),
			array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
			array('миллион' ,'миллиона','миллионов' ,0),
			array('миллиард','милиарда','миллиардов',0),
		);
		//
		list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
		$out = array();
		if (intval($rub)>0) {
			foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
				if (!intval($v)) continue;
				$uk = sizeof($unit)-$uk-1; // unit key
				$gender = $unit[$uk][3];
				list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
				// mega-logic
				$out[] = $hundred[$i1]; # 1xx-9xx
				if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
				else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
				// units without rub & kop
				if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
			} //foreach
		}
		else $out[] = $nul;
		$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
		$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
		return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
	}

	/**
	 * Склоняем словоформу
	 * @ author runcore
	 */
	function morph($n, $f1, $f2, $f5) {
		$n = abs(intval($n)) % 100;
		if ($n>10 && $n<20) return $f5;
		$n = $n % 10;
		if ($n>1 && $n<5) return $f2;
		if ($n==1) return $f1;
		return $f5;
	}

	/**
	* Копирование бекапа таблиц
	*/
	function copyWebTables2Local ($tables) {

		foreach($tables as $table) {

			mysql_connections('www');

			$ct = mysql_array('SHOW CREATE TABLE ' . $table);
			$createTable = $ct[0]['Create Table'];

			$res = query('select * from ' . $table);
			
			mysql_connections('local');

			query('DROP TABLE IF EXISTS ' . $table);
			query($createTable);

			while($row = mysql_fetch_assoc($res)) {
				$fields = array_keys($row);
				$names = $values = array();

				foreach($fields as $field) {
					$names[] = $field;
					$values[] = setnull($row[$field]);
				}
				
				query("insert into " . $table . " (" . implode(', ', $names) . ") values (" . implode(', ', $values) . ")");
			}
		}
	}

	function dater ($date) {
		// dd.mm.yyyy
		return mktime(0, 0, 0, substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4));
	}

	function mysqlDater ($date) {
		// yyyy-mm-dd
		return mktime(0, 0, 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
	}
?>