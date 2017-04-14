<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <section class="faq">
            
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?echo '<pre>'; print_r($faqFilter); echo '</pre>';
$pathcount = count($arResult["SECTION"]["PATH"]) - 1;
$section_id = 0;
$section_code = '';
$parent = 0;
if (!empty($_REQUEST['SECTION_CODE'])){
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>14, "ID" => $arResult["SECTION"]["PATH"][$pathcount]["ID"]), false, Array("UF_DESCRIPTION", "UF_KEYWORDS", "UF_METATITLE"));
	if (!empty($arResult["SECTION"])) while($ar_result = $db_list->GetNext())  {
		//echo '<pre>'.print_r($ar_result).'</pre>';
		$section_id = $ar_result["ID"];
		$section_code = $ar_result["CODE"];
		$parent = intval($ar_result['IBLOCK_SECTION_ID']);
		if (!empty($ar_result["UF_DESCRIPTION"])) $APPLICATION->SetPageProperty("description", $ar_result["UF_DESCRIPTION"]); 
		if (!empty($ar_result["UF_KEYWORDS"])) $APPLICATION->SetPageProperty("keywords", $ar_result["UF_KEYWORDS"]); 
		if (!empty($ar_result["UF_METATITLE"])) $APPLICATION->SetPageProperty("title", $ar_result["UF_METATITLE"]); 
			else $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][$pathcount]["NAME"]); 
	}
}

?>
<?

//if (!empty($arResult["SECTION"])) $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["PATH"][$pathcount]["NAME"]); 
?>
<h1><?if(!empty($arResult["SECTION"])):?><?=$arResult["SECTION"]["PATH"][$pathcount]["NAME"]?><?else:?>Вопрос-ответ<?endif;?></h1>

<?

$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC", "SORT"=>"ASC"), array("IBLOCK_ID"=>14, "SECTION_ID" => $section_id), false, Array("UF_*"));
//echo $section_id.' - '.$db_list->SelectedRowsCount().'<br>';
if ($db_list->SelectedRowsCount() > 0){

	if($section_code != '') $link = '/'.$section_code.'/';
		else $link = '/';
	if ($parent > 0){
		$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>"14", "ID"=>$parent));
		if($res=$db_list->GetNext()){
			$link = '/'.$res['CODE'].$link;
			//echo $link.'<br>';
		}
	}
	$link = '/faq'.$link;
	//echo 'link: '.$link;
	
	while($ar_result = $db_list->GetNext())
	  {
		//echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
		
	?>
	<div class="b-subsection">
	   <h2><a href="<?=$link;?><?echo $ar_result["CODE"]?>/"><?echo $ar_result["UF_MENUTITLE"]?></a></h2>
	   <figure>
	   <?if(!empty($ar_result["PICTURE"])):?>
	   <?
	   $rsFile = CFile::GetByID($ar_result["PICTURE"]);
	   $arFile = $rsFile->Fetch();
	   ?>
	   <img src="/upload/<?echo $arFile["SUBDIR"];?>/<?echo $arFile["FILE_NAME"]?>" alt="" />
	   <?endif;?>
	   
		  <figcaption>
			<?echo $ar_result['DESCRIPTION'];?>
			 <p class="more"><a href="<?=$link?><?echo $ar_result["CODE"]?>/">Перейти к разделу</a></p>

		  </figcaption>   
	   </figure>
	</div>
	   <?
	  };

} else {


?>
<dl class="b-list-faq">


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<dt id="<?=$arItem['ID']?>">
	  <!--div class="path">Раздел: <a href="#">Фундаменты</a> » <a href="#">Конструкции фундаментов</a></div-->

	  <h3><?echo $arItem['PREVIEW_TEXT']?></h3>
   </dt>
   <dd>
	  <?/*<p><?echo $arItem['DETAIL_TEXT']?></p>*/?>
	  <p>
	  <?
	  
		$result = implode(array_slice(explode('<br>',wordwrap($arItem['DETAIL_TEXT'],265,'<br>',false)),0,1));
		echo $result;
		if($result!=$string)echo'...';
	  ?>
	  </p>
	  <p class="more"><a href="/faq/faq<?=$arItem['ID']?>/">Читать полностью</a></p>
	  <!--p class="more"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Читать полностью</a></p-->
   </dd>

<?endforeach;?>


            </dl> <?}?>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
         </section>
 
 
 

               
