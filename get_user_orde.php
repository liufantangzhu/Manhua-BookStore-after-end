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

$orderlist=array();

$getorder = mysqli_query($sql->con, "SELECT * FROM `order_item` where user_id=$account;");
while ( $rowObj = $getorder->fetch_object () ) {
$preorder = array(
	goodsid=>"$rowObj->goods_id",
	goods_num=>"$rowObj->goods_num",
	goods_price=>"$rowObj->goods_price",
	sum_price=>"$rowObj->sum_price",
	goods_title=>"$rowObj->goods_title",
	recor_addrees=>"$rowObj->addrees",
	order_id=>"$rowObj->order_id",
	creat_time=>"$rowObj->creat_time",
	status=>"$rowObj->status"
);
$add=array_push($orderlist, $preorder);
}
echo json_encode($orderlist);
$getorder->close ();
$sql->disconnect(); 
?>