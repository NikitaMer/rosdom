<? 
    include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

    CHTTP::SetStatus("404 Not Found"); 
    @define("ERROR_404","Y");  

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

    $APPLICATION->SetTitle("404. Страница не найдена");
?>                                      
<div style="padding: 20px 0px 0px 11px; "> 		 
    <font size=18><b>404 ошибка</b>   
    </font>
    <br />
    <span style="color: rgb(204, 0, 0); font-size:18px; ">Запрашиваемый Вами документ <?//echo $_SERVER['HTTP_REFERER'];?> не найден</span>
    <br> 
    <br>
    Вы можете:
    <ul> 
        <li><b><a href="/" >Перейти на главную</a></b></li>

        <li><b><a href="/map/" >Посмотреть карту сайта</a></b></li>
    </ul>      		 

 </div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>