<?php
require_once("./authAdmin.php");
require_once('./class/class.Mail.php');
require_once("./class/class.Kos.php");

//anggota info
$idKos = $_POST['id-kos'];
$status = $_POST['status'];
$emailPemilik = $_POST['email-kos'];

//data empty
if (empty($idKos) | empty($status) | empty($emailPemilik)) {
    echo "<script>
    alert('Gagal Memperbaharui status, Pastikan semua data benar')
    window.location = 'dashboard.php?p=edit-status-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    $kos = new Kos();
    $kos->idKos = $idKos;
    $kos->status = $status;
    $hasil = $kos->editStatusKos();

    if ($hasil == "berhasil mengedit") {

        $kos->getKosanData();

        $user2 = new User2();
        $user2->email = $emailPemilik;
        $hasil = $user2->cekEmailData();

        //ini buat ngirim email
        //jadi aktif
        if ($status == 1) {
            $mail = new Mail();
            $mail->namaUser = $user2->fullname;
            $mail->mailUser = $emailPemilik;
            $mail->subject = "Status Kos";
            $mail->message = "Status Kos Kamu";
            $mail->namaKos = $kos->namaKos;
            $mail->status = "Diterima";
            $mail->statusKosTemplate();
            $mail->sendMailAction();
        }

        //ditolak
        else if ($status == 2) {
            $mail = new Mail();
            $mail->namaUser = $user2->fullname;
            $mail->mailUser = $emailPemilik;
            $mail->subject = "Status Kos";
            $mail->message = "Status Kos Kamu";
            $mail->namaKos = $kos->namaKos;
            $mail->status = "Ditolak";
            $mail->statusKosTemplate();
            $mail->sendMailAction();
        }

        echo "<script>
        alert('Berhasil Memperbaharui status')
        window.location = 'dashboard.php?p=admin';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Memperbaharui status, Pastikan semua data benar')
        window.location = 'dashboard.php?p=edit-status-kos&id-kos=$idKos';
        </script>";
    }
}
