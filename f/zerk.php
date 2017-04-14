<html>
	<head>
		<title><? 
				if(host(0) != "catalog-domov"){
					if(host(0) != "stroybur")
						echo "Заказ проектов и консультации по телефонам: ".implode(", ",$phones);
					else
						echo "Консультации по телефонам: ".implode(", ",$phones);
				} 
			?></title>
		<meta http-equiv=content-type content='text/html; charset=windows-1251' />
		<meta name='robots' content='noindex,nofollow' />
		<style>
			.prices{padding-left:10px;}
			.prices .head{background:#ccc; font-weight:bold;}
			.prices .b{font-weight:bold;}
			.prices td{padding:10px; border-bottom:1px solid #aaa;}
			.prices .head td{border-bottom:0;}
			p.prices{color:#999; font-size:12px; margin-bottom:10px;}

			.hint{font-family:tahoma; font-size:12px; color:#0082c4; border-bottom: 1px dashed #0082c4; cursor:pointer; display:inline;}
			.hint1{font-family:tahoma; font-size:12px; color:white; background:#555; width:300px; position:absolute; margin:0 0 0 0px; padding:20px; display:none; line-height:16px; z-index:9;}
			
			#variants{border:1px dotted gray;}
			#variants{overflow:hidden; zoom:1; padding:10px;}
			.var{float:left; margin-right:20px; width:200px; height:250px;}
			.var img{padding:0; margin:0;}
			.var varimg{width:254px;}
			.var a{font-weight:bold;}
			
			#actions{border:1px dotted gray;}
		</style>
	</head>
	<body>
		<? 
			echo "<h1>".$h1."(S) - зеркальный вариант</h1>"; 
			echo project_p($project)."<br>";
			echo "<h2>Площади:</h2>";
				if($project[0]["o_pl"] != "" && $project[0]["o_pl"] != 0)echo "<b>Общая площадь: ".$project[0]["o_pl"]." м<sup>2</sup></b><br>";
				if($project[0]["g_pl"] != "" && $project[0]["g_pl"] != 0)echo "<b>Жилая площадь: ".$project[0]["g_pl"]." м<sup>2</sup></b><br>";
				if($project[0]["pl_z"] != "" && $project[0]["pl_z"] != 0)echo "<b>Площадь застройки: ".$project[0]["pl_z"]." м<sup>2</sup></b>";	
			echo "<br><br>";
			if($project_h2_mater1 != "" && $project_h2_mater2 != "")echo project_mater($project,$rashod)."<br>";
			
			if($project_h2_pln != "" && $project_h2_fsd != "")echo project_pln_fsd($project,$pln,$fsd)."<br>";
			
			
			if($project_h2_actions != "")echo project_actions($actions_set)."<br>";
			
			if($project_h2_vars != "")echo project_variants($variants)."<br>";
			
			if($project_h2_prices != "" && $project_h2_prices_table1 != "" && $project_h2_prices_hintword != "" && $project_h2_prices_table2 != "")
				echo project_prices($project[0],$actions_set);
				
			if(host(0) == "postroi")
			echo "
				<h2>Акция - вы видели этот проект дома дешевле? Мы продадим Вам по еще более низкой цене!</h2>
				<p>
					Пришлите нам конкретную <b>ссылку</b> и <b>ПОЛУЧИТЕ ПРОЕКТ ПО ЕЩЕ БОЛЕЕ НИЗКОЙ ЦЕНЕ</b>.
					Предложение действительно для цен, найденных в каталогах проектов (интернет-магазинах проектов), торгующих только лицензионными проектами. Мы оставляем за собой право не рассматривать некоторые заявки	по причине коммерческих договоренностей с нашими партнерами.<br>
					<b>Все цены на нашем сайте даны с учетом всех налогов.</b>
				</p>";
				
			if(host(0) != "catalog-domov"){
				echo "<h2>Контактная информация:</h2><p>";
				if(host(0) != "stroybur")
					echo "<b>Срок получения чертежей - от 1 до 5 дней.</b><br>
					Задать вопрос или заказать проект Вы можете по телефонам: <b>".implode(", ",$phones)."</b></br>
					Адрес офиса: <b>Москва, ул. Новая Басманная, д.19, офис 504.</b><br>
					Каталог проектов <b>".host(0).".ru</b><br>";
				else
					echo "Задать вопрос Вы можете по телефонам: <b>".implode(", ",$phones)."</b></br>
						Строительная компания \"Стройбур\": <b>".host(0).".ru</b><br>";
				echo "E-mail: <b>".$info_email."</b></p>";
			}
		?>
		
	</body>
</html>