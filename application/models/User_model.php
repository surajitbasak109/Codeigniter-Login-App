<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class User_Model extends CI_Model
{
   public $status;
   public $roles;

   function __construct()
   {
      // Call the Model Constructor
      parent::__construct();
      $this->status = $this->config->item('status');
      $this->roles = $this->config->item('roles');
      $this->banned_users = $this->config->item('banned_users');
   }

   // get settings
   public function getAllSettings()
   {
      $this->db->select('*');
      $this->db->from('settings');
      return $this->db->get()->row();
   }

   // check login
   public function checkLogin($post)
   {
      $this->load->library('password');
      //$db = $this->db;
      $this->db->select('*');
      $this->db->where('email', $post['email']);
      $query = $this->db->get('users');
      $userInfo = $query->row();
      $count = $query->num_rows();

      if ($count == 1) {
         if (!$this->password->validate_password($post['password'], $userInfo->password))
         {
            error_log('Unsuccessfull login attempt('.$post['email'].')');
            return false;
         }
         else
         {
            $this->updateLoginTime($userInfo->id);
         }
      }
      else
      {
         error_log('Unsuccessfull login attempt('.$post['email'].')');
         return false;
      }

      unset($userInfo->password);
      return $userInfo;
   }

   public function updateLoginTime($id)
   {
      $this->db->where('id', $id);
      $this->db->update('users', array('last_login' => date('Y-m-d H:i:s A')));
   }

   public function getUserInfo($id)
   {
      $sql = "SELECT * FROM users WHERE id = ?";
      $q = $this->db->query($sql, array($id));
      if ($this->db->affected_rows() > 0)
      {
         $row = $q->row();
         return $row;
      }
      else
      {
         error_log('no user found getUserInfo('.$id.')');
         return false;
      }
   }

   public function updateProfile($post)
   {
      $this->db->where('id', $post['user_id']);
      $this->db->update('users', array(
         'password'=>$post['password'],
         'email'=>$post['email'],
         'first_name'=>$post['firstname'],
         'last_name'=>$post['lastname'],
      ));
      $success = $this->db->affected_rows();

      if (!$success)
      {
          error_log('Unable to updateProfile('.$post['user_id'].')');
          return false;
      }
      return true;
   }

   public function updatePassword($post)
   {
      $this->db->where('id', $post['user_id']);
      $this->db->update('users', array('password' => $post['password']));
      $success = $this->db->affected_rows();

      if (!$success)
      {
         error_log('Unable to updatedPassword('.$post['user_id'].')');
         return false;
      }
      return true;
   }
   
   public function settings($post)
   {
      $this->db->where('id', $post['id']);
      $this->db->update('settings',
         array(
            'site_title'=>$post['site_title'],
            'timezone'=>$post['timezone'],
            'recaptcha'=>$post['recaptcha'],
            'theme'=>$post['theme']
         )
      );
      $success = $this->db->affected_rows();
      if (!$success) {
          return false;
      }
      return true;
   }
   public function getUserData() {
      $query = $this->db->get('users');
      return $query->result();
   }
   public function updateUserLevel($post)
   {
       $this->db->where("email", $post['email']);
       $this->db->update("users", array('role'=>$post['level']));
       $success = $this->db->affected_rows();

       if(!$success) {
         return false;
       }
       return true;
   }
   public function deleteUser($id)
   {
      $this->db->where("id", $id);
      $this->db->delete("users");

      if ($this->db->affected_rows() == 1)
      {
         return TRUE;
      }
      return FALSE;
   }

    public function isDuplicate($email) {
      $this->db->get_where("users", array('email' => $email), 1);
      return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
   
   public function addUser($post) {
      $string = array(
         'first_name'=>$post['firstname'],
         'last_name'=>$post['lastname'],
         'email'=>$post['email'],
         'password'=>$post['password'],
         'role'=>$post['role'],
         'status'=>$this->status[1],
      );
      $q = $this->db->insert_string("users", $string);
      $this->db->query($q);
      return $this->db->insert_id();
   }

   public function updateUserban($post) {
      $this->db->where("email", $post['email']);
      $this->db->update('users', array('banned_users' => $post['banuser']));
      $success = $this->db->affected_rows();

      if (! $success)
      {
         return false;
      }
      return true;
   }

   public function getUserInfoByEmail($email) {
      $q = $this->db->get_where("users", array('email' => $email), 1);
      if ($this->db->affected_rows() > 0)
      {
         $row = $q->row();
         return $row;
      }
      else
      {
         error_log('no user found getUserInfo('.$email.')');
         return false;
      }
   }

   public function insertToken($user_id) {
       $token = substr(sha1(rand()), 0, 30);
       $date = date('Y-m-d');

       $string = array(
          'token'=>$token,
          'user_id'=>$user_id,
          'created'=>$date,
       );
       $query = $this->db->insert_string('tokens', $string);
       $this->db->query($query);
       return $token . $user_id;

   }

   public function isTokenValid($token) {
       $tkn = substr($token, 0, 30);
       $uid = substr($token, 30);

       $q = $this->db->get_where("tokens", array(
          'tokens.token' => $tkn,
          'tokens.user_id' => $uid
       ), 1);

       if ($this->db->affected_rows() > 0)
       {
          $row = $q->row();

          $created = $row->created;
          $createdTS = strtotime($created);
          $today = date('Y-m-d');
          $todayTS = strtotime($today);

          if ($createdTS != $todayTS)
             return false;

          $user_info = $this->getUserInfo($row->user_id);
          return $user_info;
       }
       else
       {
          return false;
       }
   }

   public function insertUser($post)
   {
      $string = array(
         'first_name'=>$post['firstname'],
         'last_name'=>$post['lastname'],
         'email'=>$post['email'],
         'role'=>$this->roles[0],
         'status'=>$this->status[0],
         'banned_users'=>$this->banned_users[0]
      );
      $q = $this->db->insert_string('users', $string);
      $this->db->query($q);
      return $this->db->insert_id();
   }

   public function updateUserInfo($post)
   {
      $data = array(
         'password'=>$post['password'],
         'last_login'=>date('Y-m-d h:i:s A'),
         'status'=>$this->status[1]
      );

      $this->db->where("id", $post['user_id']);
      $this->db->update('users', $data);
      $success = $this->db->affected_rows();

      if (!$success)
      {
         error_log('Unable to updateUserInfo('. $post['user_id'] .')');
         return false;
      }
      $user_info = $this->getUserInfo($post['user_id']);
      return $user_info;
   }

}
