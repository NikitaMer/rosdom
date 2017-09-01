<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Документы");
?><section class="faq">
<?
   if(CModule::IncludeModule("iblock"))
    {
?>
<h1>Документы</h1>
<?
$db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), Array("IBLOCK_ID"=>"15", "SECTION_ID"=>0));
while($ar_result = $db_list->GetNext())
  {
    
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
         <!--p class="more"><a href="<?echo $ar_result["SECTION_PAGE_URL"]?>">Перейти к разделу</a></p-->

      </figcaption>   
   </figure>
</div>
   <?
  };
?>
</section>
<? } ?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>



