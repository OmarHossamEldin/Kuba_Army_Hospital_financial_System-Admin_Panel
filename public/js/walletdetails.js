$(document).ready(function(){
    
    $.ajaxSetup({
         headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]')
         }
    });
    
    /**<-----------------date ----------------------> */
    $('.edit-date').click(function(){

        $(".edit-date").fadeOut(300);
        $(".update-date").fadeIn(1000);

        $('.start').attr('readonly',false);
        $('.end').attr('readonly',false);

        $('.start').daterangepicker({
            singleDatePicker: true,
            startDate : $('.start').attr('data'),
            locale: {
                format: 'YYYY-MM-DD'
            } 
        });
        $('.end').daterangepicker({
            singleDatePicker: true,
            startDate : $('.end').attr('data'),
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        if(!$('.end').attr('data'))
        {
            $('.end').val(' ');
        }
        
    });

    $('.update-date').click(function(){
        var visitIn=$(this).attr("visitInid"),
            start=$('.start').val(),
            end=$('.end').val();
            if(end==" ")
            {
                return Swal.fire({
                    icon: 'error',
                    title: 'خطاء',
                    text: 'برجاء التاكد من تاريخ خروج',
                    confirmButtonText: 'نعم'
                });
            }
            $.ajax({
                url:'/date/'+visitIn,
                type:'PATCH',
                data:{
                    _token:$('meta[name="csrf-token"]').attr("content"),
                    _method:"PATCH",
                    start:start,
                    end:end
                },
                success:function(data){
                    if(data==0)
                    {
                        return Swal.fire({
                            icon: 'error',
                            title: 'خطاء',
                            text: 'لقد حدث خطاء اثناء تعديل التواريخ',
                            confirmButtonText: 'نعم'
                        });
                    }
                    else
                    {
                       return Swal.fire({
                            icon: 'success',
                            title: 'تم',
                            text: 'لقد تم تغير البيانات بنجاح',
                            confirmButtonText: 'نعم'
                        }).then(function() {
                            location.reload(true);
                        });
                    }
                },
                error:function(e){
                   console.log(e);
                }
            });

    });
    /**<-----------------date ----------------------> */
    
    /** Validate Price And Saving newMyCash */
    $('.total').click(function(){
        var visitInid=$(this).attr('visitInid');
        Swal.fire({
            title: 'من فضلك قم بادخال الرصيد الصحيح',
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
            },
            confirmButtonText: 'تاكيد',
            showLoaderOnConfirm: true,
            preConfirm: function(value){
                if(!value){
                    return Swal.fire({
                        icon: 'error',
                        title: 'خطاء',
                        text: 'برجاء ادخال الرصيد بصورة صحيحة',
                        confirmButtonText: 'نعم'
                    });
                }
                var pattern=/^\d{0,6}(\.\d{0,3}){0,1}$/;
                if(pattern.test(value)){
                    $.ajax({
                            url:'/visitIn/'+visitInid,
                            type:'PATCH',
                            data:{
                                _token:$('meta[name="csrf-token"]').attr("content"),
                                _method:"PATCH",
                                MyCash:value 
                            },
                            success:function(data){
                                if(data==0){
                                    return Swal.fire({
                                        icon: 'error',
                                        title: 'خطاء',
                                        text: 'حدث خطاء اثناء تحديث الرصيد',
                                        confirmButtonText: 'نعم'
                                    });
                                }
                                else{
                                    Swal.showLoading();
                                    setTimeout(function(){
                                        Swal.close();
                                    },1000);
                                    setTimeout(function(){
                                        $('.total').val(value);
                                        return Swal.fire({
                                            icon: 'success',
                                            title: 'تم',
                                            text: 'لقد تم تغير البيانات بنجاح',
                                            confirmButtonText: 'نعم'
                                        })
                                    },1000);
                                }
                            },
                            error:function(e){
                               console.log(e);
                            }
                    });
                }
                else{
                    console.log(false);                      
                }
            }
        });
    });
    /** Validate Price And Saving newMyCash */

    /** Changing Types For Morafeks */
    $('.type').click(function(){
        var Morafek=$(this).attr('morafekId');
        Swal.fire({
            title: 'من فضلك قم باختيار نوع المرافق',
            input: 'select',
            inputOptions: {
              "2":"داخل البطاقة",
              "3":"خارج البطاقة"
            },
            inputAttributes: {
                autocapitalize: 'off'
            },
            inputPlaceholder:"تحديد النوع",
            confirmButtonText: 'تاكيد',
            showLoaderOnConfirm: true,
            preConfirm: function(value){
                if(!value){
                    return Swal.fire({
                        icon: 'error',
                        title: 'خطاء',
                        text: 'برجاء اختيار المرافق بصوره صحيحه',
                        confirmButtonText: 'نعم'
                    });
                }
                else{
                    $.ajax({
                            url: '/morafek/service/'+Morafek,
                            type:'PATCH',
                            data:{
                                _token:$('meta[name="csrf-token"]').attr("content"),
                                _method:"PATCH",
                                ServiceId:value 
                            },
                            success:function(data){
                                if(data==0){
                                    return Swal.fire({
                                        icon: 'error',
                                        title: 'خطاء',
                                        text: 'برجاء اختيار نوع المرافق',
                                        confirmButtonText: 'نعم'
                                    });
                                }
                                else{
                                    Swal.showLoading();
                                    setTimeout(function(){
                                        Swal.close();
                                    },1000);
                                    setTimeout(function(){
                                        return Swal.fire({
                                            icon: 'success',
                                            title: 'تم',
                                            text: 'لقد تم تغير البيانات بنجاح',
                                            confirmButtonText: 'نعم'
                                        })
                                    },1000);
                                }
                            },
                            error:function(e){
                               console.log(e);
                            }        
                        });
                }
            }
        });
    });
    /** Changing Types For Morafeks */

    /** Changing Balance For Morafek */
    $('.morafekbalance').click(function(){
        var Morafek=$(this).attr('morafekId');
        Swal.fire({
            title: 'من فضلك قم بادخال الرصيد الصحيح',
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
            },
            confirmButtonText: 'تاكيد',
            showLoaderOnConfirm: true,
            preConfirm: function(value){
                if(!value){
                    return Swal.fire({
                        icon: 'error',
                        title: 'خطاء',
                        text: 'برجاء ادخال الرصيد بصورة صحيحة',
                        confirmButtonText: 'نعم'
                    });
                }
                var pattern=/^\d{0,6}(\.\d{0,3}){0,1}$/;
                if(pattern.test(value)){
                    $.ajax({
                            url:'/morafek/balance/'+Morafek,
                            type:'PATCH',
                            data:{
                                _token:$('meta[name="csrf-token"]').attr("content"),
                                _method:"PATCH",
                                MyCash:value 
                            },
                            success:function(data){
                                if(data==0){
                                    return Swal.fire({
                                        icon: 'error',
                                        title: 'خطاء',
                                        text: 'حدث خطاء اثناء تحديث الرصيد',
                                        confirmButtonText: 'نعم'
                                    });
                                }
                                else{
                                    Swal.showLoading();
                                    setTimeout(function(){
                                        Swal.close();
                                    },1000);
                                    setTimeout(function(){
                                        $('.morafekmoney'+Morafek).val(value);
                                        return Swal.fire({
                                            icon: 'success',
                                            title: 'تم',
                                            text: 'لقد تم تغير البيانات بنجاح',
                                            confirmButtonText: 'نعم'
                                        })
                                    },1000);
                                }
                            },
                            error:function(e){
                               console.log(e);
                            }
                    });
                }
                else{
                    console.log(false);                      
                }
            }
        });
    });
    /** Changing Balance For Morafek */

    /**Updating StartDate And EndDate For Morafeks Or Deleting Them */
    $(".edit-info").click(function(){
        var selector=$(this).attr('morafekId');
            MStart=$('.MStart'+selector).html();
            MEnd=$('.MStart'+selector).html();
        $(".Morafekstart"+selector).attr('readonly',false);
        $(".Morafekend"+selector).attr('readonly',false);
        $('.Morafekstart'+selector).daterangepicker({
            singleDatePicker: true,
            startDate : $('.Morafekstart'+selector).attr('data'),
            locale: {
                format: 'YYYY-MM-DD'
            } 
        });
        $('.Morafekend'+selector).daterangepicker({
            singleDatePicker: true,
            startDate : $('.Morafekend'+selector).attr('data'),
            locale: {
                format: 'YYYY-MM-DD'
            } 
        });
        $(".update-info").fadeOut();
        $(".edit-info").attr('disabled',true);
        $(".delete-info").attr('disabled',true);
        $(".e"+selector).fadeOut(300);
        $(".d"+selector).fadeOut(300);
        $(".u"+selector).fadeIn(1000);
        $(".r"+selector).fadeIn(1000);
    });

    //reverse editng
    $(".reverse").click(function(){
        var selector=$(this).attr('morafekId');
        $(".MStart"+selector).html(' ');
        $(".MStart"+selector).html(MStart);
        $(".MEnd"+selector).html(' ');
        $(".MEnd"+selector).html(MEnd);
        $(".r"+selector).fadeOut(300);
        $(".u"+selector).fadeOut(300);
        $(".edit-info").attr('disabled',false);
        $(".delete-info").attr('disabled',false);
        $(".e"+selector).fadeIn(300);
        $(".d"+selector).fadeIn(300);        
    });
    //->updating Date morafek/{Morafek}
    $(".update-info").click(function(){
        var Morafek=$(this).attr('morafekId'),
            DayIn =$('.Morafekstart'+Morafek).val(),
            DayOut =$('.Morafekend'+Morafek).val();
            $.ajax({
                    url:'/morafek/'+Morafek,
                    type:'PATCH',
                    data:{
                        _token:$('meta[name="csrf-token"]').attr("content"),
                        _method:"PATCH",
                        DayIn:DayIn,
                        DayOut 
                    },
                    success:function(data){
                        if(data==0){
                            return Swal.fire({
                                icon: 'error',
                                title: 'خطاء',
                                text: 'حدث خطاء اثناء تغير التواريخ',
                                confirmButtonText: 'نعم'
                            });
                        }
                        else{
                            Swal.showLoading();
                            setTimeout(function(){
                                Swal.close();
                            },1000);
                            setTimeout(function(){
                                $(".r"+Morafek).fadeOut(300);
                                $(".u"+Morafek).fadeOut(300);
                                $(".edit-info").attr('disabled',false);
                                $(".delete-info").attr('disabled',false);
                                $(".e"+Morafek).fadeIn(300);
                                $(".d"+Morafek).fadeIn(300);
                                $('.Morafekstart'+Morafek).attr('readonly',true);
                                $('.Morafekend'+Morafek).attr('readonly',true);
                                return Swal.fire({
                                    icon: 'success',
                                    title: 'تم',
                                    text: 'لقد تم تغير التواريخ بنجاح',
                                    confirmButtonText: 'نعم'
                                })
                            },1000);
                        }
                    },
                    error:function(e){
                        console.log(e);
                    }
            });
    });
    //->Deleting morafek
    $(".delete-info").click(function(){
        var Morafek=$(this).attr('morafekId');
        $.ajax({
                url:'/morafek/'+Morafek,
                type:'DELETE',
                data:{
                    _token:$('meta[name="csrf-token"]').attr("content"),
                    _method:"DELETE"
                },
                success:function(data){
                    if(data==0){
                        return Swal.fire({
                            icon: 'error',
                            title: 'خطاء',
                            text: 'حدث خطاء اثناء حذف المرافق',
                            confirmButtonText: 'نعم'
                        });
                    }
                    else{
                        Swal.showLoading();
                        setTimeout(function(){
                            Swal.close();
                        },1000);
                        setTimeout(function(){
                            return Swal.fire({
                                icon: 'success',
                                title: 'تم',
                                text: 'لقد تم حذف المرافق بنجاح',
                                confirmButtonText: 'نعم'
                            })
                        },1000);
                    }
                },
                error:function(e){
                    console.log(e);
                }
        });
    })
    /**Updating StartDate And EndDate For Morafeks Or Deleting Them */
 });