$(document).ready(function(){
    
   $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]')
        }
   });

   // filter for table users
   var old_rows=$('.data-rows').html();
   $('.searchusername').keyup(function(){
        var searchusername=$(this).val().trim();
        if(!searchusername || searchusername==''){
            $('.data-rows').html(old_rows);
        }
        else
        {
            $.ajax({
                url:'\search/'+searchusername,
                type:'GET',
                success:function(data){
                    console.log(data);
                    $('.data-rows').html(' ');
                    $('.data-rows').html(data);
                },
                error:function(e){
                    console.log(e);
                    console.log(searchusername);
                }
            });
        }
   });
   // filter for table users
   
});