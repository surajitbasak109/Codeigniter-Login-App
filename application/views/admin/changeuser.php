    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Change Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('main/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-md-4 col-lg-offset-4">
           <h5>Hello <span><?= $first_name; ?></span>.</h5>
<?php
   $fattr = array('class'=> 'form-signin');
   echo form_open(base_url('main/changeuser/'), $fattr);
?>
            <div class="form-group">
               <?= form_input(array('name'=>'firstname', 'id'=>'firstname', 'placeholder'=>'First Name', 'class'=>'form-control', 'value'=>set_value('firstname', $groups->first_name))); ?>
               <?= form_error('firstname'); ?>
            </div>
            <div class="form-group">
               <?= form_input(array('name'=>'lastname', 'id'=>'lastname', 'placeholder'=>'Last Name', 'class'=>'form-control', 'value'=>set_value('lastname', $groups->last_name))); ?>
               <?= form_error('lastname'); ?>
            </div>
            <div class="form-group">
               <?= form_input(array('name'=>'email', 'id'=>'email', 'placeholder'=>'Email', 'class'=>'form-control', 'value'=>set_value('email', $groups->email))); ?>
               <?= form_error('email'); ?>
            </div>
            <div class="form-group">
               <?= form_password(array('name'=>'password', 'id'=>'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value'=>set_value('password'), 'autocomplete'=>'new-password')); ?>
               <?= form_error('password'); ?>
               <div id="pswd_info">
                   <h5>Password must meet the following requirements:</h5>
                    <ul>
                        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                        <li id="number" class="invalid">At least <strong>one number</strong></li>
                        <li id="length" class="invalid">Be at least <strong>6 characters</strong></li>
                    </ul>
               </div>
            </div>
            <div class="form-group">
               <?= form_password(array('name'=>'passconf', 'id'=>'passconf', 'placeholder'=>'Password Confirmation', 'class'=>'form-control', 'value'=>set_value('passconf'))); ?>
               <?= form_error('passconf'); ?>
               <div id="pswdconf_info">
                   <h5>Checking Password confirmation...</h5>
                    <ul>
                        <li id="match" class="invalid"><strong>Password not matched.</strong></li>
                    </ul>
               </div>
            </div>
            <?= form_submit(array('value'=>'Change', 'class'=>'btn btn btn-lg btn-primary btn-block')); ?>
            <?= form_close(); ?>
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
