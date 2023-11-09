function resetSupplierForm() {
    $('#title').html('Add Supplier');
    $('#suppliers-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#suppliers-modal').modal('show');
}
$(function () {
    getSuppliers();
    $('#add').on('click',function (e) {
        e.preventDefault();
        resetSupplierForm();
    });

    $('#suppliers-table').on('click','.edit',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#title').html('Update Supplier');
        $.ajax({
            url: 'Suppliers/edit/' + id,
            type: "GET",
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            if(data!=''){
        $('#name').val(data.name); // Update to set name
        $('#address').val(data.address);
        $('#tin_no').val(data.tin_no);
        $('#id').val(data.id);
        $('#suppliers-modal').modal('show'); // Ensure #suppliers-modal exists
    }
})
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });

    $('#suppliers-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;
        if(id!=''){
            url = 'Suppliers/edit/' + id;
        }else{
            url = 'Suppliers/add';
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
                getSuppliers();
                msgBox('success',data.message);
                $('#suppliers-modal').modal('hide');
                resetSupplierForm();
            }else{
                msgBox('error',data.message);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });
});

var selectedSupplierData; // Store the data of the selected Supplier for delete
var isDeleteConfirmationDisplayed = false; // Flag to track delete confirmation display

function getSuppliers() {
    var table = $("#suppliers-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "asc"]],
        "ajax": {
            "url": 'Suppliers/getSuppliers'
        },
        "columns": [
            { data: "name" },
            { data: "address" },
            { data: "tin_no" },
            {
                data: null,
                render: function (data, type, row) {
                    var option = '<div style="text-align:center;">' +
                    '<a href="#" class="delete" data-toggle="tooltip" ' +
                    'data-placement="bottom" title="Delete Supplier" data-id="' + data.id + '"><i ' +
                    'class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            },
        ]
    });

    $('#suppliers-table tbody').on('click', 'tr', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    if ($(e.target).is('.edit')) {
        return;
    }
    var data = table.api().row(this).data();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        resetSupplierForm();
        $('#title').html('Supplier Details');
        $('#name').val(data.name);
        $('#address').val(data.address);
        $('#tin_no').val(data.tin_no);
        $('#id').val(data.id);
        $('#suppliers-modal').modal('show');
    }
});

    $('#suppliers-table tbody').on('click', '.delete', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    e.preventDefault();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        var data = table.api().row($(this).closest('tr')).data();
        selectedSupplierData = data;
        isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
        $('#delete-modal').modal('show');
    }
});

    $('#suppliers-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: 'Suppliers/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                .done(function(data, textStatus, jqXHR){
                    if(data.result=='success'){
                        getSuppliers();
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

function msgBox(result,message){
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: result,
        title: message
    });
}

function isDelete(callback){
    Swal.fire({
        title: 'Are you sure you want to delete this record?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((confirmed) => {
        callback(confirmed && confirmed.value == true);
    });
}