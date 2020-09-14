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

$account=trim($_GET["useraccount"]);

$addreeslist=array();
$addrees = mysqli_query($sql->con, "SELECT * FROM user_addrees where user_account=$account limit 15 ");
while ( $rowObj = $addrees->fetch_object () ) {
$cont="$rowObj->addrees";
$name=mb_substr($cont,0)."";
$preaddrees = array(
	recier=>"$rowObj->receior",
	area=>"$rowObj->area",
	tel=>"$rowObj->telephone",
	addreesdetal=>"$rowObj->addrees",
	post=>"$rowObj->postal_code",
	addrees_id=>"$rowObj->addrees_id"
);
$add=array_push($addreeslist, $preaddrees);
}
echo json_encode($addreeslist);
$addrees->close (); 
$sql->disconnect();  
?>