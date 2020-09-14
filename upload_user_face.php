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

$userid=trim($_GET["userid"]);
$account=trim($_GET["useraccount"]);

if(!empty($_FILES['file']['name'])){		//判断上传内容是否为空
// 	// if($_FILES['up_picture']['error']>0){		//判断文件是否可以上传到服务器
// 	// 	echo "上传错误:";
// 	// 	switch($_FILES['up_picture']['error']){
// 	// 		case 1:
// 	// 			echo "上传文件大小超出配置文件规定值";
// 	// 		break;
// 	// 		case 2:
// 	// 			echo "上传文件大小超出表单中约定值";
// 	// 		break;
// 	// 		case 3:
// 	// 			echo "上传文件不全";
// 	// 		break;
// 	// 		case 4:
// 	// 			echo "没有上传文件";
// 	// 		break;	
// 	// 	}
// 	// }else{
		if(!is_dir("./image/user_head/")){				//判断指定目录是否存在
			mkdir("./image/user_head/");					//创建目录
		}
		if($_COOKIE['adminuser']!=''){
		$filename=$userid['adminuser'].".jpg";
		}else{$filename=$userid.".jpg";}					//定义文件名
   		
		$path='./image/user_head/'.$filename;		//定义上传文件名称和存储位置
		if(is_uploaded_file($_FILES['file']['tmp_name'])){	//判断文件是否是HTPP POST上传
			if(!move_uploaded_file($_FILES['file']['tmp_name'],$path)){	//执行上传操作
				echo json_encode("上传失败");
			}else{
				echo json_encode("上传成功");
				$updata ="UPDATE `user` SET `has_head` = 1 WHERE `user`.`user_id` = $userid";
				mysqli_query($sql->con,$updata);
			}
		}else{
			echo "上传文件".$_FILES['file']['name']."不合法！";
		}
		
	};
	
$sql->disconnect(); 
?>