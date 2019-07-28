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
           <h1 class="text-center">Forgot Password</h1>
            <?php $fattr = array('class'=>'form-forgot-password');
            echo form_open(base_url('main/forgot/'), $fattr);
            ?>
            <div class="form-group">
            <?php echo form_input(array(
               'name'=>'email',
               'id'=>'email',
               'placeholder'=>'Email',
               'class'=>'form-control',
               'value'=>set_value('email')
            )); ?>
            <?= form_error('email'); ?>
            </div>
           <?php if ($recaptcha == 'yes') { ?>
              <div style="text-align: center;" class="form-group">
                 <div style="display: inline-block;"><?= $this->recaptcha->render(); ?></div>
              </div>
           <?php } ?>
            <?= form_submit(array('value'=>'Submit', 'class'=>'btn btn-primary btn-block')); ?>
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
