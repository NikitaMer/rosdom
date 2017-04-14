<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="news-list">
<h2><?=GetMessage("SECTION")?></h2>
<?foreach($arResult as $arItem):?>

    <p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">


        <?if($arItem["NAME"]):?>
            <?if($arItem["DETAIL_TEXT"]):?>
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
            <?else:?>
                <b><?echo $arItem["NAME"]?></b><br />
            <?endif;?>
        <?endif;?>


            <?echo substr($arItem["DETAIL_TEXT"],0,200)."...";?>


        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <div style="clear:both"></div>
        <?endif?>
        <?foreach($arItem["FIELDS"] as $code=>$value):?>
            <small>
            <?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
            </small><br />
        <?endforeach;?>
        <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
            <small>
            <?=$arProperty["NAME"]?>:&nbsp;
            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
            <?else:?>
                <?=$arProperty["DISPLAY_VALUE"];?>
            <?endif?>
            </small><br />
        <?endforeach;?>
    </p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>