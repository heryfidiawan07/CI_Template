(function() {
    'use strict';
    domFactory.handler.autoInit();
});

$(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
});

// $("#btnLogin").click(function() {
//     // $('#loadingModal').modal({backdrop: 'static', keyboard: false});
//     // alert('Test');
//     var username = $('#username').val();
//     var password = $('#password').val();
//     if(username == '' || password == '') {
//         alert('Username or password must be fill.');
//     }else {
//         $.ajax({
//             url: '<?= base_url('login/login'); ?>',
//             type: 'POST',
//             data:  $( "#flogin" ).serialize(),
//             success: function (data){
//                 var data = eval('('+data+')');
//                 var result = (data.msg).split('|');
//                 if (data.info == 'success') {
//                     window.location = data.redirect;
//                 }
//                 else{
//                     alert(result[1]);
//                     return false;
//                 }
//             }
//         });
//     }
//     // $('#loadingModal').modal('hide');

//     return false;
// });

$('#linkForgotpassword').click(function() {
    $('#modalForgot').modal('show');
});

$('#modalForgot').on('hidden.bs.modal', function () {
    $('#usernameForgot').val('');
    $('#emailForgot').val('');
    $('#WarnusernameForgot').css('display', 'none');
    $('#WarnemailForgot').css('display', 'none');
});

$('#btnSavepassword').click(function() {
        var username = $('#usernameForgot').val();
        var email = $('#emailForgot').val();
        var isValid = 1;

    if(username == '') {
        $('#WarnusernameForgot').css('display', 'block');
        $('#WarnusernameForgot').html('<i class="fa fa-exclamation-circle"></i> Required field.');
    }else {
        $('#WarnusernameForgot').css('display', 'none');
    }

    if(email == '') {
        $('#WarnemailForgot').css('display', 'block');
        $('#WarnemailForgot').html('<i class="fa fa-exclamation-circle"></i> Required field.');
    }else {
        $('#WarnemailForgot').css('display', 'none');
    }

    if(username == '' || email == '') {
        isValid = 0;
    }

    if(isValid == 1) {
        $.ajax({
            url: 'http://10.8.3.125/singletid/c_login/forgotpassword',
            type: 'POST',
            data:  { username: username, email: email },
            success: function (data) {
                var data = eval('('+data+')');
                var result;
                result = (data.msg).split('|');
                if (data.info == 'success') {
                    alert('New password has been sent to your email');
                    $('#modalForgot').modal('hide');
                // window.location = "";
                }else {
                    if(result[0] == '01') {
                        $('#WarnusernameForgot').css('display', 'block');
                        $('#WarnusernameForgot').html('<i class="fa fa-exclamation-circle"></i> User is not exists.');
                    }else {
                        $('#WarnemailForgot').css('display', 'block');
                        $('#WarnemailForgot').html('<i class="fa fa-exclamation-circle"></i> Email is not valid.');
                    }
                }
            }
        });
    }
});