<?php
$dataLevel = $this->userlevel->checkLevel($role);
$result = $this->user_model->getAllSettings();
$site_title = $result->site_title;
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('main/'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <?php $sTle_words = explode(" ", $site_title);
      $acronym = "";
      foreach ($sTle_words as $w) {
          $acronym .= $w[0];
      }
      ?>
      <span class="logo-mini"><b><?= $acronym; ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?= $site_title; ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src="<?= base_url("public/dist/img/avatar.png"); ?>" class="user-image" alt="User Image">
               <span class="hidden-xs"><?= $first_name . ' ' . $last_name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url("public/dist/img/avatar.png"); ?>" class="img-circle" alt="User Image">

                <p>
                <?= $first_name . ' ' . $last_name;  ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                   <a href="<?= base_url('main/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('main/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
         <?php if ($dataLevel == 'is_admin') { ?>
            <li>
                <a href="<?= base_url('main/settings') ?>"><i class="fa fa-gears"></i></a>
           </li>
         <?php } ?>

        </ul>
      </div>
    </nav>
  </header>
