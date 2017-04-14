<?
	$i = 0;
		
	if(isset($_GET["num"]) && $_GET["num"] != "")
		$qa[$i++] = "(projects.id like('%" . htmlspecialchars(trim($_GET["num"])) . "%'))"; // по номеру
	
	//if(isset($_GET["pl"]) && $_GET["pl"] == 1) $qa[$i++] = "projects.o_pl<150"; // по площади
	//if(isset($_GET["pl"]) && $_GET["pl"] == 2) $qa[$i++] = "(projects.o_pl>=150 and projects.o_pl<250)";
	//if(isset($_GET["pl"]) && $_GET["pl"] == 3) $qa[$i++] = "(projects.o_pl>=250 and projects.o_pl<400)";
	//if(isset($_GET["pl"]) && $_GET["pl"] == 4) $qa[$i++] = "projects.o_pl>=400";
	
	if(isset($_GET['plFrom']) && isset($_GET['plTo'])) {
		$qa[$i++] = "(projects.o_pl>=".intval($_GET['plFrom'])." and projects.o_pl<=".intval($_GET['plTo']).")";
	}
	
	
	$i1 = 0;
	if((isset($_GET["k"]) && $_GET["k"] == "on") || (isset($_GET["materials"]) && $_GET["materials"] == "k")) $qa1[$i1++] = "projects.id like('%-%-%k')";
	if((isset($_GET["p"]) && $_GET["p"] == "on") || (isset($_GET["materials"]) && $_GET["materials"] == "p")) $qa1[$i1++] = "projects.id like('%-%-%p')";
	if((isset($_GET["d"]) && $_GET["d"] == "on") || (isset($_GET["materials"]) && $_GET["materials"] == "d")) $qa1[$i1++] = "projects.id like('%-%-%d')";
	if((isset($_GET["s"]) && $_GET["s"] == "on") || (isset($_GET["materials"]) && $_GET["materials"] == "s")) $qa1[$i1++] = "projects.id like('%-%-%s')";
	if($i1 != 0) $qa[$i++] = "(" . implode(" or ",$qa1) . ")";

	if(isset($_GET["gabx"]) && $_GET["gabx"] != ""){
		$h1 = htmlspecialchars($_GET["gabx"])- 500;
		$h2 = htmlspecialchars($_GET["gabx"])+ 500;
		$qa[$i++] = "((projects.h>='$h1' and projects.h<'$h2') or (projects.h>='$h2' and projects.h<'$h1'))";
	}
	if(isset($_GET["gaby"]) && $_GET["gaby"] != ""){
		$v1 = htmlspecialchars($_GET["gaby"])- 500;
		$v2 = htmlspecialchars($_GET["gaby"])+ 500;
		$qa[$i++] = "((projects.v>='$v1' and projects.v<'$v2') or (projects.v>='$v2' and projects.v<'$v1'))";
	}

	if(isset($_GET["sauna"]) && $_GET["sauna"] == "on") $qa[$i++] = "substring(projects.fs,4,1)=1";
	if(isset($_GET["waterpool"]) && $_GET["waterpool"] == "on") $qa[$i++] = "substring(projects.fs,5,1)=1";
	if(isset($_GET["garage"]) && $_GET["garage"] == "on") $qa[$i++] = "(substring(projects.fs,9,1)=1 or substring(projects.fs,9,1)=2)";

	if(isset($_GET["flores"]) && $_GET["flores"] != 0) $qa[$i++] = "substring(projects.flores,1,1)=".$_GET["flores"];
	if(isset($_GET["cokol"]) && $_GET["cokol"] != 0) {
		if($_GET["cokol"] == 1) $qa[$i++] = "substring(projects.flores,2,1)=1";
		else $qa[$i++] = "substring(projects.flores,2,1)=0";
	}
	if(isset($_GET["mansarda"]) && $_GET["mansarda"] != 0){
		if($_GET["mansarda"] ==1)$qa[$i++] = "substring(projects.flores,3,1)=1";
		else $qa[$i++] = "substring(projects.flores,3,1)=0";
	}

	if(isset($qa) && count($qa) > 0) $q = implode(" and ",$qa);
	if(isset($q) && $q != "") $q .= " and";
	else $q = '';
	
	//Каталог
	$bartype = 1;
	if($REQUEST_URI == "/rsrch/")$bartype = 2;
	$dir = $v[0]; 
	if(strpos($REQUEST_URI,"&page=") > 0)$url = str_replace(strrchr($REQUEST_URI,"&"),"",$REQUEST_URI)."&page=";
	else $url = $REQUEST_URI."&page=";

	$q1 = "select count(id) as goods_total from projects where $q $commonwhere";
	$q2 = "select projects.*,count(projects_var.id) as varkol
		from projects left join projects_var on projects.id=projects_var.name 
		group by projects.id 
		having $q $commonwhere";

	include("$common_functions_dir/projects1.php");	
	
	include($t0);
?>