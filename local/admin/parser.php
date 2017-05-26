<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

$APPLICATION->SetTitle('parser');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<?
    if($_POST["parser"]){
       AddingParceAdd(true);
    } else {
?>
    <form action="<?$APPLICATION->GetCurPage()?>" method="post">
        <h2>Ручной запуск парсера</h2>
        <input type="submit" name="parser" value="Запустить выгрузку">
    </form>
<?}?>

<?
$lAdmin->DisplayList();
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>