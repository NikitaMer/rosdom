<?php	

	/*
	 *	Выборки проектов по акциям 
	 */

	$dir = $v[0]; $url = "/".$v[0]."/";
	include("$common_functions_dir/page1.php");
	
	preg_match("/\(([0-9]*)\)/i", query1("select menu from pages where dir='" . $v[0] . "'"), $matches);
	$action_number = $matches[1];
	
	$q1 = "select count(id) as goods_total from projects where name like '%(" .$action_number . ")%' and " . $commonwhere;
	$q2 = "select projects.*,count(projects_var.id) as varkol
		from projects left join projects_var on projects.id=projects_var.name 
		group by projects.id 
		having name like '%(" .$action_number . ")%' and " . $commonwhere;
	
	if(($n == 2 && !preg_match("/^[0-9]{1,2}$/",$v[1])) || $n > 2)
		header('HTTP/1.0 404 not found');
	else {
		include("$common_functions_dir/projects1.php");
		include($t0);
	}