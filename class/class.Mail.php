
<?php
// awal class email
require_once dirname(__FILE__) . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

class Mail extends Connection2
{
    private $namaUser;
    private $mailUser;
    private $linkKirim;
    private $subject;
    private $message;
    private $template;

    //untuk kos
    private $namaKos;
    private $status;

    //auto get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }

    //auto set
    public function __set($atribut, $value)
    {
        if (property_exists($this, $atribut)) {
            $this->$atribut = $value;
        }
    }

    public static function SendMail($to, $name, $subject, $message)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        //ganti dengan email dan password yang akan di gunakan sebagai email pengirim
        $mail->Username = 'zhirosec@gmail.com';
        $mail->Password = 'faizthunder13+';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //ganti dengan email yg akan di gunakan sebagai email pengirim
        $mail->setFrom('zhirosec@gmail.com', 'Admin Company');
        $mail->addAddress($to, $name);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->$mail->isHTML(true);

        if (!$mail->send()) {
            echo  "<script> alert('Registrasi anda Gagal');</script>";
        }
    }


    public function resetPassTemplate()
    {
        //link yg mau dikirim
        $link = "<a href='$this->linkKirim'>$this->message</a>";

        //templatenya
        $this->template =
            '
        <!-- bootsrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <div class="card text-center"  style="text-align: center">
            <div class="card-header">
            <img src="cid:image_cid2">  
         </div>
    <div class="card-body"  style="text-align: center; " >
                <h3 class="card-title"><b>Halo, Berikut Link ' . $this->message . '</b></h3>
                <p class="card-text">
            <p>Hi ' . $this->namaUser . ', Kami dari tim <b>Wikikos</b></p> 

            <p>Link berikut merupakan akses untuk ' . $this->message  . '</p> 
            <p>Jangan beritahukan kepada siapapun link berikut karena bersifat rahasia</p> 
            <p><b>Wikikos</b> akan selalu menjaga akun mu agar tetap aman,cari kos ya Wikikos.</p>
            <p>Wikikos solusi bagi para pencari kos.</p>
            </p>
                <button type="link" class="btn btn-primary">' . $link . '  </button>
        </div>
            <br>        
            <div class="card-footer text-muted"  style="text-align: center">
            Terima Kasih sudah membaca email kami!.<br> 
            Customer Care +6288000889911 24/7 services
                </div>
       </div>';
    }

    public function statusKosTemplate()
    {
        $link = "<a href='$this->linkKirim'>$this->message</a>";
        $this->template =
            '
            <!-- bootsrap css -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
            <div class="card text-center" style="text-align: center">
                <div class="card-header">
                    <img src="cid:image_cid2">
                </div>
                <div class="card-body" style="text-align: center; ">
                    <h3 class="card-title"><b>Halo, Berikut Kami Kabarkan Tentang ' . $this->message . '</b></h3>
                    <p class="card-text">
                    <p>Hi ' . $this->namaUser . ', Kami dari tim <b>Wikikos</b></p>
            
                    <p>Kami Ingin Mengabarkan Tentang ' . $this->message . '</p>
            
                    <p>Nama : <b>' . $this->namaKos . '</b></p>
                    <p>status : <b>' . $this->status . '</b></p>
            
                    <p><b>Wikikos</b> akan selalu membuatmu aman dan nyaman, cari kos ya Wikikos.</p>
                    <p>Wikikos solusi bagi para pencari kos.</p>
                    </p>
                </div>
                <br>
                <div class="card-footer text-muted" style="text-align: center">
                    Terima Kasih sudah membaca email kami!.<br>
                    Customer Care +6288000889911 24/7 services
                </div>
            </div>';
    }

    public function sendMailAction()
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        //ganti dengan email dan password yang akan di gunakan sebagai email pengirim
        $mail->Username = 'zhirosec@gmail.com';
        $mail->Password = 'faizthunder13+';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //ganti dengan email yg akan di gunakan sebagai email pengirim
        $mail->setFrom('zhirosec@gmail.com', 'Admin Wikikos');
        $mail->addAddress($this->mailUser);
        $mail->isHTML(true);
        $mail->addEmbeddedImage('./image/mail.png', 'image_cid2');
        $mail->Subject = $this->subject;

        //ganti sesuai dengan isi yang diingkan 
        $bodyContent = $this->template;

        $mail->Body = $bodyContent;

        $mail->send();
    }
}
