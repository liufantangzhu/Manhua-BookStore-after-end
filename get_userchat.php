<?php
include('sql_connect.php');
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();


$commentlist=array();
	$result = mysqli_query($sql->con, "SELECT `user_comment`.*,`user`.`user_name` FROM `user_comment`,`user` where `user_comment`.`user_account`=`user`.`user_account` ORDER BY `user_comment`.`creat_time` DESC  limit 12");
	while ( $rowObj = $result->fetch_object()) { //动态生成 文章评论 列表

	    $precomment = array(
	    	c_id=>"$rowObj->comment_id",
	    	user_account=>"$rowObj->user_account",
	    	uid=>"$rowObj->user_id",
	    	user_name=>"$rowObj->user_name",
	    	user_comment=>"$rowObj->user_comment",
	    	creat_time=>"$rowObj->creat_time",
	    	doc_id=>"$rowObj->doc_id");
	    $add=array_push($commentlist, $precomment);
	    }
	$retureInfo=$commentlist;
	echo json_encode($retureInfo);
	$result->close();
	$sql->disconnect();
?>