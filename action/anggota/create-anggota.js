$(document).ready(function(){
  var count = 0;

  // muncul fasilitas modal
  $("#muncul-anggota-modal").click(()=>{
    $('#anggota-modal').modal('show');
    $('#NIK-anggota').val('');
    $('#nama-anggota').val('');
  });

  // close fasilitas modal
  $("#close-anggota-modal").click(()=>{
    $('#anggota-modal').modal('hide');
  });

  // close edit fasilitas modal
  $("#close-edit-anggota-modal").click(()=>{
    $('#edit-anggota-modal').modal('hide');
  });
});