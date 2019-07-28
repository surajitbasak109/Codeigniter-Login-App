    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Add User
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('main/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-lg-10 col-lg-offset-1">
           <h2>Hello <?= $first_name; ?></h2>
           <h5>Please enter the required information below.</h5>
           <?php $fattr = array('class'=>'form-add-user');
                echo form_open(base_url('main/adduser'), $fattr);
           ?>
           <div class="form-group row">
            <div class="col-lg-6">
              <?= form_label('Firstname', 'firstname', array('class' => 'control-label')); ?>
              <?= form_input(array('name'=>'firstname', 'id'=>'firstname', 'placeholder'=>'First Name', 'class'=>'form-control','value'=>set_value('firstname'))); ?>
              <?= form_error('firstname'); ?>
            </div>
            <div class="col-lg-6">
              <?= form_label('Lastname', 'lastname', array('class' => 'control-label')); ?>
              <?= form_input(array('name'=>'lastname', 'id'=>'lastname', 'placeholder'=>'Last Name', 'class'=>'form-control','value'=>set_value('lastname'))); ?>
              <?= form_error('lastname'); ?>
            </div>
           </div>
           <div class="form-group row">
              <div class="col-lg-6">
                 <?= form_label('Email', 'email', array('class' => 'control-label')); ?>
                 <?= form_input(array('name'=>'email', 'id'=>'email', 'placeholder'=>'Email', 'class'=>'form-control','value'=>set_value('email'))); ?>
                 <?= form_error('email'); ?>
              </div>
              <div class="col-lg-6">
                 <?= form_label('Role', 'role', array('class' => 'control-label')); ?>
                  <?php $dd_list = array(
                       '1' => 'Admin',
                       '2' => 'Author',
                       '3' => 'Editor',
                       '4' => 'Subscriber'
                    );
                   $dd_name = 'role';
                   echo form_dropdown($dd_name, $dd_list, set_value($dd_name), array('class'=>'form-control select2', 'id'=>'role'));
                 ?>
              </div>

           </div>
           <div class="form-group row">
            <div class="col-lg-6">
              <?= form_label('Password', 'password', array('class' => 'control-label')); ?>
              <?= form_password(array('name'=>'password', 'id'=>'password', 'placeholder'=>'Password', 'class'=>'form-control','value'=>set_value('password'))); ?>
              <?= form_error('password'); ?>
            </div>
            <div class="col-lg-6">
              <?= form_label('Confirm Password', 'passconf', array('class' => 'control-label')); ?>
              <?= form_password(array('name'=>'passconf', 'id'=>'passconf', 'placeholder'=>'Confirm Password', 'class'=>'form-control','value'=>set_value('passconf'))); ?>
              <?= form_error('passconf'); ?>
            </div>
           </div>
           <?= form_submit(array('value'=>'add', 'class'=>'btn btn-primary btn-block')); ?>
           <?= form_close(); ?>
        </div>
        <!-- ./col -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php $this->load->view('templates/admin_footer'); ?>
<script>
$('#userListTable').DataTable();
</script>
</body>
</html>
