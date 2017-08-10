<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));?>
<div class="<? echo $arCurView['CONT']; ?>">
<?
if ($arResult["SECTION"]["PATH"] == false){
    ?><h1><?=GetMessage("PROJECTS_CATALOG")?></h1><?
    $cnt = CIBlockElement::GetList(array(),array('IBLOCK_ID'=>$arParams["IBLOCK_ID"],"!SECTION_ID" => false ,'ACTIVE '=>'Y'),false, false, array("ID","IBLOCK_SECTION_ID"));?>
    <p class="colprj"><?=GetMessage("TOTAL_NUMBER")?><b class="total"><?=$cnt->SelectedRowsCount()?></b></p>
    <table class="cat">
    <tr><td><b><?=GetMessage("PROJECT_CATEGORIES")?></b></td><td></td><td><b><?=GetMessage("AMOUNT")?></b></td></tr>
    <?foreach ($arResult["SECTIONS"] as $arSection) {
        if($arSection["UF_SORT_MENU"] == 1){?>
        <tr valign="top">
            <td rowspan="5"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img class="cat_td_img" src="<?=$arSection['PICTURE']['SRC']?>"></a></td>
            <td><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><b><?=$arSection["NAME"]?></b></a></td>
            <td align="center"><b><?=CIBlockSection::GetSectionElementsCount($arSection['ID'])?></b></td>
        </tr>
        <?$obCod = CIBlockSection::GetList(array(),Array("SECTION_ID"=>$arSection['ID']));
        while($arCod = $obCod -> Fetch()){
            $QUANTITY = CIBlockElement::GetList(array(),array( "SECTION_ID" => $arCod['ID']),false);?>
            <tr>
                <td><ul><li><a href="<?=$arSection['CODE']?>/<?=$arCod['CODE']?>/"><?=$arCod['NAME']?></a></li></ul></td>
                <td align="center"><b><?=$QUANTITY->SelectedRowsCount()?></b></td>
            </tr>
        <?}
        }
    }?>
    </table>
    <br/>
    <hr/>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "COMPONENT_TEMPLATE" => ".default",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/project_bot.php"
        )
    );?>
    <hr>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}else{
    ?><h1 style="margin:0;padding:0;"><?if($arResult["SECTION"]["PATH"][1] == null){echo($arResult["SECTION"]["PATH"][0]["NAME"]);}else{echo($arResult["SECTION"]["PATH"][0]["NAME"]." ".$arResult["SECTION"]["PATH"][1]["NAME"]);}?></h1><?
    ?><div class="plbuttons"><?
    foreach ($arResult["SECTIONS"] as $arSection)
    {?>
        <div class="plbuttonsel"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=substr($arSection["NAME"],0,-1)?><sup>2</sup></a></div>
    <?}?>
    </div><?
}
?></div>
<div style="clear: both;"></div>