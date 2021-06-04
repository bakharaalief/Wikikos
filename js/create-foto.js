$(document).ready(function(){
    $('#gambar-kos').change(()=>{

        var gambar_file = $('#gambar-kos')[0].files[0]
    
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#image-crop').attr('src', e.target.result);
        }
        reader.readAsDataURL(gambar_file)
    
        $('#image-crop').css("visibility", "visible")
      })
});