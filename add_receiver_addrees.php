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
$receiver=trim($_GET["receiver"]);
$postcode=trim($_GET["postcode"]);
$telephone=trim($_GET["telephone"]);
$area=trim($_GET["area"]);
$addreesDetal=trim($_GET["addreesDetal"]);

$new_addrees=mysqli_query($sql->con, "select user_account from user_addrees where user_account=$account");
$info=mysqli_num_rows($new_addrees);
if ($info==15) {
	echo "最多只可保存15个地址";
}else{

	$insert = "INSERT INTO `user_addrees` 
	(`user_account`, `receior`, `area`, `addrees`, `telephone`, `addrees_id`, `postal_code`) VALUES 
	('$account', '$receiver', '$area', '$addreesDetal', '$telephone', NULL, '$postcode')";

	mysqli_query($sql->con,$insert);
}
$new_addrees->close();
$arr=[$account,$receiver,$area,$addreesDetal,$telephone,$postcode];
echo json_encode($arr);
$sql->disconnect();  
?>