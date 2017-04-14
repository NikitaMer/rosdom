<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
<script type="text/javascript" src="/js/jquery.tinycarousel.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#slider').tinycarousel();	
	});
</script>	
<style type="text/css">
#slider { height: 1%; overflow:hidden; padding: 0 0 10px; float:left;  }
#slider .viewport { float: left; width: 500px; height: 500px; overflow: hidden; position: relative; }
#slider .buttons { background:url(/i/arrows.png) no-repeat scroll 0 0 transparent; display: block; margin: 160px 10px 0 0; background-position: 0 -38px; text-indent: -999em; float: left; width: 20px; height: 37px; overflow: hidden; position: relative; }
#slider .next { background-position: 0 0; margin: 160px 0 0 10px;  }
#slider .disable { visibility: hidden; }
#slider .overview { list-style: none; position: absolute; padding: 0; margin: 0; width: 240px; left: 0 top: 0; }
#slider .overview li{ float: left; margin: 0 20px 0 0; padding: 1px; height: 121px; border: 1px solid #dcdcdc; width: 500px;}

</style>		

<h1> <?=$arResult['NAME'] ?> </h1>



	<div id="slider">
		<a class="buttons prev" href="#">left</a>
		<div class="viewport">
			<ul class="overview">
<? foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $picture){ ?>
			<li><img src="<?=CFile::GetPath($picture)?>" /></li>
<? } ?>

			</ul>
		</div>
		<a class="buttons next" href="#">right</a>
	</div>
<div>
<?=$arResult['DETAIL_TEXT'] ?>
</div>



			