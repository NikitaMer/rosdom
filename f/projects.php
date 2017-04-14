<? 
	$bartype = 2; $pladd = '';
	#debmes($t0);
	$m2i = $m3i = $m4i = $m5i = $m7i = "";
	for($i=0;$i<count($m2);$i++)$m2i .= $m2[$i]["dir"]." ";
	for($i=0;$i<count($m3);$i++)$m3i .= $m3[$i]["dir"]." ";
	for($i=0;$i<count($m4);$i++)$m4i .= $m4[$i]["dir"]." ";
	for($i=0;$i<count($m5);$i++)$m5i .= $m5[$i]["dir"]." ";
	for($i=0;$i<count($m8);$i++)$m8i .= $m8[$i]["dir"]." ";
	
	$not = "(not(projects.name like '%[60]%' or projects.name like '%[140]%' or projects.name like '%[644]%' or projects.name like '%[645]%') or isnull(projects.name))";
	
	if((preg_match("/^\/".$projects_dir."\/(.-.{3,4}-..)\/(.\/)?$/",$REQUEST_URI,$ar) && host(0) != "catalog-domov") || 
		 (preg_match("/^\/".$projects_dir."\/([A-Za-zа-яА-Я][0-9]{5})\/(.\/)?$/",$REQUEST_URI,$ar) && host(0) == "catalog-domov")){
		if(host(0) == "catalog-domov")$ar[1] = query1("select id from projects where dillername='".$ar[1]."'");
		include("$common_functions_dir/project.php");
		if(@mysql_result(mysql_query("select count(id) from projects where id='".$ar[1]."' and $commonwhere"),0) > 0){
			$printer = 0;
			if(isset($ar[2]) && $ar[2] == "p/"){
				$printer = 1;
				header('HTTP/1.0 404 not found');
				//include("$common_functions_dir/printer.php");
			}
			else if(isset($ar[2]) && $ar[2] == "z/"){
				$zerk = 1;
				header('HTTP/1.0 404 not found');
				//include("$common_functions_dir/zerk.php");
			}
			else include($t1);
		}
		else header('HTTP/1.0 404 not found');
	}
	else{
		if($v[0] == $newprojects_dir){
			//Новые проекты
			$dir = $v[0]; $url = "/".$v[0]."/";
			include("$common_functions_dir/page1.php");
			
			$q1 = "select count(id) as goods_total from projects 
				where (dt<=now() and dt>='$date2') and ".substr($commonwhere,0,strpos($commonwhere,"order")-1)." 
				order by dt DESC";
			$q2 = "select projects.*,count(projects_var.id) as varkol
				from projects left join projects_var on projects.id=projects_var.name 
				group by projects.id 
				having (projects.dt<=now() and projects.dt>='$date2') and ".substr($commonwhere,0,strpos($commonwhere,"order")-1)." 
				order by dt DESC";
			
			if(query1($q1) == 0){
				$q1 = "select 10";
				$q2 = "select projects.*,count(projects_var.id) as varkol
					from projects left join projects_var on projects.id=projects_var.name 
					group by projects.id 
					having ".substr($commonwhere,0,strpos($commonwhere,"order")-1)." 
					order by dt DESC limit 10";
			}	
				
			if(($n == 2 && !preg_match("/^[0-9]{1,2}$/",$v[1])) || $n > 2)header('HTTP/1.0 404 not found');
			else{
				include("$common_functions_dir/projects1.php");
				include($t0);
			}
		}
		else if($v[0] == $projects_dir){
			if($n == 1){
				//Рубрикатор
				
				include("$common_functions_dir/page1.php");
				#debmes($m1);
				#debmes($projects_dir,$v[0]);
				//print_r($m1);
				
				$startcontent = $content;

				if(host(1) == 2)
					$content = "<p class=colprj>Общее количество архитектурных проектов в каталоге: <b class=total>".query1("select count(id) from projects where $commonwhere")."</b></p>";

				if(count($m1)>0){
					
					$content .= "
						<style>.cat td { padding:3px; }</style>
						<table class=cat><tr><td><b>Категории проектов:</b></td><td></td><td><b>Количество:</b></td></tr>";
					
					for($i1=0;$i1<count($m1);$i1++){
						$content .= "<tr valign=top>
							<td rowspan=5><a href=/".$m1[$i1]["dir"]."/><img src=/i2/cat/".substr($m1[$i1]["dir"],strlen($m1[$i1]["dir"])-1,1).".jpg></a></td>
							<td><a href=/".$m1[$i1]["dir"]."/><b>".$m1[$i1]["menu"]."</b></a></td>
							<td align='center'><b>".@mysql_result(mysql_query("select count(id) as goods_total from projects where id like('%-%-%".substr($m1[$i1]["dir"],strlen($m1[$i1]["dir"])-1,1)."') and $commonwhere"),0)."</b></td>
						</tr>";
						for($i2=0;$i2<count($pl);$i2++)$content .= "<tr>
							<td><ul><li><a href=/".$m1[$i1]["dir"]."/".$pl[$i2][1]."/>".$pl[$i2][0]."</a></li></ul></td>
							<td align='center'><b>".@mysql_result(mysql_query("select count(id) as goods_total from projects where id like('%-%-%".substr($m1[$i1]["dir"],strlen($m1[$i1]["dir"])-1,1)."') and ".$pl[$i2][2]." and $commonwhere"),0)."</b></td>
						</tr>";
					}
					$content .= "</table><br><hr>".$startcontent . "<br><br>";
				}
				
				if(count($m2)>0 || count($m3)>0 || count($m4)>0 || count($m5)>0 || count($m6)>0){
					/*
					$content .= "<h2>Выборки по типу:</h2><table class=cat>";
					for($i1=0;$i1<count($m2);$i1++){
						preg_match("/\[[0-9]*\]/i",$m2[$i1]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
						$content .= "<tr valign=top>
						<td><a href=/".$m2[$i1]["dir"]."/><b>".preg_replace("/ *\[[0-9]*\]/i","",$m2[$i1]["menu"])."</b></a></td>
						<td><b>".@mysql_result(mysql_query("select count(id) as goods_total from projects where substring(projects.flores,1,1)='".($i1+1)."' and ".$not." and $commonwhere"),0)."</b> шт.</td></tr>";
					}
					$content .= "<tr valign=top><td>&nbsp;</td><td></td></tr>";
					for($i1=0;$i1<count($m3);$i1++){
						preg_match("/\[[0-9]*\]/i",$m3[$i1]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
						$content .= "<tr valign=top><td><a href=/".$m3[$i1]["dir"]."/><b>".preg_replace("/ *\[[0-9]*\]/i","",$m3[$i1]["menu"])."</b></a></td><td><b>";
						$content .= @mysql_result(mysql_query("select count(id) as goods_total from projects where substring(projects.flores,".($i1+2).",1)='1' and ".$not." and $commonwhere"),0);
						$content .= "</b> шт.</td></tr>";
					}
					$content .= "<tr valign=top><td>&nbsp;</td><td></td></tr>";
					for($i1=0;$i1<count($m4);$i1++){
						preg_match("/\[[0-9]*\]/i",$m4[$i1]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
						$content .= "<tr valign=top><td><a href=/".$m4[$i1]["dir"]."/><b>".preg_replace("/ *\[[0-9]*\]/i","",$m4[$i1]["menu"])."</b></a></td><td><b>";
						$content .= @mysql_result(mysql_query("select count(id) as goods_total from projects where name like('%[".$idv1."]%') and $commonwhere"),0);
						$content .= "</b> шт.</td></tr>";
					}
					$content .= "<tr valign=top><td>&nbsp;</td><td></td></tr>";
					for($i1=0;$i1<count($m5);$i1++){
						preg_match("/\[[0-9]*\]/i",$m5[$i1]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
						$content .= "<tr valign=top><td><a href=/".$m5[$i1]["dir"]."/><b>".preg_replace("/ *\[[0-9]*\]/i","",$m5[$i1]["menu"])."</b></a></td><td><b>";
						$content .= @mysql_result(mysql_query("select count(id) as goods_total from projects where name like('%[".$idv1."]%') and $commonwhere"),0);
						$content .= "</b> шт.</td></tr>";
					}
					
					//Дополнительные выборки
					for($i1=0;$i1<count($m8);$i1++){
						preg_match("/\[[0-9]*\]/i",$m8[$i1]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
						$content .= "<tr valign=top><td><a href=/".$m8[$i1]["dir"]."/><b>".preg_replace("/ *\[[0-9]*\]/i","",$m8[$i1]["menu"])."</b></a></td><td><b>";
						$content .= @mysql_result(mysql_query("select count(id) as goods_total from projects where name like('%[".$idv1."]%') and $commonwhere"),0);
						$content .= "</b> шт.</td></tr>";
					}

					if(host(0) == "postroi"){
						$content .= "<tr valign=top><td>&nbsp;</td><td></td></tr>";
						$content .= "<tr><td><a href=/$projects_dir/num/><b>Проекты по номерам</b></a></td><td></td></tr>";
					}
					*/
					$content .= "</table>";
				}
				
				include($t0);
			}
			else if(($n >= 2 && $n <= 4) && $v[0] == $projects_dir && ($v[1] == "k" || $v[1] == "p" || $v[1] == "d" || $v[1] == "s" || $v[1] == "m")){
				//Раздел каталога (по материалу)
				$dir = $v[0]."/".$v[1]; 
				$pl1 = ""; 

				for($i = 0; $i < count($pl); $i++) {
					if(isset($v[2]) && $v[2] == $pl[$i][1]) {
						$pladd = ' ' . $pl[$i][0];
						$pl1 = "and " . $pl[$i][2];
					}
				}

				if($pl1 != "")$url = "/".$v[0]."/".$v[1]."/".$v[2]."/";
				else $url = "/".$v[0]."/".$v[1]."/";
				$q1 = "select count(id) as goods_total from projects where projects.id like('%-%-%".$v[1]."') $pl1 and $commonwhere";
				$q2 = "select projects.*,count(projects_var.id) as varkol from projects 
					left join projects_var on projects.id=projects_var.name 
					group by projects.id 
					having projects.id like('%-%-%".$v[1]."') $pl1 and $commonwhere";
				
				if($n == 3 && !($v[2] == "do150" || $v[2] == "ot150do250" || $v[2] == "ot250do400" || $v[2] == "ot400" || preg_match("/^[0-9]{1,2}$/",$v[2])))
					header('HTTP/1.0 404 not found');
				else if($n == 4 && !(($v[2] == "do150" || $v[2] == "ot150do250" || $v[2] == "ot250do400" || $v[2] == "ot400") && preg_match("/^[0-9]{1,2}$/",$v[3])))
					header('HTTP/1.0 404 not found');
				else{
					include("$common_functions_dir/projects1.php");
					include($t0);
				}
			}
			else if(($n >= 2 && $n <= 4) && ($v[1] == "num")){
				$dir = $v[0]."/".$v[1]; 
				$url = "/".$v[0]."/".$v[1]."/"; 
				$q1 = "select count(id) as goods_total from projects where $commonwhere";
				$q2 = "select * from projects where $commonwhere";
				include("$common_functions_dir/projects1.php");
				include($t0);
			}
			else if(($n >= 2 && $n <= 3) && ($v[1] == "otl")){
				//Отложенные проекты
				$dir = $v[0]."/".$v[1];
				$url = "/".$v[0]."/".$v[1]."/";
				$otl = get_otl1('selected_projects');
				$q1 = "select count(id) as goods_total from projects where id in('". implode("','", $otl) . "') and $commonwhere";
				$q2 = "select * from projects where id in('". implode("','", $otl) . "') and $commonwhere";
				include("$common_functions_dir/projects1.php"); 
				include($t0);
			}
			else if($n == 2 && ($v[1] == "sravn")){
				//Сравнение проектов
				$dir = $v[0]."/".$v[1];
				$url = "/".$v[0]."/".$v[1]."/";
				$sravn = get_otl1('sravn_projects');
				$q1 = "select count(id) as goods_total from projects where id in('". implode("','", $sravn) . "') and $commonwhere";
				$q2 = "select projects.*,
					GROUP_CONCAT('<tr valign=top>',
						'<td>', mats.name, '</td>',
						'<td>', mats_prj.kol, '</td>',
						'<td>', 
							IF(mats_prj.ed = '0', 'м<sup>2</sup>', ''), 
							IF(mats_prj.ed = '1', 'м<sup>3</sup>', ''),
							IF(mats_prj.ed = '2', 'шт', ''),
							IF(mats_prj.ed = '3', 'м.п.', ''),
							IF(mats_prj.ed = '4', 'тонн', ''),
						'</td>',
						'<td>', IF(isnull(mats_prj.comment), '', mats_prj.comment), '</td>',
						'</tr>' SEPARATOR '') as matsname
					from projects 
					left join mats_prj on projects.id=mats_prj.prj_id
					left join mats on mats_prj.mats_id=mats.id
					where projects.id in('". implode("','", $sravn) . "') and " . substr($commonwhere, 0, strpos($commonwhere,"order")-1) . "
					group by projects.id
					order by projects.sflag,if((projects.id like 'q%') and not(projects.name like '%{v}%'),1,0),projects.o_pl,projects.id";
				include("$common_functions_dir/projects1.php");
				include($t0);
			}
			else if(($n == 2 || $n == 3) && ($v[1] == $as[0] || $v[1] == $as[1] || $v[1] == $as[2] || $v[1] == $as[3] || $v[1] == $as[4] || $v[1] == $as[5] || $v[1] == $as[6])){
				//Раздел каталога (по этажности)
				$dir = $v[0]."/".$v[1];
				$url = "/".$v[0]."/".$v[1]."/";
				$f = "_";
				if($v[1] == $as[0])$f = 1;
				if($v[1] == $as[1])$f = 2;
				if($v[1] == $as[2])$f = 3;
				if($v[1] == $as[3])$f = 4; 
				
				if($v[1] == $as[4])$aq = "(projects.name like '%[63]%' or ((v<9000 or h<9000) and ".$not."))";
				else if($v[1] == $as[5])$aq = "substring(projects.flores,2,1)='1' and ".$not;
				else if($v[1] == $as[6])$aq = "substring(projects.flores,3,1)='1' and ".$not;
				else $aq = "substring(projects.flores,1,1)='$f' and ".$not;
				
				$q1 = "select count(id) as goods_total from projects where $aq and $commonwhere";
				$q2 = "select projects.*,count(projects_var.id) as varkol 
					from projects left join projects_var on projects.id=projects_var.name 
					group by projects.id having $aq and $commonwhere";
				
				if($n == 2 && !($v[1] == $as[0] || $v[1] == $as[1] || $v[1] == $as[2] || $v[1] == $as[3] || $v[1] == $as[4] || $v[1] == $as[5] || $v[1] == $as[6]))
					header('HTTP/1.0 404 not found');
				else if($n == 3 && (!($v[1] == $as[0] || $v[1] == $as[1] || $v[1] == $as[2] || $v[1] == $as[3] || $v[1] == $as[4] || $v[1] == $as[5] || $v[1] == $as[6]) || !preg_match("/^[0-9]{1,2}$/",$v[2])))
					header('HTTP/1.0 404 not found');
				else if($n > 3)
					header('HTTP/1.0 404 not found');
				else{
					include("$common_functions_dir/projects1.php");
					include($t0);
				}
			}
			else if(($n == 2 || $n == 3) && (strpos(" ".$m4i,$v[1]) > 0 || strpos(" ".$m5i,$v[1]) > 0 || strpos(" ".$m8i,$v[1]) > 0)){	
				
				//Раздел каталога (выборки)
				$dir = $v[0]."/".$v[1];
				$url = "/".$v[0]."/".$v[1]."/";

				for($i=0;$i<count($m4);$i++){
					preg_match("/\[[0-9]*\]/i",$m4[$i]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
					if($m4[$i]["dir"] == $v[0] .'/'.$v[1])$id = $idv1;
				}
				for($i=0;$i<count($m5);$i++){
					preg_match("/\[[0-9]*\]/i",$m5[$i]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
					if($m5[$i]["dir"] == $v[0] .'/'.$v[1])$id = $idv1;
				}
				for($i=0;$i<count($m8);$i++){
					preg_match("/\[[0-9]*\]/i",$m8[$i]["menu"],$idv); $idv1 = substr($idv[0],1,strlen($idv[0])-1);	$idv1 = substr($idv1,0,strlen($idv1)-1);
					if($m8[$i]["dir"] == $v[0] .'/'.$v[1])$id = $idv1;
				}
				
				$q1 = "select count(id) as goods_total from projects where name like('%[".$id."]%') and $commonwhere";
				$q2 = "select projects.*,count(projects_var.id) as varkol
					from projects left join projects_var on projects.id=projects_var.name 
					group by projects.id 
					having projects.name like('%[".$id."]%') and $commonwhere";

				if(($n == 3 && !preg_match("/^[0-9]{1,2}$/",$v[2])) || $n > 3)header('HTTP/1.0 404 not found');
				else{
					
					include("$common_functions_dir/projects1.php");
					
					include($t0);
				}
			}
			else header('HTTP/1.0 404 not found');
		}
		else{
			header('HTTP/1.0 404 not found');
		}
	}
?>