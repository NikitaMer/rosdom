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
	<table>
		<tr>
			<td align="center">
				Вы вошли как 
                
                <a class="Authlink" href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><? if ($arResult['FORM_TYPE']=='logout'):?><?=$arResult["USER_NAME"]?><? else:?><?='Гость'?><? endif;?></a>:
				
            </td>
 <?
 if(!CModule::IncludeModule("sale"))
	{
		ShowError(GetMessage("SALE_MODULE_NOT_INSTALL"));
		return;
	}
	$fUserID = CSaleBasket::GetBasketUserID(True);
	$fUserID = IntVal($fUserID);
	$num_products = 0;
	if ($fUserID > 0)
	{
		$num_products = CSaleBasket::GetList(
			array(),
			array("FUSER_ID" => $fUserID, "LID" => SITE_ID, "ORDER_ID" => "NULL", "CAN_BUY" => "Y", "DELAY" => "N"),
			array()
		);
	}
	//$_SESSION["SALE_BASKET_NUM_PRODUCTS"][SITE_ID] = intval($num_products);
	//p($num_products);
 ?>  
 <?
 $cc=0;
 foreach($_SESSION["basket"] as $basket_section_key=>$basket_section)
 {
	 foreach($basket_section['items'] as $decoration_key=>$decoration)
	 {
		
		foreach($decoration as $basket_key=>$basket_value)
		{
			$cc++;
		}
	}
 }
 ?>
<td><a href="/downloads/" class="AuthLinks">Скачать</a>  |  <a href="/personal/order/" class="AuthLinks">Ваши заказы</a>  |  
<a href="/personal/basket/" class="AuthLinks">Корзина (<span id="labelbasketcount"><?=$cc?></span>)</a>  |  <a href="/about/site-help.php" class="AuthLinks">Помощь по сайту</a></td>
		</tr>
	</table>
</div>