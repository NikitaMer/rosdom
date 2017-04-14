<?
	if(count($v)==1) {
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// вывод всех тренеров
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		$res = query("select * from $pages where dir='$a'");
		if($row = mysql_fetch_assoc($res))
		{
			$keywords=$row["keyw"];
			$description=$row["des"];
			$title=$row["title1"];
			$h1=$row["name"];
			
			
			$path_urls=getpagespathurls($row["parent"],$row["menu"],$row["dir"]);
			mysql_free_result($res);

			$res = query("select * from praktika_treners where aktiv and site='".host(1)."' order by num");
			while($row = mysql_fetch_assoc($res))
			{
				$content.="<a href=/" . $row["url"] . "/><b>" . $row["name"] . "</b></a><br>";
				$content.=$row["anonce"] . "<BR>";
			}
			mysql_free_result($res);
		}
	}
	if(count($v)==2) {
			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			// вывод подробной информации о трененре
			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			$res = query("select * from praktika_treners where aktiv and url='" . implode($v,"/") . "' and site='".host(1)."'");
			if($row = mysql_fetch_assoc($res))
			{
				$path_urls=getcatalogpath(549) . "&nbsp;/&nbsp;$tmp<a href=/" . $row["url"] . "/ title=\"" . $row["name"] . "\">" . $row["name"] . "</a>";
				$keywords=$description=$title=$h1=$row["name"];
				$content=$row["detail"] . "<BR><BR><a href=/command/>Все психологи, тренеры, бизнес-тренеры Компании ПРАКТИКА >></a>";
			}
			else{
				header("HTTP/1.1 404 Not Found");
				exit(1);
			}
			mysql_free_result($res);
	}
	include($t0);
?>