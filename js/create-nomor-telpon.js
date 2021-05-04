$(document).ready(function(){
    // muncul nomor telpon modal
    $("#muncul-nomor-telpon-modal").click(()=>{
        $('#nomor-telpon-modal').modal('show');
        $('#nomor-telpon-kos').val('');
    });

    // close nomor telpon modal
    $("#close-nomor-telpon-modal").click(()=>{
        $('#nomor-telpon-modal').modal('hide');
    });
})