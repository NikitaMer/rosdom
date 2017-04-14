<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1><?=$arResult["SECTION"]["NAME"]?></h1>
<?
$APPLICATION->SetPageProperty("title", $arResult["SECTION"]["NAME"]);


?>
<?
//echo "<pre>";print_r($arResult);echo "</pre>";

$APPLICATION->AddChainItem("Помощь", "/help/");
	foreach($arResult["SECTIONS"] as $arSection):
		//echo "<pre>";print_r($arSection);echo "</pre>";
		?>
		<p class="sect"><?=$arSection["NAME"]?></p>
		<div class="elements">
			<?$db=CIBlockElement::GetList(array("SORT"=>"ASC"), array("SECTION_ID"=>$arSection["ID"]));
			//echo $arSection["ID"];
			while($el = $db->GetNext()){ ?>

				<div class="head" id="help_head">
					<?=$el["NAME"];?> 
				</div>
				<div style="clear:left;"></div>
				<div class="text">
					<?=$el["PREVIEW_TEXT"];?>
				</div>
				<?//echo "<pre>";print_r($el);echo "</pre>";
			}
			?>
			
		</div>	
		


		<? endforeach?>


<script type="text/javascript">
$(function (){
	$("div.head").click(function(){
	$(this).next().next().slideToggle();
	});
});

</script>