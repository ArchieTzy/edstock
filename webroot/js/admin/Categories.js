function resetCategoryForm() {
    $('#title').html('Add Type');
    $('#categories-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#categories-modal').modal('show');
}
$(function () {
    getCategories();
    $('#add').on('click',function (e) {
        e.preventDefault();
        resetCategoryForm();
    });

    $('#categories-table').on('click','.add',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#title').html('Add Category');
        $.ajax({
            url: 'Categories/add/',
            type: "GET",
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            if(data!=''){
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#id').val(data.id);
                $('#categories-modal').modal('show');
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });

    $('#categories-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;
        if(id!=''){
            url = 'Categories/edit/' + id;
        }else{
            url = 'Categories/add';
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
                getCategories();
                msgBox('success',data.message);
                $('#categories-modal').modal('hide');
                resetCategoryForm();
            }else{
                msgBox('error',data.message);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });
});

var selectedCategoryData; // Store the data of the selected item for delete
var isDeleteConfirmationDisplayed = false; // Flag to track delete confirmation display

function getCategories() {
    var table = $("#categories-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "asc"]],
        "ajax": {
            "url": 'Categories/getCategories'
        },
        "columns": [
            { data: "name" },
            {
                data: null,
                render: function (data, type, row) {
                    var option = '<div style="text-align:center;">' +
                    '<a href="#" class="delete" data-toggle="tooltip" ' +
                    'data-placement="bottom" title="Delete Category" data-id="' + data.id + '"><i ' +
                    'class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            },
            ]
    });

    $('#categories-table tbody').on('click', 'tr', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    if ($(e.target).is('.edit')) {
        return;
    }
    var data = table.api().row(this).data();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        resetCategoryForm();
        $('#title').html('Category Details');
        $('#name').val(data.name).prop('disabled', true);
        $('#description').val(data.description).prop('disabled', true);
        $('#id').val(data.id);
        $('#categories-modal').modal('show');
    }
});

    $('#categories-table tbody').on('click', '.delete', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    e.preventDefault();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        var data = table.api().row($(this).closest('tr')).data();
        selectedCategoryData = data;
        isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
        $('#delete-modal').modal('show');
    }
});

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

};