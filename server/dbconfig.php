<?php

$db = new mysqli('host', 'user', 'pass', 'DBname');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

?>