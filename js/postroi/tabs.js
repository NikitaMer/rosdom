
(function($){
	
	$.fn.tabs = function(classOn, classOff) {
		
		var root = this;
		var tabsName = this.attr('id');
		
		var item_headers = $(this).children(".item_header");
		var item_contents = $(this).children(".item_content");
		
		var activeTab = $.cookie(tabsName) || 0;
				
		$(item_headers).addClass(classOff);
		
		$(item_headers[activeTab]).removeClass(classOff);
		$(item_headers[activeTab]).addClass(classOn);
		$(item_contents[activeTab]).css("display", "block");
		
		$(this).children(".item_header").click(function(){
			for(var i=0; i<item_headers.length; i++) {
				if(this == item_headers[i]) {
					activeTab = i;
					$(item_headers[i]).removeClass(classOff);
					$(item_headers[i]).addClass(classOn);
					$(item_contents[i]).css("display", "block");
				}
				else {
					$(item_headers[i]).removeClass(classOn);
					$(item_headers[i]).addClass(classOff);
					$(item_contents[i]).css("display", "none");
				}
			}
			$(root).data('activeTab', activeTab);
			$.cookie(tabsName, activeTab);
			$(root).trigger('tabs.tabclicked');
		});
		$(root).data('activeTab', activeTab);
		$(root).trigger('tabs.tabclicked');
		
	};
	
})(jQuery);