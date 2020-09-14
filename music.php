<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();



$songlist="SELECT * FROM music ORDER BY `music`.`M_id` ";
$result = mysqli_query($sql->con, $songlist);
$list=array();
while ( $rowObj = $result->fetch_object () ) {    
    $presong = array(title=>"$rowObj->M_title",id=>"$rowObj->M_id",singer=>"$rowObj->M_singer",time=>"$rowObj->M_time",album=>"$rowObj->M_album");
    $add=array_push($list,$presong);
}
$result->close (); 

  $retureInfo=$list;
  echo json_encode($retureInfo);
$sql->disconnect();  
?>