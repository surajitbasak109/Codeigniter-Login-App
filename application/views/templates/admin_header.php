<?php
defined('BASEPATH') OR exit('No direct script access allowed.');

$result = $this->user_model->getAllSettings();
$theme = $result->theme;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/font-awesome/css/font-awesome.min.css"); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/Ionicons/css/ionicons.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url("public/dist/css/main.min.css"); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url($theme); ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/morris.js/morris.css"); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/jvectormap/jquery-jvectormap.css"); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/bootstrap-daterangepicker/daterangepicker.css"); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= base_url("public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"); ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <!-- DataTable -->
  <link rel="stylesheet" href="<?= base_url("public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"); ?>">
   <!-- custom css -->  
   <link rel="stylesheet" href="<?= base_url("public/dist/css/custom.css"); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
