<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();

$pagesize= $_GET['pagesize'];
$page= $_GET['page'];

$row=mysqli_fetch_row(mysqli_query($sql->con,"select count(1) from doc"));

$recordcount=$row[0];

if ($recordcount==0){
  $pagecount=0;
}else if ($recordcount<=$pagesize) {
  $pagecount=1;
}else if ($recordcount%$pagesize==0) {
  $pagecount=$recordcount/$pagesize;
}else{
  $pagecount=(int)($recordcount/$pagesize)+1;
}
$retureInfo=$pagecount;
echo json_encode($retureInfo);
$sql->disconnect();
?>