
<?php

include_once("themepart/constant.php");
include_once("../connection.php");
?>
<?php include './themepart/header.php'; ?>
<!-- Navbar -->
<?php include './themepart/navbar.php'; ?>
<!-- Navbar -->

<!-- Main Sidebar Container -->
<?php include './themepart/sidebar.php'; ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manage Landing Pages</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Landing Listing</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Country Name</th>
                    <th>Page Url</th>
                    <th>IP Address</th>
                    <th>Date</th>
                    
                  </tr>
                </thead>
                <tbody>
                 <?php
                 $sql_statement ='SELECT `country_name`, `page_url`, `ip_address`, `date` FROM `tbl_landing_url` WHERE  1 ORDER BY id DESC';
                 $result = mysqli_query($conn,$sql_statement);

                 if (mysqli_num_rows($result)) {
                  $inr = 1;
                  while ($arrRow = mysqli_fetch_assoc($result)) 
                  {

                    ?>
                    <tr>
                     <td><?php echo $inr; ?></td>
                     <td><?php echo $arrRow['country_name']; ?></td>
                     <td><?php echo $arrRow['page_url']; ?></td>
                     <td><?php echo $arrRow['ip_address']; ?></td>
                     <td><?php date_default_timezone_set('Asia/Kolkata');
                     echo $arrRow['date']; ?>
                     
                   </td>

                 </tr>

                 <?php
                 $inr++;

               }
             }
             ?>
           </tbody>
           <tfoot>
            <tr>
              <th>ID</th>
              <th>Country Name</th>
              <th>Page Url</th>
              <th>IP Address</th>
              <th>Date</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->


    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- Content Wrapper. Contains page content -->

<?php include './themepart/footer.php'; ?>
