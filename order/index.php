<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проекты домов");
$prj = htmlspecialchars($_GET['nproj']);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="http://davidjbradshaw.com/iframe-resizer/js/iframeResizer.min.js"></script>
<style> 
#id1, #id2 { border: none; }
</style>
<iframe id=id1 src="http://www.postroi.ru/diller_price.php?mode=order&prj=<?=$prj?>&stroy=33589" width="100%" scrolling="no"></iframe>  
<!--<iframe id=id2 src="http://www.postroi.ru/diller_price.php?mode=price&prj=<?=$prj?>" width="100%" scrolling="no"></iframe>-->       
<script type="text/javascript">iFrameResize({checkOrigin:false,enablePublicMethods:true});</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>