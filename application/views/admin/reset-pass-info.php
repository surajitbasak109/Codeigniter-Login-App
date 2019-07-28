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
            <div class="page-header">
               <h1>Email sent successfully.</h1>
            </div>
            <div class="alert alert-info" role="alert">
               <p>Please check your inbox.</p>
               <p>Login? <a href="<?= base_url('main/login'); ?>">login</a></p>
            </div>
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
