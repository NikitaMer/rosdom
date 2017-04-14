<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");


$APPLICATION->SetTitle("404. Страница не найдена");

/*$APPLICATION->IncludeComponent("bitrix:main.map", ".default", array(
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"SET_TITLE" => "Y",
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION" => "Y"
	),
	false
);
*/
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?> 
<div style="padding: 0px; "> 	 
  <div style="padding: 20px 0px 0px 11px; "> 		 
    <font size=18><b>404 ошибка</b> 
      <br /></font>
     <span style="color: rgb(204, 0, 0); font-size:18px; ">Запрашиваемый Вами документ <?//echo $_SERVER['HTTP_REFERER'];?> не найден</span>
<br> <br>
   Вы можете:
    <ul> 
      <li><b><a href="/" >Перейти на главную</a></b></li>
     
      <li><b><a href="/map/" >Посмотреть карту сайта</a></b></li>
     </ul>
   		 
    <p> 
      <br />
     </p>
   	</div>
 </div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>