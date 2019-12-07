$(document).ready(function () {

    var base_url = $('#base_url').val();
    
    var dataTable = $('#user_table').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [],
        'ajax': {
            url : base_url+'user/datatables',
            type: 'POST'
        },
        'columnDefs': [
            {
                'targets': [0,7,8],
                'orderable': false,
            },
            {
                "targets": [7,8],
                "className": "text-center",
            }
        ]
    });

    function showNotification(data, status) {
        $('#notification').addClass('alert alert-'+status+' alert-dismissible fade show animated bounceOutUp delay-5s text-white bold');
        $('#notification').fadeIn().html(data);
        if (status == 'danger') {
            $('#notification').prepend('<i class="fas fa-exclamation-triangle pr-2"></i>');
        }else {
            $('#notification').prepend('<i class="fas fa-check-circle pr-2"></i>');
        }
        $('#notification').append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        setTimeout(function() {
            $('#notification').fadeOut('slow');
        }, 6000);
    }

    // FORM CREATE ========================================================================================================================
    $(document).on('submit', '#form_create', function(event){
        event.preventDefault();

        $('#btn-create').text('Saving ...');

        var name     = $('#name').val();
        var username = $('#username').val();
        var email    = $('#email').val();
        var role_id  = $('#role_id').val();
        var password = $('#password').val();
        var repass   = $('#repeat_password').val();

        if (password == repass) {
            if (name != '' && username != '' && email != '' && role_id != 0 && password != '' && repass != '') {
                $.ajax({
                    url: base_url+'user/store/', 
                    method: 'POST',
                    data:{
                        name: name,
                        username: username,
                        email: email,
                        role_id: role_id,
                        password: password,
                    },
                    success: function(data){
                        data = JSON.parse(data);
                        if (data.error) {
                            showNotification(data.error, 'danger');
                        }
                        if (data.success) {
                            showNotification(data.success, 'success');
                        }
                        $('#form_create')[0].reset();
                        $('#modal-create').modal('hide');
                        $('#btn-create').text('Save');
                        dataTable.ajax.reload();
                    }
                });
            }else{
                alert('Field must be required !');
                $('#btn-create').text('Save');
            }
        }else {
            alert('Password not match with retype password !');
            $('#btn-create').text('Save');
        }
    });

    // USER EDIT ===========================================================================================================================
    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $('#form_edit').attr('action', base_url+'user/update/'+id);
        $.ajax({
            url: base_url+'user/show/'+id,
            method: 'GET',
            success: function(data){
                var user = JSON.parse(data);
                
                $('#name_edit').val(user.name);
                $('#username_edit').val(user.username);
                $('#email_edit').val(user.email);
                $('#role_id_edit option[value='+user.role_id+']').attr('selected','selected');
                $('#status option[value='+user.status+']').attr('selected','selected');
            }
        });
    });

    // FORM UPDATE ========================================================================================================================
    $(document).on('submit', '#form_edit', function(event){
        event.preventDefault();
        $('#btn-edit').text('Saving ...');
        
        var name_edit     = $('#name_edit').val();
        var username_edit = $('#username_edit').val();
        var email_edit    = $('#email_edit').val();
        var role_id_edit  = $('#role_id_edit').val();
        var password_edit = $('#password_edit').val();
        var repass_edit   = $('#repass_edit').val();
        var status        = $('#status').val();

        var urlForm       = $('#form_edit').attr('action');

        if (password_edit == repass_edit) {
            if (name_edit != '' && username_edit != '' && email_edit != '' && role_id_edit != 0 && password_edit != '') {
                $.ajax({
                    url: urlForm,
                    method: 'POST',
                    data: {
                        name : name_edit,
                        username : username_edit,
                        email : email_edit,
                        role_id : role_id_edit,
                        password : password_edit,
                        status : status
                    },
                    success: function(data){
                        data = JSON.parse(data);
                        if (data.error) {
                            showNotification(data.error, 'danger');
                        }
                        if (data.success) {
                            showNotification(data.success, 'success');
                        }
                        $('#form_edit')[0].reset();
                        $('#modal-edit').modal('hide');
                        $('#btn-edit').text('Save');
                        dataTable.ajax.reload();
                    }
                });
            }else{
                $('#btn-edit').text('Save');
                alert('Field edit must be required !');
            }
        }else {
            alert('Password not match with retype password !');
            $('#btn-edit').text('Save');
        }
    });

    // USER DELETE ==========================================================================================================================
    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: base_url+'user/show/'+id,
            method: 'GET',
            success: function(data){
                var user = JSON.parse(data);
                $('.modal-title').text('Delete User '+user.name+' ?');

                $(document).on('click', '#btn-delete', function(event){
                    event.preventDefault();
                    $('#btn-delete').text('Delete ...');
                    $.ajax({
                        url: base_url+'user/destroy/'+id,
                        method: 'GET',
                        success: function(data){
                            data = JSON.parse(data);
                            if (data.error) {
                                showNotification(data.error, 'danger');
                            }
                            if (data.success) {
                                showNotification(data.success, 'success');
                            }
                            $('#modal-delete').modal('hide');
                            $('#btn-delete').text('Delete !');
                            dataTable.ajax.reload();
                        }
                    });
                });
            }
        });
    });

    // =================================================
    $('.get_data_user').on('click', function () {
        var link = base_url+'user/datatables' + '?status=' + $(this).attr('data-status');
        // console.log(link);
        $('#user_table').DataTable().ajax.url(link).load();
    });

    // Prevent space username input
    var usernameInput = document.querySelector('[name="username"]');

    usernameInput.addEventListener('keypress', function ( event ) {  
       var key = event.keyCode;
        if (key === 32) {
          event.preventDefault();
        }
    });
    $('#username').keyup(function(){
        $(this).val($(this).val().toLowerCase());
    });
    $('#email').keyup(function(){
        $(this).val($(this).val().toLowerCase());
    });

});
