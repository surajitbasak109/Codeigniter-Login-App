<?php // defined('BASEPATH') OR exit('No direct script access allowed.');

class MY_Controller extends CI_Controller
{
   function __construct() {
      parent::__construct();
   }

   public function send_mail($to, $from = '', $subject, $msg) {
      // Load PHPMailer Library
      $this->load->library("phpmailer_lib");

      // PHPMailer object
      $mail = $this->phpmailer_lib->load();

      // SMTP configuration
      $mail->isSMTP();
      $mail->Host     = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = '';
      $mail->Password = '';
      $mail->SMTPSecure = 'tls';
      $mail->Port     = 587;
     
      if ($from == '')
      {
         $mail->setFrom('silwebdev@gmail.com', 'Siliguri Web Developer');
         $mail->addReplyTo('silwebdev@gmail.com', 'Siliguri Web Developer');
      }
      else
      {
         $mail->setFrom($from);
         $mail->addReplyTo($from);
      }
     
      // Add a recipient
      $mail->addAddress($to);
     
      // Add cc or bcc 
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');
     
      // Email subject
      $mail->Subject = $subject;
     
      // Set email format to HTML
      $mail->isHTML(true);
     
      // Email body content
      $mailContent = $msg;
      $mail->Body = $mailContent;
     
      // Send email
      if(!$mail->send()){
         return false;
         error_log('Mailer Error: ' . $mail->ErrorInfo);
      }else{
         return true;
      }
   }

}
