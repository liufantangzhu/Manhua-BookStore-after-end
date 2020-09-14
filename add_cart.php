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


$sql_query1 = mysqli_query($sql->con, "select num goods_id from shop_cart where `shop_cart`.`user_account` = '$account' and goods_id='$id'");
    
$info=mysqli_num_rows($sql_query1);
if($info){
    $row=mysqli_fetch_row($sql_query1);
    $new_num=$row[0] +$number;
  $updata =" UPDATE `shop_cart` SET `num` = '$new_num' WHERE `shop_cart`.`user_account` = '$account' and goods_id='$id'";
  mysqli_query($sql->con,$updata);
    $retureInfo['status'] = 1;
    $retureInfo['info'] = '加入购物车成功';
    echo json_encode($retureInfo);
}else{
   $insert = "INSERT INTO `shop_cart` (`id`, `user_account`, `goods_id`, `num`, `status`, `create_time`, `updata_time`) VALUES (NULL, '$account', '$id', '$number', '', '', '')";

   $retureInfo['status'] = 1;
    $retureInfo['info'] = '加入购物车成功';
    mysqli_query($sql->con,$insert);
    echo json_encode($retureInfo);
}

    

$sql->disconnect();  
?>