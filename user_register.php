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

$account=trim($_GET["account"]);
$password=trim($_GET["password"]);
$name=trim($_GET["name"]);
$sex=trim($_GET["sex"]);
$sign=trim($_GET["sign"]);
$area=trim($_GET["area"]);
$birthday=trim($_GET["birthday"]);

$is_user = mysqli_query($sql->con, "select user_account from user where user_account='$Account'");
$is_admin = mysqli_query($sql->con, "select user_account from admin where user_account='$Account'");

if($info||$infoa){
		echo "<script language='javascript'>alert('对不起，该账号已被其他用户注册!');history.back();</script>"; 
		exit; 
	}else{
		$sql_query2 = "INSERT INTO `user` (`user_id`, `user_account`, `user_name`, `password`, `user_sex`, `user_addrees`, `user_sign`,`has_head`, `user_birthday`) VALUES ('NULL', '$account', '$name', '$password', '$sex', '$area', '$sign','0', '$birthday')";
	mysqli_query($sql->con,$sql_query2);
	}
	$sql->disconnect();
	?>
