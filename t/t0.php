<?php 
	if(preg_match("/projects\/[a-zA-Z]\-[0-9]{3,4}\-[0-9][a-zA-Z]/i", $REQUEST_URI))
		$in_project = true;
	else
		$in_project = false;
?>
<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />


	<meta name="google-site-verification" content="bjjl6ds0M0xsC7WgUMyMDNWzraV-8RAXD4X8h7Q1DDg" />
	<meta name='yandex-verification' content='625c24d2c596b38e' />
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<title><?php echo $title; ?></title>
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="description" content="<?php echo str_replace(array('<br>','<BR>'),'. ',$description); ?>" />

	
	<link href="http://www.rosdom.ru/bitrix/js/main/core/css/core.css?1363170002" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/system.auth.form/auth/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/menu/rosdom_infomenu/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/menu/rosdom_main_menu/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/news.detail/rosdom_text_only/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/menu/left_menu/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/news.list/articles_index/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/panel/main/popup.css?1363170002" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/rosdom/components/bitrix/news.list/faq_index1/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/news.list/video_index/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/rosdom/components/bitrix/news.list/documents-index/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/js/main/core/css/core_popup.css?1363170002" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/rosdom/components/bitrix/catalog.section/companies_tab/style.css?1363169990" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/.default/components/bitrix/menu/rosdom_bottom/style.css?1366128272" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/rosdom/styles.css?1366130192" type="text/css" rel="stylesheet" />
	<link href="http://www.rosdom.ru/bitrix/templates/rosdom/template_styles.css?1366130192" type="text/css" rel="stylesheet" />
	
	<script type="text/javascript" src="http://www.rosdom.ru/bitrix/js/main/core/core.js?1363170002"></script>
	<script type="text/javascript">BX.message({'LANGUAGE_ID':'ru','FORMAT_DATE':'DD.MM.YYYY','FORMAT_DATETIME':'DD.MM.YYYY HH:MI:SS','COOKIE_PREFIX':'BITRIX_SM','USER_ID':'','SERVER_TIME':'1382528026','SERVER_TZ_OFFSET':'14400','USER_TZ_OFFSET':'0','USER_TZ_AUTO':'Y','bitrix_sessid':'b8dd82c03dc3727b8bdbc4a5413963cd','SITE_ID':'s1','JS_CORE_LOADING':'Загрузка...','JS_CORE_NO_DATA':'- Нет данных -','JS_CORE_WINDOW_CLOSE':'Закрыть','JS_CORE_WINDOW_EXPAND':'Развернуть','JS_CORE_WINDOW_NARROW':'Свернуть в окно','JS_CORE_WINDOW_SAVE':'Сохранить','JS_CORE_WINDOW_CANCEL':'Отменить','JS_CORE_H':'ч','JS_CORE_M':'м','JS_CORE_S':'с','JSADM_AI_HIDE_EXTRA':'Скрыть лишние','JSADM_AI_ALL_NOTIF':'Показать все','JSADM_AUTH_REQ':'Требуется авторизация!','JS_CORE_WINDOW_AUTH':'Войти'})</script>
	<script type="text/javascript" src="http://www.rosdom.ru/bitrix/js/main/core/core_ajax.js?1363170002"></script>
	<script type="text/javascript" src="http://www.rosdom.ru/bitrix/js/main/session.js?1363170002"></script>
	<script type="text/javascript">
		bxSession.Expand(1440, 'b8dd82c03dc3727b8bdbc4a5413963cd', false, 'eda88b188f01a78bb0ea802d6cb558cf');
	</script>
	<script type="text/javascript" src="http://www.rosdom.ru/bitrix/js/main/core/core_window.js?1363170002"></script>
	<script type="text/javascript" src="http://www.rosdom.ru/bitrix/js/main/core/core_popup.js?1363170002"></script>
	<?/*<link href="http://www.rosdom.ru/bitrix/js/altasib/errorsend/css/window.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript">
		var errorSendMessages = {
			'head':'Орфографическая ошибка в тексте',
			'footer':'<b>Послать сообщение об ошибке автору?</b><br /><span style="font-size: 10px; color: #7d7d7d">(ваш браузер останется на той же странице)</span>',
			'comment':'Комментарий для автора (необязательно)',
			'TitleForm':'Сообщение об ошибке',
			'ButtonSend':'Отправить',
			'LongText':'Вы выбрали слишком большой объем текста.',
			'LongText2':'Попробуйте ещё раз.',
			'text_ok':'Сообщение отправлено.',
			'text_ok2':'Спасибо за внимание!'
		}
		var errorLogoImgSrc = 'http://www.rosdom.ru/logo.gif';
	</script>
    <script type="text/javascript" src="http://www.rosdom.ru/bitrix/js/altasib/errorsend/error.js?1363170002"></script>
    */?>
	<script type="text/javascript" src="http://www.rosdom.ru/bitrix/js/main/rsasecurity.js?1363170002"></script>            

	<script src="http://www.rosdom.ru/bitrix/templates/rosdom/js/modernizr-1.6.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
	<script src="http://www.rosdom.ru/bitrix/templates/rosdom/js/js.js"></script>
	<script type="text/javascript" src="http://www.rosdom.ru/js/gray.js"></script>
	<!--<script src="http://www.rosdom.ru/bitrix/templates/rosdom/js/jquery.cookie.js"></script>-->
	<script type="text/javascript" src="http://www.rosdom.ru/bitrix/templates/rosdom/js/fancybox/jquery.fancybox-1.3.4.js"></script>
	<link rel="stylesheet" href="http://www.rosdom.ru/bitrix/templates/rosdom/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
  	
  	
  	<script type="text/javascript" src="http://www.rosdom.ru/js/postroi/jquery-1.8.2.min.js"></script>
  	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  	<script type="text/javascript" src="http://www.rosdom.ru/js/postroi/jquery.cookie.js"></script>
  	<script type="text/javascript" src="http://www.rosdom.ru/js/postroi/tabs.js"></script>
  	  	
  	
  	<script src="http://www.rosdom.ru/bitrix/templates/rosdom/js/button_1plus.js"></script>
	<script src="http://www.rosdom.ru/bitrix/templates/rosdom/js/google-analitics.js"></script>


	<script src="/js/jquery.maskedinput-1.3.min.js"></script>

	<!--[if lt IE 7 ]>
		<script src="http://www.rosdom.ru/js/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
	<![endif]-->
	
	<style>
		body {
			width: expression(((document.documentElement.clientWidth || document.body.clientWidth) < 1200)?"1200px" :  "100%");
		}

		.projects{overflow:hidden; zoom:1;}
		.projects .psm { width:200px; height:150px; }
		.prj{float:left; width:200px; height:340px; margin:0 20px 20px 0;}
		.prj img{border:1px solid #dadada;}
		.prj p{font-size:14px; line-height:20px;}
		.prj p .add{font-size:14px; font-weight:100;}
		.prj a{font-weight:bold; margin:2px 0;}
		.projects .prj .psm{width:200px;}

		.bar a{border:1px solid #ddd; background:#f5f5f5; margin:2px; padding:2px; text-decoration:none; font-weight:bold; display:inline-block; width:20px; height:20px; text-align:center;}
		.bar a:hover{border:1px solid #ddd; background:#ddd; margin:2px; padding:2px; text-decoration:none; font-weight:bold; display:inline-block; width:20px; height:20px; text-align:center;}
		.bar a.selected{border:1px solid #ff6900; background:#ff6900; color:white; margin:2px; padding:2px; text-decoration:none; font-weight:bold; display:inline-block; width:20px; height:20px; text-align:center;}
	
		#variants{overflow:hidden; zoom:1;}
		.var{float:left; margin-right:20px; width:200px;}
		.var a{font-weight:bold;}

		.hint{font-family:tahoma; font-size:12px; color:#0082c4; border-bottom: 1px dashed #0082c4; cursor:pointer; display:inline;}
		.hint1{font-family:tahoma; font-size:12px; color:white; background:#555; width:300px; position:absolute; margin:0 0 0 0px; padding:20px; display:none; line-height:16px;}

		.prices .head{background:url(/i2/pr.jpg) left center repeat-x; font-weight:bold; color:white;}
		.prices .b{font-weight:bold;}
		.prices td{padding:10px; border-bottom:1px solid #aaa;}
		.prices .head td{border-bottom:0;}
		p.prices{color:#aaa;}

		#os_form table, #postform table{margin-left:9px; padding-top:10px;}
		#os_form table td, #postform table td{padding:3px 0;}
		#os_form table td.b, #postform table td.b{font-weight:bold;}
		#os_form .t, #postform .t{border:1px solid #bbb; width:480px;}
		#os_form textarea, #postform textarea{border:1px solid #bbb; width:480px; height:200px;}
		#os_form .t2, #postform .t2{border:1px solid #bbb; width:80px;}
		#os_form select, #postform select{border:1px solid #bbb; width:480px;}
		#os_form .captcha, #postform .captcha{width:100px; height:60px;}
		#os_form .form_mes, #postform .form_mes{font-size:10px; color:red; margin:0; padding:0; background:#efe8d2;}

		#actions { border-collapse: collapse; }
		#actions td { border: 1px solid #ccc; padding: 10px; }

		#variants { overflow: hidden; zoom: 1; }
		#variants .var { float: left; height: 220px; margin-right: 3%; width: 200px; }
		#variants .var img { width: 200px; }

		#tabs { margin: 20px 1%; }
		.item_header { display: inline-block; *display: inline; zoom: 1;
			position: relative; z-index: 100;
			border: 1px solid #aaa; cursor: pointer;
			padding: 10px; 
		}
		.first { margin-left: 1%; }

		.item_content { display: none; margin-top: -1px; height: 100%;
			border-top: 1px solid #aaa; padding: 1%; }

		.classon { border-bottom: 1px solid #fff; border-top: 3px solid orange; background: #fff; }
		.classoff { 
			border-bottom: 1px solid #aaa; border-top: 1px solid #aaa; background: #ddd;
		}

		#pln_fsd img{padding:5px; border:1px dotted #aaa; margin-left:10px;}
		#pln_fsd b{margin-left:10px;}

		#search input{ margin: 4px 2px; } 
		#search select { margin: 2px; }

		.plbuttons { margin-top: 10px; }
		.plbuttons .plbutton, 
		.plbuttons .plbuttonsel, 
		.plbuttons .plbutton:hover, 
		.plbuttons .plbuttonsel:hover
		{ 
			width: 130px; height: 30px; font-weight: normal; line-height: 22px; 
		}
		.plbuttons .plbuttonsel { background: #ddd; }
	</style>

	<script>
		$(window).load(function() {
			$('#tabs').tabs('classon', 'classoff');
			$(function() {
				$( ".postform_datepicker" ).datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: 'dd.mm.yy'
				});
			});

			$(function() {
				var availableTags = [
					"Директора",
					"Генерального директора",
					"Коммерческого директора"
				];
				$( "#doljnost" ).autocomplete({
					source: availableTags
				});
			});

			$(function() {
				var availableTags = [
					"Устава",
					"Доверенности от дата выдачи"
				];
				$( "#osnovanie" ).autocomplete({
					source: availableTags
				});
			});
		});
  	</script>

</head>
<body>

	<div id="grayBG" style="position:absolute; left:0; top:0; display:none; z-index:8;"></div>
	<div id="grayBGMessage" style="position:absolute; left:0; top:0; display:none; z-index:12;"></div>

	<div class="gl-wrapper">
		<header>
			<span class="logo"><a href="/"><img src="http://www.rosdom.ru/bitrix/templates/rosdom/images/logo.gif" alt="Rosdom" /></a></span>
			<div class="top-links">
				<nav>
					<ul>
						<li><a href="/map/">Карта сайта</a></li>
						<!--<li><a href="#">RSS</a></li>
						<li><a href="#">Atom</a></li>
						<li><a href="#">E-mail рассылка</a></li>-->
					</ul>
				</nav>
			</div>

			<div class="authorization" style="z-index: 11">
         
				<script type="text/javascript">
				top.BX.defer(top.rsasec_form_bind)({'formid':'system_auth_form57029','key':{'M':'awx1WGTXZ218zRsMiU2lXT6eHYt7NimdGnbld4Y14m3PSc3b3M8ewZoXLR/SUWA6jITO2pyieknXGSY30OjHKTBabtk532fQePAaDM36daL9QrR9nj0s++P+em4Hu5AZYoGpwRZsDpNWmtAALzicGhnrm6/K92y+3xtyyx8kFao=','E':'AQAB','chunk':'128'},'rsa_rand':'52679d3713a7d2.20366469','params':['USER_PASSWORD']});
				</script>
				
				<noindex>
    	        	<div id="login_link"><span style="text-decoration:underline;"  onclick="gray(); document.getElementById('login_form').style.display='block';">Войти</span>&nbsp;</div>
					<div id="login_form" style="z-index:11;" >
						<div class="plantext" style="z-index:12">
							<div id="at_frm_bitrix" style="z-index:13;">
								<div style="width:530px; height:211px; background:url(/i/auth_form_bg.gif) no-repeat; position:relative; z-index:14;">
									<a style="position:absolute; top:2px; right:4px; cursor:pointer; color:#222 z-index:15;" onclick="javascript:document.getElementById('login_form').style.display='none';gray_hide();">[x]</a>
									<div style="width:240px; float:left; height:181px; text-align:center; padding:40px 0 0 25px; z-index:15;">
										<form method="post" target="_top" action="/personal/my/" >
											<input type="hidden" name="backurl" value="/personal/my/" />
											<input type="hidden" name="AUTH_FORM" value="Y" />
											<input type="hidden" name="TYPE" value="AUTH" />
											
											<table style="width:95%; text-align:left; padding-top:5px;">
												<tr>
													<td colspan="3">
														Логин:<br />
														<input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" />
													</td>
												</tr>
												<tr>
													<td colspan="3">
														Пароль:<br />
														<input type="password" name="USER_PASSWORD" maxlength="50" size="17" />
													</td>
												</tr>
												<tr>
													<td colspan="3" style="text-align:right;"><a class="Authlink" href="/personal/registration/forgot_pass.php" rel="nofollow" >Забыли свой пароль?</a><br/><br/></td>
												</tr>
												<tr>
													<td style="valign:top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></td>
													<td style="width:100%"><label for="USER_REMEMBER_frm">&nbsp;Запомнить меня</label></td>
													<td style="align:right"><input type="submit" name="Login" value="Войти" /></td>
												</tr>
											</table>
										</form>
									</div>

									<div style="width:240px; float:right; height:181px; text-align:center; padding:24px 14px 0 0; z-index:1500;">
										<table style="width:95%; text-align:left;">
											<tr>
												<td>
													<p>
														<!--[if lt IE 8]><br/><![endif]--> 
														Если Вы не являетесь нашим 
														клиентом, нажмите 
														кнопку <strong>"Регистрация"</strong>. <br/>
														<br/>
														Если Вы уже проходили процедуру
														регистрации на нашем сайте, 
														введите логин и пароль в блоке 
														слева  и нажмите кнопку <strong>"Войти"</strong> 
													</p>
												</td>
											</tr>
											<tr>
												<td style="text-align:right;"><a class="Authlink" style="color:#ff7201;" href="http://www.rosdom.ru/personal/registration/?register=yes" rel="nofollow">Регистрация</a><br /></td>
											</tr>
										</table>
									</div>

									<div class="clear"></div>
									
								</div>
							</div>
						</div>
					</div>
				</noindex>
			</div>
			
			<div class=topsubmenu></div>
 
			<div class="search">

				<form action="/search/index.php">
					<input type="text" name="q" id="s" value="" maxlength="50" />&nbsp;<input class="search_button" name="s" type="submit" value="Поиск" />
					<!--a href="/search/" class="link-advanced-search">Расширенный поиск</a-->
				</form>

			</div>
		
			<div class="infomenu">
				<!- --> 

				<ul  class="infomenu" >

			<li style="list-style:none;"><a href="/projects/">Проекты домов</a></li>
		
			<li><a href="/photo/">Фотогалерея</a></li>
		
			<li><a href="/articles/">Статьи</a></li>
		
			<li><a href="/faq/">Вопросы-ответы</a></li>
		
			<li><a href="/documents/">Файлы</a></li>
		


					<!--<li style='list-style:none;'><a href="/photo/">Фотогалерея</a></li>
					<li ><a href="/video/">Видео</a></li>
					<li ><a href="/articles/">Статьи</a></li>
					<li ><a href="/faq/">Вопросы-ответы</a></li>
					<li ><a href="/documents/">Файлы</a></li>-->
				</ul>
			</div>

			<section class="b-tabs-descriptions w-tabs">
				<div class="b-tabs">
					<nav>
						<!- --> 
						<div id="mainmenu">
							<ul>
								<li><a href="/">Главная</a></li>
								<!--<li><a href="/equipment/" class="root-item">Оборудование</a></li>-->
								<!--<li><a href="/material/" class="root-item">Материалы</a></li>-->
								<!--<li><a href="/interior/" class="root-item">Интерьер</a></li>-->
								<!--<li><a href="/machinery/" class="root-item">Техника</a></li>-->
								<!--<li><a href="/service/" class="root-item">Услуги</a></li>-->
								<!--<li class="root-item-selected"><a href="/<?php /* echo $projects_dir; */ ?>/" class="root-item-selected">Проекты домов</a></li>-->
							</ul>

							<ul id="question" style="float:right"><li><a href='/os/<?php if($in_project) echo "?os_theme=2&os_id=" . strtolower($project[0]['id']) . "'>Задать вопрос по проекту № " . strtoupper($project[0]['id']); else echo "'>Обратная связь (по проектам)"; ?></a></li></ul>
						</div>
						<div class="menu-clear-left"></div>
						<!-- <pre>
						</pre> -->

						<div id="submenu">
							<div id="txt">
								Вы можете преобрести проекты домов на нашем сайте. По всем вопросам, связанным с проектами домов
								звоните по телефонам<br />
								в Москве: <b>(495) 744-75-54, (499) 265-35-35</b>,<br />
								в Санкт-Петербурге: <b>(812) 905-73-44</b><br />
								бесплатная линия для регионов: <b>(800) 555-04-47</b>
							</div>
						</div>

						<div class="clear_both"></div>
					</nav>
				</div>
				
				<div class="b-descriptions">
					<!--            <div id="ask_form" class="description">
					</div>-->
					<div class="description" id="main_plank"></div>
				</div>
			</section>
		</header>

		<aside>

			<?php 
				for($i=1; $i<=4; $i++) {
					$var = "m" . $i;
					$var = $$var;
					echo "<div class='b-widget b-widget__for-company'>"; 
					if($i == 1) echo "<h2><a href='/" . $projects_dir . "/'>Каталог проектов</a>:</h2>";
					echo "<div class='description-for-company'><ul id=leftmenu>";
					for($i1=0; $i1<count($var); $i1++) {
						echo "<li><a href=/" . $var[$i1]["dir"] . "/>" . preg_replace("/ *\[[0-9]*\]/i", "", $var[$i1]["menu"]) . "</a></li>";
					}
					echo "</ul></div></div>";
				}
			?>

			<div class="b-widget b-widget__for-company"> 
				<h2>Поиск проектов:</h2>
				<div class="description-for-company">
					<noindex>
						<form id=search action=/search/ method=get>
							<table>
								
								<tr>
									<td class=b>Площадь:</td>
									<td>
										<? if(true):?>
										
											<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/jquery-ui.min.css" type="text/css" media="screen" />
											<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/jquery-ui.theme.min.css" type="text/css" media="screen" />
																									<?
																									
																									$arStartPl = array(
																										'from' => 0,
																										'to' 	=> 1650
																									);
																									$startPl = '['.intval($arStartPl['from']).', '.intval($arStartPl['to']).']';
																									if(isset($_GET['plFrom'])) {
																										$startPl = '['.intval($_GET['plFrom']).', '.intval($_GET['plTo']).']';
																										$arStartPl = array(
																											'from' => intval($_GET['plFrom']),
																											'to' 	=> intval($_GET['plTo'])
																										);
																									}
																									?>
											<script type="text/javascript">
												$(document).ready(function(){
													  $( "#wormPl" ).slider({											  
														  min : 0,//Минимально возможное значение на ползунке
														  max : 1600,//Максимально возможное значение на ползунке
														  values : <?=$startPl?>,//Значение, которое будет выставлено слайдеру при загрузке
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
											<input type="hidden" id="plFrom" name="plFrom" value="<?=$arStartPl['from']?>" />
											<input type="hidden" id="plTo" name="plTo" value="<?=$arStartPl['to']?>" />
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
											<select name=pl><option value='0'>не важно</option><? for($i=0;$i<4;$i++)echo selected($_GET["pl"],($i+1),$pl[$i][0]); ?></select>
										<?endif?>							
									</td>
								</tr>		
								<tr ><td class=b>Материал:</td><td><input class=checkbox type=checkbox name=k <? if($_GET["k"] == "on")echo "checked"; ?>>&nbsp;кирпич <input class=checkbox type=checkbox name=p <? if($_GET["p"] == "on")echo "checked"; ?>>&nbsp;пенобетон <br><input class=checkbox type=checkbox name=d <? if($_GET["d"] == "on")echo "checked"; ?>>&nbsp;дерево <input class=checkbox type=checkbox name=s <? if($_GET["s"] == "on")echo "checked"; ?>>&nbsp;каркас</td></tr>
								</table>
							<br />
								<table class="hiddentable">
								<tr><td class=b>Номер (лат):</td><td><input type=text class=text name=num value=<? echo $_GET["num"]; ?>></td></tr>
								<tr ><td class=b>Этажей:</td><td><select name=flores><option value='0'>не важно</option><? for($i=1;$i<6;$i++)echo selected($_GET["flores"],$i,$i); ?></select></td></tr>
								<tr ><td class=b>Цоколь:</td><td><select name=cokol><option value='0'>не важно</option><option value='1' <? if($_GET["cokol"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($_GET["cokol"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
								<tr ><td class=b>Мансарда:</td><td><select name=mansarda><option value='0'>не важно</option><option value='1' <? if($_GET["mansarda"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($_GET["mansarda"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
								<tr ><td class=b>Габарит Х (мм):</td><td><input type=text class=text name=gabx value=<? echo $_GET["gabx"]; ?>></td></tr>
								<tr ><td class=b>Габарит Y (мм):</td><td><input type=text class=text name=gaby value=<? echo $_GET["gaby"]; ?>></td></tr>
								<tr ><td class=b>Помещения:</td><td><input class=checkbox type=checkbox name=garage <? if($_GET["garage"] == "on")echo "checked"; ?>>&nbsp;гараж <input class=checkbox type=checkbox name=sauna <? if($_GET["sauna"] == "on")echo "checked"; ?>>&nbsp;сауна <br><input class=checkbox type=checkbox name=waterpool <? if($_GET["waterpool"] == "on")echo "checked"; ?>>&nbsp;бассейн </td></tr>																	
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
					<? /*
					<noindex>
						<form id=search action=/search/ method=get>
							<table>
								<tr><td class=b>Номер (лат):</td><td><input type=text class=text name=num value=<? echo $HTTP_GET_VARS["num"]; ?>></td></tr>
								<tr><td class=b>Площадь:</td><td><select name=pl><option value='0'>не важно</option><? for($i=0;$i<4;$i++)echo selected($HTTP_GET_VARS["pl"],($i+1),$pl[$i][0]); ?></select></td></tr>
								<tr><td class=b>Материал:</td><td><input class=checkbox type=checkbox name=k <? if($HTTP_GET_VARS["k"] == "on")echo "checked"; ?>>кирпич<input class=checkbox type=checkbox name=p <? if($HTTP_GET_VARS["p"] == "on")echo "checked"; ?>>пенобетон<br><input class=checkbox type=checkbox name=d <? if($HTTP_GET_VARS["d"] == "on")echo "checked"; ?>>дерево<input class=checkbox type=checkbox name=s <? if($HTTP_GET_VARS["s"] == "on")echo "checked"; ?>>каркас</td></tr>
								<tr><td class=b>Этажей:</td><td><select name=flores><option value='0'>не важно</option><? for($i=1;$i<6;$i++)echo selected($HTTP_GET_VARS["flores"],$i,$i); ?></select></td></tr>
								<tr><td class=b>Цоколь:</td><td><select name=cokol><option value='0'>не важно</option><option value='1' <? if($HTTP_GET_VARS["cokol"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($HTTP_GET_VARS["cokol"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
								<tr><td class=b>Мансарда:</td><td><select name=mansarda><option value='0'>не важно</option><option value='1' <? if($HTTP_GET_VARS["mansarda"] == "1")echo "selected"; ?>>есть</option><option value='2' <? if($HTTP_GET_VARS["mansarda"] == "2")echo "selected"; ?>>нет</option></select></td></tr>
								<tr><td class=b>Габарит Х (мм):</td><td><input type=text class=text name=gabx value=<? echo $HTTP_GET_VARS["gabx"]; ?>></td></tr>
								<tr><td class=b>Габарит Y (мм):</td><td><input type=text class=text name=gaby value=<? echo $HTTP_GET_VARS["gaby"]; ?>></td></tr>
								<tr><td class=b>Помещения:</td><td><input class=checkbox type=checkbox name=garage <? if($HTTP_GET_VARS["garage"] == "on")echo "checked"; ?>>гараж<input class=checkbox type=checkbox name=sauna <? if($HTTP_GET_VARS["sauna"] == "on")echo "checked"; ?>>сауна<br><input class=checkbox type=checkbox name=waterpool <? if($HTTP_GET_VARS["waterpool"] == "on")echo "checked"; ?>>бассейн</td></tr>
								<tr><td colspan=2><input class=submit type=submit src=/i2/find1.jpg value=' Найти '></td></tr>
							</table>
						</form>
					</noindex>
					*/?>
				</div>
			</div>

			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-5601470063074614";
				/* Главная (левая) */
				google_ad_slot = "8635621308";
				google_ad_width = 250;
				google_ad_height = 250;
				//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
			<div style="padding-bottom:20px;"> </div>
			
			<div class="b-widget b-widget__for-company"> 
				<div style="padding: 12px; cursor: pointer; background-color: rgb(234, 234, 234);" id="err"> 
					<h2>Нашли ошибку?</h2>
					<div style="clear: both;"> 
						<div id="err_text" style="display: none;"> 
							Выделите текст, который считаете ошибочным,  и нажмите комбинацию клавиш Ctrl+Enter.  В появившемся окне введите комментарий к ошибке. Все ошибки будут оперативно устранены.
						</div>
					</div>
				</div>

				<div style="margin-top:25px">
					<a href=/projects/><img src=/i2/2000.jpg alt="Каталог проектов домов, коттеджей" title="Каталог проектов домов, коттеджей" /></a>
				</div>

				<script type="text/javascript">
					$(function (){
						$("div#err").click(function(){
							$("#err_text").slideToggle("fast");
						});
					});
				</script>
			</div>
		</aside>
		
		<article>
			<section class="last-posts w-tabs"> 
				<table style='margin-bottom:10px; width:650px;' id='h2header'>
					<tr>
						<td>
							<?php 
								echo "<h1 style='margin:0;padding:0;'>" . $h1 . "</h1>";
								if($in_project) 
									echo "общая площадь: <b style='margin:0;padding:0;'>" . $project[0]["o_pl"] . "</b> м<sup>2</sup>"; 
							?>
						</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td align="right">
							<?php 
								if($in_project) 
									echo "<a href='/postform/?nproj=" . strtolower($project[0]['id']) . 
										"' style='text-align:center; border-radius:3px; background:#de4139; color:white; padding:5px 20px; display:inline-block; font-size:20px; text-decoration:none;'>Купить проект</a>"; 
							?>
						</td>
					</tr>
				</table>
				<?php 
				if($in_project){
					echo project_p($project);
					if($project_h2_mater1 != "" && $project_h2_mater2 != "") echo project_mater($project,$rashod) . "<br>";
					if($project_h2_actions != "") echo project_actions($actions_set) . "<br>";
					if($project_h2_pln != "" && $project_h2_fsd != "") echo project_pln_fsd($project,$pln,$fsd) . "<br>";
					if($project_h2_des != "") echo project_des($des,$project) . "<br>";
					if($project_h2_vars != "") echo project_variants($variants) . "";
					if($project_h2_prices != "" && $project_h2_prices_table1 != "" && $project_h2_prices_hintword != "" && $project_h2_prices_table2 != "")
						echo project_prices($project[0], $actions_set);
					

					if($project[0]['rosdom_description'] !== "")
						echo "<p style='font-weight:bold;margin-top:20px;'>" . $project[0]['rosdom_description'] . "</p>";

					$similar = mysql_array("select projects_similar.*, projects.rosdom_h1 
						from projects_similar 
						inner join projects on projects_similar.similar = projects.id
						where projects_similar.project='".strtolower($project[0]["id"])."'");
					if(count($similar)) {
						echo "<br /><br /><h2>Проекты этой серии:</h2><div style='overflow:hidden;zoom:1'>";
						$rosdom_projects = "http://www.rosdom.ru/projects/";
						foreach($similar as $s)
							echo "<div class='var'>
								<a href='" . $rosdom_projects . strtolower($s['similar'])."/' target='_blank'><img src='/projects/".strtolower($s['similar'])."/p-sm.jpg' class='varimg' width='200' height='150' alt='".str_replace(",","",strip_tags($s['rosdom_h1']))."' title='".str_replace(",","",strip_tags($s['rosdom_h1']))."'/></a><br />
								<a href='" . $rosdom_projects . strtolower($s['similar'])."/' target='_blank'>".$s['rosdom_h1']."</a>
								</div>";
						echo "</div><br /><br />";
					}
				}
				else 
					echo $content;
				?>
				
				
</article>
<div class="push"><!-- --></div>
</div>
<footer>
<div class="w-foot">
<section class="foot-links"> 
<!- --> 


<ul id="horizontal-multilevel-menu">
<li>Основные разделы				<ul>
<li><a href="http://www.rosdom.ru/interior/">Интерьер</a></li>
<li><a href="http://www.rosdom.ru/material/">Материалы</a></li>
<li><a href="http://www.rosdom.ru/equipment/">Оборудование</a></li>
<li><a href="http://www.rosdom.ru/machinery/">Техника</a></li>
<li><a href="http://www.rosdom.ru/service/">Услуги</a></li>
</ul></li>	
<li>Для компаний				<ul>
<li><a href="/#">Заявка на регистрацию</a></li>
<li><a href="http://www.rosdom.ru/equipment/">Разместить пресс-релиз</a></li>
<li><a href="/#">Разместить статью</a></li>
<li><a href="/#">Реклама на сайте</a></li>
</ul></li>	
<li>Проекты домов				<ul>
<li><a href="http://www.rosdom.ru/<? echo $projects_dir; ?>/d/">Проекты деревянных домов</a></li>
<li><a href="http://www.rosdom.ru/<? echo $projects_dir; ?>/p/">Проекты домов из пеноблоков</a></li>
<li><a href="http://www.rosdom.ru/<? echo $projects_dir; ?>/s/">Проекты каркасных домов</a></li>
<li><a href="http://www.rosdom.ru/<? echo $projects_dir; ?>/k/">Проекты кирпичных домов</a></li>
</ul></li>	
<li>О проекте				<ul>
<li><a href="/about/agreement/">Соглашение с пользователем</a></li>
</ul></li>	
<li>Навигация				<ul>
<li><a href="http://www.rosdom.ru/map/">Карта сайта</a></li>
<li><a href="http://www.rosdom.ru/firms/">Компании</a></li>
<li><a href="/#">Помощь</a></li>
</ul></li>
</ul>

<div class="menu-clear-left"></div>
</section>

<section class="foot-data">
<div class="b-copyright">
&copy; 2011 Rosdom.ru. Все права защищены.<br />
Автор: Алексей Пензин.
</div>
<div class="b-counter">
<div class="counter">
</div>
<div class="counter">
<noindex><!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.1;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet-->

<a href="https://www.facebook.com/Rosdom.ru" target="_blank"><img src="/logo_facebook.png"></a>
<a href="https://twitter.com/Rosdom_RU" target="_blank"><img src="/logo_twitter.png"></a>
<a href="https://plus.google.com/109666258847080290759?prsrc=3" target="_blank"><img src="/logo_g.png"></a>
<a href="https://plus.google.com/u/0/b/105793966849441883946/" target="_blank"><img src="/logo_gplus.png"></a>

</noindex>
</div>
</div>
<div class="b-contacts">
<div id="txt">
Эл. почта: <a href="mailto:info@rosdom.ru" >info@rosdom.ru</a>  
<br />
Телефон: (495) 508-74-09</div>
</div>
</section>
</div>
<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
(function(w, c) {
(w[c] = w[c] || []).push(function() {
try {
w.yaCounter182498 = new Ya.Metrika({id:182498, enableAll: true, webvisor:true});
}
catch(e) { }
});
})(window, "yandex_metrika_callbacks");
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
<noscript><div><img src="//mc.yandex.ru/watch/182498" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</footer>


</body>
</html>