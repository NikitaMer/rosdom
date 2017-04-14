<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $menutree_parent;

/*echo '<pre>';
print_r($menutree_parent);
echo '</pre>';*/

if (isset($menutree_parent[2])){

$dbSect = CIBlockSection::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), Array("IBLOCK_ID" => 25,"SECTION_ID" => $menutree_parent[2]["ID"], "DEPTH_LEVEL" => 3), false, Array("UF_MENUTITLE"));

while ($arSect = $dbSect->GetNext()) {
unset($tmplink);

if (!empty($arSect["UF_MENUTITLE"])) $tmplink[0] = $arSect["UF_MENUTITLE"];
else $tmplink[0] = $arSect["NAME"];
$tmplink[1] = '/'.$menutree_parent[1]["CODE"].'/'.$menutree_parent[2]["CODE"].'/'.$arSect["CODE"].'/';
$tmplink[2] = $arSect["CODE"];
if ($menutree_parent[3]["CODE"] == $arSect["CODE"]) $tmplink[3]["SELECTED"] = true;
if ($tmplink[3]["SELECTED"] == true){
		$dbSect1 = CIBlockSection::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), Array("IBLOCK_ID" => 10,"SECTION_ID" => $arSect["ID"], "DEPTH_LEVEL" => 4), false, Array("UF_MENUTITLE"));
		while ($arSect1 = $dbSect1->GetNext()) {
			if (!empty($arSect["UF_MENUTITLE"])) $tmplink1[0] = $arSect1["UF_MENUTITLE"];
			else $tmplink1[0] = $arSect1["NAME"];
			$tmplink1[1] = '/'.$menutree_parent[1]["CODE"].'/'.$menutree_parent[2]["CODE"].'/'.$menutree_parent[3]["CODE"].'/'.$arSect1["CODE"].'/';
			if ($_REQUEST["SECTION_NAME"] == $arSect1["CODE"]) $tmplink1[3]["SELECTED"] = true;
			$tmplink[4][] = $tmplink1;
		}
}
$aMenuLinksExt[] = $tmplink;

}
}

/*echo '<pre>';
//print_r($aMenuLinksExt);
echo '</pre>';*/

if (!empty($aMenuLinksExt)) {
	?> 
<div class="b-widget b-widget__submenu"> 				
  <h2>Подразделы:</h2>
 				
  <div class="description-submenu"> 	
    <ul> 	<?
	foreach($aMenuLinksExt as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
			continue;
	?> 		<?if(($arItem[3]["SELECTED"]) AND ($arItem[2] == $_REQUEST["SECTION_NAME"])):?> 			
      <li><?=$arItem[0]?></li>
     		<?elseif($arItem[3]["SELECTED"]):?> 					
      <li><b><a href="<?=$arItem[1]?>" ><?=$arItem[0]?></a></b></li>
     		<?else:?> 			
      <li><a href="<?=$arItem[1]?>" ><?=$arItem[0]?></a></li>
     		<?endif?> 		 		<?if(!empty($arItem[4])):?> 		
      <ul> 			<?foreach($arItem[4] as $arItem1):?> 				<?if($arItem1[3]["SELECTED"]):?> 					
        <li><?=$arItem1[0]?></li>
       				 				<?else:?> 					
        <li><a href="<?=$arItem1[1]?>" ><?=$arItem1[0]?></a></li>
       				<?endif?> 			<?endforeach?> 		</ul>
     		<?endif;?> 		 	<?endforeach?> 	</ul>
   	</div>
 	</div>
 <?};
?>