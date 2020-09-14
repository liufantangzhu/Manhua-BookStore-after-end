<?php include('sql_connect.php');?> 
<?php header("Content-Type:text/html;charset=UTF-8"); ?>
<?php

header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');

header("Access-Control-Request-Methods:GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,test-sessid');

$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();

$account=trim($_GET["useraccount"]);
$id=trim($_GET["id"]);


$delete=$sql_query1 = mysqli_query($sql->con, "DELETE FROM `shop_cart` WHERE `shop_cart`.`id` = $id and `shop_cart`.`user_account` = '$account';");


echo json_encode('success') ;    

$sql->disconnect();  
?>