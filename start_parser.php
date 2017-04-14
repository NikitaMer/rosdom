<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
    if($_POST["parser"]){
       AddingParceAddManually();
    } else {
?>
    <form action="<?$APPLICATION->GetCurPage()?>" method="post">
        <h2>Ручной запуск парсера</h2>
        <input type="submit" name="parser" value="Запустить выгрузку">
    </form>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>