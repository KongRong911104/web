<?php

include 'database.php';
$conn = connection();

if ($conn->connect_error) {
    die("連接失敗" . $conn->connect_error);
}

$SID = $_POST["SID"];
$edit_name_name = $_POST["edit_name_name"];
$edit_o_hour = $_POST["edit_o_hour"];
$edit_o_minute = $_POST["edit_o_minute"];
$edit_c_hour = $_POST["edit_c_hour"];
$edit_c_minute = $_POST["edit_c_minute"];
$edit_day = implode(",", $_POST["edit_day"]);

if ($edit_o_minute == "00") {
    $edit_o_minute = 0;
}
else{
    $edit_o_minute =intval($edit_o_minute);
}
if ($edit_c_minute == "00") {
    $edit_c_minute = 0;
}
else{
    $edit_c_minute =intval($edit_c_minute);
}

// echo "++"+"++";
// if(is_null($_POST["edit_day"])){
//     echo "null";
// }
// echo $edit_day;

$sql = sprintf("SELECT * FROM `stores` WHERE `SID`= %d ;", intval($SID));
// echo "<script>window.alert('"++"');window.location.href='edit_store.html';</script>";
// echo $sql;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

for ($i = 1; $i < 7; $i++) {
    if ($i == 1 and $row["name"] != $edit_name_name) {
        $sql=sprintf("UPDATE `stores` SET `name`='%s' WHERE `SID`= %d ;",$edit_name_name, intval($SID));
        $result1 = $conn->query($sql);
    } 
    elseif ($i == 2 and $row["open_time_hour"] != intval($edit_o_hour)) {
        $sql=sprintf("UPDATE `stores` SET `open_time_hour`=%d WHERE `SID`= %d ;",intval($edit_o_hour), intval($SID));
        $result2 = $conn->query($sql);
    } 
    elseif ($i == 3 and $row["open_time_minute"]!=$edit_o_minute) {
        $sql=sprintf("UPDATE `stores` SET `open_time_minute`=%d WHERE `SID`= %d ;",$edit_o_minute, intval($SID));
        $result3 = $conn->query($sql);
    } 
    elseif ($i == 4 and $row["closed_time_hour"]!=intval($edit_c_hour)) {
        $sql=sprintf("UPDATE `stores` SET `closed_time_hour`=%d WHERE `SID`= %d ;",intval($edit_c_hour), intval($SID));
        $result4 = $conn->query($sql);
    } 
    elseif ($i == 5 and $row["closed_time_minute"]!=$edit_c_minute) {
        $sql=sprintf("UPDATE `stores` SET `closed_time_minute`=%d WHERE `SID`= %d ;",$edit_c_minute, intval($SID));
        $result5 = $conn->query($sql);
    } 
    elseif ($i == 6 and $row["closed_day"]!=$edit_day) {
        $sql=sprintf("UPDATE `stores` SET `closed_day`='%s' WHERE `SID`= %d ;",$edit_day, intval($SID));
        $result6 = $conn->query($sql);
    }
}

// echo sprintf("<script>window.alert('%s');window.location.href='edit_store.html';</script>",$SID);
echo "<script>window.alert('修改完成');window.location.href='edit_store.html';</script>";
exit;

?>