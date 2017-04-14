<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div id="mainmenu">

<ul>
<? if ($APPLICATION->GetCurDir() == '/') 
	echo '<li class="root-item-selected"> <a href="/" class="root-item-selected">';
else 
	echo '<li class="root-item"> <a href="/" class="root-item">'; ?>
О проекте </a>
</li>
<? 
$sub=0;
$mem=0;
foreach($arResult as $arItem):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
		    <? if ($arItem["SELECTED"]){ ?>

			<li class="root-item-selected">
				<a href="<?=$arItem["LINK"]?>" id="root-item-selected"><span class="root-item-selected">
					<?=$arItem["PARAMS"]["UF_MENUTITLE"]?></span></a>
			</li>
			<? $mem=$arItem["LINK"];
			$root_link=$arItem["LINK"];
			$root_name = $arItem["PARAMS"]["UF_MENUTITLE"]; ?>
			<?//$APPLICATION->AddChainItem($arItem["PARAMS"]["UF_MENUTITLE"], $arItem["LINK"]);?>
		    <? }
		    else{ ?>
			<li>
				<a href="<?=$arItem["LINK"]?>" class="root-item">
					<?=$arItem["PARAMS"]["UF_MENUTITLE"]?></a>
			</li>
			<? $mem=0; ?>
			<? } ?>
		<?elseif ($arItem["DEPTH_LEVEL"] == 2) :?> 
			<? //echo "!".$mem."!";
			if ($mem) $sub++;
			$temp=array();
//			$temp = $arItem;
//			$temp["LINK"]=substr($mem,0,-1).$arItem["LINK"];
//			$curDir = $APPLICATION -> GetCurPage();
//			if(substr($mem,0,-1).$arItem["LINK"] == $curDir) $temp["SELECTED"]=1; 

//			$SubMenu[]=$temp; 
//			}
			?> 
		<?endif?>
<?endforeach?>
</ul>

<ul id="question" style="float:right"><li><a href="/about/feedback/">Задать вопрос</a></li></ul>
</div>
<!-- <div class="menu-clear-left"></div> -->

<!-- <pre
<?// print_r($arResult);?>
</pre> -->
  

	<? 
	$curDir = $APPLICATION -> GetCurPage();
	if ($curDir == "/"){
?>
<div id="submenu">
<?/**/?>
 <? $APPLICATION->IncludeComponent("bitrix:news.detail", "rosdom_text_only", Array(
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
	"DISPLAY_NAME" => "N",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить детальное изображение
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"USE_SHARE" => "N",	// Отображать панель соц. закладок
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"IBLOCK_TYPE" => "generated",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "24",	// Код информационного блока
	"ELEMENT_ID" => "10814",	// ID новости
	"ELEMENT_CODE" => "",	// Код новости
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => "",	// Поля
	"PROPERTY_CODE" => "",	// Свойства
	"IBLOCK_URL" => "",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
	"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
	"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
	"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_NOTES" => "",
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
	"PAGER_TITLE" => "Страница",	// Название категорий
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);
?>
</div>
<? }
	elseif ($sub>0){
?>

<div id="submenu">
<?/**/?>
	    <ul>
	    <? $i=0;?>
<?
global $APPLICATION;
$dirs = array();
$dir = $APPLICATION->GetCurDir();
$dirs = explode( "/", $dir );
$CurPath="/".$dirs["1"]."/".$dirs["2"]."/"; 
?>

<?
$count=ceil($sub/5);
$show = 0;
foreach($arResult as $arItem):?>

<? if ($arItem["DEPTH_LEVEL"] == 1 && $arItem["SELECTED"] == 1) $show=1;
elseif ($arItem["DEPTH_LEVEL"] == 1 && !$arItem["SELECTED"] == 1) $show=0;

    if ($arItem["DEPTH_LEVEL"] == 2 && $show == 1) { 
?>
			<li>
			<?if ($arItem["SELECTED"]):
 				$APPLICATION->AddChainItem($root_name, $root_link);
				global $sub_name;
				global $sub_link;
				$sub_name =$arItem["PARAMS"]["UF_MENUTITLE"] ;
				$sub_link =$arItem["LINK"]; ?>
 			<span class="selected">
 			<a href="<?=$arItem["LINK"]?>" >
			<?=$arItem["PARAMS"]["UF_MENUTITLE"]?>
			</a>
			</span>
			<?else: ?> 
 			<a href="<?=$arItem["LINK"]?>" >
			<?=$arItem["PARAMS"]["UF_MENUTITLE"]?>
			</a>
 			<?endif?>
			</li>	
		<? 
    
		 $i++;
		if ($i>0 && $i< $sub && $i%$count == 0 ) echo "</ul><ul>";
		?>
<? } ?>

<?endforeach?>
	    </ul>


</div>
<div style="clear:both;"></div>
<? } ?>
<?endif?>