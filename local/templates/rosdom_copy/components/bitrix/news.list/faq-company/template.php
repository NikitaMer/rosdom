<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <section class="faq">
            <dl class="b-list-faq">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?
if (count($arResult["ITEMS"]) > 0) {
?>
<script>
$(function (){
	$('#faq-tab').show();
});
</script>
<?
}
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<dt>
	  <!--div class="path">Раздел: <a href="#">Фундаменты</a> » <a href="#">Конструкции фундаментов</a></div-->

	  <h3><?echo $arItem['PREVIEW_TEXT']?></h3>
   </dt>
   <dd>
	  <p><?echo $arItem['DETAIL_TEXT']?></p>
	  <!--p class="more"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Читать полностью</a></p-->
   </dd>

<?endforeach;?>


            </dl>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
         </section>
 
 
 

               
