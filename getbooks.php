<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();



$shoplist="SELECT * FROM books ORDER BY `books`.`catid` DESC";
$result = mysqli_query($sql->con, $shoplist);
$list=array();
while ( $rowObj = $result->fetch_object () ) {    
    $title=$rowObj->title;
    $title_cuted=mb_substr($title,0,20);
    $preshop = array(title=>$title_cuted,bookid=>"$rowObj->catid",price=>"$rowObj->price");
    $add=array_push($list, $preshop);
}
$result->close (); 

  $retureInfo=$list;
  echo json_encode($retureInfo);
$sql->disconnect();  
?>