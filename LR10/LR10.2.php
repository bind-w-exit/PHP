<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

if(isset($_SESSION['username'])){
  echo "logged in as ". $_SESSION['username'];
} else{
  header("Location: lr.php");
}

if(isset($_POST['email'])){
  require './PHPMailer/Exception.php';
  require './PHPMailer/PHPMailer.php';
  require './PHPMailer/SMTP.php';
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'andrii.soroka-ki211k@nung.edu.ua';                     //SMTP username
      $mail->Password   = '************';                               //SMTP password
      $mail->SMTPSecure = "ssl";
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('andrii.soroka-ki211k@nung.edu.ua', 'Student');
      $mail->addAddress('12Andriy24@Gmail.com', 'Soroka Andriy');     //Add a recipient
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Feedback from website: '.$_POST['subject'];
      $mail->Body    = 'From: '.$_POST['email'].'</br> '.$_POST['message'];
  
      $mail->send();
      echo 'Message has been sent';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
?>
<html>
    <head>
        <title>Mailing test</title>
    </head>
    <body>
        <form method="POST">
            <input type="email" placeholder="email" name="email" required/></br>
            <input type="text" placeholder="subject" name="subject" required/></br>
            <textarea placeholder="message" name="message"></textarea></br>
            <input type="submit" value="Send"/>
        </form>
    </body>
</html>
