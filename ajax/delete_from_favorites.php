<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?
if($_REQUEST['favorite_project']) {
    delete_from_favorites($_REQUEST['favorite_project']);    
}
?>