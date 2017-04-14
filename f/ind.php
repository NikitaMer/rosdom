<?php
	
	include("$common_functions_dir/redirector.php");
	

	setcookie('cookie', 'ok', time()+3600*24*365, '/');

	if(isset($_COOKIE[host(0)])){
		//$_SESSION['id'] = decoder($_COOKIE[host(0)],0);
		//$_SESSION['login'] = decoder($_COOKIE[host(0)],1);
		
		$_SESSION['session_id'] = decoder($_COOKIE[host(0)],0);
		$_SESSION['session_login'] = decoder($_COOKIE[host(0)],1);
	}
	
	if($is_local)mysql_connections("local");
	else mysql_connections("www");
	
	//Проверка аплоада базы
	$loadbase = "0";
	if(!$is_local && host(0) != "praktika-new" && host(0) != "trening-new")
		$loadbase = query1("select value from online where variable='loadbase'");

	if(trim($loadbase) == "0"){	
		$date2 = date("Y-m-d",mktime(0,0,0,date("m")-2,date("d"),date("Y")));
		include("$common_functions_dir/sides.php");
		if(host(0) == "postroi")include("b.php");
		
		if($_SERVER["REQUEST_URI"] != "")$REQUEST_URI = $_SERVER["REQUEST_URI"];
		
		if(host(0) != "praktika-new" && host(0) != "trening-new") 
			include("$common_functions_dir/mail.php"); 
		
		if($REQUEST_URI != "/"){
			$a = preg_replace("/(\?.*)/i","",$REQUEST_URI);
			$a = preg_replace("/(\/)$/i","",preg_replace("/^\//i","",$a));
			$v = preg_split('/\//',$a);
			$n = count($v);
			$f = @mysql_result(mysql_query("select funcname from $pages where dir='".$v[0]."' and site='".host(1)."'"),0);
			#echo $f.' ; ';
			#debmes($m1);
			if($f != "") include("$common_functions_dir/".$f.".php");
			else include("$common_functions_dir/page.php");
		}
		else include("$common_functions_dir/main.php");
	}
	else{
		echo "
			<html>
				<body>
					<div style='margin:10% auto 0 auto; width:80%;'>
						<img src=/i2/biglogo.gif>
						<h1>Сайт будет доступен в течение 3 минут.</h1>
						<p>Приносим извинения за неудобство. На сайте идут технические работы.</p>
					</div>
				</body>
			</html>
		";
	}
?>