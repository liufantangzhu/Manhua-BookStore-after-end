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
$name=trim($_GET["name"]);
$sex=trim($_GET["sex"]);
$sign=trim($_GET["sign"]);
$area=trim($_GET["area"]);
$birthday=trim($_GET["birthday"]);

$updata ="UPDATE `user` SET `user_name` = '$name',`user_sex` = '$sex', `user_addrees` = '$area', `user_sign` = '$sign' WHERE `user`.`user_account` = $account";
mysqli_query($sql->con,$updata);


$sql->disconnect();  
?>

