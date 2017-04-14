<?
	if(isset($_GET["url"]) && isset($_GET["p"]) && $_GET["url"] != "" && $_GET["p"] != ""){
		include("admin/conf.php"); 
		include("$common_functions_dir/common.php");	
	
		if($is_local == 1) mysql_connections("local");
		else mysql_connections("www");
		
		if(isset($_GET["u"])) $uid = $_GET["u"];
		else $uid = '';
		
		$g = '';
		if(isset($_GET['g'])) {
			if($_GET['g'] != '') $g = $_GET['g'];
		}

		clicker($_GET["p"], $uid, $g);
				
		header("Location: ".$_GET["url"]);
	}
?>