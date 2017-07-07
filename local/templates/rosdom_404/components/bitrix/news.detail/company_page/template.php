<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
							 //  echo '<pre>';
							  //  print_r($arResult);
							 //   echo '</pre>';
$company_id = $arResult["ID"];
global $TabsFilter;
$TabsFilter = array("PROPERTY_COMPANY"=>"$company_id");
//$APPLICATION->AddChainItem($arResult["NAME"], '/');
?>
         <h1>Компания «<?=$arResult["NAME"]?>»</h1>
         <section class="last-posts w-tabs equipments-tabs">
            <div class="b-tabs" id="company-tabs">
               <nav>
                  <ul>
                     <li class="active"><a href="javascript: void(0);">О компании</a></li>
					 <li style="display: none;" id="faq-tab"><a href="javascript: void(0);">Вопрос-ответ</a></li>
                     <li style="display: none;" id="tabs-articles"><a href="javascript: void(0);">Статьи</a></li>
                     <li style="display: none;" id="tabs-press-release"><a href="javascript: void(0);">Пресс-релизы</a></li>
					 <li style="display: none;" id="photo-tab"><a href="javascript: void(0);">Фото</a></li>
					 <li style="display: none;" id="tabs-video"><a href="javascript: void(0);">Видео</a></li>
					 <li style="display: none;" id="files-tab"><a href="javascript: void(0);">Файлы</a></li>
					 

                  </ul>
               </nav>
            </div>
            <div class="b-descriptions">
               <div class="description visible">
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>

                  <div class="b-about-company">
				  <?if(!empty($arResult["PREVIEW_PICTURE"])):?>
                     <div class="b-company-logo">
                        <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="" />
                     </div>
				  <?endif;?>


<? if($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]): ?>
           <strong>Адрес</strong>: <?echo $arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><br>
<?endif?>

<? if($arResult["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"]): ?>
           <strong>Телефоны</strong>: <?echo $arResult["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"]?>
           <?if(!empty($arResult["DISPLAY_PROPERTIES"]["ADD_PHONE"]["DISPLAY_VALUE"])) echo ', '.$arResult["DISPLAY_PROPERTIES"]["ADD_PHONE"]["DISPLAY_VALUE"];?><br>
<?endif?>

<? if($arResult["DISPLAY_PROPERTIES"]["FAX"]["DISPLAY_VALUE"]): ?>
	 <strong>Факс</strong>: <?echo $arResult["DISPLAY_PROPERTIES"]["FAX"]["DISPLAY_VALUE"]?><br>
<?endif?>

<? if($arResult["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]): ?>
         <strong>E-mail</strong>: <a href="mailto:<?echo $arResult["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]?>"><?echo $arResult["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]?></a><br>
<?endif?>

<?if(!empty($arResult["DISPLAY_PROPERTIES"]["SITE_URL"])):?>
	 <strong>Сайт</strong>: <?if ($arResult["DISPLAY_PROPERTIES"]["SITE_URL_INDEX"]["VALUE"] != 1):?><noindex><?endif;?><a <?if ($arResult["DISPLAY_PROPERTIES"]["SITE_URL_INDEX"]["VALUE"] != 1):?>rel="rel nofollow" <?endif;?>href="http://<?echo $arResult["DISPLAY_PROPERTIES"]["SITE_URL"]["VALUE"]?>" target="_blank"><?echo $arResult["DISPLAY_PROPERTIES"]["SITE_URL"]["VALUE"]?></a><?if ($arResult["DISPLAY_PROPERTIES"]["SITE_URL_INDEX"]["VALUE"] != 1):?></noindex><?endif;?><br>
<?endif;?>
						
                     <p><strong>Описание</strong>: <?echo $arResult["DETAIL_TEXT"];?></p>
<?// echo "!".strlen($arResult["PROPERTIES"]["PUB_SECTION"]["VALUE"])."!";?>
                     <? if(!empty($arResult["PROPERTIES"]["PUB_SECTION"]["VALUE"])):?>
                     <div class="where-is clearfix">
                        <h3>Компания представлена к разделах:</h3>
						<ul>
						<?	$arFilter = Array("ID" => $arResult["PROPERTIES"]["PUB_SECTION"]["VALUE"]);
							$db_el = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter );
							while ($el = $db_el -> GetNext()) {
								
								$dbSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$el["IBLOCK_ID"], "<=LEFT_BORDER" => $el["LEFT_MARGIN"], ">=RIGHT_BORDER" => $el["RIGHT_MARGIN"]), false);
								while ($arSect = $dbSect->GetNext()) {
									$menutree_parent[$arSect["DEPTH_LEVEL"]]["ID"] = $arSect["ID"];
									$menutree_parent[$arSect["DEPTH_LEVEL"]]["CODE"] = $arSect["CODE"];
							}
						//echo '<pre>';
						// print_r($arResult["PROPERTIES"]["PUB_SECTION"]["VALUE"]);
						// echo '</pre>';
							$link = '/';
							for ($i = 1; $i<=count($menutree_parent); $i++) $link .= $menutree_parent[$i]["CODE"].'/';
							echo '<li><a href="'.$link.'">'.$el["NAME"].'</a></li>';								
							}
						?>
						</ul>
                      </div>
                     <?endif?>
                  </div>
               </div>
				<div class="description">
			<!-- -->		
					<?
/* FAQ */ 
$APPLICATION->IncludeComponent("bitrix:news.list", "faq-company", array(
	"IBLOCK_TYPE" => "faq",
	"IBLOCK_ID" => "14",
	"NEWS_COUNT" => "10",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "TabsFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "AUTHOR",
		1 => "EMAIL",
		2 => "REFERENCE",
		3 => "72",
		4 => "73",
		5 => "74",
		6 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "/faq/detail.php?ELEMENT_ID=#ID#",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "ЧаВО",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);
/* Конец FAQ */ 
?>
				</div>
				<div class="description">
					<?
/* Статьи */ 
$APPLICATION->IncludeComponent("bitrix:news.list", "articles_index", array(
	"IBLOCK_TYPE" => "articles",
	"IBLOCK_ID" => "9",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "TabsFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "AUTHOR",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);
/* Конец Статьи */ 
?>
				</div>

				<div class="description">
					<?
/* Пресс-релизы */ 
$APPLICATION->IncludeComponent("bitrix:news.list", "press_release_list", Array(
	"IBLOCK_TYPE" => "pressrelease",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "34",	// Код информационного блока
	"NEWS_COUNT" => "20",	// Количество новостей на странице
	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "TabsFilter",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "AUTHOR",
		2 => "",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
	"PAGER_TITLE" => "Новости",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);
/* Конец Пресс-релизы */
?>
				</div>
				<div class="description">
<?
/* Фото */
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_photo_firms", Array(
	"IBLOCK_TYPE" => "photos",	// Тип инфоблока
	"IBLOCK_ID" => "31",	// Инфоблок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => "",	// Код раздела
	"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
	"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
	"SECTION_FIELDS" => array(	// Поля разделов
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// Свойства разделов
		0 => "UF_PUB_SECTION",
		1 => "UF_COMPANY",
		2 => "",
	),
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"CACHE_TYPE" => "N",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	),
	false
);
/* Конец Фото*/?>
				</div>
				<div class="description">
					 <?
/* Видео*/
$APPLICATION->IncludeComponent("bitrix:news.list", "video_index", array(
	"IBLOCK_TYPE" => "video",
	"IBLOCK_ID" => "13",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "TabsFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "VIDEO",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Видео",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);
/* Конец Видео*/
?>
				</div>
				<div class="description">
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "documents-company", Array(
	"IBLOCK_TYPE" => "documents",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "15",	// Код информационного блока
	"NEWS_COUNT" => "20",	// Количество новостей на странице
	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "TabsFilter",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "DATE_CREATE",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "FILE",
		2 => "",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Документы",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>
				</div>
            </div>



         </section>
