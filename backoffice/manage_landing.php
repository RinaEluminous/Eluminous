
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
                    <th>Campaign</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company Name</th>
                    <th>Message</th>
                    <th>IP Address</th>
                    <th>Page URL</th>
                    <th>Entry Date</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                 <?php
                 $sql_statement ='SELECT ID,camp_id,name,email,phone_number,skype_id,message,IP_address,entry_date, page_url FROM tbl_campaign_data order by ID DESC ';
                 $result = mysqli_query($conn,$sql_statement);

                 if (mysqli_num_rows($result)) {
                  $inr = 1;
                  while ($arrRow = mysqli_fetch_assoc($result)) 
                  {

                   $sql_statement1 ='SELECT camp_name FROM tbl_campaign where ID = '.$arrRow['camp_id'].' ';


                   $result1 = mysqli_query($conn,$sql_statement1);
                   $num_rows1 = mysqli_num_rows($result1);

                   if($num_rows1 > 0) {
                     while ($arrRow1 = mysqli_fetch_assoc($result1)) {
                      $camp_name = $arrRow1['camp_name'];
                    }
                  }


                  ?>
                  <tr>
                   <td><?php echo $inr; ?></td>
                   <td><?php echo $camp_name; ?></td>
                   <td><?php echo $arrRow['name']; ?></td>
                   <td><?php echo $arrRow['email']; ?></td>
                   <td><?php echo $arrRow['phone_number']; ?></td>
                   <td><?php echo $arrRow['skype_id']; ?></td>
                   <td><?php echo $arrRow['message']; ?></td>
                   <td><?php echo $arrRow['IP_address']; ?></td>
                   <td><?php echo $arrRow['page_url']; ?></td>
                   <td><?php echo $arrRow['entry_date']; ?></td>
                   <!-- <td> <a href="editUser.php?id=<?php echo $arrRow['ID']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit" ></span> Edit</a>&nbsp;
                    <a href="delUser.php?id=<?php echo $arrRow['ID']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a></td> -->
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
                <th>Campaign</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skype Id</th>
                <th>Message</th>
                <th>IP Address</th>
                <th>Page URL</th>
                <th>Entry Date</th>
                <!-- <th>Action</th> -->
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
