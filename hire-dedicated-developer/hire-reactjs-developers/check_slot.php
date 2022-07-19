<?php
include_once ("../connection.php");
$resultArray['slot'] = array();

$dateSlot = date("Y-m-d H:i:s", strtotime($_POST['slotDate']));
$sql_statement = 'SELECT `bookingtime` FROM `tbl_booking_slot` WHERE `bookingday`= "' . $dateSlot . '"  ';

$result = mysqli_query($conn, $sql_statement);

if ($result)
{
    if (mysqli_num_rows($result) == 0)
    {
        $resultArray['type'] = "success";
        $resultArray['day'] = "";
    }
    else
    {
        while ($row = $result->fetch_assoc())
        {

            foreach ($row as $key1 => $value1)
            {
                array_push($resultArray['slot'], $value1);
            }

        }

        $resultArray['type'] = "success";
        $timestamp = strtotime($_POST['slotDate']);
        $resultArray['day'] = date('D', $timestamp);
    }

}
else
{
    $resultArray['type'] = "error";
}
$resultArray = json_encode($resultArray);
echo $resultArray;
die();
?>
