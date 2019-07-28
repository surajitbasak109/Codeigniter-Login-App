<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Main extends MY_Controller {
   public $status;
   public $roles;

   function __construct() {
      parent::__construct();
      $this->load->model('User_model', 'user_model', TRUE);
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->status = $this->config->item('status');
      $this->roles = $this->config->item('roles');
      $this->load->library('userlevel');
   }

   public function index()
   {
      // user data from session
      $data = $this->session->userdata();

      if (empty($data))
      {
         redirect(base_url().'main/login');
      }

      // check user level
      if (empty($data['role']))
      {
         redirect(base_url().'main/login/');
      }
      $dataLevel = $this->userlevel->checkLevel($data['role']);
      // check user level
      
      $result = $this->user_model->getAllSettings();
      $data['site_title'] = $result->site_title;
      $data['title'] = "Dashboard Admin";

      if (empty($this->session->userdata('email')))
      {
          redirect(base_url().'main/login');
      }
      else
      {
         $this->load->view('templates/admin_header', $data);
         $this->load->view('templates/admin_nav', $data);
         $this->load->view('templates/admin_sidebar', $data);
         $this->load->view('admin/container');
         $this->load->view('admin/index', $data);
      }

   }

   public function login()
   {
      $data = $this->session->userdata;
      if (!empty($data['email']))
      {
          redirect(base_url().'main/');
      }
      else
      {
         $this->load->library('curl');
         $this->load->library('recaptcha');
         $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
         $this->form_validation->set_rules('password', 'Password', 'required|trim');

         $data['title'] = "Sign In";

         $result = $this->user_model->getAllSettings();
         $data['site_title'] = $result->site_title;
         $data['recaptcha'] = $result->recaptcha;

         if ($this->form_validation->run() == FALSE)
         {
            $this->load->view('admin/login.php', $data);
         }
         else
         {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);
            $userInfo = $this->user_model->checkLogin($clean);

            if ($data['recaptcha'] == 'yes')
            {
               $recaptchaResponse = $this->input->post('g-recaptcha-response');
               $userIp = $_SERVER['REMOTE_ADDR'];
               $key = $this->recaptcha->secret;
               $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$recaptchaResponse."&remoteip=".$userIp; //link
               $response = $this->curl->simple_get($url);
               $status= json_decode($response, true);

               if (!$userInfo)
               {
                  $this->session->set_flashdata('flash_message', 'Wrong password or email.');
                  redirect(base_url().'main/login');
               }
               else if ($userInfo->banned_users == "ban")
               {
                  $htis->session->set_flashdata('danger_message', 'You are temporarily banned from our website!'); 
                  redirect(base_url().'main/login');
               }
               else if (!$status['success'])
               {
                  $this->session->set_flashdata('flash_message', 'Error...! Google Recaptcha Unsuccessful!');
                  redirect(base_url().'main/login');
                  exit;
               }
               else if ($status['success'] && $userInfo && $userInfo->banned_users == "unban") // recaptcha check, success login, ban
               {
                  foreach ($userInfo as $key => $val) {
                     $this->session->set_userdata($key, $val);
                  }
                  redirect(base_url().'main/checkLoginUser/');
               }
               else
               {
                  $this->session->set_flashdata('flash_message', 'Something went wrong');
                  redirect(base_url().'main/login');
                  exit;
               }
            }
            else
            {
               if (!$userInfo)
               {
                  $this->session->set_flashdata('flash_message', 'Wrong password or email.');
                  redirect(base_url().'main/login');
               }
               else if ($userInfo->banned_users == "ban")
               {
                  $this->session->set_flashdata('danger_message', 'You are temporarily banned from our website!'); 
                  redirect(base_url().'main/login');
               }
               else if ($userInfo && $userInfo->banned_users == "unban") // success login, ban
               {
                  foreach ($userInfo as $key => $val) {
                     $this->session->set_userdata($key, $val);
                  }
                  redirect(base_url().'main/checkLoginUser/');
               }
               else
               {
                  $this->session->set_flashdata('flash_message', 'Something went wrong');
                  redirect(base_url().'main/login');
                  exit;
               }
            }
         }
      }
   }

   public function forgot()
   {
      $data['title'] = 'Forgot Password';
      $this->load->library("curl");
      $this->load->library("recaptcha");
      $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");

      $result = $this->user_model->getAllSettings();
      $sTl = $result->site_title;
      $data['recaptcha'] = $result->recaptcha;

      if ($this->form_validation->run() == FALSE)
      {
         $this->load->view('templates/admin_header', $data);
         $this->load->view('admin/container');
         $this->load->view('admin/forgot', $data);
      }
      else
      {
        $email = $this->input->post("email");
        $clean = $this->security->xss_clean($email);
        $userInfo = $this->user_model->getUserInfoByEmail($clean);

        if (!$userInfo)
        {
           $this->session->set_flashdata("flash_message", "We cant find your email address.");
           redirect(base_url('main/login'));
        }

        if ($userInfo->status != $this->status[1])
        {
           $this->session->set_flashdata("flash_message", "Your account is not in approved status.");
           redirect(base_url('main/login'));
        }

        if ($data['recaptcha'] == 'yes')
        {
           // recaptcha
           $recaptchaResponse = $this->input->post("g-recaptcha-response");
           $userIp = $_SERVER['REMOTE_ADDR'];
           $key = $this->recaptcha->secret;
           $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$recaptchaResponse."&remoteip=".$userIp; //link
           $response = $this->curl->simple_get($url);
           $status = json_encode($response, true);

           // recaptcha check
           if ($status['success'])
           {
              // generate token
              $token = $this->user_model->insertToken($userInfo->id);
              $qstring = $this->base64url_encode($token);
              $url = base_url('main/reset_password/token/' . $qstring);
              $link = '<a href="'.$url.'">'.$url.'</a>';

              $this->load->library("email");
              $this->load->library("sendmail");
               
              $message = $this->sendmail->sendForgot($this->input->post('lastname'), $this->input->post('email'), $link, $sTl);
              $to_email = $this->input->post("email");
              $this->email->from($this->config->item('forgot'), 'Reset Password! ', $this->input->post('firstname') .' '. $this->input->post('lastname') ); // from sender, title email
              $this->email->to($to_email);
              $this->email->subject('Reset Password');
              $this->email->message($message);
              $this->email->set_mailtype('html');

              if ($this->email->send())
              {
                 redirect(base_url('main/successresetpassword/'));
              }
              else
              {
                 $this->session->set_flashdata("flash_message", "There was a problem sending an email.");
                 redirect(base_url('main/forgot'));
              }
           }
           else
           {
              $this->session->set_flashdata("flash_message", "Error...! Google Recaptcha Unsuccessfull!");
              redirect(base_url('main/forgot'));
              exit;
           }
        }
        else
        {
           // generate token
           $token = $this->user_model->insertToken($userInfo->id);
           $qstring = $this->base64url_encode($token);
           $url = base_url('main/reset_password/token/' . $qstring);
           $link = '<a href="'.$url.'">'.$url.'</a>';

           $this->load->library("sendmail");
            
           $message = $this->sendmail->sendForgot($this->input->post('lastname'), $this->input->post('email'), $link, $sTl);
           $to_email = $this->input->post("email");
           $subject = 'Reset Password';

           if ($this->send_mail($to_email, '', $subject, $message))
           {
              redirect(base_url('main/successresetpassword/'));
           }
           else
           {
              $this->session->set_flashdata("flash_message", "There was a problem sending an email.");
              redirect(base_url('main/forgot'));
           }
        }
      }

   }

   public function successresetpassword() {
       $data['title'] = 'Success Reset Password';
       $this->load->view("templates/admin_header", $data);
       $this->load->view("admin/container");
       $this->load->view("admin/reset-pass-info", $data);
   }

   public function reset_password()
   {
      $token = $this->base64url_decode($this->uri->segment(4));
      $cleanToken = $this->security->xss_clean($token);
      $user_info = $this->user_model->isTokenValid($cleanToken); // eighther false or array();

      if (!$user_info)
      {
         $this->session->set_flashdata("flash_message", "Token is invavlid or expired.");
         redirect(base_url('main/login'));
      }
      $data = array(
         'firstname'=>$user_info->first_name,
         'email'=>$user_info->email,
         'token'=>$this->base64url_encode($token),
      );

      $data['title'] = 'Reset Password';
      $this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]");
      $this->form_validation->set_rules("passconf", "Password Confirmation", "trim|required|matches[password]");

      if ($this->form_validation->run() == FALSE)
      {
         $this->load->view('templates/admin_header', $data);
         $this->load->view('admin/container');
         $this->load->view('admin/reset_password', $data);
      }
      else
      {
         $this->load->library('password');
         $post = $this->input->post(NULL, TRUE);
         $cleanPost = $this->security->xss_clean($post);
         $hashed = $this->password->create_hash($cleanPost['password']);
         $cleanPost['password'] = $hashed;
         $cleanPost['user_id'] = $user_info->id;
         unset($cleanPost['passconf']);
         if (!$this->user_model->updatePassword($cleanPost))
         {
            $this->session->set_flashdata("flash_message", "There was a problem updating your password.");
            redirect($_SERVER['HTTP_REFERER']);
         }
         else
         {
            $this->session->set_flashdata("success_message", "Your password has been updated. You may now login");
         }
         redirect(base_url('main/login'));
      }
   }


   public function register()
   {
      $data['title'] = 'Register to Admin';
      $this->load->library("curl");
      $this->load->library("recaptcha");
      $this->form_validation->set_rules("firstname", "Firstname", "trim|required");
      $this->form_validation->set_rules("lastname", "Lastname", "trim|required");
      $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");

      $result = $this->user_model->getAllSettings();
      $sTl = $result->site_title;
      $data['site_title'] = $sTl;
      $data['recaptcha'] = $result->recaptcha;

      if ($this->form_validation->run() == FALSE)
      {
         $this->load->view('admin/register', $data);
      }
      else
      {
         if ($this->user_model->isDuplicate($this->input->post('email')))
         {
            $this->session->set_flashdata("flash_message", "Users email already exists.");
            redirect(base_url('main/register'));
         }
         else
         {
            $post = $this->input->post(NULL, TRUE);
            $clean = $this->security->xss_clean($post);

            if ($data['recaptcha'] == 'yes')
            {
              // recaptcha
              $recaptchaResponse = $this->input->post("g-recaptcha-response");
              $userIp = $_SERVER['REMOTE_ADDR'];
              $key = $this->recaptcha->secret;
              $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$recaptchaResponse."&remoteip=".$userIp; //link
              $response = $this->curl->simple_get($url);
              $status = json_encode($response, true);

              // recaptcha check
              if ($status['success'])
              {
                 // insert to database
                 $id = $this->user_model->insertUser($clean);
                 $token = $this->user_model->insertToken($id);

                 // generate token
                 $qstring = $this->base64url_encode($token);
                 $url = base_url('main/complete/token/'.$qstring);
                 $link = '<a href="' .$url. '">' . $url . '</a>';

                 $this->load->library("sendmail");

                 $subject = 'Set Password Login';
                 $message = $this->sendmail->sendRegister($this->input->post('lastname'), $this->input->post("email"), $link, $sTl);
                 $to_email = $this->input->post("email");
                 
                 if ($this->send_mail($to_email, '', $subject, $msg))
                 {
                    redirect(base_url('main/successregister/'));
                 }
                 else
                 {
                    $this->session->set_flashdata("flash_message", "There was a problem sending an email.");
                    redirect(base_url('main/register'));
                 }
              }
              else
              {
                 $this->session->set_flashdata("flash_message", "Error...! Google Recaptcha Unsuccessfull!");
                 redirect(base_url('main/register'));
                 exit;
              }
           }
           else
           {
              // insert to database 
              $id = $this->user_model->insertUser($clean);
              $token = $this->user_model->insertToken($id);

              // generate token
              $qstring = $this->base64url_encode($token);
              $url = base_url('main/complete/token/' . $qstring);
              $link = '<a href="'.$url.'">'.$url.'</a>';

              $this->load->library("sendmail");
               
              $message = $this->sendmail->sendRegister($this->input->post('lastname'), $this->input->post('email'), $link, $sTl);
              $to_email = $this->input->post("email");
              $subject = 'Set Password Login';

              if ($this->send_mail($to_email, '', $subject, $message))
              {
                 redirect(base_url('main/successregister/'));
              }
              else
              {
                 $this->session->set_flashdata("flash_message", "There was a problem sending an email.");
                 exit;
              }
           }
         }
      }
   }
   public function successregister()
   {
      $data['title'] = 'Success Register';
       $this->load->view("templates/admin_header", $data);
       $this->load->view("admin/container");
       $this->load->view("admin/register-info", $data);
   }

   public function complete()
   {
      $token = $this->base64url_decode($this->uri->segment(4));
      $cleanToken = $this->security->xss_clean($token);

      $user_info = $this->user_model->isTokenValid($cleanToken); // eighther false or array();

      if (!$user_info)
      {
         $this->session->set_flashdata("flash_message", "Token is invavlid or expired.");
         redirect(base_url('main/login'));
      }
      $data = array(
         'firstname'=>$user_info->first_name,
         'email'=>$user_info->email,
         'user_id'=>$user_info->id,
         'token'=>$this->base64url_encode($token),
      );

      $data['title'] = 'Set the Password';
      $this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]");
      $this->form_validation->set_rules("passconf", "Password Confirmation", "trim|required|matches[password]");

      if ($this->form_validation->run() == FALSE)
      {
         $this->load->view('templates/admin_header', $data);
         $this->load->view('admin/container');
         $this->load->view('admin/complete', $data);
      }
      else
      {
         $this->load->library('password');
         $post = $this->input->post(NULL, TRUE);

         $cleanPost = $this->security->xss_clean($post);

         $hashed = $this->password->create_hash($cleanPost['password']);
         $cleanPost['password'] = $hashed;
         unset($cleanPost['passconf']);
         $userInfo = $this->user_model->updateUserInfo($cleanPost);

         if (!$userInfo)
         {
            $this->session->set_flashdata("flash_message", "There was a problem updating your record.");
            redirect($_SERVER['HTTP_REFERER']);
         }

         unset($userInfo->password);

         foreach ($userInfo as $key=>$val)
         {
            $this->session->set_userdata($key, $val);
         }
         redirect(base_url('main/'));

      }
   }
   public function checkLoginUser()
   {
      $data = $this->session->userdata;
      if (empty($data))
          redirect(base_url().'main/login');

      $this->load->library('user_agent');
      $browser = $this->agent->browser();
      $os = $this->agent->platform();
      $getip = $this->input->ip_address();

      $result = $this->user_model->getAllSettings();
      $stLe = $result->site_title;
      $tz = $result->timezone;

      $now = new DateTime();
      $now->setTimezone(new DateTimeZone($tz));
      $dTod = $now->format('Y-m-d');
      $dTim = $now->format('H:i:s');

      $this->load->helper('cookie');
      $keyid = rand(1, 9000);
      $scSh = sha1($keyid);
      $neMSC = md5($data['email']);
      $setLogin = array(
         'name'     => $neMSC,
         'value'    => $scSh,
         'expire'   => strtotime("+2 year"),
      );
      $getAccess = get_cookie($neMSC);

      if (!$getAccess && $setLogin["name"] == $neMSC)
      {
         $this->load->library('email');
         $this->load->library('sendmail');
         $bUrl = base_url();
         $message = $this->sendmail->secureMail($data['first_name'], $data['last_name'], $data['email'], $dTod,$dTim,$stLe,$browser,$os,$getip,$bUrl);
         $to_email = $data['email'];
         $this->email->from($this->config->item('register'), 'New sign-in! from '.$browser.'');
         $this->email->to($to_email);
         $this->email->subject('New sign-in! from '.$browser.'');
         $this->email->message($message);
         $this->email->set_mailtype("html");
         $this->email->send();

         $this->input->set_cookie($setLogin, TRUE);
         redirect(base_url().'main/');
      }
      else
      {
         $this->input->set_cookie($setLogin, TRUE);
         redirect(base_url().'main/');
      }
   }

   // open profile and gravatar user
   public function profile()
   {
      $data = $this->session->userdata();
      if (empty($data['role']))
          redirect(base_url('main/login'));

      $result = $this->user_model->getAllSettings();
      $data['site_title'] = $result->site_title;
      $data['title'] = 'Profile';

      $this->load->view('templates/admin_header', $data);
      $this->load->view('templates/admin_nav', $data);
      $this->load->view('templates/admin_sidebar', $data);
      $this->load->view('admin/container');
      $this->load->view('admin/profile', $data);
   }

   public function changeUser() {
      $data = $this->session->userdata();
      if (empty($data['role'])) {
          redirect(base_url('main/login'));
      }

      $dataInfo = array(
         'firstname' => $data['first_name'],
         'id' => $data['id'],
      );

      $result = $this->user_model->getAllSettings();
      $data['site_title'] = $result->site_title;
      $data['title'] = 'Profile';
      $data['title'] = "Change Password";
      $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
      $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
      $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|trim|matches[password]');

      $data['groups'] = $this->user_model->getUserInfo($dataInfo['id']);

      if ($this->form_validation->run() == FALSE)
      {
         $this->load->view('templates/admin_header', $data);
         $this->load->view('templates/admin_nav', $data);
         $this->load->view('templates/admin_sidebar', $data);
         $this->load->view('admin/container');
         $this->load->view('admin/changeuser', $data);
      }
      else
      {
         $this->load->library('password');
         $post = $this->input->post(NULL, TRUE);
         $cleanPost = $this->security->xss_clean($post);
         //print_r($cleanPost); exit;
         $hashed = $this->password->create_hash($cleanPost['password']);
         $cleanPost['password'] = $hashed;
         $cleanPost['user_id'] = $dataInfo['id'];
         $cleanPost['email'] = $this->input->post('email');
         $cleanPost['firstname'] = $this->input->post('firstname');
         $cleanPost['lastname'] = $this->input->post('lastname');
         unset($cleanPost['passconf']);
         if (!$this->user_model->updateProfile($cleanPost))
         {
            $this->session->set_flashdata('flash_message', 'There was a problem updating your profle.');
         }
         else
         {
            $this->session->set_flashdata('success_message', 'Your profile has been updated.');
         }
         redirect(base_url('main/'));
      }
   }

   public function logout()
   {
      $this->session->sess_destroy();
      redirect('main/login/');
   }

   public function phpinf()
   {
      phpinfo();
   }

   public function settings()
   {
      $data = $this->session->userdata;
      if (empty($data['role']))
          redirect(base_url('main/login'));
      $dataLevel = $this->userlevel->checkLevel($data['role']);
      // check user level

      $data['title'] = "Settings";
      $this->form_validation->set_rules('site_title', 'Site Title', 'required|trim');
      $this->form_validation->set_rules('timezone', 'Timezone', 'required|trim');
      $this->form_validation->set_rules('recaptcha', 'Recaptcha', 'required|trim');
      $this->form_validation->set_rules('theme', 'Theme', 'required|trim');

      $result = $this->user_model->getAllSettings();
      $data['id'] = $result->id;
      $data['site_title'] = $result->site_title;
      $data['timezone'] = $result->timezone;

      if (!empty($data['timezone']))
      {
         $data['timezonevalue'] = $result->timezone;
         $data['timezone'] = $result->timezone;
      }
      else
      {
         $data['timezonevalue'] = '';
         $data['timezone'] = 'Select a time zone';
      }

      if ($dataLevel == 'is_admin')
      {
         if ($this->form_validation->run() == FALSE)
         {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_nav', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('admin/container', $data);
            $this->load->view('admin/settings', $data);
          }
         else
         {
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $cleanPost['id'] = $this->input->post('id');
            $cleanPost['site_title'] = $this->input->post('site_title');
            $cleanPost['timezone'] = $this->input->post('timezone');
            $cleanPost['recaptcha'] = $this->input->post('recaptcha');
            $cleanPost['theme'] = $this->input->post('theme');

            if (!$this->user_model->settings($cleanPost))
            {
               $this->session->set_flashdata('flash_message', 'There was a problem updating your data!');
            }
            else
            {
               $this->session->set_flashdata('success_message', 'Your data has been updated.');
            }
            redirect(base_url('main/settings'));
         }
      }
   }

   public function users() {
      $data = $this->session->userdata;
      $data['title'] = "User List";
      $data['groups'] = $this->user_model->getUserData();

      // check user level
      if (empty($data['role']))
          redirect(base_url('main/login'));
      $dataLevel = $this->userlevel->checkLevel($data['role']);
      // check user level

      // check is admin or not
      if ($dataLevel == 'is_admin')
      {
         $this->load->view('templates/admin_header', $data);
         $this->load->view('templates/admin_nav', $data);
         $this->load->view('templates/admin_sidebar', $data);
         $this->load->view('admin/container', $data);
         $this->load->view('admin/user', $data);
      }
      else
      {
         redirect(base_url('main/'));
      }
      
   }

   public function changelevel() {
      $data = $this->session->userdata;
      // check user level
      if (empty($data['role'])) {
          redirect(base_url('main/login'));
      }
      $dataLevel = $this->userlevel->checkLevel($data['role']);
      // check user level
      $data['title'] = "Change Level Admin";
      $data['groups'] = $this->user_model->getUserData();

      // check is admin or not
      if ($dataLevel == 'is_admin') {
         $this->form_validation->set_rules('email', 'Your Email', 'required|trim');
         $this->form_validation->set_rules('level', 'User Level', 'required|trim');

         if ($this->form_validation->run() == FALSE)
         {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_nav', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('admin/container', $data);
            $this->load->view('admin/changelevel', $data);
         }
         else
         {
            $cleanPost['email'] = $this->input->post('email');
            $cleanPost['level'] = $this->input->post('level');
            if (!$this->user_model->updateUserLevel($cleanPost))
            {
               $this->session->set_flashdata('flash_message', 'There was a problem updating the level user.');
            }
            else
            {
               $this->session->set_flashdata('success_message', 'The level user has been updated.');
            }
            redirect(site_url('main/changelevel'));
         }
      }
      else
      {
         redirect(site_url('main/'));
      }
   }

   public function deleteuser($id)
   {
      $data = $this->session->userdata;
      if (empty($data['role']))
         redirect(base_url('main/login'));
      $dataLevel = $this->userlevel->checkLevel($data['role']);
      // check user level

      // check is admin or not
      if ($dataLevel == 'is_admin')
      {
         if ($this->user_model->deleteUser($id) == FALSE)
         {
            $this->session->set_flashdata('flash_message', 'Error, cant delete the user!');
         }
         else
         {
            $this->session->set_flashdata('success_message', 'Delete user was successfull.');
         }
         redirect(base_url('main/users'));
      }
      else
      {
         redirect(base_url('main/'));
      }
   }

   public function addUser()
   {
      $data = $this->session->userdata;
      if (empty($data['role']))
         redirect(base_url('main/login'));

      $dataLevel = $this->userlevel->checkLevel($data['role']);

      // check is admin or not
      if ($dataLevel == 'is_admin')
      {
         $this->form_validation->set_rules("firstname", "Firstname", "trim|required");
         $this->form_validation->set_rules("lastname", "Lastname", "trim|required");
         $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
         $this->form_validation->set_rules("role", "Role", "trim|required");
         $this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]");
         $this->form_validation->set_rules("passconf", "Password Confirmation", "trim|required|matches[password]");

         $data['title'] = "Add User";
         if ($this->form_validation->run() == FALSE)
         {
            $this->load->view("templates/admin_header", $data);
            $this->load->view("templates/admin_nav", $data);
            $this->load->view("templates/admin_sidebar", $data);
            $this->load->view("admin/container");
            $this->load->view("admin/adduser", $data);
         }
         else
         {
            if ($this->user_model->isDuplicate($this->input->post('email')))
            {
               $this->session->set_flashdata("flash_message", "User email already exists.");
               redirect(base_url('main/adduser'));
            } else
            {
               $this->load->library('password');
               $post = $this->input->post(NULL, TRUE);
               $cleanPost = $this->security->xss_clean($post);
               $hashed = $this->password->create_hash($cleanPost['password']);
               $cleanPost['password'] = $hashed;
               unset($cleanPost['passconf']);

               // insert to database
               if (!$this->user_model->addUser($cleanPost))
               {
                  $this->session->set_flashdata("flash_message", "There was a problem add new user.");
               }
               else
               {
                  $this->session->set_flashdata("success_message", "New user has been added.");
               }
               redirect(base_url('main/users/'));
            }
         }
      }
      else
      {
         redirect(base_url('main/'));
      }
   }
   
   public function banuser()
   {
      $data = $this->session->userdata;
      if (empty($data['role']))
         redirect(base_url('main/login'));

      $dataLevel = $this->userlevel->checkLevel($data['role']);

      // check is admin or not
      if ($dataLevel == 'is_admin')
      {
         $this->form_validation->set_rules("email", "Email", "trim|required");
         $this->form_validation->set_rules("banuser", "Ban or Unban", "trim|required");

         $data['title'] = "Add User";
         $data['groups'] = $this->user_model->getUserData();

         if ($this->form_validation->run() == FALSE)
         {
            $this->load->view("templates/admin_header", $data);
            $this->load->view("templates/admin_nav", $data);
            $this->load->view("templates/admin_sidebar", $data);
            $this->load->view("admin/container");
            $this->load->view("admin/banuser", $data);
         }
         else
         {
            $post = $this->input->post(null, true);
            $cleanPost = $this->security->xss_clean($post);
            if (! $this->user_model->updateUserban($cleanPost))
            {
               $this->session->set_flashdata("flash_message", "There was a problem updating.");
            }
            else
            {
               $this->session->set_flashdata("success_message", "The status user has been updated.");
            }
            redirect(base_url('main/banuser'));
         }
      }
      else
      {
         redirect(base_url('main/'));
      }
   }

   public function base64url_encode($data) {
       return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
   }

   public function base64url_decode($data) {
       return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
   }
}
