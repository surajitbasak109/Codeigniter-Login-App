    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('main/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-lg-8 col-lg-offset-2">
           <h5>Hello <span><?= $first_name; ?></span>.</h5>
           <hr>
            <?php
            $fattr = array('class'=>'form-settings');
            echo form_open(base_url('main/settings'), $fattr);

            function tz_list() {
               $zones_array = array();
               $timestamp = time();
               foreach (timezone_identifiers_list() as $key => $zone) {
                   date_default_timezone_set($zone);
                   $zones_array[$key]['zone'] = $zone;
               }
               return $zones_array;
            }
            ?>
            <?= '<input type="hidden" name="id" value="'.$id.'">'; ?>
            <div class="form-group">
               <?= form_label('Site Tititle', 'site_title'); ?>
               <?= form_input(array('name'=>'site_title', 'id'=>'site_title', 'placeholder'=>'Site Title', 'class'=>'form-control', 'value' => set_value('site_title', $site_title))); ?>
               <?= form_error('site_title'); ?>
            </div>

            <div class="form-group">
               <?= form_label('Timezone', 'timezone'); ?>
               <select name="timezone" id="timezone" class="form-control select2">
                  <option value="<?= $timezonevalue; ?>"><?= $timezone; ?></option>
                  <?php foreach (tz_list() as $t) { ?>
                  <option value="<?= $t['zone']; ?>"><?= $t['zone']; ?></option>
                  <?php } ?>
               </select>
            </div>

            <div class="form-group">
               <?= form_label('Recaptcha', 'recaptcha'); ?>
               <?= form_dropdown('recaptcha', array(''=>'Select option', 'no'=>'No', 'yes'=>'Yes'), 'yes', array('class'=>'form-control select2', 'id'=>'recaptcha')); ?>
            </div>

            <div class="form-group">
               <?= form_label('Theme', 'theme'); ?>
               <?php $theme_array = array(
                  'public/dist/css/skins/skin-black.min.css' => 'Black',
                  'public/dist/css/skins/skin-black-light.min.css' => 'Black Light',
                  'public/dist/css/skins/skin-blue.min.css' => 'Blue',
                  'public/dist/css/skins/skin-blue-light.min.css' => 'Blue Light',
                  'public/dist/css/skins/skin-green.min.css' => 'Green',
                  'public/dist/css/skins/skin-green-light.min.css' => 'Green Light',
                  'public/dist/css/skins/skin-purple.min.css' => 'Purple',
                  'public/dist/css/skins/skin-purple-light.min.css' => 'Purple Light',
                  'public/dist/css/skins/skin-red.min.css' => 'Red',
                  'public/dist/css/skins/skin-red-light.min.css' => 'Red Light',
                  'public/dist/css/skins/skin-yellow.min.css' => 'Yellow',
                  'public/dist/css/skins/skin-yellow-light.min.css' => 'Yellow Light',
               );
               echo form_dropdown('theme', $theme_array, 'public/dist/css/skins/skin-black.min.css', array('id'=>'theme', 'class'=>'form-control select2'));
               ?>
            </div>
            <?= form_submit(array('value'=>'Save', 'name'=>'submit', 'class'=>'btn btn-primary btn-block')); ?>
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
