<?php
session_start();
session_destroy();

echo "<script>
alert('Sampai Jumpa Kembali');
window.location = '/kuliah/project/index.php'
</script>";
