<?
	function parser($url){
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Парсер xml-файла. На входе URL xml-файла, на выходе 2ух мерный массив параметров.                         //
		// Первый индекс выходного массива отвечает за номер проекта (по порядку их следования в xml-файле).         //
		// Второй - за параметр (тег) внутри одного проекта. Максимальное число тегов в проекте 27.                  //
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$f = file($url); 
		$s = implode("",$f);
		$n = preg_match_all("/<project>(.*)<\/project>/U",$s,$project,PREG_SET_ORDER);
		
		$tags = array("perspectiva_small","perspectiva_big","plan_0","plan_1","plan_2","plan_3","plan_4","plan_m",
			"fasad_front","fasad_left","fasad_right","fasad_behind","prj_name","date","labels","materials","rooms",
			"v_gab","h_gab","ob_pl","jil_pl","pl_zast","price0","price1","price2","price3","price4");
		
		for($i=0;$i<$n;$i++){
			for($tag=0;$tag<count($tags);$tag++){
				preg_match_all("/<".$tags[$tag].">(.*)<\/".$tags[$tag].">/",$project[$i][1],$array,PREG_SET_ORDER);
				$a[$i][$tag] = $array[0][1];
				unset($array);
			}
		}
		return $a;
	}
?>

