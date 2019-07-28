<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter PHPMailer class
 *
 * This class enables SMTP email with PHPMailer
 *
 * @category Libraries
 * @author Surajit Basak
 * @link https://surajitbasak109.github.io/
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class PHPMailer_lib
{
   public function __construct()
   {
      log_message('Debug', 'PHPMailer class is loaded.');
   }

   public function load() {
      // include PHPMailer library class
      require_once APPPATH.'third_party/PHPMailer/Exception.php';
      require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
      require_once APPPATH.'third_party/PHPMailer/SMTP.php';

      $mail = new PHPMailer;
      return $mail;
   }

}
