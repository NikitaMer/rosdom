<?
	$res = query("select * from $pages where dir='$a' and site='".host(1)."'");
	$nopage = 0;
	if($row = mysql_fetch_assoc($res)){
		mysql_free_result($res);
		//Страница
		$id = $row["id"];
		$title = $row["title1"];
		$keywords = $row["keyw"];
		$description = $row["des"];
		$h1 = $row["name"];
		$content = ((host(0)=="postroi")?"<hr />":"") . $row["content"];
		$lastedit = $row["lastedit"];

		// формируем путь;
		if(host(0)=="praktika-new" || host(0)=="trening-new")
			$path_urls=getpagespathurls($row["parent"],$row["menu"],$row["dir"]);
		
		if($row["funcname"]=="page") {
			//Список дочерних страниц
			$res = query("select * from $pages where parent=$id and site='".host(1)."' order by lastedit desc");
			$content .= "<ul>";
			while($row = mysql_fetch_assoc($res)) {
				preg_match('/[a-zA-Zа-яА-Я]\-[0-9]{3,4}\-[0-9][a-zA-Zа-яА-Я]/i', $row["name"], $pn);
				$content .= "<li>
					<b><a href=/" . $row["dir"] . "/>" . $row["name"] . "</a></b><br />
					<i class='date'>".mysql_date($row["lastedit"])."</i><br />";
				if(isset($pn[0]) && $pn[0] != '') 
					$content .= "<img src='/projects/" . strtolower($pn[0]) . "/p-sm.jpg' align='left' style='width:100px; margin:0 5px 5px 0' />";
				$content .= getfirst(strip_tags($row["content"]), 7) . 
					"<br /><a href=/".$row["dir"]."/>подробнее</a><br /><br /></li>";
			}
			$content .= "</ul>";
			mysql_free_result($res);
		}
	}
	else $nopage = 1;
?>