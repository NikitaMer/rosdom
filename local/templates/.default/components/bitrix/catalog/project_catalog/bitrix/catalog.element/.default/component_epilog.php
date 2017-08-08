<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;                 
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency)
	{
	?>
	<script type="text/javascript">
		BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
	</script>
<?
	}
}
if (isset($templateData['JS_OBJ']))
{
?><script type="text/javascript">
BX.ready(BX.defer(function(){
	if (!!window.<? echo $templateData['JS_OBJ']; ?>)
	{
		window.<? echo $templateData['JS_OBJ']; ?>.allowViewedCount(true);
	}
}));
</script><?
}
?>

<?//Скрипты для работой с избранными?>
<?$arFavoriteProjects = get_favorites_list();?>  
<?if(in_array($arResult['ID'], $arFavoriteProjects)) { $isFavorite = 'Y'; } else { $isFavorite = 'N'; }?>
<script>
$(document).ready(function(){  
    var is_favorite = '<?=$isFavorite?>'; 
    
    if(is_favorite == 'Y'){
        $('.delete_from_favorite').show();   
    } else {                       
        $('.add_to_favorite').show();           
    }
    
    $('.add_to_favorite').click(function(e){   
        e.preventDefault();   
        $.ajax({
            type: "POST",
            url: "/ajax/add_to_favorites.php",
            data: {favorite_project: $(this).attr("data-project-id")}
        }).done(function() {                                                                        
            $('.add_to_favorite').hide();
            $('.delete_from_favorite').show();                                                                                          
        });                                                                          
    });
    $('.delete_from_favorite').click(function(e){
        e.preventDefault();                   
        $.ajax({
            type: "POST",
            url: "/ajax/delete_from_favorites.php",
            data: {favorite_project: $(this).attr("data-project-id")}
        }).done(function() {                                                                                                                                      
            $('.delete_from_favorite').hide();
            $('.add_to_favorite').show();                                                                                                   
        });     
    }) 
});                          
</script>                                                                                       