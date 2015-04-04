<html>
<head>
<meta charset="UTF-8">
</head>
<body>
  <h3>現在時刻</h3>
  <span>
<?php
echo date("Y-m-d H:i:s", time()).'</span>';

//Open a new connection to the MySQL server
require("dbconfig.php");

//現在時刻
$today = date("Y-m-d", time());
$tomorrow = date("Y-m-d", time()+86400);
$flag1=0;
$flag2=0;

//05:00-12:00のチェック
$result1 = $db->query("SELECT id, date, onoff, place FROM info where date BETWEEN '$today 05:00:00' and '$today 12:00:00' ");
if ($result1->num_rows==0) {
  $flag1=1;
}
print '<h2>今日の5時-12時まで</h2><table border="1">';
while($row = $result1->fetch_array()) {
    print '<tr>';
    print '<td>'.$row["id"].'</td>';
    print '<td>'.$row["date"].'</td>';
    print '<td>'.$row["onoff"].'</td>';
    print '<td>'.$row["place"].'</td>';
    print '</tr>';
}
if ($flag1==1) {
  if (strtotime(date("Y-m-d H:i:s", time()))>strtotime(date("Y-m-d 12:00:00", time()))) {
    echo "今日の午前中は扉の開閉が行われませんでした。電話をしたほうが良いかもしれません。";
  }
  else{
    echo "今日はまだ開閉が行われていません。注意をしましょう。";
  }
}
print '</table>';
// Frees the memory associated with a result
$result1->free();


//12:00~19:00のチェック
$result2 = $db->query("SELECT id, date, onoff, place FROM info where date BETWEEN '$today 12:00:00' and '$today 19:00:00' ");
if ($result2->num_rows==0) {
  $flag2=1;
}
print '<h2>今日の12時-19時まで</h2><table border="1">';
while($row2 = $result2->fetch_array()) {
    print '<tr>';
    print '<td>'.$row2["id"].'</td>';
    print '<td>'.$row2["date"].'</td>';
    print '<td>'.$row2["onoff"].'</td>';
    print '<td>'.$row2["place"].'</td>';
    print '</tr>';
}
print '</table>';
if ($flag2==1) {
  if (strtotime(date("Y-m-d H:i:s", time()))>strtotime(date("Y-m-d 19:00:00", time()))) {
    echo "今日の午後は扉の開閉が行われませんでした。電話をしたほうが良いかもしれません。";
  }
  else{
    echo "今日の午後はまだ開閉が行われていません。注意をしましょう。";
  }
}
// Frees the memory associated with a result
$result2->free();
// close connection 


if (($flag1 == 1) and ($flag2 == 1)){
  if (strtotime(date("Y-m-d H:i:s", time()))>strtotime(date("Y-m-d 19:00:00", time()))) {
    echo '<BR><B style="color:red">ばあちゃんが危険</B>';
  }
}


//19:00~05:00のチェック
$result3 = $db->query("SELECT id, date, onoff, place FROM info where date BETWEEN '$today 19:00:00' and '$tomorrow 05:00:00' ");
if ($result3->num_rows==0) {
  $flag3=1;
}
print '<h2>今日の19時-05時まで</h2><table border="1">';
while($row3 = $result3->fetch_array()) {
    print '<tr>';
    print '<td>'.$row3["id"].'</td>';
    print '<td>'.$row3["date"].'</td>';
    print '<td>'.$row3["onoff"].'</td>';
    print '<td>'.$row3["place"].'</td>';
    print '</tr>';
}
print '</table>';

// Frees the memory associated with a result
$result3->free();
// close connection 
$db->close();


?>
</body>
</html>