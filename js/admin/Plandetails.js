$(function () {
    $('#add').on('click',function (e) {
        e.preventDefault();
        getItems();
        $('#items-modal').modal('show');
    });

    $('#items-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var plan_id = $('#plan-id').val();
        $.ajax({
            processData: false,
            contentType:false,
            data: fd,
            url: base_url + '/Plandetails/add',
            type: "POST",
            dataType: 'json'
        })
            .done(function(data, textStatus, jqXHR){
                if(data.result=='success'){
                    $('#items-modal').modal('hide');
                    msgBox('success',data.message);
                    setTimeout(function() {
                        location.reload(true);
                    }, 2000);
                }else{
                    msgBox('error',data.message);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
    });

    $('.edit').on('click',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var item_id = $(this).data('item_id');
        $('#id').val(id);
        var cost = $(this).closest('tr').find('td:eq(4)').text();
        if(id==''){
            $.ajax({
                url: base_url + '/Plandetails/getItem/' + item_id,
                type: "GET",
                dataType: 'json'
            })
                .done(function(data, textStatus, jqXHR){
                    if(data!=''){
                        $('#item').val(data.description);
                        $('#item-id').val(data.id);
                        $('#plans-modal').modal('show');
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown){
                    msgBox('error',errorThrown);
                });
        }else{
            $.ajax({
                url: base_url + '/Plandetails/edit/' + id,
                type: "GET",
                dataType: 'json'
            })
                .done(function(data, textStatus, jqXHR){
                    if(data!=''){
                        $('#item').val(data.item.description);
                        $('#item-id').val(data.item.id);
                        $('#code').val(data.code);
                        $('#jan').val(data.jan);
                        $('#feb').val(data.feb);
                        $('#mar').val(data.mar);
                        $('#apr').val(data.apr);
                        $('#may').val(data.may);
                        $('#jun').val(data.jun);
                        $('#jul').val(data.jul);
                        $('#aug').val(data.aug);
                        $('#sep').val(data.sep);
                        $('#oct').val(data.oct);
                        $('#nov').val(data.nov);
                        $('#decm').val(data.decm);
                        $('#plans-modal').modal('show');
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown){
                    msgBox('error',errorThrown);
                });
        }

        $('#plans-modal').modal('show');
    });

    $('#plans-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var plan_id = $('#plan-id').val();
        $.ajax({
            processData: false,
            contentType:false,
            data: fd,
            url: base_url + '/Plandetails/add_update',
            type: "POST",
            dataType: 'json'
        })
            .done(function(data, textStatus, jqXHR){
                if(data.result=='success'){
                    $('#plans-modal').modal('hide');
                    window.location = base_url + '/Plandetails/view/' + plan_id;
                }else{
                    msgBox('error',data.message);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
    });

    $('#plans-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: base_url + '/Plandetails/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            msgBox('success',data.message);
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        }else{
                            msgBox('error',data.message);
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                        msgBox('error',errorThrown);
                    });

            }
        });
    });

    $('#units-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: base_url + '/Units/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getUnits();
                            msgBox('success',data.message);
                        }else{
                            msgBox('error',data.message);
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                        msgBox('error',errorThrown);
                    });

            }
        });
    });
    $('').modal('hide');

    $('#plans-modal').on('shown.bs.modal', function() {
        setTimeout(function() {
            $('#code').focus();
        }, 500);
    });

    $('#plans-modal').on('hidden.bs.modal', function() {
        $("#plans-form").trigger("reset");
        $("#id").val('');
    });

    $('#items-modal').on('hidden.bs.modal', function() {
        item_id = '';
    });

});

function getItems() {
    $("#items-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "bPaginate": false,
        "destroy":true,
        "targets": 'no-sort',
        "bSort": false,
        "order": [],
        "ajax": {
            "url": base_url + '/Requests/getItems'
        },
        "columns": [
            { data: null,render: function(data,type,row){
                    return data.category.name
                }
            },
            {data: "description"},
            { data: null,render: function(data,type,row){
                    return data.unit.name
                }
            },
            {data: "cost"},
            { data: null,render: function(data,type,row){
                    var option = '<div style="text-align:center;"><div class="custom-control custom-checkbox">' +
                        '<input name="item_id[]" class="custom-control-input custom-control-input-success item" type="checkbox" id="customCheckbox'+ data.id+'" value="'+data.id+'">' +
                        '<label for="customCheckbox'+ data.id+'" class="custom-control-label"></label>' +
                        '</div></div>';
                    return option;
                }
            }
        ]
    });
}
