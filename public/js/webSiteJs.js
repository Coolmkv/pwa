$(document).ready(function(){
     
});
let windowUrl = window.location.hostname;
function loadMenu(){
    $.ajax({
        url:'/getmenu-items',
        type:'GET',
        accept:'json',
        success:function(data){
             
            if(data.menu_html.top){
                $("#top_menu").html(data.menu_html.top);
            }
        }
    });
}