<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/dist/css/main.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>public/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
   .content-wrapper {
      margin-left: 0px;
   }
   .content-wrapper {
      background: inherit;
   }
  </style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<?php $this->load->view('admin/container'); ?>
<div class="login-box">
  <div class="login-logo">
     <a href="<?= base_url(); ?>"><b><?= $site_title; ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

      <?php $fattr = array('class'=>'form-signin');
      echo form_open(base_url().'main/login', $fattr); ?>
      <div class="form-group has-feedback">
         <?php echo form_input(array(
            'name'=>'email',
            'id'=>'email',
            'placeholder'=>'Email',
            'class'=>'form-control',
            'value'=>set_value('email')
         )); ?>
         <?php echo form_error('email'); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
         <?php echo form_password(array(
            'name'=>'password',
            'id'=>'password',
            'placeholder'=>'Password',
            'class'=>'form-control',
            'value'=>set_value('password')
         )); ?>
         <?php echo form_error('password'); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <?php if ($recaptcha == 'yes') { ?>
      <div style="text-align: center;" class="form-group">
         <div style="display: inline-block;"><?php $this->recaptcha->render(); ?></div>
      </div>
      <?php } ?>
      <div class="row">
        <div class="col-xs-12">
           <?php echo form_submit(array('value'=>'Sign In', 'class'=>'btn btn-primary btn-block btn-flat')); ?>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
    <p>Forgot your password? <a href="<?= base_url(); ?>main/forgot">Forgot password</a></p>
    <p>Not Registered? <a href="<?= base_url(); ?>main/register" class="text-center">Register</a></p>

  </div>
  <!-- /.login-box-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url(); ?>public/plugins/iCheck/icheck.min.js"></script>
</body>
</html>
