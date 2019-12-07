$(document).ready(function () {

    var base_url = $('#base_url').val();
    
    var dataTable = $('#role_table').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [],
        'ajax': {
            url : base_url+'role/datatables',
            type: 'POST'
        },
        'columnDefs': [
            {
                'targets': [0,3,4,5,6],
                'orderable': false,
            },
            {
                "targets": [4,5,6],
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

    $(document).on('click', '.menu_id', function(){
        var id = $(this).attr('data-id');
        if($('#menu_'+id).is(':checked')) {
            $('.action_'+id).prop('checked', true);
        }else {
            $('.action_'+id).prop('checked', false);
        }
        $('.action_'+id).on('click', function() {
            if ($('.action_'+id).filter(':checked').length < 4) {
                $('#menu_'+id).prop('checked', false);
            }
        });
    });
    $(document).on('click', '.actions', function() {
        var id = $(this).attr('id');
        if ($('.action_'+id).is(':checked') > 0) {
            $('#menu_'+id).prop('checked', true);
        }else{
            $('#menu_'+id).prop('checked', false);
        }
        // console.log($('.action_'+id).filter(':checked').length);
    });
    // Add Role
    $(document).on('submit', '#form_create', function(event) {
        event.preventDefault();
        $('#btn-create').text('Saving ...');
        
        var name = $('#name').val();

        if (name != '') {
            $.ajax({
                url: base_url+'role/store/',
                method: 'POST',
                data: $('#form_create').serialize(),
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
        }else {
            alert('Field must be required !');
            $('#btn-create').text('Save');
        }
    });


    // ROLE UPDATE ==========================================================================================================================
    $(document).on('click', '.edit', function(){
        $(document).on('click', '.menu_id_edit', function(){
            var id = $(this).attr('data-id');
            if($('#menu_edit_'+id).is(':checked')) {
                $('.action_edit_'+id).prop('checked', true);
            }else {
                $('.action_edit_'+id).prop('checked', false);
            }
            $('.action_edit_'+id).on('click', function() {
                if ($('.action_edit_'+id).filter(':checked').length < 4) {
                    $('#menu_edit_'+id).prop('checked', false);
                }
            });
        });
        $(document).on('click', '.actions_edit', function() {
            var id = $(this).attr('id');
            if ($('.action_edit_'+id).is(':checked') > 0) {
                $('#menu_edit_'+id).prop('checked', true);
            }else{
                $('#menu_edit_'+id).prop('checked', false);
            }
            // console.log($('.action_edit_'+id).filter(':checked').length);
        });

        var role_id = $(this).attr('id');
        $('#form_edit').attr('action', base_url+'role/update/'+role_id);

        $.ajax({
            url: base_url+'role/role_details/'+role_id,
            method: 'GET',
            success: function(data){
                data = JSON.parse(data);
                console.log(data);
                $('#name_edit').val(data[0]);
                if ($('#modal-edit').modal('hide')) {
                    $('.menu_id_edit').prop('checked', false);
                    $('.actions_edit').prop('checked', false);
                };
                if ($('#modal-edit').modal('show')) {
                    for (var i = 1; i < data.length; i++) {
                        $('.menus-edit').find('#menu_id_edit_'+data[i][0]['menu_id']).prop('checked', true);
                        $('.action_'+data[i][0]['id']).attr('disabled', false);
                        for (var a = 0; a < data[i][0].actions.length; a++) {
                            console.log('action = ' + data[i][0].actions[a].action);
                            console.log('id = ' + data[i][0].actions[a].menu_id);
                            $('#menu_edit_'+data[i][0].actions[a].id).prop('checked', true);
                            $('.action_check_'+data[i][0].actions[a].menu_id+'_'+data[i][0].actions[a].action+'').prop('checked', true);
                        }
                    }
                }
            }
        });
    });

    // UPDATE FORM ==========================================================================================================================
    $(document).on('submit', '#form_edit', function(event){
        event.preventDefault();
        $('#btn-edit').text('Saving ...');

        var name_edit = $('#name_edit').val();
        var urlForm   = $('#form_edit').attr('action');

        if (name_edit != '') {
            $.ajax({
                url: urlForm,
                method: 'POST',
                data: $('#form_edit').serialize(),
                success: function(data){
                    data = JSON.parse(data);
                    // console.log(data);
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
        }else {
            alert('Field edit must be required !');
        }
    });


    // Delete Role ========================================================================================================================
    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: base_url+'role/find/'+id,
            method: 'GET',
            success: function(data){
                var role = JSON.parse(data);
                $('.modal-title').text('Delete Role '+role.name+' ?');

                $(document).on('click', '#btn-delete', function(event){
                    event.preventDefault();
                    $('#btn-delete').text('Delete ...');
                    $.ajax({
                        url: base_url+'role/destroy/'+id,
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
                            dataTable.ajax.reload();
                        }
                    });
                });
                $('#btn-delete').text('Delete !');
            }
        });
    });

    $(document).on('click', '.details', function() {
        var id = $(this).attr('id');
        $.ajax({
            url: base_url+'role/role_details/'+id,
            method: 'GET',
            success: function(data){
                var data = JSON.parse(data);
                $('.role-detail-title').text(data[0]+' Details');
                if ($('#role-details').modal('hide')) {
                    $('.modal-body-details').empty();
                }
                for (var menu = 1; menu < data.length; menu++) {
                    // console.log(data[menu][0].name);
                    $('.modal-body-details').append(
                        '<p class="pt-3"><b>'+ data[menu][0].name +'</b></p>'
                    );
                    for (var a = 0; a < data[menu][0].actions.length; a++) {
                        // console.log(data[menu][0].actions[a].action);
                        $('.modal-body-details').append('<i class="text-'+data[menu][0].actions[a].action+' mr-2">'+data[menu][0].actions[a].action+'</i>');
                    }
                }
            }
        });
    });

    // =================================================
    $('.get_data_role').on('click', function () {
        var link = base_url+'role/datatables' + '?status=' + $(this).attr('data-status');
        // console.log(link);
        $('#role_table').DataTable().ajax.url(link).load();
    });

});
