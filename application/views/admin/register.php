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
<body class="hold-transition register-page">
<?php $this->load->view('admin/container'); ?>
<div class="register-box">
  <div class="register-logo">
     <a href="<?= base_url(); ?>"><b><?= $site_title; ?></b></a>
  </div>
<div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <?php
    $fattr = array('class'=>'form-register');
    echo form_open(base_url('main/register'), $fattr);
    ?>

      <div class="form-group has-feedback">
         <?= form_input(array(
            'name'=>'firstname',
            'id'=>'firstname',
            'placeholder'=>'Firstname',
            'class'=>'form-control',
            'value'=>set_value('firstname')
         )); ?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?= form_error('firstname'); ?>
      </div>
      <div class="form-group has-feedback">
         <?= form_input(array(
            'name'=>'lastname',
            'id'=>'lastname',
            'placeholder'=>'Lastname',
            'class'=>'form-control',
            'value'=>set_value('lastname')
         )); ?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?= form_error('lastname'); ?>
      </div>
      <div class="form-group has-feedback">
         <?= form_input(array(
            'name'=>'email',
            'id'=>'email',
            'placeholder'=>'Email',
            'class'=>'form-control',
            'value'=>set_value('email')
         )); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?= form_error('email'); ?>
      </div>
      <?php if($recaptcha == 'yes') {?>
        <div style="text-align: center;" class="form-group">
           <div style="display: inline-block;"><?= $this->recaptcha->render(); ?></div>
        </div>
      <?php
      }
      echo form_submit(array('value'=>'Sign up', 'class'=>'btn btn-block btn-primary'));
      echo form_close();
      ?>

      <br>
      <a href="<?= base_url('main/login/') ?>" class="text-center">I already have a membership</a>
  </div>
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
