<style>
.content-wrapper, .main-footer {
   margin-left: 0px; 
}
.content {
   margin-top: 40px;
}
</style>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-lg-4 col-lg-offset-4">
           <h2>Almost there!</h2>
           <h5>Hello <span><?= $firstname; ?></span>, <br>Your username is <span><?= $email; ?></span>.</h5>
           <small>Please enter a password to begin using the site.</small>
           <br>
           <br>
            <?php $fattr = array('class'=>'form-password-reset');
            echo form_open(base_url('main/complete/token/'.$token), $fattr);
            ?>
            <div class="form-group">
               <?php echo form_password(array(
                  'name'=>'password',
                  'id'=>'password',
                  'placeholder'=>'Password',
                  'class'=>'form-control',
                  'value'=>set_value('password')
               )); ?>
               <?= form_error('password'); ?>
            </div>
            
            <div class="form-group">
               <?php echo form_password(array(
                  'name'=>'passconf',
                  'id'=>'passconf',
                  'placeholder'=>'Confirm Password',
                  'class'=>'form-control',
                  'value'=>set_value('passconf')
               )); ?>
               <?= form_error('passconf'); ?>
            </div>
            <?= form_hidden('user_id', $user_id); ?>
            <?= form_submit(array('value'=>'Complete', 'class'=>'btn btn-primary btn-block')); ?>
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
