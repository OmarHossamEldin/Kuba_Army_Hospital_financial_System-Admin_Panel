function makeRequest(input,page=1){
    $.ajax({
        url:'/visitin/'+ input +`?page=${page}`,
        type:'GET',
        success:function(data){
            console.log(data);
            $('.visitIns-result').html(' ');
            $('.visitIns-result').html(data);
            $('.page-link').click(function (e) {
                e.preventDefault();
                if ($(this).attr('href')) {
                    var start = $(this).attr('href').lastIndexOf('=');
                    var page = $(this).attr('href').slice(start + 1);
                    $(this).addClass('active');
                    makeRequest(input, page);
                }
            });
        },
        error:function(e){
           console.log(e);
        }
    });
}

$(document).ready(function(){
    
    $.ajaxSetup({
         headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]')
         }
    });
    
    /** select  key or selector */
    $(".searchkey").keypress(function(){
        var input=$(this).val().trim();
        if(!input){
            return;
        }
        else{
            $.ajax({
                url:'/relate/'+input,
                type:'GET',
                success:function(data){
                    console.log(data);
                    $(".searchkey").autocomplete({
                        source: data
                    });

                },
                error:function(e){
                   console.log(e);
                }
            });
        }
    });

    /** select  key or selector */


    /** get VisitINs using key or selector */
    $(".searchkey").keyup(function (e) {
        var input=$(this).val().trim();
        if (e.keyCode === 13) {
            makeRequest(input);
        }
    });

    /** get VisitINs using key or selector */


       
});