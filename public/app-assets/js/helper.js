$('.required').append(`<span class="text-danger">*</span>`)
$('.optional').append(`<span class="text-dark"> (opsional)</span>`)

function str_to_int(number){
    var number = number.replaceAll('Rp.','').replaceAll('.','')
    return parseInt(number)
}

function dataTableAjax(class_table, url, params, columns,order = [[]]) {
    datatable_table = $(class_table);
    if (datatable_table.length) {
        datatable = datatable_table.DataTable({
            searchDelay: 300,
            processing: true,
            serverSide: true,
            destroy: true,
            order: order,
            ajax: {
                url:url,
                data:params
            },
            columns: columns,
            pageLength: 10,
            lengthMenu: [[5,10, 50, 100, -1], [5, 10, 50, 100, "Semua"]],
            responsive: true,
            dom: '<"d-flex justify-content-between align-items-center mx-0 row px-0"<"col-12 col-sm-6 col-md-6 px-0"l><"col-12 col-sm-6 col-md-6 px-0"f>>t<"d-flex justify-content-between mx-0 row px-0"<"col-sm-12 col-md-6 px-0"i><"col-sm-12 col-md-6 px-0"p>>',
            language: {
                url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
            },
        });
    }
}

function pad(s) {
    return (s < 10) ? '0' + s : s;
}

function dateFormat(date) {
    var d = new Date(date);
    if(d.getFullYear() == "1970")
        return "";
    var tmonths = ["", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"];
    result = pad(d.getDate()) + " " + tmonths[d.getMonth()+1] + " " + d.getFullYear();
    return result;
}

function toast(type,message){
    $.notify({message: message,},
    {
        type:type,
        allow_dismiss:false,
        newest_on_top:true ,
        mouse_over:true,
        showProgressbar:false,
        spacing:10,
        timer:2000,
        placement:{from:'top',align:'center'},
        offset:{x:30,y:30},
        delay:1000 ,
        z_index:10000,
        animate:{enter:'animated flash',exit:'animated swing'}
    });
}

    function alertNotif(title,url){
        color_btn_confirm = '#dc3545';
        color_btn_cancel = '#afafaf';
        btn_confirm = 'Lanjut';
        btn_cancel = 'Batal';
        var text = '';
        event.preventDefault();
        Swal.fire({
            title: title,
            text:  text,
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: btn_confirm,
            confirmButtonColor: color_btn_confirm,
            cancelButtonText: btn_cancel,
            cancelButtonColor: color_btn_cancel,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }

function numberFormat(number){
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}
