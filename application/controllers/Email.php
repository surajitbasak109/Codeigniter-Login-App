<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends MY_Controller
{
   public function __construct()
   {
      parent::__construct();
   }

   public function index()
   {
      // Load PHPMailer Library
      $this->load->library("phpmailer_lib");

      // PHPMailer object
      $mail = $this->phpmailer_lib->load();

      // SMTP configuration
      $mail->isSMTP();
      $mail->Host     = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'silwebdev@gmail.com';
      $mail->Password = 'step2success';
      $mail->SMTPSecure = 'tls';
      $mail->Port     = 587;
     
      $mail->setFrom('silwebdev@gmail.com', 'Siliguri Web Developer');
      $mail->addReplyTo('silwebdev@gmail.com', 'Siliguri Web Developer');
     
      // Add a recipient
      $mail->addAddress('surajitbasak109@gmail.com');
     
      // Add cc or bcc 
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');
     
      // Email subject
      $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
     
      // Set email format to HTML
      $mail->isHTML(true);
     
      // Email body content
      $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
      <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
      $mail->Body = $mailContent;
     
      // Send email
      if(!$mail->send()){
         echo 'Message could not be sent.';
         echo 'Mailer Error: ' . $mail->ErrorInfo;
      }else{
         echo 'Message has been sent';
      }
   }
}
