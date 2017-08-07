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
    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arResult['IBLOCK_ID'], $arResult['ID']);
    $IPROPERTY = $ipropValues->getValues();   

    $ELEMENT_META_TITLE_whith_tag =  html_entity_decode($IPROPERTY['ELEMENT_META_TITLE']);                                                                                    
    $ELEMENT_PAGE_TITLE_whith_tag =  html_entity_decode($IPROPERTY['ELEMENT_PAGE_TITLE']);     

    $replace_from = array("<nobr>", "</nobr>");
    $replace_to = array(GetMessage("PROJECT")." ", "");
    $ELEMENT_PAGE_TITLE_whith_tag = str_replace($replace_from, $replace_to, $ELEMENT_PAGE_TITLE_whith_tag);           

    $ELEMENT_META_TITLE =  strip_tags(html_entity_decode($IPROPERTY['ELEMENT_META_TITLE']));                                                                                      
?>
<script type="text/javascript">
var viewedCounter = {
    path: '/bitrix/components/bitrix/catalog.element/ajax.php',
    params: {
        AJAX: 'Y',
        SITE_ID: "<?= SITE_ID ?>",
        PRODUCT_ID: "<?= $arResult['ID'] ?>",
        PARENT_ID: "<?= $arResult['ID'] ?>"
    }
};
BX.ready(
    BX.defer(function(){
        BX.ajax.post(
            viewedCounter.path,
            viewedCounter.params
        );
    })
);
</script>          
<section class="last-posts w-tabs"> 
    <table style="margin-bottom:10px; width:650px;" id="h2header">
        <tbody><tr>
                <td>           
                    <h1><?if($ELEMENT_PAGE_TITLE_whith_tag){ echo $ELEMENT_PAGE_TITLE_whith_tag;} else {echo GetMessage("HOUSE_PROJECT") . $arResult["NAME"];}?></h1>
                    <span><?=GetMessage("TOTAL_AREA")?> <b style="margin:0;padding:0;"><?=$arResult['PROPERTIES']['OB_PL']['VALUE']?></b> м<sup>2</sup></span>                        
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td align="right" style="display:none; width:80px;">                                                                          
                    <a href="" data-project-id="<?=$arResult['ID']?>" class="add_to_favorite"><?=GetMessage("ADD_TO_FAVORITE")?></a>      
                </td>    
                <td align="right" style="display:none; width:80px;">                                                                          
                    <a href="" data-project-id="<?=$arResult['ID']?>" class="delete_from_favorite"><?=GetMessage("REMOVE_FROM_FAVORITE")?></a>      
                </td>
                <td align="right">
                    <?if ($arResult["PROPERTIES"]["PROJECT_TEMPORARILY_UNAVAILABLE"]["VALUE"] != "Y") {?>
                        <a href="/order/?nproj=<?=$arResult['CODE']?>" class="buy_project"><?=GetMessage("BUY_PROJECT")?></a>                       
                        <?} else {?>
                        <span class="project_tmp_unavailable"><?=GetMessage("TMP_UNVAILABLE")?></span>
                        <?}?>
                </td>
            </tr>
        </tbody></table>

    <table cellpadding="0" cellspacing="0" border="0">
        <tbody><tr valign="top">
                <td><img id="viz" class="p" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - <?=GetMessage("IMG")?> 1" title="<?=$ELEMENT_META_TITLE?> - <?=GetMessage("IMG")?> 1"></td>
                <?if ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] != null){?>
                    <td width="120">
                        <div style="padding:3px 3px 80px 0px; background:url(/i2/rightzoom.jpg) center bottom no-repeat #e0e4ec;">
                            <img class="min_img" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"  alt="<?=$ELEMENT_META_TITLE?> - <?=GetMessage("IMG")?> 1 <?=GetMessage("MIN")?>" title="<?=$ELEMENT_META_TITLE?> - <?=GetMessage("IMG")?> 1 <?=GetMessage("MIN")?>" style="width:100px; margin:0 2px 2px 2px; cursor:pointer;" onmouseover="this.style.width='110px'" onmouseout="this.style.width='100px'"><br>
                            <?foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key=>$arItems){
                                    $temp_img = CFile::GetFileArray($arItems);?>
                                <img class="min_img" src="<?=$temp_img['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - <?=GetMessage("IMG")?> <?=$key+2?> <?=GetMessage("MIN")?>" title="<?=$ELEMENT_META_TITLE?> - <?=GetMessage("IMG")?> <?=$key+2?> <?=GetMessage("MIN")?>" style="width:100px; margin:0 2px 2px 2px; cursor:pointer;" onmouseover="this.style.width='110px'" onmouseout="this.style.width='100px'"><br>        
                                <?}?>
                        </div>
                    </td>
                    <?}?>
            </tr>
        </tbody></table>
    <table class="mater" cellpadding="0" cellspacing="0">
    <tbody><tr valign="top">
        <td class="matertd">
            <h2><?=GetMessage("MATERIALS")?></h2>
            <?foreach($arResult['PROPERTIES']['MATERIALS']['VALUE'] as $arItems){?>
                <?=$arItems?><br>
                <?}?>
        </td>
    </tr>
    <br>
    <table id="pln_fsd" cellpadding="0" cellspacing="0">
        <tbody><tr valign="top">
                <td style="padding-right:15px;"><h2><?=GetMessage("PLANS")?></h2>
                    <? 
                        $file_floor['PLINTH'] = CFile::GetFileArray($arResult['PROPERTIES']['PLAN_0']['VALUE']);     
                        $file_floor[1] = CFile::GetFileArray($arResult['PROPERTIES']['PLAN_1']['VALUE']);     
                        $file_floor[2] = CFile::GetFileArray($arResult['PROPERTIES']['PLAN_2']['VALUE']);     
                        $file_floor[3] = CFile::GetFileArray($arResult['PROPERTIES']['PLAN_3']['VALUE']);     
                        $file_floor[4] = CFile::GetFileArray($arResult['PROPERTIES']['PLAN_4']['VALUE']);     
                        $file_floor['ATTIC'] = CFile::GetFileArray($arResult['PROPERTIES']['PLAN_M']['VALUE']);     
                    ?>
                    <?if(!empty($file_floor['PLINTH'])){?><b><?=$arResult['PROPERTIES']['PLAN_0']['NAME']?></b><br><img class="pln" src="<?=$file_floor['PLINTH']['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - цоколь" title="<?=$ELEMENT_META_TITLE?> - цоколь"><br><?}?>
                    <?if(!empty($file_floor[1])){?><b><?=$arResult['PROPERTIES']['PLAN_1']['NAME']?></b><br><img class="pln" src="<?=$file_floor[1]['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - 1-й этаж" title="<?=$ELEMENT_META_TITLE?> - 1-й этаж"><br><?}?>
                    <?if(!empty($file_floor[2])){?><b><?=$arResult['PROPERTIES']['PLAN_2']['NAME']?></b><br><img class="pln" src="<?=$file_floor[2]['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - 2-й этаж" title="<?=$ELEMENT_META_TITLE?> - 2-й этаж"><br><?}?>
                    <?if(!empty($file_floor[3])){?><b><?=$arResult['PROPERTIES']['PLAN_3']['NAME']?></b><br><img class="pln" src="<?=$file_floor[3]['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - 3-й этаж" title="<?=$ELEMENT_META_TITLE?> - 3-й этаж"><br><?}?>
                    <?if(!empty($file_floor[4])){?><b><?=$arResult['PROPERTIES']['PLAN_4']['NAME']?></b><br><img class="pln" src="<?=$file_floor[4]['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - 4-й этаж" title="<?=$ELEMENT_META_TITLE?> - 4-й этаж"><br><?}?>   
                    <?if(!empty($file_floor['ATTIC'])){?><b><?=$arResult['PROPERTIES']['PLAN_M']['NAME']?></b><br><img class="pln" src="<?=$file_floor['ATTIC']['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - мансарда" title="<?=$ELEMENT_META_TITLE?> - мансарда"><br><?}?>   
                    <br>
                </td>
                <td><h2><?=GetMessage("FACADES")?></h2>
                    <?
                        $file_facade['FASAD_FRONT'] = CFile::GetFileArray($arResult['PROPERTIES']['FASAD_FRONT']['VALUE']);
                        $file_facade['FASAD_LEFT'] = CFile::GetFileArray($arResult['PROPERTIES']['FASAD_LEFT']['VALUE']);
                        $file_facade['FASAD_RIGHT'] = CFile::GetFileArray($arResult['PROPERTIES']['FASAD_RIGHT']['VALUE']);
                        $file_facade['FASAD_BEHIND'] = CFile::GetFileArray($arResult['PROPERTIES']['FASAD_BEHIND']['VALUE']);
                    ?>
                    <?if(!empty($file_facade['FASAD_FRONT'])){?><b><?=$arResult['PROPERTIES']['FASAD_FRONT']['NAME']?></b><br>
                        <img class="fsd" src="<?=$file_facade['FASAD_FRONT']['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - <?=$arResult['PROPERTIES']['FASAD_FRONT']['NAME']?>" title="<?=$ELEMENT_META_TITLE?> - <?=$arResult['PROPERTIES']['FASAD_FRONT']['NAME']?>"><br><?}?>
                    <?if(!empty($file_facade['FASAD_LEFT'])){?><b><?=$arResult['PROPERTIES']['FASAD_LEFT']['NAME']?></b><br>
                        <img class="fsd" src="<?=$file_facade['FASAD_LEFT']['SRC']?>" alt="<?=$ELEMENT_META_TITLE?>- <?=$arResult['PROPERTIES']['FASAD_LEFT']['NAME']?>" title="<?=$ELEMENT_META_TITLE?> - <?=$arResult['PROPERTIES']['FASAD_LEFT']['NAME']?>"><br><?}?>
                    <?if(!empty($file_facade['FASAD_RIGHT'])){?><b><?=$arResult['PROPERTIES']['FASAD_RIGHT']['NAME']?></b><br>
                        <img class="fsd" src="<?=$file_facade['FASAD_RIGHT']['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - <?=$arResult['PROPERTIES']['FASAD_RIGHT']['NAME']?>" title="<?=$ELEMENT_META_TITLE?> - <?=$arResult['PROPERTIES']['FASAD_RIGHT']['NAME']?>"><br><?}?>
                    <?if(!empty($file_facade['FASAD_BEHIND'])){?><b><?=$arResult['PROPERTIES']['FASAD_BEHIND']['NAME']?></b><br>
                        <img class="fsd" src="<?=$file_facade['FASAD_BEHIND']['SRC']?>" alt="<?=$ELEMENT_META_TITLE?> - <?=$arResult['PROPERTIES']['FASAD_BEHIND']['NAME']?>" title="<?=$ELEMENT_META_TITLE?> - <?=$arResult['PROPERTIES']['FASAD_BEHIND']['NAME']?>"><br><?}?>
                </td>
            </tr>
        </tbody>
    </table>
    <?if($arResult["DETAIL_TEXT"]){?>
        <h2><?=GetMessage("PROJ_DES")?></h2>
        <p id="des"><?=html_entity_decode($arResult["DETAIL_TEXT"])?></p>
        <u style="cursor:pointer;color:#0082c4;" onclick="
            if($('#des').css('height') == '55px'){
                $('#des').css('height','auto');
                $(this).html('<?=GetMessage("COLL")?>');
            }
            else{
                $('#des').css('height','55px');
                $(this).html('<?=GetMessage("READ_MORE")?>');
            }
            "><?=GetMessage("READ_MORE")?></u>
        <br/>
        <?}?>                                                  
    <br/>
    <?if($arResult["PROPERTIES"]["PROJECT_OPTIONS"]["VALUE"]){?>
        <h2><?=GetMessage("PROJ_OPT")?></h2>
        <div class="bx_catalog_list_home col3 bx_catalog_item"> <?//Количество элементов в строке можно менять, поменяв col3 на col1 или col2?>
            <?$dbResultProj = CIBlockElement::GetList(array(),Array("ID"=>$arResult["PROPERTIES"]["PROJECT_OPTIONS"]["VALUE"], "ACTIVE"=>"Y"),false,false,Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"));
                while($arResultProj = $dbResultProj->GetNext()){
                    $pic = CFile::GetFileArray($arResultProj['PREVIEW_PICTURE']);    
                    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arParams["IBLOCK_ID"],$arResultProj["ID"]);
                    $IPROPERTY = $ipropValues->getValues();
                ?>
                <div class="bx_catalog_item"> 
                    <div class="bx_catalog_item_container"> 
                        <a href="<? echo $arResultProj['DETAIL_PAGE_URL']; ?>"><img src="<?=$pic["SRC"]?>" alt="<? echo strip_tags(html_entity_decode($IPROPERTY['ELEMENT_PAGE_TITLE'])) ?>" title="<? echo strip_tags(html_entity_decode($IPROPERTY['ELEMENT_PAGE_TITLE'])) ?>" class="bx_catalog_item_img"></a>
                        <div class="bx_catalog_item_title"><a href="<? echo $arResultProj['DETAIL_PAGE_URL']; ?>" title="<? echo strip_tags(html_entity_decode($IPROPERTY['ELEMENT_PAGE_TITLE'])) ?>"><?echo html_entity_decode($IPROPERTY['ELEMENT_PAGE_TITLE']);?></a></div>
                        <br/> 
                    </div>
                </div>
                <?}?>
        </div>
        <?}?>
    <div style="clear: both;"></div>
    <?/*?>
        <script type="text/javascript" src="http://davidjbradshaw.com/iframe-resizer/js/iframeResizer.min.js"></script>
        <style> 
        #id1, #id2 { border: none; }
        </style>
        <iframe id=id2 src="http://www.postroi.ru/diller_price.php?mode=price&prj=<?=$arResult["CODE"]?>" width="100%" scrolling="no"></iframe>        
        <script type="text/javascript">iFrameResize({checkOrigin:false,enablePublicMethods:true});</script>
    <?*/?>
    <?$price = CPrice::GetList(array(),array('PRODUCT_ID' => $arResult['ID']),false,false,array()); 
        while ($ar_res = $price->Fetch()) {
            if($ar_res['PRICE'] != 0 && $ar_res['CATALOG_GROUP_ID'] != 1){
                $allPrice[] = $ar_res;    
            }         
        }?>
    <h2><?=GetMessage("PROJ_PRICE")?></h2>
    <table class="prices" cellpadding="0" cellspacing="0">
        <tbody>
            <tr class="head">
                <td><?=GetMessage("EQUIPMENT")?></td>
                <td><?=GetMessage("PRICES")?></td>
            </tr>
            <?foreach($allPrice as $arPrice){?>
                <tr class="mainprices">
                    <td><?=$arPrice['CATALOG_GROUP_NAME']?></td>
                    <td class="b"><?=$arPrice['PRICE']?></td>
                </tr>
                <?}?>
        </tbody>
    </table>               
</section>
<br>                 
<b><?=html_entity_decode($IPROPERTY['ELEMENT_META_DESCRIPTION'])?></b>
<br>  
<br>  
    <h2><?=GetMessage("PROJ_SER")?></h2>
    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"proj", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_FIELD2" => "",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "37",
		"IBLOCK_TYPE" => "projects_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "3",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE_MOBILE" => "",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "proj",
		"MESS_BTN_COMPARE" => "Сравнить"
	),
	false
);?>