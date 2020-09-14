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
$id=trim($_GET["id"]);
$number=trim($_GET["number"]);

$updata =" UPDATE `shop_cart` SET `num` = '$number' WHERE`shop_cart`.`user_account` = '$account' and id='$id'";
  mysqli_query($sql->con,$updata);



  
    $retureInfo['status'] = 1;
    $retureInfo['info'] = '加入购物车成功';
    echo json_encode($retureInfo);

    

$sql->disconnect();  
?>