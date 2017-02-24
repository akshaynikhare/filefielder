<?php


require "mail/PHPMailerAutoload.php";
class MailService {
    //put your code here
    
   public function send_mail($filename,$key,$email){
       $subject="ecloud password for file uploaded  ".$filename;
       $message="here is your password".PHP_EOL.PHP_EOL;
       $message.="file name:-   ".$filename.PHP_EOL;
       $message.="password :-   ".$key.PHP_EOL;
	   $message.="".PHP_EOL;
	   $message.="download link :-http://localhost/filefeilder4.3/MAIN.php?fnamex=".$filename."&kp=".$key.PHP_EOL;
	   
       $headers ="From: ".$email;

       // Configuring SMTP server settings
       $mail = new PHPMailer;
       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com';
       $mail->Port = 587;
       $mail->SMTPSecure = 'tls';
       $mail->SMTPAuth = true;
       $mail->Username = "shrutimohod115@gmail.com";//from email our mail;
       $mail->Password = "shruti115";//pass;

// Email Sending Details
       $mail->addAddress($email);
       $mail->Subject = $subject;
       $mail->msgHTML($message);

// Success or Failure
       if (!$mail->send()) {
           $error = "Mailer Error: " . $mail->ErrorInfo;
           echo '<p id="para">'.$error.'</p>';
       }
       else {
           echo '<p id="para">Message sent!</p>';
       }



       /*local mailer
       if(mail($email,$subject,$message,$headers)){
           echo "message sent successfully..";

           
       }else
       {
           echo "message could not be sent...";
       }
    */

       }




}




//$m=new MailService();
//$m->send_mail("hell.jpg","hello world","root@localhost.com");
//$m->send_mail_g("hell.jpg","hello world","akshay.victrans@gmail.com");

?>

