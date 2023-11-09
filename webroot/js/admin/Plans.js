$(function () {
    getPlans();
    $('#add').on('click',function (e) {
        e.preventDefault();
        $('#modal-title').html('Add APP');
        $('#plans-modal').modal('show');
    });

    $('#plans-table').on('click','.view',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        window.location = base_url + '/Plandetails/view/' + id;
    });

    $('#plans-table').on('click','.edit',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal-title').html('Update APP');
        $.ajax({
            url: base_url + '/Plans/edit/' + id,
            type: "GET",
            dataType: 'json'
        })
            .done(function(data, textStatus, jqXHR){
                if(data!=''){
                    $('#title').val(data.title);
                    $('#subtitle').val(data.subtitle);
                    $('#prepared-by').val(data.prepared_by);
                    $('#position').val(data.position);
                    $('#id').val(data.id);
                    $('#plans-modal').modal('show');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
    });

    $('#plans-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;

        if(id != ''){
            url = base_url + '/Plans/edit/'+ id;
        }else{
            url = base_url + '/Plans/add';
        }
        $.ajax({
            processData: false,
            contentType:false,
            data: fd,
            url: url,
            type: "POST",
            dataType: 'json'
        })
            .done(function(data, textStatus, jqXHR){
                if(data.result=='success'){
                    getPlans();
                    msgBox('success',data.message);
                    $('#plans-modal').modal('hide');
                }else{
                    msgBox('error',data.message);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
    });

    $('#upload-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#planid').val();
        var url = base_url + '/Plans/uploadFile/'+ id;

        $.ajax({
            processData: false,
            contentType:false,
            data: fd,
            url: url,
            type: "POST",
            dataType: 'json'
        })
            .done(function(data, textStatus, jqXHR){
                if(data.result=='success'){
                    msgBox('success',data.message);
                    getPlans()
                    $('#id').val('');
                    $('#upload-modal').modal('hide');
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
                    url: base_url + '/Plans/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getPlans();
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

    $('#delete-file').on('click',function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: base_url + '/Plans/deleteFile/'+ id,
                    type: "GET",
                    dataType: 'json'
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getPlans();
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

    $('#plans-table').on('click', '.upload', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        $('#planid').val(id);
        $('#upload-modal').modal('show');
    });

    $('#plans-table').on('click', '.view-document', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        $.ajax({
            url: base_url + '/Plans/viewFile/' + id,
            type: "GET",
            dataType: 'json'
        })
            .done(function(data, textStatus, jqXHR){
                if(data!=''){
                    $('#file').attr('src',base_url + '/uploads/plans/' + data.document);
                    $('#delete-file').attr('data-id',data.id);
                    $('#view-modal').modal('show');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
    });

    $('#plans-modal').on('shown.bs.modal', function() {
        setTimeout(function() {
            $('#title').focus();
        }, 500);
    });

    $('#plans-modal').on('hidden.bs.modal', function() {
        $("#plans-form").trigger("reset");
        $("#id").val('');
    });

    $('#upload-modal').on('hidden.bs.modal', function() {
        $("#upload-form").trigger("reset");
        $("#document").val('');
    });

});

function getPlans() {
    $("#plans-table").dataTable({
        "responsive": true,
        "destroy":true,
        "order": [[ 0, "asc" ]],
        "ajax": {
            "url": base_url + '/Plans/getPlans'
        },
        "columns": [
            {data: "title"},
            {data: "subtitle"},
            {data: "prepared_by"},
            {data: "position"},
            { data: null,render: function(data,type,row){
                   var status = ['Pending','Approved','Disapproved'];
                    return status[data.status];
                }
            },
            { data: null,render: function(data,type,row){
                    if(data.document==null){
                        return '<a class="btn btn-app upload" data-id="'+data.id+'">'+
                            '<i class="fas fa-file-upload"></i>'+
                            '</a>'
                    }else{
                        return '<a class="btn btn-app view-document" data-id="'+data.id+'">'+
                            '<i class="fas fa-file-pdf"></i>'+
                            '</a>'
                    }
                }
            },
            { data: null,render: function(data,type,row){
                    var option = '<div style="text-align:center;"><a href="" class="view" data-toggle="tooltip"' +
                        'data-placement="bottom" title="View Plans" data-id="'+ data.id +'"><i ' +
                        'class="fa fas fa-eye"></i></a> |<a href="" class="edit" data-toggle="tooltip" + ' +
                        'data-placement="bottom" title="Edit Plans" data-id="'+ data.id +'"><i' +
                        ' class="fa fas fa-pen"></i></a> | <a href="" class="delete" data-toggle="tooltip" + ' +
                        'data-placement="bottom" title="Delete Plans" data-id="'+ data.id +'"><i' +
                        ' class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            }
        ]
    });
}
