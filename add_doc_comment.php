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
$userid=trim($_GET["userid"]);
$comment=trim($_GET["comment"]);
$docid=trim($_GET["docid"]);

$result=mysqli_query($sql->con, "select * from user_comment where `user_comment`.`user_account`='$account' and `user_comment`.`doc_id`='$docid' ");
	$info=mysqli_num_rows($result);
	if ($info>=5) {
	$retureInfo="最多只可以发五条评论哦";
	}else{
		$insert = "INSERT INTO `user_comment` 
		(`comment_id`, `user_id`, `user_account`, `user_comment`, `creat_time`, `doc_id`) VALUES 
		(NULL, '$userid', '$account', '$comment', CURRENT_TIMESTAMP, '$docid')";
		mysqli_query($sql->con,$insert);
	}

$sql->disconnect();  
?>