<?php
require("dbconfig.php");
    $status = $_POST['status'];
    $place = "0"; //複数用意する場合はここをPOSTで取得

//MySqli Insert Query
$insert_row = $db->query("INSERT INTO info (onoff, place) VALUES($status, $place)");

if($insert_row){
	echo "insert";
    print 'Success! ID of last inserted record is : ' .$db->insert_id .'<br />'; 
}else{
	echo "string";
    die('Error : ('. $db->errno .') '. $db->error);
}