<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    global $APPLICATION;
    
    //если мы в списке статей, но урл построен по шаблону детальной страницы статьи (/articles/article#CODE#/), то блокируем данную страницу (избавляемся от дублей)
    if (substr_count($APPLICATION->GetCurDir(), "/articles/article") > 0) {     
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
        @define("ERROR_404","Y");
        include($_SERVER["DOCUMENT_ROOT"].'/404.php');
        die();       
}    