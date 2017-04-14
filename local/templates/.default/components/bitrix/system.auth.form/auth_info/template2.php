<div class="plantext">
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
a.Authlink, span.Authlink
{
	font-family:Tahoma;
	font-size:12px;
	color:#1a7ca3;
	text-decoration:underline;
}
a:hover.Authlink
{
	font-family:Tahoma;
	font-size:12px;
	color:#1a7ca3;
	text-decoration:none;
}
.plantext
{
	font-family:Tahoma;
	font-size:12px;
	color:#454646;
	text-decoration:none;
}

a.AuthLinks
{
	font-family:Tahoma;
	font-size:12px;
        color:#454646;
	text-decoration:none;
}
</style>
	<table width="100%">
		<tr>
			<td align="center">
				Вы вошли как 
                
                <a class="Authlink" href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><? if ($arResult['FORM_TYPE']=='logout'):?><?=$arResult["USER_NAME"]?><? else:?><?='Гость'?><? endif;?></a>:
				
            </td>
<td><a href="#" class="AuthLinks">Скачать</a>  |  <a href="/personal/order/" class="AuthLinks">Ваши заказы</a>  |  
<a href="/personal/basket/" class="AuthLinks">Корзина</a>  |  <a href="/about/site-help.php" class="AuthLinks">Помощь по сайту</a></td>
		</tr>
	</table>
</div>