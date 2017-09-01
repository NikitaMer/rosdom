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
?>
<?
    if (!empty($arResult['ITEMS']))
    {                              
        $templateLibrary = array('popup');
        $currencyList = '';
        if (!empty($arResult['CURRENCIES']))
        {
            $templateLibrary[] = 'currency';
            $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
        }
        $templateData = array(
            'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
            'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
            'TEMPLATE_LIBRARY' => $templateLibrary,
            'CURRENCIES' => $currencyList
        );
        unset($currencyList, $templateLibrary);

        $skuTemplate = array();
        if (!empty($arResult['SKU_PROPS']))
        {
            foreach ($arResult['SKU_PROPS'] as $arProp)
            {
                $propId = $arProp['ID'];
                $skuTemplate[$propId] = array(
                    'SCROLL' => array(
                        'START' => '',
                        'FINISH' => '',
                    ),
                    'FULL' => array(
                        'START' => '',
                        'FINISH' => '',
                    ),
                    'ITEMS' => array()
                );
                $templateRow = '';
                if ('TEXT' == $arProp['SHOW_MODE'])
                {
                    $skuTemplate[$propId]['SCROLL']['START'] = '<div class="bx_item_detail_size full" id="#ITEM#_prop_'.$propId.'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';;
                    $skuTemplate[$propId]['SCROLL']['FINISH'] = '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style=""></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style=""></div>'.
                    '</div></div>';

                    $skuTemplate[$propId]['FULL']['START'] = '<div class="bx_item_detail_size" id="#ITEM#_prop_'.$propId.'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';;
                    $skuTemplate[$propId]['FULL']['FINISH'] = '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style="display: none;"></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style="display: none;"></div>'.
                    '</div></div>';
                    foreach ($arProp['VALUES'] as $value)
                    {
                        $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                        $skuTemplate[$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="'.$propId.'_'.$value['ID'].
                        '" data-onevalue="'.$value['ID'].'" style="width: #WIDTH#;" title="'.$value['NAME'].'"><i></i><span class="cnt">'.$value['NAME'].'</span></li>';
                    }
                    unset($value);
                }
                elseif ('PICT' == $arProp['SHOW_MODE'])
                {
                    $skuTemplate[$propId]['SCROLL']['START'] = '<div class="bx_item_detail_scu full" id="#ITEM#_prop_'.$propId.'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';
                    $skuTemplate[$propId]['SCROLL']['FINISH'] = '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style=""></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style=""></div>'.
                    '</div></div>';

                    $skuTemplate[$propId]['FULL']['START'] = '<div class="bx_item_detail_scu" id="#ITEM#_prop_'.$propId.'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';
                    $skuTemplate[$propId]['FULL']['FINISH'] = '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style="display: none;"></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style="display: none;"></div>'.
                    '</div></div>';
                    foreach ($arProp['VALUES'] as $value)
                    {
                        $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                        $skuTemplate[$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="'.$propId.'_'.$value['ID'].
                        '" data-onevalue="'.$value['ID'].'" style="width: #WIDTH#; padding-top: #WIDTH#;"><i title="'.$value['NAME'].'"></i>'.
                        '<span class="cnt"><span class="cnt_item" style="background-image:url(\''.$value['PICT']['SRC'].'\');" title="'.$value['NAME'].'"></span></span></li>';
                    }
                    unset($value);
                }
            }
            unset($templateRow, $arProp);
        }

        

        $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
        $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
        $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

        if($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y')
        { ?>
        <div class="bx-section-desc <? echo $templateData['TEMPLATE_CLASS']; ?>">
            <p class="bx-section-desc-post"><?=$arResult["DESCRIPTION"]?></p>
        </div>
        <div class="catalog-sort">
            Сортировка
            <form method="post" class="catalog-sort-form">
                <select name="sort" onchange="this.form.submit()" class="select-type">
                    <option value="CATALOG_PRICE_1" <?if($_POST["sort"] == "CATALOG_PRICE_1" || $_SESSION["sort"] == "CATALOG_PRICE_1"){?>selected="selected"<?}?>><?=GetMessage('BY_PRICE')?></option>
                    <option value="PROPERTY_201" <?if($_POST["sort"] == "PROPERTY_201" || $_SESSION["sort"] == "PROPERTY_201"){?>selected="selected"<?}?>><?=GetMessage('BY_AREA')?></option>
                    <option value="created_date" <?if($_POST["sort"] == "created_date" || $_SESSION["sort"] == "created_date"){?>selected="selected"<?}?>><?=GetMessage('BY_DATE')?></option>  
                </select>
                <?if($_POST["method"] == "asc,nulls" || $_SESSION["method"] == "asc,nulls"){?>
                    <button class="button_desc" name="method" onchange="this.form.submit()" value="desc,nulls"></button>
                <?}else{?>
                    <button class="button_asc" name="method" onchange="this.form.submit()" value="asc,nulls"></button>
                <?}?>
                                 
            </form> 
        </div>       
        <? } ?>   
    <div class="bx_catalog_list_home col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">        
        <?
            foreach ($arResult['ITEMS'] as $key => $arItem) 
            {                 
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
                $strMainID = $this->GetEditAreaId($arItem['ID']);

                $arItemIDs = array(
                    'ID' => $strMainID,
                    'PICT' => $strMainID.'_pict',
                    'SECOND_PICT' => $strMainID.'_secondpict',
                    'STICKER_ID' => $strMainID.'_sticker',
                    'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
                    'QUANTITY' => $strMainID.'_quantity',
                    'QUANTITY_DOWN' => $strMainID.'_quant_down',
                    'QUANTITY_UP' => $strMainID.'_quant_up',
                    'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
                    'BUY_LINK' => $strMainID.'_buy_link',
                    'BASKET_ACTIONS' => $strMainID.'_basket_actions',
                    'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
                    'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
                    'COMPARE_LINK' => $strMainID.'_compare_link',

                    'PRICE' => $strMainID.'_price',
                    'DSC_PERC' => $strMainID.'_dsc_perc',
                    'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
                    'PROP_DIV' => $strMainID.'_sku_tree',
                    'PROP' => $strMainID.'_prop_',
                    'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
                    'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
                );

                $strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

                $productTitle = (
                    isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
                    ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
                    : GetMessage("HOUSE_PROJECT").$arItem['NAME']
                );
                $imgTitle = (
                    isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
                    ? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
                    : $arItem['NAME']
                );

                $minPrice = false;
                $minPrice = $arItem['MIN_PRICE'];                   
                
               $subsection = CIBlockSection::GetByID($arItem["~IBLOCK_SECTION_ID"])->GetNext();
               $section = CIBlockSection::GetByID($subsection["IBLOCK_SECTION_ID"])->GetNext(); 
               
            ?><div class="bx_catalog_item" id="<? echo $strMainID; ?>" > 
                <div class="bx_catalog_item_container min" > 
                    <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><img src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo strip_tags(html_entity_decode($productTitle)) ?>" title="<? echo strip_tags(html_entity_decode($productTitle)) ?>" class="bx_catalog_item_img"></a>
                    <div class="bx_catalog_item_title"><a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo strip_tags(html_entity_decode($productTitle)) ?>"><?echo html_entity_decode($productTitle);?></a></div>
                    <br/>
                    <p class="info">
                        <noindex><?=GetMessage("TOTAL_AREA")?><b><?=$arItem['PROPERTIES']['OB_PL']['VALUE']?> м<sup>2</sup></b><br>
                        <?=GetMessage("DIMENSIONS")?><b><?=$arItem['PROPERTIES']['V_GAB']['VALUE']?> x <?=$arItem['PROPERTIES']['H_GAB']['VALUE']?></b><br>
                        <?=GetMessage("MATERIAL")?></noindex><b><a href="<?=$section["SECTION_PAGE_URL"]?>"><?=$arItem['PROPERTIES']['MATERIAL']['VALUE'][0]?></a></b>
                        <br><?=GetMessage("PRICE")?><b style="color:red" id="<? echo $arItemIDs['PRICE']; ?>"><? echo $minPrice['PRINT_VALUE']; ?></b>
                        <noindex>
                        <a href="/order/?nproj=<?=$arItem['CODE']?>" style="padding:3px 5px; text-decoration:none; background:#aaa; color:white;"><?=GetMessage("BUY")?></a>
                        </noindex><br>                                    
                    </p>
                </div>
            </div><?
            }
        ?><div style="clear: both;"></div>
    </div>
    <script type="text/javascript">
        BX.message({
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
            COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            SITE_ID: '<? echo SITE_ID; ?>'
        });
    </script>
    <?
        if ($arParams["DISPLAY_BOTTOM_PAGER"])
        {
        ?><? echo $arResult["NAV_STRING"]; ?><?
        }
}                               