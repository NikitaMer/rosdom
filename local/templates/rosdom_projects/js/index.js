$(document).ready(function () {
    // Увеличение картинок
   $('.min_img').click(function(){
        src = $(this).attr('src');
        alt = $(this).attr('alt');                        
        title = $(this).attr('title');                         
        $('#viz').attr('src',src);                        
        $('#viz').attr('alt',alt.replace(/(^|\s+)маленькая(\s+|$)/g, ''));                        
        $('#viz').attr('title',title.replace(/(^|\s+)маленькая(\s+|$)/g, ''));                        
    });
   
});