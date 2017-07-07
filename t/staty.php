<? 
/**
 * Файл шаблона вывода каталога статей SAPE.
 * @author Дмитрий Заико
 * @copyright postroi.ru 13.06.2012
 * @link http://post2:600/
 * @package stroibur.ru
 * @version 1.000
 */
	include("../admin/conf.php"); 
	include("../f/common.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv=content-type content="text/html; charset=windows-1251" />
		<title>{title}</title>
    <meta name=keywords content="{keywords}" />
		<meta name=description content="{description}" />
    <link href=/t/s0.css rel=stylesheet type=text/css />
    <!--[if lte IE 6]><style type=text/css>@import url("/t/pngfix.css");</style><![endif]--> 
	</head>
  <body>
    <div id=head>
    	<div id=png><a href=/><img src=/i/logo.png width=284 height=367></a></div>
      <div id=cont>Строительство коттеджей в Московской области</div>
    </div>
    
    <div class=menu>
    	<div class=redline>
      	<a href=/>Строительство коттеджей</a> | 
        <a href=/<? echo $projects_dir; ?>/>Каталог проектов</a> | 
        <a href=/galery/>Фото строительства</a> | 
        <a href=/price/>Стомость строительства</a> |
        <a href=/contacts/>Контакты</a>
      </div>
      <div class=shadow></div>
    </div>
    
    <div id=main>
      <div id=left>
        <h3><a href=/prj/>Каталог проектов:</a></h3>
        <ul><? for($i=0;$i<count($m1);$i++)echo "<li><a href=/$projects_dir/".$m1[$i][1]."/>".$m1[$i][0]."</a></li>"; ?></ul>
        <ul><? for($i=0;$i<count($m2);$i++)echo "<li><a href=/".$m2[$i][1]."/>".$m2[$i][0]."</a></li>"; ?></ul>
        <ul><? for($i=0;$i<count($m3);$i++)echo "<li><a href=/".$m3[$i][1]."/>".$m3[$i][0]."</a></li>"; ?></ul>
      	<br>
        <h3>Поиск проекта дома:</h3>
        <noindex>
        	<form id=search action=/search/ method=get>
            <table>
            	<tr><td class=b>Номер (лат):</td><td><input type=text class=text name=num value=<? echo htmlspecialchars($HTTP_GET_VARS["num"]); ?>></td></tr>
           		<tr><td class=b>Площадь:</td><td><select name=pl><option value='0'>не важно</option><? for($i=0;$i<4;$i++)echo htmlspecialchars(selected($HTTP_GET_VARS["pl"],($i+1),$pl[$i][0])); ?></select></td></tr>
            	<tr><td class=b>Материал:</td><td><input class=checkbox type=checkbox name=k <? if($HTTP_GET_VARS["k"] == "on")echo "checked"; ?>>кирпич<input class=checkbox type=checkbox name=p <? if($HTTP_GET_VARS["p"] == "on")echo "checked"; ?>>пенобетон<br><input class=checkbox type=checkbox name=d <? if($HTTP_GET_VARS["d"] == "on")echo "checked"; ?>>дерево<input class=checkbox type=checkbox name=s <? if($HTTP_GET_VARS["s"] == "on")echo "checked"; ?>>каркас</td></tr>
            	<tr><td class=b>Этажей:</td><td><select name=flores><option value='0'>не важно</option><? for($i=1;$i<6;$i++)echo htmlspecialchars(selected($HTTP_GET_VARS["flores"],$i,$i)); ?></select></td></tr>
            	<tr><td class=b>Цоколь:</td><td><select name=cokol><option value='0'>не важно</option><option value='1' <? if($HTTP_GET_VARS["cokol"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($HTTP_GET_VARS["cokol"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
            	<tr><td class=b>Мансарда:</td><td><select name=mansarda><option value='0'>не важно</option><option value='1' <? if($HTTP_GET_VARS["mansarda"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($HTTP_GET_VARS["mansarda"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
            	<tr><td class=b>Габарит Х (мм):</td><td><input type=text class=text name=gabx value=<? echo htmlspecialchars($HTTP_GET_VARS["gabx"]); ?>></td></tr>
            	<tr><td class=b>Габарит Y (мм):</td><td><input type=text class=text name=gaby value=<? echo htmlspecialchars($HTTP_GET_VARS["gaby"]); ?>></td></tr>
            	<tr><td class=b>Помещения:</td><td><input class=checkbox type=checkbox name=garage <? if($HTTP_GET_VARS["garage"] == "on")echo "checked"; ?>>гараж<input class=checkbox type=checkbox name=sauna <? if($HTTP_GET_VARS["sauna"] == "on")echo "checked"; ?>>сауна<br><input class=checkbox type=checkbox name=waterpool <? if($HTTP_GET_VARS["waterpool"] == "on")echo "checked"; ?>>бассейн</td></tr>
            	<tr><td colspan=2><input class=submit type=submit src=/i/find1.jpg value=' Найти '></td></tr>
            </table>
	        </form>
        </noindex>
        <br>
        <h3>Статьи по строительству:</h3>
        <?
        	if(!$is_local){
						if(!defined('_SAPE_USER'))define('_SAPE_USER', '9f3d66ca09d65eeda2ed79b22080d9f9');
					 	require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php');
						$sape_article = new SAPE_articles();
						echo $sape_article->return_announcements();
					}
				?>
      </div>
      <div id=right>
					<h1>{header}</h1>
          {body}
      </div>
    </div>
    
    <div id=footer><div class=footer_left><div class=footer_right>
      
    	<div class=menu>
        <div class=redline>
          <a href=/>Строительство коттеджей</a> | 
          <a href=/<? echo $projects_dir; ?>/>Каталог проектов</a> | 
          <a href=/galery/>Фото строительства</a> | 
          <a href=/price/>Стомость строительства</a> |
          <a href=/contacts/>Контакты</a>
        </div>
        <div class=shadow></div>
    	</div>
      
      <div id=counters>
        <div class=conter>
          <!--Rating@Mail.ru COUNTER--><script language="JavaScript" type="text/javascript"><!--
          d=document;var a='';a+=';r='+escape(d.referrer)
          js=10//--></script><script language="JavaScript1.1" type="text/javascript"><!--
          a+=';j='+navigator.javaEnabled()
          js=11//--></script><script language="JavaScript1.2" type="text/javascript"><!--
          s=screen;a+=';s='+s.width+'*'+s.height
          a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth)
          js=12//--></script><script language="JavaScript1.3" type="text/javascript"><!--
          js=13//--></script><script language="JavaScript" type="text/javascript"><!--
          d.write('<a href="http://top.mail.ru/jump?from=1458479"'+
          ' target="_top"><img src="http://d1.c4.b6.a1.top.mail.ru/counter'+
          '?id=1458479;t=216;js='+js+a+';rand='+Math.random()+
          '" alt="Рейтинг@Mail.ru"'+' border="0" height="31" width="88"/><\/a>')
          if(11<js)d.write('<'+'!-- ')//--></script><noscript><a
          target="_top" href="http://top.mail.ru/jump?from=1458479"><img
          src="http://d1.c4.b6.a1.top.mail.ru/counter?js=na;id=1458479;t=216"
          border="0" height="31" width="88"
          alt="Рейтинг@Mail.ru"/></a></noscript><script language="JavaScript" type="text/javascript"><!--
          if(11<js)d.write('--'+'>')//--></script><!--/COUNTER-->
        </div>
        <div class=conter>		
          <!-- begin of Top100 code -->
          <a href="http://top100.rambler.ru/top100/"><img src="http://counter.rambler.ru/top100.cnt?1448557" alt="" width="1" height="1" border="0" /></a>
          <!-- end of Top100 code --><!-- begin of Top100 logo -->
          <a href="http://top100.rambler.ru/top100/"><img src="http://top100-images.rambler.ru/top100/banner-88x31-rambler-gray2.gif" alt="Rambler's Top100" width="88" height="31" border="0" /></a>
          <!-- end of Top100 logo -->
        </div>
        <div class=conter style='margin-right:20px;'>&copy; Стройбур <? echo date("Y"); ?>, 143900, М.О., г.Балашиха, Щелковское шоссе 54-Б<br>(495) <b>979-4762, 233-5828</b></div>
        <div class=sa>
        	<?
						if(!$is_local){
							$sape = new SAPE_client();
							echo $sape->return_links();
						}
					?>
        </div>
      </div>
    </div></div></div>
    <script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-7256208-7']);
			_gaq.push(['_trackPageview']);
		
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
  </body>
</html>