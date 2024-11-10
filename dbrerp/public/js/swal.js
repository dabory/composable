var swalInit = swal.mixin({
        buttonsStyling: false,
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-light'
}),

alert = (msg, type, url, time = 500) => {
    swalInit.fire({
        title: 'Information',
        text: msg,
        type: ( type != undefined && type != '' ) ? type : 'info',
        timer: time
    }).then(function(){
        switch( url ){
            case 'reload' : location.reload(); break;
            default :
                if( url != undefined && url != '' ) window.location.replace(url);
        }
    });
}
