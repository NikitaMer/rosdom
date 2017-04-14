<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)) :  ?>

<?if (!empty($arResult)):?>

<div class="b-widget b-widget__submenu">
            <h2>Подразделы:</h2>
            <div class="description-submenu">

<ul class="left-menu">

<?foreach ($arResult as $arItem){?>
    <?if (!$arItem["SELECTED"]):?>
    <li class="root"> 
        <a href="<?=$arItem["LINK"]?>"><?=!empty($arItem["UF_MENUTITLE"])?$arItem["UF_MENUTITLE"]:$arItem["TEXT"];?></a>
    </li>
    <?else:?>
    <li class="root-selected"> 
        <a href="<?=$arItem["LINK"]?>"><?=!empty($arItem["UF_MENUTITLE"])?$arItem["UF_MENUTITLE"]:$arItem["TEXT"];?></a>
        <ul>
    <?endif?>
        <?if ($arItem["SELECTED"]):
            foreach ($arItem['CHILDREN'] as $Children):
                if (!$Children["SELECTED"]):?>                       
                <li class="item"> 
                    <a href="<?=$Children["LINK"]?>"><?=!empty($Children["UF_MENUTITLE"])?$Children["UF_MENUTITLE"]:$Children["TEXT"];?></a>
                </li>
                <?else:?>
                <li class="item-selected"> 
                    <a href="<?=$Children["LINK"]?>"><?=!empty($Children["UF_MENUTITLE"])?$Children["UF_MENUTITLE"]:$Children["TEXT"];?></a>
                </li>
                <?endif?>
            <?endforeach;?>
        </ul>
        <?endif?>
<?}?>
</ul>
</div>
</div>
<?endif?>
<?endif?>
