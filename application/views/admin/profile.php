<?php
   $default = base_url("public/dist/img/avatar.png");
   $emailAvatar = md5(strtolower(trim($email)));
   $gravurl = "";
   $imageProfile = '<img src="http://www.gravatar.com/avatar/'.$emailAvatar.'?d='.$default.'&s=140&r=g&d=mm" class="img-circle" alt="">';
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       User Profile 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('main/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-md-8 col-lg-offset-2">
           <div class="container well col-md-12">
              <div class="row">
                 <div class="col-md-3">
                    <?= $imageProfile; ?>
                 </div>
                 <div class="col-md-7">
                    <h3><i class="fa fa-user-circle" aria-hidden="true"></i> <?= $first_name .' '. $last_name; ?></h3>
                    <h3><i class="fa fa-envelope-o" aria-hidden="true"></i> <?= $email; ?></h3>
                    <h3><i class="fa fa-sign-in" aria-hidden="true"></i> <?= $last_login; ?></h3>
                 </div>
                 <div class="col-md-2">
                    <div class="btn-group">
                       <a class="btn dropdown-toggle btn-info" href="#" data-toggle="dropdown">
                          Action
                          <span class="icon-cog icon-white"><span><span class="caret"></span></span>
                       </a>
                       <ul class="dropdown-menu">
                          <li>
                             <a href="<?= base_url("main/changeuser")?>"><span class="icon-wrench"></span> Edit</a>
                          </li>
                       </ul>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <!-- ./col -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php $this->load->view('templates/admin_footer'); ?>


</body>
</html>
