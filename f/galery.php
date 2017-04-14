<?
	if(eregi("/[0-9]*/",$REQUEST_URI,$a)){
		$id = str_replace("/","",$a[0]);
		$res = query("select * from galery where id=$id and site='".host(1)."'");
		if($row = mysql_fetch_assoc($res)){
			$h1 = $row["comment"];
			$content = "<img class=p src=/i2/galery/".$row["id"].".jpg><p>".$row["des"]."</p>";
		}
	}
	else{
		include("$common_functions_dir/page1.php");
		$sale = ""; if($REQUEST_URI == "/galery/")$sale = "sale=0 and"; if($REQUEST_URI == "/sale/")$sale = "sale=1 and";
		$res = query("select * from galery where $sale site='".host(1)."'");
		$content .= "<div class=projects>";
		while($row = mysql_fetch_assoc($res))$content .= galery_breif($row);
		$content .= "</div>";
	}
	include("t/t0.php");
?>