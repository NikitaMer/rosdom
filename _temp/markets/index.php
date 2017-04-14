<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Строительные рынки Москвы");
?>
<section class="faq">
<?
/*if(isset($_REQUEST['SECTION_NAME'])){
$res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 15, 'CODE' => $_REQUEST['SECTION_NAME'])); 
$section = $res->Fetch(); 

$section_id = $section['ID'];*/
?>
<h1>Строительные рынки Москвы</h1>
<?
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>"20"/*, "SECTION_ID"=>$section_id*/));
while($ar_result = $db_list->GetNext())
  {
	//echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
	
	?>
<div class="b-subsection">
   <h2><a href="<?echo $ar_result["SECTION_PAGE_URL"]?>"><?echo $ar_result["NAME"]?></a></h2>
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
		 <p class="more"><a href="<?echo $ar_result["SECTION_PAGE_URL"]?>">Перейте к разделу</a></p>

	  </figcaption>   
   </figure>
</div>
   <?
  };
?>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>