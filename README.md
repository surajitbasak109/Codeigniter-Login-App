# Codeigniter Login App

Manage member user & login System for CodeIgniter. It's very small, secure (with notification to review activity log in, will Sent via Your Email) and very fast login system, :+1: with bootstrap 3 & Custom Theme.

Created By me [Surajit Basak](http://surajitbasak109.github.com)

# Screenshot
<img width="100%" alt="Codeigniter Login Application" src="https://raw.githubusercontent.com/surajitbasak109/Codeigniter-Login-App/master/codeigniter-login-app-screenshot.png">

<img width="100%" src="https://raw.githubusercontent.com/surajitbasak109/Codeigniter-Login-App/master/codeigniter-login-app-screenshot2.png" alt="codeigniter-login-app-screenshot2.png">

I could not uploaded Bower_Component directory as it was 40MB in size. You can download the Admin LTE from <a href="https://adminlte.io/">here</a> and copy the bower_components into the public folder.

# Features
- Add user
- Delete user
- Ban, Unban user
- Register new user sent to email token
- Forget password
- Role user level
- Edit user profile
- Gravatar user profile
- Recaptcha by Google
- Compress HTML Settings, for more speed
- Secure Account (Notification to Review Activity Log In, Will Sent via Email like Google) :new: :tada:
- Active or Inactive Recaptcha :new:
- Add Settings :new:

# Settings
- database.php
```
'hostname' => 'localhost', 'username' => '', 'password' => '', 'database' => '',
```

- config.php
```
//Link URL
$config['base_url'] = 'http://adminweb.com/admin/';
// Sent email from:
$config['register'] = 'admin@gmail.com';
$config['forgot'] = 'admin@gmail.com';
```

- ReCAPTCHA.php (Library)<br>
```
private $dataSitekey = ""; //Your SiteKey`
private $lang = "en"; //Lang ReCAPTCHA
public $secret = ''; //Secret
```

# User Level
- is_admin
- is_author
- is_editor
- is_subscriber

# Install
- Clone or download
- Import Sql file
- Do Settings
- Done

# login
- Pass : password
- User : admin@gmail.com

# Check User Level
controller.php
```
//check user level
if(empty($data['role'])){
    redirect(site_url().'main/login/');
}
$dataLevel = $this->userlevel->checkLevel($data['role']);
//check user level

if($dataLevel == "is_admin"){
  (your code here)
}
```

Copyright (c) 2019, Surajit Basak. 
 
Please feel free to send me an email if you have any problems. 
Thank you so much, my email : surajit Basak.
