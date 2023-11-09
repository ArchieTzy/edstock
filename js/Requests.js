$(function () {
    getRequests();

    $('#customCheckbox').on('change',function () {
        if($(this.checked)){
            $('.item').prop('checked',this.checked);
        }
    });

    $('#requests-form').on('click','#search',function (e) {
        e.preventDefault();
        getItems();
        $('#items-modal').modal('show');
    });

    $('#edit-search').on('click',function (e) {
        e.preventDefault();
        getItems();
        $('#edit-items-modal').modal('show');
    });

    $('.cost').on('keyup', function () {
        var qty = $(this).closest("tr").find("input.input-number");
        var total = $(this).closest("tr").find("input.total");
        total.val(qty.val() * $(this).val());
    });
    
    $('#items').on('keyup','.cost',function () {
        var qty = $(this).closest("tr").find("input.input-number");
        var total = $(this).closest("tr").find("input.total");
        total.val(qty.val() * $(this).val());
    })

    $('#select').on('click',function () {
        $('#items').empty();
        var ctr = 0;
        $("input[type=checkbox]:checked").each(function(i){
            var id = $(this).val();
            if($.isNumeric(id)) {
                $.ajax({
                    url: base_url + '/Requests/getItem/' + id,
                    type: "GET",
                    dataType: 'json'
                })
                    .done(function (data, textStatus, jqXHR) {
                        var item = '<tr>' +
                            '<td>' + (ctr + 1) + '</td>' +
                            '<td>' + data.unit.name + '</td>' +
                            '<td>' + data.description + '</td>' +
                            '<td>' +
                            '<div class="input-group">' +
                            '<span class="input-group-prepend">' +
                            '<button type="button" class="btn btn-outline-secondary minus" data-field="requestdetails[' + ctr + '][qty]">' +
                            '<span class="fa fa-minus"></span>' +
                            '</button>' +
                            '</span>' +
                            '<input type="number" name="requestdetails[' + ctr + '][qty]" class="form-control input-number" value="1" min="0">' +
                            '<input type="hidden" name="requestdetails[' + ctr + '][item_id]" value="' + data.id + '" >' +
                            '<span class="input-group-append">' +
                            '<button type="button" class="btn btn-outline-secondary plus"  data-field="requestdetails[' + ctr + '][qty]">' +
                            '<span class="fa fa-plus"></span>' +
                            '</button>' +
                            '</span>' +
                            '</div>' +
                            '</td>' +
                            '<td><input type="number" name="requestdetails[' + ctr + '][cost]" class="form-control cost" value="' + data.cost + '" readonly="readonly"></td>' +
                            '<td><input type="number" name="requestdetails[' + ctr + '][total]" class="form-control total" value="' + data.cost + '" readonly="readonly"></td>' +
                            '</tr>';

                        $('#items').append(item);
                        ctr++;
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        msgBox('error', errorThrown);
                    });
            }
        });
        $('#items-modal').modal('hide');

    });
    $('#edit-select').on('click',function () {
        var ctr  = $('#item-count tr:last td:first').text();
        $("input[type=checkbox]:checked").each(function(i){
            var id = $(this).val();
            if($.isNumeric(id)) {
                $.ajax({
                    url: base_url + '/Requests/getItem/' + id,
                    type: "GET",
                    dataType: 'json'
                })
                    .done(function(data, textStatus, jqXHR){
                        if(ctr==''){
                            ctr=0;
                        }
                        var item = '<tr>' +
                            '<td>'+(parseInt(ctr)+1)+'</td>' +
                            '<td>'+data.unit.name+'</td>' +
                            '<td>'+data.description+'</td>' +
                            '<td>' +
                            '<div class="input-group">' +
                            '<span class="input-group-prepend">' +
                            '<button type="button" class="btn btn-outline-secondary minus" data-field="requestdetails['+ctr+'][qty]">' +
                            '<span class="fa fa-minus"></span>' +
                            '</button>' +
                            '</span>' +
                            '<input type="text" name="requestdetails['+ctr+'][qty]" class="form-control input-number" value="1" min="0">' +
                            '<input type="hidden" name="requestdetails['+ctr+'][item_id]" value="'+data.id+'" >' +
                            '<span class="input-group-append">' +
                            '<button type="button" class="btn btn-outline-secondary plus"  data-field="requestdetails['+ctr+'][qty]">' +
                            '<span class="fa fa-plus"></span>' +
                            '</button>' +
                            '</span>' +
                            '</div>' +
                            '</td>' +
                            '<td><input type="number" name="requestdetails['+ctr+'][cost]" class="form-control cost" value="'+data.cost+'" readonly="readonly"></td>' +
                            '<td><input type="number" name="requestdetails['+ctr+'][total]" class="form-control total" value="'+data.cost+'" readonly="readonly"></td>' +
                            '</tr>';

                        $('#items').append(item);
                        ctr++;
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                        msgBox('error',errorThrown);
                    });
            }
        });
        $('#edit-items-modal').modal('hide');

    });


    $('#requests-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;

        if(id != undefined){
            url = base_url + '/Requests/edit/'+ id;
        }else{
            url = base_url + '/Requests/add';
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
                    msgBox('success',data.message);
                    setTimeout(function() {
                        window.location = base_url + '/Requests';
                    }, 2000);
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
        var id = $('#id').val();
        var url = base_url + '/Requests/uploadFile/'+ id;

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
                    getRequests()
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

    $('#requests-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: base_url + '/Requests/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getRequests();
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
                    url: base_url + '/Requests/deleteFile/'+ id,
                    type: "GET",
                    dataType: 'json'
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getRequests();
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

    $('#requests-table').on('click', '.upload', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        $('#id').val(id);
        $('#upload-modal').modal('show');
    });

    $('#requests-table').on('click', '.print', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        window.location = base_url + '/Requests/printRequest/'+ id;
    });

    $('#items').on('click','.minus',function(e){
        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var costname = fieldName.substring(0,fieldName.length - 5)+'[cost]';
        var cost = $(this).closest("tr").find("input[name='"+costname+"']");
        var totalname = fieldName.substring(0,fieldName.length - 5)+'[total]';
        var total = $(this).closest("tr").find("input[name='"+totalname+"']");
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
                total.val(input.val() * cost.val());
            }
            if(parseInt(input.val()) == 0) {
                $(this).closest("tr").remove();
            }
        } else {
            input.val(0);
        }
    });

    $('#items').on('click','.plus',function(e){
        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var costname = fieldName.substring(0,fieldName.length - 5)+'[cost]';
        var cost = $(this).closest("tr").find("input[name='"+costname+"']");
        var totalname = fieldName.substring(0,fieldName.length - 5)+'[total]';
        var total = $(this).closest("tr").find("input[name='"+totalname+"']");
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1).change();
            total.val(input.val() * cost.val());
        } else {
            input.val(0);
        }
    });

    $('.edit-minus').on('click',function(e){
        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var idname=fieldName.substring(0,fieldName.length - 5)+'[id]';
        var costname = fieldName.substring(0,fieldName.length - 5)+'[cost]';
        var cost = $(this).closest("tr").find("input[name='"+costname+"']");
        var totalname = fieldName.substring(0,fieldName.length - 5)+'[total]';
        var total = $(this).closest("tr").find("input[name='"+totalname+"']");
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
                total.val(input.val() * cost.val());
            }
            if(parseInt(input.val()) == 0) {
                var id = $(this).closest("tr").find("input[name='"+idname+"']");
                $.ajax({
                    url: base_url + '/Requestdetails/delete/'+ id.val(),
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            $(this).closest("tr").remove();
                            window.location = base_url + '/Requests/edit/'+ $('#id').val();
                        }else{
                            msgBox('error',data.message);
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                        msgBox('error',errorThrown);
                    });
            }
        } else {
            input.val(0);
        }
    });

    $('.edit-plus').on('click',function(e){
        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var costname = fieldName.substring(0,fieldName.length - 5)+'[cost]';
        var cost = $(this).closest("tr").find("input[name='"+costname+"']");
        var totalname = fieldName.substring(0,fieldName.length - 5)+'[total]';
        var total = $(this).closest("tr").find("input[name='"+totalname+"']");
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1).change();
            total.val(input.val() * cost.val());
        } else {
            input.val(0);
        }
    });

    $('#qoutations-modal').on('shown.bs.modal', function() {
        setTimeout(function() {
            $('#name').focus();
        }, 500);
    });

    $('#qoutations-modal').on('hidden.bs.modal', function() {
        $("#qoutations-form").trigger("reset");
        $("#id").val('');
    });

    $('#items-modal').on('shown.bs.modal', function() {
        $("#customCheckbox").prop('checked',false);
    });


    $('#items-modal').on('hidden.bs.modal', function() {
        $("#customCheckbox").prop('checked',false);
    });

    $('#upload-modal').on('hidden.bs.modal', function() {
        $("#upload-form").trigger("reset");
        $("#document").val('');
    });

});

function getRequests() {
    $("#requests-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy":true,
        "order": [[ 0, "asc" ]],
        "ajax": {
            "url": base_url + '/Requests/getRequests'
        },
        "columns": [
            { data: null,render: function(data,type,row){
                    return data.office.name;
                }
            },
            { data : "purpose"},
            { data : "requester"},
            { data : "approver"},
            {
                data: "created",
                render: function (data, type, row) {
                        // Format the date and time
                    var date = new Date(data);
                    var day = date.getDate().toString().padStart(2, '0');
                        var month = (date.getMonth() + 1).toString().padStart(2, '0'); // Month is zero-based
                        var year = date.getFullYear();

                        var formattedDate = month + '-' + day + '-' + year;
                        return formattedDate;
                    }
            },
            { data: null,render: function(data,type,row){
                    var option = ['Pending','Approved','Disapproved'];
                    return option[data.status];
                }
            },
            { data: null,render: function(data,type,row){
                    var option = '<div style="text-align:center;"><a href="requests/edit/'+data.id+'" class="edit" data-toggle="tooltip" + ' +
                        'data-placement="bottom" title="Edit request" data-id="'+ data.id +'"><i' +
                        ' class="fa fas fa-pen"></i></a> | <a href="" class="delete" data-toggle="tooltip" ' +
                        'data-placement="bottom" title="Delete request" data-id="'+ data.id +'"><i' +
                        ' class="fa fa fa-trash"></i></a> | <a href="" class="print" data-toggle="tooltip" ' +
                        'data-placement="bottom" title="Print request" data-id="'+ data.id +'"><i ' +
                        'class="fa fa fa-print"></i></a></div>';
                    return option;
                }
            }
        ]
    });
}

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
                        '<input class="custom-control-input custom-control-input-success item" type="checkbox" id="customCheckbox'+ data.id+'" value="'+data.id+'">' +
                        '<label for="customCheckbox'+ data.id+'" class="custom-control-label"></label>' +
                        '</div></div>';
                    return option;
                }
            }
        ]
    });
}
