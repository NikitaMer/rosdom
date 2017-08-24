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
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<div class="b-widget b-widget__for-company">
<h2 ><a href="/projects/"><?=GetMessage('PROJECTS_TITLE')?></a></h2>
<div class="<? echo $arCurView['CONT']; ?> description-for-company"><?

if (0 < $arResult["SECTIONS_COUNT"]) { ?>

<ul class="<? echo $arCurView['LIST']; ?>" id="leftmenu">
<?
   	foreach ($arResult['SECTIONS'] as &$arSection) {
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            if($arSection["UF_SORT_MENU"] == 1 && $arSection["UF_SHOW_MENU"] == 1){
			    ?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
			    if ($arParams["COUNT_ELEMENTS"]) {
				    ?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
			    }
			    ?></li><?
            }
	}

?>
</ul>

<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?>
</div>

<div class="<? echo $arCurView['CONT']; ?> description-for-company"><?

if (0 < $arResult["SECTIONS_COUNT"]) { ?>

<ul class="<? echo $arCurView['LIST']; ?>" id="leftmenu">
<?

    foreach ($arResult['SECTIONS'] as &$arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            if($arSection["UF_SORT_MENU"] == 2 && $arSection["UF_SHOW_MENU"] == 1){
                ?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
                if ($arParams["COUNT_ELEMENTS"]) {
                    ?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
                }
                ?></li><?
            }
    }

?>
</ul>

<?
    echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?>
</div>

<div class="<? echo $arCurView['CONT']; ?> description-for-company"><?

if (0 < $arResult["SECTIONS_COUNT"]) { ?>

<ul class="<? echo $arCurView['LIST']; ?>" id="leftmenu">
<?

    foreach ($arResult['SECTIONS'] as &$arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            if($arSection["UF_SORT_MENU"] == 3 && $arSection["UF_SHOW_MENU"] == 1){
                ?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
                if ($arParams["COUNT_ELEMENTS"]) {
                    ?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
                }
                ?></li><?
            }
    }

?>
</ul>

<?
    echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?>
</div>

<div class="<? echo $arCurView['CONT']; ?> description-for-company"><?

if (0 < $arResult["SECTIONS_COUNT"]) { ?>

<ul class="<? echo $arCurView['LIST']; ?>" id="leftmenu">
<?

    foreach ($arResult['SECTIONS'] as &$arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            if($arSection["UF_SORT_MENU"] == 4 && $arSection["UF_SHOW_MENU"] == 1){
                ?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
                if ($arParams["COUNT_ELEMENTS"]) {
                    ?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
                }
                ?></li><?
            }
    }

?>
</ul>

<?
    echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?>
</div>
</div>