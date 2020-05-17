$(document).ready(function(){
    
    $.ajaxSetup({
         headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]')
         }
    });
 
    /** answering SQ */
    $('.store').click(function(){
        var data=$('.answer').val().trim();
        
        if($('.store').attr('done')=='done!'){
            var data=$('.answer').val().trim();
            var user=$('.answer').attr("username");
            $.ajax({
                url:'confirmAnswer/'+user+'/'+data,
                type:'GET',
                success:function(data){
                    if(data=='NotConfirmed'){
                        return;
                    }
                    else{
                        window.location ='changingPassword/'+data;
                    }
                    
                },
                error:function(e){
                    console.log(e);
                }
            });
        }
        else{
            if(!data){
                return;
            }
            else{
                $('.answer').attr("username",data);
                $.ajax({
                    url:'forgetPassword/'+data,
                    type:'GET',
                    success:function(data){
                        if(!data[1]){
                            //console.log(data[0]);
                            $('.msg-alert').html(data[0]);
                            setTimeout(function(){
                                $('.msg-alert').html(' ');
                            },1000)
                        }
                        else{
                            //console.log(data[1]);
                            $('.question').html(' ');
                            $('.question').html(data[0]);
                            $('.answer').attr("placeholder","اكتب اجابتك هنا");
                            $('.answer').val(' ');
                            $('.store').attr('done','done!');
                        }
                    },
                    error:function(e){
                        console.log(e);
                    }
                });
            }
        }
        
    });
    /** answeringSQ */

 });