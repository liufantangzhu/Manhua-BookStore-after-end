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
$result = mysqli_query($sql->con,
"SELECT * FROM shop_cart inner join books on shop_cart.goods_id=books.catid where user_account=$account");

$info=mysqli_num_rows($result);

if($info){
	$shoplist=array();
	while ( $rowObj = $result->fetch_object () ) {
	$preshop = array(
		shopCart_id=>"$rowObj->id",
		goodsid=>"$rowObj->goods_id",
		goodstitle=>"$rowObj->title",
		goodsprice=>"$rowObj->price",
		goodsnumber=>"$rowObj->num"
	);
	$add=array_push($shoplist, $preshop);
	}
	echo json_encode($shoplist);
}else{
	echo json_encode("empty");
}


$sql->disconnect();  
?>