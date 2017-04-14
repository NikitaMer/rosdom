<?php

	error_reporting(E_ERROR);

	if(@opendir("..\\1c2.loc"))$is_local = 1;
	else $is_local = 0;
	
	$common_functions_dir = "f";

	
	$site = array("rosdom","2");
	$root = "http://www.rosdom.ru/";
	$t0 = "t/t0.php";
	$t1 = "t/t0.php";
	$commonwhere = "projects.site like('_____1__') and ((projects.sflag is null) or projects.sflag<'1') and not(projects.arch=139) and not(projects.arch=137) and not(projects.arch=141) order by projects.sflag,if((projects.id like 'q%') and not(projects.name like '%{v}%'),1,0),projects.o_pl,projects.id";
	
	$projects_dir = "projects";
	$newprojects_dir = "newprj";
	
	$galery_top_limit = 3;
	$new_projects_top_limit = 3;
	
	$in_page = 20;
	$pages = "pages";
	
	$info_email = "info@postroi.ru";
	$manager_email = "manager@postroi.ru";
	$request_email = "requests@postroi.ru";

	$phones = array("");
	$faxes = array("");
	
	//----------------------------------------------------------------------
	
	$request = "";
	$des = "rosdom_des";

	//----------------------------------------------------------------------
	
	$breif_var = "Разновидности проекта";
	
	$project_h2_des = "Описание проекта";
	$project_h2_mater1 = "Материалы заложенные в типовой проект";
	$project_h2_mater2 = "Расход материалов";
	$project_h2_actions = "Акции по проекту";
	$project_h2_pln = "Планы";
	$project_h2_fsd = "Фасады";
	$project_h2_vars = "Варианты данного проекта:";

	$project_h2_prices = "Цены";
		$project_h2_prices_table1 = "Комплектация";
			$project_h2_prices_hintword = "что входит?";
		$project_h2_prices_table2 = "Доп. услуги";
	
	//----------------------------------------------------------------------
	
	$pl = array(
		array("до 150 м2","do150","projects.o_pl<150"),
		array("от 150 до 250 м2","ot150do250","(projects.o_pl>=150 and projects.o_pl<250)"),
		array("от 250 до 400 м2","ot250do400","(projects.o_pl>=250 and projects.o_pl<400)"),
		array("от 400 м2","ot400","projects.o_pl>=400"),
	);
	
	$as = array("one","two","three","four","uzk","cokol","mansarda");
?>