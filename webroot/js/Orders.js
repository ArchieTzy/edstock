$(function () {
    getOrders();
    var maxField = 10;
    var x = 1;

    $('#customCheckbox').on('change',function () {
        if($(this.checked)){
            $('.request').prop('checked',this.checked);
        }
    });

    $('#orders-form').on('click','#search',function (e) {
        e.preventDefault();
        getRequests();
        $('#requests-modal').modal('show');
    });

    $('#edit-search').on('click',function (e) {
        e.preventDefault();
        getRequests();
        $('#edit-requests-modal').modal('show');
    });

    $('#select').on('click',function () {
        $('#requests').empty();
        var ctr = 0;
        $("input[type=checkbox]:checked").each(function(i){
            var id = $(this).val();
            if($.isNumeric(id)){
                $.ajax({
                    url: base_url + '/Orders/getRequests/' + id,
                    type: "GET",
                    dataType: 'json'
                })
                    .done(function(data, textStatus, jqXHR){
                        var request = '<tr>' +
                            '<td>'+(ctr+1)+'</td>' +
                            '<td>'+data.office.name+'</td>' +
                            '<td>'+data.purpose+'</td>' +
                            '<td>'+data.requester+'</td>' +
                            '<td>'+data.approver+'</td>' +
                            '<td>'+data.created+'</td>' +
                            '</tr>';

                        $('#requests').append(request);
                        ctr++;
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                        msgBox('error',errorThrown);
                    });
            }
        });
        $('#requests-modal').modal('hide');
    });

    $('#edit-select').on('click',function () {
        var ctr  = $('#request-count tr:last td:first').text();
        $("input[type=checkbox]:checked").each(function(i){
            var id = $(this).val();
            if($.isNumeric(id)){
                $.ajax({
                    url: base_url + '/Orders/getRequests/' + id,
                    type: "GET",
                    dataType: 'json'
                })
                    .done(function(data, textStatus, jqXHR){
                        if(ctr==''){
                            ctr=0;
                        }
                        var request = '<tr>' +
                            '<td>'+(ctr+1)+'</td>' +
                            '<td>'+data.office.name+'</td>' +
                            '<td>'+data.purpose+'</td>' +
                            '<td>'+data.requester+'</td>' +
                            '<td>'+data.approver+'</td>' +
                            '<td>'+data.created+'</td>' +
                            '</tr>';

                        $('#requests').append(request);
                        ctr++;
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                        msgBox('error',errorThrown);
                    });
            }
        });
        $('#edit-requests-modal').modal('hide');

    });

    $('#orders-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;

        if(id != undefined){
            url = base_url + '/Orders/edit/'+ id;
        }else{
            url = base_url + '/Orders/add';
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
                        window.location = base_url + '/Orders';
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
        var url = base_url + '/Orders/uploadFile/'+ id;

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
                    getOrders()
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

    $('#orders-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: base_url + '/Orders/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getOrders();
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
                    url: base_url + '/Orders/deleteFile/'+ id,
                    type: "GET",
                    dataType: 'json'
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getOrders();
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

    $('#orders-table').on('click', '.upload', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        $('#id').val(id);
        $('#upload-modal').modal('show');
    });

    $('#orders-table').on('click', '.view', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        $.ajax({
            url: base_url + '/Orders/viewFile/' + id,
            type: "GET",
            dataType: 'json'
        })
            .done(function(data, textStatus, jqXHR){
                if(data!=''){
                    $('#file').attr('src',base_url + '/uploads/orders/' + data.document);
                    $('#delete-file').attr('data-id',data.id);
                    $('#view-modal').modal('show');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
    });

    $('#orders-table').on('click', '.print', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        window.location = base_url + '/Orders/printOrder/'+ id;
    });

    $('#items').on('click','.minus',function(e){
        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
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
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1).change();
            if(parseInt(input.val()) > input.attr('min')) {
                $('.minus').attr('disabled', false);
            }
        } else {
            input.val(0);
        }
    });

    $('.edit-minus').on('click',function(e){
        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var idname=fieldName.substring(0,fieldName.length - 5)+'[id]';
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == 0) {
                var id = $(this).closest("tr").find("input[name='"+idname+"']");
                $.ajax({
                    url: base_url + '/orderdetails/delete/'+ id.val(),
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            $(this).closest("tr").remove();
                            window.location = base_url + '/Orders/edit/'+ $('#id').val();
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
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            input.val(currentVal + 1).change();
            if(parseInt(input.val()) > input.attr('min')) {
                $('.minus').attr('disabled', false);
            }
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

    $('#requests-modal').on('shown.bs.modal', function() {
        $("#customCheckbox").prop('checked',false);
    });


    $('#requests-modal').on('hidden.bs.modal', function() {
        $("#customCheckbox").prop('checked',false);
    });

    $('#upload-modal').on('hidden.bs.modal', function() {
        $("#upload-form").trigger("reset");
        $("#document").val('');
    });

});

function getOrders() {
    $("#orders-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy":true,
        "order": [[ 0, "asc" ]],
        "ajax": {
            "url": base_url + '/Orders/getOrders'
        },
        "columns": [
            { data: null,render: function(data,type,row){
                    return data.office.name;
                }
            },
            { data: null,render: function(data,type,row){
                    return data.supplier.name;
                }
            },
            { data: null,render: function(data,type,row){
                    return data.office.name;
                }
            },
            { data : "approver"},
            { data: null,render: function(data,type,row){
                    return moment(data.created).format('MM/DD/YYYY');
                }
            },
            { data: null,render: function(data,type,row){
                    console.log(data);
                    var option = ['Pending','Approved','Disapproved'];
                    return option[data.status];
                }
            },
            { data: null,render: function(data,type,row){
                    var option = '<div style="text-align:center;"><a href="orders/edit/'+data.id+'" class="edit" data-toggle="tooltip" + ' +
                        'data-placement="bottom" title="Edit Order" data-id="'+ data.id +'"><i' +
                        ' class="fa fas fa-pen"></i></a> | <a href="" class="delete" data-toggle="tooltip" ' +
                        'data-placement="bottom" title="Delete Order" data-id="'+ data.id +'"><i' +
                        ' class="fa fa fa-trash"></i></a> | <a href="" class="print" data-toggle="tooltip" ' +
                        'data-placement="bottom" title="Print Order" data-id="'+ data.id +'"><i ' +
                        'class="fa fa fa-print"></i></a></div>';
                    return option;
                }
            }
        ]
    });
}

function getRequests() {
    $("#requests-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "bPaginate": false,
        "destroy":true,
        "targets": 'no-sort',
        "bSort": false,
        "order": [],
        "ajax": {
            "url": base_url + '/Orders/getRequests'
        },
        "columns": [
            { data: null,render: function(data,type,row){
                    return data.office.name
                }
            },
            {data: "requester"},
            {data: "approver"},
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
