    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Change Level
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('main/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Level</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-lg-4 col-lg-offset-4">
           <?php $fattr = array('class'=>'form-change-level');
               echo form_open(base_url('main/changelevel'), $fattr);
           ?>
           <div class="form-group">
              <?= form_label('Email', "email"); ?>
              <select id="email" class="form-control select2" name="email">
                 <option value="">Select Email</option>
                  <?php
                   foreach($groups as $row)
                    {
                       echo '<option value="'.$row->email.'">'.$row->email.'</option>';
                    }
                 ?>
              </select>
           </div>

           <div class="form-group">
              <?= form_label('Level', 'level'); ?>
            <?php
                $dd_list = array(
                   '1' => 'Admin',
                   '2' => 'Author',
                   '3' => 'Editor',
                   '4' => 'Subscriber'
                );
               $dd_name = 'level';
               echo form_dropdown($dd_name, $dd_list, set_value($dd_name), 'class = "form-control select2" id="level"');
            ?>
           </div>
           
           <?= form_submit(array('value'=>'Submit', 'class'=>'btn btn-primary')); ?>
           <a href="<?= base_url('main/users/'); ?>">
              <button type="button" class="btn btn-default">
                 Cancel
              </button>
           </a>
           
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
