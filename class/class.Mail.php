
<?php
// awal class email
require_once dirname(__FILE__) . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

class Mail
{
    private $link;
    private $mail;
    private $subject;
    private $message;

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

    public function resetMail()
    {
        $link = "<a href='http://localhost/kuliah/project/?p=new-pass'>Reset Your Pass</a>";
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
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->addEmbeddedImage('./image/mail.png', 'image_cid2');
        $mail->Subject = "Reset Link Password";
        $bodyContent = '
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
          <div class="card text-center"  style="text-align: center">
                <div class="card-header">
                <img src="cid:image_cid2">  
                </div>
            <div class="card-body"  style="text-align: center; " >
                    <h3 class="card-title"><b>Selamat, Berikut Link reset akun anda</b></h3>
                    <p class="card-text">
                <p>Hi, Kami dari tim <b>Wikikos</b></p> 

                <p>Link berikut merupakan akses untuk mengganti password anda yang baru</p> 
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
        $mail->Body = $bodyContent;

        $mail->send();
    }
}
