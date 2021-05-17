$(document).ready(function(){
  var count = 0;

  //image crop kebuka
  $('#image-crop').css("visibility", "visible")

  // muncul fasilitas modal
  $("#muncul-fasilitas-modal").click(()=>{
    $('#fasilitas-modal').modal('show');
    $('#fasilitas-kos').val('');
  });

  // close fasilitas modal
  $("#close-fasilitas-modal").click(()=>{
    $('#fasilitas-modal').modal('hide');
  });

  //tambah fasilitas 
  $("#tambah-fasilitas").click(()=>{
    var error_fasilitas_kos = '';
    var fasilitas_nama = '';

    //when fasilitas nama is empty
    if($('#fasilitas-kos').val() == ''){
      error_fasilitas_kos = 'Nama Fasilitas Dibutuhkan';
      $('#error_fasilitas_kos').text(error_fasilitas_kos);
      $('#fasilitas-kos').css('border-color', '#cc0000');
      fasilitas_nama = '';
    }

    // not empty
    else{
      jumlah_fasilitas = $('#jumlah-fasilitas').val()
      jumlah_fasilitas += 1;

      fasilitas_nama = $('#fasilitas-kos').val()

      var nPembatas = fasilitas_nama.search("-");

      count += $('#fasilitas-kos').val();
      output = '<tr id="row_' + count + '">';
      output += '<td>' + fasilitas_nama.substring(0, nPembatas) + ' <input type="hidden" name="hidden_fasilitas_nama[]" id="fasilitas_nama' + count + '" class="fasilitas_nama" value="' + fasilitas_nama.substring(nPembatas+1) + '" /></td>';
      output += '<td><a type="button" name="remove_fasilitas_nama" class="btn btn-danger btn-xs remove_fasilitas_nama" id="' + count + '">Hapus</a></td>';
      output += '</tr>';

      $('#fasilitas-data').append(output);
      $('#fasilitas-modal').modal('hide');
    }    
  });

  //remove fasilitas
  $(document).on('click', '.remove_fasilitas_nama', function() {
    var row_id = $(this).attr("id");
    if (confirm("Are you sure you want to remove this row data?")) {
        $('#row_' + row_id + '').remove();
    } else {
        return false;
    }
  });

  //tambah gambar
  $('#gambar-kos').change(()=>{

    var gambar_file = $('#gambar-kos')[0].files[0]

    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image-crop').attr('src', e.target.result);
    }
    reader.readAsDataURL(gambar_file)
  })
});