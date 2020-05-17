function makeRequest(patient, newPage = 1) {
    $.ajax({
        url: '\patient/' + patient + `?page=${newPage}`,
        type: 'GET',
        success: function (data) {
            if (data == 0) {
                $('.message').html(" ");
                $('.patients-result').html(" ");
                $('.message').html("<div class='alert alert-danger' style='text-align: right;'>لا توجد معلومات</div>");
            }
            else {
                $('.message').html(" ");
                $('.patients-result').html(" ");
                $('.patients-result').html(data);
                $('.page-link').click(function (e) {
                    e.preventDefault();
                    if ($(this).attr('href')) {
                        var start = $(this).attr('href').lastIndexOf('=');
                        var page = $(this).attr('href').slice(start + 1);
                        $(this).addClass('active');
                        makeRequest(patient, page);
                    }
                });
                /** delete patient  from Patients Table */
                $('.delete').click(function () {
                    var patient = $(this).attr("info");
                    Swal.fire({
                        icon: 'warning',
                        title: 'تأكيد حذف',
                        text: 'هل تريد حذف المريض',
                        confirmButtonText: 'تأكيد'
                    }).then(function () {
                        $.ajax({
                            url: '/patient/' + patient,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr("content"),
                                _method: "DELETE"
                            },
                            success: function (data) {
                                if(data==1){
                                    return Swal.fire({
                                        icon: 'success',
                                        title: 'تم',
                                        text: 'تم حذف المريض بنجاح',
                                        confirmButtonText: 'نعم'
                                    }).then(function () {
                                        location.reload(true);
                                    });
                                }
                                else{
                                    return Swal.fire({
                                        icon: 'error',
                                        title: 'حطاء',
                                        text: 'حوث خطاء اثناء الحدف',
                                        confirmButtonText: 'نعم'
                                    });
                                }
                                
                            },
                            error: function (e) {
                                console.log(e)
                                return Swal.fire({
                                    icon: 'error',
                                    title: 'خطاء',
                                    text: 'لا يمكن حذف المريض لانه قام بزيارات سابقة',
                                    confirmButtonText: 'نعم'
                                });
                            }
                        });
                    });
                    
                });
            }
        },
        error: function (e) {
            console.log(e);
        }
    });
}

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
        }
    });

    // filter for table patient

    $('.patient').keyup(function () {
        var patient = $(this).val().trim();
        if (!patient || patient == '') {
            $('.message').html(" ");
            $('.patients-result').html(" ");
            return;
        }
        else {
            makeRequest(patient);
        }
    });
    // filter for table patient



    /** delete Patient From Patients Table */

});