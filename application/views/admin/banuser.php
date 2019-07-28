    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>
          Ban or Unban User
       </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('main/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ban or Unban User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-lg-10 col-lg-offset-1">
            <h5>Hi <span><?= $first_name; ?></span>.</h5>
            <?php $fattr = array('class'=>'form-ban-user');
            echo form_open(base_url('main/banuser'), $fattr);
            ?>
            <div class="form-group row">
               <div class="col-lg-6">
                  <?= form_label('Email', 'email', array('class'=>'control-label')) ?>
                  <select id="email" class="form-control select2" name="email">
                     <?php foreach ($groups as $row)
                     {
                        echo '<option value="'.$row->email.'">'.$row->email.'</option>';
                     } ?>
                  </select>
               </div>
               <div class="col-lg-6">
                  <?= form_label('Email', 'email', array('class'=>'control-label')); ?>
                  <select id="banuser" class="form-control select2" name="banuser">
                     <option value="" hidden="" disabled="" selected="">Ban or Unban?</option>
                     <option value="ban">Ban</option>
                     <option value="unban">Unban</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-md-6">
                  <?= form_submit(array('value'=>'Submit', 'class'=>'btn btn-primary btn-block')); ?>
               </div>
               <div class="col-md-6">
                  <a href="<?= base_url('main/users/'); ?>">
                     <button type="button" class="btn btn-default btn-block">Cancel</button>
                  </a>
               </div>
            </div>
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
