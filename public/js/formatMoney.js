$(document).ready(function(){
    $('.money').each(function () {
        var item = $(this).text();
        var num = Number(item).toLocaleString('en');     
        if (Number(item) < 0) { 
            $(this).addClass('negMoney');
        }else{
            $(this).addClass('enMoney');
        } 
        $(this).text(num);
    });
});
