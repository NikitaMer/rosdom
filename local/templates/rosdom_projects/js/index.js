$(document).ready(function () {
    // ���������� ��������
   $('.min_img').click(function(){
        src = $(this).attr('src');
        alt = $(this).attr('alt');                        
        title = $(this).attr('title');                         
        $('#viz').attr('src',src);                        
        $('#viz').attr('alt',alt.replace(/(^|\s+)���������(\s+|$)/g, ''));                        
        $('#viz').attr('title',title.replace(/(^|\s+)���������(\s+|$)/g, ''));                        
    });
   
});