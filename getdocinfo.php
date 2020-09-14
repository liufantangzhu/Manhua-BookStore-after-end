<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();

$docid=$_GET['getdocid'];

$infosql="SELECT * FROM doc where doc.docid='$docid'";
$getdocinfo = mysqli_query($sql->con,$infosql);

while ( $rowObj = $getdocinfo->fetch_object () ) {

      $docinfo = array(title=>"$rowObj->title",creat_date=>"$rowObj->creat_date",hot=>"$rowObj->hot",content=>"$rowObj->cont",docid=>"$rowObj->docid");
      }


$getdocinfo->close (); 
  $retureInfo=$docinfo;
  echo json_encode($retureInfo);
  $sql->disconnect();  
?>