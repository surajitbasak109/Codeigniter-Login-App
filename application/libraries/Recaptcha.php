<?php
/**
 * CodeIgniter NO Captcha ReCAPTCHA a.k.a reCAPTCHA Version 2.0 library
 *
 * This library is based on official reCAPTCHA library for PHP
 * https://github.com/google/ReCAPTCHA
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ReCaptcha {

   private $dataSitekey = "6LfMva4UAAAAAO8XAnDnPPdLMRo6PqbZ7BQ8-YQt"; //Your SiteKey
    private $lang = "en";
   public $secret = '6LfMva4UAAAAAKyEyZjearNWQptASFfjmN2zAGH4'; //Secret

    public function render() {
        $return = '<div class="g-recaptcha" data-sitekey="' . $this->dataSitekey . '"></div>
            <script src="https://www.google.com/recaptcha/api.js?hl=' . $this->lang . '" async defer></script>';
        return $return;
    }

}
