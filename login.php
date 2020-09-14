<?php include('sql_connect.php');?> 
<?php header("Content-Type:text/html;charset=UTF-8"); ?>
<?php



header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:x-jwt-header,content-type');

header("Access-Control-Request-Methods:GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,test-sessid');

// $is_login=0;
$sql=new mysqli_connect();
$sql->connection();
$sql->set_laugue();
$sql->choice();

	$Name=trim($_GET["usercount"]);
	$PW=trim($_GET["userpwd"]);
	$check_query= mysqli_query($sql->con, "select user_account from user where user_account=$Name AND password='$PW'");
	$check=mysqli_num_rows($check_query);
	if($check){
		setcookie("id",$Name, time()+$_POST ['remember'])or die("");
		setcookie("password",$PW, time()+$_POST ['remember'])or die("");
		// 获取用户信息
			$result = mysqli_query($sql->con, "SELECT * FROM user where user_account=$Name limit 1");
			while ( $rowObj = $result->fetch_object () ) {
			$userinfo = array(
				useraccount=>"$rowObj->user_account",
				userid=>"$rowObj->user_id",
				username=>"$rowObj->user_name",
				usersex=>"$rowObj->user_sex",
				useraire=>"$rowObj->user_addrees",
				usersign=>"$rowObj->user_sign",
				hasface=>"$rowObj->has_head",
				islogin=>1
			);
			   }$result->close (); 
			echo json_encode($userinfo);
	}
	else{
		$check_query= mysqli_query($sql->con, "select user_account from admin where user_account=$Name AND password='$PW'");
		$check=mysqli_num_rows($check_query);
		if($check){
			setcookie("adminuser",$Name, time()+$_POST ['remember'])or die("");
			setcookie("password",$PW, time()+$_POST ['remember'])or die("");
			// 获取用户信息
			$result = mysqli_query($sql->con, "SELECT * FROM admin where user_account=$Name limit 1");
			while ( $rowObj = $result->fetch_object () ) {
			$userinfo = array(
				useraccount=>"$rowObj->user_account",
				userid=>"$rowObj->user_id",
				username=>"$rowObj->user_name",
				usersex=>"$rowObj->user_sex",
				useraire=>"$rowObj->user_addrees",
				usersign=>"$rowObj->user_sign",
				has_face=>"$rowObj->has_head",
				islogin=>1
			);
			   }$result->close (); 
			echo json_encode($userinfo);

		}else{
			echo json_encode('登录失败，请检查你的账户或者密码是否正确!');
			exit; 
		}
		$sql->disconnect();
	}
	
// if( empty ($_GET["user_password"]) or empty ($_GET["username"])){ 
// 	echo json_encode('对不起，登录信息不能够为空!');
// 		exit; 		
// 	}
?>