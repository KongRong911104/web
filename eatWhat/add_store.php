<?php
include 'database.php';
$conn = connection();

if ($conn->connect_error) {
    die("連接失敗" . $conn->connect_error);
}

if($_POST["add_name_name"]==""){
    echo "<script>window.alert('請輸入店家名稱');window.location.href='edit_store.html';</script>";
    exit;
}

$add_name_name = $_POST["add_name_name"];
$add_o_hour = $_POST["add_o_hour"];
$add_o_minute = $_POST["add_o_minute"];
$add_c_hour = $_POST["add_c_hour"];
$add_c_minute = $_POST["add_c_minute"];

if (is_null($_POST["add_days"])) {
    $sql = sprintf("INSERT INTO `stores` (`name`,`open_time_hour`,`open_time_minute`,`closed_time_hour`,`closed_time_minute`,`closed_day`) VALUES ('%s',%d,%d,%d,%d,null);", $add_name_name, intval($add_o_hour), intval($add_o_minute), intval($add_c_hour), intval($add_c_minute));
}
else{
    $add_days = implode(",", $_POST["add_days"]);
    $sql = sprintf("INSERT INTO `stores` (`name`,`open_time_hour`,`open_time_minute`,`closed_time_hour`,`closed_time_minute`,`closed_day`) VALUES ('%s',%d,%d,%d,%d,'%s');", $add_name_name, intval($add_o_hour), intval($add_o_minute), intval($add_c_hour), intval($add_c_minute), $add_days);
}

// echo $add_o_hour;

$result = $conn->query($sql);


echo "<script>window.alert('新增完成');window.location.href='edit_store.html';</script>";
exit;


?>