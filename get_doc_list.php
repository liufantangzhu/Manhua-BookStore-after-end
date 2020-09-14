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
$sqli=($page-1)*$pagesize;

$docinfo=array();
$result = mysqli_query($sql->con,"SELECT * FROM doc order by creat_date desc limit {$sqli},{$pagesize}");
while ( $rowObj = $result->fetch_object()) { //动态生成文章
$creat_date=$rowObj->creat_date;
$date=substr($creat_date,0,10);

  $predoc = array(title=>"$rowObj->title",creat_date=>$date,hot=>"$rowObj->hot",cont=>"$rowObj->cont;",docid=>"$rowObj->docid");
$add=array_push($docinfo, $predoc);
}
$result->close();
$retureInfo=$docinfo;
echo json_encode($retureInfo); 
$sql->disconnect();
?>