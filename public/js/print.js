$(document).ready(function(){

    $('.print').click(function(){
        $('.invoice').printThis({
            importCSS: false,
            loadCSS: "../css/print.css",
        });
    });
});

$(document).keypress(function(e){
    if(e.keyCode==13){
        $('.invoice').printThis({
            importCSS: false,
            loadCSS: "../css/print.css",
        });
    }
});

 