<?
	//Подробная информация по проекту

	$project = mysql_array("select * from projects where id='".strtolower($ar[1])."' and " . $commonwhere);

	//А это батенька, если проекта нема
	if(count($project) == 0) {
		header("HTTP/1.0 404 Not Found");
		exit;
	}

	$h1 = $project[0]["rosdom_h1"];
	$title = $project[0]["rosdom_title"];
	$keywords = $project[0]["rosdom_keywords"];
	$description = $project[0]["rosdom_description"];

	$actions_set = actions($project[0]["name"],$project[0]["dt"]);
	$rashod = mysql_array("select mats.name,mats_prj.kol,mats_prj.ed,mats_prj.id,mats_prj.comment from mats_prj inner join mats on mats_prj.mats_id=mats.id where mats_prj.prj_id='".$project[0]["id"]."'");
	$pln = mysql_array("select projects_p.*,projects_p_n.* from projects_p inner join projects_p_n on projects_p.part = projects_p_n.num where type = 1 and prj='".$project[0]["id"]."' order by num");
	$fsd = mysql_array("select projects_p.*,projects_p_n.* from projects_p inner join projects_p_n on projects_p.part = projects_p_n.num where type = 2 and prj='".$project[0]["id"]."' order by num");
	
	/* че-та говнише 02.06.2014 [D]
	$variantsQuery = "select 
		projects_var.var,
		projects_var.des,
		projects.prev,
		projects.rosdom_h1  

		from projects_var 

		inner join projects on (
			projects_var.name = projects.id";

			//Добавка для отсечения не существующих для данного сайта вариантов проекта (только для catalog-domov)
			if(host(0) == 'catalog-domov') { 
				$variantsQuery .=  " and (
					select count(id) from projects 
					where (id=projects_var.var and " . substr($commonwhere, 9, 21) . ") or projects_var.var like '%(%'
				) > 0";
			}

			$variantsQuery .= "
		)
		where projects.id='".$project[0]["id"]."'";
	*/
	$variantsQuery = "select 
		projects_var.var,
		projects_var.des,
		projects.prev,
		projects.rosdom_h1  

		from projects_var 

		inner join projects on (
			replace(replace(replace(projects_var.var, '(s)', ''), '(S)', ''), ' ', '') = projects.id";

			//Добавка для отсечения не существующих для данного сайта вариантов проекта (только для catalog-domov)
			if(host(0) == 'catalog-domov') { 
				$variantsQuery .=  " and (
					select count(id) from projects 
					where (id=projects_var.var and " . substr($commonwhere, 9, 21) . ") or projects_var.var like '%(%'
				) > 0";
			}

			$variantsQuery .= "
		)
		where projects_var.name='".$project[0]["id"]."'";
	
	$variants = mysql_array($variantsQuery);
	
	//Реклама
	
	$material = strtolower(substr($project[0]["id"], strlen($project[0]["id"])-1, 1));
	$ind = "and rekl1.ind like '" . $material;
	
	if(strpos($project[0]["name"], "[644]") > -1) $ind .= "4'"; //Гаражи
	elseif(strpos($project[0]["name"], "[60]") > -1) 	$ind .= "5'"; //Бани
	elseif(strpos($project[0]["name"], "[140]") > -1) $ind .= "6'"; //Бассейны
	elseif(strpos($project[0]["name"], "[645]") > -1) $ind .= "7'"; //Беседки
	else 
		$ind = " and (rekl1.ot<=" . $project[0]["o_pl"] . " and rekl1.do>" . $project[0]["o_pl"] . ") 
			and (rekl1.ind = '".$material."1' or rekl1.ind = '".$material."2' or rekl1.ind = '".$material."3')";
	
	$rekl_q = "select 
		users.id as userid,
		users1.name as companyname, users1.name2 as companyname2, users1.site, users1.site2,
		regions.name as regionname, 
		rekl.name,	rekl.logo, rekl.status, rekl.smeta,
		rekl.geo_countrys, rekl.geo_districts, rekl.geo_regions, rekl.geo_towns,
		rekl1.ot, rekl1.do, rekl1.k, rekl1.status, rekl1.comment, rekl1.ind, rekl1.showprices,
		(
			ifnull((select sum(summa_opl) from bills where user_id=users.id and status=3 and summa_opl>0), 0) + 3000 - 
			ifnull((select count(id) FROM b_stat where user_id = users.id), 0) * 30
		) AS ost
		
		from users 
		
		left join dogovors on users.id=dogovors.user_id
		left join users1 on users.users1=users1.id
		left join regions on regions.id=users1.stroyregion
		left join rekl on rekl.user_id=users.id
		left join rekl1 on rekl1.rekl_id=rekl.id
		
		where users.site='" . host(1) . "' and (users1.rekl=1 or users1.rekl=3)
		and rekl.status=1 and rekl1.status=1 " . $ind;

		//Гео-уточнение
		$geo_add = array();
		
		if(isset($geo_param['country_id']) && $geo_param['country_id'] != '') 	$geo_add[] = "(rekl.geo_countrys like '%[" . $geo_param['country_id'] . "]%' or isnull(rekl.geo_countrys))";
		if(isset($geo_param['district_id']) && $geo_param['district_id'] != '') $geo_add[] = "(rekl.geo_districts like '%[" . $geo_param['district_id'] . "]%' or isnull(rekl.geo_districts))";
		if(isset($geo_param['region_id']) && $geo_param['region_id'] != '') 	$geo_add[] = "(rekl.geo_regions like '%[" . $geo_param['region_id'] . "]%' or isnull(rekl.geo_regions))";
		if(isset($geo_param['town_id']) && $geo_param['town_id'] != '') 		$geo_add[] = "(rekl.geo_towns like '%[" . $geo_param['town_id'] . "]%' or isnull(rekl.geo_towns))";
	
		if(count($geo_add))
			$rekl_q .= " and " . implode(" and ", $geo_add);

		$rekl_q .= " order by dogovors.date";
		
	$rekl_array = mysql_array($rekl_q);
	//print2me($rekl_q);

	//--------------------------------------------------------------------------------------------------------------------------------------------------
	
	//Добавка в мета-описание преокта
	if(host(0) == 'postroi') {
		//Габариты	
		if(isset($project[0]['v']) && $project[0]['v'] != '' && isset($project[0]['h']) && $project[0]['h'] != '') 
			$description .= ', ' . ($project[0]['v']/1000) . ' x ' . ($project[0]['h']/1000) . ' м'; 
		//Общая площадь
		if(isset($project[0]['o_pl']) && $project[0]['o_pl'] != '') $description .= ', ' . $project[0]['o_pl'] . ' м2'; 

		//Этажность
		if(isset($project[0]['flores']) && $project[0]['flores'] != '') { 
			$description .= ', ' . substr($project[0]['flores'], 0, 1) . ' этажа';
			$etin = array();
			if(substr($project[0]['flores'], 1, 1) == 1) $etin[] = 'цоколь';
			if(substr($project[0]['flores'], 2, 1) == 1) $etin[] = 'мансарда';
			if(count($etin) > 0) $description .= ' (' . implode(', ', $etin) . ')';
		}

		//Помещения
		if(isset($project[0]['fs']) && $project[0]['fs'] != '') { 
			if(substr($project[0]['fs'], 3, 1) == 1) $description .= ', сауна';
			if(substr($project[0]['fs'], 4, 1) == 1) $description .= ', бассейн';
			if(substr($project[0]['fs'], 7, 1) == 1) $description .= ', зимний сад';
			if(substr($project[0]['fs'], 8, 1) == 1 || substr($project[0]['fs'], 8, 1) == 2) { 
				if(substr($project[0]['fs'], 8, 1) == 1) $description .= ', встроенный';
				if(substr($project[0]['fs'], 8, 1) == 2) $description .= ', внешний';
				$description .= ' гараж';
				$description .= ' на ' . substr($project[0]['fs'], 9, 1) . ' а.м.';
			}
		}
		
		//Доставка
		if(strpos($project[0]["name"], "(16)") > -1 || strpos($project[0]["name"], "(26)") > -1)
			$description .= ', бесплатная доставка по РФ'; 

		//Выборки
		$viborky = array();
		if(strpos($project[0]["name"], "[60]") > -1)	$viborky[] = 'проекты бань';
		if(strpos($project[0]["name"], "[61]") > -1) 	$viborky[] = 'проекты таунхаусов и блокированных домов';
		if(strpos($project[0]["name"], "[62]") > -1) 	$viborky[] = 'проекты домов на две семьи';
		if(strpos($project[0]["name"], "[63]") > -1) 	$viborky[] = 'проекты узких домов';
		if(strpos($project[0]["name"], "[124]") > -1) 	$viborky[] = 'дома под ключ';
		if(strpos($project[0]["name"], "[140]") > -1) 	$viborky[] = 'проекты бассейнов';
		if(strpos($project[0]["name"], "[142]") > -1) 	$viborky[] = 'проекты особняков';
		if(strpos($project[0]["name"], "[143]") > -1) 	$viborky[] = 'проекты домов из поризованного камня (rauf, knauf)';
		if(strpos($project[0]["name"], "[644]") > -1)	$viborky[] = 'проекты гаражей';
		if(strpos($project[0]["name"], "[645]") > -1) 	$viborky[] = 'проекты беседок';

		if(count($viborky) > 0) {
			if(count($viborky) == 1) $description .= ', относится к выборке ';	
			else $description .= ', относится к выборкам: ';
			$description .= implode(', ', $viborky);
		}
		
	}

