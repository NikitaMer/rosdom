<?php

	//Меню
	$m1 = mysql_array("select id,menu,dir from $pages where type=1 and site='".host(1)."' order by num");
	$m2 = mysql_array("select id,menu,dir from $pages where type=2 and site='".host(1)."' order by num");
	$m3 = mysql_array("select id,menu,dir from $pages where type=3 and site='".host(1)."' order by num");
	$m4 = mysql_array("select id,menu,dir from $pages where type=4 and site='".host(1)."' order by num");
	$m5 = mysql_array("select id,menu,dir from $pages where type=5 and site='".host(1)."' order by num");
	$m6 = mysql_array("select id,menu,dir from $pages where type=6 and site='".host(1)."' order by num");
	$m7 = mysql_array("select id,menu,dir from $pages where type=7 and site='".host(1)."' order by num");
	$m8 = mysql_array("select id,menu,dir from $pages where type=8 and site='".host(1)."' order by num");
	$m9 = mysql_array("select id,menu,dir from $pages where type=9 and site='".host(1)."' order by num");
	$m10 = mysql_array("select id,menu,dir from $pages where type=10 and site='".host(1)."' order by num");
	
	//Реклама на сайте (личный кабинет)
	if(!empty($_SESSION['session_id']) && !empty($_SESSION['session_login'])) {
		$rekl = query1("select users1.rekl from users left join users1 on users.users1=users1.id where users.id='" . $_SESSION['session_id'] . "'");
	}
	
	//Гео-таргетинг
	$cookie_spliter = ';';
	if(isset($_COOKIE['geo_param_' . host(0)])) {
		$geo_param0 = split($cookie_spliter, $_COOKIE['geo_param_' . host(0)]);
		if(count($geo_param0) == 10) {
			$geo_param = array(
				'id' 			=> $geo_param0[0], 
				
				'country_id'	=> $geo_param0[1], 
				'alpha2' 		=> $geo_param0[2], 
				'country' 		=> $geo_param0[3],

				'district_id'	=> $geo_param0[4],
				'district' 		=> $geo_param0[5], 
				
				'region_id' 	=> $geo_param0[6],
				'region' 		=> $geo_param0[7], 
				
				'town_id' 		=> $geo_param0[8],
				'town' 			=> $geo_param0[9],
			);
		}
		else {
			$geo_param = makeGeoParam($cookie_spliter);
		}
	}
	else {
		$geo_param = makeGeoParam($cookie_spliter);
	}
	
	//Новости
	$news = mysql_array("select * from $pages where (parent=607 or parent=727) and site='".host(1)."' order by lastedit desc limit 2"); 
	
	//Поседние комментарии

	//Акции
	$actions = mysql_array("select 
		actions.id,actions.status,actions.showlist,actions.type,actions.not_field,actions.showinfo,
		actions_des.name,actions_des.k_opis,actions_des.opis,actions_des.file,actions_des.file_zn,actions_des.k
		from actions inner join actions_des 
		on actions.id=actions_des.action_id 
		where actions.status='1' and actions_des.site='".host(1)."'");
	$action_s10 = mysql_array("select 
		actions.id,actions.status,actions.showlist,actions.type,actions.not_field,
		actions_des.name,actions_des.k_opis,actions_des.opis,actions_des.file,actions_des.file_zn,actions_des.k
		from actions inner join actions_des 
		on actions.id=actions_des.action_id 
		where actions.id=5 and actions_des.site='".host(1)."'"); 

	//Статьи
	if(host(0) == "catalogdomov"){ $staty_parent = 206; $staty_limit = 2; }
	else { $staty_parent = 573; $staty_limit = 4; }

	$staty = mysql_array("select * from $pages where parent=".$staty_parent." and site=".host(1)." order by lastedit limit ".$staty_limit); 

	//Проекты в шапку
	if(isset($header_projects_array) and count($header_projects_array) > 0){
		$header_projects = mysql_array("select projects.*,count(projects_var.id) as varkol 
			from projects left join projects_var on projects.id=projects_var.name 
			where projects.id in('".implode("','",$header_projects_array)."') and ".substr($commonwhere,0,strpos($commonwhere,"order")-1)."
			group by projects.id 
			order by projects.dt desc");
	}
	
	//Хиты продаж
	$hitprj = mysql_array("select projects.*,count(projects_var.id) as varkol 
		from projects left join projects_var on projects.id=projects_var.name 
		where projects.name like '%(23)%' and ".substr($commonwhere,0,strpos($commonwhere,"order")-1)."
		group by projects.id order by projects.dt desc");
	
	//Особые Хиты для главной на postroi.ru
	if(host(0) == 'postroi') {
		$hitprj_m = mysql_array("select projects.*,count(projects_var.id) as varkol 
			from projects left join projects_var on projects.id=projects_var.name 
			where projects.id in ('F-149-1P','W-184-1K','B-133-1P','O-231-1K','H-131-1P','T-210-1K','B-191-1P','L-115-1P','O-165-1K') 
			and ".substr($commonwhere,0,strpos($commonwhere,"order")-1)."
			group by projects.id
			order by field(projects.id, 'F-149-1P','W-184-1K','B-133-1P','O-231-1K','H-131-1P','T-210-1K','B-191-1P','L-115-1P','O-165-1K')");
	}

	//Новые проекты
	$newprj = mysql_array("select projects.*,count(projects_var.id) as varkol 
		from projects left join projects_var on projects.id=projects_var.name 
		where (projects.dt<=now() and projects.dt>='$date2') and ".substr($commonwhere,0,strpos($commonwhere,"order")-1)."
		group by projects.id 
		order by projects.dt desc");
	
	if(count($newprj) == ""){
		if(!isset($new_if0_limit))
			$new_if0_limit = 3;
		$newprj = mysql_array("select projects.*,count(projects_var.id) as varkol 
		from projects left join projects_var on projects.id=projects_var.name 
		where ".substr($commonwhere,0,strpos($commonwhere,"order")-1)."
		group by projects.id 
		order by projects.dt desc 
		limit " . $new_if0_limit);
	}
	
	//Галерея
	$galery = mysql_array("select * from galery where sale='0' and site='".host(1)."' limit ".$galery_top_limit);
	
	//На продажу
	$sale = mysql_array("select * from galery where sale='1' and site='".host(1)."' and id in('93','98')");
	
	if($_SERVER["REQUEST_URI"] == "/" && !empty($request)) {
		
		//Последние комментарии
		$last_comments = mysql_array("
				select comments.site, comments.prj, comments.mes, comments.date,
				users.nicname, users.pol,	
				projects.id, projects." . $request . ", projects.konkurents, projects.name, projects.dillername, projects.score 
				from comments 
				inner join users on comments.user_id=users.id 
				inner join projects on comments.prj=projects.id
				where comments.site='".host(1)."' 
				order by comments.date desc,comments.id desc limit 3");
		
		//Самые комментируемые проекты
		$most_commented = mysql_array("
				select comments.prj, count(comments.id) as col, 
				projects.id, projects." . $request . ", projects.konkurents, projects.name, projects.dillername, projects.score  
				from comments inner join projects on comments.prj=projects.id
				where comments.site='".host(1)."' 
				group by prj 
				order by col desc limit 16");
	}
	
	//Нижняя статья на главной
	//$mainpage_ls_row = mysql_array("select * from pages where id='625' and site='".host(1)."'");
	
	if(host(1) == 8 || host(1) == 9){
		//Календарь
		$calendar = mysql_array("select praktika_calendar.date,praktika_trenings.name,praktika_trenings.anonce2,praktika_trenings.url from praktika_calendar inner join praktika_trenings 
			on praktika_calendar.trening=praktika_trenings.id 
			where praktika_calendar.date>='".date("Y-m-d")."' and praktika_calendar.site='".host(1)."' order by praktika_calendar.date");
	}
?>