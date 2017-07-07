
<?
	include("./admin/conf.php");
	include("./$common_functions_dir/common.php");
	include("./$common_functions_dir/redirector.php");


	setcookie('cookie', 'ok', time()+3600*24*365, '/');
    host();
	if(isset($_COOKIE[host(0)])){
		//$_SESSION['id'] = decoder($_COOKIE[host(0)],0);
		//$_SESSION['login'] = decoder($_COOKIE[host(0)],1);

		$_SESSION['session_id'] = decoder($_COOKIE[host(0)],0);
		$_SESSION['session_login'] = decoder($_COOKIE[host(0)],1);
	}


	if($is_local)mysql_connections("local");
	else mysql_connections("www");
        include("./$common_functions_dir/sides.php");
        for($i=1;$i<11;$i++) {
            $name = 'm'.$i;
            //debmes($$name);
        }

        //debmes($m1);

?>

<h2 style="font-weight: normal; font-size: 18px; margin-left: 18px; margin-bottom: 5px;"><a href="/projects/">Каталог проектов</a>:</h2>
<div class="b-widget b-widget__for-company">
<div class="description-for-company">
<ul id="leftmenu">
<?foreach($m1 as $k=>$m):?>
	<li><a href="<?=$m["dir"]?>"><?=$m["menu"]?></a></li>
<?endforeach?>
</ul>
</div>
</div>

<div class="b-widget b-widget__for-company">
<div class="description-for-company">
<ul id="leftmenu">
<?foreach($m2 as $k=>$m):?>
	<li><a href="<?=$m["dir"]?>"><?=(preg_replace('/\[.+\]/', '', $m["menu"]))?></a></li>
<?endforeach?>
</ul>
</div>
</div>

<div class="b-widget b-widget__for-company">
<div class="description-for-company">
<ul id="leftmenu">
<?foreach($m3 as $k=>$m):?>
	<li><a href="<?=$m["dir"]?>"><?=(preg_replace('/\[.+\]/', '', $m["menu"]))?></a></li>
<?endforeach?>
</ul>
</div>
</div>

<div class="b-widget b-widget__for-company">
<div class="description-for-company">
<ul id="leftmenu">
<?foreach($m4 as $k=>$m):?>
	<li><a href="<?=$m["dir"]?>"><?=(preg_replace('/\[.+\]/', '', $m["menu"]))?></a></li>
<?endforeach?>
</ul>
</div>
</div>

<div class="b-widget b-widget__for-company">
	<h2>Поиск проектов:</h2>
	<div class="description-for-company">
		<noindex>
			<form id=search action=/search/ method=get>
				<table>

					<tr>
						<td class=b>Площадь:</td>
						<td>
							<?if($USER->IsAdmin() || true):?>

								<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/jquery-ui.min.css" type="text/css" media="screen" />
								<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/jquery-ui.theme.min.css" type="text/css" media="screen" />

								<script type="text/javascript">
									$(document).ready(function(){
										  $( "#wormPl" ).slider({
											  min : 0,//Минимально возможное значение на ползунке
											  max : 1600,//Максимально возможное значение на ползунке
											  values : [0, 1600],//Значение, которое будет выставлено слайдеру при загрузке
											  step : 10,//Шаг, с которым будет двигаться ползунок
											  range: true,
											  create: function( event, ui ) {
														$('#contentWormPlFrom').html(jQuery("#wormPl").slider("values",0));
														$('#contentWormPlTo').html(jQuery("#wormPl").slider("values",1));
											  },
											  slide: function( event, ui ) {

														$('#contentWormPlFrom').html(jQuery("#wormPl").slider("values",0));
														$('#contentWormPlTo').html(jQuery("#wormPl").slider("values",1));

														$( "#plFrom" ).val(jQuery("#wormPl").slider("values",0));
														$( "#plTo" ).val(jQuery("#wormPl").slider("values",1));

													}
										});



										$( "#wormPr" ).slider({
											  values : [0, 400000],//Значение, которое будет выставлено слайдеру при загрузке
											  min : 0,//Минимально возможное значение на ползунке
											  max : 400000,//Максимально возможное значение на ползунке
											  step : 1000,//Шаг, с которым будет двигаться ползунок
											  create: function( event, ui ) {
												  $('#contentWormPrFrom').html(jQuery("#wormPr").slider("values",0));
												  $('#contentWormPrTo').html(jQuery("#wormPr").slider("values",1));
											  },
											  slide: function( event, ui ) {

														$('#contentWormPrFrom').html(jQuery("#wormPr").slider("values",0));
														$('#contentWormPrTo').html(jQuery("#wormPr").slider("values",1));

														$( "#prFrom" ).val(jQuery("#wormPr").slider("values",0));
														$( "#prTo" ).val(jQuery("#wormPr").slider("values",1));

													}
										});
									});
								</script>


								<div id="wormPl"></div>
								От <span id="contentWormPlFrom"></span> м<sup>2</sup> - до
								<span id="contentWormPlTo"></span> м<sup>2</sup>
								<input type="hidden" id="plFrom" name="plFrom" value="0" />
								<input type="hidden" id="plTo" name="plTo" value="0" />
								<p style="clear:both;"></p>
								</td>
								</tr>
								<tr style="display: none;">
								<td class=b>Цена:</td>
								<td>
									<div id="wormPr"></div>
									От <span id="contentWormPrFrom"></span> руб. - до
									<span id="contentWormPrTo"></span>&nbsp;руб.
									<input type="hidden" id="prFrom" name="prFrom" value="0" />
									<input type="hidden" id="prTo" name="prTo" value="0" />
									<p style="clear:both;"></p>
								</td>
								</tr>
							<?else:?>
								<select name=pl><option value='0'>не важно</option><? for($i=0;$i<4;$i++)echo htmlspecialchars(selected($HTTP_GET_VARS["pl"],($i+1),$pl[$i][0])); ?></select>
							<?endif?>
						</td>
					</tr>
					<tr ><td class=b>Материал:</td><td><input class=checkbox type=checkbox name=k <? if($HTTP_GET_VARS["k"] == "on")echo "checked"; ?>>&nbsp;кирпич <input class=checkbox type=checkbox name=p <? if($HTTP_GET_VARS["p"] == "on")echo "checked"; ?>>&nbsp;пенобетон <br><input class=checkbox type=checkbox name=d <? if($HTTP_GET_VARS["d"] == "on")echo "checked"; ?>>&nbsp;дерево <input class=checkbox type=checkbox name=s <? if($HTTP_GET_VARS["s"] == "on")echo "checked"; ?>>&nbsp;каркас</td></tr>
					</table>
				<br />
					<table class="hiddentable">
					<tr><td class=b>Номер (лат):</td><td><input type=text class=text name=num value=<? echo htmlspecialchars($HTTP_GET_VARS["num"]); ?>></td></tr>
					<tr ><td class=b>Этажей:</td><td><select name=flores><option value='0'>не важно</option><? for($i=1;$i<6;$i++)echo htmlspecialchars(selected($HTTP_GET_VARS["flores"],$i,$i)); ?></select></td></tr>
					<tr ><td class=b>Цоколь:</td><td><select name=cokol><option value='0'>не важно</option><option value='1' <? if($HTTP_GET_VARS["cokol"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($HTTP_GET_VARS["cokol"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
					<tr ><td class=b>Мансарда:</td><td><select name=mansarda><option value='0'>не важно</option><option value='1' <? if($HTTP_GET_VARS["mansarda"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($HTTP_GET_VARS["mansarda"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
					<tr ><td class=b>Габарит Х (мм):</td><td><input type=text class=text name=gabx value=<? echo htmlspecialchars($HTTP_GET_VARS["gabx"]); ?>></td></tr>
					<tr ><td class=b>Габарит Y (мм):</td><td><input type=text class=text name=gaby value=<? echo htmlspecialchars($HTTP_GET_VARS["gaby"]); ?>></td></tr>
					<tr ><td class=b>Помещения:</td><td><input class=checkbox type=checkbox name=garage <? if($HTTP_GET_VARS["garage"] == "on")echo "checked"; ?>>&nbsp;гараж <input class=checkbox type=checkbox name=sauna <? if($HTTP_GET_VARS["sauna"] == "on")echo "checked"; ?>>&nbsp;сауна <br><input class=checkbox type=checkbox name=waterpool <? if($HTTP_GET_VARS["waterpool"] == "on")echo "checked"; ?>>&nbsp;бассейн </td></tr>
				</table>
				<br>
				<a href="javascript:void(0);" id="showMore">Показать еще</a>
				<a href="javascript:void(0);" style="display:none;" id="hideMore">Скрыть</a>
				<br>
				<br>
				<table>
				<tr><td colspan=2><input class=submit type=submit src=/i2/find1.jpg value=' Показать проекты '></td></tr>
				</table>
			</form>
		</noindex>
	</div>
</div>

