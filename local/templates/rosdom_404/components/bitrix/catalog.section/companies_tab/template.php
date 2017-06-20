<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<!--<pre>
<? //print_r($arResult);?>
</pre>-->
<?
if (count($arResult["ITEMS"]) > 0) {
?>
<script>
$(function (){
	$('#tabs-companies').show();
});
</script>
<?
};

if (($_COOKIE['sections-tabs'] == 'tabs-companies') AND (count($arResult["ITEMS"]) == 0)) {
?>
<script>
	$('.secdes').removeClass('visible');
	$('#tabs-about').addClass('active');
	$('#tabs-about-container').addClass('visible');
</script> 
<?
};
?>
<?
/*echo '<pre>';
print_r($arParams);
echo '</pre>';*/

$res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'CODE' => $arParams['SECTION_CODE'])); 
$section = $res->GetNext(); 

global $current_firms_section;
$current_firms_section = $section['ID'];;
//echo '!'.$current_firms_section;

$firms_per_col = ceil(count($arResult["ITEMS"]) / 3);

$i = 0;
?>
<div class="w-column">
<div class="b-column">
<ul>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		
			<?
			if ($i == $firms_per_col) {
				echo '</ul></div><div class="b-column"><ul>';
				$i = 0;
			};
			?>
		

			<li><strong><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></strong><br />
						<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<?/*=$arProperty["NAME"]*/?><?/*:&nbsp;*/?><?
								if(is_array($arProperty["DISPLAY_VALUE"]))
									echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
								else
									echo $arProperty["DISPLAY_VALUE"];?><br />
						<?endforeach?>
			</li>
						
			<?$i++;?>


		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
</ul>
</div>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<?
global $current_section_description;
global $current_section_id;
$current_section_description = $arResult["DESCRIPTION"];

$current_section_id = $arResult["ID"];

?>
<!-- <script>
$(function (){
  
$('#about-section-description').html('<?echo str_replace(array("\r","\n"),"",$current_section_description);?>');
   });
</script> -->
