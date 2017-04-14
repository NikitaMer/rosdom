$(function (){
   $('#index-tabs').delegate('li:not(.active)', 'click', function() {
   
      $(this).addClass('active').siblings().removeClass('active').parents('.w-tabs').find('.description').hide().eq($(this).index()).css('display', 'block');
      return false;
   });
   
   $('#company-tabs').delegate('li:not(.active)', 'click', function() {
   
      $(this).addClass('active').siblings().removeClass('active').parents('.w-tabs').find('.description').hide().eq($(this).index()).css('display', 'block');
      return false;
   });
});



$(function (){
   $("#ask_link").click(function(){
   //alert($("#ask_form").css("display"));
	if($("#ask_form").css("display") == 'none'){
	$("#ask_link").addClass('active');
	$("#current-tab").removeClass('active');
	$("#main_plank").removeClass('visible');
	$("#ask_form").slideDown(300);}
	else {
		$("#ask_form").slideUp(300);
		$("#main_plank").addClass('visible');
		$("#current-tab").addClass('active');
		$("#ask_link").removeClass('active');
		}
   });
});

$(function (){
   $('#section-tabs').delegate('li:not(.active)', 'click', function() {
      $(this).addClass('active').siblings().removeClass('active').parents('.w-tabs').find('.description').hide().eq($(this).index()).css('display', 'block');
      var coocont = $(this).attr('id');
	  
	  $.cookie('sections-tabs', coocont, { path: '/' });
	  
	  return false;
   });
});

$(function() {
   $( "#calendar" ).datepicker();
});

$(function() {
   $('.list-docs .b-list-docs dd:last').css('borderBottom', 'none')
});

$(function() {
   $( "#city-selector" ).change(function(){ 
		//alert($("#city-selector option:selected").attr('value'));
		$.cookie("selected-city", $("#city-selector option:selected").attr('value'), {path: '/'});
		location.reload();
   });
});

$(function() {
   $('#showMore').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		
		$('.hiddentable').addClass('active');
		$('#showMore').hide();
		$('#hideMore').show();
						
	});

	$('#hideMore').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		
		$('.hiddentable').removeClass('active');
		$('#showMore').show();
		$('#hideMore').hide();
						
	});
});