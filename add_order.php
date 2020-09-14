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

$account=trim($_GET['useraccount']);
$goods_id=trim($_GET['goods_id']);
$goods_num=trim($_GET['number']);
$addrees_id=trim($_GET['addrees_id']);

$getaddrees=mysqli_query($sql->con, "SELECT addrees FROM user_addrees where addrees_id='$addrees_id' limit 1" );
while ( $rowObj = $getaddrees->fetch_object () ) {
$addrees=$rowObj->addrees;
}$getaddrees->close ();

$result = mysqli_query($sql->con, "SELECT title,price FROM books where catid='$goods_id' limit 1" );
while ( $rowObj = $result->fetch_object () ) {
$singprice=$rowObj->price;
$goods_title=$rowObj->title;
}$result->close ();

$sum_price=$singprice*$goods_num;
$insert = "INSERT INTO `order_item` (`user_id`, `goods_title`, `goods_id`, `goods_num`, `goods_price`, `sum_price`, `addrees`, `status`, `creat_time`, `update_time`) VALUES ('$account','$goods_title', '$goods_id', '$goods_num', '$singprice', '$sum_price', '$addrees', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
mysqli_query($sql->con,$insert);


$retureInfo = array(
'state' =>'success',
);
    echo json_encode($retureInfo);

$sql->disconnect();  
?>