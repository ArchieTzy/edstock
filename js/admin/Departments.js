function resetDepartmentForm() {
    $('#title').html('Add Department');
    $('#departments-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#departments-modal').modal('show');
}
    $(function () {
        getDepartments();
        $('#add').on('click',function (e) {
            e.preventDefault();
            resetDepartmentForm();
        });

        $('#departments-table').on('click','.add',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#title').html('Add Department');
            $.ajax({
                url: 'Departments/add/',
                type: "GET",
                dataType: 'json'
            })
                .done(function(data, textStatus, jqXHR){
                    if(data!=''){
                        $('#name').val(data.name);
                        $('#description').val(data.description);
                        $('#id').val(data.id);
                        $('#departments-modal').modal('show');
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown){
                    msgBox('error',errorThrown);
                });
        });

        $('#departments-form').on('submit',function (e) {
            e.preventDefault();
            var fd = new FormData(this);
            var id = $('#id').val();
            var url;
            if(id!=''){
                url = 'Departments/edit/' + id;
            }else{
                url = 'Departments/add';
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
                        getDepartments();
                        msgBox('success',data.message);
                        $('#departments-modal').modal('hide');
                        resetCategoryForm();
                    }else{
                        msgBox('error',data.message);
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown){
                    msgBox('error',errorThrown);
                });
        });

        $('#departments-table').on('click', '.delete', function (e) {
            e.preventDefault();
            var id=$(this).data('id');
            isDelete(function (confirmed) {
                if (confirmed) {
                    $.ajax({
                        url: 'Departments/delete/'+ id,
                        type: "DELETE",
                        dataType: 'json',
                        headers : {
                            'X-CSRF-Token': $('[name="_csrfToken"]').val()
                        },
                    })
                        .done(function(data, textStatus, jqXHR){
                            if(data.result=='success'){
                                getDepartments();
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
    });

    function getDepartments() {
        $("#departments-table").dataTable({
            "responsive": true,
            "autoWidth": false,
            "destroy":true,
            "order": [[ 0, "asc" ]],
            "ajax": {
                "url": 'Departments/getDepartments'
            },
            "columns": [
                { data: "name" },
                { data: null,render: function(data,type,row){
                        var option = '<div style="text-align:center;"><a href="" class="delete" data-toggle="tooltip" + ' +
                            'data-placement="bottom" title="Delete Department" data-id="'+ data.id +'"><i' +
                            ' class="fa fa fa-trash"></i></a></div>';
                        return option;
                    }
                },
            ]
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