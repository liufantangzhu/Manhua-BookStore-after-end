<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();

$select = $_GET['select'] ;


$noticelist=array();
$notice="SELECT * FROM `notice` order by create_date desc limit 3";
$result = mysqli_query($sql->con,$notice);
while ( $rowObj = $result->fetch_object()) {
$prenotice = array(content=>"$rowObj->content",create_date=>"$rowObj->create_date");
$add=array_push($noticelist, $prenotice);
}
  
$docinfo=array();
$doc="SELECT * FROM doc order by creat_date desc limit 0,4";
$result2 = mysqli_query($sql->con,$doc);
while ( $rowObj = $result2->fetch_object()) { //动态生成文章
	$creat_date=$rowObj->creat_date;
  $date=substr($creat_date,0,10);
  $predoc = array(title=>"$rowObj->title",creat_date=>$date,hot=>"$rowObj->hot",cont=>"$rowObj->cont",docid=>"$rowObj->docid");
  $add=array_push($docinfo, $predoc);
  }

$ranklist=array();
$rank= "SELECT title,hot,docid FROM doc ORDER BY hot DESC limit 10";
$result3 = mysqli_query($sql->con,$rank);
while ( $rowObj = $result3->fetch_object()) { //动态生成 文章 列表
    $prerank = array(title=>"$rowObj->title",hot=>"$rowObj->hot",docid=>"$rowObj->docid");
    $add=array_push($ranklist, $prerank);
    }




  $retureInfo=array(notice=>$noticelist,doc=>$docinfo,rank=>$ranklist);
  echo json_encode($retureInfo);
  $sql->disconnect();
?>