<?
	include("$common_functions_dir/page1.php");
	
	$content .= "<table cellspacing=5>";
	for($i=0;$i<count($actions);$i++)$content .= "<tr><td><img src=/i2/actions/".$actions[$i]["file"]." align=absmiddle></td><td>".$actions[$i]["name"]."</td></tr>";
	$content .= "</table>";
	
	if(!$nopage)include($t0);
	else header("HTTP/1.1 404 Not Found");
?>