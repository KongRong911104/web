<?php
include '../crud.php';
// echo 12;
$username = $_POST["sent_new_username"];
$username = json_decode($username);
// print_r($username[0][1]);
create_user($username[0][1],$username[0][0]);
header('Location: ./');
?>