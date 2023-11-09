const base_url = url_path('');
const js_url = base_url + '/webroot/js/';
$(function () {
    var invalidChars = ["-", "e", "+", "E"];

    $("input[type='number']").on("keydown", function(e){
        if(invalidChars.includes(e.key)){
            e.preventDefault();
        }
    });
    bsCustomFileInput.init();
});

function loadjs(filename){
    var fileref=document.createElement('script');
    fileref.setAttribute("type","text/javascript");
    fileref.setAttribute("src", filename);
    if (typeof fileref!="undefined"){
        document.getElementsByTagName("head")[0].appendChild(fileref);
    }
}

function url_path(path){
    var url = window.location.href;
    var arr = url.split("/");
    var result = arr[0]+"//"+arr[2];
    return result + '/edstock' + path;
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
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((confirmed) => {
        callback(confirmed && confirmed.value == true);
    });
}

function isRestore(callback){
    Swal.fire({
        title: 'Are you sure you want to restore this record?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!'
    }).then((confirmed) => {
        callback(confirmed && confirmed.value == true);
    });
}



