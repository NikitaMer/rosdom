<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div>
<table class="list" >
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>


<tr>
	<td valign="top">
		<b><?echo $arItem["NAME"]?></b><br><?=$arItem["PREVIEW_TEXT"]?>
	</td>
	<td valign="top">
		<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" target="_blank"> Просмотреть </a>
	</td>
	<td valign="top">
		<a href="edit.php">Редактировать</a>
	</td>

<?endforeach;?>
</table>
</div>

</div>
