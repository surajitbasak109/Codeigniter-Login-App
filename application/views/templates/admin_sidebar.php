<?php
$dataLevel = $this->userlevel->checkLevel($role);
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url("public/dist/img/avatar.png"); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $first_name. ' ' . $last_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
          <a href="<?= base_url('main/'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($dataLevel == 'is_admin') { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-plus"></i>
            <span>Member Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="<?= base_url('main/users/'); ?>"><i class="fa fa-list"></i> Users List</a></li>
            <li><a href="<?= base_url('main/adduser/'); ?>"><i class="fa fa-user-plus"></i> Add User</a></li>
            <li><a href="<?= base_url('main/banuser/'); ?>"><i class="fa fa-user-times"></i> Ban User</a></li>
            <li><a href="<?= base_url('main/changelevel/'); ?>"><i class="fa fa-wrench"></i> Change Level</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

