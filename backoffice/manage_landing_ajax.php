
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage landing Pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo BACKOFFICE?>">Home</a></li>
              <li class="breadcrumb-item active">Manage landing Pages</li>
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
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
                     <th>Entry Date</th>
                     <th>Action</th>
                  </tr>
                  </thead>
              
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
                     <th>Entry Date</th>
                     <th>Action</th>
                  
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
   

    //  $("#landing_page").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["csv", "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#landing_page_wrapper .col-md-6:eq(0)');
    // $('#landing_page').DataTable({
    //  // 'responsive': true,
    //    "scrollX": true,
      
    
      
      
   
    //   "buttons": ["csv", "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#landing_page_wrapper .col-md-6:eq(0)');
  });
</script>

 <script type="text/javascript" class="init">




  var table;
  $(document).ready(function() {
//add class to reefund coloumn
//var total_table_content = $("#total_table_con").html();




  var  table = $('#example1').DataTable({
      // 'fixedHeader': true,
      'responsive': true,
       'processing':true,
      'lengthChange' : true,
        'order' : [[1 , 'desc']],
      "lengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]],
      "dom": 'Blfrtip',
      "paging": true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'beforeSend': function (request) {
             $(".se-pre-con").show();
          },
       
          'url':'ajax_fetch.php'
      },

       
      'columns': [
       
               
         { data: 'srno' },
         { data: 'camp_name' },
         { data: 'name' },
         { data: 'email' },
         { data: 'phone_number' },
         { data: 'skype_id' },
         { data: 'message' },
         { data: 'IP_address' },
         { data: 'entry_date' }, 
       
           { data: 'action' },
      ],
      
           buttons: [
           
        
        { 
          extend: 'print',
          customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            $("#total_table_con").html()
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
          footer: true,
          title: 'Fetched Live Orders',
          exportOptions: {
              columns: [ 0, 1, 2,3,4,5,6,7,8,9,10 ]
          },
        },
     
        { 
          extend: 'csv',
          title: 'Fetched Live Orders',
          exportOptions: {
              columns: [ 0, 1, 2,3,4,5,6,7,8,9,10]
          }
        },

     ],
      
      columnDefs: [{
        
        orderable: false,
        targets: "no-sort",
      }],

     
       
    }); 

   

    // search start
    $('#btnSearch').on( 'click', function () {

    
      var search = new Array();
      var search ={"attribute": $('#attribute').val(),"date_start": $('#datepicker_start').val(),"date_end": $('#datepicker_end').val(),"status": $('#status').val()} ;

      table.search( JSON.stringify(search)).draw();


      
    });
    // search end

    // reset search start
    $('#btnReset').on( 'click', function () {

      location.reload();
        table.search('').draw();
      
    });
    // reset search end 
    //datepicker_start
$("#datepicker_start").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});

$("#datepicker_end").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});
  });



</script> 
</body>
</html>
