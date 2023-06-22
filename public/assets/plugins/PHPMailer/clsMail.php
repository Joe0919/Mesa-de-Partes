<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

class clsMail{

    private $mail = null;
    
    function __construct(){
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;
        $this->mail->Username = "joel09llalli@gmail.com";
        $this->mail->Password = "ibkltfrivgevulbp";
    }


    public function metEnviar(string $titulo, string $nombre, string $correo, string $asunto, string $bodyHTML){
        $this->mail->setFrom("joel09llalli@gmail.com", $titulo);
        $this->mail->addAddress($correo,$nombre);
        $this->mail->Subject = $asunto;
        $this->mail->Body = $bodyHTML;
        $this->mail->isHTML(true);
        $this->mail->CharSet = "UTF-8";
        return $this->mail->send();
    }
}

?>