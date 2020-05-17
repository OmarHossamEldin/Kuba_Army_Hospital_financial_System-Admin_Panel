$(document).ready(function(){
    
    $.ajaxSetup({
         headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]')
         }
    });
    

    /** selecting options ranks &franks */

    //frank
    var frank=$('.frank').attr('data');
    $('.frank').val(frank);

    //rank
    var rank=$('.rank').attr('data');
    $('.rank').val(rank);
    /** selecting options ranks &franks */

    /** get related rank for frank  */

    $('.frank').change(function(){

        var related=$(this).val();
        
        if(related){
            $('.rank').val('');
            $(".update-info").prop('disabled', true);
            $(".relat_to").fadeIn(300);
        }
        else{
            $(".update-info").prop('disabled', false);
            $(".relat_to").fadeOut(300);
        }     
    });

    $('.rank').change(function(){

        var rank=$(this).val();
        
        if(rank){
            $('.frank').val('');
            $(".update-info").prop('disabled', false);
            $(".relat_to").fadeOut(300);

            $('.parent').attr('idinfo',null);
            $('.parent').attr('code',null);
            $('.parent').val(null);
        }   
    });

    $(".search_parent").keyup(function(){

        var input=$(this).val().trim();
        if(!input){
            return;
        }
        else{
            $.ajax({
                url:'/relate/'+input,
                type:'GET',
                success:function(data){
                    
                    $(".search_parent").autocomplete({
                        source: data
                    });
                },
                error:function(e){
                   console.log(e);
                }
            });
        }
    });
    $(".search_parent").keyup(function (e) {
        var input=$(this).val().trim();
        if (e.keyCode === 13) {
            if(input===$.trim($('.name').val()) | input===$.trim($('.code').val()))
            {
                $(this).val(' ');

                return Swal.fire({
                    icon: 'error',
                    title: 'خطاء',
                    text: 'لا يمكن اضافة درجة القاربة الي نفسها',
                    confirmButtonText: 'نعم'
                  });
            }
            else{
                $.ajax({
                    url:'/relate/'+input+'/confirm',
                    type:'GET',
                    success:function(data){
                        console.log(data);
                        $(".update-info").prop('disabled', false);
                        $('.parent').attr('idinfo',data.patient.ID);
                        $('.parent').attr('code',data.patient.code);
                        $('.parent').val(data.rank+' / '+data.patient.name);
                    },
                    error:function(e){
                        console.log(e);
                    }
                });
            }
        }
    });
    
    /** get related rank for frank  */

    /**  updeting patient info */

    $('.update-info').click(function(){
        var id=$('.code').attr('data'),
            code=$.trim($('.code').val()),
            name=$.trim($('.name').val()),
            rank=$('.rank').val(), 
            frank=$('.frank').val();
        if(!code )
        {
            return Swal.fire({
                icon: 'error',
                title: 'خطاء',
                text: 'يجب كتابة رقم الحاسب',
                confirmButtonText: 'نعم'
              });
        }
        if(!name)
        {
            return Swal.fire({
                icon: 'error',
                title: 'خطاء',
                text: 'يجب كتابة اسم المريض',
                confirmButtonText: 'نعم'
              });
        }
        if(!rank & !frank)
        {
            return Swal.fire({
                icon: 'error',
                title: 'خطاء',
                text: 'يجب اختيار  الرتبة او درجة القرابة للمتابعة',
                confirmButtonText: 'نعم'
              });
        }
        if(rank & frank){
            return Swal.fire({
                icon: 'error',
                title: 'خطاء',
                text: 'لايمكن اختيار  الرتبة و درجة القرابة معا',
                confirmButtonText: 'نعم'
              });
        }
        
        $.ajax({
            url:'/patient/'+id,
            type:'PATCH',
            data:{
                _token:$('meta[name="csrf-token"]').attr("content"),
                _method:"PATCH",
                code:code,
                name:name,
                rank:rank,
                frank:frank,
                parentid:$('.parent').attr('idinfo')
            },
            success:function(data){
                if(data==0)
                {
                    return Swal.fire({
                        icon: 'error',
                        title: 'خطاء',
                        text: 'برجاء تحديد درجة القرابة',
                        confirmButtonText: 'نعم'
                      });
                }
                else if(data==1)
                {
                    
                    return Swal.fire({
                        icon: 'success',
                        title: 'تم',
                        text: 'لقد تم تغير البيانات بنجاح',
                        confirmButtonText: 'نعم'
                      });
                }
                else{
                    console.log(data);
                }
            },
            error:function(e){
               console.log(e);
            }
        });
        
    });

    /**  updeting patient info */
       
 });