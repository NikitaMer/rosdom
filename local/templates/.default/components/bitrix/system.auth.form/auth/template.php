<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<noindex>
    	<?
//echo "<pre>";print_r($arResult);echo "</pre>";
        global $USER;
	if ($USER->IsAuthorized()):				
		?>
<div class="usermenu" style="position:absolute; top:0px; right:0px; float_:right; border:1px dotted; padding:10px; width:240px; text-align:right;">

Вы вошли как <a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_NAME"]?></a><br /><br />
 <a href ="/personal/my/" >Мои материалы</a><br />
<div id="login_link"><span style="text-decoration:underline;" onclick="window.location='/?logout=yes'">Выход</span></div>


</div>
        <?
        else:
		?>
        <div id="login_link"><span style="text-decoration:underline;"  onclick="gray(); document.getElementById('login_form').style.display='block';">Войти</span>&nbsp;</div>
		<?global $loginError?>
		<?//if ($loginError == "Y"):?>
		<?if (strlen($arResult['ERROR']) >0 && $arResult['POST']['TYPE'] == 'AUTH'):?>
			<script>
				$(document).ready(function() {
					document.getElementById('login_form').style.display='block';gray();
				});
			</script>
		<?endif?>

<div id="login_form" style="z-index:11;" >

<div class="plantext" style="z-index:12">

<?
define("NEED_AUTH", true);
?>

<?if ($arResult["FORM_TYPE"] == "login"):?>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>
<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && ($arResult['USE_OPENID'] == 'Y' || $arResult['USE_LIVEID'] == 'Y')){?>
<script type="text/javascript">
function SAFChangeAuthForm(v)
{
	document.getElementById('at_frm_bitrix').style.display = (v == 'bitrix') ? 'block' : 'none';
	<? if ($arResult['USE_OPENID'] == 'Y') { ?>document.getElementById('at_frm_openid').style.display = (v == 'openid') ? 'block' : 'none';<?}?>
	<? if ($arResult['USE_LIVEID'] == 'Y') { ?>document.getElementById('at_frm_liveid').style.display = (v == 'liveid') ? 'block' : 'none';<?}?>
}

</script>
<table border="0" cellpadding="0" cellspacing="0">
<form id="choosemethod">
<tr>
	<td><input type="radio" id="auth_type_frm_bitrix" name="BX_AUTH_TYPE" value="bitrix" onclick="SAFChangeAuthForm(this.value)" checked></td>
	<td><label for="auth_type_frm_bitrix"><?=GetMessage('AUTH_A_INTERNAL')?></label></td>
</tr>
<? if ($arResult['USE_OPENID'] == 'Y') { ?>
<tr>
	<td><input type="radio" id="auth_type_frm_openid" name="BX_AUTH_TYPE" value="openid" onclick="SAFChangeAuthForm(this.value)"></td>
	<td><label for="auth_type_frm_openid"><?=GetMessage('AUTH_A_OPENID')?></label></td>
</tr>
<? } ?>
<? if ($arResult['USE_LIVEID'] == 'Y') { ?>
<tr>
	<td><input type="radio" id="auth_type_frm_liveid" name="BX_AUTH_TYPE" value="liveid" onclick="SAFChangeAuthForm(this.value)"></td>
	<td><label for="auth_type_frm_liveid"><?=GetMessage('AUTH_A_LIVEID')?></label></td>
</tr>
<? } ?>
</form>
</table>
<?}?>

<div id="at_frm_bitrix" style="z-index:13;">
<div style="width:272px; height:211px; background:url(/i/auth_form_bg.gif) no-repeat; position:relative; z-index:14;">
	<a style="position:absolute; top:2px; right:4px; cursor:pointer; color:#222 z-index:15;" onclick="javascript:document.getElementById('login_form').style.display='none';gray_hide();">[x]</a>
	<div style="width:240px; float:left; height:181px; text-align:center; padding:40px 0 0 25px; z-index:15;">
    	<form method="post" target="_top" action="/personal/my/" <?//=$arResult["AUTH_URL"]?>>
			<?
            if (strlen($arResult["BACKURL"]) > 0)
            {
            $arResult["BACKURL"] = "/personal/my/";
            ?> 
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?
            }
            ?>
            <?
            foreach ($arResult["POST"] as $key => $value)
            {
            ?>
            	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?
            }
            ?>
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <table style="width:95%; text-align:left; padding-top:5px;">
                    <tr>
                        <td colspan="3">
                        <?=GetMessage("AUTH_LOGIN")?>:<br />
                        <input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" /></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                        <?=GetMessage("AUTH_PASSWORD")?>:<br />
                        <input type="password" name="USER_PASSWORD" maxlength="50" size="17" /></td>
                    </tr>
                    <tr>
                   <!--     <td colspan="3" style="text-align:right;"><a class="Authlink" href="/personal/registration/forgot_pass.php"<?//=$arResult["AUTH_FORGOT_PASSWORD_URL"]?> rel="nofollow" ><?//=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a><br/><br/></td>  -->
                    </tr>
                    
                <?
                if ($arResult["STORE_PASSWORD"] == "Y")
                {
                ?>
                    <tr>
                        <td style="valign:top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></td>
                        <td style="width:100%"><label for="USER_REMEMBER_frm">&nbsp;<?='Запомнить меня'?></label></td>
                        <td style="align:right"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
                    </tr>
                <?
                }
                ?>
                <?
                if ($arResult["CAPTCHA_CODE"])
                {
                ?>
                    <tr>
                        <td colspan="3">
                        <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                        <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA"><br /><br />
                        <input type="text" name="captcha_word" maxlength="50" value="" /></td>
                    </tr>
                <?
                }
                ?>
            </table>
        </form>
    </div>
   <div style="width:240px; float:right; height:181px; display:none; text-align:center; padding:24px 14px 0 0; z-index:1500;">
   
    	<table style="width:95%; text-align:left;">
                <!--    <tr>
                    	<td>
                        	<p>
								<?if (!$arResult["ERROR"]):?>
									<!--[if lt IE 8]><br/><![endif]--> 
				<!--					Если Вы не являетесь нашим 
									клиентом, нажмите 
									кнопку <strong>"Регистрация"</strong>. <br/>
									<br/>
									Если Вы уже проходили процедуру
									регистрации на нашем сайте, 
									введите логин и пароль в блоке 
									слева  и нажмите кнопку <strong>"Войти"</strong>    -->
								<?else:?>
									<?global $loginError?>
									<?$loginError = "Y"?>
									<?ShowError("К сожалению, Вы неверно ввели логин и пароль. Попробуйте еще раз.<br />Проверьте язык ввода, а также что кнопка Caps-Lock не нажата.")?>
								<?endif?>
                            </p>
                <!--        </td>
                    </tr>     -->
                            <?
							if (($arResult["NEW_USER_REGISTRATION"] == "Y") && (!$arResult["ERROR"]))
							{
							?>
								<tr>
									<td style="text-align:right;"><a class="Authlink" style="color:#ff7201;" href="/personal/registration/?register=yes<?//=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?//=GetMessage("AUTH_REGISTER")?></a><br /></td>
								</tr>
							<?
							}
							?>

                    
        </table>
    </div>
    <div class="clear"></div>
</div>
</div>
<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_OPENID'] == 'Y'){?>
<div id="at_frm_openid" style="display: none">
<form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<table style="width:95%">
			<tr>
				<td colspan="2">
				<?=GetMessage("AUTH_OPENID")?>:<br />
				<input type="text" name="OPENID_IDENTITY" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
			</tr>

	</table>
</form>
</div>
<?}?>

<? if($arResult['NEW_USER_REGISTRATION'] == 'Y' && $arResult['USE_LIVEID'] == 'Y'){?>
<div id="at_frm_liveid" style="display: none">
<a href="<?=$arResult['LIVEID_LOGIN_LINK']?>" rel="nofollow"><?=GetMessage('AUTH_LIVEID_LOGIN')?></a>
</div>
<?}?>

<?else:?>

<form action="<?=$arResult["AUTH_URL"]?>">
	<table style="width:95%">
		<tr>
			<td style="align:center;">
				<?=$arResult["USER_NAME"]?><br />
				[<?=$arResult["USER_LOGIN"]?>]<br />
				<a class="Authlink" href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
			</td>
		</tr>
		<tr>
			<td style="align:center;">
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
			</td>
		</tr>
	</table>
</form>
<?endif?>
</div>

</div>

        <?
        endif;

	?>
</noindex>