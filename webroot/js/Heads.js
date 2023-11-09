function resetHeadForm() {
    $('#title').html('Add Head');
    $('#heads-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#heads-modal').modal('show');
}

$(function () {
    getHeads();
    $('#add').on('click',function (e) {
        e.preventDefault();
        resetHeadForm();
    });

    $('#heads-table').on('click','.edit',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#title').html('Head Details');
        $.ajax({
            url: 'Heads/edit/' + id,
            type: "GET",
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            if(data!=''){
        $('#name').val(data.name);
        $('#position').val(data.position);
        $('#id').val(data.id);
        $('#heads-modal').modal('show');
    }
})
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });

    $('#heads-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;
        if(id!=''){
            url = 'Heads/edit/' + id;
        }else{
            url = 'Heads/add';
        }
        $.ajax({
            processData: false,
            contentType:false,
            data: fd,
            url: url,
            type: "POST",
            dataType: 'json'
        })
        .done(function(data){
            if(data.result=='success'){
                getHeads();
                msgBox('success',data.message);
                $('#heads-modal').modal('hide');
                resetHeadForm();
            }else{
                msgBox('error',data.message);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });
});

var selectedHeadData;
var isDeleteConfirmationDisplayed = false;

function getHeads() {
    var table = $("#heads-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "asc"]],
        "ajax": {
            "url": 'Heads/getHeads'
        },
        "columns": [
            { data: "name" },
            { data: "position" },
            {
                data: null,
                render: function (data, type, row) {
                    var option = '<div style="text-align:center;">' +
                    '<a href="#" class="delete" data-toggle="tooltip" ' +
                    'data-placement="bottom" title="Delete Head" data-id="' + data.id + '"><i ' +
                    'class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            },
            ]
    });

    $('#heads-table tbody').on('click', 'tr', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    if ($(e.target).is('.edit')) {
        return;
    }
    var data = table.api().row(this).data();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        resetHeadForm();
        $('#title').html('Head Details');
        $('#name').val(data.name);
        $('#position').val(data.position);
        $('#id').val(data.id);
        $('#heads-modal').modal('show');
    }
});

    $('#heads-table tbody').on('click', '.delete', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    e.preventDefault();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        var data = table.api().row($(this).closest('tr')).data();
        selectedHeadData = data;
        isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
        $('#delete-modal').modal('show');
    }
});

    $('#heads-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: 'Heads/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                .done(function(data, textStatus, jqXHR){
                    if(data.result=='success'){
                        getHeads();
                        msgBox('success',data.message);
                    }else{
                        msgBox('error',data.message);
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown){
                    msgBox('error',errorThrown);
                })
                .always(function() {
                    isDeleteConfirmationDisplayed = false; // Reset delete confirmation flag
                });
            } else {
                isDeleteConfirmationDisplayed = false; // Reset delete confirmation flag
            }
        });
    });
}