<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();

$isbn=trim($_GET['book_id']);
$result = mysqli_query($sql->con, "SELECT * FROM books where catid='$isbn'");

while ( $rowObj = $result->fetch_object () ) { 
	$goodsinfo = array(
		books_title=>"$rowObj->title",
		books_id=>"$rowObj->catid",
		books_price=>"$rowObj->price",
		books_description=>"$rowObj->description",
		books_isbn=>"$rowObj->isbn");
      }

$result->close (); 
$retureInfo=$goodsinfo;
  echo json_encode($retureInfo);
$sql->disconnect();
?>