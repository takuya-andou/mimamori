<?php
/*
19:00にcronでまわすためのプログラム
*/

//Open a new connection to the MySQL server
require("dbconfig.php");

//現在時刻
$today = date("Y-m-d", time());
$flag1=0;
$flag2=0;

//05:00-12:00のチェック
$result1 = $db->query("SELECT id, date, onoff, place FROM info where date BETWEEN '$today 05:00:00' and '$today 12:00:00' ");
if ($result1->num_rows==0) {
	$flag1=1;
}
// Frees the memory associated with a result
$result1->free();

//12:00~19:00のチェック
$result2 = $db->query("SELECT id, date, onoff, place FROM info where date BETWEEN '$today 12:00:00' and '$today 19:00:00' ");
if ($result2->num_rows==0) {
	$flag2=1;
}
// Frees the memory associated with a result
$result2->free();
// close connection 
$db->close();


if (($flag1 == 1) and ($flag2 == 1)) {
	if (mail("送信先のメールアドレス", "Alert MAil", "ばあちゃんが危険。電話したほうがいいかも。", "From: FROMのアドレス")) {
  echo "メールが送信されました。";
} else {
  echo "メールの送信に失敗しました。";
}
}

?>