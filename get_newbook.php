<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();



$shoplist="SELECT `title`,`catid`,`price` FROM `books` ORDER BY `books`.`catid` DESC limit 10";
$result = mysqli_query($sql->con, $shoplist);
$list=array();
while ( $rowObj = $result->fetch_object () ) {    
    $preshop = array(title=>$rowObj->title,bookid=>"$rowObj->catid",price=>"$rowObj->price");
    $add=array_push($list, $preshop);
}
$result->close (); 

  $retureInfo=$list;
  echo json_encode($retureInfo);

$sql->disconnect();  
?>
