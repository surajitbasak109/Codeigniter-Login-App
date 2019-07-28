    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('main/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /col -->
        <div class="col-md-12 col-lg-12">
           <div class="table-responsive">
              <table id="userListTable" class="table table-hover table-bordered table-striped">
                 <thead>
                     <tr>
                        <th>
                           Name
                        </th>
                        <th>
                           User Name
                        </th>
                        <th>
                           Last Login
                        </th>
                        <th>
                           Level Name
                        </th>
                        <th>
                           Status
                        </th>
                        <th>
                           Edit Role
                        </th>
                        <th>
                           Delete
                        </th>
                     </tr>
                 </thead>
                 <tbody>
                  <?php
                  foreach ($groups as $row) {
                     if ($row->role == 1)
                          $rolename = "Admin";
                     else if ($row->role == 2)
                         $rolename = "Author";
                     else if($row->role == 3)
                         $rolename = "Editor";
                     else if($row->role == 4)
                        $rolename = "Subscriber";

                     echo '<tr>';
                     echo '<td>'.$row->first_name.'</td>';
                     echo '<td>'.$row->email.'</td>';
                     echo '<td>'.$row->last_login.'</td>';
                     echo '<td>'.$rolename.'</td>';
                     echo '<td>'.$row->status.'</td>';
                     echo '<td><a href="'.base_url('main/changelevel/').'"><button type="button" class="btn btn-primary">Role</button></a></td>';
                     echo '<td><a href="'.base_url().'main/deleteuser/'.$row->id.'"><button type="button" class="btn btn-danger">Delete</button></a></td>';
                     echo '</tr>';
                  }

                  ?>
                 </tbody>
              </table>
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
