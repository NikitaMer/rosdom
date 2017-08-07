<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?> 
<?  
/*$ar_favorite_projects = array('123', '345', '789');
setcookie('favorite_projects', json_encode($ar_favorite_projects), time() + 60*60*24*365*5); 
$data = json_decode($_COOKIE['favorite_projects'], true);
arshow($data);*/                          
//add_to_favorites('21049');              
//delete_from_favorites('155121');
arshow('<----------->');
arshow($_COOKIE);

$ar_favorites = get_favorites_list();  
 
arshow($ar_favorites);
arshow('<----------->');
?>