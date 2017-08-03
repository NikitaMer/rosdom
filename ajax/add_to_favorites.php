<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?
if($_REQUEST['favorite_project']) {
    add_to_favorites($_REQUEST['favorite_project']);    
}
?>