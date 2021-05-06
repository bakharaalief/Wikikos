$(document).ready(function(){
    // muncul konfirmasi berhasil modal
    $("#muncul-registration-modal").click(()=>{
        $('#registration-modal').modal('show');
        $('#registration-kos').val('');
    });

    // close konfirmasi register modal
    $("#close-registration-modal").click(()=>{
        $('#regitration-modal').modal('hide');
    });
})