<?php
  include_once("../connection.php");
 include_once("themepart/constant.php");
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
$intCount = $intCountFiltered = $totalRecordwithFilter = 0;
$sqlFilteredRecords = '';
$intCount = 0;



$searchValue = json_decode( $searchValue);


$searchQuery = " ";
$searchItems = " ";
$searchItemsCount = " ";

if($searchValue != ''){
 $searchQuery = '';
 
  
}else{
  $searchQuery = '';
}

## Total number of records without filtering
$sel = mysqli_query( $conn,"SELECT count(*) as all_count FROM tbl_campaign_data ORDER BY ID ASC");

// $totalRecords = $records['allcount'];
if (mysqli_num_rows($sel) > 0) {
  while ($arrData = mysqli_fetch_assoc($sel)) {
     $intCount = $arrData['all_count'];
  }  
}


$strLimit = '';
// fetch the colours start
if ($rowperpage != -1) {
  $strLimit = ' LIMIT '.$row.','.$rowperpage;
}



  $sqlFilteredRecords = 'SELECT ID,camp_id,name,email,phone_number,skype_id,message,IP_address,entry_date FROM tbl_campaign_data WHERE 1'.$searchQuery;


$sel2 = mysqli_query( $conn,$sqlFilteredRecords);
if (mysqli_num_rows($sel2)) {
  while ($arrRow1 = mysqli_fetch_assoc($sel2)) {

  }
}


  $sqlListCSV = 'SELECT ID,camp_id,name,email,phone_number,skype_id,message,IP_address,entry_date FROM tbl_campaign_data  WHERE 1'.$searchQuery.' order by ID '.$columnSortOrder.$strLimit;




$arrResult = mysqli_query( $conn,$sqlListCSV);
$intCountFiltered = mysqli_num_rows($arrResult);

$data = array();
// if records found start
if (mysqli_num_rows($arrResult) > 0) {
  $intSrNo = $row+1;
  while ($arrRow = mysqli_fetch_assoc($arrResult)) {

    extract($arrRow); 

     $sql_statement1 ='SELECT camp_name FROM tbl_campaign where ID = '.$arrRow['camp_id'].' ';


           $result1 = mysqli_query($conn,$sql_statement1);
          $num_rows1 = mysqli_num_rows($result1);

                 if($num_rows1 > 0) {
                         while ($arrRow1 = mysqli_fetch_assoc($result1)) {
                          $camp_name = $arrRow1['camp_name'];
                         }
                  }else{
                    $camp_name = "NOT FOUND";
                  }
    
    $data[] = array( 
      
      "srno"             => $intSrNo++ ,
      "camp_name"              => $camp_name ,
      "name"       => $name,
      "email" =>  $email ,
      "phone_number" =>  $phone_number ,
      "skype_id"  => $skype_id ,
      "message"  => $message ,
      "IP_address"  => $IP_address ,
      "entry_date"         => $entry_date ,
     
      "action"           => '<a class="btn btn-primary itemRow" id ="'.$ID.'" data-toggle="modal" data-target="#myModal" style="color:white;" href="javascript:void(0)" onclick="return delete_data('.$ID.')">Delete</a>'
    );
  }
}
// if records found end
 
$response = array(
 
  "data" => $data ,
  "draw" => intval($draw),
  "iTotalRecords" => $intCount,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
);

echo json_encode($response);
// fetch the colours end
 ?>